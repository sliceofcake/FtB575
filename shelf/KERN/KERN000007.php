<script id="KERN000007CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000007A,.KERN000007A *"                                :"box-sizing:border-box;",
		".KERN000007A::-moz-selection,.KERN000007A *::-moz-selection":"¥bgc:transparent;",
		".KERN000007A::selection,.KERN000007A *::selection"          :"¥bgc:transparent;",
		".KERN000007A"                                               :"¥:relative;¥s:1000‰;¥bgc:transparent;cursor:crosshair;",
		".KERN000007AA"                                              :"¥:absolute;¥h:1000‰;",
		".KERN000007AA,\
		 .KERN000007AB,\
		 .KERN000007AC,\
		 .KERN000007AD,\
		 .KERN000007AE,\
		 .KERN000007AF"                                              :"¥:absolute;¥:NW;¥s:1000‰;¥bgc:transparent;",};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000007"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000007A").forEach(el=>{el.KERN.refresh();});});
var KERN000007 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000007",
			o : {
				tx       : [0,0,1  ],
				co       : [0,1,0.5],
				bg       : [0,0,0  ,1],
				elO      : {},
				ctxO     : {},
				pxd      : 2,
				w        : 0,
				h        : 0,
				whMin    : 0,
				hHandW   : 6,hHandH :  500,
				mHandW   : 4,mHandH :  900,
				sHandW   : 2,sHandH : 1000,
				hHandCo  : [0,1,0.5],
				hHandCoS : hsla([0,1,0.5],0.5),
				mHandCo  : [0,1,0.5],
				mHandCoS : hsla([0,1,0.5],0.5),
				sHandCo  : [0,1,0.5],
				sHandCoS : hsla([0,1,0.5],0.5),
				timezoneOffset : 0,
				handTransformMultiplier : 1,
				counter : 0,
				pixelsPerFrame : 0.5, // the maximum number of pixels we can transition each frame without it looking skippy
				// utilities
				partToAngle : function(n){return (-(n)*(2*Math.PI))+(Math.PI*0.5);},
				preclSecondHandFPS : function(){var _ = this;
					_.secondHandFPS = (Math.PI*(_.whMin/2)/30)/_.pixelsPerFrame;},
				preclSize : function(){var _ = this;
					_.elO.d.width  = _.w*_.pxd;_.elO.d.style.width  = _.w+"px";
					_.elO.d.height = _.h*_.pxd;_.elO.d.style.height = _.h+"px";
					_.elO.e.width  = _.w*_.pxd;_.elO.e.style.width  = _.w+"px";
					_.elO.e.height = _.h*_.pxd;_.elO.e.style.height = _.h+"px";
					_.elO.f.width  = _.w*_.pxd;_.elO.f.style.width  = _.w+"px";
					_.elO.f.height = _.h*_.pxd;_.elO.f.style.height = _.h+"px";},
			},
			validateFxnO : {},
			stabilize_SUB : function(){var _ = this.o;
				if (this.if("hHandCo")){_.hHandCoS = hsla(_.hHandCo,_.hHandCo[3]);}
				if (this.if("mHandCo")){_.mHandCoS = hsla(_.mHandCo,_.mHandCo[3]);}
				if (this.if("sHandCo")){_.sHandCoS = hsla(_.sHandCo,_.sHandCo[3]);}
				if (this.if("pxd")){_.preclSize();_.preclSecondHandFPS();}},
			setup_SUB : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000007A"+this.base,{z:{KERN:this}},[
						[".KERN000007AA"+this.base], // back panel, image
						[".KERN000007AB"+this.base], // back panel filter
						["canvas.KERN000007AD"+this.base], // display hours
						["canvas.KERN000007AE"+this.base], // display minutes
						["canvas.KERN000007AF"+this.base], // display seconds
						[".KERN000007AC"+this.base], // total filter
					]]
				]]));
				_.elO.root = µ.qd(".KERN000007A"+this.base);
				_.elO.a    = µ.qd(_.elO.root,".KERN000007AA"+this.base);
				_.elO.b    = µ.qd(_.elO.root,".KERN000007AB"+this.base);
				_.elO.c    = µ.qd(_.elO.root,".KERN000007AC"+this.base);
				_.elO.d    = µ.qd(_.elO.root,".KERN000007AD"+this.base);
				_.elO.e    = µ.qd(_.elO.root,".KERN000007AE"+this.base);
				_.elO.f    = µ.qd(_.elO.root,".KERN000007AF"+this.base);
				_.ctxO.d   = _.elO.d.getContext("2d");
				_.ctxO.e   = _.elO.e.getContext("2d");
				_.ctxO.f   = _.elO.f.getContext("2d");
				_.timezoneOffset = (new Date()).getTimezoneOffset();
				_.counter = 0;},
			refreshResize_SUB   : function(){var _ = this.o;
				_.w = _.elO.root.offsetWidth;
				_.h = _.elO.root.offsetHeight;
				_.whMin = Math.min(_.w,_.h);
				_.handTransformMultiplier = (_.whMin/2)/1000;
				_.preclSize();
				_.preclSecondHandFPS();
				_.counter = 0;},
			refresh_SUB   : function(){var _ = this.o;
				_.counter = 0;},
			drawFrame_SUB : function(){var _ = this.o;
				var center = {x:_.w*0.5,y:_.h*0.5};
				var totalSec = (π.now()/1000000)-_.timezoneOffset*60;
				var s = totalSec%60;
				var m = (totalSec%3600)/60;
				var h = (totalSec%86400)/3600;
				var sAngle = _.partToAngle(s/60);
				var mAngle = _.partToAngle(m/60);
				var hAngle = _.partToAngle(h/24);
				var mod = Math.floor(      (Ω.fps/_.secondHandFPS));if (mod === 0){mod = 1;}if (_.counter%mod===0){anipnt.clearRect(_.ctxO.f,0,0,_.w,_.h,_.pxd);anipnt.drawRay(_.ctxO.f,center.x,center.y,sAngle,_.sHandH*_.handTransformMultiplier,_.sHandW,_.sHandCoS,_.pxd);}
				var mod = Math.floor(60*   (Ω.fps/_.secondHandFPS));if (mod === 0){mod = 1;}if (_.counter%mod===0){anipnt.clearRect(_.ctxO.e,0,0,_.w,_.h,_.pxd);anipnt.drawRay(_.ctxO.e,center.x,center.y,mAngle,_.mHandH*_.handTransformMultiplier,_.mHandW,_.mHandCoS,_.pxd);}
				var mod = Math.floor(60*60*(Ω.fps/_.secondHandFPS));if (mod === 0){mod = 1;}if (_.counter%mod===0){anipnt.clearRect(_.ctxO.d,0,0,_.w,_.h,_.pxd);anipnt.drawRay(_.ctxO.d,center.x,center.y,hAngle,_.hHandH*_.handTransformMultiplier,_.hHandW,_.hHandCoS,_.pxd);}
				_.counter++;if (_.counter >= 3600){_.counter = 0;}},
		});
		oo.portInP .pushA([["pxd",KERNTypeO.number],["hHandW",KERNTypeO.number],["mHandW",KERNTypeO.number],["sHandW",KERNTypeO.number],["hHandH",KERNTypeO.number],["mHandH",KERNTypeO.number],["sHandH",KERNTypeO.number],["sHandCo",KERNTypeO.complex],["mHandCo",KERNTypeO.complex],["hHandCo",KERNTypeO.complex]]);
		oo.portOutP.pushA([]);
		return oo;},
	};
</script>
