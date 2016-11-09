<script id="KERN">
// to create a KERN element, append key-value pairs to a KERN() instance
// this way, we can keep track of all registered KERN elements here
var KERNCounter = 1;
var KERNA = [];
var KERNDump = function(){KERNA.forEach(v=>{v.registerA.forEach(vv=>{ll(v+" -> "+vv.rcvRoot+" : "+π.jsonE(vv.portA));});});};
var KERNTypeO = {array:0,object:1,number:2,string:3,boolean:4,flag:4,complex:5,function:6,complexReference:7,signal:8}; // complex will permit anything, complexReference will be referenced, not duplicated
var KERNTypeDefault = function(type){
	switch (type){default : return U;
		break;case 0 : return [];
		break;case 1 : return {};
		break;case 2 : return 0;
		break;case 3 : return "";
		break;case 4 : return F;
		break;case 5 : return N;
		break;case 6 : return function(){};
		break;case 7 : return N;
		break;case 8 : return F;}};
// for debugging output
var KERNDebugIndentLevel = 0;
var KERNDebugMicrosecondTolerance = 100;
var KERNDebugIndentS = " ";
//var KERNll = lld;
var KERNll = ()=>{};

// Each function has two versions.
// The non-"_SUB" version does some mundane things to alleviate code duplication.
// It then passes execution to the "_SUB" version to do specific things, expected to be implemented by the creator of the specific KERN element.

