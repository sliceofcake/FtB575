<script id="KERN000013CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000013A,.KERN000013A *"                                :"box-sizing:border-box;",
		".KERN000013A::-moz-selection,.KERN000013A :not(.KERN000013AA)::-moz-selection":"¥bgc:transparent;",
		".KERN000013A::selection,.KERN000013A :not(.KERN000013AA)::selection"          :"¥bgc:transparent;",
		".KERN000013A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000013AA"                                              :"¥:absolute;¥:NW;¥s:1000‰;¥bgc:transparent;overflow-x:auto;",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000013"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000013A").forEach(el=>{el.KERN.refresh();});});
var KERN000013 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000013",
			o : {
				txt   : "",
				fs    : "inherit", // font-size
				lineWrap : T,
				tx    : [0,0,1  ],
				co    : [0,1,0.5],
				bg    : [0,0,0  ,1],
				elO   : {},
				// utilities
			},
			validateFxnO : {},
			stabilize_SUB   : function(){},
			setup_SUB : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000013A"+this.base,{z:{KERN:this}},[
						["textarea.KERN000013AA"+this.base],]]
				]]));
				_.elO.aa = µ.qd(".KERN000013AA"+this.base);},
			refresh_SUB  : function(){var _ = this.o;
				if (_.elO.aa.value !== _.txt){_.elO.aa.value = _.txt;}
				µ.ma(document.head,µ.m({type:"style",d:{"data-unique":this.base},css:{
					[".KERN000013AA"+this.base] : "¥c:"+hsla(_.tx)+";¥fs:"+_.fs+"px;"+(_.lineWrap?"white-space:nowrap;":"white-space:normal;"),
				}}));},
		});
		oo.portInP .pushA([["txt",KERNTypeO.string],["fs",KERNTypeO.string]]);
		oo.portOutP.pushA([["txt",KERNTypeO.string],["fs",KERNTypeO.string]]);
		return oo;},
	};
</script>