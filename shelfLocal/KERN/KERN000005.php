<script id="KERN000005CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000005A,.KERN000005A *"                                :"box-sizing:border-box;",
		".KERN000005A::-moz-selection,.KERN000005A *::-moz-selection":"¥bgc:transparent;",
		".KERN000005A::selection,.KERN000005A *::selection"          :"¥bgc:transparent;",
		".KERN000005A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000005AA"                                              :"¥:absolute;",
		".KERN000005AAA"                                             :"¥:absolute;",
		".KERN000005AC"                                              :"¥:absolute;¥:NW;¥s:1000‰;pointer-events:none;display:flex;align-items:center;justify-content:center;",};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000005"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000005A").forEach(el=>{el.KERN.refresh();});});
// Min  Root      Max
// |----|-----------|
// |----XXXXX-------| ->dir:East
// |----|-----------|
//  neg‰ pos‰-------
//
//
var KERN000005 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000005",
			o : {
				min       : 0,
				max       : 10,
				// make sure that min and max land on a snap
				snap      : 1,
				value     : 0,
				valueValidSignal : F, // flip when value is being set - used because if value is not continuously driving, receivers need to know when to ignore/pay-attention
				dirAsc    : "E", // the direction that the bar progresses when the value ascends
				valueFxn  : v=>"", // when showing the current value as an overlay, what pre-processing function to use, to disable, return empty string
				ascMode   : "additive", // one of ["additive","multiplicative"]
				ascRoot   : U, // where the ascender function is based from
				incSignal : N,
				decSignal : N,
				n         : 0,
				nMin      : 0,
				nMax      : 0,
				tx        : [0,0,1  ],
				co        : [0,1,0.5],
				bg        : [0,0,0  ,1],
				el_aa     : N,
				el_aaa    : N,
				el_ac     : N,
				side_aa   : 0,
				side_ab   : 0,
				snapDecimalPlaceC : 0,
				// utilities
				feed : function(that,e){var _ = that.o;
					var el = µ.ic(that.elP)[0];
					switch (_.dirAsc){default:;
						/****/case "N" : var part = (µ.offsetBottomTotal(el) - e.pageY)/el.clientHeight;
						break;case "E" : var part = (e.pageX - µ.offsetLeftTotal(el)  )/el.clientWidth ;
						break;case "S" : var part = (e.pageY - µ.offsetTopTotal (el)  )/el.clientHeight;
						break;case "W" : var part = (µ.offsetRightTotal (el) - e.pageX)/el.clientWidth ;}
					//if (part < _.side_aa){ll("AA");}
					//else{ll("AB");}
					var n = part*(_.nMax-_.nMin)+_.nMin;
					switch (_.ascMode){default:;
						break;case "additive"      :var value = _.ascRoot+(_.snap*Math.round(n));
						break;case "multiplicative":var value = _.ascRoot*Math.pow(_.snap,Math.round(n));}
					that.inbound({datA:[["value",value]]});
					_.valueValidSignal=!_.valueValidSignal;that.changed({datA:[["valueValidSignal",_.valueValidSignal]]});that.outbound();},
				mousedown : function(e){var _ = this.KERN.o;
					window.addEventListener("mousemove",_.mousemove);
					window.addEventListener("mouseup"  ,_.mouseup  );
					_.feed(this.KERN,e);},
				mousemove : N,
				mouseup   : N,
			},
			validateFxnO : {
				value : function(_,base,access){_.value = π.rangeRestrict(_.value,_.min,_.max,_.ascRoot);},
			},
			stabilize_SUB  : function(){var _ = this.o;
				var outboundF = F;
				if (typeof _.ascRoot === "undefined"){_.ascRoot = _.min;}
				if (this.if("incSignal")){
					_.value += _.snap;
					_.valueValidSignal=!_.valueValidSignal;
					this.changed({datA:[["value",_.value],["valueValidSignal",_.valueValidSignal]]});
					outboundF = T;}
				if (this.if("decSignal")){
					_.value -= _.snap;
					_.valueValidSignal=!_.valueValidSignal;
					this.changed({datA:[["value",_.value],["valueValidSignal",_.valueValidSignal]]});
					outboundF = T;}
				// instance 1 of 2, for easing processing next
				if (_.value < _.min){_.value = _.min;}else if (_.value > _.max){_.value = _.max;}
				// follow the snaps
				switch (_.ascMode){default:;
					break;case "additive"       :
						var n = (_.value-_.ascRoot)/_.snap; // solved for n, the multiplicative distance away from root
						_.value = _.ascRoot+(_.snap*Math.round(n));
					break;case "multiplicative" :
						var n = Math.log(_.value/_.ascRoot)/Math.log(_.snap); // solved for n, the exponential distance away from root
						_.value = _.ascRoot*Math.pow(_.snap,Math.round(n));}
				// fix funky decimal values like 1.00000000000005
				_.snapDecimalPlaceC = π.getDecimalPlaceC(_.snap);
				if (_.snapDecimalPlaceC !== 0){
					var c = Math.pow(10,_.snapDecimalPlaceC);
					//ll(Math.round(_.value*c),c,_.value);
					_.value = Math.round(_.value*c)/c;}
				// instance 2 of 2, for the actual validation
				if (_.value < _.min){_.value = _.min;}else if (_.value > _.max){_.value = _.max;}
				
				// ----
				// derive below
				
				if (this.if("value","min","max","snap")){
					switch (_.ascMode){default:;
						break;case "additive"       :
							// solved for n, the multiplicative distance away from root
							_.n    = (_.value-_.ascRoot)/_.snap;
							_.nMin = (_.min  -_.ascRoot)/_.snap;
							_.nMax = (_.max  -_.ascRoot)/_.snap;
						break;case "multiplicative" :
							// solved for n, the exponential distance away from root
							_.n    = Math.log(_.value/_.ascRoot)/Math.log(_.snap);
							_.nMin = Math.log(_.min  /_.ascRoot)/Math.log(_.snap);
							_.nMax = Math.log(_.max  /_.ascRoot)/Math.log(_.snap);}
					// AA covers the displayable area [either negative or positive side]
					// AB covers the actual bar within that area
					_.side_aa = Math.abs(_.nMin)/(_.nMax-_.nMin); // _.nRoot is 0, by definition of the n-series
					_.side_ab = 1-_.side_aa;}
				if (outboundF){
					this.outbound();}
			},
			setup_SUB : function(){var _ = this.o;
				_.mousemove = function(that){
					return function(e){var _ = that.o;
						if (Ω.mousedownF){_.feed(that,e);}};
				}(this);
				_.mouseup = function(that){
					return function(e){var _ = that.o;
						window.removeEventListener("mousemove",_.mousemove);
						window.removeEventListener("mouseup"  ,_.mouseup  );};
				}(this);
				µ.rr(this.elP,µ.m([[
					[".KERN000005A"+this.base,{z:{KERN:this},mousedown:_.mousedown},[
						[".KERN000005AA"+this.base,[
							[".KERN000005AAA"+this.base],]],
						[".KERN000005AC"+this.base],
					]]
				]]));
				_.el_aa  = µ.qd(".KERN000005AA" +this.base);
				_.el_aaa = µ.qd(".KERN000005AAA"+this.base);
				_.el_ac  = µ.qd(".KERN000005AC" +this.base);},
			refreshResize_SUB   : function(){var _ = this.o;},
			refresh_SUB   : function(){var _ = this.o;
				switch (_.dirAsc){default:;
					/****/case "N" : var pos_aa = "S";var pos_ab = "N";var unit = "h";var unitOther = "w";var deg =   0;var degTxt = 270;
					break;case "E" : var pos_aa = "W";var pos_ab = "E";var unit = "w";var unitOther = "h";var deg =  90;var degTxt =   0;
					break;case "S" : var pos_aa = "N";var pos_ab = "S";var unit = "h";var unitOther = "w";var deg = 180;var degTxt = 270;
					break;case "W" : var pos_aa = "E";var pos_ab = "W";var unit = "w";var unitOther = "h";var deg = 270;var degTxt =   0;}
				var magnitude_aaa = Math.abs(_.n)/(_.nMax-_.nMin)*1000;
				if (_.n < 0){magnitude_aaa /= _.side_aa;}
				else        {magnitude_aaa /= _.side_ab;}
				µ.maCSS(document.head,this.base,µ.cssCompile({
					[".KERN000005AA" +this.base] : "¥:"+(_.n<0?pos_aa:pos_ab)+";¥"+unit+":"+((_.n<0?_.side_aa:_.side_ab)*1000)+"‰;¥"+unitOther+":1000‰;",
					[".KERN000005AAA"+this.base] : "¥:"+(_.n<0?pos_ab:pos_aa)+";¥"+unit+"min:1px;¥"+unit+":"+magnitude_aaa+"‰;¥"+unitOther+":1000‰;¥bgi:linear-gradient("+(Math.sign(_.n)*deg)+"deg,"+hslma(_.co,_.bg,0.7)+","+hslma(_.co,_.tx,0.9)+");",
					[".KERN000005AC" +this.base] : "transform:rotate("+degTxt+"deg);",
				}));
				if (_.el_ac !== N){_.el_ac.innerHTML = str(_.valueFxn(_.value,_.snapDecimalPlaceC,_));}},
		});
		oo.portInP .pushA([["value",KERNTypeO.number],["incSignal",KERNTypeO.signal],["decSignal",KERNTypeO.signal],["min",KERNTypeO.number],["max",KERNTypeO.number],["snap",KERNTypeO.number],["dirAsc",KERNTypeO.string],["valueFxn",KERNTypeO.function],["ascMode",KERNTypeO.string],["ascRoot",KERNTypeO.string]]);
		oo.portOutP.pushA([["value",KERNTypeO.number],["valueValidSignal",KERNTypeO.signal]]);
		return oo;},
	};
</script>
