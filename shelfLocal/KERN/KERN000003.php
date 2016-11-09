<script>
// WARNING : THIS OBJECT IS RELIANT ON /edit/ BECAUSE OF /edit/'S VISUAL CONTROLS
var GameFrame = function(processID,elP){
	µ.rr(elP,µ.m([[
		["canvas.gameframe[data-layer='L']"],
		["canvas.gameframe[data-layer='N']"],
		["canvas.gameframe[data-layer='J']"],
		["canvas.gameframe[data-layer='P']"],
		["canvas.gameframe[data-layer='S']"],]]));
	var canvasL = µ.qd(elP,"canvas.gameframe[data-layer='L']");
	var canvasN = µ.qd(elP,"canvas.gameframe[data-layer='N']");
	var canvasJ = µ.qd(elP,"canvas.gameframe[data-layer='J']");
	var canvasP = µ.qd(elP,"canvas.gameframe[data-layer='P']");
	var canvasS = µ.qd(elP,"canvas.gameframe[data-layer='S']");
	π.ooAbsorb(this,{
		initF    : false,
		processID,
		canvasO   : {
			"S":canvasS,
			"P":canvasP,
			"J":canvasJ,
			"N":canvasN,
			"L":canvasL,},
		ctxO      : {
			"S":canvasS.getContext("2d"),
			"P":canvasP.getContext("2d"),
			"J":canvasJ.getContext("2d"),
			"N":canvasN.getContext("2d"),
			"L":canvasL.getContext("2d"),},
		canvasContainer : canvasS.parentNode,});
	this.ctxO.forEach(v=>{v.imageSmoothingEnabled = false;});
	this.canvasO.S.addEventListener("mousemove",function(gf){return function(e){
		var x = µ.offsetLeftTotal(this) + e.pageX;
		var y = µ.offsetTopTotal (this) + e.pageY;
		if (Ω.mousedownF){
			if (gf.initF && (y <= gf.progressH || y >= gf.height-gf.progressH)){
				gf.jump((gf.audio.duration===0)?0:(x/gf.width)*gf.audio.duration*1000000);}}
	};}(this));
	this.canvasO.S.addEventListener("mousemove",function(gf){return function(e){
		var x = µ.offsetLeftTotal(this) + e.pageX;
		var y = µ.offsetTopTotal (this) + e.pageY;
		gf.mousemove(x,y);
	};}(this));
	this.canvasO.S.addEventListener("mousedown",function(gf){return function(e){
		var x = µ.offsetLeftTotal(this) + e.pageX;
		var y = µ.offsetTopTotal (this) + e.pageY;
		gf.mousedown(x,y);
	};}(this));
	this.canvasO.S.addEventListener("mouseup"  ,function(gf){return function(e){
		var x = µ.offsetLeftTotal(this) + e.pageX;
		var y = µ.offsetTopTotal (this) + e.pageY;
		gf.mouseup(x,y);
	};}(this));
	// ???
	this.mousemove = function(x,y){
		if (Ω.mousedownF){this.mousedown(x,y);}};
	this.mousedown = function(x,y){//ll("mousedown : ("+x+","+y+")");
		if (this.initF && (y <= this.progressH || y >= this.height-this.progressH)){
			this.jump((this.audio.duration===0)?0:(x/this.width)*this.audio.duration*1000000);}
		var validF = F;
		for (var lane = 1; lane <= this.keyC; lane++){
			var _x  = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
			var _xx = _x+this.noteW;
			if (_x <= x && x <= _xx){validF = T;break;}}
		if (validF){this.keydown({which:-lane,location:-575});}}; // iffy
	this.mouseup   = function(x,y){//ll("mouseup   : ("+x+","+y+")");
		var validF = F;
		for (var lane = 1; lane <= this.keyC; lane++){
			var _x  = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
			var _xx = _x+this.noteW;
			if (_x <= x && x <= _xx){validF = T;break;}}
		if (validF){this.keyup({which:-lane,location:-575});}}; // iffy
	this.errorToScore = (error,boundary=this.missBoundary)=>(error>boundary)?0:Math.cos(Math.PI*error/(2*boundary))*this.missBoundary;
	
	this.registerDriveA = [];
	this.registerDrive = function(fxn){
		this.registerDriveA.push(fxn);};
	
	window.addEventListener("keydown",this.keydown=(event)=>{
		var instantT = (this.initF)
			? (p.now() - this.anchorUpT) * this.audio.playbackRate + this.anchorP
			: null;
		// needs separation, don't reach into p like this
		this.keyO.forEach((keySubA,label)=>{if (keySubA === null){return;}
			keySubA.forEach(v=>{
				if (v.s === 0 && v.k === event.which && v.l === event.location && label === "reset"){
					if (typeof p.gfLoad !== "undefined"){
						p.gfLoad();}}})});
		if (!this.initF){
			return;}
		if (document.activeElement.matches("input,textarea")){return;}
		// keyCodeA : [null,[{k:65,s:0}],[{k:83,s:0}],[{k...
		this.keyO.forEach((keySubA,label)=>{if (keySubA === null){return;}
			keySubA.forEach(v=>{
				if (v.s === 0 && v.k === event.which && v.l === event.location){
					v.s = 1;
					if (this.state === "playing" && label.startsWith("lane ")){
						var lane = int(label.substr("lane ".length));
						// if note is close by, trigger it, cap out at 1 note maximum
						var loopmax = this.lanexnoteA[lane].length;
						for (var iNote = 0; iNote < loopmax; iNote++){var note = this.lanexnoteA[lane][iNote];
							if (note.started){continue;} // ignore notes that have already been triggered
							if (note.ended){continue;} // ??? might not be needed
							var errorEarly = this.timeAdjust(note.head)-instantT;
							var errorLate = -1*errorEarly;
							var error = Math.abs(errorEarly);
							var early = (errorEarly > 0);
							var exact = (errorEarly === 0);
							var late = (errorLate > 0);
							// hit note
							if (typeof note.tail === "undefined"){
								if (error <= this.missBoundary){
									this.score += this.errorToScore(error);
									this.stat.push([iNote,0,error]);
									note.started = true;
									note.ended = true;}}
							// hold note
							else{
								if (error <= this.missBoundary){
									this.score += this.errorToScore(error);
									this.stat.push([iNote,0,error]);
									note.started = true;
									note.ended = false;}}}}
					else{
						switch (label){default:
						//break;case "reset" :this.init();
						break;case "pause"  : this.resume_SIGNAL = 0;this.pause_SIGNAL = 1;
						break;case "resume" : this.resume_SIGNAL = 1;this.pause_SIGNAL = 0;
						break;case "0 jump" : this.jump(0);
						break;case "hop ↑"  : if (this.snapMultiplier !== 0){this.jump(this.nearestSnapUp());}
						break;case "hop ↓"  : if (this.snapMultiplier !== 0){this.jump(this.nearestSnapDown());}
						break;case "jump ↑" : if (this.snapMultiplier !== 0){this.jump(this.nearestSnapMajorUp());}
						break;case "jump ↓" : if (this.snapMultiplier !== 0){this.jump(this.nearestSnapMajorDown());}
						break;case "pbr ↑"  : KERN000001.flow({group:"gf","¥":"playbackRate",fxn:el=>({value:el.KERN.valueUp()}),});
						break;case "pbr ↓"  : KERN000001.flow({group:"gf","¥":"playbackRate",fxn:el=>({value:el.KERN.valueDown()}),});
						break;case "spd ↑"  : KERN000001.flow({group:"gf","¥":"speedMultiplier",fxn:el=>({value:el.KERN.valueUp()}),});
						break;case "spd ↓"  : KERN000001.flow({group:"gf","¥":"speedMultiplier",fxn:el=>({value:el.KERN.valueDown()}),});
						break;case "snap ↑" : KERN000001.flow({group:"gf","¥":"snapMultiplier",fxn:el=>({value:el.KERN.valueUp()}),});
						break;case "snap ↓" : KERN000001.flow({group:"gf","¥":"snapMultiplier",fxn:el=>({value:el.KERN.valueDown()}),});
						}}}});});
		this.renderRegister("J");
		this.renderRegister("L");
	});
	window.addEventListener("keyup",this.keyup=(event)=>{
		var instantT = (this.initF)
			? (p.now() - this.anchorUpT) * this.audio.playbackRate + this.anchorP
			: null;
		if (!this.initF){return;}
		if (document.activeElement.matches("input,textarea")){return;}
		// keyCodeA : [null,[{k:65,s:0}],[{k:83,s:0}],[{k...
		this.keyO.forEach((keySubA,label)=>{if (keySubA === null){return;}
			keySubA.forEach(v=>{
				if (v.s === 1 && v.k === event.which && v.l === event.location){
					v.s = 0;
					if (this.state === "playing" && label.startsWith("lane ")){
						var lane = int(label.substr("lane ".length));
						// if [hold]note is close by, [un]trigger it, cap out at 1 note maximum
						var loopmax = this.lanexnoteA[lane].length;
						for (var iNote = 0; iNote < loopmax; iNote++){var note = this.lanexnoteA[lane][iNote];
							if (!note.started || note.ended || typeof note.tail === "undefined"){continue;} // ignore these notes
							var errorEarly = this.timeAdjust(note.tail)-instantT;
							var errorLate = -1*errorEarly;
							var early = (errorEarly > 0);
							var exact = (errorEarly === 0);
							var late = (errorLate > 0);
							// hold note
							if (exact){
								this.score += this.errorToScore(0);
								this.stat.push([iNote,1,0]);}
							else if (late/* && errorLate <= note.tail-note.head*/){
								this.score += this.errorToScore(errorLate,this.timeAdjust(note.tail)-this.timeAdjust(note.head));
								this.stat.push([iNote,1,errorLate]);
								ll(this.errorToScore(errorLate,note.tail-note.head));
								note.ended = true;}
							else if (early/* && errorEarly <= note.tail-note.head*/){
								this.score += this.errorToScore(errorEarly,this.timeAdjust(note.tail)-this.timeAdjust(note.head));
								this.stat.push([iNote,1,errorEarly]);
								ll(this.errorToScore(errorEarly,this.timeAdjust(note.tail)-this.timeAdjust(note.head)));
								note.ended = true;}}}}});});
		this.renderRegister("J");
		this.renderRegister("L");
	});
	
	this.optionDessert = function(o={}){π.p(o,{type:"",m:{}});};
	this.optionAssert  = function(o={}){π.p(o,{type:"",m:{}});
		π.p(o.m,{type:"",e:{}});
		π.p(o.m.e,{which:0,location:0});
		ll(o);
		switch (o.type){default : ;
			break;case "key" :
				if (typeof this.keyO === "undefined"){this.keyO = {};} // I want some keys to work before initing
				if (typeof this.keyO[o.m.type.substr("key-".length)] === "undefined"){this.keyO[o.m.type.substr("key-".length)] = [];}
				this.keyO[o.m.type.substr("key-".length)].push({k:o.m.e.which,l:o.m.e.location,s:0});}};
	
	this.init = function(noteA=this.noteA,snapA=this.snapA,keyC=this.keyC,audioFile=this.audioFile,optionO=this.optionO){
		π.ooAbsorb(this,{
			syncMovingAverage : new π.MovingAverage(180),
			optionO           : optionO,
			anchorDownT       : 0,
			anchorUpT         : 0,
			endT              : null,
			anchorP           : null,
			currentP          : null,
			renderRegisterA   : [],
			missBoundary      : 125000,
			state             : "waiting",
			introLatch        : 0,
			load_SIGNAL       : 0,
			loaded_SIGNAL     : 0,
			play_SIGNAL       : 0,
			pause_SIGNAL      : 0,
			finished_SIGNAL   : 0,
			resume_SIGNAL     : 0,
			noteA             : noteA, // don't use this variable besides for initial piping into lanexnoteA
			lanexnoteA        : [],
			snapA             : snapA,
			audioFile         : audioFile,
			keyC              : keyC,
			score             : 0,
			stat              : [],});
		if (typeof this.audioFile === "undefined" || this.audioFile === null){ll("nope");return;}
		if (typeof this.noteA === "undefined" || this.noteA === null){ll("nope");return;}
		this.hitC     = noteA.filter(v=>typeof v.end === "undefined").length;
		this.holdC    = noteA.filter(v=>typeof v.end !== "undefined").length;
		this.scoreMax = (this.hitC*this.missBoundary) + (this.holdC*(this.missBoundary*2));
		
		// lanexnoteA
		this.lanexnoteA = this.noteA.map(v=>π.ooAbsorb(v,{started:false,ended:false})).distribute(v=>v.lane);
		for (var lane = 1; lane <= this.keyC; lane++){
			if (typeof this.lanexnoteA[lane] === "undefined"){
				this.lanexnoteA[lane] = [];}}
		
		// !!! snapA : [{head,value},...]
		this.snapA = this.snapA.filter(snap=>snap.value>0);
		
		// option data, intended to possibly be overwritten
		var pink      = rgbToHsl([255,  0,170].map(v=>v/255));
		var orange    = rgbToHsl([255,170,  0].map(v=>v/255));
		var purple    = rgbToHsl([170,  0,255].map(v=>v/255));
		var green     = rgbToHsl([170,255,  0].map(v=>v/255));
		var blue      = rgbToHsl([  0,170,255].map(v=>v/255));
		var turquoise = rgbToHsl([  0,255,170].map(v=>v/255));
		switch (this.keyC){default:noteCoA_RAW = [null];
			break;case  1:noteCoA_RAW = [null,pink                                                       ];
			break;case  2:noteCoA_RAW = [null,pink                                                  ,pink];
			break;case  3:noteCoA_RAW = [null,pink,orange                                           ,pink];
			break;case  4:noteCoA_RAW = [null,pink,orange                                    ,orange,pink];
			break;case  5:noteCoA_RAW = [null,pink,orange,green                              ,orange,pink];
			break;case  6:noteCoA_RAW = [null,pink,orange,green                        ,green,orange,pink];
			break;case  7:noteCoA_RAW = [null,pink,orange,green,blue                   ,green,orange,pink];
			break;case  8:noteCoA_RAW = [null,pink,orange,green,blue              ,blue,green,orange,pink];
			break;case  9:noteCoA_RAW = [null,pink,orange,green,blue,purple       ,blue,green,orange,pink];
			break;case 10:noteCoA_RAW = [null,pink,orange,green,blue,purple,purple,blue,green,orange,pink];}
		// fill in unspecified note colors
		for (var i = 1; i <= this.keyC.length; i++){if (typeof noteCoA_RAW[i] === "undefined"){noteCoA_RAW[i] = p.co;}}
		
		var {tx,co,bg} = p;
		var a  = bg[3];
		var hannanos = Array(this.keyC+1).fill(0); // used in javascript map function further down
		π.ooAbsorb(this,{
			introWaitTime      : 2000000       ,
			playbackRate       :       1       ,
			volume             :       0.5     ,
			laneDividerW       :       1       ,
			noteW              :      40       ,
			noteH              :      16       ,
			snapH              :       1       ,
			snapMultiplier     :       4       ,
			warningPreH        :       4       ,
			warningPostH       :       4       ,
			progressH          :      10       ,
			noteOffset         :       0       ,
			autoSyncF          : false,
			errorOffset        :       0       , // error from not being able to play the audio within 1ms of chart starting
			syncOffset         :       0       , // error from audio video desync
			speedMultiplier    :       0.00055 ,
			judgeLineRaise     :       0       ,
			noteShape          : "rectangle",
			laneDividerCo      : hslma(tx,bg,0.2),
			snapMajorCo        : hslma(tx,bg,0.8),
			snapMinorCo        : hslma(tx,bg,0.4),
			progressBgCo       : hsla (bg       ),
			progressPlayCo     : hslma(tx,bg,0.4),
			progressScoreCo    : hsla (tx   ,1  ),
			noteFadedCoA       : hannanos.map((v,i)=>(i===0)?null:hslma(noteCoA_RAW[i],bg,0.5 ,0.5)),
			noteCoA            : hannanos.map((v,i)=>(i===0)?null:hsla (noteCoA_RAW[i]            )),
			noteActiveCoA      : hannanos.map((v,i)=>(i===0)?null:hslma(noteCoA_RAW[i],tx,0.3     )),
			laneWarningPreCoA  : hannanos.map((v,i)=>(i===0)?null:hsla (bg                    ,a  )),
			laneWarningPostCoA : hannanos.map((v,i)=>(i===0)?null:hsla (bg                    ,a  )),
			laneCoA            : hannanos.map((v,i)=>(i===0)?null:hsla (bg                    ,a  )),
			laneActiveCoA      : hannanos.map((v,i)=>(i===0)?null:hslma(noteCoA_RAW[i],bg,0.2 ,a  )),
			hitboxCoA          : hannanos.map((v,i)=>(i===0)?null:hsla (noteCoA_RAW[i]        ,0.5)),
			hitboxActiveCoA    : hannanos.map((v,i)=>(i===0)?null:hslma(noteCoA_RAW[i],tx,0.3 ,1  )),
			//keyCodeA           : [null,[{k:65,s:0}],[{k:83,s:0}],[{k:68,s:0}],[{k:70,s:0}],[{k:71,s:0}],[{k:72,s:0}],[{k:74,s:0}],[{k:75,s:0}],[{k:76,s:0}],[{k:186,s:0}]], // home row left to right, starting with "a",
			//keyCodeSPA         : [null,[{k:81,s:0}],[{k:87,s:0}],[{k:69,s:0}],[{k:0,s:0}],[{k:0,s:0}],[{k:0,s:0}],[{k:0,s:0}],[{k:0,s:0}],[{k:0,s:0}]],
			keyO               : {},
		});
		π.ooAbsorb(this,this.optionO);
		for (var lane = 1; lane <= this.keyC; lane++){
			ll(lane);
			this.optionAssert({type:"key",m:{type:"key-lane "+lane,e:{which:-lane,location:-575}}});}
		this.initO = π.cc(this);
		
		// audio
		if (typeof this.audio !== "undefined"){
			this.audio.pause();
			this.audio.src = "";
			this.audio.load();}
		this.audio = new Audio(this.audioFile);
		this.audio.playbackRate = this.playbackRate;
		this.audio.defaultPlaybackRate = this.playbackRate;
		this.audio.addEventListener("ratechange",()=>{
			this.jump(this.audio.currentTime*1000000);});
		this.audio.volume = this.volume;
		this.audio.loop = false;
		this.audio.addEventListener("canplaythrough",event=>{
			ll("canplaythrough");
			//this.jump(0,this.audio.playbackRate);
			this.renderRegister("J");
			this.renderRegister("L");
			if (this.state === "waiting"){
				ll("set time");
				var now = p.now();
				this.anchorUpT   = this.anchorDownT = now + this.introWaitTime;
				this.anchorP     = -1*this.introWaitTime;
				this.state = "playing";}});
		this.audio.addEventListener("ended",event=>{
			this.endT = p.now();
			ll("ended");
			this.state = "waiting";});
		this.audio.load();
		
		this.sizeEverything();
		this.registerDriveA.forEach(fxn=>fxn());
		this.initF = true;};
	
	this.sizeEverything = ()=>{
		this.calcW();
		this.calcH();
		this.canvasContainer.style.width  = this.cachedW()+"px";
		this.canvasO.forEach(v=>{
			v.style.width  = (v.width  = this.cachedW()) + "px";
			v.style.height = (v.height = this.cachedH()) + "px";});};
	this.jumpRelative = (delta)=>{
		this.jump(this.currentP + delta);};
	this.jump = (location)=>{
		var now = p.now();
		this.audio.currentTime = location/1000000;
		this.anchorP           = Math.round(location);
		this.anchorUpT         = this.anchorDownT = now;
		this.currentP = ((now - this.anchorUpT) * this.audio.playbackRate) + this.anchorP;
		// break the intro
		if (this.introLatch === 0){
			this.introLatch = 1;
			this.audio.play();}
		this.score = 0;
		this.stat = [];
		this.resetNoteA();};
	
	// !!!
	this.calcNoteAhead = ()=>{
		return 0;
		var a,b;
		a = performance.now();
		b = this.audio.currentTime;
		return ((Math.trunc(a*1000 /*- ??? this.initialT*/))-(Math.trunc(b*1000000)));};
	this.drawFrame = (now)=>{//now *= 1000;//if (Math.random()<0.1){ll(this.state);}
		var now = p.now();
		var oldW = this.cachedW();this.calcW();
		var oldH = this.cachedH();this.calcH();
		if (this.cachedW() !== oldW || this.cachedH() !== oldH){
			this.sizeEverything();
			this.renderRegister("S");
			this.renderRegister("P");
			this.renderRegister("J");
			this.renderRegister("N");
			this.renderRegister("L");}
		// #statemachine
		switch (this.state){default:
		break;case "waiting":
			//this.renderRegister("J");
			//this.renderRegister("L");
		break;case "playing":
			if (this.pause_SIGNAL === 1){this.pause_SIGNAL = 0;
				this.anchorDownT = now;
				this.state = "paused";
				this.audio.pause();
				break;}
			this.currentP = ((now - this.anchorUpT) * this.audio.playbackRate) + this.anchorP;
			this.currentTAudio = this.audio.currentTime*1000000;
			if (this.introLatch === 0 && this.currentP >= 0){
				ll("go");
				this.audio.play();
				this.introLatch = 1;
				console.log("play error [I will adjust] : "+this.currentP+"µs");
				/*this.errorOffset = this.currentP;*/}
			if (this.autoSyncF && this.introLatch === 1){
				var noteAhead = this.calcNoteAhead();
				this.syncMovingAverage.push(noteAhead-this.syncOffset);
				if (Math.abs(this.syncMovingAverage.calc()) > 16000){
					this.syncOffset = noteAhead;
					ll(this.syncMovingAverage.calc());
					ll("set : "+noteAhead);}}
			this.renderRegister("P");
			this.renderRegister("N");
		break;case "paused":
			if (this.resume_SIGNAL === 1){this.resume_SIGNAL = 0;
				this.state = "playing";
				this.jump(this.currentP);
				this.audio.play();
				break;}
			this.renderRegister("P");
			this.renderRegister("N");
		}
		this.render();
	};
	this.width   = 0;
	this.height  = 0;
	this.cachedW = ()=>this.width;
	this.cachedH = ()=>this.height;
	this.calcW   = ()=>{
		if (typeof this.noteW === "undefined"){
			this.width = this.canvasContainer.clientWidth;}
		else{
			this.width = (this.keyC*this.noteW) + ((this.keyC+1)*this.laneDividerW);}
		return this.width;};
	this.calcH   = ()=>{
		this.height = this.canvasContainer.clientHeight;
		return this.height;};
	this.calcKeyStateA = function(){
		var res = [null];
		for (var lane = 1; lane <= this.keyC; lane++){
			res[lane] = 0;
			if (typeof this.keyO["lane "+lane] === "undefined"){continue;}
			for (var k of Object.keys(this.keyO["lane "+lane])){var keyCodeInnerA = this.keyO["lane "+lane][k];
				if (keyCodeInnerA.s === 1){
					res[lane] = 1;
					break;}}}
		return res;};
	this.calcScoreMaxSoFar = function(){
		return this.missBoundary*this.lanexnoteA.reduce(((p,noteA)=>p.concat(noteA)),[]).reduce(((p,note)=>p+(
			(this.currentP < this.timeAdjust(note.head))
				? 0 // future
				: (typeof note.tail === "undefined")
					? 1 // past-present hit
					: (this.currentP < this.timeAdjust(note.tail))
						? 1 // past-present hold half
						: 2 // past-present hold full
	)),0);};
	this.resetNoteA = function(                         ){this.lanexnoteA.forEach(noteA=>noteA.forEach(note=>{π.ooAbsorb(note,{started:false,ended:false});}));};
	this.placeHit   = function({lane=1,head=0       }={}){this.lanexnoteA[lane].push({lane,head     ,started:false,ended:false});this.noteASort(this.lanexnoteA[lane]);};
	this.placeHold  = function({lane=1,head=0,tail=0}={}){this.lanexnoteA[lane].push({lane,head,tail,started:false,ended:false});this.noteASort(this.lanexnoteA[lane]);};
	this.removeNote = function({lane=1,head=0       }={}){this.lanexnoteA[lane] = this.lanexnoteA[lane].filter(note=>!(note.lane === lane && this.timeAdjust(note.head) === head));};
	this.noteASort  = function(noteA){
		noteA.sort((a,b)=>{
			var h = a.head-b.head;
			return (h !== 0) ? h : a.tail-b.tail;});};
	this.timeToPixel = function(t){
		var h = this.cachedH();
		var precl_a = h+((this.currentP/*-this.noteOffset-this.errorOffset-this.syncOffset*/)*this.speedMultiplier)-this.progressH-this.noteH-Math.round((h-this.progressH-this.progressH-this.noteH)*this.judgeLineRaise/1000);
		return precl_a - t*this.speedMultiplier;};
	this.pixelToTime = function(p){
		if (this.speedMultiplier === 0){return -1;} // !!! needs better handling
		var h = this.cachedH();
		var precl_a = h+((this.currentP/*-this.noteOffset-this.errorOffset-this.syncOffset*/)*this.speedMultiplier)-this.progressH-this.noteH-Math.round((h-this.progressH-this.progressH-this.noteH)*this.judgeLineRaise/1000);
		return (precl_a - p)/this.speedMultiplier;};
	this.nearestSnapGroup = function(o={}){
		π.ooaw(o,{
			majorOnlyF : false,});
		if (this.snapMultiplier === 0){return {prev:null,curr:null,next:null};}
		var prev = null;
		var curr = null;
		var next = null;
		var breakNextF = false;
		var breakNextM = null;
		// draw bar lines
		var endBefore = Math.trunc(this.audio.duration*1000000);
		for (var iSnap = this.snapA.length-1; iSnap >= 0; iSnap--){var snap = this.snapA[iSnap];
			for (var t = endBefore-(endBefore%snap.value)+(this.timeAdjust(snap.head)%snap.value); t >= this.timeAdjust(snap.head); t-=snap.value){
				for (var i = (o.majorOnlyF?0:this.snapMultiplier-1); i >= 0; i--){
					var _ = t + i*(snap.value/this.snapMultiplier);
					if (_ >= endBefore){continue;}
					curr = _;
					// if we're exactly at the time, {prev,curr,next}
					if (curr === this.currentP){breakNextF = true;breakNextM = {prev:null,curr:curr,next:prev};}
					// if we're at that next time
					else if (breakNextF){π.ooa(breakNextM,{prev:curr});return breakNextM;}
					// if we're past the time, {prev,null,curr}
					else if (curr < this.currentP){return {prev:curr,curr:null,next:prev};}
					prev = curr;}}
			endBefore = this.timeAdjust(snap.head);}};
	this.nearestSnapUp        = function(){return this.nearestSnapGroup().next;};
	this.nearestSnapDown      = function(){return this.nearestSnapGroup().prev;};
	this.nearestSnapMajorUp   = function(){return this.nearestSnapGroup({majorOnlyF:T,}).next;};
	this.nearestSnapMajorDown = function(){return this.nearestSnapGroup({majorOnlyF:T,}).prev;};
	this.timeAdjust = function(n){return n+this.noteOffset+this.errorOffset+this.syncOffset;};
	
	this.renderRegister = (which)=>{
		this.renderRegisterA.pushUnique(which);};
	this.render = ()=>{
		var {tx,co,bg} = p;
		var a = bg[3];
		var w = this.cachedW();
		var h = this.cachedH();
		for (var which of this.renderRegisterA){
			var ctx = this.ctxO[which];
			switch (which){default:
			// [s] shield
			break;case "S":
			// [p] progress
			break;case "P":if (typeof this.audio === "undefined" || this.audio === null){break;}
				ctx.clearRect(0,0,w,h);
				var bgL = w;
				var playL = (this.audio.duration===0)?0:w*this.audio.currentTime/this.audio.duration;
				var scoreMaxSoFar = this.calcScoreMaxSoFar();
				var scoreL = (scoreMaxSoFar===0)?0:playL*this.score/scoreMaxSoFar;
				mangaka.drawRect(ctx,0,               0,bgL      ,this.progressH,this.progressBgCo   );
				mangaka.drawRect(ctx,0,h-this.progressH,bgL      ,h             ,this.progressBgCo   );
				mangaka.drawRect(ctx,0,               0,playL    ,this.progressH,this.progressPlayCo );
				mangaka.drawRect(ctx,0,h-this.progressH,playL    ,h             ,this.progressPlayCo );
				mangaka.drawRect(ctx,0,               0,scoreL   ,this.progressH,this.progressScoreCo);
				mangaka.drawRect(ctx,0,h-this.progressH,scoreL   ,h             ,this.progressScoreCo);
			// [j] judgement line, with key hitboxes
			break;case "J":
				ctx.clearRect(0,0,w,h);
				var keyStateA = this.calcKeyStateA();
				for (var lane = 1; lane <= this.keyC; lane++){
					x = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
					color = (keyStateA[lane]===1)?this.hitboxActiveCoA[lane]:this.hitboxCoA[lane];
					mangaka.drawRect(ctx,x,this.timeToPixel(this.currentP),this.noteW,this.noteH,color);}
			// [n] notes
			break;case "N":
				ctx.clearRect(0,0,w,h);
				if (!this.initF){return;}
				var tH = this.pixelToTime( -this.snapH);
				var tT = this.pixelToTime(h+this.snapH);
				if (this.speedMultiplier < 0){var _ = tH;tH = tT;tT = _;}
				// draw bar lines
				var endBefore = Math.trunc(this.audio.duration*1000000);
				for (var iSnap = this.snapA.length-1; iSnap >= 0; iSnap--){var snap = this.snapA[iSnap];
					for (var t = this.timeAdjust(snap.head); t < endBefore; t+=snap.value){
						if (t > tH || t < tT){continue;}
						for (var i = true; i; i = false){ // trivial for loop for the continue feature
							if (this.snapMultiplier !== 0){
								var y = this.timeToPixel(t);
								if (y < -this.snapH){continue;} // fail-fast for offscreen notes
								if (y > h+this.snapH){continue;} // fail-fast for offscreen notes
								mangaka.drawRect(ctx,0,y,this.width,this.snapH,this.snapMajorCo);}}}
					for (var t = this.timeAdjust(snap.head); t < endBefore; t+=snap.value){
						for (var i = 1; i < this.snapMultiplier; i++){
							var tt = t + i*(snap.value/this.snapMultiplier);
							if (tt >= endBefore){continue;} // brief bpm changes
							if (tt > tH || tt < tT){continue;}
							var y = this.timeToPixel(tt);
							if (y < -this.snapH){continue;} // fail-fast for offscreen notes
							if (y > h+this.snapH){continue;} // fail-fast for offscreen notes
							mangaka.drawRect(ctx,0,y,this.width,this.snapH,this.snapMinorCo);}}
					endBefore = this.timeAdjust(snap.head);}
				/*for (var y = (this.currentP%1000000)/10000; y < 10000; y+=100){
					mangaka.drawRect(ctx,0,y,this.width,1,this.laneDividerCo);}*/
				// draw them per lane, to optimize away color swaps in canvas
				// y is from the top origin, positive going down
				//if (ctx.lineW !== 4){ctx.lineW = 4;}
				var tH = this.pixelToTime( -this.noteH);
				var tT = this.pixelToTime(h+this.noteH);
				if (this.speedMultiplier < 0){var _ = tH;tH = tT;tT = _;}
				for (var lane = 1; lane <= this.keyC; lane++){
					//if (ctx.strokeStyle !== this.laneCoA[lane]){ctx.strokeStyle = this.laneCoA[lane];}
					var noteA = this.lanexnoteA[lane];
					var noteAC = noteA.length;
					// draw each note
					for (var iNote = 0; iNote < noteAC; iNote++){var note = noteA[iNote];
						if (this.timeAdjust(note.head) > tH && (typeof note.tail === "undefined" || this.timeAdjust(note.tail) > tH)){continue;}
						if (this.timeAdjust(note.head) < tT && (typeof note.tail === "undefined" || this.timeAdjust(note.tail) < tT)){continue;}
						var y = this.timeToPixel(this.timeAdjust(note.head));
						var yy = (typeof note.tail==="undefined")
							? null
							: this.timeToPixel(this.timeAdjust(note.tail));
						if ((y <  -this.noteH) && (yy === null || yy <  -this.noteH)){continue;} // fail-fast for offscreen notes
						if ((y > h+this.noteH) && (yy === null || yy > h+this.noteH)){continue;} // fail-fast for offscreen notes
						var l = lane;
						var x = ((l-1)*this.noteW)+(l*this.laneDividerW);
						var color = (note.started)
							? (!note.ended
								? (this.noteActiveCoA[l])
								: (this.noteFadedCoA[l]))
							: (this.noteCoA[l]);
						
						if (this.warningPreH >= 1){
							if (ctx.fillStyle !== this.laneWarningPreCoA[lane]){ctx.fillStyle = this.laneWarningPreCoA[lane];}
							ctx.beginPath();
							if (this.noteShape === "rectangle"){
								ctx.rect(x,y+this.noteH,this.noteW,this.warningPreH);}
							ctx.closePath();
							ctx.fill();}
						if (this.warningPostH >= 1){
							if (ctx.fillStyle !== this.laneWarningPostCoA[lane]){ctx.fillStyle = this.laneWarningPostCoA[lane];}
							ctx.beginPath();
							if (this.noteShape === "rectangle"){
								if (yy === null){
									ctx.rect(x,y-this.warningPreH,this.noteW,this.warningPostH);}
								else{
									ctx.rect(x,yy-this.warningPostH,this.noteW,this.warningPostH);}}
							ctx.closePath();
							ctx.fill();}
						if (ctx.fillStyle !== color){ctx.fillStyle = color;}
						ctx.beginPath();
						if (this.noteShape === "rectangle"){
							if (yy === null){
								ctx.rect(x,y,this.noteW,this.noteH);}
							else{
								ctx.rect(x,yy,this.noteW,y-yy+this.noteH);}}
						ctx.closePath();
						ctx.fill();
						}}
			// [l] lanes and lane dividers
			break;case "L":
				ctx.clearRect(0,0,w,h);
				var keyStateA = this.calcKeyStateA();
				// draw lane textures
				for (var lane = 1; lane <= this.keyC; lane++){
					x = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
					color = (keyStateA[lane] == 1)?this.laneActiveCoA[lane]:this.laneCoA[lane];
					mangaka.drawRect(ctx,x,this.progressH,this.noteW,h-this.progressH,color);}
				// draw lane dividers
				for (var l = 1; l <= this.keyC+1; l++){
					x = ((l-1)*this.noteW)+(l*this.laneDividerW)-this.laneDividerW;
					mangaka.drawRect(ctx,x,0,this.laneDividerW,h,this.laneDividerCo);}}}}
	this.renderRegisterA = [];
	this.sizeEverything();
	uniani.register("game"+this.processID,this);
};
</script>
