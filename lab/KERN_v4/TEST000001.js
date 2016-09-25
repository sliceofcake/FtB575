(function(){
	var partname = "TEST000001";
	document.addEventListener("DOMContentLoaded",()=>{
		var elCSS = document.createElement("style");elCSS.setAttribute(KERN.pcv.elCSSAttributeK,partname);
		elCSS.textContent
		="."+partname+"A,."+partname+"A *"+"{box-sizing:border-box;}"
		+"."+partname+"A"                 +"{position:relative;width:100%;height:100%;}"
		+"."+partname+"AA"                +"{display:inline-block;}"
		+"."+partname+"AB"                +"{display:inline-block;}"
		+"."+partname+"AC"                +"{display:inline-block;}"
		+"."+partname+"AD"                +"{display:inline-block;width:20px;height:20px;}";
		document.head.appendChild(elCSS);
	});
	KERN.partO[partname] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					elCSS              : null,
					elO                : {},
					rainbowCoHue       : 0,
					// imports and exports
					edgeHiImportSignal : null,
					edgeHiExportSignal : false,
					edgeHiS            : "",
					continuousS        : "",
					// utilities
				},
				portInA  : [["edgeHiS",KERN.typeO.string],["continuousS",KERN.typeO.string],["edgeHiImportSignal",KERN.typeO.signal]],
				portOutA : [["edgeHiS",KERN.typeO.string],["continuousS",KERN.typeO.string],["edgeHiExportSignal",KERN.typeO.signal]],
				validateFxnO : {
					edgeHiS : function(that,_,propertyname,base,k,v){
						if (typeof v !== "string"){_[propertyname] = "";return;}
						if (v.length > 10){_[propertyname] = v.substr(0,10);}},
					continuousS : function(that,_,propertyname,base,k,v){
						if (typeof v !== "string"){_[propertyname] = "";return;}
						if (v.length > 10){_[propertyname] = v.substr(0,10);}},
				},
				stabilize_SUB : function(){var _ = this.o;
					if (this.if("edgeHiImportSignal") && _.edgeHiImportSignal !== null){
						_.edgeHiExportSignal = !_.edgeHiExportSignal;}},
				setup_SUB : function(){var _ = this.o;
					_.elCSS  = document.createElement("style");_.elCSS .setAttribute(KERN.pcv.elCSSAttributeK,this.name+"_"+this.counter);document.head.appendChild(_.elCSS);
					
					_.elO.a  = document.createElement("div"   );_.elO.a .setAttribute("class",this.name+"A" );_.elO.a .setAttribute(KERN.pcv.elInnerAttributeK,this.counter);
					_.elO.aa = document.createElement("button");_.elO.aa.setAttribute("class",this.name+"AA");_.elO.aa.setAttribute(KERN.pcv.elInnerAttributeK,this.counter);
					_.elO.ab = document.createElement("input" );_.elO.ab.setAttribute("class",this.name+"AB");_.elO.ab.setAttribute(KERN.pcv.elInnerAttributeK,this.counter);
					_.elO.ac = document.createElement("input" );_.elO.ac.setAttribute("class",this.name+"AC");_.elO.ac.setAttribute(KERN.pcv.elInnerAttributeK,this.counter);
					_.elO.ad = document.createElement("div"   );_.elO.ad.setAttribute("class",this.name+"AD");_.elO.ad.setAttribute(KERN.pcv.elInnerAttributeK,this.counter);
					
					_.elO.aa.addEventListener("mousedown",function(that){return function(){var _ = that.o;
						_.edgeHiExportSignal = !_.edgeHiExportSignal;
						//that.changed(["edgeHiExportSignal"]);
						that.export();
					};}(this));
					_.elO.ab.addEventListener("input",function(that){return function(){var _ = that.o;
						that.import([["edgeHiS",this.value]],true);
					};}(this));
					_.elO.ac.addEventListener("input",function(that){return function(){var _ = that.o;
						that.import([["continuousS",this.value]],true);
					};}(this));
					
					this.import([["edgeHiS","giraffe"]],true);
					this.import([["continuousS","hamster"]],true);
					
					_.elO.a.appendChild(_.elO.aa);
					_.elO.a.appendChild(_.elO.ab);
					_.elO.a.appendChild(_.elO.ac);
					_.elO.a.appendChild(_.elO.ad);
					this.elP.appendChild(_.elO.a);},
				refresh_SUB   : function(){var _ = this.o;
					if (this.if("co")){
						_.elCSS.textContent = "["+KERN.pcv.elInnerAttributeK+"='"+this.name+"A"+this.counter+"']{color:hsl("+(_.co[0]*100)+","+(_.co[1]*100)+","+(_.co[2]*100)+");}";}
					if (this.if("continuousS")){
						_.elO.ac.value = _.continuousS;}
					if (this.if("edgeHiImportSignal")){
						_.elO.ab.value = _.edgeHiS;}},
				drawFrame_SUB : function(){var _ = this.o;
					_.rainbowCoHue = (_.rainbowCoHue+1)%360;
					_.elO.ad.style.backgroundColor = "hsl("+_.rainbowCoHue+",100%,50%)";},
			};
			return oo;},
		};
})();