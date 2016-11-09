<script id="KERN000008CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000008A,.KERN000008A *"                                 :"box-sizing:border-box;",
		".KERN000008A::-moz-selection,.KERN000008A *::-moz-selection" :"¥bgc:transparent;",
		".KERN000008A::selection,.KERN000008A *::selection"           :"¥bgc:transparent;",
		".KERN000008A"                                                :"¥:relative;¥s:1000‰;cursor:crosshair;¥bo:1px solid transparent;",
		".KERN000008AA"                                               :"¥:relative;¥s:1000‰;¥bo:1px solid transparent;border-collapse:collapse;",
		".KERN000008AA>tbody>tr>td"                                   :"¥bo:1px solid transparent;¥p:0px;",
		".KERN000008AAA"                                              :"¥:relative;",
		".KERN000008AAAA"                                             :"¥:absolute;¥:SW;",
		".KERN000008AAB"                                              :"¥:relative;",
		".KERN000008AABA"                                             :"¥:absolute;¥:SW;",
		".KERN000008AAC"                                              :"¥:relative;",
		".KERN000008AACA"                                             :"¥:absolute;¥:SW;",
		".KERN000008AAD"                                              :"¥:relative;",
		".KERN000008AADA"                                             :"¥:absolute;¥:SW;",
		};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000008"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000008A").forEach(el=>{el.KERN.refresh();});});
