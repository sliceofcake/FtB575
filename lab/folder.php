<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>Image Viewer</title>
<style>
* {box-sizing:border-box;}
html {width:100%;height:100%;}
body {
	width:100%;height:100%;margin:0px;padding:0px;
	font-family:Verdana,Geneva,sans-serif;font-size:16px;
	overflow:hidden;}
.main {width:100%;height:100%;}
.main>.row {
	position:fixed;width:5000%;
	transform:translateX(0px);transition-property:transform;animation-timing-function:ease-in-out;
	overflow:visible;white-space:nowrap;}
.main>.row.row-no-animation {transition-property:none !important;}
.main>.row>.img {
	position:relative;opacity:1;
	background-repeat:no-repeat;background-size:cover;background-origin:content-box;background-position:center center;/*background-attachment:fixed;*/
	transition-property:opacity;animation-timing-function:ease-in-out;}
.main>.row>.img>.path {
	display:none;position:absolute;bottom:0px;left:0px;width:100%;overflow:hidden;}
.main>.intro {
	display:flex;height:100%;align-items:center;justify-content:center;
	opacity:0.85;font-weight:bold;font-size:120%;}

.bottomish {
	position:fixed;left:0px;width:100%;
	overflow:auto;}
.bottomish>* {display:inline-block;vertical-align:middle;}

.bottom {
	position:fixed;bottom:0px;left:0px;width:100%;}
.bottom>* {display:inline-block;vertical-align:middle;}
.bottom>.status-light {
	display:inline-block;border-radius:50%;}
.bottom>.reminder {opacity:0.5;}
.bottom>.path {}
</style>
<script>
//======================================================================================================================
// !!! TODO LIST
// • N/A
// ----
// • memory leaks with image blobs never being released in Chrome
//======================================================================================================================
var ll = (...m)=>{m.forEach(v=>console.log(v));};
var dbg = (...m)=>{var el = document.querySelector("#debug");if (el === null){return;}el.innerHTML = "";m.forEach(v=>{el.innerHTML += v.toString();});};
var π = {
	randCounter : 0,
	// random integer, doubly inclusive bounds
	rand:function(low,high){
		// note : for controlled random numbers for debugging, this is a good set in general
		//var a = [1,1,1,1,1,2,2,2,2,2];
		//return a[this.randCounter++%a.length];
		return Math.floor(Math.random()*((high+1)-low)+low);},
	// object <-- object ; property absorb
	ooAbsorb:function(o,oo,opt={}){
		if (typeof opt.blockDuplicate === "undefined"){opt.blockDuplicate = false;}
		for (var k of Object.keys(oo)){var v = oo[k];
			if (!opt.blockDuplicate || typeof o[k] === "undefined"){
				o[k] = v;}}
		return o;},
	// make an array, like a for loop
	a : function(h=0,t=h,fxn=(v=>v+1)){
		var res = [];
		for (var i = h; i <= t; i = fxn(i)){
			res.push(i);}
		return res;},
};
Array.prototype.forEach = function(fxn){
	var length = this.length;
	for (var i = 0; i < length; i++){
		fxn(this[i],i,this);}};
Array.prototype.map = function(fxn){
	var res = new Array(this.length);
	var length = this.length;
	for (var i = 0; i < length; i++){
		res[i] = fxn(this[i],i,this);}
	return res;};
Array.prototype.mapO = function(fxn){ // fxn returns {key:value} instead of just value as in the traditional map
	return this.map(fxn).reduce((p,v)=>π.ooAbsorb(p,v),{});};
Array.prototype.reduce = function(fxn,accumulator){
	var length = this.length;
	for (var i = 0; i < length; i++){
		if (i === 0 && typeof accumulator === "undefined"){accumulator = this[i];continue;}
		accumulator = fxn(accumulator,this[i],i,this);}
	return accumulator;};
Array.prototype.findRandom = function(fxn){
	var thisC = this.length;
	if (thisC === 0){return undefined;}
	return this[Math.floor(Math.random()*thisC)];};
Array.prototype.findIndexRandom = function(fxn){
	var thisC = this.length;
	if (thisC === 0){return -1;}
	return Math.floor(Math.random()*thisC);};
