var core = {
	//--------------------------------------------------------------------------------------------------
	// PROGRAMMER CONFIGURATION VARIABLES
	MAX_BYTE_UPLOAD:60*1024*1024, // should set lower than server will accept, there's overhead
	SITE_NAME:"FtB575", // used in notifications to the guest
	CORE_FILE_PATH:π.mainDirectory()+"shelf/rho.php", // where to send the AJAX requests
	TIMEOUT_DURATION:10*60*1000, // in milliseconds, will stop waiting for a response
	POOR_QUALITY_MINIMUM_WAIT:3000, // in milliseconds, for people with a poor network connection
	COMMAND_QUEUE_MAX_SIZE:99, // maximum commands on the waiting list before ignoring future ones
	//--------------------------------------------------------------------------------------------------
	timeUpgrade       : function(){var a,b;a=Date.now();b=performance.now();return(a-b)*1000;}(),
	now               : function(){return Math.trunc(performance.now()*1000 + this.timeUpgrade);},
	live              :  0 ,
	// requestID needs to be an increasing, comparable value, but it's only ever compared to
	// past requests with the exact same [processID, table, action], and this detail is important
	// for example, it allows the RHO server to piggyback message fetches with messageIDA fetches,
	// using the same requestID and processID, but different table and action
	req               :  0 ,
	ntq               :  0 , // 0 for baseline, positive for good, negative for bad
	socketO           : {} ,
	bin               : {} ,
	interval          : {} ,
	notify            : function(str){console.log(str);},
	heylisten         : function(str){console.log(str);},
	patientTimeoutA   : [] ,
	pqueue            : [] ,
	plu               : "" ,
	who               :  0 ,
	// ask to queue up a command (no guarantees)
	send:function(m){
		var arg = (typeof m !== "undefined" && Array.isArray(m)) ? m : arguments;
		for (var p of arg){
			if (typeof p         === "undefined" || p         === null){p         = {} ;}
			if (typeof p.tbl     === "undefined" || p.tbl     === null){p.tbl     = "" ;}
			if (typeof p.act     === "undefined" || p.act     === null){p.act     = "" ;}
			if (typeof p.dat     === "undefined" || p.dat     === null){p.dat     = {} ;}
			if (typeof p.fln     === "undefined" || p.fln     === null){p.fln     = [] ;}
			if (typeof p.fil     === "undefined" || p.fil     === null){p.fil     = [] ;}
			if (typeof p.prc     === "undefined" || p.prc     === null){p.prc     = "" ;}
			if (typeof p.patient === "undefined" || p.patient === null){p.patient = 100000;}
			//if (p.prc != "custom"){return;} // temporary fail-fast
			p.ntq = this.ntq;
			p.req = this.req++;
			p.who = this.who;
			p.plu = this.plu;
			if (this.pqueue.length >= this.COMMAND_QUEUE_MAX_SIZE){return false;} // fail-fast : queue full
			this.pqueue.push(p);
			if (this.ntq < 0){p.patient = (p.patient<this.POOR_QUALITY_MINIMUM_WAIT) ? this.POOR_QUALITY_MINIMUM_WAIT : p.patient;}
			if (p.patient === 0){this.run();}
			else{this.patientTimeoutA.push(setTimeout(function(){core.run();},p.patient/1000));}}
		return true;},
	// run the commands in the queue, grouped into one batch
	run:function(){
		if (this.live <= 0){return;} // fail-fast : core stopped
		
		// we're running all the commands right now, no need to hold on to these timeouts
		for (var i = 0; i < this.patientTimeoutA.length; i++){
			clearTimeout(this.patientTimeoutA[i]);
			this.patientTimeoutA[i] = null;}
		this.patientA = [];
		
		if (this.pqueue.length === 0){
			/*this.notify("core blank");*/}
		else{
			// set up the core request
			var xhr = new XMLHttpRequest();
			xhr.sks = [];
			var data = new FormData();
			for (var i = 0; i < this.pqueue.length; i++){
				var p = this.pqueue[i];
				p.ntq = this.ntq;
				
				// check that the files will fit, if not, simply ignore this one, and allow the other commands through
				var totalFileSize = 0;
				for (var ii = 0; ii < p.fil.length; ii++){totalFileSize += p.fil[ii].size;}
				if (totalFileSize > this.MAX_BYTE_UPLOAD){
					this.heylisten("your selected files add up to "+totalFileSize+"B which is more than "+this.MAX_MB_UPLOAD+"B, the current "+this.SITE_NAME+" maximum.");
					continue;}
				
				// AJAX files must be in root scope, unfortunately, so we identify them with their request's requestID
				// name of file,file handle --> $_FILES[nameOfFile] = file handle
				for (var ii = 0; ii < p.fil.length; ii++){
					data.append(preq+"_"+p.fln[ii],p.fil[ii]);}
				
				delete p.patient; // patient isn't needed after dequeueing is complete
				delete p.fil; // deletes reference, not underlying object ; fileA is worthless when jsonified
				
				// add the segment to the batch
				xhr.sks.push(p);}
			this.pqueue = [];
			
			
			xhr.upload.addEventListener('progress',function(ev){
				// ev.loaded/ev.total maps from 0 to 1
				var socket = (typeof core.socketO[this.tbl] != "undefined") ? core.socketO[this.tbl][this.act] : undefined;
				if (typeof socket != "undefined" && typeof socket.progress === "function"){socket.progress(this.prc,ev.loaded/ev.total);}});
			xhr.timeout = this.TIMEOUT_DURATION;
			xhr.ontimeout = function(){core.notify("core timeout: "+this);};
			xhr.onreadystatechange = function(ev){
				if (this.readyState === 4){
					if (this.status === 200){
						var timestamp = core.now();
						//core.notify(this.getAllResponseHeaders());
						var socketGlobalPre = (typeof core.socketO["RHO"] === "undefined"?function(){}:(typeof core.socketO["RHO"]["preGlobal"] === "undefined"?function(){}:core.socketO["RHO"]["preGlobal"]));
						if (typeof socketGlobalPre === "function"){socketGlobalPre(this.responseText.length,parseInt(this.getResponseHeader('Content-Length')));}
						var allData = (this.responseText.length === 0) ? [] : JSON.parse(this.responseText);
						for (var iAll = 0; iAll < allData.length; iAll++){
							var o = allData[iAll];
							o.f = timestamp;
							//core.notify(o);
							// check for network rate limit
							if (o.sta === -9001){
								core.notify(o.msg);
								continue;}
							// check for stale response
							var staleResponse = (
								typeof core.bin[o.mir.prc] != "undefined" &&
								typeof core.bin[o.mir.prc][o.mir.tbl] != "undefined" &&
								typeof core.bin[o.mir.prc][o.mir.tbl][o.mir.act] != "undefined" &&
								typeof core.bin[o.mir.prc][o.mir.tbl][o.mir.act]["req"] != "undefined" &&
								oreq < core.bin[o.mir.prc][o.mir.tbl][o.mir.act]["req"]);
							
							if (typeof core.interval[o.mir.prc] === "undefined"){core.interval[o.mir.prc] = {};}
							if (typeof core.interval[o.mir.prc][o.mir.tbl] === "undefined"){core.interval[o.mir.prc][o.mir.tbl] = {};}
							core.interval[o.mir.prc][o.mir.tbl][o.mir.act] = o.int;
							
							if (typeof core.bin[o.mir.prc] === "undefined"){core.bin[o.mir.prc] = {};}
							if (typeof core.bin[o.mir.prc][o.mir.tbl] === "undefined"){core.bin[o.mir.prc][o.mir.tbl] = {};}
							core.bin[o.mir.prc][o.mir.tbl][o.mir.act] = o;
							
							var halfsocket = core.socketO[o.mir.tbl];
							if (typeof halfsocket === "undefined"){halfsocket = {};} // no socket functions hooked up, oh well
							var socket = halfsocket[o.mir.act];
							if (typeof socket === "undefined"){socket = {};} // no socket functions hooked up, oh well
							
							var socketAllPre = (typeof core.socketO["RHO"] === "undefined"?function(){}:(typeof core.socketO["RHO"]["pre"] === "undefined"?function(){}:core.socketO["RHO"]["pre"]));
							var socketAllPost = (typeof core.socketO["RHO"] === "undefined"?function(){}:(typeof core.socketO["RHO"]["post"] === "undefined"?function(){}:core.socketO["RHO"]["post"]));
							
							if (typeof socket.progress === "function"){socket.progress(1);}
							if (typeof socketAllPre === "function"){socketAllPre(o);}
							if (typeof socket.pre === "function"){socket.pre(o);}
							if (staleResponse){
								if (typeof socket.stale === "function"){socket.stale(o);}}
							else{
								if (o.sta < 0){
									if (typeof socket.failure === "function"){socket.failure(o);}}
								else if (o.sta === 0){
									if (typeof socket.empty === "function"){socket.empty(o);}}
								else if (o.sta > 0){
									if (typeof socket.success === "function"){socket.success(o);}}}
							if (typeof socketAllPost === "function"){socketAllPost(o);}
							if (typeof socket.post === "function"){socket.post(o);}
							if (typeof socket.progress === "function"){socket.progress(0);}}
						var socketGlobalPost = (typeof core.socketO["RHO"] === "undefined"?function(){}:(typeof core.socketO["RHO"]["postGlobal"] === "undefined"?function(){}:core.socketO["RHO"]["postGlobal"]));
						if (typeof socketGlobalPost === "function"){socketGlobalPost(this.responseText.length,parseInt(this.getResponseHeader('Content-Length')));}}
					else{
						// error
						core.notify("core error (status:"+this.status+"): ");
						core.notify(this);}}};
			xhr.open('POST',this.CORE_FILE_PATH,true);
			var timestamp = this.now();
			for (var i = 0; i < xhr.sks.length; i++){
				xhr.sks[i].a = timestamp;}
			data.append("sks",JSON.stringify(xhr.sks));
			xhr.send(data);}},
	start:function(){
		this.live = 1;
		this.run();},
	stop:function(){
		this.live = 0;},
	up:function(){
		this.live++;
		this.run();},
	down:function(){
		this.live--;},
}
// set core into motion on load
document.addEventListener("DOMContentLoaded",function(){core.start();});
