<script id="KERN000017CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000017A,.KERN000017A *"                                :"box-sizing:border-box;",
		".KERN000017A::-moz-selection,.KERN000017A *::-moz-selection":"¥bgc:transparent;",
		".KERN000017A::selection,.KERN000017A *::selection"          :"¥bgc:transparent;",
		".KERN000017A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000017AA"                                              :"¥:block;¥w:600‰;¥h:300‰;¥f:left;",
		".KERN000017AAA"                                             :"¥:block;¥s:1000‰;",
		".KERN000017AAA>*"                                           :"¥:absolute;¥:NW;¥s:1000‰;",
		".KERN000017AAAA"                                            :"¥:block;¥s:1000‰;¥bo:none;",
		".KERN000017AAAB"                                            :"¥:block;¥s:1000‰;¥op:0;¥:hand;",
		".KERN000017AB"                                              :"¥:block;¥w:200‰;¥h:300‰;¥f:left;¥fs:850‰;",
		".KERN000017ABA"                                             :"¥:block;¥w:1000‰;¥h:500‰;",
		".KERN000017ABB"                                             :"¥:block;¥w:1000‰;¥h:500‰;",
		".KERN000017AC"                                              :"¥:block;¥w:200‰;¥h:300‰;¥f:left;",
		".KERN000017AD"                                              :"¥:block;¥w:1000‰;¥h:700‰;¥f:left;¥o:auto;¥fs:650‰;white-space:nowrap;",
		".KERN000017ADA"                                             :"¥op:0.70;",
		".KERN000017ADA:hover"                                       :"¥op:0.85;",
		".KERN000017ADA:active"                                      :"¥op:1.00;",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000017"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000017A").forEach(el=>{el.KERN.refresh();});});
var KERN000017 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000017",
			o : {
				fil   : N,
				filChartO  : {},
				filChart   : N,
				filAudio   : N,
				elO   : {},
				tx    : [0,0,1  ],
				co    : [0,1,0.5],
				bg    : [0,0,0  ,1],
				// utilities
				dragover  : function(e){e.preventDefault();}, // dragover-->preventDefault : magic, to get browsers to stop loading dropped files locally
				dragenter : function(e){e.preventDefault();},
				dragleave : function(e){e.preventDefault();},
				drop      : function(e){e.preventDefault();e.dataTransfer.files.forEach(fil=>{
					this.KERN.inbound({datA:[["fil",fil]]});
					this.KERN.o.filChartO = {};
					var KERN = this.KERN;
					var elA = [];
					var getEntries = function(file,onend){
						zip.createReader(new zip.BlobReader(file),function(zipReader){
							zipReader.getEntries(onend);
						},onerror);};
					var getEntryFile = function(entry,onend,onprogress){
						var writer,zipFileEntry;
						function getData(){
							entry.getData(writer,function(blob){
								var blobURL = window.URL.createObjectURL(blob);onend(blobURL);
								if (entry.filename.includes(".mp3")){
									KERN.inbound({datA:[["filAudio",blob]]});}
								else if (entry.filename.includes(".osu")){
									KERN.o.filChartO[entry.filename] = blob;}
								else{;}
							},onprogress);}
						writer = new zip.BlobWriter();
						getData();};
					getEntries(fil,function(entries){
						entries.forEach(function(entry){
							ll(entry.filename);
							getEntryFile(entry,function(blobURL){
								;
							},function(current,total){/*console.log(current/total);*/});
						});
					});
				});},
			},
			stabilize_SUB   : function(){var _ = this.o;},
			refresh_SUB  : function(){var _ = this.o;
//				µ.maCSS(document.head,this.base,µ.cssCompile({
//					[base+".KERN000017A"] : "¥bgc:"+hsla(_.bg,_.bg[3])+";",
//				}));
				var title = jj(_.fil,"name");
				for (var i = 0; i < 1; i++){
					var macro = µ.m([[
						[".KERN000017A"+this.base,{z:{KERN:this},dragover:_.dragover,dragenter:_.dragenter,dragleave:_.draglleave,drop:_.drop},[
							µ.bscss("file",["label.KERN000017AAA"+this.base,[
								["input.KERN000017AAAA"+this.base+".file[readonly=''][value='"+π.esc(title,["'"])+"'][data-value='"+π.esc(title,["'"])+"']"],
								["input.KERN000017AAAB"+this.base+"[type='file']",{change:function(that){return function(){that.inbound({datA:[["fil",this.files[0]]]});this.value = "";};}(this)}],
							]],".KERN000017AA"+this.base),
							[".KERN000017AB"+this.base,[
								[".KERN000017ABA"+this.base,π.byteCToFancy(jj(_.fil,"size",0))],
								[".KERN000017ABB"+this.base,jj(_.fil,"type","N/A")],
							]],
							µ.bscss("⌫",[".button.KERN000017ACA"+this.base,{click:function(that){return function(){that.inbound({datA:[["fil",N]]});};}(this)}],".KERN000017AC"+this.base),
							[".KERN000017AD"+this.base,_.filChartO.mapV((blob,filename)=>{
								return [".KERN000017ADA",{click:(function(that,blob){return function(){that.inbound({datA:[["filAudio",that.o.filAudio],["filChart",blob]]});};})(this,blob)},filename];
							})],
						]]
					]]);}
				µ.rr(this.elP,macro);
				_.elO.fileList = µ.qd(".KERN000017AD"+this.base);},
		});
		oo.portInP .pushA([["fil",KERNTypeO.complexReference],["filAudio",KERNTypeO.complexReference],["filChart",KERNTypeO.complexReference]]);
		oo.portOutP.pushA([["filAudio",KERNTypeO.complexReference],["filChart",KERNTypeO.complexReference]]);
		return oo;},
	};
</script>