var KERN000008 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000008",
			o : {
				hValue      : 0,
				sValue      : 1,
				lValue      : 0.5,
				aValue      : 1,
				coValue     : [0,1,0.5,1], // ! make sure this matches the initial h,s,l,a values
				coValueS    : hsla([0,1,0.5,1]), // ! make sure this matches the initial h,s,l,a values
				tx          : [0,0,1  ],
				co          : [0,1,0.5],
				bg          : [0,0,0  ,1],
				orientation : "horizontal",
				// utilities
				feed        : function(that,e,type){var _ = that.o;
					if (_.orientation==="horizontal"){that.inbound({datA:[[type+"Value",(e.pageX - µ.offsetLeftTotal(_.elA[type])  )/_.elA[type].clientWidth ]]});}
					else                             {that.inbound({datA:[[type+"Value",(µ.offsetBottomTotal(_.elA[type]) - e.pageY)/_.elA[type].clientHeight]]});}},
				mousedown_h : N,
				mousedown_s : N,
				mousedown_l : N,
				mousedown_a : N,
				mousemove_h : N,
				mousemove_s : N,
				mousemove_l : N,
				mousemove_a : N,
				mouseup_h   : N,
				mouseup_s   : N,
				mouseup_l   : N,
				mouseup_a   : N,
				elA         : [],
			},
			validateFxnO : {
				hValue : function(_,base,access){_.hValue = π.rangeRestrict(_.hValue,0,1,0);},
				sValue : function(_,base,access){_.sValue = π.rangeRestrict(_.sValue,0,1,0);},
				lValue : function(_,base,access){_.lValue = π.rangeRestrict(_.lValue,0,1,0);},
				aValue : function(_,base,access){_.aValue = π.rangeRestrict(_.aValue,0,1,0);},
				orientation : function(_,base,access){if (typeof _.orientation !== "string" || !["horizontal","vertical"].includes(_.orientation)){_.orientation = "horizontal";}},
			},
			stabilize_SUB : function(){var _ = this.o;
				// giving coValue set priority over h,s,l,a individually
				if (this.if("coValue")){
					if (!isA(_.coValue) || _.coValue.length <= 2 || _.coValue.length >= 5){_.coValue = [0,0,0,0];}
					else if (_.coValue.length === 3){_.coValue.push(1);}
					// at this point, _.coValue.length === 4
					_.hValue = _.coValue[0];this.validateFxnO.hValue(_,_,"hValue");_.coValue[0] = _.hValue;
					_.sValue = _.coValue[1];this.validateFxnO.sValue(_,_,"sValue");_.coValue[1] = _.sValue;
					_.lValue = _.coValue[2];this.validateFxnO.lValue(_,_,"lValue");_.coValue[2] = _.lValue;
					_.aValue = _.coValue[3];this.validateFxnO.aValue(_,_,"aValue");_.coValue[3] = _.aValue;
					_.coValueS = hsla(_.coValue,_.aValue);
					this.changed({datA:[["coValue",_.coValue],["coValueS",_.coValueS]]});
					// this.outbound() will be called for us
					}
				else if (this.if("hValue","sValue","lValue","aValue")){
					_.coValue = [_.hValue,_.sValue,_.lValue,_.aValue];
					_.coValueS = hsla(_.coValue,_.aValue);
					this.changed({datA:[["coValue",_.coValue],["coValueS",_.coValueS]]});
					// this.outbound() will be called for us
					}
				if (this.if("orientation")){
					var mInner = (_.orientation==="horizontal")
						?[
							["tr",[
								["td.KERN000008AAA"+this.base+"[colspan='2']",{mousedown:_.mousedown_h},[
									[".KERN000008AAAA"+this.base],]],]],
							["tr",[
								["td.KERN000008AAB"+this.base,{mousedown:_.mousedown_s},[
									[".KERN000008AABA"+this.base],]],
								["td.KERN000008AAC"+this.base,{mousedown:_.mousedown_l},[
									[".KERN000008AACA"+this.base],]],]],
							["tr",[
								["td.KERN000008AAD"+this.base+"[colspan='2']",{mousedown:_.mousedown_a},[
									[".KERN000008AADA"+this.base],]],]],
						]
						:[
							["tr",[
								["td.KERN000008AAA"+this.base+"[rowspan='2']",{mousedown:_.mousedown_h},[
									[".KERN000008AAAA"+this.base],]],
								["td.KERN000008AAC"+this.base,{mousedown:_.mousedown_l},[
									[".KERN000008AACA"+this.base],]],
								["td.KERN000008AAD"+this.base+"[rowspan='2']",{mousedown:_.mousedown_a},[
									[".KERN000008AADA"+this.base],]],]],
							["tr",[
								["td.KERN000008AAB"+this.base,{mousedown:_.mousedown_s},[
									[".KERN000008AABA"+this.base],]],]],
						];
					µ.rr(this.elP,µ.m([[
						[".KERN000008A"+this.base,{z:{KERN:this}},[
							["table.KERN000008AA"+this.base,[
								["tbody",mInner],]],]]
					]]));
					_.elA.h = µ.qd(".KERN000008AAA"+this.base);
					_.elA.s = µ.qd(".KERN000008AAB"+this.base);
					_.elA.l = µ.qd(".KERN000008AAC"+this.base);
					_.elA.a = µ.qd(".KERN000008AAD"+this.base);}
			},
			setup_SUB : function(){var _ = this.o;
				// this is here because of JavaScript scoping, we need this KERN element from the context of window
				// though, the mousedown ones don't NEED to be here, but why not [all in one place, also marginally faster execution when done this way, without a .parentNode chain]
				_.mousedown_h = function(home){return function(e){var _ = home.o;window.addEventListener("mousemove",_.mousemove_h);window.addEventListener("mouseup",_.mouseup_h);_.feed(home,e,"h");};}(this);
				_.mousedown_s = function(home){return function(e){var _ = home.o;window.addEventListener("mousemove",_.mousemove_s);window.addEventListener("mouseup",_.mouseup_s);_.feed(home,e,"s");};}(this);
				_.mousedown_l = function(home){return function(e){var _ = home.o;window.addEventListener("mousemove",_.mousemove_l);window.addEventListener("mouseup",_.mouseup_l);_.feed(home,e,"l");};}(this);
				_.mousedown_a = function(home){return function(e){var _ = home.o;window.addEventListener("mousemove",_.mousemove_a);window.addEventListener("mouseup",_.mouseup_a);_.feed(home,e,"a");};}(this);
				_.mousemove_h = function(home){return function(e){var _ = home.o;_.feed(home,e,"h");};}(this);
				_.mousemove_s = function(home){return function(e){var _ = home.o;_.feed(home,e,"s");};}(this);
				_.mousemove_l = function(home){return function(e){var _ = home.o;_.feed(home,e,"l");};}(this);
				_.mousemove_a = function(home){return function(e){var _ = home.o;_.feed(home,e,"a");};}(this);
				_.mouseup_h   = function(home){return function(e){var _ = home.o;window.removeEventListener("mousemove",_.mousemove_h);window.removeEventListener("mouseup",_.mouseup_h);};}(this);
				_.mouseup_s   = function(home){return function(e){var _ = home.o;window.removeEventListener("mousemove",_.mousemove_s);window.removeEventListener("mouseup",_.mouseup_s);};}(this);
				_.mouseup_l   = function(home){return function(e){var _ = home.o;window.removeEventListener("mousemove",_.mousemove_l);window.removeEventListener("mouseup",_.mouseup_l);};}(this);
				_.mouseup_a   = function(home){return function(e){var _ = home.o;window.removeEventListener("mousemove",_.mousemove_a);window.removeEventListener("mouseup",_.mouseup_a);};}(this);},
			refresh_SUB  : function(){var _ = this.o;
				var h = _.hValue;
				var s = _.sValue;
				var l = _.lValue;
				var a = _.aValue;
				var gradientRainbow = π.a(0,24).map(v=>hsla([v/24,s,l],a)).join(",");
				var dimensionPrimary   = (_.orientation === "horizontal") ? "w" : "h";
				var dimensionSecondary = (_.orientation === "horizontal") ? "h" : "w";
				var deg = (_.orientation === "horizontal") ? 90 : 0;
				var s = µ.cssCompile({
					[".KERN000008A"   +this.base] : "¥bc:"+hsla(_.coValue)+";",
					[".KERN000008AAA" +this.base] : "¥bgi:linear-gradient("+deg+"deg,"+gradientRainbow+");"                                          +((_.orientation==="horizontal")?"¥w:1000‰;¥h:360‰;":"¥h:1000‰;¥w:450‰;"), // ??? magic - maybe tables scale percents?
					[".KERN000008AAAA"+this.base] : "¥"+dimensionSecondary+":1000‰;¥"+dimensionPrimary+":"+(_.hValue*1000)+"‰;¥b"+(_.orientation==="horizontal"?"r":"t")+":1px solid "+hsla(_.tx)+";",
					[".KERN000008AAB" +this.base] : "¥bgi:linear-gradient("+deg+"deg,"+hsla([h,0,l],a)+","+hsla([h,1,l],a)+");"                      +((_.orientation==="horizontal")?"¥w: 500‰;¥h:360‰;":"¥h: 500‰;¥w:450‰;"), // ??? magic - maybe tables scale percents?
					[".KERN000008AABA"+this.base] : "¥"+dimensionSecondary+":1000‰;¥"+dimensionPrimary+":"+(_.sValue*1000)+"‰;¥b"+(_.orientation==="horizontal"?"r":"t")+":1px solid "+hsla(_.tx)+";",
					[".KERN000008AAC" +this.base] : "¥bgi:linear-gradient("+deg+"deg,"+hsla([h,s,0],a)+","+hsla([h,s,0.5],a)+","+hsla([h,s,1],a)+");"+((_.orientation==="horizontal")?"¥w: 500‰;¥h:360‰;":"¥h: 500‰;¥w:450‰;"), // ??? magic - maybe tables scale percents?
					[".KERN000008AACA"+this.base] : "¥"+dimensionSecondary+":1000‰;¥"+dimensionPrimary+":"+(_.lValue*1000)+"‰;¥b"+(_.orientation==="horizontal"?"r":"t")+":1px solid "+hsla(_.tx)+";",
					[".KERN000008AAD" +this.base] : "¥bgi:linear-gradient("+deg+"deg,"+hsla([h,s,l,0],0)+","+hsla([h,s,l,1],1)+");"                  +((_.orientation==="horizontal")?"¥w:1000‰;¥h:300‰;":"¥h:1000‰;¥w:350‰;"), // ??? magic - maybe tables scale percents?
					[".KERN000008AADA"+this.base] : "¥"+dimensionSecondary+":1000‰;¥"+dimensionPrimary+":"+(_.aValue*1000)+"‰;¥b"+(_.orientation==="horizontal"?"r":"t")+":1px solid "+hsla(_.tx)+";",
				});
				var maF = µ.maCSS(document.head,this.base,s);},
		});
		oo.portInP .pushA([["hValue",KERNTypeO.number],["sValue",KERNTypeO.number],["lValue",KERNTypeO.number],["aValue",KERNTypeO.number],["orientation",KERNTypeO.string],["coValue",KERNTypeO.complex]]);
		oo.portOutP.pushA([["hValue",KERNTypeO.number],["sValue",KERNTypeO.number],["lValue",KERNTypeO.number],["aValue",KERNTypeO.number],["orientation",KERNTypeO.string],["coValue",KERNTypeO.complex],["coValueS",KERNTypeO.string]]);
		return oo;},
	};
</script>