Object.prototype.mapK = function(fxn){return Object.keys  (this.map(fxn));};
Object.prototype.mapV = function(fxn){return Object.values(this.map(fxn));};
Object.prototype.mapO = function(fxn){ // fxn returns {key:value} instead of just value as in the traditional map
	return this.mapV(fxn).reduce((p,v)=>π.ooAbsorb(p,v),{});};
Object.prototype.map = function(fxn){
	var o = {};
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		o[k] = fxn(this[k],k,this);}
	return o;};
Object.prototype.reduce = function(fxn,initial){
	if (typeof initial !== "undefined"){accumulator = initial;}
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (typeof accumulator === "undefined"){accumulator = this[k];continue;}
		accumulator = fxn(accumulator,this[k],k,this);}
	return accumulator;};
Object.prototype.filterK = function(fxn){return Object.keys  (this.filter(fxn));};
Object.prototype.filterV = function(fxn){return Object.values(this.filter(fxn));};
Object.prototype.filter = function(fxn){
	var o = {};
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (fxn(this[k],k,this)){
			o[k] = this[k];}}
	return o;};
// by JS spec, object iteration is by arbitrary order
Object.prototype.forEach = function(fxn){
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		fxn(this[k],k,this);}};
Object.prototype.findRandom = function(fxn){
	var keyA = Object.keys(this);
	var keyAC = keyA.length;
	if (keyAC === 0){return undefined;}
	return this[keyA[Math.floor(Math.random()*keyAC)]];};
Object.prototype.findIndexRandom = function(fxn){
	var keyA = Object.keys(this);
	var keyAC = keyA.length;
	if (keyAC === 0){return -1;}
	return keyA[Math.floor(Math.random()*keyAC)];};
var selectFxn = function(v,elSelect){
	v = v.toString();
	var optionE = elSelect.options;
	for (var option, i = 0; option = optionE[i]; i++){
		if (option.value === v){
			elSelect.selectedIndex = i;
			break;}}};










