<script id="KERN000009CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000009A,.KERN000009A *"                                :"box-sizing:border-box;",
		".KERN000009A::-moz-selection,.KERN000009A *::-moz-selection":"¥bgc:transparent;",
		".KERN000009A::selection,.KERN000009A *::selection"          :"¥bgc:transparent;",
		".KERN000009A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000009AA"                                              :"¥:block;¥w:600‰;¥h:1000‰;¥f:left;",
		".KERN000009AAA"                                             :"¥:block;¥s:1000‰;",
		".KERN000009AAA>*"                                           :"¥:absolute;¥:NW;¥s:1000‰;",
		".KERN000009AAAA"                                            :"¥:block;¥s:1000‰;¥bo:none;",
		".KERN000009AAAB"                                            :"¥:block;¥s:1000‰;¥op:0;¥:hand;",
		".KERN000009AB"                                              :"¥:block;¥w:200‰;¥h:1000‰;¥f:left;",
		".KERN000009ABA"                                             :"¥:block;¥w:1000‰;¥h:500‰;",
		".KERN000009ABB"                                             :"¥:block;¥w:1000‰;¥h:500‰;",
		".KERN000009AC"                                              :"¥:block;¥w:200‰;¥h:1000‰;¥f:left;",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000009"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000009A").forEach(el=>{el.KERN.refresh();});});
var KERN000009 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000009",
			o : {
				fil   : N,
				tx    : [0,0,1  ],
				co    : [0,1,0.5],
				bg    : [0,0,0  ,1],
				// utilities
				dragover  : function(e){e.preventDefault();}, // dragover-->preventDefault : magic, to get browsers to stop loading dropped files locally
				dragenter : function(e){e.preventDefault();},
				dragleave : function(e){e.preventDefault();},
				drop      : function(e){e.preventDefault();e.dataTransfer.files.forEach(fil=>{this.KERN.inbound({datA:[["fil",fil]]});});},
			},
			stabilize_SUB   : function(){var _ = this.o;},
			refresh_SUB  : function(){var _ = this.o;
				µ.ma(document.head,µ.m({type:"style",d:{"data-unique":this.base},css:{
					//[base+".KERN000009A"] : "¥bgc:"+hsla(_.bg,_.bg[3])+";",
				}}));
				var title = jj(_.fil,"name");
				for (var i = 0; i < 1; i++){
					var macro = µ.m([[
						[".KERN000009A"+this.base,{z:{KERN:this},dragover:_.dragover,dragenter:_.dragenter,dragleave:_.draglleave,drop:_.drop},[
							µ.bscss("file",["label.KERN000009AAA"+this.base,[
								["input.KERN000009AAAA"+this.base+".file[readonly=''][value='"+π.esc(title,["'"])+"'][data-value='"+π.esc(title,["'"])+"']"],
								["input.KERN000009AAAB"+this.base+"[type='file']",{change:function(that){return function(){that.inbound({datA:[["fil",this.files[0]]]});this.value = "";};}(this)}],
							]],".KERN000009AA"+this.base),
							[".KERN000009AB"+this.base,[
								[".KERN000009ABA"+this.base,π.byteCToFancy(jj(_.fil,"size",0))],
								[".KERN000009ABB"+this.base,jj(_.fil,"type","N/A")],
							]],
							µ.bscss("clear",[".button.KERN000009ACA"+this.base,{click:function(that){return function(){that.inbound({datA:[["fil",N]]});};}(this)}],".KERN000009AC"+this.base),
						]]
					]]);}
				µ.rr(this.elP,macro);},
		});
		oo.portInP .pushA([["fil",KERNTypeO.complexReference]]);
		oo.portOutP.pushA([["fil",KERNTypeO.complexReference]]);
		return oo;},
	};
</script>
