var KERN;
(function(){
	// KERN ELEMENT SPECIFICATION VERSION 4
	
	// The KERN specification was developed in the year 2016 by sliceofcake for FeeltheBeats version 575.
	// You are free to use this code however you want.
	// If you want to use this code in a monetized project, go for it. I won't come after you. --unless you make millions of dollars, then I might consider it. Though, if you make millions of dollars from a product, what is it doing running my code, seriously.
	// By using this code, you are taking full responsibility for any damages caused by it.
	// You don't have to mention me or my organization when you use this code. Delete this paragraph right now if you want.
	// Good day.
	
	// This version has been altered from its original programming in order to
	// (1) run independently - without the need for any libraries
	// (2) run quicker - we're already lowering readability by delinking libraries, so we might as well write the code super tight [example:object-object data absorption, handling each property specially, entangling absorption and program logic]
	// (3) being more formal - I've historically had to kludge around some vaguely defined features and missing or incorrectly defined [yet "good enough"] features
	
	// Some potential errors are checked, but only ones that could reasonably occur.
	// I intentionally do not handle errors that would only come about in a catastrophe and/or the programmer not knowing what they're doing to a large degree, such as passing a function a string when an array is expected.
	
	// ! for defined behavior, only call setup() before any calls to registerAssert(), for that element. in other words, always setup() before you link any data flows
	
	KERN = {
		// programmer configuration variables
		pcv : {
			// all sub-elements of the part type, such as "TEST000001"
			elAttributeK_ofPartType    : "data-kern-of-part-type",
			elAttributeVFxn_ofPartType : root=>root.name,
			// all sub-elements of the class, such as "aac"
			elAttributeK_ofUnique      : "data-kern-of-unique",
			// all sub-elements of the instance, such as "4"
			elAttributeK_ofInstance    : "data-kern-of-instance",
			elAttributeVFxn_ofInstance : root=>root.counter,
			// the CSS element for the part type
			elCSSMultiAttributeK     : "data-kern-unique",
			elCSSMultiAttributeVFxn  : root=>root.name,
			// the CSS element for this specific part, per part
			elCSSUniqueAttributeK    : "data-kern-unique",
			elCSSUniqueAttributeVFxn : root=>root.counter,
		},
		// storage
		partO : {},
		rootA : [],
		counter : 0, // gets increments before logic
		a : [],
		dump : function(){KERNA.forEach(v=>{v.registerA.forEach(vv=>{ll(v+" -> "+vv.rcvRoot+" : "+π.jsonE(vv.portA));});});},
		typeO : {array:0,object:1,number:2,string:3,boolean:4,flag:4,complex:5,function:6,complexReference:7,signal:8}, // complex will permit anything, complexReference will be referenced, not duplicated
		typeVerificationFxn : function(type,m){
			switch (type){default : return false;
				break;case 0 : return this.isA(m);
				break;case 1 : return this.isO(m);
				break;case 2 : return this.isN(m);
				break;case 3 : return this.isS(m);
				break;case 4 : return this.isF(m);
				break;case 5 : return true;
				break;case 6 : return this.isFxn(m);
				break;case 7 : return true;
				break;case 8 : return this.isF(m);}},
		typeDefault : function(type){
			switch (type){default : return undefined;
				break;case 0 : return [];
				break;case 1 : return {};
				break;case 2 : return 0;
				break;case 3 : return "";
				break;case 4 : return false;
				break;case 5 : return null;
				break;case 6 : return function(){};
				break;case 7 : return null;
				break;case 8 : return false;}},
		// utilities, had to scope them here, they were originally in another library that would have had to be linked
		ll    : (...m)=>{return;m.forEach(v=>console.log(v));},
		debugF : true,
		debugIndentLevel : 0,
		debugMicrosecondTolerance : 100,
		debugIndentS : " ",
		isI   : function(m){return Number.isInteger(m);},
		isN   : function(m){return (typeof m === "number");},
		isNaN : function(m){return Number.isNaN(m);},
		isS   : function(m){return (typeof m === "string");},
		isF   : function(m){return (m === true || m === false);},
		isN   : function(m){return (m === null);},
		isU   : function(m){return (typeof m === "undefined");}, // only useful for leaf nodes
		isA   : function(m){return Array.isArray(m);},
		isO   : function(m){return typeof m === "object" && m !== null && !Array.isArray(m);},
		isFxn : function(m){return (typeof m === "function");},
		now   : ()=>performance.now(),
		// carbon copy [deep copy]
		cc:function(m){
			if (typeof m === "object"){
				if (m === null){return m;}
				if (Array.isArray(m)){
					var res = new Array(m.length);
					for (var i = 0; i < m.length; i++){
						res[i] = this.cc(m[i]);}
					return res;}
				else{
					var res = {};
					var keyA = Object.keys(m);
					for (var i = 0; i < keyA.length; i++){var k = keyA[i];
						res[k] = this.cc(m[k]);}
					return res;}}
			return m;},
		// object-object equal[ity] for arrays, objects, strings, numbers, booleans [slow, don't use in tight performance loops]
		ooe:function(o,oo){
			return JSON.stringify(o)===JSON.stringify(oo);},
		// write can be slow
		// reads must be extremely quick
		// ! pass me an array I have exclusive control over [including control of each element], π.cc() it if you aren't willing to give me that privilege
		// searchCompareFxn should have the same basis as sortCompareFxn, but the search variant might have an extra filter
		// L> example : an array of elements like ["John","Smith",28] might have the ability to search for "John" and return this entry as equivalent
		// L> example : same as above, but perhaps you would search for {initials:"JS",ageRange:[20,30]}, with these query parts hooked up to return that John Smith (28) row
		// ! searchCompareFxn will put your search term in the "a" slot, and the array terms in the "b" slot
		SortedArray : function(o={}){
			if (typeof o.arr               === "undefined"){o.arr = [];}
			if (typeof o.sortCompareFxn    === "undefined"){o.sortCompareFxn = undefined;}
			if (typeof o.searchCompareFxnA === "undefined"){o.searchCompareFxnA = [];}
			var res = {
				arr        : o.arr,
				sortCompareFxn    : o.sortCompareFxn,
				searchCompareFxn  : o.searchCompareFxnA[0],
				searchCompareFxnA : o.searchCompareFxnA,
				length     : o.arr.length,
				get        : function(i){return this.arr[i];},
				push       : function(v){this.pushDirty(v);this.clean();},
				pushDirty  : function(v){this.length++;this.arr.push(v);},
				pushA      : function(a){a.forEach(v=>this.pushDirty(v));this.clean();},
				freshPushA : function(a){this.clear();this.pushA(a);},
				clean      : function(){this.arr.sort(this.sortCompareFxn);},
				clear      : function(){this.arr.length = 0;},
				// optimize the living carp out of this
				// matchType
				//  -2 : index of value that is minimally strictly smaller than given input
				//  -1 : index of value that is minimally smaller than or equal to given input, if duplicates, then the smallest of the duplicate chain
				//   0 : index of value that is equal to given input
				//   1 : index of value that is minimally larger than or equal to given input, if duplicates, then the largest of the duplicate chain
				//   2 : index of value that is minimally strictly larger than given input
				// 100 : index of value that is somewhat close to the given input, in a non-specified manner*
				// * the lazy/vague matchType can offer immense performance improvements for algorithms that need a ~recommended starting point~ and can performantly take over after they have one
				// ex: arr=[1,3,5,7]; indexOf(2,1) returns index of 1, because arr[1]=3, which is the value minimally larger than or equal to 3
				indexOf    : function(v,searchI,matchType){
					if (typeof searchI === "undefined"){searchI = 0;}
					this.searchCompareFxn = this.searchCompareFxnA[searchI];
					if (typeof matchType === "undefined"){matchType = 0;}
					// reason
					// -1 : a[mid] is too small
					//  1 : a[mid] is too large
					var a=this.arr,lo=0,hi=a.length-1,mid,reason;
					if (a.length === 0){return -1;} // apparently, logic breaks down when this is the case
					if (typeof this.searchCompareFxn === "undefined"){
						while (lo<=hi){
							mid=Math.floor((lo+hi)/2);
							if (v<a[mid]){hi=mid-1;reason=1;}
							else if (v>a[mid]){lo=mid+1;reason=-1;}
							else{reason=0;break;}}}
					else{
						var cmp;
						while (lo<=hi){
							mid=Math.floor((lo+hi)/2);
							cmp=this.searchCompareFxn(v,a[mid]);
							if (cmp<0){hi=mid-1;reason=1;}
							else if (cmp>0){lo=mid+1;reason=-1;}
							else{reason=0;break;}}}
					switch (matchType){default:;
						break;case  -2:
							switch (reason){default:;
								break;case -1:return mid;
								break;case  0:return mid-1;
								break;case  1:return mid-1;}
						break;case  -1:
							switch (reason){default:;
								break;case -1:return mid;
								// !!! not optimal execution, but algorithm easy to understand
								// follow the duplicates in a linear search until you reach to most extremely-located duplicate
								break;case  0:var currentV = a[mid];while (T){mid--;if (typeof mid === -1){break;}var nextV=a[mid];if (nextV!==currentV){break;}currentV=nextV;}return mid;
								break;case  1:return mid-1;}
						break;case   0:
							switch (reason){default:;
								break;case -1:return -1;
								break;case  0:return mid;
								break;case  1:return -1;}
						break;case   1:
							switch (reason){default:;
								break;case -1:if (mid+1===a.length){return -1;}else{return mid+1;}
								// !!! not optimal execution, but algorithm easy to understand
								// follow the duplicates in a linear search until you reach to most extremely-located duplicate
								break;case  0:var currentV = a[mid];while (T){mid++;if (typeof mid === a.length){mid=-1;break;}var nextV=a[mid];if (nextV!==currentV){break;}currentV=nextV;}return mid;
								break;case  1:return mid;}
						break;case   2:
							switch (reason){default:;
								break;case -1:if (mid+1===a.length){return -1;}else{return mid+1;}
								break;case  0:if (mid+1===a.length){return -1;}else{return mid+1;}
								break;case  1:return mid;}
						break;case 100:
							switch (reason){default:;
								break;case -1:return mid;
								break;case  0:return mid;
								break;case  1:return mid;}}},
				find       : function(v,searchI){
					if (typeof searchI === "undefined"){searchI = 0;}
					var k = this.indexOf(v,searchI);
					return ((k === -1) ? undefined : this.get(k));},
				includes   : function(v,searchI){
					if (typeof searchI === "undefined"){searchI = 0;}
					//KERN.ll(v);
					//KERN.ll(this.arr[this.indexOf(v,searchI)]);
					return (this.indexOf(v,searchI) !== -1);},
				map        : function(){return this.arr.map(arguments[0]);},
				mapO       : function(){return this.arr.mapO(arguments[0]);},
				every      : function(){return this.arr.every(arguments[0]);},
				forEach    : function(){this.arr.forEach(arguments[0]);},
				filter     : function(){return this.arr.filter(arguments[0]);},
				toString   : function(){return this.arr.toString();},
			};
			res.clean();
			return res;
		},
		// unified animation
		uniani : {
			profileRowC     : 500,
			cycleT          :   0,
			registerKA      : [] ,
			registerOA      : [] ,
			registerQueue   : [] ,
			unregisterQueue : [] ,
			profileA        : [] ,
			register : function(k,o){this.registerQueue.push({k:k,o:o});},
			register_INTERNAL : function(k,o){
				if (this.registerKA.indexOf(k) === -1){ // no duplicates kthx
					this.registerKA.push(k);
					this.registerOA.push(o);
					this.profileA  .push([]);}},
			unregister : function(k){this.unregisterQueue.push({k:k});},
			unregister_INTERNAL : function(k){
				var pos = this.registerKA.indexOf(k);
				if (pos !== -1){
					this.registerKA.splice(pos,1);
					this.registerOA.splice(pos,1);
					this.profileA  .splice(pos,1);}},
			start : function(){window.requestAnimationFrame(this.cycle.bind(this));},
			cycle : function(timestamp){timestamp = Math.round(timestamp*1000);
				var el;
				while (typeof (el = this.unregisterQueue.pop()) !== "undefined"){this.unregister_INTERNAL(el.k);}
				while (typeof (el = this.  registerQueue.pop()) !== "undefined"){this.  register_INTERNAL(el.k,el.o);}
				// draw frame for each registered circle
				for (var iO = 0; iO < this.registerOA.length; iO++){var o = this.registerOA[iO];
					var a = performance.now();
					o.drawFrame(timestamp);
					var b = performance.now();
					this.profileA[iO][this.cycleT%this.profileRowC] = b-a;}
				this.cycleT++;
				window.requestAnimationFrame(this.cycle.bind(this));},
			dump : function(ret=false){
				var out = "";
				out += "uniani profile report\n";
				out += "---------------------\n";
				for (var iRow in this.profileA){var row = this.profileA[iRow];
					if (row.length < this.profileRowC){continue;} // not enough data for this process, skip it
					out += this.registerKA[iRow]+" ... "+Math.floor(1000*row.average())+"µs\n";}
				out += "-------- END --------\n";
				if (ret){return out;}else{console.log(out);}},},
		// generate a KERN element
		create : function(o={}){
			if (typeof o.partID           === "undefined"){o.partID           = ""   ;}
			if (typeof o.elP              === "undefined"){o.elP              = null ;}
			if (typeof o.datA             === "undefined"){o.datA             = {}   ;}
			if (typeof this.partO[o.partID]     === "undefined"){ll("KERN ERROR : part:"+o.partID+" not found");return undefined;}
			if (typeof this.partO[o.partID].gen !== "function" ){ll("KERN ERROR : part:"+o.partID+" doesn't have a gen() function");return undefined;}
			var res = this.gen();
			res.name = o.partID;
			var resExtension = this.partO[o.partID].gen();
			var kA = Object.keys(resExtension);
			for (var kAI = 0,kAC = kA.length; kAI < kAC; kAI++){var k = kA[kAI];var v = resExtension[k];
				switch (k){default                :res[k] = v;
					break;case "o"                :
						var o_kA = Object.keys(v);var o_kAC = o_kA.length;
						for (var o_kAI = 0; o_kAI < o_kAC; o_kAI++){var o_k = o_kA[o_kAI];var o_v = v[o_k];
							res[k][o_k] = o_v;}
					break;case "portInA"               :res.portInP .pushA(v);
					break;case "portOutA"              :res.portOutP.pushA(v);
					break;case "validateFxnO"          :for (var vK of Object.keys(v)){res[k][vK] = v[vK];}
					break;case "setup_SUB"             :res[k] = v;
					break;case "stabilize_SUB"         :res[k] = v;
					break;case "importInitialForce_SUB":res[k] = v;
					break;case "import_SUB"            :res[k] = v;
					break;case "export_SUB"            :res[k] = v;
					break;case "refresh_SUB"           :res[k] = v;
					break;case "refreshResize_SUB"     :res[k] = v;
					break;case "drawFrame_SUB"         :res[k] = v;
					break;case "destroy_SUB"           :res[k] = v;}}
			if (typeof o.importAllF     !== "undefined"){res.importAllF     = o.importAllF    ;}
			if (typeof o.exportAllF     !== "undefined"){res.exportAllF     = o.exportAllF    ;}
			if (typeof o.importAllPortA !== "undefined"){res.importAllPortA = o.importAllPortA;}
			if (typeof o.exportAllPortA !== "undefined"){res.exportAllPortA = o.exportAllPortA;}
			if (o.elP !== null){
				res.elP = o.elP;}
			res.o.root = res; // convenience, if you have root.o, let every element refer to root
			res.setup(o.datA);
			return res;},
		gen : function(o={}){
			KERN.counter++;
			// return negative shifts "a" left
			// return 0 generally doesn't do anything, but not safe to assume much else
			// return positive shifts "a" right
			var sortCompareFxn           = (a,b)=>{
				var cmp = 0;
				for (var i = 0;; i++){
					var aDef = (i < a.length);
					var bDef = (i < a.length);
					if       (!aDef && !bDef)  {break;}
					else  if (!aDef &&  bDef)  {return  -1;}
					else  if ( aDef && !bDef)  {return   1;}
					else/*if ( aDef &&  bDef)*/{
						var ai = a[i];
						var bi = b[i];
						if (typeof ai === "number" && typeof bi === "number"){cmp = ai-bi;}
						else{cmp = a[i].localeCompare(b[i]);}
						if (cmp === 0){continue;}
						else{return cmp;}}}
				return cmp;};
			var searchCompareBaseFxn     = (a,b)=>a.localeCompare(b[0]); // use the propertyname to search
			var searchCompareFullFxn     = sortCompareFxn;
			var searchCompareFxnA = [
				searchCompareBaseFxn,
				searchCompareFullFxn,];
			var colorValidateFxn = function(that,_,propertyname,base,k,v){
				if (!KERN.isA(v)){return [0,0,0,1];}
				if (typeof v[0] !== "number"){v[0] = 0;}if (v[0] < 0){v[0] = 0;}else if (v[0] > 1){v[0] = 1;}
				if (typeof v[1] !== "number"){v[1] = 0;}if (v[1] < 0){v[1] = 0;}else if (v[1] > 1){v[1] = 1;}
				if (typeof v[2] !== "number"){v[2] = 0;}if (v[2] < 0){v[2] = 0;}else if (v[2] > 1){v[2] = 1;}
				if (typeof v[3] !== "number"){v[3] = 1;}if (v[3] < 0){v[3] = 0;}else if (v[3] > 1){v[3] = 1;}
				if (v.length > 4){base[k] = v.slice(0,3);}};
			
			var oo = {
				name       : "",
				counter    : KERN.counter,
				// about the ID field,
				// [the save-file spec made this necesary]
				// a eternally consistent ID so that an entry in a save-file can act on a pre-existing KERN element,
				// even if that KERN element changes details between builds, yet retains the same general functionality
				// preferably, you'd hand your users a save-file that does the entire KERN creation process.
				// however, you have the ability to pre-create KERN elements, and then apply a save file on top of those already-existing elements
				// this is where ID is needed.
				// example1: having a color slider to set background color for the page. even if you change the appearance of the slider between builds, you'd give each new slider the same ID
				// example2: having a color slider that changed so radically between builds that it's no longer compatible with old save-files. change the ID, and force your users to reconfigure their save file for future builds
				ID         : "",
				elP        : null, // the parent element, the one that directly contains the root element for this KERN thing
				el         : null, // the root element for this KERN thing
				// put basic properties here that you think every element should have
				o          : {
					log      : [],
					tx       : [0,0,1  ,1], // the color for text, specified in normalized HSLA
					co       : [0,1,0.5,1], // the color for text, specified in normalized HSLA
					bg       : [0,0,0  ,0.65], // the color for text, specified in normalized HSLA
				}, // where KERN#-specific variables go, including public variables
				
				ll : function(m){var root = this;var _ = this.o;
					_.log.push(m);
					root.changed(["log"]);
					root.export();},
				
				genElA : function(){
					var resO = {};
					var elM = this.elP.querySelectorAll("["+KERN.pcv.elAttributeK_ofUnique+"]");
					for (var elMI = 0,elMC = elM.length; elMI < elMC; elMI++){var el = elM[elMI];
						resO[el.getAttribute(KERN.pcv.elAttributeK_ofUnique)] = el;}
					return resO;},
				// major explanation needed:
				// partType example : KERN000001 (the registered name of the KERN part)
				// unique   example : aaba (like the "id" attribute, but scoped to this element - if you fill these in for all elements, genElA() will be of great help to you later)
				//(class    example): title-large (anything you want, in the classic CSS "class" manner - not specially handled, just a normal selector)
				// L> class names specific to the element [to not mix with globally-defined class with the same name] should be run through genClassS(), which appends an identifier to the classname
				// instance example : 23 (the 23rd el generated on the page)
				// Q&A:
				// Q: Why don't you get rid of the oppressive "class" thing, and rename "aux" to "class"
				// A: While KERN elements were simpler [all spec3 elements], a higher-level class was not needed. It had to be added to the KERN4 spec, preferably without redoing a large part of the styling algorithms.
				genCSSRulePartialS_ofPartType : function( ){return "["+KERN.pcv.elAttributeK_ofPartType+"='"+KERN.pcv.elAttributeVFxn_ofPartType(this)+"']";},
				genCSSRulePartialS_ofUnique   : function(s){return "["+KERN.pcv.elAttributeK_ofUnique  +"='"+s                                        +"']";},
				genCSSRulePartialS_ofInstance : function( ){return "["+KERN.pcv.elAttributeK_ofInstance+"='"+KERN.pcv.elAttributeVFxn_ofInstance(this)+"']";},
				genCSSUniqueRulePartialS      : function(s){return this.genCSSRulePartialS_ofPartType()+this.genCSSRulePartialS_ofUnique(s)+this.genCSSRulePartialS_ofInstance();},
				genCSSGenericRulePartialS     : function(s){return this.genCSSRulePartialS_ofPartType()+this.genCSSRulePartialS_ofUnique(s);},
				genClassS                     : function(...m){return m.map(s=>"."+KERN.pcv.elAttributeVFxn_ofPartType(this)+"-"+s).join("");},
				gcrps_ofPartType : function(){return this.genCSSRulePartialS_ofPartType.apply(this,arguments);},
				gcrps_ofUnique   : function(){return this.genCSSRulePartialS_ofUnique  .apply(this,arguments);},
				gcrps_ofInstance : function(){return this.genCSSRulePartialS_ofInstance.apply(this,arguments);},
				gcurps           : function(){return this.genCSSUniqueRulePartialS.apply(this,arguments);},
				gcgrps           : function(){return this.genCSSGenericRulePartialS.apply(this,arguments);},
				gcs              : function(){return this.genClassS.apply(this,arguments);},
				
				deadEndSA  : ["tx","co","bg"], // these properties will not chain into any derived properties
				
				portInP    : KERN.SortedArray({sortCompareFxn:sortCompareFxn,searchCompareFxnA:searchCompareFxnA,arr:[["tx",KERN.typeO.string],["co",KERN.typeO.string],["bg",KERN.typeO.string]]}), // the full port specification
				portOutP   : KERN.SortedArray({sortCompareFxn:sortCompareFxn,searchCompareFxnA:searchCompareFxnA,arr:[["log",KERN.typeO.complexReference]]}), // the full port specification
				
				importAllF      : false,
				importAllPortA  : [],
				exportAllF      : false,
				exportAllPortA  : [],
				
				registerA        : [],
				registerAssert   : function(o={}){
					if (typeof o.rcvRoot === "undefined"){o.rcvRoot = null;}
					if (typeof o.portA   === "undefined"){o.portA   = [];}
					this.registerDessert(o);
					var entry = this.registerA.find(v=>v.rcvRoot===o.rcvRoot);
					if (typeof entry === "undefined"){
						this.registerA.push({rcvRoot:o.rcvRoot,portA:[]});
						entry = this.registerA[this.registerA.length-1];}
					// add each port
					for (var portAI = 0,portAC = o.portA.length; portAI < portAC; portAI++){var port = o.portA[portAI];
						entry.portA.push(port);}
					// since we just changed the outgoing port assignments, there may be data to feed now
					this.export(true);},
				registerDessert  : function(o={}){
					if (typeof o.rcvRoot === "undefined"){o.rcvRoot = null;}
					if (typeof o.portA   === "undefined"){o.portA   = [];}
					var entryI = this.registerA.findIndex(v=>v.rcvRoot===o.rcvRoot);
					if (entryI === -1){return;} // obviously, our work is not needed
					var entry = this.registerA[entryI];
					// for each existing port
					for (var portAI = 0,portAC = o.portA.length; portAI < portAC; portAI++){var port = o.portA[portAI];
						// if the port matches any of our Dessert ports, remove the port
						if (o.portA.some(v=>KERN.ooe(port,v))){
							entry.portA.splice(portAI,1);}}
					// if this row has no ports, remove it for cleanliness purposes
					if (entry.portA.length === 0){
						this.registerA.splice(entryI,1);}},
				
				validateFxnO         : {
					tx : colorValidateFxn,
					co : colorValidateFxn,
					bg : colorValidateFxn,},
				alteredPropertyFullImportP : KERN.SortedArray({sortCompareFxn:sortCompareFxn,searchCompareFxnA:searchCompareFxnA,arr:[]}),
				alteredPropertyFullExportP : KERN.SortedArray({sortCompareFxn:sortCompareFxn,searchCompareFxnA:searchCompareFxnA,arr:[]}),
				// used to test if ANY of the given properties has changed
				// can accept one string or multiple strings
				if               : function(){
					if (this.ifFullForceF){return true;}
					// arguments is suddenly not working
					var argM = ((arguments.length === 1 && KERN.isA(arguments[0])) ? arguments[0] : arguments);
					for (var argMI = 0,argMC = argM.length; argMI < argMC; argMI++){var arg = argM[argMI];
						if (this.alteredPropertyFullImportP.includes(arg,0)){return true;}}
					return false;},
				ifExport         : function(){
					if (this.ifFullExportForceF){return true;}
					// arguments is suddenly not working
					var argM = ((arguments.length === 1 && KERN.isA(arguments[0])) ? arguments[0] : arguments);
					for (var argMI = 0,argMC = argM.length; argMI < argMC; argMI++){var arg = argM[argMI];
						if (this.alteredPropertyFullExportP.includes(arg,0)){return true;}}
					return false;},
				// only accepts a single port description
				ifFull           : function(q){
					if (this.ifFullForceF){return true;}
					return this.alteredPropertyFullImportP.includes(q,1);},
				ifFullExport     : function(q){
					if (this.ifFullExportForceF){return true;}
					return this.alteredPropertyFullExportP.includes(q,1);},
				ifFullForceF : false, // used during setup() to fake that every possible import port has been altered
				ifFullExportForceF : false, // used before [and after] export() to fake that every possible export port has been altered
				
				// char in str
				π_cins:function(c,s){
					var loopmax = s.length;
					for (var i = 0; i < loopmax; i++){
						if (s[i] === c){return true;}}
					return false;},
				//•ping - faux-class, actual name prepended with partID
				//∑ - [standalone] of this partID
				//¶ - [standalone] of this instanceID
				cssReplKFxn:function(s){
					if (this.π_cins("•",s)){s = s.replace(/•([a-zA-Z0-9\-_]+)/g,(m,p1)=>"."+this.name+"-class-"+p1);}
					if (this.π_cins("†",s)){s = s.replace(/†([a-zA-Z0-9\-_]+)/g,(m,p1)=>"."+this.name+"-type-"+p1);}
					if (this.π_cins("∑",s)){s = s.replace(/∑/g,()=>this.genCSSRulePartialS_ofPartType());}
					if (this.π_cins("¶",s)){s = s.replace(/¶/g,()=>this.genCSSRulePartialS_ofInstance());}
					return s;},
				cssReplVFxn:function(s){return s;},
				// used when making els, since we want each el tagged with this info
				cssReplKTagFxn:function(s){
					s += this.genCSSRulePartialS_ofPartType();
					s += this.genCSSRulePartialS_ofInstance();
					return s;},
				
				//----
				
				// return null if you do not wish to assert [recalculate and possibly change] CSS [for performance reasons, perhaps]
				genMultiCSSO : function(){return null;},
				genUniqueCSSO : function(){return null;},
				
				// convenience translation
				changed : function(){
					this.alteredPropertyFullExportP.pushA(Array.prototype.slice.call(arguments));},
				
				importInitialForce_SUB     : function(){},
				importInitialForce         : function(datA){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v importInitialForce "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					this.ifFullForceF = true;
					this.stabilize();
					this.ifFullForceF = false;
					this.importInitialForce_SUB(datA);
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ importInitialForce "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				// it is assumed that this is called strictly before any registerAssert() calls to the same element
				setup_SUB     : function(){},
				setup         : function(datA){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v setup "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					if (typeof datA === "undefined"){datA = [];}
					this.setup_SUB(datA);
					// ! do not mix these import calls, keeping them separate will ensure that the intention of the programmer is met
					this.importInitialForce();
					this.import(datA);
					var elCSS = document.head.querySelector("style["+KERN.pcv.elCSSMultiAttributeK+"='"+KERN.pcv.elCSSMultiAttributeVFxn(this)+"']");
					var elMissingF = (elCSS === null);
					var cssO = this.genMultiCSSO(elMissingF);
					if (cssO !== null){
						var cssOKA = Object.keys(cssO);
						var cssS = "";
						for (var cssOKAI = 0,cssOKAC = cssOKA.length; cssOKAI < cssOKAC; cssOKAI++){cssOK = cssOKA[cssOKAI];cssOV = cssO[cssOK];
							cssS += this.cssReplKFxn(cssOK)+"{"+this.cssReplVFxn(cssOV)+"}";}
						if (elMissingF){
							elCSS = document.createElement("style");elCSS.setAttribute(KERN.pcv.elCSSMultiAttributeK,KERN.pcv.elCSSMultiAttributeVFxn(this));}
						elCSS.textContent = cssS;
						if (elMissingF){
							document.head.appendChild(elCSS);}}
					this.refreshResize();
					this.refresh();
					setTimeout(function(that){return function(){KERN.uniani.register("KERN_"+that.counter,that);};}(this),0);
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ setup "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				// stabilize has built-in validation for leaf data nodes [a plain string, or the final chain in a [multi-]array]
				stabilize_SUB : function(){},
				stabilize     : function(){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v stabilize "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					var _ = this.o;
					
					// this code more-or-less mirrors import() - go check out that function if you want
					this.alteredPropertyFullImportP.forEach(propEnt=>{ // example: propEnt = ["elephantOA",12,"cat"] // missing the leaf value, intentionally
						// per property object, apply the "name" rule for the chain
						// ex: ["thing",1,17] means to run _.["thing"][1][17] through this.validateFxnO["thing"], assuming that function exists
						var propertyname = propEnt[0]; // example: propertyname = "elephantOA"
						if (typeof this.validateFxnO[propertyname] !== "undefined"){
							var base;var k;var v = _; // reason: we cannot assign directly to a variable, we need a base and a k, as in : base[k] = v
							for (var propEntI = 0,propEntC = propEnt.length; propEntI < propEntC; propEntI++){ // example: for ["elephantOA",12,"cat"], missing the leaf value, intentionally
								base = v;k = propEnt[propEntI];v = base[k];}
							this.validateFxnO[propertyname](this,_,propertyname,base,k,v);}});
					this.stabilize_SUB();
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ stabilize "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				// datA contains [unsorted] properties and values to feed in like :
				// [["tx","white"],["co","red"],["bg","black"],["somethingA",7,3,"hello"]]
				import_SUB   : function(datA,internalF){},
				import       : function(datA,internalF){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v import "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					if (typeof internalF === "undefined"){internalF = false;}
					var _ = this.o;
					this.alteredPropertyFullImportP.clear();
					this.alteredPropertyFullExportP.clear();
					var deadEndF = true;
					// example: datA = [["giraffe",15],["elephantOA",12,"cat",true]]
					datA.forEach(propEnt=>{ // example: propEnt = ["elephantOA",12,"cat",true]
						var propertyname = propEnt[0]; // example: propertyname = "elephantOA"
						deadEndF = deadEndF && this.deadEndSA.includes(propertyname);
						var guide = this.portInP.find(propertyname,0); // example: guide = ["elephantOA",KERN.typeO.array,KERN.typeO.object,KERN.typeO.flag]
						if (typeof guide === "undefined" && internalF){
							guide = this.portOutP.find(propertyname,0);} // example: guide = ["elephantOA",KERN.typeO.array,KERN.typeO.object,KERN.typeO.flag]
						if (typeof guide === "undefined"){
							KERN.ll("KERN ERROR : Element "+this.name+"_"+this.counter+" was fed with a not-accepted property : "+propertyname,this.portInP.arr);return;}
						var base;var k;var v = _; // reason: we cannot assign directly to a variable, we need a base and a k, as in : base[k] = v
						var entryFull = [];
						for (var propEntI = 0,propEntC = propEnt.length; propEntI < propEntC-1; propEntI++){ // example: for ["elephantOA",12,"cat"], ignoring the last element, which is the leaf value
							base = v;k = propEnt[propEntI];v = base[k];
							entryFull.push(k);
							var typecode = guide[propEntI+1]; // reason: the first element of the guide is the propertyname, then after that, at position 1, starts the type chain
							if (!KERN.typeVerificationFxn(typecode,v)){
								base[k] = KERN.typeDefault(typecode);
								v = base[k];}}
						// check if a change is detected for the leaf [for performance reasons, we don't check KERN.typeO.complex using a deep comparison, even though we could.
						// for short, moderately similar strings, my deep comparison function, π.ooe() seems to run about 10x slower than the === operator]
						if (v !== propEnt[propEnt.length-1]){
							base[k] = (guide[guide.length-1] === KERN.typeO.complexReference) ? propEnt[propEnt.length-1] : KERN.cc(propEnt[propEnt.length-1]);
							this.alteredPropertyFullImportP.pushDirty(entryFull);
							this.alteredPropertyFullExportP.pushDirty(entryFull); // this line is okay even if the chain isn't a valid export
							}});
					if (this.alteredPropertyFullImportP.length > 0){
						this.alteredPropertyFullImportP.clean();
						this.alteredPropertyFullExportP.clean();
						this.stabilize();
						this.refresh();
						if (!deadEndF){this.export();}
						this.import_SUB(datA);
						this.alteredPropertyFullImportP.clear();}
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ stabilize "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				refreshResize_SUB : function(){},
				refreshResize     : function(){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v refreshResize "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					this.refreshResize_SUB();
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ refreshResize "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				refresh_SUB   : function(){},
				refresh       : function(){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v refresh "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					var _ = this.o;
					var elCSS = document.head.querySelector("style["+KERN.pcv.elCSSUniqueAttributeK+"='"+KERN.pcv.elCSSUniqueAttributeVFxn(this)+"']");
					var elMissingF = (elCSS === null);
					var cssO = this.genUniqueCSSO(elMissingF);
					if (cssO !== null){
						var cssOKA = Object.keys(cssO);
						var cssS = "";
						for (var cssOKAI = 0,cssOKAC = cssOKA.length; cssOKAI < cssOKAC; cssOKAI++){cssOK = cssOKA[cssOKAI];cssOV = cssO[cssOK];
							cssS += this.cssReplKFxn(cssOK)+"{"+this.cssReplVFxn(cssOV)+"}";}
						if (elMissingF){
							elCSS = document.createElement("style");elCSS.setAttribute(KERN.pcv.elCSSUniqueAttributeK,KERN.pcv.elCSSUniqueAttributeVFxn(this));}
						elCSS.textContent = cssS;
						if (elMissingF){
							document.head.appendChild(elCSS);}}
					this.refresh_SUB();
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ refresh "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				drawFrame_SUB : function(now){},
				drawFrame     : function(now){this.drawFrame_SUB(now);},
				
				export_SUB  : function(blockSignalF){},
				export      : function(blockSignalF){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v export "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					if (typeof blockSignalF === "undefined"){blockSignalF = false;}
					var _ = this.o;
					// portP might look like : [[["coValue0"],["tx"]],[["coValue1"],["co"]],[["coValue2"],["bg"]],[["valueA",5],["somethingAA",14,32]]]
					// meaning : rcv.tx = snd.coValue0;rcv.co = snd.coValue1;rcv.bg = snd.coValue2;rcv.somethingAA[14][32] = snd.value[5];
					// import accepts something like : [["tx","white"],["co","red"],["bg","black"],["somethingAA",7,3,"hello"]]
					// meaning : o.tx = white;o.co = "red";o.bg = "black";o.somethingAA[7][3] = "hello";
					var otherAllA = [];
					if (this.exportAllF){
						KERN.a.forEach(rcvRoot=>{
							otherAllA.push({rcvRoot,portA:this.exportAllPortA});});}
					var backlogA = [];
					[this.registerA,otherAllA].forEach(a=>{
						a.forEach(connection=>{ // example: connection = {rcvRoot:{...},portA:[[["coValue0"],["tx"]],[["coValue1"],["co"]],[["coValue2"],["bg"]],[["valueA",5],["somethingAA",14,32]]]}
							var datA = [];
							connection.portA.forEach(pair=>{ // example: pair = [["valueA",5],["somethingAA",14,32]]
								var sndChain = pair[0];
								//KERN.ll("----");
								//KERN.ll(this.ifFullExportForceF);
								//KERN.ll("----");
								//KERN.ll(this.ifFullExport(["lolcatz"])); // !!! HERE, this is a joke code line that should ALWAYS return false, but it's returning true sometimes ...
								if (!this.ifFullExport(sndChain)){return;}
								// v warning: this line's if() will only refer to, consistently, the same changed-information until we call import() again
								// v          if this element feeds into itself, it will modify those if() returns while we're in the middle of export() logic
								// v          the fix here was to make sure the import()s come after the all the logic here is over
// !!! if possible, only send properties that have changed
//if (!this.if(sndChain[0])){return;} // property not changed, don't send it
								var rcvChain = pair[1];
								var sndValue = _;
								for (var sndChainI = 0,sndChainC = sndChain.length; sndChainI < sndChainC; sndChainI++){
									sndValue = sndValue[sndChain[sndChainI]];}
								var res = rcvChain.slice(); // slice quickly duplicates this one-level, array of primitives
								var propertyname = sndChain[0];
								var guide = this.portOutP.find(propertyname); // example: guide = ["elephantOA",KERN.typeO.array,KERN.typeO.object,KERN.typeO.flag]
								if (typeof guide === "undefined"){ll("KERN ERROR : Element "+this.name+"_"+this.counter+" attempted to send a not-accepted property : "+propertyname,this.portOutP.arr);return;}
								var typeBase = guide[1];
								var typeLeaf = guide[guide.length-1];
								// ! don't send signals on an automatic push, a.k.a. the setup push, the on-link-register trigger
								if (blockSignalF && typeLeaf === KERN.typeO.signal){return;}
								if (typeBase === KERN.typeO.array || typeBase === KERN.typeO.object || typeBase === KERN.typeO.complex){res.push(KERN.cc(sndValue));}
								else{res.push(sndValue);}
								datA.push(res);});
							if (datA.length > 0){
								backlogA.push({root:connection.rcvRoot,datA});}});});
					backlogA.forEach(v=>{
						if (KERN.debugF){KERN.ll("#"+this.counter+" --"+JSON.stringify(v.datA)+"-> #"+v.root.counter);}
						v.root.import(v.datA);});
					this.export_SUB();
					this.alteredPropertyFullExportP.clear();
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ export "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				destroy_SUB   : function(){},
				destroy       : function(){if (KERN.debugF){var startT = KERN.now();KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"v destroy "+this.name+"_"+this.counter);KERN.debugIndentLevel++;}
					KERN.uniani.unregister("KERN_"+that.counter);
					this.registerA.length = 0;
					// make everyone forget about this element
					KERN.a.forEach(v=>{
						var entryI = v.registerA.findIndex(v=>v.rcvRoot===o.rcvRoot);
						if (entryI === -1){return;} // apparently our work is not needed
						v.registerA.splice(entryI,1);});
					var _;while (_=this.elP.firstChild){this.elP.removeChild(_);}
					this.setup_SUB = function(){};
					this.importInitialForce_SUB = function(){};
					this.import_SUB = function(){};
					this.stabilize_SUB = function(){};
					this.refresh_SUB = function(){};
					this.refreshResize_SUB = function(){};
					this.drawFrame_SUB = function(){};
					this.export_SUB = function(){};
					this.destroy_SUB();
					this.destroy_SUB = function(){};
					if (KERN.debugF){var endT = KERN.now();KERN.debugIndentLevel--;if (endT - startT > KERN.debugMicrosecondTolerance){KERN.ll(KERN.debugIndentS.repeat(KERN.debugIndentLevel)+"^ export "+this.name+"_"+this.counter+" "+(endT-startT)+"µs");}}},
				
				toString      : function(){return "KERN ELEMENT #"+this.counter+"("+this.name+")";},
			};
			KERN.a.push(oo);
			return oo;
		},
	};
	//window.addEventListener("resize",()=>{KERN.a.forEach(root=>{root.refreshResize();});});
	document.addEventListener("DOMContentLoaded",function(){KERN.uniani.start();});
})();
