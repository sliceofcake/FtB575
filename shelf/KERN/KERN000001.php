<script id="KERN000001CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var tickW       = 1; // code duplication
	var nonBarH     = 0.7; // percent
	var nonBarHalfH = nonBarH*0.5; // percent
	var tickH       = 0.4; // percent
	var tickMajorH  = 0.8; // percent
	var css = {
		"@font-face" : "font-family:Visitor2;src:url(../shelf/font/visitor2.ttf);",
		".KERN000001A,\
		 .KERN000001A *" : "box-sizing:border-box;",
		".KERN000001A,\
		 .KERN000001A *::-moz-selection" : "background-color:transparent;",
		".KERN000001A,\
		 .KERN000001A *::selection" : "background-color:transparent;",
		".KERN000001A"    : "¥:block;¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000001AA"   : "¥:block;¥:absolute;¥:NW;¥w:950‰;¥h:1000‰;¥m:0px 25‰;",
		".KERN000001AAA"  : "¥:block;¥:absolute;¥:NW;¥:full-width;¥h:"+(1000*nonBarHalfH)+"‰;",
		".KERN000001AAAA" : "¥:block;¥:absolute;¥:S;¥w:"+tickW+"px;¥h:"+(1000*tickH)+"‰;",
		".KERN000001AAAB" : "¥:block;¥:absolute;¥:S;¥w:"+tickW+"px;¥h:0%;",
		".KERN000001AAAC" : "¥:block;¥:absolute;¥b:450‰;text-align:center;",
		".KERN000001AAB"  : "¥:block;¥:absolute;¥:W;¥t:calc("+(1000*nonBarHalfH)+"‰ + "+(tickW*1)+"px);¥h:calc(100% - "+(1000*nonBarH)+"‰ - "+((tickW*1)*2)+"px);",
		".KERN000001AAC"  : "¥:block;¥:absolute;¥:SW;¥:full-width;¥h:"+(1000*nonBarHalfH)+"‰;",
		".KERN000001AACA" : "¥:block;¥:absolute;¥:N;¥w:"+tickW+"px;¥h:"+(1000*tickH)+"‰;",
		".KERN000001AACB" : "¥:block;¥:absolute;¥:N;¥w:"+tickW+"px;¥h:"+(1000*tickMajorH)+"‰;",
		".KERN000001AACC" : "¥:block;¥:absolute;¥t:calc(50% - "+(1000*nonBarHalfH)+"%);text-align:center;",
		".KERN000001AAD"  : "¥:block;¥:absolute;¥t:"+(1000*(nonBarHalfH*(1-tickMajorH)))+"‰;¥w:"+tickW+"px;¥h:"+(1000*(1-(2*(nonBarHalfH*(1-tickMajorH)))))+"‰;",
		".KERN000001AAE"  : "¥:block;¥:absolute;¥:W;¥t:calc("+(100*nonBarHalfH)+"% + "+(tickW*1)+"px);¥w:1000‰;¥h:calc(100% - "+(1000*nonBarH)+"‰ - "+((tickW*1)*2)+"px);text-align:center;white-space:nowrap;",
		".KERN000001AAF"  : "¥:block;¥:absolute;¥:W;¥t:calc("+(100*nonBarHalfH)+"% + "+(tickW*1)+"px);¥w:1000‰;¥h:calc(100% - "+(1000*nonBarH)+"‰ - "+((tickW*1)*2)+"px);",
		};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000001"},css:css}));
});
window.addEventListener("resize",()=>{
	KERN000001.refresh();
});
var KERN000001 = π.ooa(KERN("KERN000001"),{
	name : "KERN000001",
	genMarkA : function(o={}){
		π.ooaw(o,{
			A1 : [],
			A2 : [],
			A3 : [],
			mode : "literal"});
		var a = o.A1.map((v,i)=>({left:i,value:o.A1[i],display:o.A2[i],majorFlag:o.A3[i]}));
		switch (o.mode){default:
		break;case "literal":return a;
		break;case "equalMajor":
			// write the fractional increments for majorFlag ticks
			var counter = 0;
			a.forEach((v,i,a)=>{
				counter++;
				if (v.majorFlag){
					v._ = 1/counter;
					counter = 0;}});
			// back-fill the increments
			var _ = a[a.length-1]._;
			for (var i = a.length-1; i >= 0; i--){
				if (a[i].majorFlag){
					_ = a[i]._;}
				a[i]._ = _;}
			// calculate the absolute lefts
			var left = 0;
			a.forEach((v,i,a)=>{
				left = v.left = left+v._;
				delete v._;});
			return a;}},
	gen : function(o={}){
		π.ooaw(o,{
			tx       : [0,0,1],
			co       : [0,0,0.5],
			bg       : [0,0,0,1],
			title    : "",
			markA    : [],
			callback : ()=>{},});
		π.ooaw(o,{
			center   : o.markA[0].value,
			initial  : o.markA[0].value,});
		
		o.markA.forEach(mark=>{
			if (typeof mark.display === "undefined"){mark.display = mark.value;}
			mark.left = π.chop(mark.left,3);});
		var _ = o.markA.find(v=>v.value===o.initial);
		var initialLeft = (typeof _ === "undefined") ? o.markA[0].left : _.left;
		var tickW = 1; // code duplication
		var min = o.markA.map(v=>v.left).reduce((p,v)=>Math.min(p,v));
		var max = o.markA.map(v=>v.left).reduce((p,v)=>Math.max(p,v));
		o.markA.forEach(mark=>{mark.leftCSS = π.chop((mark.left-min)/(max-min),3);});
		initialLeftCSS = (initialLeft-min)/(max-min);
		
		var refresh = function(o={}){
			π.ooa(this.KERN,o);
			var A   = this;
			var AA  = µ.qd(this,".KERN000001AA" );
			var AAB = µ.qd(AA  ,".KERN000001AAB");
			var AAD = µ.qd(AA  ,".KERN000001AAD");
			var AAE = µ.qd(AA  ,".KERN000001AAE");
			var AAF = µ.qd(AA  ,".KERN000001AAF");
			var {tx,co,bg} = this.KERN;
			var a = bg[3];
			var tickLoC      = hslma(tx,bg,0.6);
			var tickHiC      = hslma(co,bg,0.6);
			var tickMajorLoC = hslma(tx,tx,0.6);
			var tickMajorHiC = hslma(co,tx,0.6);
			var markLoC      = hslma(tx,tx,0.6);
			var markHiC      = hslma(co,tx,0.6);
			var titleC       = hsla(tx);
			var barBgC       = hslma(bg,tx,0.85,a);
			var barC         = hsla(co);
			var needleC      = hsla(co);
			AAD.style.backgroundColor = needleC;
			AAE.style.color = titleC;
			AAF.style.backgroundColor = barBgC;
			AAE.style.fontSize   = (this.clientHeight*0.3)+"px";
			µ.qdA(this,".KERN000001AAAC").forEach(vv=>{
				vv.style.fontSize   = (this.clientHeight*0.4)+"px";
				vv.style.marginLeft = (vv.clientWidth*-1/2)+"px";});
			
			var closestRow = this.KERN.markA.reduce((p,v)=>(Math.abs(this.KERN.l-v.leftCSS)<Math.abs(this.KERN.l-p.leftCSS))?v:p);
			var centerRow = this.KERN.markA.find(v=>v.value===this.KERN.center);
			var lPoint = Math.min(closestRow.leftCSS,centerRow.leftCSS);
			var rPoint = Math.max(closestRow.leftCSS,centerRow.leftCSS);
			//AAB.style.backgroundColor = barC;
			AAB.style.background = "linear-gradient("+(closestRow.leftCSS>centerRow.leftCSS?"-":"")+"90deg,"+barC+","+barBgC+")";
			AAD.style.left  = (100*closestRow.leftCSS)+"%";
			AAB.style.left  = (100*lPoint)+"%";
			AAB.style.width = (100*(rPoint-lPoint))+"%";
			var AAAA = µ.qdA(this,".KERN000001AAAA");
			var AAAB = µ.qdA(this,".KERN000001AAAB");
			var AAAC = µ.qdA(this,".KERN000001AAAC");
			var AACA = µ.qdA(this,".KERN000001AACA");
			var AACB = µ.qdA(this,".KERN000001AACB");
			AAAC             .forEach(v=>{var _ = num(v.style.left);v.style.color           = (100*lPoint<=_ && _<=100*rPoint)?markHiC:markLoC     });
			AAAA.concat(AACA).forEach(v=>{var _ = num(v.style.left);v.style.backgroundColor = (100*lPoint<=_ && _<=100*rPoint)?tickHiC:tickLoC     });
			AAAB.concat(AACB).forEach(v=>{var _ = num(v.style.left);v.style.backgroundColor = (100*lPoint<=_ && _<=100*rPoint)?tickMajorHiC:tickMajorLoC});
			if (closestRow.value !== this.KERN.value || (typeof this.value === "undefined" || this.value === "")){
				this.value = this.KERN.value = closestRow.value;
				A.KERN.l = closestRow.leftCSS;
				A.KERN.value = closestRow.value;
				A.KERN.drive.call(A);}};
		var drive = function(o={}){
			π.ooaw(o,{
				strong : false});
			var drive = {value:this.KERN.value,};
			if (o.strong || !π.ooe(drive,this.KERN.drive_PREV)){
				this.KERN.callback(drive);
				this.KERN.drive_PREV = {value:this.KERN.value,};}};
		var flow = function(o={}){
			var A   = this;
			var AA  = µ.qd(A,".KERN000001AA");
			var closestRow = this.KERN.markA.find(v=>v.value===o.value);
			if (typeof closestRow === "undefined"){return;}
			A.KERN.refresh.call(A,{l:closestRow.leftCSS});
			A.KERN.drive.call(A);};
		var valueUp = function(){
			var i = this.markA.findIndex(mark=>mark.value===this.value);
			return (i===this.markA-1) ? this.markA[i].value : this.markA[i+1].value;};
		var valueDown = function(){
			var i = this.markA.findIndex(mark=>mark.value===this.value);
			return (i===0) ? this.markA[i].value : this.markA[i-1].value;};
		var _ = function(e){
			e.preventDefault();
			var A   = this;
			var AA  = µ.qd(A,".KERN000001AA");
			if (e.type === "mousedown" || Ω.mousedownF){
				A.KERN.refresh.call(A,{l:(e.pageX - µ.offsetLeftTotal(AA))/AA.clientWidth,});
				A.KERN.drive.call(A);}};
		return {d:{class:"KERN000001A"},z:{KERN:π.ooa(o,{refresh,drive,flow,l:initialLeftCSS,drive_PREV:null,valueUp,valueDown,}),},listenerO:{mousedown:_,mousemove:_,},childA:[
			[".KERN000001AA",[
				[".KERN000001AAF"],
				[".KERN000001AAA",
					o.markA.mapM(mark=>(mark.majorFlag)
						? [[".KERN000001AAAB[style='¥l:"+(1000*mark.leftCSS)+"‰;']"],[".KERN000001AAAC[style='¥l:"+(1000*mark.leftCSS)+"‰;¥h:660‰;']",mark.display],]
						: [[".KERN000001AAAA[style='¥l:"+(1000*mark.leftCSS)+"‰;']"],])],
				[".KERN000001AAB"],
				[".KERN000001AAC",
					o.markA.mapM(mark=>(mark.majorFlag)
						? [[".KERN000001AACB[style='¥l:"+(1000*mark.leftCSS)+"‰;']"],]
						: [[".KERN000001AACA[style='¥l:"+(1000*mark.leftCSS)+"‰;']"],])],
				[".KERN000001AAD"],
				[".KERN000001AAE",o.title],]],]};},
});
</script>