//======================================================================================================================
// p
//----------------------------------------------------------------------------------------------------------------------
// Handles the specifics of this page/service, the sliding image viewer.
//======================================================================================================================
var p = {
	// user configuration variables
	rowC                : 3,//5,
	blockMaxC           : 7,
	borderN             : 4,
	co_bg               : "black",
	unitMax             : 2, // for math reasons, the possible width units need to be 1 to this, without gaps
	tickMajorDeltaT     : 2000000,//100000,
	transitionOutDeltaT : 1500000,//0,
	
	// the corresponding dimension of a 1-unit image, not including any borders
	widthUnit  : 0, // filled in update()
	heightUnit : 0, // filled in update()
	widthBlockToPx  : function(n,rawF=false){var _ = n*(this.widthUnit +(2*this.borderN));return rawF?_:Math.round(_);}, // includes borders
	heightBlockToPx : function(n,rawF=false){var _ = n*(this.heightUnit+(2*this.borderN));return rawF?_:Math.round(_);}, // includes borders
	
	liveF           : false,
	rowCurr         : 0, // the current row, since we handle one row at a time
	rowxblockInUseC : {},
	timeoutO        : {main:null},
	bottomH         : 20,
	bottomishH      : 60,
	spacebarLock    : false, // used to produce a single keydown event
	reminderLo      : "Press Spacebar to Play and Hide Options [available only if images are currently loaded]",
	reminderHi      : "Press Spacebar to Pause and Show Options",
	
	// utilities
	calcWidth  : function(){return window.innerWidth -this.borderN-this.borderN;},
	calcHeight : function(){return window.innerHeight-this.bottomH-this.borderN-this.borderN;},
	imgPush : function(fileE){
		var elRow = this.calcRowCurrEl();
		elRow.classList.remove("row-no-animation"); // freeShift() disables animations, and this is the emergency point where we NEED animations enabled
		var el = document.createElement("div");
		el.classList.add("img");
		el.classList.add("w"+fileE.widthBlock);
		el.classList.add("h1");
		el.sliceofcake = {fileE};
		el.style.backgroundImage = "url("+fileE.hash+")";
		el.addEventListener("mouseenter",(function(that){return function(){
			that.calcBottomPathEl().textContent = this.sliceofcake.fileE.path;};})(this));
		el.addEventListener("mouseleave",(function(that){return function(){
			that.calcBottomPathEl().textContent = "";};})(this));
		
		var elPath = document.createElement("div");
		elPath.classList.add("path");
		elPath.textContent = fileE.pathEnd;
		el.appendChild(elPath);
		
		elRow.appendChild(el);
		this.changeBlockInUseC(fileE.widthBlock);
		return fileE;},
	imgPop  : function(){
		var elRow = this.calcRowCurrEl();
		var elImg = this.calcOldestVisibleEl();
		var fileE = elImg.sliceofcake.fileE;
		// note : the transitionend event is generally unreliable
		// we wait 1.5x the animation time because the animation may be delayed a little, making it take slightly longer than 1x, but generally, it should never acceptably take longer than 2x
		clearTimeout(elRow.sliceofcake.freeShiftTimeout);elRow.sliceofcake.freeShiftTimeout = setTimeout((function(that,rowCurr,fileE){return function(){
			elImg.style.backgroundImage = "none";
			fileE.destroy();
			that.freeShift(rowCurr);
		};})(this,this.rowCurr,fileE),1.5*this.transitionOutDeltaT/1000);
		elRow.sliceofcake.translateX += (this.rowCurr%2===0?-1:1)*(this.widthBlockToPx(fileE.widthBlock,true));
		elRow.style.transform = "translateX("+Math.round(elRow.sliceofcake.translateX)+"px)";
		elImg.style.opacity = "0";
		this.changeBlockInUseC(-fileE.widthBlock);
		return true;}, // configure it to return meta-data on the fileE if you want, but I don't need that feature right now
	
	calcBottomPathEl : function(){return document.querySelector(":root>body>.bottom>.path");},
	calcRowCurrEl : function(rowCurr){
		if (typeof rowCurr === "undefined"){
			return document.querySelector(".row[data-row='"+this.rowCurr.toString()+"']");}
		else{
			return document.querySelector(".row[data-row='"+rowCurr.toString()+"']");}},
	changeBlockInUseC : function(n,rowCurr){
		if (typeof rowCurr === "undefined"){
			this.rowxblockInUseC[this.rowCurr] += n;}
		else{
			this.rowxblockInUseC[rowCurr] += n;}},
	calcBlockInUseC : function(rowCurr){
		if (typeof rowCurr === "undefined"){
			return this.rowxblockInUseC[this.rowCurr];}
		else{
			return this.rowxblockInUseC[rowCurr];}},
	calcOldestVisibleElI : function(rowCurr){
		var elRow = this.calcRowCurrEl(rowCurr);
		var blockInUseC = this.calcBlockInUseC(rowCurr);
		var elI;
		for (elI = elRow.children.length-1; elI >= 0; elI--){var el = elRow.children[elI];
			blockInUseC -= el.sliceofcake.fileE.widthBlock;
			if (blockInUseC <= 0){break;}}
		return elI;},
	calcOldestVisibleEl : function(rowCurr){
		var elRow = this.calcRowCurrEl(rowCurr);
		return elRow.children[this.calcOldestVisibleElI()];},
	
	play : function(){
		// fail-fast wait-loop : no images to serve
		if (mem.fileEA_current.length < mem.bufferImgC){
			mem.fillBuffer();
			clearTimeout(this.timeoutO.main);this.timeoutO.main = setTimeout(()=>{this.play();},100);
			return;}
		ll("******* "+mem.fileEA_current.length);
		this.floodNewSet(true);
		document.querySelector(".status-light").style.backgroundColor = "hsla(120,100%,40%,1)";
		document.querySelector(".bottomish").style.display = "none";
		document.querySelector(".reminder").innerHTML = p.reminderHi;
		var elL = document.querySelectorAll(".path");for (var elLI = 0; elLI < elL.length; elLI++){var el = elL[elLI];el.style.display = "none";}
		this.calcBottomPathEl().style.display = "none";
		this.liveF = true;
		// if we run tickMajor() immediately, it'll get logically grouped with floodNewSet(), so the first animation won't be observable
		setTimeout(()=>{this.tickMajor();},100);},
	pause : function(){
		document.querySelector(".status-light").style.backgroundColor = "hsla(0,100%,40%,1)";
		document.querySelector(".bottomish").style.display = "block";
		document.querySelector(".reminder").innerHTML = p.reminderLo;
		var elL = document.querySelectorAll(".path");for (var elLI = 0; elLI < elL.length; elLI++){var el = elL[elLI];el.style.display = "block";}
		this.calcBottomPathEl().style.display = "block";
		this.liveF = false;},
	toggle : function(){
		if (this.liveF){
			p.pause();}
		else{
			p.play();}},
	
	// destructively set up the amount of rows we need, blank, and immediately fill them in
	floodNewSet : function(nondestructiveF=false){ll("floodNewSet("+nondestructiveF+")");
		var rowCurr_FREEZE = this.rowCurr;
		this.rowCurr = 0;
		if (!nondestructiveF){
			document.querySelector(".main").innerHTML = "";}
		do{
			// ensure rows exist
			var elRow = this.calcRowCurrEl();
			if (elRow === null){
				this.rowxblockInUseC[this.rowCurr] = 0;
				var elRow = document.createElement("div");
				elRow.classList.add("row");
				elRow.classList.add("row"+this.rowCurr);
				elRow.setAttribute("data-row",this.rowCurr.toString());
				elRow.sliceofcake = {translateX:0};
				document.querySelector(".main").appendChild(elRow);
				ll("this.rowCurr : "+this.rowCurr);
				if (mem.fileEA_current.length >= 1){this.shiftFill();}} // initial push
			this.rowAdvance();}while (this.rowCurr !== 0);
		this.rowCurr = rowCurr_FREEZE;},
	
	
	// unordered
	// (A) when spatial changes occur, evict all images and bring in an entirely new set
	// (B) when nonspatial changes occur (bg color change), just change style
	update : function(o={}){ll("update("+JSON.stringify(o)+")");
		if (typeof o.spatialF    === "undefined"){o.spatialF    = false;}
		if (typeof o.nonspatialF === "undefined"){o.nonspatialF = false;}
		
		if (o.spatialF){
			this.rowxblockInUseC = {};
			this.floodNewSet();
			this.rowCurr = 0;
			this.widthUnit  = (window.innerWidth -(2*this.borderN))/this.blockMaxC - (2*this.borderN);
			this.heightUnit = (window.innerHeight-this.bottomH-(2*this.borderN))/this.rowC      - (2*this.borderN);
			mem.bufferImgC = this.blockMaxC*this.rowC*2; // two-times the total displayable images in reserve
			// re-calculate ratios
			mem.fileEA_current.forEach(fileE=>{mem.preclRatio(fileE);});}
		
		if (o.spatialF || o.nonspatialF){
			var el = document.head.querySelector("style[data-type='dynamic']");
			if (el === null){
				el = document.createElement("style");
				el.setAttribute("data-type","dynamic");
				document.head.appendChild(el);}
			switch (this.co_bg){default:;
				break;case "black":var co_tx = "white";
				break;case "white":var co_tx = "black";}
			if (this.co_bg){}
			el.textContent
			="body{border:"+this.borderN+"px solid "+this.co_bg+";color:"+co_tx+";background-color:"+this.co_bg+";}"
			+".row,.img{transition-duration:"+(this.transitionOutDeltaT/1000000)+"s;}"
			+".img{border:"+this.borderN+"px solid "+this.co_bg+";}"
			+".main>.row>.img>.path{background-color:hsla(0,0%,"+(this.co_bg==="white"?100:0)+"%,0.65);font-size:"+(this.bottomH*0.5)+"px;}"
			
			+".bottomish{height:"+this.bottomishH+"px;bottom:"+this.bottomH+"px;background-color:hsla(0,0%,"+(this.co_bg==="white"?100:0)+"%,0.65);}"
			+".bottom{height:"+this.bottomH+"px;}"
			+".bottom>.status-light{width:"+(this.bottomH/2)+"px;height:"+(this.bottomH/2)+"px;margin:"+(this.bottomH/4)+"px;}"
			+".bottom>.reminder{height:"+this.bottomH+"px;font-size:"+(this.bottomH*0.75)+"px;}"
			+".bottom>.path{position:absolute;bottom:0px;right:0px;height:"+this.bottomH+"px;font-size:"+(this.bottomH*0.75)+"px;}"
			+".bottomish>select,.bottomish>button{height:"+(this.bottomishH/2)+"px;margin:"+(this.bottomishH/4)+"px 0px 0px 0px;}"
			
			+π.a(0,this.rowC-1 ).map(n   =>".row"+n+"{top:"+(this.borderN+(n*(this.calcHeight()/this.rowC)))+"px;"+(n%2===0?"left":"right")+":"+this.borderN+"px;}").join("")
			+π.a(0,this.rowC-1 ).map(n   =>".row"+n+">.img{float:"+(n%2===0?"left":"right")+";}").join("")
			+π.a(1,this.unitMax).map(unit=>".w"+unit+"{width:" +this.widthBlockToPx (unit,true)+"px;}").join("")
			+π.a(1,           1).map(unit=>".h"+unit+"{height:"+this.heightBlockToPx(unit)+"px;}").join("");}},
	tickMajor : function(){ll("tickMajor() w/this.rowCurr : "+this.rowCurr);
		if (!this.liveF){return;}
		this.shiftFill();
		this.rowAdvance();
		clearTimeout(this.timeoutO.main);this.timeoutO.main = setTimeout(()=>{this.tickMajor();},this.tickMajorDeltaT/1000);},
	// increment this.rowCurr, and wrap it around to 0 when it goes out of bound high
	rowAdvance : function(){this.rowCurr = (this.rowCurr+1) % this.rowC;},
	// shift in new image[s] and shift out old image[s]
	shiftFill : function(){
		// generate an image out of bounds to shift in
		this.imgPush(mem.getRandFileE(π.rand(1,this.unitMax),1));
		// in order for this to be brought in, we need to clear that many x-blocks, or more [to not cut an old image in half, throw out enough to get it complete offscreen]
		while (this.calcBlockInUseC() > this.blockMaxC){
			p.imgPop();}
		// if that didn't go evenly, we'll have leftover blocks to fill now [field with 4 blocks, want to move in a 3-block, we shifted everything out and now there's 1 extra block to fill]
		while (this.calcBlockInUseC() < this.blockMaxC){
			this.imgPush(mem.getRandFileE(Math.min(this.unitMax,(this.blockMaxC-this.calcBlockInUseC())),1));}},
	// nothing changes visually, but old offscreen parts are clipped off for long-running performance reasons
	freeShift : function(rowCurr){ll("freeShift() v");
		// freeShift() only needs to happen occasionally to prevent high thousands of pixels of shift buildup
		// generally speaking, it's an unnecessary performance hit to run it after every animation
		// unless--! we're going to run out of room, then force the freeShift()
		// hardcoded CSS at 50x screen width, cut out margin to 48x screen width
		if (π.rand(0,99)!==0 && !(Math.abs(this.calcRowCurrEl().sliceofcake.translateX) >= window.innerWidth*48)){return;}
		ll("freeShift() ^");
		// freeShift: (doesn't need to be implemented in the short term for testing, only for long-term running reasons)
		// • disable CSS transform animations for the row (re-enabled by whatever later process needs animations enabled, at that time)
		// • remove the old offscreen images
		// • shift to 0px
		var elRow = this.calcRowCurrEl(rowCurr);
		if (elRow !== null){
			elRow.classList.add("row-no-animation");
			elRow.sliceofcake.translateX = 0;
			elRow.style.transform = "translateX(0px)";
			while (this.calcOldestVisibleElI(rowCurr) > 0){ // stop when (_ === 0 || _ === -1)
				elRow.removeChild(elRow.children[0]);}}},
};










