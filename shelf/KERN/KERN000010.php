<script id="KERN000010CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000010A,.KERN000010A *"                                :"box-sizing:border-box;",
		".KERN000010A::-moz-selection,.KERN000010A *::-moz-selection":"¥bgc:transparent;",
		".KERN000010A::selection,.KERN000010A *::selection"          :"¥bgc:transparent;",
		".KERN000010A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000010AA"                                              :"¥w:1000‰;¥h:600‰;",
		".KERN000010AAA"                                             :"¥:inline-block;",
		".KERN000010AAB"                                             :"¥:inline-block;",
		".KERN000010AAC"                                             :"¥:inline-block;",
		".KERN000010AAD"                                             :"¥:inline-block;",
		".KERN000010AB"                                              :"¥w:1000‰;¥h:400‰;",
		".KERN000010ABA"                                             :"¥s:1000‰;",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000010"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000010A").forEach(el=>{el.KERN.refresh();});});
var KERN000010 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000010",
			o : {
				tx     : [0,0,1  ],
				co     : [0,1,0.5],
				bg     : [0,0,0  ,1],
				aDim   : 0.4,
				elO    : {},
				ctxO   : {},
				wO     : {},
				hO     : {},
				audio  : N,
				fil    : N,
				state  : "lo", // does not necessarily reflect the actual state of the media - this is the intended state of the media
				t      : 0,
				playbackRate : 1,
				volume : 0.575,
				loopF  : F,
				progressBarGradient : "transparent",
				pxd     : 1,
				counter : 0,
				pixelsPerFrame : 2, // the maximum number of pixels we can transition each frame without it looking skippy
				progressBarFPS : 0, // filled later
				assertLightStateF : F, // whether the state of the interface lights needs to be [re]asserted
				// how much the audio has to become de-synced before it will correct
				// asking the audio to play, and asking where the audio playhead is currently located, both are unreliable operations
				// additionally, seeking frequently may cause static-y noise and be less favorable than merely allowing the audio to be slightly de-synced for a relatively brief period
				leeway : 100000, // 1000000µs/60fps = 16333µs/f, but HTML5 audio handler is unreliable in giving accurate time
				temporarySkippedF : F, // used to show when audio skips, in the interface
				// utilities
				skipCorrection:function(){var _ = this;
					if (_.audio !== N){
						var skipF = F;
						var t = _.t/1000000;
						// before the start
						if      (t < 0                  ){
							_.audio.pause();
							_.audio.currentTime = 0;}
						// after the end
						else if (t > _.audio.duration){
							_.audio.pause();
							_.audio.currentTime = _.audio.duration;}
						// within, doubly inclusive
						else                             {
							// attempt to assert the intended state to the actual media state
							switch (_.state){default : ;
								break;case "lo" : if (!_.audio.paused){_.audio.pause();}
								break;case "hi" : if ( _.audio.paused){_.audio.play();}}
							if (Math.abs(_.audio.currentTime-t) > _.leeway/1000000){skipF = T;}}
						// if detected unacceptably large drift
						if (skipF){
							_.assertLightStateF = T;
							_.temporarySkippedF = T;
							_.audio.currentTime = t;}}},
				preclGradient : function(){var _ = this;
					_.progressBarGradient = _.ctxO.aba.createLinearGradient(0,0,_.wO.aba,0);
					_.progressBarGradient.addColorStop(0,hslma(_.co,_.bg,0.7));
					_.progressBarGradient.addColorStop(1,hsla(_.co));},
				preclProgressBarFPS : function(){var _ = this;
					_.progressBarFPS = (Math.PI*(_.wO.aba/2)/30)/_.pixelsPerFrame;},
				preclSize : function(){var _ = this;
					_.elO.aba.width  = _.wO.aba*_.pxd;_.elO.aba.style.width  = _.wO.aba+"px";
					_.elO.aba.height = _.hO.aba*_.pxd;_.elO.aba.style.height = _.hO.aba+"px";},
			},
			validateFxnO : {
				state : function(_,base,access){if (!["lo","hi"].includes(_.state)){_.state = "lo";}},
			},
			stabilize_SUB : function(){var _ = this.o;
				if (this.if("fil")){
					if (_.audio !== N){
						_.audio.pause();
						_.audio.src = "";
						_.audio.load();}
					if (_.fil !== N){
						_.audio = new Audio(URL.createObjectURL(_.fil));
						_.audio.addEventListener("canplaythrough",e=>{});
						_.audio.addEventListener("ratechange",e=>{});
						_.audio.addEventListener("ended",e=>{});
						_.audio.load();}
					else{
						_.audio = N;}}
				if (this.if("state")){
					_.assertLightStateF = T;
					_.skipCorrection();
					if (_.audio !== N && _.state === "lo"){
						_.temporarySkippedF = T;
						_.audio.currentTime = _.t/1000000;}}
				if (this.if("t","leeway")){
					_.skipCorrection();}
				if (this.if("playbackRate","fil")){
					if (_.audio !== N){
						_.audio.playbackRate = _.playbackRate;
						_.audio.defaultPlaybackRate = _.playbackRate;}}
				if (this.if("volume","fil")){
					if (_.audio !== N){
						_.audio.volume = _.volume;}}
				if (this.if("loopF","fil")){
					if (_.audio !== N){
						_.audio.loop = _.loopF;}}
				if (typeof _.wO.aba !== "undefined" && this.if("co","bg")){
					_.preclGradient();}
				if (this.if("pxd")){_.preclSize();_.preclProgressBarFPS();}
			},
			setup_SUB : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000010A"+this.base,{z:{KERN:this}},[
						[".KERN000010AA"+this.base,[
							[".KERN000010AAA"+this.base,"✕"],
							[".KERN000010AAB"+this.base,"△"],
							[".KERN000010AAC"+this.base,"◯"],
							[".KERN000010AAD"+this.base,"seeked"],
						]],
						[".KERN000010AB"+this.base,[
							["canvas.KERN000010ABA"+this.base],
						]],
					]]
				]]));
				_.elO.aa   = µ.qd(".KERN000010AA" +this.base);
				_.elO.aaa  = µ.qd(".KERN000010AAA"+this.base);
				_.elO.aab  = µ.qd(".KERN000010AAB"+this.base);
				_.elO.aac  = µ.qd(".KERN000010AAC"+this.base);
				_.elO.aad  = µ.qd(".KERN000010AAD"+this.base);
				_.elO.ab   = µ.qd(".KERN000010AB" +this.base);
				_.elO.aba  = µ.qd(".KERN000010ABA"+this.base);
				_.ctxO.aba = _.elO.aba.getContext("2d");
				_.counter = 0;},
			refreshResize_SUB : function(){var _ = this.o;
				_.wO.aba = _.elO.ab.offsetWidth;
				_.hO.aba = _.elO.ab.offsetHeight;
				_.preclSize();
				_.preclGradient();
				_.preclProgressBarFPS();
				_.counter = 0;},
			refresh_SUB   : function(o={}){var _ = this.o;
				if (this.if("tx","co","bg","aDim")){
					µ.ma(document.head,µ.m({type:"style",d:{"data-unique":this.base},css:{
						[".KERN000010AA" +this.base] : "¥c:"+hsla(_.co)+";",
						[".KERN000010AAA"+this.base] : "¥c:"+hsla(_.co)+";¥op:"+str(_.aDim)+";",
						[".KERN000010AAB"+this.base] : "¥c:"+hsla(_.co)+";¥op:"+str(_.aDim)+";",
						[".KERN000010AAC"+this.base] : "¥c:"+hsla(_.co)+";¥op:"+str(_.aDim)+";",
						[".KERN000010AAD"+this.base] : "¥c:"+hsla(_.co)+";¥op:"+str(_.aDim)+";",
					}}));}
				_.counter = 0;},
			drawFrame_SUB : function(){var _ = this.o;
				_.skipCorrection();
				if (_.assertLightStateF){
					var tri = π.tri(_.state);
					_.elO.aaa.style.opacity = tri===-1           ?"1":str(_.aDim);
					_.elO.aab.style.opacity = tri=== 0           ?"1":str(_.aDim);
					_.elO.aac.style.opacity = tri=== 1           ?"1":str(_.aDim);
					_.elO.aad.style.opacity = _.temporarySkippedF?"1":str(_.aDim);}
				var mod = Math.floor((Ω.fps/_.progressBarFPS));if (mod === 0){mod = 1;}
				if (_.counter%mod===0){
					var part = (_.audio===N?0:(_.audio.currentTime/_.audio.duration));
					if (part !== 0){
						anipnt.clearRect(_.ctxO.aba,0,0,_.wO.aba,_.hO.aba,_.pxd);
						anipnt.drawRect(_.ctxO.aba,0,0,part*_.wO.aba,_.hO.aba,_.progressBarGradient,_.pxd);}}
				_.assertLightStateF = F;
				_.temporarySkippedF = F;
				_.counter++;if (_.counter >= 3600){_.counter = 0;}},
		});
		oo.portInP .pushA([["pxd",KERNTypeO.number],["fil",KERNTypeO.complexReference],["t",KERNTypeO.number],["state",KERNTypeO.string],["playbackRate",KERNTypeO.number],["volume",KERNTypeO.number],["loopF",KERNTypeO.flag],["leeway",KERNTypeO.number],["aDim",KERNTypeO.number]]);
		oo.portOutP.pushA([["pxd",KERNTypeO.number],["fil",KERNTypeO.complexReference],["t",KERNTypeO.number],["state",KERNTypeO.string],["playbackRate",KERNTypeO.number],["volume",KERNTypeO.number],["loopF",KERNTypeO.flag],["leeway",KERNTypeO.number],["aDim",KERNTypeO.number]]);
		return oo;},
	};
</script>
