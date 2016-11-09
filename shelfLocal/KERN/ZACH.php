<script id="ZACH">
//var _log = lld();
var _log = ()=>{};
// FtB-specific KERN wrapper
var ZACH = {
	// elP contains the element. elPP contains elP. make a new part with partID given, return it
	new : function(o={}){π.p(o,{mode:"layer"});
		switch (o.mode){default : ;
			break;case "layer" :
				var now = Math.ceil(π.now()/1000);
				var dif = 0;
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("A ... "+dif);
				π.p(o,{partID:"",elP:N,initial:{},title:"",style:{},inboundAllF:F,outboundAllF:F,inboundAllPortA:[],outboundAllPortA:[]});
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("B ... "+dif);
				if (typeof window[o.partID]     === "undefined"){ll("ZACH ERROR : part:"+o.partID+" not found");return undefined;}
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("C ... "+dif);
				if (typeof window[o.partID].gen !== "function" ){ll("ZACH ERROR : part:"+o.partID+" doesn't have a gen() function");return undefined;}
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("D ... "+dif);
				var res = window[o.partID].gen();
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("E ... "+dif);
				res.inboundAllF  = o.inboundAllF ;
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("F ... "+dif);
				res.outboundAllF = o.outboundAllF;
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("G ... "+dif);
				res.inboundAllPortA  = o.inboundAllPortA ;
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("H ... "+dif);
				res.outboundAllPortA = o.outboundAllPortA;
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("I ... "+dif);
				var ID  = "KERN_"+res.counter;
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("J ... "+dif);
				var elLayer  = µ.m([".layer¥"+ID]);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("K ... "+dif);
				var elHandle = µ.m([".handle¥"+ID,[
					["span",o.title],
					["span.faded",res.name.replace(/KERN0*/,"K").replace(/_/,"#")+"_"+res.counter]]]);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("L ... "+dif);
				var elElse   = µ.m(["¥"+ID]);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("M ... "+dif);
				µ.ma(o.elP,elLayer);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("N ... "+dif);
				µ.ma(elLayer,elHandle);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("O ... "+dif);
				µ.ma(elLayer,elElse);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("P ... "+dif);
				res.setup({elP:elElse,datA:o.initial});
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("Q ... "+dif);
				panflo.register(ID,{panel:elLayer,handle:elHandle});
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("R ... "+dif);
				elLayer.addEventListener("resize",()=>{res.refreshResize();res.refresh();});
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("S ... "+dif);
				var rr = π.reductionRatio(p.rrx,p.rry);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("T ... "+dif);
				var fxnFilter = m=>Math.ceil(m);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("U ... "+dif);
				var rrn = (n)=>fxnFilter(rr*n);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("V ... "+dif);
				var handleH = rrn(p.handleH_base);
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("W ... "+dif);
				// ! handle width-height before top-left
				π.p(o.style,{w:π.rand(100,200),h:π.rand(100,200),z:1});
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("X ... "+dif);
				if (typeof o.style.z === "undefined"){o.style.z = getComputedStyle(elLayer).getPropertyValue("z-index");}
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("Y ... "+dif);
				π.ooas(elLayer.style,{width:o.style.w+"px",height:o.style.h+handleH+"px",zIndex:o.style.z});
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("Z ... "+dif);
				// performance boost due to dodging layout trashing
				if (typeof o.style.t === "undefined"){o.style.t = π.rand(0,window.innerHeight-elLayer.offsetHeight);}
				if (typeof o.style.l === "undefined"){o.style.l = π.rand(0,window.innerWidth -elLayer.offsetWidth );}
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("a ... "+dif);
				π.ooas(elLayer.style,{top:o.style.t+"px",left:o.style.l+"px"});
																														dif = (dif=(-1*(now-(now=Math.ceil(π.now()/1000)))));dif>1&&_log("b ... "+dif);
				res.refreshResize();
				return res;
			break;case "embed" :
				π.p(o,{partID:"",elP:N,initial:{},inboundAllF:F,outboundAllF:F,inboundAllPortA:{},outboundAllPortA:{}});
				if (typeof window[o.partID]     === "undefined"){ll("ZACH ERROR : part:"+o.partID+" not found");return undefined;}
				if (typeof window[o.partID].gen !== "function" ){ll("ZACH ERROR : part:"+o.partID+" doesn't have a gen() function");return undefined;}
				var res = window[o.partID].gen();
				res.inboundAllF  = o.inboundAllF ;
				res.outboundAllF = o.outboundAllF;
				res.inboundAllPortA  = o.inboundAllPortA ;
				res.outboundAllPortA = o.outboundAllPortA;
				var ID = res.name+"_"+res.counter;
				var el_a  = µ.m(["¥"+ID]);
				µ.ma(o.elP,el_a);
				res.setup({elP:o.elP,datA:o.initial});
				return res;
			}},
};
</script>