var KERN = function(o={}){
	while(KERNA.some(root=>typeof root !== "undefined" && root.counter===KERNCounter)){KERNCounter++;}
	// return negative shifts "a" left
	// return 0 generally doesn't do anything, but not safe to assume much else
	// return positive shifts "a" right
	var sortCompareFxn       = (a,b)=>a[0].localeCompare(b[0]);
	var searchCompareFxn     = (a,b)=>a   .localeCompare(b[0]);
	var searchCompareFullFxn = (a,b)=>{
		if (a.length !== b.length){return false;}
		for (var i = 0; i < a.length; i++){
			if (a[i] !== b[i]){return false;}}
		return true;};
	var oo = {
		name       : "KERN000000",
		counter    : KERNCounter,
		ID         : "", // the save file spec made this necesary
		base       : "¥KERN_0", // filled later
		elP        : N,
		o          : {}, // where KERN#-specific variables go, including public variables
		deadEndSA  : ["tx","co","bg"], // these properties will not chain into any derived properties
		
		portInP    : SortedArray({sortCompareFxn,searchCompareFxn,arr:[["tx",KERNTypeO.string],["co",KERNTypeO.string],["bg",KERNTypeO.string]]}), // the full port specification
		portInSP   : SortedArray({sortCompareFxn,searchCompareFxn,arr:[]}), // just the names of the ports, for performance usage
		portOutP   : SortedArray({sortCompareFxn,searchCompareFxn,arr:[]}), // the full port specification
		portOutSP  : SortedArray({sortCompareFxn,searchCompareFxn,arr:[]}), // just the names of the ports, for performance usage
		
		inboundAllF      : F,
		inboundAllPortA  : [],
		outboundAllF     : F,
		outboundAllPortA : [],
		
		registerA        : [],
		registerAssert   : function(o={}){π.p(o,{rcvRoot:N,portA:[]});
			this.registerDessert(o);
			var entryI = this.registerA.findIndex(v=>v.rcvRoot===o.rcvRoot);
			if (entryI === -1){
				this.registerA.push({rcvRoot:o.rcvRoot,portA:[]});
				entryI = this.registerA.length-1;}
			entry = this.registerA[entryI];
			// add each port
			for (var portI = 0; portI < o.portA.length; portI++){var port = o.portA[portI];
				entry.portA.push(port);}
			this.alteredPropertyAllF = T;
			this.outbound({automaticF:T});
			this.alteredPropertyAllF = F;},
		registerDessert  : function(o={}){π.p(o,{rcvRoot:N,portA:[]});
			var entryI = this.registerA.findIndex(v=>v.rcvRoot===o.rcvRoot);
			if (entryI === -1){return;} // obviously, our work is not needed
			entry = this.registerA[entryI];
			// for each existing port
			for (var portI = 0; portI < entry.portA.length; portI++){var port = entry.portA[portI];
				// if the port matches any of our Dessert ports, remove the port
				if (o.portA.some(v=>π.ooe(port,v))){
					entry.portA.splice(portI,1);}}
			// if this row has no ports, remove it for cleanliness purposes
			if (entry.portA.length === 0){
				this.registerA.splice(entryI,1);}},
		inboundSP        : N, // overridden, used in derive() to feed to if(), as a precl optimization
		
		validateFxnO     : {},
		alteredPropertyFullP : SortedArray({sortCompareFxn,searchCompareFullFxn,arr:[]}),
		alteredPropertyP : SortedArray({sortCompareFxn,searchCompareFxn,arr:[]}),
		alteredPropertyAllF : F, // used during setup to fake that every possible port has been altered
		// can accept one string or multiple strings
		if               : function(){
			if (this.alteredPropertyAllF){return T;}
			return ((arguments.length === 1 && isA(arguments[0])) ? arguments[0] : arguments).some(s=>this.alteredPropertyP    .includes(s));}, // used to test if ANY of the given properties has changed
		// only accepts a single port description
		ifFull           : function(q){
			if (this.alteredPropertyAllF){return T;}
			return this.alteredPropertyFullP.includes(q);},
		
		//----
		
		setup_SUB     : function(o={}){},
		setup         : function(o={}){var startT = π.now();KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"v setup "+this.base);KERNDebugIndentLevel++;
			π.p(o,{datA:[],elP:this.elP});this.elP = o.elP;
			
			this.base = "¥KERN_"+this.counter;
			this.portInSP .freshPushA(this.portInP .map(v=>v[0]));
			this.portOutSP.freshPushA(this.portOutP.map(v=>v[0]));
			this.setup_SUB(o);
			//this.alteredPropertyP.freshPushA(π.cc(this.portInP.arr)); // set all the ports to fake inbounds on everything initially
			// Q: Why are these separate calls? A: The color sider allows setting either h,s,l,a individually, or all together,
			// with a priority system where coValue takes priority over hValue,sValue,lValue,aValue individually, but since both
			// property groups are set during setup, we need to make the explicit initialization set a separate call in order to
			// completely ensure the programmer's intention is met, even with a quirky element
			this.inbound({datA:U,setupF:T});
			this.inbound({datA:o.datA});
			this.refreshResize();
			setTimeout(function(that){return function(){uniani.register(that.base,that);};}(this),0);
			var endT = π.now();KERNDebugIndentLevel--;if (endT - startT > KERNDebugMicrosecondTolerance){KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"^ setup "+this.base+" "+(endT-startT)+"µs");}},
		
		// stabilize has built-in validation for leaf data nodes [a plain string, or the final chain in a [multi-]array]
		stabilize_SUB : function(){},
		stabilize     : function(){var startT = π.now();KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"v stabilize "+this.base);KERNDebugIndentLevel++;
			var _ = this.o;
			
			this.alteredPropertyP.forEach(propEnt=>{//ll(propEnt);
				// per property object, apply the "name" rule for the chain
				// ex: ["thing",1,17,"ping"] means to run _.["thing"][1][17] through this.validateFxnO["thing"], assuming that function exists
				var k = propEnt[0];
				if (typeof this.validateFxnO[k] !== "undefined"){
					var base = _;
					var access = k;
					var entry = base[access];
					for (var i = 1; i < propEnt.length-1; i++){
						// follow the chain
						base = entry;
						access = propEnt[i];
						entry = base[access];}
					this.validateFxnO[k](_,base,access);
				}
			});
			this.stabilize_SUB();
			var endT = π.now();KERNDebugIndentLevel--;if (endT - startT > KERNDebugMicrosecondTolerance){KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"^ stabilize "+this.base+" "+(endT-startT)+"µs");}},
		
		// mark variables that have changed so outbound will repect them
		changed : function(o={}){var _ = this.o;
			π.p(o,{datA:[]});
			// !!! block duplicates, possibly, they are still correct, but may impact performance
			this.alteredPropertyP.pushA(π.cc(o.datA));
			this.alteredPropertyFullP.pushA(π.cc(o.datA));
		},
		
		// datA contains [unsorted] properties and values to feed in like :
		// [["tx","white"],["co","red"],["bg","black"],["somethingA",7,3,"hello"]]
		inbound_SUB   : function(o={}){},
		inbound       : function(o={}){var startT = π.now();KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"v inbound "+this.base);KERNDebugIndentLevel++;
			π.p(o,{datA:[],setupF:F});var _ = this.o;
