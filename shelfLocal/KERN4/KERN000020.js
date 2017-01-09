(function(){
	KERN.partO["KERN000020"] = {
		gen : function(){
			var oo = {
				o : {
					// internal
					elO       : {},
					// imports and exports
					// utilities
					chartNew : function(){var root = this.root;var _ = this;
						root.ll("new chart -> ...");
						core.send({tbl:"chart",act:"new",
							dat:{
								titleS     :      (µ.qd(root.elP,root.cssReplKFxn("∑†slot-titleS input†new"       )).value),
								originS    :      (µ.qd(root.elP,root.cssReplKFxn("∑†slot-originS input†new"      )).value),
								infoAudioS :      (µ.qd(root.elP,root.cssReplKFxn("∑†slot-infoAudioS textarea†new")).value),
								infoS      :      (µ.qd(root.elP,root.cssReplKFxn("∑†slot-infoS textarea†new"     )).value),
								durationN  :   int(µ.qd(root.elP,root.cssReplKFxn("∑†slot-durationN input†new"    )).value*1000000,U,T),
								safeTri    : π.tri(µ.qd(root.elP,root.cssReplKFxn("∑†slot-safeTri input†new"      )).value),
								hN         :   int(µ.qd(root.elP,root.cssReplKFxn("∑†slot-hN input†new"           )).value,U,T),
								sN         :   int(µ.qd(root.elP,root.cssReplKFxn("∑†slot-sN input†new"           )).value,U,T),
								lN         :   int(µ.qd(root.elP,root.cssReplKFxn("∑†slot-lN input†new"           )).value,U,T),},
							flO:{
								txtR : µ.qd(root.elP,root.cssReplKFxn("∑†slot-txtR input[type='file']")).files[0],
								icoR : µ.qd(root.elP,root.cssReplKFxn("∑†slot-icoR input[type='file']")).files[0],},
							successFxn:(function(that){return function(o){var root = that;var _ = that.o;root.ll("new chart -> success");};})(root),
							failureFxn:(function(that){return function(o){var root = that;var _ = that.o;root.ll("new chart -> "+o.msg);};})(root),});
					},
					fill:function(){var root = this.root;var _ = this;
						root.ll("fill info -> ...");
						var chart = core.getRow("chart",int(µ.qd(root.elP,root.cssReplKFxn("∑†slot-chartID input†edt")).value,U,T));
						if (chart === N){
							root.ll("fill info -> delayed (waiting for server response)");
							//setTimeout((function(_){_.fill();})(_),1000); // !!! more official, tighter async loop
							return;}
						µ.qd(root.elP,root.cssReplKFxn("∑†slot-titleS input†new"       )).value = chart.titleS;
						root.ll("fill info -> success");
					},
					coreRcvFxn : function(dat){
						//ll("KERN000020:coreRcvFxn:",dat);
					},
				},
				portInA  : [],
				portOutA : [],
				//•ping - faux-class, actual name prepended with partID
				//†ping - faux-¥, actual name prepended with partID and something else
				//∑ - [standalone] of this partID
				//¶ - [standalone] of this instanceID
				genMultiCSSO : function(elMissingF){var root = this;var _ = this.o;return µ.cssO({
					"∑"       : "box-sizing:border-box;",//¥c:var(--c);
					"†root"   : "¥:relative;¥w:1000‰;¥h:1000‰;",
					"†root>*" : "¥w:1000‰;",
					"•title"  : "font-weight:bold;¥fs:140%;",
					"†axis"   : "font-weight:bold;¥fs:120%;",
					"†fill"   : "¥h:26px;",
					"•double-column" : "¥:block;¥w:400‰;",
					"•double-column>:nth-child(1)" : "¥:block;¥w:500‰;¥h:1000‰;¥f:left;",
					"•double-column>:nth-child(2)" : "¥:block;¥w:500‰;¥h:1000‰;¥f:left;",
					"†slot-chartID"    : "¥h:26px;",
					"†slot-titleS"     : "¥h:26px;",
					"†slot-originS"    : "¥h:26px;",
					"†slot-infoAudioS" : "¥h:52px;",
					"†slot-infoS"      : "¥h:52px;",
					"†slot-durationN"  : "¥h:26px;",
					"†slot-safeTri"    : "¥h:26px;",
					"†slot-hN"         : "¥h:26px;",
					"†slot-sN"         : "¥h:26px;",
					"†slot-lN"         : "¥h:26px;",
					"†slot-txtR"       : "¥h:26px;",
					"†slot-icoR"       : "¥h:26px;",
					"†submit"          : "¥h:26px;",
					"•brick"  : "¥w:1000‰;",
					"†head"   : "¥w:1000‰;¥h:89px;¥o:auto;",
					"†main"   : "¥w:1000‰;¥h:calc(1000‰ - 89px - 80px);¥o:auto;",
					"†foot"   : "¥w:1000‰;¥h:80px;¥o:auto;",
				});},
				genUniqueCSSO : function(elMissingF){var root = this;var _ = this.o;
					if (elMissingF || this.if("tx","co","bg")){
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
					µ.rr(this.elP,µ.m([[
						["†root",[
							["•brick†head",[
								["•brick",[
									["•title","Chart submitter/editor"],
								]],
								["•brick•double-column†axis",[
									["†new","New ↓ (may need to scroll)"],
									["†edt","Edit ↓ (may need to scroll)"],
								]],
								["•brick•double-column†slot-chartID",[
									µ.bscss("chartID",["input†new"+"[placeholder='automatically randomly generated'][disabled='']"],"†new"),
									µ.bscss("chartID",["input†edt"+"[placeholder='1199']"],"†edt"),
								]],
								["•brick•double-column†fill",[
									[],
									µ.bscss("Fill With Current Info",[".button†edt",{click:(function(that){return function(){var root = that;var _ = that.o;_.fill();};})(this)}],"†edt"),
								]],
							]],
							["•brick†main",[
								["•brick•double-column†slot-titleS",[
									µ.bscss("title",["input†new"+"[placeholder='Pallet Town']"],"†new"),
									µ.bscss("title",["input†edt"+"[placeholder='Pallet Town']"],"†edt"),
								]],
								["•brick•double-column†slot-originS",[
									µ.bscss("origin",["input†new"+"[placeholder='Pokémon Red/Blue']"],"†new"),
									µ.bscss("origin",["input†edt"+"[placeholder='Pokémon Red/Blue']"],"†edt"),
								]],
								["•brick•double-column†slot-infoAudioS",[
									µ.bscss("audio info",["textarea†new"+"[placeholder='Download the song from iTunes https://example.com/example']"],"†new"),
									µ.bscss("audio info",["textarea†edt"+"[placeholder='Download the song from iTunes https://example.com/example']"],"†edt"),
								]],
								["•brick•double-column†slot-infoS",[
									µ.bscss("info",["textarea†new"+"[placeholder='Original track from Pokémon Gen I, plays twice']"],"†new"),
									µ.bscss("info",["textarea†edt"+"[placeholder='Original track from Pokémon Gen I, plays twice']"],"†edt"),
								]],
								["•brick•double-column†slot-durationN",[
									µ.bscss("song duration (seconds)",["input†new"+"[placeholder='90']"],"†new"),
									µ.bscss("song duration (seconds)",["input†edt"+"[placeholder='90']"],"†edt"),
								]],
								["•brick•double-column†slot-safeTri",[
									µ.bscss("safe rating? (yes,uncertain,no)",["input†new"+"[placeholder='yes']"],"†new"),
									µ.bscss("safe rating? (yes,uncertain,no)",["input†edt"+"[placeholder='yes']"],"†edt"),
								]],
								["•brick•double-column†slot-hN",[
									µ.bscss("theme color hue (0-1000)",["input†new"+"[placeholder='200']"],"†new"),
									µ.bscss("theme color hue (0-1000)",["input†edt"+"[placeholder='200']"],"†edt"),
								]],
								["•brick•double-column†slot-sN",[
									µ.bscss("theme color saturation (0-1000)",["input†new"+"[placeholder='1000']"],"†new"),
									µ.bscss("theme color saturation (0-1000)",["input†edt"+"[placeholder='1000']"],"†edt"),
								]],
								["•brick•double-column†slot-lN",[
									µ.bscss("theme color lightness (0-1000)",["input†new"+"[placeholder='500']"],"†new"),
									µ.bscss("theme color lightness (0-1000)",["input†edt"+"[placeholder='500']"],"†edt"),
								]],
								["•brick•double-column†slot-txtR",[
									µ.bscss("chart notes file",["label",[
										["input.file[readonly=''][value='']"],
										["input[type='file']",{change:(function(that){return function(){µ.qud(this,"label",".file").value = this.files[0].name;};})(this)}],
									]],"†new"),
									µ.bscss("chart notes file",["label",[
										["input.file[readonly=''][value='']"],
										["input[type='file']",{change:(function(that){return function(){µ.qud(this,"label",".file").value = this.files[0].name;};})(this)}],
									]],"†edt"),
								]],
								["•brick•double-column†slot-icoR",[
									µ.bscss("icon image file",["label",[
										["input.file[readonly=''][value='']"],
										["input[type='file']",{change:(function(that){return function(){µ.qud(this,"label",".file").value = this.files[0].name;};})(this)}],
									]],"†new"),
									µ.bscss("icon image file",["label",[
										["input.file[readonly=''][value='']"],
										["input[type='file']",{change:(function(that){return function(){µ.qud(this,"label",".file").value = this.files[0].name;};})(this)}],
									]],"†edt"),
								]],
							]],
							["•brick†foot",[
								["•brick•double-column†submit",[
									µ.bscss("Submit",[".button†new",{click:(function(that){return function(){var root = that;var _ = that.o;_.chartNew();};})(this)}],"†new"),
									µ.bscss("Edit"  ,[".button†edt",{click:(function(that){return function(){var root = that;var _ = that.o;_.chartEdt();};})(this)}],"†edt"),
								]],
							]],
						]],
					]],[v=>this.cssReplKFxn(v),v=>this.cssReplKTagFxn(v)]));
					core.registerRcvCallbackAssert("KERN_"+root.counter,(function(root,_){return function(dat){_.coreRcvFxn(dat);};})(root,_));
					},
				refresh_SUB   : function(){var root = this;var _ = this.o;;},
				destroy_SUB : function(){var root = this;var _ = this.o;
					core.registerRcvCallbackDessert("KERN_"+root.counter);},
			};
			return oo;},
		};
})();
