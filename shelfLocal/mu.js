var core = {
	//--------------------------------------------------------------------------------------------------
	// PROGRAMMER CONFIGURATION VARIABLES
	MAX_BYTE_UPLOAD:60*1024*1024, // should set lower than server will accept, there's overhead
	SITE_NAME:"FtB575", // used in notifications to the guest
	CORE_FILE_PATH:π.mainDirectory()+"shelfRemote/mu.php", // where to send the AJAX requests
	TIMEOUT_DURATION:10*60*1000000, // in microseconds, will stop waiting for a response
	POOR_QUALITY_MINIMUM_WAIT:3*1000000, // in microseconds, for people with a poor network connection
	COMMAND_QUEUE_MAX_SIZE:99, // maximum commands on the waiting list before ignoring future ones
	ROW_REFRESH_MAXIMUM_WAIT:5*60*1000000, // in microseconds, the most time we'll wait to refresh a row, even though the server reports that the row rarely changes [the server may enforce a max wait, but that doesn't mean that you can't do it too]
	EVICT_DELTA_T:10*1000000, // evict entries that haven't been getRow()ed in this many microseconds
	MAX_REFRESH_WAIT_DELTA_T:5*1000000, // if it's been this long since an entry was requested, request it again to see if there's newer data
	MEMORY_ENTRY_C:0, // while storage memory usage is less than or equal to this many entries, no passive eviction will take place
	//--------------------------------------------------------------------------------------------------
	timeUpgrade       : (function(){var a,b;a=Date.now();b=performance.now();return(a-b)*1000;})(),
	now               : function(){return Math.trunc(performance.now()*1000 + this.timeUpgrade);},
	nowServer         : function(){return Math.trunc(performance.now()*1000 + this.timeUpgrade)+this.serverOffsetT;},
	serverOffsetTA    : [],
	serverOffsetT     : 0,
	liveF             : T,
	// requestID needs to be an increasing, comparable value, but it's only ever compared to
	// past requests with the exact same [processID, table, action], and this detail is important
	// for example, it allows the MU server to piggyback message fetches with messageIDA fetches,
	// using the same requestID and processID, but different table and action
	req               :  0,
	ntq               :  0, // 0 for baseline, positive for good, negative for bad
	socketO           : {MU:{
		preGlobal  : function(){},
		pre        : function(){},
		post       : function(){},
		postGlobal : function(){},}},
	notify            : function(str){console.log(str);},
	heylisten         : function(str){console.log(str);},
	patientTimeoutA   : [],
	requestQueue      : [],
	who               :  0,
	plu               : "",
	storage           : {}, // a local swiss cheese copy of the database
	reqxlocalPak      : {},
	// !!! registration structure for process ID dependencies and callbacks on update
	hasRow : function(tbl,ID){return (typeof this.storage[tbl] !== "undefined" && typeof this.storage[tbl][ID] !== "undefined" && typeof this.storage[tbl][ID].row !== "undefined");},
	hasEntry : function(tbl,ID){return (typeof this.storage[tbl] !== "undefined" && typeof this.storage[tbl][ID] !== "undefined");},
	getRow : function(tbl,ID,secretF=F){if (!secretF){ll("getRow : "+tbl+":"+ID);}
		if (!secretF){
			if (typeof this.storage[tbl]     === "undefined"){this.storage[tbl]     = {};}
			if (typeof this.storage[tbl][ID] === "undefined"){this.storage[tbl][ID] = {};}
			this.storage[tbl][ID].getLatestT = this.now();}
		if (!this.hasRow(tbl,ID)){
			if (!secretF){this.requestRowA(tbl,[ID]);}
			return N;}
		return this.storage[tbl][ID].row;},
	getEntry : function(tbl,ID,secretF=F){
		if (!secretF){
			if (typeof this.storage[tbl]     === "undefined"){this.storage[tbl]     = {};}
			if (typeof this.storage[tbl][ID] === "undefined"){this.storage[tbl][ID] = {};}
			this.storage[tbl][ID].getLatestT = this.now();}
		if (!this.hasEntry(tbl,ID)){return N;}
		return this.storage[tbl][ID];},
	requestRowA : function(tbl,IDA){ll("requestRowA : "+tbl+":"+π.jsonE(IDA));
		var now = this.now();
		// separate rows by ones we're initially getting and ones we're refreshing
		var IDAO = IDA.distribute(ID=>{
			if (typeof this.storage[tbl]     === "undefined"){this.storage[tbl]     = {};}
			if (typeof this.storage[tbl][ID] === "undefined"){this.storage[tbl][ID] = {};}
			var entry = this.storage[tbl][ID];
			// we don't have any info, it's new
			if (typeof entry.pendingT === "undefined"){entry.pendingT = now;return "initial";}
			// we have pendingT info and it's not N, we're already waiting on this row don't ask for it again
			if (typeof entry.pendingT !== "undefined" && entry.pendingT !== N){ll("HOLD YOUR HORSES "+tbl+" "+ID);return U;}
			var row = (entry===N?N:(typeof entry.row === "undefined"?N:entry.row));
			// we don't have the row, it's new
			if (row === N){return "initial";}
			// we don't have any refresh timing information, grudgingly let it through as if it's new
			if (typeof row.t1 === "undefined"){return "initial";}
			// default fallthrough to refresh
			return "refresh";},["refresh","initial"]);
		var successFxn = (function(that){return function(o){ll("success");
			if (typeof that.storage[o.mir.tbl] === "undefined"){return F;} // row was deleted/killed while this request was busy
			o.dat["fresh"][o.mir.tbl].forEach((row,ID)=>{//ll("fresh : "+o.mir.tbl+":"+ID);
				if (!that.calcIsValidRowF(row)){return F;}
				if (typeof that.storage[o.mir.tbl][ID] === "undefined"){return F;} // row was deleted/killed while this request was busy
				//var waitT = Math.max(0,Math.min(that.ROW_REFRESH_MAXIMUM_WAIT,3000000));
				that.storage[o.mir.tbl][ID].row = row;
				that.storage[o.mir.tbl][ID].rcvLatestT = that.now();
				that.storage[o.mir.tbl][ID].pendingT = N;
				//that.storage[o.mir.tbl][ID]._tStaleTimeout = setTimeout((function(that,tbl,ID){return function(){
				//	that.storage[tbl][ID].needsRefreshF = T;
				//};})(that,o.mir.tbl,ID),waitT/1000);
			});
			o.dat["repeat"][o.mir.tbl].forEach((row,ID)=>{//ll("repeat : "+o.mir.tbl+":"+ID);
				if (typeof that.storage[o.mir.tbl][ID] === "undefined"){return F;} // row was deleted/killed while this request was busy
				that.storage[o.mir.tbl][ID].rcvLatestT = that.now();
				that.storage[o.mir.tbl][ID].pendingT = N;
				//var waitT = Math.max(0,Math.min(that.ROW_REFRESH_MAXIMUM_WAIT,3000000));
				//that.storage[o.mir.tbl][ID]._tStaleTimeout = setTimeout((function(that,tbl,ID){return function(){
				//	that.storage[tbl][ID].needsRefreshF = T;
				//};})(that,o.mir.tbl,ID),waitT/1000);
			});
			o.dat["bad"][o.mir.tbl].forEach((row,ID)=>{//ll("bad : "+o.mir.tbl+":"+ID);
				if (typeof that.storage[o.mir.tbl][ID] === "undefined"){return F;} // row was deleted/killed while this request was busy
				that.storage[o.mir.tbl][ID].rcvLatestT = that.now();
				that.storage[o.mir.tbl][ID].pendingT = N;
				delete that.storage[o.mir.tbl][ID]; // delete-if-exists
			});
			that.registerRcvCallbackO.forEach(fxn=>{fxn(o.dat);});
		};})(this);
		var neutralFxn = (function(that){return function(o){ll("neutral");};})(this);
		var failureFxn = (function(that){return function(o){ll("failure");};})(this);
		// rows we're initially getting
		if (IDAO["initial"].length >= 1){this.send({tbl,act:"get",dat:{_IDA:IDAO["initial"],modificationTA:[]},patientDeltaT:0,successFxn,neutralFxn,failureFxn});}
		// rows we're refreshing
		if (IDAO["refresh"].length >= 1){this.send({tbl,act:"get",dat:{_IDA:IDAO["refresh"],modificationTA:IDAO["refresh"].map(ID=>this.getRow(tbl,ID,T).t1)},patientDeltaT:0,successFxn,neutralFxn,failureFxn});}
		},
	registerRcvCallbackO : {},
	registerRcvCallbackAssert : function(k,fxn){this.registerRcvCallbackO[k] = fxn;},
	registerRcvCallbackDessert : function(k){delete this.registerRcvCallbackO[k];},
	storageRefresh : function(){
		if (!this.liveF){return;} // fail-fast : core stopped
		
		if (this.storage.mapV(entryO=>Object.keys(entryO).length).sum() > core.MEMORY_ENTRY_C){
			// evict rows that haven't been asked for in a long time
			this.storage.forEach((entryO,tbl)=>{
				var len1 = Object.keys(this.storage[tbl]).length;
				this.storage[tbl] = entryO.filter(entry=>entry.getLatestT+this.EVICT_DELTA_T>=this.now());
				var len2 = Object.keys(this.storage[tbl]).length;
				var lenDelta = len2-len1;
				if (lenDelta < 0){ll("EVICTED "+(-lenDelta)+" ROWS");}
			});}
		
		// foreach ID remaining, refresh rows that are considered stale
		this.storage.forEach((entryO,tbl)=>{
			var IDA = entryO.filter(entry=>entry.rcvLatestT+this.MAX_REFRESH_WAIT_DELTA_T<this.now()).mapV(entry=>entry.row._ID);
			if (IDA.length >= 1){
				ll("storageRefresh["+tbl+"] : "+π.jsonE(IDA));
				this.requestRowA(tbl,IDA);}
		});
		
		setTimeout((function(that){return function(){that.storageRefresh();};})(this),1000);},
	calcIsValidRowF : function(m){
		if (!isO(m)){return F;}
		if (typeof m._ID !== "number"){return F;}
		//if (typeof m.t0 !== "number"){return F;}
		//if (typeof m.t1 !== "number"){return F;}
		return T;},
	// ask to queue up a command (no guarantees)
	send:function(m=[]){
		(isA(m) ? m : arguments).forEach(v=>{
			if (this.requestQueue.length >= this.COMMAND_QUEUE_MAX_SIZE){return F;} // fail-fast : queue full
			this.req++;
			π.ooaw(v,{
				tbl : "",
				act : "",
				dat : {},
				flO : {},
				ntq : this.ntq,
				req : this.req,
				who : this.who,
				plu : this.plu,
				patientDeltaT : 100000,
				alwaysPreFxn  : ()=>{},
				progressFxn   : ()=>{},
				successFxn    : ()=>{},
				neutralFxn    : ()=>{},
				failureFxn    : ()=>{},
				alwaysPostFxn : ()=>{},});
			v.flO = v.flO.filter(v=>typeof v !== "undefined" && v !== null);
			this.requestQueue.push(π.kr(π.cc(v),["tbl","act","dat","flO","ntq","req","who","plu"]));
			if (this.ntq < 0){
				v.patientDeltaT = Math.max(v.patientDeltaT,this.POOR_QUALITY_MINIMUM_WAIT/1000);}
			this.reqxlocalPak[this.req] = v;
			if (v.patientDeltaT < 0){this.run();}
			else{this.patientTimeoutA.push(setTimeout((function(that){return function(){that.run();};})(this),v.patientDeltaT/1000));}});
		return T;},
	// run the commands in the queue, grouped into one batch
	run:function(){
		if (!this.liveF){return;} // fail-fast : core stopped
		
		// we're running all the commands right now, no need to hold on to these timeouts
		this.patientTimeoutA.forEach(patientTimeout=>{
			clearTimeout(patientTimeout);});
		this.patientTimeoutA = [];
		
		if (this.requestQueue.length > 0){
			// set up the core request
			var xhr = new XMLHttpRequest();
			xhr.sks = [];
			xhr.upload.sks = xhr.sks;
			var data = new FormData();
			this.requestQueue.forEach(request=>{
				// check that the files will fit, if not, simply ignore this one, and allow the other commands through
				var totalFileSize = request.flO.mapV(v=>v.size).sum();
				if (totalFileSize > this.MAX_BYTE_UPLOAD){
					this.heylisten("Your selected files add up to "+totalFileSize+"B which is more than "+this.MAX_MB_UPLOAD+"B, the current maximum.");
					return;}
				// sent files must be in PHP root scope, unfortunately, so we identify them with their request's requestID
				// name of file,file handle --> $_FILES[nameOfFile] = file handle
				request.flO.forEach((fil,filename)=>{
					data.append(request.req+"_"+filename,fil);
					});
				delete request.flO; // files are worthless when jsonified
				xhr.sks.push(request);});
			this.requestQueue = [];
			xhr.upload.addEventListener("progress",(function(that){return function(ev){
				// ev.loaded/ev.total maps from 0 to 1
				this.sks.forEach(v=>{
					that.reqxlocalPak[v.req].progressFxn(ev.loaded/ev.total);});};})(this));
			xhr.timeout = this.TIMEOUT_DURATION/1000;
			xhr.ontimeout = (function(that){return function(){that.notify("core timeout: "+this);};})(this);
			xhr.onreadystatechange = (function(that){return function(ev){
				if (this.readyState === 4){
					if (this.status === 200){
						var timestamp = that.now();
						// what you can do with "this" passed to the global trigger functions : this.responseText | this.responseText.length | parseInt(this.getResponseHeader("Content-Length")) | this.getAllResponseHeaders()
						var allData = (this.responseText.length === 0) ? [] : (π.jsonD(this.responseText));allData.forEach(v=>{v.f = timestamp;});
						that.socketO["MU"]["preGlobal"](allData,this);
						allData.forEach(o=>{
							that.serverOffsetTA.push((o.b-o.a)-(o.f-o.e)); // make the iffy assumption that in-flight network times to and from should be equal
							π.ooa(o,{mir:that.reqxlocalPak[o.req]});
							// check for network rate limit
							if (o.sta === -9001){
								that.notify(o.msg);
								return;}
							that.reqxlocalPak[o.req].progressFxn(1);
							that.socketO["MU"]["pre"](o);
							that.reqxlocalPak[o.req].alwaysPreFxn(o);
							switch (Math.sign(o.sta)){default:;
								break;case  1: that.reqxlocalPak[o.req].successFxn(o);
								break;case  0: that.reqxlocalPak[o.req].neutralFxn(o);
								break;case -1: that.reqxlocalPak[o.req].failureFxn(o);}
							that.socketO["MU"]["post"](o);
							delete that.reqxlocalPak[o.req];});
						that.socketO["MU"]["postGlobal"](allData,this);
						that.serverOffsetT = that.serverOffsetTA.average();}
					else{
						// error
						that.notify("core error (status:"+this.status+"): ");
						that.notify(this);}}};})(this);
			xhr.open("POST",this.CORE_FILE_PATH,T);
			var timestamp = this.now();
			xhr.sks.forEach(v=>{
				this.reqxlocalPak[v.req].progressFxn(0);
				v.a = timestamp;});
			data.append("sks",π.jsonE(xhr.sks));
			xhr.send(data);}},
	// !!! cancel a request
	cancel:function(){},
	start:function(){
		this.liveF = T;
		this.run();
		this.storageRefresh();},
	stop:function(){
		this.liveF = F;},
}
// set core into motion on load
document.addEventListener("DOMContentLoaded",function(){core.start();});