//======================================================================================================================
// mem
//----------------------------------------------------------------------------------------------------------------------
// Handles files and memory management.
// Your responsibilities, as the user of this interface:
// • Set mem.bufferImgC to the number of images you want to have in your buffer. It's recommended to have, at the very
//   least, this be your number of rows, so that each row has at least one image ready to bring in
// • Call mem.getRandFileE(widthBlockRecommendation) to get a fileE to add to one of your rows.
// • When you're done with a fileE, call fileE.destroy(), which will do some cleanup for itself.
//======================================================================================================================
var mem = {
	bufferImgC : 0,
	fileEA_possible : [],
	fileEA_current  : [],
	pendingImgC : 0,
	destroy : function(){
		URL.revokeObjectURL(this.hash);
		this.hash = "";
		this.image.src = "";
		dbg("destroy()");},
	preclRatio : function(fileE){
		var unit_best = null;
		var closenessToPerfect_best = null;
		for (var unit = 1; unit <= p.unitMax; unit++){
			var whRatio = (fileE.image.width/fileE.image.height);
			var whRatio_desired = p.widthBlockToPx(unit)/p.heightBlockToPx(1);
			var closenessToPerfect = whRatio/whRatio_desired;if (closenessToPerfect < 1){closenessToPerfect = 1/closenessToPerfect;}
			if (closenessToPerfect_best === null || closenessToPerfect < closenessToPerfect_best){
				closenessToPerfect_best = closenessToPerfect;
				unit_best = unit;}}
		fileE.widthBlock_recommended = unit_best;},
	// if we have an image to return from our current set, return it and remove it from our current set [now it's all theirs]
	// if we don't have any images to serve, return null
	getRandFileE : function(widthBlockRecommendation=1){var heightBlockRecommendation = 1;
		// !!! update to not repeat images already shown
		if (this.fileEA_current.length === 0){return null;}
		// try our best to find an image with appropriate dimensions
		// find a random fileE matching the recommended dimension ratio
		// but if there aren't any, randomly choose any
		var fileEO_current = this.fileEA_current.mapO((fileE,fileEI)=>({[fileEI]:fileE}));
		var fileEO_recommended = fileEO_current.filter(fileE=>fileE.widthBlock_recommended === widthBlockRecommendation);
		var fileEAI_current = fileEO_recommended.findIndexRandom(); // yes, this line is correct, fileEO and fileEA match indices by design
		// if no images with desired properties, switch to any random image
		if (fileEAI_current === -1){
			ll("fell back to random image, sorry!");
			fileEAI_current = this.fileEA_current.findIndexRandom();}
		var fileE_current = this.fileEA_current[fileEAI_current];
		this.fileEA_current.splice(fileEAI_current,1)[0]; // remove it from our control to hand to the caller
		fileE_current.widthBlock  = widthBlockRecommendation ;
		fileE_current.heightBlock = heightBlockRecommendation;
		fileE_current.destroy = this.destroy;
		setTimeout((function(that){return function(){that.fillBuffer();};})(this),0);
		return fileE_current;},
	//----
	// internal
	//----
	// make a few attempts to get a non-redundant image, but after a while, just give up and go with whatever image is available
	fillBuffer : function(){//dbg(this.fileEA_current.length+"/"+this.bufferImgC);
		if (this.fileEA_possible.length === 0){return;}
		var toLoadC = this.bufferImgC-this.fileEA_current.length-this.pendingImgC;
		for (var i = 0; i < toLoadC; i++){
			var fileE_possible;
			var fileEAI_possible;
			var attemptCounter = 0;
			while (attemptCounter < 10){
				fileEAI_possible = π.rand(0,this.fileEA_possible.length-1);
				fileE_possible = this.fileEA_possible[fileEAI_possible];
				if (this.fileEA_current.includes(fileE_possible)){continue;}
				else{break;}}
			this.loadFile(fileE_possible);}},
	// pass it a fileE from the complete set [meta-only]
	// duplicates fileE and returns a buffed-up version
	loadFile : function(fileE_possible){
		this.pendingImgC++;
		var fileE_current = {file:fileE_possible.file,path:fileE_possible.path,pathEnd:fileE_possible.pathEnd,hash:URL.createObjectURL(fileE_possible.file),image:(new Image())}
		fileE_current.image.addEventListener("load",(function(that,fileE_current){return function(){
			fileE_current.width  = this.width ;
			fileE_current.height = this.height;
			that.preclRatio(fileE_current);
			that.fileEA_current.push(fileE_current);
			that.pendingImgC--;};})(this,fileE_current));
		// load the image
		fileE_current.image.src = fileE_current.hash;},
	
	// !!! don't have a formal proof that what I did here will always correctly detect the end of the async processes
	scanFolderPendingC : 0,
	scanFilePendingC   : 0,
	// we may be done scanning at this point, test that possibility
	scanEndpointFxn : function(){
		if (this.scanFolderPendingC === 0 && this.scanFilePendingC === 0){
			ll("-----------------------------------------------------------------");
			mem.fillBuffer();
			p.play();}},
	scan : function(item,path,root){
		path = (path.length===0?(item.name):(path+"/"+item.name));
		// folder
		if (item.isDirectory){
			var reader = item.createReader();
			ll("opening(step1/1) folder : "+path);this.scanFolderPendingC++;
			reader.readEntries(entryA=>{this.scanHelper1(this,entryA,reader,item,path,root,false);});}
		// single file
		else if (item.isFile){
			ll("opening(step1/2) file : "+path);this.scanFilePendingC++;
			root.getFile(item.fullPath,{},fileEntry=>{
				ll("opening(step2/2) file : "+path);
				fileEntry.file(file=>{
					// fail-fast-ish : not image
					if (["image/jpeg","image/png","image/gif"].includes(file.type)){
						var e = {file,path,pathEnd:item.name};
						mem.fileEA_possible.push(e);}
					ll("opened file : "+path);this.scanFilePendingC--;this.scanEndpointFxn();
					});});}
		// this case ~can~ occur
		else{
			ll("found unknown : "+path);}},
	scanHelper1 : (that,entryA,reader,item,path,root,continuationF)=>{
		ll("opened folder"+(continuationF?" as continutation":" ")+" : "+path);that.scanFolderPendingC--;
		if (entryA.length === 0){that.scanEndpointFxn();return;}
		entryA.forEach(entry=>{
			that.scan(entry,path,root);});
		ll("opening(step1/1) folder as continuation : "+path);that.scanFolderPendingC++;
		reader.readEntries(entryA=>{that.scanHelper1(that,entryA,reader,item,path,root,true);});
		},
};










