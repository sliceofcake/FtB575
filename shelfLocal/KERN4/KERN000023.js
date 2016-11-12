(function(){
	KERN.partO["KERN000022"] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					// imports and exports
					log : [],
					headerSA : [],
					
					// utilities
				},
				portInA  : [["log",KERN.typeO.complex]],
				portOutA : [],
				//•ping - faux-class, actual name prepended with partID
				//†ping - faux-¥, actual name prepended with partID and something else
				//∑ - [standalone] of this partID
				//¶ - [standalone] of this instanceID
				genMultiCSSO : function(elMissingF){var root = this;var _ = this.o;return µ.cssO({
					"∑"       : "box-sizing:border-box;",//¥c:var(--c);
					"†root"   : "¥:relative;¥w:1000‰;¥h:1000‰;¥o:auto;",
					"†root>*" : "¥w:1000‰;",
				});},
				genUniqueCSSO : function(elMissingF){var root = this;var _ = this.o;
					if (elMissingF || this.if("tx","co","bg")){
						return µ.cssO({
							"¶†root"   : ø.genCSSVarS({tx:_.tx,co:_.co,bg:_.bg})+"¥bgc:"+hslma(_.bg,_.co,0.8,_.bg[3])+";",
							"¶†foot>:not(:first-child)" : "border-top:1px solid "+hsla(_.co,_.bg[3])+";",
						});}
					else{
						return null;}},
				validateFxnO : {},
				stabilize_SUB : function(){var root = this;var _ = this.o;},
				setup_SUB     : function(){var root = this;var _ = this.o;
					µ.rr(this.elP,µ.m([[
						["†root"],
					]],[v=>this.cssReplKFxn(v),v=>this.cssReplKTagFxn(v)]));
					},
				refresh_SUB   : function(){var root = this;var _ = this.o;
					µ.rr(µ.qd(this.elP,root.cssReplKFxn("¶†root")),µ.m([
						_.log.mapReverse(m=>{
							if (typeof m !== "number" && typeof m !== "string" && typeof m !== "boolean"){m = π.jsonE(m);}
							return ["",m];
						}),
					],[v=>this.cssReplKFxn(v),v=>this.cssReplKTagFxn(v)]));
					},
				destroy_SUB : function(){var root = this;var _ = this.o;},
			};
			return oo;},
		};
})();