//			if (this.counter === 3){ll(π.jsonE(o));}
//			if (this.ID.indexOf("global") === 0){ll(this.ID+" inbound");}
			
			this.alteredPropertyP    .clear();
			this.alteredPropertyFullP.clear();
			var deadEndF = T;
			// feed in the inbound collection
			o.datA.forEach(propEnt=>{
				var k = propEnt[0];if (typeof k !== "string"){ll("KERN ERROR : Element "+this.name+"_"+this.counter+" was fed an invalid inbound collection. (See the following line for the inbound collection)",o.datA);return;}
				deadEndF = deadEndF && this.deadEndSA.includes(k);
				var guideK = this.portInP.indexOf(k);if (guideK === -1){ll("KERN ERROR : Element "+this.name+"_"+this.counter+" was fed an with a not-accepted property : "+k,this.portInP.arr);return;}
				var guide = this.portInP.get(guideK);
				var entryFull = [];
				// we cannot assign directly to a variable, we need a base and an access, as in : base[access] = value;
				var base = _;
				var access = k;entryFull.push(access);
				var entry = base[access];
				//ll(entry,propEnt);
				//if (this.counter === 1){ll(π.jsonE(guide)+" "+π.jsonE(propEnt));}
				for (var i = 1; i < propEnt.length-1; i++){
					if (i < propEnt.length-2 && typeof entry[propEnt[i]] === "undefined"){
						//if (this.counter === 1 && guide[0] === "modO_Decon082_ver1"){ll(i+" : "+π.jsonE(guide)+" : "+π.jsonE(KERNTypeDefault(guide[i])));}
						// ? remnant from when o.forceF was a thing : if (guide === N){ll("KERN ERROR : You're forcing me to accept this inbound collection, so auto-construction is disabled for this property : "+propEnt[0]);return;}
						entry[propEnt[i]] = KERNTypeDefault(guide[i+1]);} // pre-fill the object/array if undefined slot
					// follow the chain
					base = entry;
					access = propEnt[i];entryFull.push(access);
					entry = base[access];}
				// check if a change is detected [for performance reasons, we don't check KERNTypeO.complex using π.ooe(), even though we could. for short, moderately similar strings, π.ooe() seems to run about 10x slower than ===]
				if (base[access] !== propEnt[propEnt.length-1]){
					// set the leaf and the change flag
					base[access] = (guide[guide.length-1] === KERNTypeO.complexReference) ? propEnt[propEnt.length-1] : π.cc(propEnt[propEnt.length-1]);
					this.alteredPropertyFullP.pushDirty(entryFull);}
			});
			this.alteredPropertyFullP.clean();
			
			// set all the ports to fake inbounds on everything initially
			var skipBecauseUselessF = F;
			if (o.setupF){this.alteredPropertyAllF = T;}
			else{
				this.alteredPropertyP.freshPushA(π.cc(this.alteredPropertyFullP.arr));
				if (this.alteredPropertyFullP.length === 0){skipBecauseUselessF = T;}}
			if (!skipBecauseUselessF){
				this.stabilize();
				this.refresh();
				if (!deadEndF){this.outbound();}
				if (o.setupF){this.alteredPropertyAllF = F;}
				this.inbound_SUB(o);
				this.alteredPropertyP    .clear();
				this.alteredPropertyFullP.clear();}
			var endT = π.now();KERNDebugIndentLevel--;if (endT - startT > KERNDebugMicrosecondTolerance){KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"^ inbound "+this.base+" "+(endT-startT)+"µs");}},
		
		refreshResize_SUB : function(){},
		refreshResize     : function(){var startT = π.now();KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"v refreshResize "+this.base);KERNDebugIndentLevel++;
			var _ = this.o;
			
			this.refreshResize_SUB();
			var endT = π.now();KERNDebugIndentLevel--;if (endT - startT > KERNDebugMicrosecondTolerance){KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"^ refreshResize "+this.base+" "+(endT-startT)+"µs");}},
		
		refresh_SUB   : function(){},
		refresh       : function(){var startT = π.now();KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"v refresh "+this.base);KERNDebugIndentLevel++;
			var _ = this.o;
			
			if (this.if("tx","co","bg")){
				var maF = µ.maCSS(document.head,this.base+"_GLOBAL",µ.cssCompile({[this.base] : p.genCSSVarS({tx:_.tx,co:_.co,bg:_.bg})}));}
			this.refresh_SUB();
			var endT = π.now();KERNDebugIndentLevel--;if (endT - startT > KERNDebugMicrosecondTolerance){KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"^ refresh "+this.base+" "+(endT-startT)+"µs");}},
		
		drawFrame_SUB : function(now){},
		drawFrame     : function(now){this.drawFrame_SUB(now);},
		
		outbound_SUB  : function(){},
		outbound      : function(o={}){var startT = π.now();KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"v outbound "+this.base);KERNDebugIndentLevel++;
			π.p(o,{automaticF:F});
			var _ = this.o;
			
			// portP might look like :
			// [[["coValue0"],["tx"]],[["coValue1"],["co"]],[["coValue2"],["bg"]],[["valueA",5],["somethingA",14,32]]]
			// meaning :
			// rcv.tx = snd.coValue0;rcv.co = snd.coValue1;rcv.bg = snd.coValue2;rcv.somethingA[14][32] = snd.value[5];
			// assuming that somethingA is a two-layered array
			// inbound accepts something like :
			// [["tx","white"],["co","red"],["bg","black"],["somethingA",7,3,"hello"]]
			// meaning :
			// o.tx = white;o.co = "red";o.bg = "black";o.somethingA[7][3] = "hello";
			var otherAllA = [];
			// !!! infinite loop hunch : it's feeding itself and deadEndSA isn't working
			if (this.outboundAllF){
				KERNA.forEach(rcvRoot=>{if (typeof rcvRoot === "undefined"){return;}
//					if (rcvRoot.ID.indexOf("global") === 0){ll(this.counter+" -> "+rcvRoot.ID);}
					otherAllA.push({rcvRoot,portA:this.outboundAllPortA});});}
