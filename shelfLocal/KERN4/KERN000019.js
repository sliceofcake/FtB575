(function(){
	KERN.partO["KERN000019"] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					elO       : {},
					chartIDA : [],
					// imports and exports
					// utilities
					chartIDAGet : function(){var root = this.root;var _ = this;
						root.ll("get chart list -> ...");
						core.send({tbl:"n/a",act:"FtB575_1|chart_list",
							successFxn:(function(that){return function(o){
								root.ll("get chart list -> success");
								_.chartIDA = o.dat.chartIDA;
								_.fill();
							};})(root,_),
							failureFxn:(function(that){return function(o){var root = that;var _ = that.o;root.ll("get chart list -> "+o.msg);};})(root),});
					},
					fill:function(){var root = this.root;var _ = this;
						root.ll("fill info -> ...");
						ll(_.chartIDA);
						var elA = _.chartIDA.map(chartID=>{
							var chart = core.getRow("chart",chartID);
							if (chart === N){
								return ["†chart-card†multi-column",[
									["†slot-ID"             ,""],
									["†slot-userID"         ,""],
									["†slot-titleS"         ,""],
									["†slot-originS"        ,""],
									["†slot-durationN"      ,""],
									["†slot-npsN_DERIVED"   ,""],
									["†slot-formatS_DERIVED",""],
									["†slot-laneC_DERIVED"  ,""],
								]];}
							else{
								var user_charter = core.getRow("user",chart.userID);
								return ["†chart-card†multi-column",[
									["†slot-ID"             ,chart.ID             ],
									["†slot-userID"         ,(user_charter===N?"":user_charter.nameS)],
									["†slot-titleS"         ,chart.titleS         ],
									["†slot-originS"        ,chart.originS        ],
									["†slot-durationN"      ,Math.ceil(chart.durationN/1000000)],
									["†slot-npsN_DERIVED"   ,chart.npsN_DERIVED   ],
									["†slot-formatS_DERIVED",chart.formatS_DERIVED],
									["†slot-laneC_DERIVED"  ,chart.laneC_DERIVED  ],
								]];}
						});
						ll(elA);
						µ.rr(µ.qd(root.elP,root.cssReplKFxn("¶†root>†main")),µ.m([elA],[v=>root.cssReplKFxn(v),v=>root.cssReplKTagFxn(v)]));
						root.ll("fill info -> success");
					},
				},
				portInA  : [],
				portOutA : [],
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
					"†multi-column:nth-child(1)" : "¥:flex-row;¥pt:"+py+"px;",
					"†multi-column"   : "¥pb:"+py+"px;",
					"†multi-column>*" : "¥f:left;¥pr:"+px+"px;¥hmin:1px;", // ¥hmin:1px hack to have width on empty element
					"†multi-column>:nth-child(1)" : "¥float:left;¥pl:"+px+"px;",
					"†multi-column>†slot-ID"              : "¥w:"+(wO.ID            +px+px)+"px;text-align:right;¥:one-row;",
					"†multi-column>†slot-userID"          : "¥w:"+(wO.userID           +px)+"px;text-align:left;¥:one-row;",
					"†multi-column>†slot-titleS"          : "¥w:"+(wO.titleS              )+  ";text-align:left;¥:one-row;",
					"†multi-column>†slot-originS"         : "¥w:"+(wO.originS             )+  ";text-align:left;¥:one-row;",
					"†multi-column>†slot-durationN"       : "¥w:"+(wO.durationN_DERIVED+px)+"px;text-align:right;¥:one-row;",
					"†multi-column>†slot-npsN_DERIVED"    : "¥w:"+(wO.npsN_DERIVED     +px)+"px;text-align:right;¥:one-row;",
					"†multi-column>†slot-formatS_DERIVED" : "¥w:"+(wO.formatS_DERIVED  +px)+"px;text-align:left;¥:one-row;",
					"†multi-column>†slot-laneC_DERIVED"   : "¥w:"+(wO.laneC_DERIVED    +px)+"px;text-align:right;¥:one-row;",
					"†head"   : "¥w:1000‰;¥h:89px;¥o:auto;",
					"†main"   : "¥w:1000‰;¥h:calc(1000‰ - 89px - 0px);¥o:auto;",
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
								["•brick†multi-column",[
									["†slot-ID"             ,"ID"              ],
									["†slot-userID"         ,"uploader"        ],
									["†slot-titleS"         ,"song title"      ],
									["†slot-originS"        ,"song origin"     ],
									["†slot-durationN"      ,"◷"     ],
									["†slot-npsN_DERIVED"   ,"♪/◷"   ],
									["†slot-formatS_DERIVED","format"],
									["†slot-laneC_DERIVED"  ,"◨"     ],
								]],
							]],
							["•brick†main",[]],
							["•brick†foot",[]],
							
						]],
					]],[v=>root.cssReplKFxn(v),v=>root.cssReplKTagFxn(v)]));
					},
				refresh_SUB   : function(){var root = this;var _ = this.o;},
				destroy_SUB : function(){var root = this;var _ = this.o;},
			};
			return oo;},
		};
})();
