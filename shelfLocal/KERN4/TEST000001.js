(function(){
	KERN.partO["TEST000001"] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					elO                : {},
					counter            : 0,
					rainbowCoHue       : 0,
					// imports and exports
					edgeHiImportSignal : null,
					edgeHiExportSignal : false,
					edgeHiS            : "",
					continuousS        : "",
					// utilities
				},
				genMultiCSS : function(){return ""
					+this.genCSSGenericRulePartialS("a") +"{box-sizing:border-box;}"
					+this.genCSSGenericRulePartialS("a") +"{position:relative;width:100%;height:100%;}"
					+this.genCSSGenericRulePartialS("aa")+"{display:inline-block;}"
					+this.genCSSGenericRulePartialS("ab")+"{display:inline-block;}"
					+this.genCSSGenericRulePartialS("ac")+"{display:inline-block;}"
					+this.genCSSGenericRulePartialS("ad")+"{display:inline-block;width:20px;height:20px;}";},
				genUniqueCSS : function(){
					if (this.if("tx","co","bg")){
						return "";}
					else{
						return null;}},
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
						_.edgeHiExportSignal = !_.edgeHiExportSignal;
						this.changed(["edgeHiExportSignal"],["edgeHiS"]);}},
				setup_SUB : function(){var _ = this.o;
					_.elO.a  = document.createElement("div"   );_.elO.a .setAttribute(KERN.pcv.elAttributeK_ofClass,"a" );_.elO.a .setAttribute(KERN.pcv.elAttributeK_ofPartType,KERN.pcv.elAttributeVFxn_ofPartType(this));_.elO.a .setAttribute(KERN.pcv.elAttributeK_ofInstance,KERN.pcv.elAttributeVFxn_ofInstance(this));
					_.elO.aa = document.createElement("button");_.elO.aa.setAttribute(KERN.pcv.elAttributeK_ofClass,"aa");_.elO.aa.setAttribute(KERN.pcv.elAttributeK_ofPartType,KERN.pcv.elAttributeVFxn_ofPartType(this));_.elO.aa.setAttribute(KERN.pcv.elAttributeK_ofInstance,KERN.pcv.elAttributeVFxn_ofInstance(this));
					_.elO.ab = document.createElement("input" );_.elO.ab.setAttribute(KERN.pcv.elAttributeK_ofClass,"ab");_.elO.ab.setAttribute(KERN.pcv.elAttributeK_ofPartType,KERN.pcv.elAttributeVFxn_ofPartType(this));_.elO.ab.setAttribute(KERN.pcv.elAttributeK_ofInstance,KERN.pcv.elAttributeVFxn_ofInstance(this));
					_.elO.ac = document.createElement("input" );_.elO.ac.setAttribute(KERN.pcv.elAttributeK_ofClass,"ac");_.elO.ac.setAttribute(KERN.pcv.elAttributeK_ofPartType,KERN.pcv.elAttributeVFxn_ofPartType(this));_.elO.ac.setAttribute(KERN.pcv.elAttributeK_ofInstance,KERN.pcv.elAttributeVFxn_ofInstance(this));
					_.elO.ad = document.createElement("div"   );_.elO.ad.setAttribute(KERN.pcv.elAttributeK_ofClass,"ad");_.elO.ad.setAttribute(KERN.pcv.elAttributeK_ofPartType,KERN.pcv.elAttributeVFxn_ofPartType(this));_.elO.ad.setAttribute(KERN.pcv.elAttributeK_ofInstance,KERN.pcv.elAttributeVFxn_ofInstance(this));
					
					_.elO.aa.addEventListener("mousedown",function(that){return function(){var _ = that.o;
						_.edgeHiExportSignal = !_.edgeHiExportSignal;
						that.changed(["edgeHiExportSignal"],["edgeHiS"]);
						that.export();
					};}(this));
					_.elO.ab.addEventListener("input",function(that){return function(){var _ = that.o;
						that.import([["edgeHiS",this.value]],true);
					};}(this));
					_.elO.ac.addEventListener("input",function(that){return function(){var _ = that.o;
						that.import([["continuousS",this.value]],true);
					};}(this));
					
					this.import([["edgeHiS","giraffe"]],true);
					this.import([["continuousS","cat"]],true);
					
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
					if (_.counter++%6!==0){return;} // fps limiter
					_.rainbowCoHue = (_.rainbowCoHue+1)%360;
					_.elO.ad.style.backgroundColor = "hsl("+_.rainbowCoHue+",100%,50%)";},
			};
			return oo;},
		};
})();