//if (this.ID === "globalCo0"){ll("---------------------");}
			var backlogA = [];
			[this.registerA,otherAllA].forEach(a=>{
				a.forEach(connection=>{
					var datA = [];
					connection.portA.forEach(pair=>{
						var sndChain = pair[0];
						//KERNll(sndChain[0]+" ... "+π.jsonE(this.alteredPropertyP.arr));
						// only send signals if they were sent by the user directly, none of this auto piping stuff [signals are not constantly driving]
						if (o.automaticF){
							var guideK = this.portOutP.indexOf(sndChain[0]);
							if (guideK === -1){ll("KERN ERROR : Element "+this.name+"_"+this.counter+" is attempting to send a non-registered property. (See the following line for the propertyname)",sndChain[0]);return;}
							var guide = this.portOutP.get(guideK);
							if (guide[guide.length-1] === KERNTypeO.signal){return;}}
//if (this.ID === "globalCo0" && connection.rcvRoot.ID.indexOf("global") === 0){ll(">"+sndChain[0]+" ... "+connection.rcvRoot.ID);}
						// v warning: this line's if() is not static, and if an element feeds into itself and others, all els coming after itself in the list will be potentially blocked.
						// v          if feeding co into itself, it will inbound immediately, which will set the if() flag for co to lo, which will block furthers from receiving the original co.
						// v          the fix here was to make sure the inbounds come after the all the logic is over
						if (!this.if(sndChain[0])){return;} // property not changed, don't send it
//if (this.ID === "globalCo0" && connection.rcvRoot.ID.indexOf("global") === 0){ll(">>");}
						var rcvChain = pair[1];
						var sndValue = _;
						for (var i = 0; i < sndChain.length; i++){
							sndValue = sndValue[sndChain[i]];}
						var res = rcvChain.slice(); // slice duplicates this one-level, array of primitives
						res.push(sndValue); // pass by reference here, will decide whether to π.cc() in inbound()
						datA.push(res);});
					if (datA.length > 0){
						//connection.rcvRoot.inbound({datA});
						backlogA.push({root:connection.rcvRoot,datA});}
					});});
			backlogA.forEach(v=>{if (v.datA.length > 0){v.root.inbound({datA:v.datA});}});
			this.outbound_SUB();
			this.alteredPropertyP    .clear();
			this.alteredPropertyFullP.clear();
			var endT = π.now();KERNDebugIndentLevel--;if (endT - startT > KERNDebugMicrosecondTolerance){KERNll(KERNDebugIndentS.repeat(KERNDebugIndentLevel)+"^ outbound "+this.base+" "+(endT-startT)+"µs");}},
		
		destroy_SUB   : function(){},
		destroy       : function(){
			uniani.unregister(this.base);
			// make everyone forget about this element
			KERNA.forEach(v=>{if (typeof v === "undefined"){return;}
				var entryI = v.registerA.findIndex(v=>v.rcvRoot===o.rcvRoot);
				if (entryI === -1){return;} // obviously, our work is not needed
				v.registerA.splice(entryI,1);});
			µ.empty(this.elP);
			this.destroy_SUB();},
		
		toString      : function(){return "#"+this.counter+"("+this.name+")";},
	};
	KERNA[KERNCounter] = oo; //KERNA.push(oo);
	return oo;
};
</script>
