(function(){
	KERN.partO["KERN000018"] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					elO       : {},
					user_plushieID : 0,
					// imports and exports
					userID         : 0,
					// utilities
					whoAmISuccessFxn : function(o){var root = this.root;var _ = this;
						_.userID         = o.dat.userID;
						_.user_plushieID = o.dat.user_plushieID;
						root.changed(["userID"]);
						root.export();
						this.userCardRenderFxn();},
					whoAmIFailureFxn : function(o){var root = this.root;var _ = this;
						_.userID         = 0;
						_.user_plushieID = 0;
						root.changed(["userID"]);
						root.export();},
					userCardRenderFxn : function(){var root = this.root;var _ = this;//ll("userCardRenderFxn");
						var user = _.userID===0?N:core.getRow("user",_.userID);
						var el = µ.qd(root.cssReplKFxn("∑†user-card>†user-card>†info"));
						if (user === N){el.textContent = "";return;}
						//{"ID":6349748301655246,"nameS":"sliceofcake","hTxN":346,"sTxN":1000,"lTxN":1000,"aTxN":1000,"hCoN":346,"sCoN":1000,"lCoN":500,"aCoN":1000,"hBgN":346,"sBgN":0,"lBgN":0,"aBgN":900,"bioS":"","divisionS":"","t0":1477628863376625}
						el.innerHTML
						="ID : "+user.ID+"<br>"
						+"username : "+user.nameS+"<br>"
						+"text color : hsla("+user.hTxN+"‰,"+user.sTxN+"‰,"+user.lTxN+"‰,"+user.aTxN+"‰)<br>"
						+"main color : hsla("+user.hCoN+"‰,"+user.sCoN+"‰,"+user.lCoN+"‰,"+user.aCoN+"‰)<br>"
						+"background color : hsla("+user.hBgN+"‰,"+user.sBgN+"‰,"+user.lBgN+"‰,"+user.aBgN+"‰)<br>";},
					coreRcvFxn : function(dat){
						//ll("KERN000018:coreRcvFxn:",dat);
					},
				},
				portInA  : [],
				portOutA : [["userID",KERN.typeO.number]],
				//•ping - faux-class, actual name prepended with partID
				//†ping - faux-¥, actual name prepended with partID and something else
				//∑ - [standalone] of this partID
				//¶ - [standalone] of this instanceID
				genMultiCSSO : function(elMissingF){var root = this;var _ = this.o;return µ.cssO({
					"∑"      : "box-sizing:border-box;",//¥c:var(--c);
					"†root"  : "¥:relative;¥w:1000‰;¥h:1000‰;",
					"•brick" : "¥w:1000‰;",
					"•title" : "font-weight:bold;",
					"•auth-container>:nth-child(1)" : "¥w:1000‰;",
					"•auth-container>:nth-child(2)" : "¥w:400‰;",
					"•auth-container>:nth-child(3)" : "¥w:400‰;",
					"•auth-container>:nth-child(4)" : "¥w:200‰;",
					
					"•brick†main":"¥h:calc(1000‰ - 80px);¥o:auto;",
					"•brick†user-card":"¥h:80px;",
					"•brick†user-card>†user-card":"¥h:1000‰;",
					"•brick†user-card>†user-card>†icon":"¥f:left;¥h:1000‰;¥w:80px;¥bgi:url(../image/favicon.png);¥bgs:cover;¥bgp:center center;",
					"•brick†user-card>†user-card>†info":"¥f:left;¥h:1000‰;¥w:calc(1000‰ - 80px);¥o:hidden;",
				});},
				genUniqueCSSO : function(elMissingF){var root = this;var _ = this.o;
					if (elMissingF || this.if("tx","co","bg")){
						return µ.cssO({
							"¶†root"      : ø.genCSSVarS({tx:_.tx,co:_.co,bg:_.bg}),
							"¶†axis"      : "¥c:"+hslma(_.tx,_.co,0.8)+";",
							"¶•title"     : "¥c:"+hslma(_.co,_.tx,0.8)+";",
							"¶†user-card" : "¥bgc:"+hslma(_.bg,_.co,0.8,_.bg[3])+";",
							"¶†main"      : "¥bgc:"+hsla (_.bg         ,_.bg[3])+";",
						});}
					else{
						return null;}},
				validateFxnO : {},
				stabilize_SUB : function(){var root = this;var _ = this.o;},
				setup_SUB     : function(){var root = this;var _ = this.o;
					µ.rr(this.elP,µ.m([[
						["†root",[
							["•brick†user-card",[
								["†user-card",[
									["†icon"],
									["†info"],
								]],
							]],
							["•brick†main",[
								["•brick•auth-container†signin-username",[
									["•title","Sign in with username"],
									µ.bscss("username",["input[placeholder='sliceofcake']"],"†username"),
									µ.bscss("password",["input[placeholder='secretstrawberrycake'][type='password']"],"†password"),
									µ.bscss("Sign In" ,[".button",{click:(function(that){return function(){var root = that;var _ = that.o;
										root.ll("sign in w/username -> ...");
										core.send({tbl:"n/a",act:"FtB575_1|plushie_gen",dat:{nameS:µ.qud(this,root.cssReplKFxn("•auth-container"),root.cssReplKFxn("†username>input")).value,passwordS:µ.qud(this,root.cssReplKFxn("•auth-container"),root.cssReplKFxn("†password>input")).value},
											successFxn:(function(that){return function(o){var root = that;var _ = that.o;
												root.ll("sign in w/username -> success");
												core.who = o.dat.ID;
												core.plu = o.dat.plu;
												core.send({tbl:"n/a",act:"FtB575_1|who_am_i",
													successFxn:o=>{_.whoAmISuccessFxn(o);},
													failureFxn:o=>{_.whoAmIFailureFxn(o);},});
											};})(that),
											failureFxn:(function(that){return function(o){var root = that;var _ = that.o;
												root.ll("sign in w/username -> failure ; "+o.msg);
												core.send({tbl:"n/a",act:"FtB575_1|who_am_i",
													successFxn:o=>{_.whoAmISuccessFxn(o);},
													failureFxn:o=>{_.whoAmIFailureFxn(o);},});
											};})(that),});
									};})(this)}],"†button"),
								]],
								["•brick•auth-container†signin-userid",[
									["•title","Sign in with userID"],
									µ.bscss("userID"  ,["input[placeholder='sliceofcake']"],"†userid"),
									µ.bscss("password",["input[placeholder='secretstrawberrycake'][type='password']"],"†password"),
									µ.bscss("Sign In" ,[".button",{click:(function(that){return function(){var root = that;var _ = that.o;
										root.ll("sign in w/userID -> ...");
										core.send({tbl:"n/a",act:"FtB575_1|plushie_gen",dat:{ID:µ.qud(this,root.cssReplKFxn("•auth-container"),root.cssReplKFxn("†userid>input")).value,passwordS:µ.qud(this,root.cssReplKFxn("•auth-container"),root.cssReplKFxn("†password>input")).value},
											successFxn:(function(that){return function(o){var root = that;var _ = that.o;
												root.ll("sign in w/userID -> success");
											};})(that),
											failureFxn:(function(that){return function(o){var root = that;var _ = that.o;
												root.ll("sign in w/userID -> failure : "+o.msg);
											};})(that),});
									};})(this)}],"†button"),
								]],
								["•brick•auth-container†signup-username",[
									["•title","Sign up"],
									µ.bscss("username",["input[placeholder='sliceofcake']"],"†username"),
									µ.bscss("password",["input[placeholder='secretstrawberrycake'][type='password']"],"†password"),
									µ.bscss("Sign Up" ,[".button",{click:(function(that){return function(){var root = that;var _ = that.o;
										root.ll("sign up w/username -> ...");
										core.send({tbl:"user",act:"new",dat:{nameS:µ.qud(this,root.cssReplKFxn("•auth-container"),root.cssReplKFxn("†username>input")).value,passwordS:µ.qud(this,root.cssReplKFxn("•auth-container"),root.cssReplKFxn("†password>input")).value},
											successFxn:(function(that){return function(o){var root = that;var _ = that.o;
												root.ll("sign up w/username -> success");
											};})(that),
											failureFxn:(function(that){return function(o){var root = that;var _ = that.o;
												root.ll("sign up w/username -> failure : "+o.msg);
											};})(that),});
									};})(this)}],"†button"),
								]],
							]],
						]],
					]],[v=>this.cssReplKFxn(v),v=>this.cssReplKTagFxn(v)]));
					_.intervalHandleMessageGet = π.intervalCall(5000000,()=>{var root = this;var _ = this.o;
						core.send({tbl:"n/a",act:"KERN|who_am_i",
							successFxn:o=>{_.whoAmISuccessFxn(o);},
							failureFxn:o=>{_.whoAmIFailureFxn(o);},});
					});
					core.registerRcvCallbackAssert("KERN_"+root.counter,(function(root,_){return function(dat){_.coreRcvFxn(dat);};})(root,_));
					},
				refresh_SUB   : function(){var root = this;var _ = this.o;},
				destroy_SUB : function(){var root = this;var _ = this.o;
					core.registerRcvCallbackDessert("KERN_"+root.counter);
					π.intervalClear(_.intervalHandleMessageGet);},
			};
			return oo;},
		};
})();
