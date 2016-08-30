<script id="KERN000016CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000016A,.KERN000016A *"                                :"box-sizing:border-box;",
		".KERN000016A::-moz-selection,.KERN000016A *::-moz-selection":"¥bgc:transparent;",
		".KERN000016A::selection,.KERN000016A *::selection"          :"¥bgc:transparent;",
		".KERN000016A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000016AA"                                              :"¥:block;¥s:1000‰;",
		".KERN000016AAA"                                             :"¥:block;¥s:1000‰;",
		".KERN000016AAB"                                             :"",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000016"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000016A").forEach(el=>{el.KERN.refresh();});});
var KERN000016 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name : "KERN000016",
			o : {
				tx        : [0,0,1  ],
				co        : [0,1,0.5],
				bg        : [0,0,0  ,1],
				elO       : {},
				labelS    : "",
				fxnEdgeHi : ()=>{},
				fxnEdgeLo : ()=>{},
				edgeHiInSignal  : N, // inbound signal
				edgeLoInSignal  : N, // inbound signal
				edgeHiOutSignal : F, // outbound signal
				edgeLoOutSignal : F, // outbound signal
				// utilities
			},
			stabilize_SUB : function(){var _ = this.o;
				if (this.if("edgeHiInSignal") && !this.alteredPropertyAllF){_.fxnEdgeHi();}
				if (this.if("edgeLoInSignal") && !this.alteredPropertyAllF){_.fxnEdgeLo();}
			},
			setup_SUB     : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000016A"+this.base,{z:{KERN:this}},[
						µ.bscss("",[".button.KERN000016AAA"+this.base,{mousedown:function(that){return function(){that.o.fxnEdgeHi();_.edgeHiOutSignal=!_.edgeHiOutSignal;that.changed({datA:[["edgeHiOutSignal",_.edgeHiOutSignal]]});that.outbound();};}(this),mouseup:function(that){return function(){that.o.fxnEdgeLo();_.edgeLoOutSignal=!_.edgeLoOutSignal;that.changed({datA:[["edgeLoOutSignal",_.edgeLoOutSignal]]});that.outbound();};}(this)}],".KERN000016AA"+this.base,".KERN000016AAB"+this.base),
					]]
				]]));
				_.elO.aab = µ.qd(".KERN000016AAB" +this.base);},
			refresh_SUB   : function(){var _ = this.o;
//				µ.maCSS(document.head,this.base,µ.cssCompile({
//					//[".KERN000016AA"+this.base] : "¥c:"+hsla(_.tx)+";¥fs:"+_.fs+"px;"+(_.lineWrap?"white-space:nowrap;":"white-space:normal;"),
//				}));
				if (this.if("labelS")){_.elO.aab.innerHTML = _.labelS;}
			},
		});
		oo.portInP .pushA([["labelS",KERNTypeO.string],["fxnEdgeHi",KERNTypeO.function],["fxnEdgeLo",KERNTypeO.function],["edgeHiInSignal",KERNTypeO.signal],["edgeLoInSignal",KERNTypeO.signal]]);
		oo.portOutP.pushA([["edgeHiOutSignal",KERNTypeO.signal],["edgeLoOutSignal",KERNTypeO.signal]]);
		return oo;},
	};
</script>
