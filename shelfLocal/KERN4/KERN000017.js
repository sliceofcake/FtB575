document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000017A,.KERN000017A *"                                :"box-sizing:border-box;",
		".KERN000017A::-moz-selection,.KERN000017A *::-moz-selection":"¥bgc:transparent;",
		".KERN000017A::selection,.KERN000017A *::selection"          :"¥bgc:transparent;",
		".KERN000017A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000017AA"                                              :"¥:block;¥s:1000‰;",
		".KERN000017AAA"                                             :"¥:block;¥s:1000‰;",
		".KERN000017AAB"                                             :"",
	};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000017"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000017A").forEach(el=>{el.KERN.refresh();});});
var KERN000017 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name : "KERN000017",
			o : {
				tx        : [0,0,1  ],
				co        : [0,1,0.5],
				bg        : [0,0,0  ,1],
				elO       : {},
				intervalHandleMessageGet : N,
				channelID :  0,
				datNeeded : {},
				// utilities
			},
			stabilize_SUB : function(){var _ = this.o;},
			setup_SUB     : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000017A"+this.base,{z:{KERN:this}},[
						["textarea.KERN000017AA"+this.base,[]],
						[".KERN000017AB"+this.base,[]],
					]],
				]]));
				_.intervalHandleMessageGet = π.intervalCall(1000000,(function(that){return function(){var _ = that.o;
					core.send({tbl:"n/a",act:"FtB575_1|get_messageIDA",fxn:(function(that){return function(pak){var _ = that.o;
						_.datNeeded["message"] = pak.dat.messageIDA;
						µ.rr(that.elO.ab,µ.m([
							pak.dat.messageIDA.map(messageID=>{
								var message = core.getRow("message",messageID);
								return ["",message.userID+">"+message.text];
							})
						]));
					};})(that)});
				};})(this));
				
				_.elO.ab = µ.qd(".KERN000017AB" +this.base);},
			refresh_SUB   : function(){var _ = this.o;
//				µ.maCSS(document.head,this.base,µ.cssCompile({
//					//[".KERN000017AA"+this.base] : "¥c:"+hsla(_.tx)+";¥fs:"+_.fs+"px;"+(_.lineWrap?"white-space:nowrap;":"white-space:normal;"),
//				}));
			},
			destroy_SUB : function(){var _ = this.o;
				π.intervalClear(_.intervalHandleMessageGet);},
		});
		oo.portInP .pushA([["channelID",KERNTypeO.number]]);
		oo.portOutP.pushA([]);
		return oo;},
	};
