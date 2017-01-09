(function(){
	KERN.partO["KERN000023"] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					// imports and exports
					log  : [],
					rowA : [],
					kAllowExtraF : T,
					kMetaEO : {},
					axisSA : [],
					westColStuckN : 0,
					eastColStuckN : 0,
					kMetaCompleteEO : {},
					scrollTop  : 0,
					scrollLeft : 0,
					block1 : N,
					block2 : N,
					block3 : N,
					block4 : N,
					block5 : N,
					block6 : N,
					block7 : N,
					block8 : N,
					block9 : N,
					scrollEndTimeout : N,
					// utilities
					scrollAssert : function(){var root = this.root;var _ = this;
						/*_.block2.defaultView.scrollTo(_.scrollLeft,0);
						_.block4.defaultView.scrollTo(0,_.scrollTop);
						_.block5.defaultView.scrollTo(_.scrollLeft,_.scrollTop);
						_.block6.defaultView.scrollTo(0,_.scrollTop);
						_.block8.defaultView.scrollTo(_.scrollLeft,0);*/
						_.block2.scrollLeft = _.scrollLeft;
						_.block4.scrollTop  = _.scrollTop;
						_.block5.scrollTop  = _.scrollTop;
						_.block5.scrollLeft = _.scrollLeft;
						_.block6.scrollTop  = _.scrollTop;
						_.block8.scrollLeft = _.scrollLeft;},
				},
				portInA  : [["rowHeightN",KERN.typeO.number],["rowA",KERN.typeO.complexReference],["kAllowExtraF",KERN.typeO.flag],["kMetaEO",KERN.typeO.complexReference],["westColStuckN",KERN.typeO.number],["eastColStuckN",KERN.typeO.number]],
				portOutA : [],
				//------------------------------------------------------------------------------------------------------------------------
				//•ping - faux-class, actual name prepended with partID
				//†ping - faux-¥, actual name prepended with partID and something else
				//∑ - [standalone] of this partID
				//¶ - [standalone] of this instanceID
				genMultiCSSO : function(elMissingF){var root = this;var _ = this.o;return µ.cssO({
					"∑"            : "box-sizing:border-box;",//¥c:var(--c);
					"†root"        : "¥:relative;¥w:1000‰;¥h:1000‰;¥o:hidden;",
					// 1 | 2 | 3 < head
					// --+---+--
					// 4 | 5 | 6 < main
					// --+---+--
					// 7 | 8 | 9 < foot
					// ^   ^   ^
					// W   C   E
					"•block"     : "¥:absolute;¥o:auto;",
					"•axis-x"    : "font-weight:bold;",
					"•axis-y"    : "font-weight:normal;",
					"•axis-none" : "font-weight:normal;",
					"•row"       : "¥:block;white-space:nowrap;",
					"•cell"      : "¥:inline-block;vertical-align:top;",
					"†block1"    : "¥:NW;",
					"†block2"    : "¥:N;",
					"†block3"    : "¥:NE;",
					"†block4"    : "¥:W;",
					"†block5"    : "",
					"†block6"    : "¥:E;",
					"†block7"    : "¥:SW;",
					"†block8"    : "¥:S;",
					"†block9"    : "¥:SE;",
				});},
				genUniqueCSSO : function(elMissingF){var root = this;var _ = this.o;
					if (elMissingF || this.if("tx","co","bg","rowHeightN","rowA","kAllowExtraF","kMetaEO","westColStuckN","eastColStuckN")){
						var h = _.rowHeightN;
						var west = _.kMetaCompleteEO.filter(kMetaCompleteE=>kMetaCompleteE.colGroup==="w").mapV(kMetaCompleteE=>kMetaCompleteE.widthN).sum();
						var east = _.kMetaCompleteEO.filter(kMetaCompleteE=>kMetaCompleteE.colGroup==="e").mapV(kMetaCompleteE=>kMetaCompleteE.widthN).sum();
						var colFinalN = _.kMetaCompleteEO.mapV(kMetaCompleteE=>kMetaCompleteE.colN).max(0);
						return µ.cssO(π.ooa({
							"¶†root" : ø.genCSSVarS({tx:_.tx,co:_.co,bg:_.bg})+"¥bgc:"+hslma(_.bg,_.co,0.8,_.bg[3])+";",
							"¶•block"  : "",
							
							"¶•cell-n" : "¥bgc:"+hslma(_.bg,_.co,1.0,_.bg[3])+";¥bb:1px solid "+hslma(_.bg,_.co,0.5,_.bg[3])+";",
							"¶•cell-s" : "¥bgc:"+hslma(_.bg,_.co,1.0,_.bg[3])+";¥bt:1px solid "+hslma(_.bg,_.co,0.5,_.bg[3])+";",
							["¶•cell-n:not(•col-"+str(colFinalN)+"),"
							+"¶•cell-s:not(•col-"+str(colFinalN)+")"] : "¥br:1px solid "+hslma(_.bg,_.co,0.6,_.bg[3])+";",
							
							"¶•cell-e" : "¥bgc:"+hslma(_.bg,_.co,0.9,_.bg[3])+";",
							"¶•cell-e:last-child" : "¥bl:1px solid "+hslma(_.bg,_.co,0.5,_.bg[3])+";",
							"¶•cell-w" : "¥bgc:"+hslma(_.bg,_.co,0.9,_.bg[3])+";",
							"¶•cell-w:last-child" : "¥br:1px solid "+hslma(_.bg,_.co,0.5,_.bg[3])+";",
							
							"¶•cell-c" : "¥bgc:"+hslma(_.bg,_.co,1.0,_.bg[3])+";",
							"¶•cell•img" : "¥bgs:contain;¥bgr:no-repeat;",
							
							["¶†block4>•row:nth-child(2n)>•cell,"
							+"¶†block5>•row:nth-child(2n)>•cell,"
							+"¶†block6>•row:nth-child(2n)>•cell"] : "¥bgc:"+hslmma(_.co,_.tx,_.bg,0.1,0.15,_.bg[3])+";",
							"¶†block1" :                                "¥w:"+west+"px;"                     +"¥h:"+h+"px;"                  ,
							"¶†block2" :               "¥l:"+west+"px;"+"¥w:calc(1000‰ - "+(west+east)+"px);"+"¥h:"+h+"px;"                  ,
							"¶†block3" :                                "¥w:"+east+"px;"                     +"¥h:"+h+"px;"                  ,
							"¶†block4" : "¥t:"+h+"px;"+                 "¥w:"+west+"px;"                     +"¥h:calc(1000‰ - "+(2*h)+"px);",
							"¶†block5" : "¥t:"+h+"px;"+"¥l:"+west+"px;"+"¥w:calc(1000‰ - "+(west+east)+"px);"+"¥h:calc(1000‰ - "+(2*h)+"px);",
							"¶†block6" : "¥t:"+h+"px;"+                 "¥w:"+east+"px;"                     +"¥h:calc(1000‰ - "+(2*h)+"px);",
							"¶†block7" :                                "¥w:"+west+"px;"                     +"¥h:"+h+"px;"                  ,
							"¶†block8" :               "¥l:"+west+"px;"+"¥w:calc(1000‰ - "+(west+east)+"px);"+"¥h:"+h+"px;"                  ,
							"¶†block9" :                                "¥w:"+east+"px;"                     +"¥h:"+h+"px;"                  ,
							"¶•row"    : "¥w:1000‰;¥h:"+h+"px;",
							"¶•cell"   : "¥h:"+h+"px;¥p:3px;¥o:auto;",
						},_.kMetaCompleteEO.mapO(kMetaCompleteE=>({["¶•cell-"+str(kMetaCompleteE.colN)]:"¥w:"+str(kMetaCompleteE.widthN)+"px;"}))));}
					else{
						return null;}},
				//------------------------------------------------------------------------------------------------------------------------
				validateFxnO : {},
				stabilize_SUB : function(){var root = this;var _ = this.o;},
				setup_SUB     : function(){var root = this;var _ = this.o;
					µ.rr(this.elP,µ.m([[
						["†root",[
							["†head"],
							["†main"],
							["†foot"],
						]],
					]],[v=>this.cssReplKFxn(v),v=>this.cssReplKTagFxn(v)]));
					},
				refresh_SUB   : function(){var root = this;var _ = this.o;
					if (root.if("rowHeightN","rowA","kAllowExtraF","kMetaEO","westColStuckN","eastColStuckN")){}
					// gather the required labels
					_.kMetaCompleteEO = _.kMetaEO.filter(kMeta=>typeof kMeta.requiredF !== "undefined" && kMeta.requiredF);
					// if we are allowing extras, add those on
					if (_.kAllowExtraF){
						var axisSA = π.flat(_.rowA.map(row=>Object.keys(row))).makeUniqueX();
						π.ooaw(_.kMetaCompleteEO,axisSA.mapO(axisS=>({[axisS]:{}})));}
					// fill in all parameters to make this cleaner for later use
					var i = 0;
					var c = Object.keys(_.kMetaCompleteEO).length;
					_.kMetaCompleteEO.forEach((kMetaCompleteE,axisS)=>{
						var colGroup = "c";
						if (i < _.westColStuckN){colGroup = "w";}
						else if (i > c-1-_.eastColStuckN){colGroup = "e";}
						π.ooaw(kMetaCompleteE,{translationS:axisS,requiredF:F,widthN:100,type:"txt",colGroup,colN:i});
						i++;});
					//....
					// !!! ensure order with colN
					var macroAxis1 = [["•row",_.kMetaCompleteEO.mapV(kMetaCompleteE=>["•cell•cell-n•cell-"+str(kMetaCompleteE.colN),kMetaCompleteE.translationS])]];
					var macroAxis2 = [["•row",_.kMetaCompleteEO.mapV(kMetaCompleteE=>["•cell•cell-s•cell-"+str(kMetaCompleteE.colN),kMetaCompleteE.translationS])]];
					var macroMain = _.rowA.map(row=>["•row",_.kMetaCompleteEO.mapV((kMetaCompleteE,k)=>{
						var v = row[k];
						switch (_.kMetaEO[k]["type"]){default:;
							/***/;case "txt":
								if (typeof v === "undefined"){v = "???";}
								return ["•cell•txt•cell-"+kMetaCompleteE.colGroup+"•cell-"+str(kMetaCompleteE.colN),str(v)];
							break;case "img":
								if (typeof v === "undefined"){v = {};}
								π.ooaw(v,{filenameS:"FtB575_unlabeled_file",src:"https://feelthebeats.se/image/blank"});
								return ["•cell•img•cell-"+kMetaCompleteE.colGroup+"•cell-"+str(kMetaCompleteE.colN),{d:{style:"¥bgi:url("+str(v.src)+");"}}]; // !!! consider putting an esc()-esque filter here for ¥bgi
							break;case "dl" :
								π.ooaw(v,{filenameS:"FtB575_unlabeled_file",src:"https://feelthebeats.se/image/blank"});
								return µ.bscss("DL⬇",[".button",{click:(function(v){return function(){π.saveLinkAsFile(str(v.src),str(v.filenameS));};})(v)}],"•cell•dl•cell-" +kMetaCompleteE.colGroup+"•cell-"+str(kMetaCompleteE.colN));}
						})]);
					µ.rr(µ.qd(this.elP,root.cssReplKFxn("¶†root")),µ.m([[
						["•block†block1",macroAxis1.map(macroRow=>["•row",macroRow[1].slice(0,_.westColStuckN)])],["•block†block2",macroAxis1.map(macroRow=>["•row",macroRow[1].slice(_.westColStuckN,c-_.eastColStuckN)])],["•block†block3",macroAxis1.map(macroRow=>["•row",macroRow[1].slice(c-_.eastColStuckN)])],
						["•block†block4",macroMain .map(macroRow=>["•row",macroRow[1].slice(0,_.westColStuckN)])],["•block†block5",macroMain .map(macroRow=>["•row",macroRow[1].slice(_.westColStuckN,c-_.eastColStuckN)])],["•block†block6",macroMain .map(macroRow=>["•row",macroRow[1].slice(c-_.eastColStuckN)])],
						["•block†block7",macroAxis2.map(macroRow=>["•row",macroRow[1].slice(0,_.westColStuckN)])],["•block†block8",macroAxis2.map(macroRow=>["•row",macroRow[1].slice(_.westColStuckN,c-_.eastColStuckN)])],["•block†block9",macroAxis2.map(macroRow=>["•row",macroRow[1].slice(c-_.eastColStuckN)])],
					]],[v=>this.cssReplKFxn(v),v=>this.cssReplKTagFxn(v)]));
					_.block1 = µ.qd(this.elP,root.cssReplKFxn("†block1"));
					_.block2 = µ.qd(this.elP,root.cssReplKFxn("†block2"));
					_.block3 = µ.qd(this.elP,root.cssReplKFxn("†block3"));
					_.block4 = µ.qd(this.elP,root.cssReplKFxn("†block4"));
					_.block5 = µ.qd(this.elP,root.cssReplKFxn("†block5"));
					_.block6 = µ.qd(this.elP,root.cssReplKFxn("†block6"));
					_.block7 = µ.qd(this.elP,root.cssReplKFxn("†block7"));
					_.block8 = µ.qd(this.elP,root.cssReplKFxn("†block8"));
					_.block9 = µ.qd(this.elP,root.cssReplKFxn("†block9"));
					_.block2.addEventListener("scroll",(function(root,_){return function(){                             _.scrollLeft = this.scrollLeft;_.scrollAssert();};})(root,_));
					_.block4.addEventListener("scroll",(function(root,_){return function(){_.scrollTop = this.scrollTop;                               _.scrollAssert();};})(root,_));
					_.block5.addEventListener("scroll",(function(root,_){return function(){_.scrollTop = this.scrollTop;_.scrollLeft = this.scrollLeft;clearTimeout(_.scrollEndTimeout);_.scrollEndTimeout = setTimeout((function(root,_){return function(){_.scrollAssert();};})(root,_),10);};})(root,_));
					_.block6.addEventListener("scroll",(function(root,_){return function(){_.scrollTop = this.scrollTop;                               _.scrollAssert();};})(root,_));
					_.block8.addEventListener("scroll",(function(root,_){return function(){                             _.scrollLeft = this.scrollLeft;_.scrollAssert();};})(root,_));
				},
				destroy_SUB : function(){var root = this;var _ = this.o;},
			};
			return oo;},
		};
})();
