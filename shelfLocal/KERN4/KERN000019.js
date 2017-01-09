(function(){
	KERN.partO["KERN000019"] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					elO      : {},
					chartIDA : [],
					userIDA  : [], // for optimization purposes, keeping track of which userIDs we are using
					//....
					rowHeightN : 20,
					rowA     : [],
					kAllowExtraF : F,
					kMetaEO : {
						"ico"             : {colN: 0,translationS:"icon"       ,requiredF:T,widthN: 20,type:"img"},
						"titleS"          : {colN: 1,translationS:"song title" ,requiredF:T,widthN:200,},
						"originS"         : {colN: 2,translationS:"song origin",requiredF:T,widthN:200,},
						"userA"           : {colN: 3,translationS:"uploaders"  ,requiredF:T,widthN:150,},
						"durationN"       : {colN: 4,translationS:"◷"          ,requiredF:T,widthN: 50,},
						"npsN_DERIVED"    : {colN: 5,translationS:"♪/◷"        ,requiredF:T,widthN: 50,},
						"formatS_DERIVED" : {colN: 6,translationS:"format"     ,requiredF:T,widthN: 50,},
						"laneC_DERIVED"   : {colN: 7,translationS:"◨"          ,requiredF:T,widthN: 50,},
						"txt"             : {colN: 8,translationS:"notes file" ,requiredF:T,widthN: 50,type:"dl"},
						"infoAudioS"      : {colN: 9,translationS:"audio info" ,requiredF:T,widthN:300,},
						"infoS"           : {colN:10,translationS:"info"       ,requiredF:T,widthN:300,},},
					westColStuckN : 2,
					eastColStuckN : 0,
					//....
					// imports and exports
					// utilities
					chartIDAGet : function(){var root = this.root;var _ = this;
						root.ll("get chart list -> ...");
						core.send({tbl:"chart",act:"dmp",
							successFxn:(function(that){return function(o){
								root.ll("get chart list -> success");
								_.chartIDA = o.dat._IDA;
								_.fill();
							};})(root,_),
							failureFxn:(function(that){return function(o){var root = that;var _ = that.o;root.ll("get chart list -> "+o.msg);};})(root),});
					},
					fill:function(){var root = this.root;var _ = this;
						root.ll("fill info -> ...");
						_.rowA = _.chartIDA.mapFilter(chartID=>{
							var chart = core.getRow("chart",chartID);
							if (chart === N){return U;}
							return chart.mapO((v,k)=>{
								switch (k){default:return {[k]:v};
									break;case "icoRExtension_DERIVED":
										return {"ico":{filenameS:"FtB575_chart_"+str(chartID)+"_ico"+v,src:"../file/?tbl="+encodeURIComponent("chart")+"&propertyS="+encodeURIComponent("icoR")+"&ID="+encodeURIComponent(str(chartID))+"&extension="+encodeURIComponent(v)}};
									break;case "txtRExtension_DERIVED":
										return {"txt":{filenameS:"FtB575_chart_"+str(chartID)+"_txt"+v,src:"../file/?tbl="+encodeURIComponent("chart")+"&propertyS="+encodeURIComponent("txtR")+"&ID="+encodeURIComponent(str(chartID))+"&extension="+encodeURIComponent(v)}};
									break;case "_userIDA_charter":
										return {"userA":v.map(userID=>{
											_.userIDA.pushUnique(userID); // !!! use a sorted array sometime
											var user_charter = core.getRow("user",userID);
											if (user_charter === N){return "???";}
											if (typeof user_charter.nameS === "undefined"){return "???";}
											return user_charter.nameS;
										}).join(" | ")};
									break;case "durationN":
										return {[k]:Math.ceil(v/1000000)+"◷"};
								}
							});
						});
						root.changed(["rowHeightN"],["rowA"],["kAllowExtraF"],["kMetaEO"],["westColStuckN"],["eastColStuckN"]);
						root.export();
						//µ.rr(µ.qd(root.elP,root.cssReplKFxn("¶†root>†main")),µ.m([elA],[v=>root.cssReplKFxn(v),v=>root.cssReplKTagFxn(v)]));
						root.ll("fill info -> success");
					},
					coreRcvFxn : function(dat){var root = this.root;var _ = this;
						dat.forEach((tblxrowA,type)=>{
							switch (type){default:;
								break;case "fresh":
									//ll(type,tblxrowA);
									tblxrowA.forEach((rowA,tbl)=>{//ll(tbl,rowA);
										var IDA = rowA.mapV(row=>row._ID);
										switch (tbl){default:;
											break;case "chart":if (π.aaIntersect(IDA,_.chartIDA)){/*ll("KERN000019:coreRcvFxn:chart");*/_.fill();}
											break;case "user" :if (π.aaIntersect(IDA,_.userIDA )){/*ll("KERN000019:coreRcvFxn:user" );*/_.fill();}
											}
									});
								break;case "repeat":;
								break;case "bad":;}
						});
					},
				},
				portInA  : [],
				portOutA : [["rowHeightN",KERN.typeO.number],["rowA",KERN.typeO.complexReference],["kAllowExtraF",KERN.typeO.flag],["kMetaEO",KERN.typeO.complexReference],["westColStuckN",KERN.typeO.number],["eastColStuckN",KERN.typeO.number]],
				//•ping - faux-class, actual name prepended with partID
				//†ping - faux-¥, actual name prepended with partID and something else
				//∑ - [standalone] of this partID
				//¶ - [standalone] of this instanceID
				genMultiCSSO : function(elMissingF){var root = this;var _ = this.o;
					// without padding
					var wO = {
						ID              : 130,
						userID          : 130,
						durationN       : 50,
						npsN_DERIVED    : 30,
						formatS_DERIVED : 50,
						laneC_DERIVED   : 30,};
					var px = 4;
					var py = 2;
					// with padding
					var wTaken = (wO.mapV(w=>w+px).sum()+px);
					wO.titleS  = "calc("+(1000/2)+"‰ - "+(wTaken/2)+"px)";
					wO.originS = "calc("+(1000/2)+"‰ - "+(wTaken/2)+"px)";
					return µ.cssO({
					"∑"       : "box-sizing:border-box;",//¥c:var(--c);
					"†root"   : "¥:relative;¥w:1000‰;¥h:1000‰;",
					"†root>*" : "¥w:1000‰;",
					"•title"  : "font-weight:bold;¥fs:140%;",
					"†axis"   : "font-weight:bold;¥fs:120%;",
					"†fill"   : "¥h:26px;",
					"•double-column" : "¥:block;¥w:400‰;",
					"•double-column>:nth-child(1)" : "¥:block;¥w:500‰;¥h:1000‰;¥f:left;",
					"•double-column>:nth-child(2)" : "¥:block;¥w:500‰;¥h:1000‰;¥f:left;",
					"•brick"  : "¥w:1000‰;",
					"†chart-card" : "¥w:1000‰;¥h:52px;",
					"†head"   : "¥w:1000‰;¥h:55px;¥o:auto;",
					"†main"   : "¥w:1000‰;¥h:calc(1000‰ - 89px - 0px);¥o:auto;",
					"†table-a" : "¥s:1000‰;",
					"†foot"   : "¥w:1000‰;¥h:0px;¥o:auto;",
				});},
				genUniqueCSSO : function(elMissingF){var root = this;var _ = this.o;
					if (elMissingF || root.if("tx","co","bg")){
						return µ.cssO({
							"¶†root"   : ø.genCSSVarS({tx:_.tx,co:_.co,bg:_.bg}),
							"¶†axis"   : "¥c:"+hslma(_.tx,_.co,0.8)+";",
							"¶•title"  : "¥c:"+hslma(_.co,_.tx,0.8)+";",
							"¶†head"   : "¥bgc:"+hsla(_.bg,_.bg[3])+";",
							"¶†main"   : "¥bgc:"+hslma(_.bg,_.co,0.8,_.bg[3])+";",
							"¶†foot"   : "¥bgc:"+hsla(_.bg,_.bg[3])+";",
						});}
					else{
						return null;}},
				validateFxnO : {},
				stabilize_SUB : function(){var root = this;var _ = this.o;},
				setup_SUB     : function(){var root = this;var _ = this.o;
					µ.rr(root.elP,µ.m([[
						["†root",[
							["•brick†head",[
								["•brick",[
									["•title","Chart Search"],
									µ.bscss("refresh",[".button",{click:(function(that){return function(){var root = that;var _ = that.o;_.chartIDAGet();};})(root)}],"†refresh"),
								]],
							]],
							["•brick†main",[
								["•brick†table-a"],
							]],
							["•brick†foot",[]],
							
						]],
					]],[v=>root.cssReplKFxn(v),v=>root.cssReplKTagFxn(v)]));
					
					var ID = π.genID();
					p.elKERNO["subKERN"+ID] = KERN.create({partID:"KERN000023",elP:µ.qd(root.cssReplKFxn("¶†table-a"))});
					root.registerAssert({rcvRoot:p.elKERNO["subKERN"+ID],portA:[[["rowHeightN"],["rowHeightN"]],[["rowA"],["rowA"]],[["kAllowExtraF"],["kAllowExtraF"]],[["kMetaEO"],["kMetaEO"]],[["westColStuckN"],["westColStuckN"]],[["eastColStuckN"],["eastColStuckN"]]]});
					core.registerRcvCallbackAssert("KERN_"+root.counter,(function(root,_){return function(dat){_.coreRcvFxn(dat);};})(root,_));
					},
				refresh_SUB   : function(){var root = this;var _ = this.o;},
				destroy_SUB : function(){var root = this;var _ = this.o;
					core.registerRcvCallbackDessert("KERN_"+root.counter);},
			};
			return oo;},
		};
})();
