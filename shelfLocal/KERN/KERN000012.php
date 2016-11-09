<script id="KERN000012CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000012A,.KERN000012A *"                                :"box-sizing:border-box;",
		".KERN000012A::-moz-selection,.KERN000012A *::-moz-selection":"¥bgc:transparent;",
		".KERN000012A::selection,.KERN000012A *::selection"          :"¥bgc:transparent;",
		".KERN000012A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000012AA"                                              :"¥:absolute;¥:NW;¥s:1000‰;¥bgc:transparent;",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000012"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000012A").forEach(el=>{el.KERN.refresh();});});
var KERN000012 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000012",
			o : {
				fil   : N,
				tx    : [0,0,1  ],
				co    : [0,1,0.5],
				bg    : [0,0,0  ,1],
				bgr   : "no-repeat",
				bgs   : "contain", //"cover",
				bgo   : "padding-box",
				bgp   : "center",
				bga   : "fixed",
				bgi   : "",
				url   : "", // overridden
				// utilities
			},
			validateFxnO : {},
			stabilize_SUB   : function(){var _ = this.o;
				if (this.if("fil")){_.url = (_.fil===N?"":URL.createObjectURL(_.fil));}},
			setup_SUB : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000012A"+this.base,{z:{KERN:this}},[
						[".KERN000012AA"+this.base],]]
				]]));},
			refresh_SUB  : function(){var _ = this.o;
				µ.maCSS(document.head,this.base,µ.cssCompile({
					[".KERN000012AA"+this.base] : "¥bgr:"+_.bgr+";¥bgs:"+_.bgs+";¥bgo:"+_.bgo+";¥bgp:"+_.bgp+";¥bga:"+_.bga+";¥bgi:url("+_.url+");",
				}));},
		});
		oo.portInP .pushA([["fil",KERNTypeO.complexReference],["bgr",KERNTypeO.string],["bgs",KERNTypeO.string],["bgo",KERNTypeO.string],["bgp",KERNTypeO.string],["bga",KERNTypeO.string],["bgi",KERNTypeO.string]]);
		oo.portOutP.pushA([["fil",KERNTypeO.complexReference]]);
		return oo;},
	};
</script>
