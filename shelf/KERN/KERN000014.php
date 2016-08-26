<script id="KERN000014CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000014A,.KERN000014A *"                                :"box-sizing:border-box;",
		".KERN000014A::-moz-selection,.KERN000014A :not(.KERN000014AA)::-moz-selection":"¥bgc:transparent;",
		".KERN000014A::selection,.KERN000014A :not(.KERN000014AA)::selection"          :"¥bgc:transparent;",
		".KERN000014A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000014AA"                                              :"¥:absolute;¥:NW;¥s:1000‰;¥bgc:transparent;overflow-x:auto;",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000014"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000014A").forEach(el=>{el.KERN.refresh();});});
var KERN000014 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000014",
			o : {
				tx    : [0,0,1  ],
				co    : [0,1,0.5],
				bg    : [0,0,0  ,1],
				elO   : {},
				ctxO  : {},
				wO    : {},
				hO    : {},
				fs    : 20,
				ff    : "Verdana",
				noteInstantStatA : [],
				score            : 0,
				scoreMax         : 0,
				scorePart        : 0,
				hitC             : 0,
				holdC            : 0,
				passedHeadC      : 0,
				passedTailC      : 0,
				earnedHeadC      : 0,
				earnedTailC      : 0,
				pxd              : 2,
				counter          : 0, // frame counter
				missBoundary     : 125000,
				txt              : "",
				txt_FREEZE       : "", // performance-friendly txt change comparison, without checking innerHTML
				scoreResetSignal : N,
				interfaceNeedsRefreshF : F,
				// utilities
				errorToScore : function(errorN,boundaryN){return (errorN>boundaryN)?0:Math.cos(Math.PI*errorN/(2*boundaryN))*boundaryN;},
				preclSize : function(){var _ = this;
					_.elO.aa.width  = _.wO.aa*_.pxd;_.elO.aa.style.width  = _.wO.aa+"px";
					_.elO.aa.height = _.hO.aa*_.pxd;_.elO.aa.style.height = _.hO.aa+"px";
					// these are here because when you change canvas width/height, everything resets, apparently
					_.ctxO.aa.textBaseline = "top";
					_.ctxO.aa.font = _.fs+"px "+_.ff;
					_.ctxO.aa.textAlign = "right";},
			},
			validateFxnO : {},
			// the kludge is real, this stabilize() section is very order-dependent. study it well
			stabilize_SUB   : function(){var _ = this.o;
				_.txt_FREEZE = _.txt;
				if (this.if("passedHeadC","passedTailC","earnedHeadC","earnedTailC")){
					var totalC = (_.passedHeadC+_.passedTailC);
					var missC = totalC - (_.earnedHeadC+_.earnedTailC);if (missC < 0){missC = 0;} // technical note, you can reach out to hit notes early that you have not yet "passed", but this kludge partially gets around that inconvenience
					_.scorePart = (totalC === 0 ? 0 : (totalC-missC)/totalC);
					_.interfaceNeedsRefreshF = T;}
//				if (this.if("noteInstantStatA")){
//					_.noteInstantStatA.forEach(stat=>{
//						// stat example : {whichEnd:"head",note:{...},t:1000000,timeUntilExact:15893,missBoundary:125000}
//						_.score += _.errorToScore(stat.timeUntilExact,stat.missBoundary);
//						_.interfaceNeedsRefreshF = T;});}
				
				// intentionally happens after score adding, squishy design decision, but, for now, a reset signal will take highest precedence
				if (this.if("scoreResetSignal")){
					_.score = 0;
					_.scoreMax = 0;
					_.scorePart = 0;
					_.passedHeadC = 0;
					_.passedTailC = 0;
					_.earnedHeadC = 0;
					_.earnedTailC = 0;
					_.interfaceNeedsRefreshF = T;}
				if (this.if("pxd")){_.preclSize();}
			},
			setup_SUB : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000014A"+this.base,{z:{KERN:this}},[
						["canvas.KERN000014AA"+this.base],]]
				]]));
				_.elO.a  = µ.qd(".KERN000014A" +this.base);
				_.elO.aa = µ.qd(".KERN000014AA"+this.base);
				_.ctxO.aa = _.elO.aa.getContext("2d");},
			refreshResize_SUB : function(){var _ = this.o;
				_.wO.aa = _.elO.a.offsetWidth;
				_.hO.aa = _.elO.a.offsetHeight;
				_.preclSize();
				_.counter = 0;},
			refresh_SUB : function(){var _ = this.o;
				if (this.if("tx")){
					µ.ma(document.head,µ.m({type:"style",d:{"data-unique":this.base},css:{
						[".KERN000014AA"+this.base] : "¥c:"+hsla(_.tx)+";",
					}}));}},
			drawFrame_SUB : function(){var _ = this.o;
				if (_.counter++ % Math.ceil(Ω.fps/10) === 0){ // 10 fps target
					if (_.interfaceNeedsRefreshF){
						anipnt.clearRect(_.ctxO.aa,0,0,_.wO.aa,_.hO.aa,_.pxd);
						anipnt.fillText(_.ctxO.aa,str(Math.floor(_.scorePart*1000))+"‰",_.wO.aa,0,hsla(_.co),_.pxd);}
					_.interfaceNeedsRefreshF = F;}
			},
		});
		oo.portInP .pushA([
			["pxd",KERNTypeO.number],
			["noteInstantStatA",KERNTypeO.complex],
			["hitC",KERNTypeO.number],
			["holdC",KERNTypeO.number],
			["passedHeadC",KERNTypeO.number],
			["passedTailC",KERNTypeO.number],
			["scoreResetSignal",KERNTypeO.flag],
			["earnedHeadC",KERNTypeO.number],
			["earnedTailC",KERNTypeO.number],
		]);
		oo.portOutP.pushA([["pxd",KERNTypeO.number],]);
		return oo;},
	};
</script>