// https://developer.mozilla.org/en-US/docs/Web/API/FileSystemDirectoryEntry/getFile
document.addEventListener("DOMContentLoaded",()=>{
	for (var pair of [["rowC",parseInt],["blockMaxC",parseInt],["borderN",parseInt],["unitMax",parseInt],["tickMajorDeltaT",parseInt],["transitionOutDeltaT",parseInt],["co_bg",m=>m]]){
		var optionS = pair[0];
		var filterFxn = pair[1];
		var el = document.querySelector("select.option-"+optionS);
		el.addEventListener("change",(function(optionS,filterFxn){return function(){
			p[optionS]=filterFxn(this.options[this.selectedIndex].value);
			var spatialF,nonspatialF;
			switch (optionS){default            :spatialF = true ;nonspatialF = true ;
				break;case "rowC"               :spatialF = true ;nonspatialF = false;
				break;case "blockMaxC"          :spatialF = true ;nonspatialF = false;
				break;case "borderN"            :spatialF = true ;nonspatialF = false;
				break;case "unitMax"            :spatialF = true ;nonspatialF = false;
				break;case "tickMajorDeltaT"    :spatialF = false;nonspatialF = true ;
				break;case "transitionOutDeltaT":spatialF = false;nonspatialF = true ;
				break;case "co_bg"              :spatialF = false;nonspatialF = true ;}
			p.update({spatialF,nonspatialF});};})(optionS,filterFxn));
		selectFxn(p[optionS],el);}
	p.update({spatialF:true,nonspatialF:true});window.addEventListener("resize",function(){p.update({spatialF:true});}); // !!! update after a few milliseconds to prevent gatling gun firing
	document.querySelector(".main").innerHTML = "";
	var elIntro = document.createElement("div");
	elIntro.classList.add("intro");
	elIntro.innerHTML
	="Drag and Drop a folder containing images here.<br>"
	+"Nested folders of images are okay!<br>"
	+"Non-image files will be safely ignored.<br>";
	document.querySelector(".main").appendChild(elIntro);
	
	var elDropzone = document.querySelector(".main");
	elDropzone.addEventListener("dragover",event=>{event.preventDefault();},false); // magic to cancel browser intercepting the drop
	elDropzone.addEventListener("drop",event=>{
		event.preventDefault();
		ll("drag&drop start");
		ll("-----------------------------------------------------------------");
		mem.fileEA_possible = [];
		var itemL = event.dataTransfer.items;
		if (typeof itemL === "undefined"){
			alert("Your web browser is currently not supported. Sorry! Google Chrome is okay, though! If you don't use Chrome, you'll probably have to wait several months for your browser to support this service.\n\nSpecifically what went wrong was event.dataTransfer.items evaluates to undefined, so we're stuck and can't load in your folder.");
			return;}
		for (var itemLI = 0; itemLI < itemL.length; itemLI++){
			var item = itemL[itemLI].webkitGetAsEntry();
			if (item !== null){
				mem.scan(item,"",item);}}
	},false);
	
	window.addEventListener("keydown",function(e){
		switch (e.which){default:;
			// spacebar
			break;case 32:if (!p.spacebarLock){p.spacebarLock = true;p.toggle();}}});
	window.addEventListener("keyup",function(e){
		switch (e.which){default:;
			// spacebar
			break;case 32:if (p.spacebarLock){p.spacebarLock = false;}}});
	window.addEventListener("focus",function(){;});
	window.addEventListener("blur" ,function(){;});
	document.addEventListener("visibilitychange",function(){
		if (document.visibilityState !== "visible"){
			p.pause();
		}
	});
	p.pause();
});
</script>
<body>
<div class="main"></div>
<div class="bottom">
	<div class="status-light"></div>
	<div class="reminder"></div>
	<div class="path"></div>
