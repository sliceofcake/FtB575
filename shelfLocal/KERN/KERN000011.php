<script id="KERN000011CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000011A,.KERN000011A *"                                :"box-sizing:border-box;",
		".KERN000011A::-moz-selection,.KERN000011A *::-moz-selection":"¥bgc:transparent;",
		".KERN000011A::selection,.KERN000011A *::selection"          :"¥bgc:transparent;",
		".KERN000011A"                                               :"¥:relative;¥s:1000‰;",
		".KERN000011AA"                                              :"¥:block;¥w:1000‰;¥h:600‰;",
		".KERN000011AAA"                                             :"",
		".KERN000011AB"                                              :"¥:block;¥w:1000‰;¥h:400‰;",
		".KERN000011ABA"                                             :"",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000011"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000011A").forEach(el=>{el.KERN.refresh();});});
var KERN000011 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000011",
			o : {
				tx       : [0,0,1  ],
				co       : [0,1,0.5],
				bg       : [0,0,0  ,1],
				which    : -1,
				location : -1,
				english  : "",
				el_aaa   : N,
				el_aba   : N,
				state    : 0,
				edgeHiSignal : F,
				edgeLoSignal : F,
				// utilities
			},
			stabilize_SUB : function(){var _ = this.o;
				if (this.if("which","location")){
					//ll(_.which+" ... "+_.location+" ... "+_.english);
					_.english = π.keySetToEnglish(_.which,_.location);}
				//window.removeEventListener("keydown",_.keydown); // MDN claims this is not needed, redundancy is blocked when calling addEventListener
				//window.removeEventListener("keyup"  ,_.keyup  ); // MDN claims this is not needed, redundancy is blocked when calling addEventListener
				window.addEventListener("keydown",_.keydown);
				window.addEventListener("keyup"  ,_.keyup  );
			},
			// technically, we should inbound() the state, but we really need this element triggering to be low-latency, so we do some direct manipulation with direct-setting, changed(), and outbound()
			setup_SUB : function(){var _ = this.o;
				_.keydown = function(that,_){return function(e){if (e.which === _.which && e.location === _.location){if (_.state!==1){_.edgeHiSignal=!_.edgeHiSignal;_.state=1;that.changed({datA:[["state",_.state],["edgeHiSignal",_.edgeHiSignal]]});that.outbound();}}};}(this,_);
				_.keyup   = function(that,_){return function(e){if (e.which === _.which && e.location === _.location){if (_.state!==0){_.edgeLoSignal=!_.edgeLoSignal;_.state=0;that.changed({datA:[["state",_.state],["edgeLoSignal",_.edgeLoSignal]]});that.outbound();}}};}(this,_);
				µ.rr(this.elP,µ.m([[
					[".KERN000011A"+this.base,{z:{KERN:this}},[
						µ.bscss("key",["input.KERN000011AAA"+this.base,{keypress:function(e){e.preventDefault();},paste:function(e){e.preventDefault();},keydown:function(_){return function(e){_.which=e.which;_.location=e.location;this.value=π.keySetToEnglish(_.which,_.location);};}(_)}],".KERN000011AA"+this.base),
						µ.bscss("trig.",[".button.KERN000011ABA"+this.base,{mousedown:function(that,_){return function(e){if (_.state!==1){_.edgeHiSignal=!_.edgeHiSignal;_.state=1;that.changed({datA:[["state",_.state],["edgeHiSignal",_.edgeHiSignal]]});that.outbound();}};}(this,_),mouseup:function(that,_){return function(e){if (_.state!==0){_.edgeLoSignal=!_.edgeLoSignal;_.state=0;that.changed({datA:[["state",_.state],["edgeLoSignal",_.edgeLoSignal]]});that.outbound();}};}(this,_)}],".KERN000011AB"+this.base),
					]]
				]]));
				_.el_aaa = µ.qd(".KERN000011AAA"+this.base);
				_.el_aba = µ.qd(".KERN000011ABA"+this.base);},
			refresh_SUB   : function(){var _ = this.o;
				if (this.if("co")){
					µ.maCSS(document.head,this.base,µ.cssCompile({
						//[this.base+".KERN000011A"               ] : "--fs-label:"+Math.floor(_.el_aaa.clientHeight/2)+"px;",
						[".KERN000011AA" +this.base] : "¥c:"+hsla(_.co)+";",
						[".KERN000011AAA"+this.base] : "¥c:"+hsla(_.co)+";",
						[".KERN000011AB" +this.base] : "¥c:"+hsla(_.co)+";",
					}));}
				if (this.if("which","location")){
					_.el_aaa.value = _.english;}},
			drawFrame_SUB : function(){var _ = this.o;
				//if (π.rand(0,120)===0){ll("    "+this.counter+" "+_.state+" "+_.which+" "+_.location);}
				if (_.state === 1){_.el_aba.classList.add("active");}
				else{_.el_aba.classList.remove("active");}},
		});
		oo.portInP .pushA([["which",KERNTypeO.number],["location",KERNTypeO.number],["tx",KERNTypeO.string],["co",KERNTypeO.string],["bg",KERNTypeO.string],["state",KERNTypeO.string]]);
		oo.portOutP.pushA([["which",KERNTypeO.number],["location",KERNTypeO.number],["tx",KERNTypeO.string],["co",KERNTypeO.string],["bg",KERNTypeO.string],["state",KERNTypeO.string],["edgeHiSignal",KERNTypeO.signal],["edgeLoSignal",KERNTypeO.signal]]);
		return oo;},
	};
</script>