</div>
<div class="bottomish">
	<select class="option-rowC">
		<option value="1">1 Row</option>
		<option value="2">2 Rows</option>
		<option value="3">3 Rows</option>
		<option value="4">4 Rows</option>
		<option value="5">5 Rows</option>
		<option value="6">6 Rows</option>
	</select>
	<select class="option-blockMaxC">
		<option value= "1">1-Unit Row Width</option>
		<option value= "2">2-Unit Row Width</option>
		<option value= "3">3-Unit Row Width</option>
		<option value= "4">4-Unit Row Width</option>
		<option value= "5">5-Unit Row Width</option>
		<option value= "6">6-Unit Row Width</option>
		<option value= "7">7-Unit Row Width</option>
		<option value= "8">8-Unit Row Width</option>
		<option value= "9">9-Unit Row Width</option>
		<option value="10">10-Unit Row Width</option>
		<option value="11">11-Unit Row Width</option>
		<option value="12">12-Unit Row Width</option>
	</select>
	<select class="option-borderN">
		<option value="0">0-Pixel Gaps</option>
		<option value="1">2-Pixel Gaps</option>
		<option value="2">4-Pixel Gaps</option>
		<option value="3">6-Pixel Gaps</option>
		<option value="4">8-Pixel Gaps</option>
		<option value="5">10-Pixel Gaps</option>
		<option value="6">12-Pixel Gaps</option>
	</select>
	<select class="option-unitMax">
		<option value="1">1-Unit Width Max</option>
		<option value="2">2-Unit Width Max</option>
		<option value="3">3-Unit Width Max</option>
	</select>
	<select class="option-tickMajorDeltaT">
		<option value=  "250000">0.25 Seconds Between Changes</option>
		<option value=  "500000">0.50 Seconds Between Changes</option>
		<option value=  "750000">0.75 Seconds Between Changes</option>
		<option value= "1000000">1.00 Seconds Between Changes</option>
		<option value= "1250000">1.25 Seconds Between Changes</option>
		<option value= "1500000">1.50 Seconds Between Changes</option>
		<option value= "1750000">1.75 Seconds Between Changes</option>
		<option value= "2000000">2.00 Seconds Between Changes</option>
		<option value= "3000000">3.00 Seconds Between Changes</option>
		<option value= "4000000">4.00 Seconds Between Changes</option>
		<option value= "5000000">5.00 Seconds Between Changes</option>
		<option value= "6000000">6.00 Seconds Between Changes</option>
		<option value= "7000000">7.00 Seconds Between Changes</option>
		<option value= "8000000">8.00 Seconds Between Changes</option>
		<option value= "9000000">9.00 Seconds Between Changes</option>
		<option value="10000000">10.00 Seconds Between Changes</option>
	</select>
	<select class="option-transitionOutDeltaT">
		<option value=      "0">No Animations</option>
		<option value= "250000">0.25-Second Long Animations</option>
		<option value= "500000">0.50-Second Long Animations</option>
		<option value= "750000">0.75-Second Long Animations</option>
		<option value="1000000">1.00-Second Long Animations</option>
		<option value="1250000">1.25-Second Long Animations</option>
		<option value="1500000">1.50-Second Long Animations</option>
		<option value="1750000">1.75-Second Long Animations</option>
		<option value="2000000">2.00-Second Long Animations</option>
	</select>
	<select class="option-co_bg">
		<option value="black">Black Background</option>
		<option value="white">White Background</option>
	</select>
	<button onclick="p.floodNewSet();">Bring In New Image Set</button>
	<div id="debug" style="display:none;">debug output here</div>
</div>
</body></html>
