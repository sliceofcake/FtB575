/**********************************************************************************************************************\
* LIBRARY : "BUTLER" | LANGUAGE : "JAVASCRIPT"                                                           [KERN MANUAL] *
************************************************************************************************************************
*                                                                                                                      *
*                                                                          VARIABLE NAMING GUIDE [KERN MANUAL 0000001] *
*                                                                                                                      *
* list of frequently used shorthands
* a   : array
* d   : data
* e   : entity [historically "event", the new style is to just name that "event", spelled out all the way]
* el  : element [in HTML] [when more details given : elExtraInformationAfter]
* fxn : function
* hi  : high, to match the same character count as an shortening of "low", the opposite of high
* i   : iterator [when more details given : iExtraInformationAfter]
* k   : key
* lo  : low, to match the same character count as an shortening of "high", the opposite of low
* m   : mystery, a parameter to a function when you have absolutely no idea what it will be
* n   : number, a parameter to a function
* o   : object [also known as a dictionary], often used to denote the arguments object directly passed to a function [therefore took the place of the historical "p" for "parameter[s]"]
* out : [usually] string, as a result and/or output
* p   : the "personal" object is given this global-scope single-letter variable name. historically meant "parameter". can confusingly be the "prev" of [].reduce((p,v,i,a)=>{})
* q   : query
* res : [usually] not string, as a result and/or output
* r   : an object, as the focus of a loop iteration [largely with tabular data]
* row : an object, as the focus of a loop iteration [largely with tabular data]
* s   : string, a parameter to a function
* str : string, a parameter to a function
* t   : time with respect to UNIX epoch in microseconds
* v   : value, of the current array element, for (var i = 0; i < a.length; i++){var v = a[i];}
* _   : temporary saving, undeserving of a name
* 
* list of suffixes
* A   : array  [#  -value]
* B
* C   : count, of array or object
* D
* E   : Entity, similar to Mystery, but used when more is known. Example: instead of a plushieA, we might have a plushieEA, because plushieEA looks like [["plushie"=>"hello"],["plushie"=>"world"]]. Use E when you don't have a good name for the entity
* F   : flag
* Fxn : function
* G
* H
* I   : iterator, use with arrays, not with objects (use "K" for object iterator "k"eys)
* J
* K   : key as in a key-value pair
* L   : co[L]lection, like an array, but not, such as element.children
* M
* N   : number
* O   : object [key-value]
* P   : performant array, designed to, in some way[s], deliver better performance than a traditional array [ex:pre-sorting] ... I tried with the naming, okay?
* Q   : query, the returned toolbox-object from a call to query()
* R   : resource interface, like a file
* S   : string
* T   : time with respect to UNIX epoch in microseconds
* Tri : tri-state boolean, 1 for positive, 0 for neutral/uncertain/don't-care, -1 for negative
* U
* V   : value as in a key-value pair
* W
* X   : version of the function that doesn't mess with supplied parameters
* Y
* Z
* 
* ~ never use plurals in variable names
* ~ from left to right, name by hypothetical/prudent longest matching
*   L> ex. three variables to name, here are descriptions : first log in time, last log in time, join date
*      L> timeLoginFirst
*      L> timeLoginLast
*      L> timeJoin
* ~ name loop iterators with additional information when possible, unless it's just a tight loop
*   L> for (var logEntryI = 0; logEntryI < logEntryA.length; logEntryI++){}
* ~ do not capitalize the "n" in "name"
*   L> boxnameA[layername] = name;
* 
\**********************************************************************************************************************/
// very little to absolutely no parameter contraint checking will be done here

var ll = (...m)=>{m.forEach(v=>console.log(v));}; // ! see bottom of file [probably] for lld, ll-delayed
var jj = (leaf,property,value="")=>{
	if (typeof leaf           === "undefined" || leaf === N){return value;}
	if (typeof leaf[property] === "undefined"){return value;}
	return leaf[property];};
const T = true;
const F = false;
const N = null;
const U = undefined;

// cannot pass undefined with default parameters, so it gets its own override flag
function int(m,fallback=NaN,undefinedF=F){var _ = parseInt(m);return (Number.isNaN(_)) ? (undefinedF?undefined:fallback) : _;}
function str(m){return m.toString();}
function num(m,fallback=NaN,undefinedF=F){var _ = parseFloat(m);return (Number.isNaN(_)) ? (undefinedF?undefined:fallback) : _;}
function isI(m){return Number.isInteger(m);}
function isN(m){return (typeof m === "number");} // this is for testing Numeric. Numeric beat out Null because Null can be simply, directly tested and Numeric cannot
function isNaN(m){return Number.isNaN(m);}
function isS(m){return (typeof m === "string");}
function isF(m){return (m === true || m === false);}
function isU(m){return (typeof m === "undefined");}
function isA(m){return Array.isArray(m);}
function isO(m){return typeof m === "object" && m !== N && !isA(m);}
function isNumStr(m){return (typeof m === "string" && str(int(m)) === m);};
function isFxn(m){return (typeof m === "function");}

var Ω = {
	mousedownF  : F,
	ID          : 0,
	css         : [],
	timeUpgrade : (()=>{var a,b;a=Date.now();b=performance.now();return(a-b)*1000;})(),
	t           : {},
	fps         : 0,};
document.addEventListener("mousedown",()=>{Ω.mousedownF = T;});
document.addEventListener("mouseup"  ,()=>{Ω.mousedownF = F;});

// element stuff
var µ = {
	// query selector x (left to right direction)
	qx:function(el,n){
		if (n === 0){return el;}
		else if (n > 0){
			var res = el;
			for (var i = 0; i < n; i++){res = res.firstChild;}
			return res;}
		else if (n < 0){
			var res = el;
			for (var i = 0; i > n; i--){res = res.parentNode;}
			return res;}},
	// query selector y (bottom to top direction) note : note that this direction is like cartesian y
	qy:function(el,n){
		if (n === 0){return el;}
		else if (n > 0){
			var res = el;
			for (var i = 0; i < n; i++){res = res.previousSibling;}
			return res;}
		else if (n < 0){
			var res = el;
			for (var i = 0; i > n; i--){res = res.nextSibling;}
			return res;}},
	// query selector from a BSCSS element's main inner element to find a different same-level BSCSS element's main inner element
	qbscss:function(el,label){
		return this.qd(this.ql(el.parentNode,"[data-label='"+label+"']"),":not(.label)");},
	// query selector down
	qd:function(el,m){
		if (typeof m === "undefined"){m = el;el = document.body;} // alternate use
		if (el === null){return null;}
		return el.querySelector(this.qRepl(m));},
	// query selector down array [all]
	qdA:function(el,m){
		if (typeof m === "undefined"){m = el;el = document.body;} // alternate use
		if (el === null){return null;}
		var res = [];
		var elA = el.querySelectorAll(this.qRepl(m));
		for (var i = 0; i < elA.length; i++){
			res.push(elA[i]);}
		return res;},
	// query selector immediate children
	qc:function(el,m){
		if (el === null){return null;}
		var childA = this.ic2(el);
		for (var i = 0; i < childA.length; i++){var k = childA[i];
			if (this.matches(k,m)){return k;}}
		return null;},
	// query selector up
	qu:function(el,m){
		if (el === null){return null;}
		var elP = el.parentNode;
		if (elP === null || elP === document){return null;}
		if (this.matches(elP,m)){return elP;}
		return this.qu(elP,m);},
	// query selector lateral
	ql:function(el,m){
		if (el === null){return null;}
		var elP = el.parentNode;
		if (elP === null){return null;}
		for (var child of this.ic2(elP)){
			if (child !== el && this.matches(child,m)){return child;}}
		return null;},
	// query selector up, and [dead-end-]lateral per level ; includes a lateral search of initial level
	qul:function(el,m){
		if (el === null){return null;}
		if (this.matches(el,m)){return el;}
		var elL = this.ql(el,m);
		if (elL !== null){return elL;}
		var elP = el.parentNode;
		if (elP === null || elP === document){return null;}
		return this.qul(elP,m);},
	// query selector up, then down ; used often for triggered buttons gathering inputs
	qud:function(el,m,mm){
		if (el === null){return null;}
		return this.qd(this.qu(el,m),mm);},
	// get attribute
	ga:function(el,m){
		if (!el.hasAttribute(m)){return "";}
		return el.getAttribute(m);},
	// set attribute
	sa:function(el,m,mm){return el.setAttribute(m,mm);},
	// toggle display
	tg:function(el,showState){
		if (el === null){return;}
		if (typeof showState === "undefined"){showState = "block";}
		// getComputedStyle causes a larger performance hit, so only resort to it if we absolute have to
		if (el.style.display === ""){
			el.style.display = (getComputedStyle(el).display===showState)?"none":showState;}
		else{
			el.style.display = (el.style.display===showState)?"none":showState;}},
	// element immediate children, without weird bugs
	// !!! 2 Aug 2016 ~ discovered to be significantly slower [10x~100x slower] than the non-array .children alternative for document.head with ~300 children
	ic:function(el){
		var res = [];
		var c = el.children;
		for (var i = 0; i < c.length; i++){
			res.push(c[i]);}
		return res;},
	// 2 Aug 2016 ~ since we implemented all the forEach,map,reduce,etc. functions for objects, we can just use this directly for high/tight performance blocks
	ic2:function(el){return el.children;},
	// replace ¥ with data-type property, § with data-id property
	// there will be exactly 0 or 1 ¥ and exactly 0 or 1 §
	qRepl:function(s){
		if (π.cins("¥",s)){s = s.replace(/¥([a-zA-Z0-9\-_]+)/g,function(m,p1){return "[data-type='"+p1+"']";});}
		if (π.cins("§",s)){s = s.replace(/§([a-zA-Z0-9\-_]+)/g,function(m,p1){return "[data-id='"+p1+"']";});}
		return s;},
	// el.matches(s), but with data-type handling
	// ! ¥(yen) attributes, meaning "data-type", must come before single quotes ~ this falls in line with my style and makes the regex easier to write
	matches:function(el,s){
		return el.matches(s
			.replace(/^[^']*¥([a-zA-Z0-9\-_]+)/g,function(m,p1){return "[data-type='"+p1+"']";})
			.replace(/§([a-zA-Z0-9\-_]+)/g,function(m,p1){return "[data-id='"+p1+"']"  ;}));},
	// query convert
	// use with caution, as regexes match my specific needs at this moment - they do not adhere strictly to the query standard
	qcnv:function(s){
		var o = {d:{class:""}};
		s = s.replace(/\[([a-zA-Z0-9\-_]+)\=\'((?:\\.|[^\'])*)\'\]/g,function(o){return function(match,p1,p2){ // \'([^\]]*)\' not good enough for embedded, escaped quotes
			o.d[p1] = p2;
			return "";};}(o));
		s = s.replace(/\.([a-zA-Z0-9\-_]+)/g,function(o){return function(match,p1){
			if (o.d.class !== ""){o.d.class += " ";}
			o.d.class += p1;
			return "";};}(o));
		s = s.replace(/¥([a-zA-Z0-9\-_]+)/g,function(o){return function(match,p1){
			o.d["data-type"] = p1;
			return "";};}(o));
		s = s.replace(/§([a-zA-Z0-9\-_]+)/g,function(o){return function(match,p1){
			o.d["data-id"] = p1;
			return "";};}(o));
		if (s !== ""){
			o.type = s;}
		return o;},
	// element macro
	m:function(o,qReplFxnA=[]){
		if (o === null){return o;}
		if (typeof o                 === "undefined"){o = {};} // default to long mode
		// short mode, translates to long mode
		if (isA(o)){
			var oo = {};
			// [query:""]
			if (o.length === 1 && typeof o[0] === "string"){
				var o0 = o[0];qReplFxnA.forEach(qReplFxn=>{o0 = qReplFxn(o0);});
				oo = this.qcnv(o0);}
			// [childA:[]]
			else if (o.length === 1 && typeof o[0] === "object" && isA(o[0])){
				var o0 = "";qReplFxnA.forEach(qReplFxn=>{o0 = qReplFxn(o0);}); // this is needed for qReplFxns that add to a possibly blank q
				oo = this.qcnv(o0);
				oo.childA = o[0];}
			// [query:"",html:""]
			else if (o.length === 2 && typeof o[0] === "string" && (typeof o[1] === "string" || typeof o[1] === "number")){
				var o0 = o[0];qReplFxnA.forEach(qReplFxn=>{o0 = qReplFxn(o0);});
				oo = this.qcnv(o0);
				oo.html = (typeof o[1] === "number") ? o[1].toString() : o[1];}
			// [query:"",listenerO+z:{},html:""]
			else if (o.length === 3 && typeof o[0] === "string" && typeof o[1] === "object" && !isA(o[1]) && (typeof o[2] === "string" || typeof o[2] === "number")){
				var o0 = o[0];qReplFxnA.forEach(qReplFxn=>{o0 = qReplFxn(o0);});
				oo = this.qcnv(o0);
				oo.listenerO = o[1];//π.cc(o[1]);
				if (typeof o[1].z !== "undefined"){oo.z = o[1].z;delete oo.listenerO.z;}
				oo.html = (typeof o[2] === "number") ? o[2].toString() : o[2];}
			// [query:"",childA:[]]
			else if (o.length === 2 && typeof o[0] === "string" && typeof o[1] === "object" && isA(o[1])){
				var o0 = o[0];qReplFxnA.forEach(qReplFxn=>{o0 = qReplFxn(o0);});
				oo = this.qcnv(o0);
				oo.childA = o[1];}
			// [query:"",listenerO+z:{}]
			else if (o.length === 2 && typeof o[0] === "string" && typeof o[1] === "object" && !isA(o[1])){
				var o0 = o[0];qReplFxnA.forEach(qReplFxn=>{o0 = qReplFxn(o0);});
				oo = this.qcnv(o0);
				oo.listenerO = o[1];//π.cc(o[1]);
				if (typeof o[1].z !== "undefined"){oo.z = o[1].z;delete oo.listenerO.z;}}
			// [query:"",listenerO+z:{},childA:[]]
			else if (o.length === 3 && typeof o[0] === "string" && typeof o[1] === "object" && !isA(o[1]) && typeof o[2] === "object" && isA(o[2])){
				var o0 = o[0];qReplFxnA.forEach(qReplFxn=>{o0 = qReplFxn(o0);});
				oo = this.qcnv(o0);
				oo.listenerO = o[1];//π.cc(o[1]);
				if (typeof o[1].z !== "undefined"){oo.z = o[1].z;delete oo.listenerO.z;}
				oo.childA = o[2];}
			o = oo;}
		if (typeof o !== "object"){console.log("******* µ.m FAILURE : "+typeof o+" : "+o);}
		// long mode
		if (typeof o.type      === "undefined"){o.type = "div";}
		if (typeof o.d         === "undefined"){o.d = {};}
		if (typeof o.z         === "undefined"){o.z = {};} // directly attached variables
		if (typeof o.init      === "undefined"){o.init = ()=>{};}
		if (typeof o.d.style   !== "undefined"){o.d.style = this.css(o.d.style);}
		if (typeof o.html      === "undefined"){o.html = "";}o.html = str(o.html);
		if (typeof o.css       === "undefined"){o.css = {};}
		if (typeof o.markupF   === "undefined"){o.markupF = false;}
		if (typeof o.listenerO === "undefined"){o.listenerO = {};}
		if (typeof o.childA    === "undefined"){o.childA    = [];}
		
		var el = document.createElement(o.type);
		for (var k of Object.keys(o.d)){var v = o.d[k];
			el.setAttribute(k,v);}
		for (var k of Object.keys(o.z)){var v = o.z[k];
			el[k] = v;}
		
		// css variables
		// !!! defunct DECO replaced by actual "CSS Variables" remove eventually
		/*if (typeof el.DECO === "undefined"){el.DECO = {};}
		if (elP !== null && typeof elP.DECO !== "undefined"){
			π.ooa(el.DECO,elP.DECO);}
		else{
			π.ooa(el.DECO,{tx:p.tx,co:p.co,bg:p.bg,});}
		el.setAttribute("data-decouniq",π.jsonE(el.DECO).replace(/'/g,"\\'"));*/
		
		if (o.html.length > 0){
			txt = o.html.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/'/g,"&apos;").replace(/"/g,"&quot;").replace(/\t/g,"&nbsp;&nbsp;&nbsp;&nbsp;").replace(/\s\s/g,"&nbsp;&nbsp;").replace(/\n\s/g,"\n&nbsp;").replace(/\n/g,"<br>");
			if (o.markupF){
				var i = 0;
				var txt_PREV = txt;
				while (i === 0 || (i < 100 && txt !== txt_PREV)){
					txt_PREV = txt;
					txt = txt.replace(/\[line:(solid|dotted|dashed|transparent)\](?:\<br\>\n)?/im,'<span class="bb_line" data-type="$1"></span>');
					txt = txt.replace(/\[link:(https?:\/\/.*?)\]/im,'<a class="bb_link" href="$1" target="_blank">$1</a>');
					txt = txt.replace(/\[image:(https?:\/\/.*?)\]/im,'<img class="bb_image" src="$1">');
					txt = txt.replace(/\[fixedwidth\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|fixedwidth\]/im,'<span class="bb_fixedwidth">$1</span>');
					txt = txt.replace(/\[bold\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|bold\]/im,'<span class="bb_bold">$1</span>');
					txt = txt.replace(/\[italic\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|italic\]/im,'<span class="bb_italic">$1</span>');
					txt = txt.replace(/\[strikethrough\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|strikethrough\]/im,'<span class="bb_strikethrough">$1</span>');
					txt = txt.replace(/\[size:([0123456789]|[123456789][0123456789]|[12][0123456789][0123456789])\%\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|size\]/im,'<span class="bb_size" style="font-size:$1%;">$2</span>');
					txt = txt.replace(/\[underline\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|underline\]/im,'<span class="bb_underline">$1</span>');
					txt = txt.replace(/\[rainbow\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|rainbow\]/im,'<span class="bb_rainbow">$1</span>');
					txt = txt.replace(/\[doublerainbow\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|doublerainbow\]/im,'<span class="bb_doublerainbow">$1</span>');
					txt = txt.replace(/\[spoiler\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|spoiler\]/im,'<span class="bb_spoiler">$1</span>');
					txt = txt.replace(/\[quote\|(?:\<br\>\n)?(.*?)(?:\<br\>\n)?\|quote\]/im,'<span class="bb_quote">$1</span>');
					i++;}
				//txt = nl2br(txt)
				}
			el.innerHTML = txt}
		// special overwrite, has priority over html, for css formatting from object format
		var css = "";
		if (Object.keys(o.css).length > 0){
			for (k of Object.keys(o.css)){var v = o.css[k];
				k = this.qRepl(k);
				css += k+"{"+this.css(v)+"}\n";}
			el.textContent = css;}
		
		// hook up listeners
		for (var k of Object.keys(o.listenerO)){var v = o.listenerO[k];
			el.addEventListener(k,v);}
		// recurse for children
		for (var i = 0; i < o.childA.length; i++){var v = o.childA[i];
			//this.ma(el,this.m(v)); // I think this is unnecessary [00:50] 17 Jan 2016
			var elInner = this.m(v,qReplFxnA);
			if (elInner !== null){el.appendChild(elInner);}}
		return el;},
	cssCompile:function(cssO){
		var css = "";
		cssO.forEach((v,i)=>{
			css += this.qRepl(i)+"{"+this.css(v)+"}\n";});
		return css;},
	// element [macro] assert
	ma:function(elOut,elIn){
		if (elOut === N){return;}
		var elID_elIn = this.elID(elIn);
		var elMatch = this.ic2(elOut).find(v=>this.elID(v)===elID_elIn);
		if (typeof elMatch === "undefined"){elOut.appendChild(elIn);return T;} // no partner found ; append
		if (elIn.innerHTML === elMatch.innerHTML){return F;} // partner found, but matched ; nop [this will ignore listeners]
		elOut.replaceChild(elIn,elMatch);return T;}, // partner found, not matched ; overwrite
	// performant version for use with css <style> ma() calls [that uses data-unique for quicker finds/comparisons]
	maCSS:function(elOut,dataUniqueS,cssS){
		var elMatch = elOut.querySelector(":scope>[data-unique='"+dataUniqueS+"']");
		if (elMatch === N){
			var elIn = µ.m({type:"style",d:{"data-unique":dataUniqueS}});
			elIn.textContent = cssS;
			elOut.appendChild(elIn);return T;} // no partner found ; append
		if (elMatch.textContent === cssS){return F;} // partner found, but matched ; nop [this will ignore listeners]
		elMatch.textContent = cssS;return T;}, // partner found, not matched ; overwrite
	// element [macro] dessert
	md:function(elOut,elIn){
		if (elIn === null){return;} // well apparently that el has already be desserted
		if (elOut.contains(elIn)){elOut.removeChild(elIn);}},
	// empty children
	// !!! controversial
	empty:function(el){var _;while (_=el.firstChild){el.removeChild(_);}},
	// get attribute array [all]
	gaO:function(el){
		var res = {};
		var attributeEww = el.attributes;
		for (var i = 0; i < attributeEww.length; i++){var attribute = attributeEww[i];
			res[attribute.nodeName] = attribute.nodeValue;}
		return res;},
	// performant version of gaO with attribute pruning built it for use with elID()
	gaO_elID_ver:function(el){
		var res = {};
		var attributeEww = el.attributes;
		for (var i = 0; i < attributeEww.length; i++){var attribute = attributeEww[i];
			nodeName = attribute.nodeName;
			if (nodeName !== "value" && nodeName !== "style" && !nodeName.startsWith("data-keep-")){
				res[nodeName] = attribute.nodeValue;}}
		return res;},
	// get info to compare elements, certain attributes are exempt
	// !!! blindly assumes object attribute sorting by key, by the browser
	elID:function(el){return JSON.stringify(this.gaO_elID_ver(el));}, 
	// element [macro] root replace
	// optimize the living carp out of this
	rr:function(elOld,elNew,level=0){
		var log = function(s){return;console.log(" ".repeat(level)+s);};
		log(this.elID(elOld));//log(elOld);
		log(this.elID(elNew));//log(elNew);
		// the "ignore" directive
		//if (this.ga(elOld,"data-ignore") === "1"){log("ignoring");return;}
		
		// if macros are equal, nothing to do
		if (elOld.innerHTML === elNew.innerHTML){log("equal,stop");return F;}
		
		// if leaf, do assert
		var childOldA = this.ic(elOld);
		var childNewA = this.ic(elNew);
		if (childOldA.length === 0 && childNewA.length === 0){ // then they must therefore be differing text nodes
			log("leaf");
			//var elP = elOld.parentNode;
			//elP.removeChild(elOld);
			//elP.appendChild(elNew);
			elOld.innerHTML = elNew.innerHTML; //elOld.textContent = elNew.textContent;
			return T;}
		
		// if child count differs, replace everything
		if (childOldA.length !== childNewA.length){
			log("child count differs");
			this.empty(elOld);
			childNewA.forEach(v=>elOld.appendChild(v));
			return T;}
		
		// if child elID chains differ, replace everything
		var chainOld = childOldA.reduce((p,v)=>p+this.elID(v),"");
		var chainNew = childNewA.reduce((p,v)=>p+this.elID(v),"");
		if (chainOld !== chainNew){log("child chains differ");//log("child chains differ : "+chainOld+" ... "+chainNew);
			this.empty(elOld);
			childNewA.forEach(v=>elOld.appendChild(v));
			return T;}
		
		// [elID chains same and non-empty] recursively run per differing child
		log("drop down");
		var orF = F;
		// ! beware of orF short circuiting
		childOldA.forEach((v,i)=>{log("opening : "+this.elID(v));orF = this.rr(v,childNewA[i],level+1) || orF;})
		return orF;},
	// root replace / macro assert
	rrma:function(elP,elOld,elNew){
		if (elOld === null){this.ma(elP  ,elNew);}
		else               {this.rr(elOld,elNew);}},
	// element [macro] root replace
	rrr:function(DOM,m,mm){ // DOM, DOM's underlying macro, desired macro
		// is current node same?
		;
		// ?
		},
	// insert split elements between macro elements
	msplit:function(A,split,opt={}){
		if (typeof opt.top    === "undefined"){opt.top    = true;}
		if (typeof opt.bottom === "undefined"){opt.bottom = true;}
		var res = [];
		if (opt.top && A.length > 0){res.push(split);}
		for (var i = 0; i < A.length; i++){
			if (i !== 0){res.push(split);}
			res.push(A[i]);}
		if (opt.bottom && A.length > 0){res.push(split);}
		return res;},
	// !!! remove eventually - defunct DECO dynamic CSS scheme replaced by CSS variables
	/*csse:function(dataUnique){
		var rr = π.reductionRatio(800,800);
		var rrn = (n)=>Math.ceil(rr*n);
		var css = {};
		// for each rule
		Ω.css[dataUnique]().forEach(a=>{
			// for each el that matches the rule
			var qMatch = (typeof a[3] !== "undefined" ? a[3] : a[0])("");
			µ.qdA(document,qMatch).forEach(el=>{
				// generate a css line
				var decoHash = π.jsonE(a[1](el.DECO).concat(rr)).replace(/'/g,"\\'"); // rrn is so common, build it into the dependency array
				µ.sa(el,"data-decohash",decoHash);
				a[2].forEach(r=>{
					var qFinal = a[0]("[data-decohash='"+decoHash+"']");
					if (r[0] !== null){qFinal += r[0];}
					css[qFinal] = r[1](π.ooa(el.DECO,{rr,rrn,}));
				});
			});
		});
		µ.ma(document.head,µ.m({type:"style",d:{"data-unique":dataUnique},css}));},*/
	cssO:function(cssO){
		return cssO.mapO((v,i)=>({[i]:this.css(v)}));},
	// css shorthand translate
	css:function(s){
		var cssTranslateCallbackZero = function(m,p1){
			switch (p1){
				case "reset"       :return "all:initial;";
				case "absolute"    :return "position:absolute;";
				case "relative"    :return "position:relative;";
				case "fixed"       :return "position:fixed;";
				case "NE"          :return "top:0px;right:0px;";
				case "SE"          :return "bottom:0px;right:0px;";
				case "SW"          :return "bottom:0px;left:0px;";
				case "NW"          :return "top:0px;left:0px;";
				case "N"           :return "top:0px;";
				case "E"           :return "right:0px;";
				case "S"           :return "bottom:0px;";
				case "W"           :return "left:0px;";
				case "full-width"  :return "width:100%;";
				case "full-height" :return "height:100%;";
				case "full-screen" :return "width:100%;height:100%;";
				case "hand"        :return "cursor:pointer;";
				case "inline"      :return "display:inline;";
				case "block"       :return "display:block;";
				case "inline-block":return "display:inline-block;";
				case "flex"        :return "display:flex;";
				case "flex-row"    :return "width:100%;display:flex;flex-direction:row;flex-wrap:nowrap;justify-content:flex-start;align-content:stretch;align-items:stretch;";
				case "one-row"     :return "white-space:nowrap;overflow-x:hidden;";
				case "multi-row"   :return "word-wrap:break-word;overflow:auto;";
				case "none"        :return "display:none;";
				default            :return m;}};
		var cssTranslateCallbackOne = function(m,p1,p2){
			switch (p1){
				case "t"   :return "top:"+p2+";";
				case "r"   :return "right:"+p2+";";
				case "b"   :return "bottom:"+p2+";";
				case "l"   :return "left:"+p2+";";
				case "w"   :return "width:"+p2+";";
				case "h"   :return "height:"+p2+";";
				case "s"   :return "width:"+p2+";height:"+p2+";";
				case "wmin":return "min-width:"+p2+";";
				case "hmin":return "min-height:"+p2+";";
				case "wmax":return "max-width:"+p2+";";
				case "hmax":return "max-height:"+p2+";";
				case "flex-ss":return "flex:1 1 auto;width:"+p2+";min-width:"+p2+";max-width:"+p2+";";
				case "flex-rs":return "flex:1000 1 auto;text-align:right;max-width:"+p2+";";
				case "flex-rw":return "flex:1000 1000 auto;text-align:right;min-width:"+p2+";";
				case "flex-ls":return "flex:1000 1 auto;text-align:left;max-width:"+p2+";";
				case "flex-lw":return "flex:1000 1000 auto;text-align:left;min-width:"+p2+";";
				case "c"   :return "color:"+p2+";";
				case "bgc" :return "background-color:"+p2+";";
				case "bg"  :return "background:"+p2+";"; // ¥bg overrides things like background-clip - use ¥bgi for gradient ¥bgc
				case "m"   :return "margin:"+p2+";";
				case "mt"  :return "margin-top:"+p2+";";
				case "mr"  :return "margin-right:"+p2+";";
				case "mb"  :return "margin-bottom:"+p2+";";
				case "ml"  :return "margin-left:"+p2+";";
				case "p"   :return "padding:"+p2+";";
				case "pt"  :return "padding-top:"+p2+";";
				case "pr"  :return "padding-right:"+p2+";";
				case "pb"  :return "padding-bottom:"+p2+";";
				case "pl"  :return "padding-left:"+p2+";";
				case "bo"  :return "border:"+p2+";";
				case "bt"  :return "border-top:"+p2+";";
				case "br"  :return "border-right:"+p2+";";
				case "bb"  :return "border-bottom:"+p2+";";
				case "bl"  :return "border-left:"+p2+";";
				case "brad":return "border-radius:"+p2+";";
				case "bc"  :return "border-color:"+p2+";";
				case "bgr" :return "background-repeat:"+p2+";";
				case "bgs" :return "background-size:"+p2+";";
				case "bgo" :return "background-origin:"+p2+";";
				case "bgp" :return "background-position:"+p2+";";
				case "bga" :return "background-attachment:"+p2+";";
				case "bgi" :return "background-image:"+p2+";";
				case "bsw" :return "box-shadow:"+p2+";";
				case "tsw" :return "text-shadow:"+p2+";";
				case "z"   :return "z-index:"+p2+";";
				case "f"   :return "float:"+p2+";";
				case "fs"  :return "font-size:"+p2+";";
				case "ff"  :return "font-family:"+p2+";";
				case "op"  :return "opacity:"+p2+";";
				case "o"   :return "overflow:"+p2+";";
				case "ox"  :return "overflow-x:"+p2+";";
				case "oy"  :return "overflow-y:"+p2+";";
				case "ws"  :return "white-space:"+p2+";";
				case "ta"  :return "text-align:"+p2+";";
				case "z"   :return "z-index:"+p2+";";
				default    :return m;}};
		s = s.replace(/([0-9]+(?:.[0-9]+)?)‰/g,function(m,p1){return str(num(p1)/10)+"%";});
		s = s.replace(/¥:([^¥:;]+);/g,cssTranslateCallbackZero);
		s = s.replace(/¥([^¥:;]+):([^;]+);/g,cssTranslateCallbackOne);
		return s;},
	// generate a bullshit-css™ element
	bscss:function(label,macro,q="",qLabel=""){
		return [q+".BSCSS[data-label='"+label+"']",[
			macro,
			[qLabel+".label",label],]];},
	offsetLeftTotal:function(el){
		var left = 0;
		do {
			left += el.offsetLeft || 0;
			el = el.offsetParent;
		}while(el);
		return left;},
	offsetTopTotal   :function(el){var top  = 0;do {top  += el.offsetTop  || 0;el = el.offsetParent;}while(el);return top ;},
	offsetRightTotal :function(el){return µ.offsetLeftTotal(el)+el.offsetWidth ;},
	offsetBottomTotal:function(el){return µ.offsetTopTotal (el)+el.offsetHeight;},
	offsetLeftTotal  :function(el){var left = 0;do {left += el.offsetLeft || 0;el = el.offsetParent;}while(el);return left;},
	onLoad:function(fxn){
		document.addEventListener("DOMContentLoaded",fxn);},
	// event trigger
	// !!! not yet tested adequately. seems to fail to render a visual mousedown with a button
	eTrig : function(el=N,eventS="click",exO={}){
		if (el === N){return;}
		var event = new MouseEvent(eventS,π.ooas({
			"view"       : window,
			"bubbles"    : T,
			"cancelable" : T,},exO));
		var canceled = !el.dispatchEvent(event); // whether a handler called preventDefault
		},
	// for now, expects given element or a [recursive-]parent to have its z-index defined, like for use with multiple panels/windows to compare to other panels/windows
	calcZIndex : function(el){
		var zIndex = undefined;
		while (el !== document.body && (zIndex=getComputedStyle(el).getPropertyValue("z-index")) === "auto"){
			el = el.parentNode;}
		return zIndex;},
};

// other stuff
var π = {
	// generate a unique id, an integer
	genID:function(){
		return Ω.ID++;},
	// !!! replacing of arrays ... there are a few ways it could be done
	// array <-- array ; property absorb
	// ([1,2,3],[3,4,5],{blockDuplicate:true }) --> [1,2,3,4,5]
	// ([1,2,3],[3,4,5],{blockDuplicate:false}) --> [1,2,3,3,4,5]
	aaAbsorb:function(a,aa,opt={}){
		if (typeof opt.blockDuplicate === "undefined"){opt.blockDuplicate = false;}
		for (var i = 0; i < aa.length; i++){var v = aa[i];
			if (!opt.blockDuplicate || !a.includes(v)){
				a.push(v);}}
		return a;},
	// object <-- array ; property absorb
	oaAbsorb:function(o,a,keyname,opt={}){
		if (typeof opt.blockDuplicate === "undefined"){opt.blockDuplicate = false;}
		for (var i = 0; i < a.length; i++){var v = a[i];var k = v[keyname];
			if (!opt.blockDuplicate || typeof o[k] === "undefined"){
				o[k] = v;}}
		return o;},
	// object <-- object ; property absorb
	ooAbsorb:function(o,oo,opt={}){
		if (typeof opt.blockDuplicate === "undefined"){opt.blockDuplicate = false;}
		for (var k of Object.keys(oo)){var v = oo[k];
			if (!opt.blockDuplicate || typeof o[k] === "undefined"){
				o[k] = v;}}
		return o;},
	// array <-- object ; property absorb
	aoAbsorb:function(a,o,opt={}){
		if (typeof opt.blockDuplicate === "undefined"){opt.blockDuplicate = false;}
		for (var k of Object.keys(oo)){var v = oo[k];
			if (!opt.blockDuplicate || !a.includes(v)){
				a.push(v);}}
		return a;},
	// absorption shorthands
	// default (strong)
	aaa:function(){return this.aaas.apply(this,arguments);},
	oaa:function(){return this.oaas.apply(this,arguments);},
	ooa:function(){return this.ooas.apply(this,arguments);},
	aoa:function(){return this.aoas.apply(this,arguments);},
	// (strong)
	aaas:function(a,aa  ){return this.aaAbsorb(a,aa,  {blockDuplicate:false});},
	oaas:function(o,a ,k){return this.oaAbsorb(o,a ,k,{blockDuplicate:false});},
	ooas:function(o,oo  ){return this.ooAbsorb(o,oo,  {blockDuplicate:false});},
	aoas:function(a,o   ){return this.aoAbsorb(a,o ,  {blockDuplicate:false});},
	// (weak)
	aaaw:function(a,aa  ){return this.aaAbsorb(a,aa,  {blockDuplicate:true });},
	oaaw:function(o,a ,k){return this.oaAbsorb(o,a ,k,{blockDuplicate:true });},
	ooaw:function(o,oo  ){return this.ooAbsorb(o,oo,  {blockDuplicate:true });},
	aoaw:function(a,o   ){return this.aoAbsorb(a,o ,  {blockDuplicate:true });},
	// ooaw, used so often for parameters
	p:function(o,oo){return this.ooaw(o,oo);},
	// object-object equal[ity]
	ooe:function(o,oo){
		return JSON.stringify(o)===JSON.stringify(oo);},
	// object key restrict
	kr:function(m,keyA){
		m.forEach((v,i)=>{
			if (!keyA.includes(i)){
				delete m[i];}});
		return m;},
	krX:function(m,keyA){
		return m.filter((v,i)=>keyA.includes(i));},
	// create an array with the specified amount of m, shallow copied
	mA:function(m,count){
		var a = [];
		for (var i = 0; i < count; i++){
			a.push(m);}
		return a;},
	// create an array with specified amount of inner arrays
	axaA:function(count){
		var arr = [];
		for (var i = 0; i < count; i++){arr[i] = [];}
		return arr;},
	// carbon copy [deep copy]
	cc_OLD:function(m){return (typeof m === "object" && m !== null) ? m.map(v=>this.cc(v)) : m;},
	// quick attempt, again [deep copy]
	cc:function(m){
		if (m instanceof File){
			return m;}
		else if (typeof m === "object"){
			if (m === null){return m;}
			if (Array.isArray(m)){
				var res = new Array(m.length);
				for (var i = 0; i < m.length; i++){
					res[i] = π.cc(m[i]);}
				return res;}
			else{
				var res = {};
				var keyA = Object.keys(m);
				for (var i = 0; i < keyA.length; i++){var k = keyA[i];
					res[k] = π.cc(m[k]);}
				return res;}}
		else{return m;}},
	// quick, minimal carbon copy
	// !!! was incorrectly handling dictionary attributes, and was not faster than π.cc
	/*ccm:function(m){
		switch (typeof m){default : return undefined;
		break;case "undefined" : return m;
		break;case "object"    : // dictionary, array, null
			if      (m === null      ){return m;}
			else if (Array.isArray(m)){return m.map(v=>this.ccm(v));}
			else                      {
				var res = {};
				for (k of Object.keys(m)){
					var _ = this.ccm(m[k]);
					if (typeof _ !== "undefined"){res[k] = _;}}
				return res;}
		break;case "boolean"   : return m;
		break;case "number"    : return m;
		break;case "string"    : return m;
		break;case "symbol"    : return undefined;
		break;case "function"  : return undefined;}},*/
	// string split, the way it should have been written
	split:function(s,delimiter){
		if (s.length === 0){return [];}
		return s.split(delimiter);},
	// tri-state flag translate
	tri:function(m){
		if (m === "+"
		||  m === "hi"
		||  m === "high"
		||  m === "1"
		||  m === 1
		||  m === "yes"
		||  m === "yeah"
		||  m === "ええ"
		||  m === "sí"
		||  m === "y"
		||  m === "yep"
		||  m === "yup"
		||  m === "ye"
		||  m === "yee"
		||  m === "alright"
		||  m === "aight"
		||  m === "okay"
		||  m === "sure"
		||  m === "affirmative"
		||  m === "positive"
		||  m === true){return 1;}
		if (m === "~"
		||  m === ""
		||  m === "0"
		||  m === "not sure"
		||  m === "uncertain"
		||  m === "dunno"
		||  m === "idk"
		||  m === "uhh"
		||  m === "dont know"
		||  m === "don't know"
		||  m === "neutral"
		||  m === "unknown"
		||  m === 0){return 0;}
		if (m === "-"
		||  m === "lo"
		||  m === "low"
		||  m === "-1"
		||  m === -1
		||  m === "n"
		||  m === "no"
		||  m === "naw"
		||  m === "nein"
		||  m === "いいえ"
		||  m === "nope"
		||  m === "nah"
		||  m === "no way"
		||  m === "ahh hell no"
		||  m === "ahh hell naw"
		||  m === "ahh hellz no"
		||  m === "ahh hellz naw"
		||  m === "lol no"
		||  m === "how about no"
		||  m === "negative"
		||  m === false){return -1;}
		return 0;},
	// repeat the string the given number of times
	// !!! you should probably use "string".repeat(n) now
	multiChar : function(s,n){
		var res = "";
		for (;n>0;n--){res += s;}
		return res;},
	// wrap indexes to fit in a certain array key space
	// "good 'ol wmod(), do you know how long this function has survived? it's crazy."
	wmod : function(value,min,max){
		while (value < min){
			value += (max+1);}
		while (value > max){
			value -= (max+1);}
		return value;},
	// 
	rangeRestrict : function(m,min=0,max=1,fallback=min){
		if (typeof m !== "number"){return fallback;}
		else if (m < min){return min;}
		else if (m > max){return max;}
		else{return m;}},
	// tri-state flag display character
	triS:function(m){
		switch (this.tri(m)){default:return "△";
		break;case  1:return "◯";
		break;case -1:return "✕";}},
	// pad on the left to get minimum width
	padLMin:function(value,totalPlaces,char){
		if (typeof char === "undefined"){char = " ";}
		var s = value.toString();
		if (s.length < totalPlaces){
			var maximum = totalPlaces-s.length;
			for (var i = 0; i < maximum; i++){
				s = char + s;}}
		return s;},
	// force exact char count
	padLAbs:function(value,totalPlaces,char){
		var min = this.padLMin(value,totalPlaces,char);
		if (min.length !== totalPlaces){
			if (typeof value === "number"){
				return "*".repeat(totalPlaces);}
			else{
				return min.substr(0,totalPlaces);}}
		else{
			return min;}},
	// pad on the right to get minimum width
	padRMin:function(value,totalPlaces,char){
		if (typeof char === "undefined"){char = " ";}
		var s = value.toString();
		if (s.length < totalPlaces){
			var maximum = totalPlaces-s.length;
			for (var i = 0; i < maximum; i++){
				s = s + char;}}
		return s;},
	// force exact char count
	padRAbs:function(value,totalPlaces,char){
		var min = this.padRMin(value,totalPlaces,char);
		if (min.length !== totalPlaces){
			if (typeof value === "number"){
				return "*".repeat(totalPlaces);}
			else{
				return min.substr(0,totalPlaces);}}
		else{
			return min;}},
	// chop off decimal places beyond a certain amount for a number
	chop:function(value,keepDec=0){
		var type = typeof value;
		if (type === "string"){value = parseFloat(value);}
		value = Math.round(value*Math.pow(10,keepDec))/Math.pow(10,keepDec);
		return (type === "string")?value.toString():value;},
	// any intersection exists with two arrays
	aaIntersect:function(a,aa){
		for (var i = 0; i < a.length; i++){
			for (var ii = 0; ii < aa.length; ii++){
				if (a[i] === b[ii]){return T;}}}
		return F;},
	// no intersections exist with two arrays
	// !!! untested
	aaDisjunct:function(a,aa){
		for (var i = 0; i < a.length; i++){
			var foundF = F;
			for (var ii = 0; ii < aa.length; ii++){
				if (a[i] === b[ii]){foundF = T;}}
			if (!foundF){return F;}}
		return T;},
	// whether the arrays are equal, disregarding order
	aaSimilar:function(a,aa){return a.length===aa.length&&π.ooe(a.sort(),aa.sort());}, // redundant for performance short-circuiting
	// whether a is subset of aa
	aaIsSubsetOf:function(a,aa){return a.every(v=>aa.includes(v));},
	// random integer, doubly inclusive bounds
	rand:function(low,high){
		return Math.floor(Math.random()*((high+1)-low)+low);},
	// run immediately, and set up setInterval
	intervalCall:function(t,fxn){fxn();return setInterval(fxn,t/1000);},
	intervalClear:function(intervalHandle){clearInterval(intervalHandle);},
	// CSS reduction ratio, multiply this by lengths to get adjusted length for screen size
	reductionRatio:function(baseW,baseH){
		return Math.pow(Math.min(window.innerWidth/baseH,window.innerHeight/baseW),1/3);},
	// MovingAverage object type
	MovingAverage:function(max=100){
		this.arr = [];
		this.max = max;
		this.push = function(n){
			this.arr.push(n);
			while (this.arr.length > this.max){this.arr.shift();}};
		this.calc = function(){
			if (this.arr.length === 0){return NaN;}
			else{return this.arr.reduce((p,v)=>p+v)/this.arr.length;}};},
	// microsecond duration to comfortable format
	durationToEnglish:function(t){
		if (typeof t !== "number"){return "";}
		var u = "microseconds";
		do{
			// microseconds --> milliseconds
			if (t === 1000){t /= 1000;u = "millisecond";break;}
			if (t   > 1000){t /= 1000;u = "milliseconds";}
			// milliseconds --> seconds
			if (t === 1000){t /= 1000;u = "second";break;}
			if (t   > 1000){t /= 1000;u = "seconds";}
			// seconds --> minutes
			if (t === 60){t /= 60;u = "minute";break;}
			if (t   > 60){t /= 60;u = "minutes";}
			// minutes --> hours
			if (t === 60){t /= 60;u = "hour";break;}
			if (t   > 60){t /= 60;u = "hours";}
		}while(false);
		t = Math.ceil(t*10)/10;
		return [t,u];},
	// microsecond timestamp from 1 Jan 1970 UTC to comfortable format, ignoring leap seconds
	// !!! daylight savings
	timestampToEnglish:function(t,precision="second"){
		if (typeof t !== "number"){return "not sure";}
		var makeBold = false;
		var now = p.now() + p.clockOffset;
		var daysPer400 = 365*400 + 97;
		var microsecondsPer400 = daysPer400*24*60*60*1000*1000;
		var year = 1970;
		var month = 0;
		var day = 1;
		var d = {};
		t -= (new Date()).getTimezoneOffset()*60*1000*1000;
		while (t < 0){
			year -= 400;t += microsecondsPer400;}
		d.milliseconds = Math.floor(t/1000);d.microseconds = t % 1000;
		d.seconds = Math.floor(d.milliseconds/1000);d.milliseconds %= 1000;
		d.minutes = Math.floor(d.seconds/60);d.seconds %= 60;
		d.hours   = Math.floor(d.minutes/60);d.minutes %= 60;
		d.days    = Math.floor(d.hours  /24);d.hours   %= 24;
		if (d.days > 0){ // NOT an else if, the above logic cascades
			while (d.days >= daysPer400){year += 400;d.days -= daysPer400;}
			for(;;){
				var leap = 0;
				if (year % 4 === 0){
					leap = 1;
					if (year % 100 === 0 && year % 400 !== 0){leap = 0;}}
				if (d.days >= 31){month =  1;d.days -= 31;}else{break;}
				if (d.days >= 28+leap){month =  2;d.days -= 28+leap;}else{break;}
				if (d.days >= 31){month =  3;d.days -= 31;}else{break;}
				if (d.days >= 30){month =  4;d.days -= 30;}else{break;}
				if (d.days >= 31){month =  5;d.days -= 31;}else{break;}
				if (d.days >= 30){month =  6;d.days -= 30;}else{break;}
				if (d.days >= 31){month =  7;d.days -= 31;}else{break;}
				if (d.days >= 31){month =  8;d.days -= 31;}else{break;}
				if (d.days >= 30){month =  9;d.days -= 30;}else{break;}
				if (d.days >= 31){month = 10;d.days -= 31;}else{break;}
				if (d.days >= 30){month = 11;d.days -= 30;}else{break;}
				if (d.days >= 31){month =  0;d.days -= 31;year++;}else{break;}}}
		day += d.days;
		var nejear = 0;
		while (year <        0){year += 575200;nejear--;}
		while (year >=  575200){year -= 575200;nejear++;}
		var year    = year;//d.getFullYear();
		var month   = month;//d.getMonth();
		var day     = day;//d.getDate();
		var hours   = π.padLMin(d.hours,2,"0");//nx(d.getHours(),2,false);
		var minutes = π.padLMin(d.minutes,2,"0");//nx(d.getMinutes(),2,false);
		var seconds = π.padLMin(d.seconds,2,"0");//nx(d.getSeconds(),2,false);
		var milliseconds = π.padLMin(d.milliseconds,3,"0");
		var microseconds = π.padLMin(d.microseconds,3,"0");
		switch (month){
			case  0:month = "Jan";break;
			case  1:month = "Feb";break;
			case  2:month = "Mar";break;
			case  3:month = "Apr";break;
			case  4:month = "May";break;
			case  5:month = "Jun";break;
			case  6:month = "Jul";break;
			case  7:month = "Aug";break;
			case  8:month = "Sep";break;
			case  9:month = "Oct";break;
			case 10:month = "Nov";break;
			case 11:month = "Dec";break;
			default:month = "";}
		switch (precision){default:
			break;case "microsecond":return (makeBold?"<b>":"") + "[" + hours + ":" + minutes + ":" + seconds + "." + milliseconds + microseconds + "] " + day + " " + month + " " + year + (nejear===0?"":" "+nejear+"N") + (makeBold?"</b>":"");
			break;case "millisecond":return (makeBold?"<b>":"") + "[" + hours + ":" + minutes + ":" + seconds + "." + milliseconds + "] " + day + " " + month + " " + year + (nejear===0?"":" "+nejear+"N") + (makeBold?"</b>":"");
			break;case "second"     :return (makeBold?"<b>":"") + "[" + hours + ":" + minutes + ":" + seconds + "] " + day + " " + month + " " + year + (nejear===0?"":" "+nejear+"N") + (makeBold?"</b>":"");
			break;case "minute"     :return (makeBold?"<b>":"") + "[" + hours + ":" + minutes + "] " + day + " " + month + " " + year + (makeBold?"</b>":"");
			break;case "day"        :return (makeBold?"<b>":"") + day + " " + month + " " + year + (makeBold?"</b>":"");
		}},
	//
	urlEncode:function(s){return s.replace(/['\)]/g,function(s){return "%"+s.charCodeAt(0).toString(16)})},
	// get the main folder, no matter where you are. Will extract "/575/" anywhere at or beyond ftb.se/575/
	mainDirectory:function(){
		return window.location.pathname.replace(/(\/[^\/]+\/).*/,(m,p1)=>p1);},
	//
	genAlphaNumeric : function(c){
		var charSet = [
			"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
			"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
			"0","1","2","3","4","5","6","7","8","9"];
		var res = "";for (var i = 0; i < c; i++){res += charSet[this.rand(0,charSet.length-1)];}
		return res;},
	//
	uniqueA : function(A){
		return Array.from(new Set(A));},
	//
	dessertA : function(a,aa){
		for (var i = a.length-1; i >= 0; i--){
			if (aa.includes(a[i])){
				a.splice(i,1);}}
		return a;},
	// https://thiscouldbebetter.wordpress.com/2012/12/18/loading-editing-and-saving-a-text-file-in-html5-using-javascrip/
	saveTextAsFile : function(fileNameToSaveAs,textToWrite,filetype="text/plain"){
		var textFileAsBlob = new Blob([textToWrite],{type:filetype});
		var downloadLink = document.createElement("a");
		downloadLink.download = fileNameToSaveAs;
		downloadLink.innerHTML = "Download File";
		var url = (filetype === "text/plain") ? window.URL.createObjectURL(textFileAsBlob) : textToWrite; // ???
		if (window.URL != null){
			// Chrome allows the link to be clicked
			// without actually adding it to the DOM.
			downloadLink.href = url;}
		else{
			// Firefox requires the link to be added to the DOM
			// before it can be clicked.
			downloadLink.href = url;
			downloadLink.onclick = function(event){document.body.removeChild(event.target);};
			downloadLink.style.display = "none";
			document.body.appendChild(downloadLink);}
		downloadLink.click();},
	saveLinkAsFile : function(url){
		var downloadLink = document.createElement("a");
		downloadLink.download = "File#"+Math.trunc(Math.random()*1000000);
		downloadLink.innerHTML = "Download File";
		if (window.URL != null){
			// Chrome allows the link to be clicked
			// without actually adding it to the DOM.
			downloadLink.href = url;}
		else{
			// Firefox requires the link to be added to the DOM
			// before it can be clicked.
			downloadLink.href = url;
			downloadLink.onclick = function(event){document.body.removeChild(event.target);};
			downloadLink.style.display = "none";
			document.body.appendChild(downloadLink);}
		downloadLink.click();},
	loadFileAsText : function(fileToLoad,fxn){
		if (fileToLoad === N){fxn("");return;}
		var fileReader = new FileReader();
		fileReader.onload = (fileLoadedEvent)=>{
			var textFromFileLoaded = fileLoadedEvent.target.result;
			fxn(textFromFileLoaded);};
		fileReader.readAsText(fileToLoad,"UTF-8");},
	flTx : function(){return this.loadFileAsText.apply(this,arguments);},
	// much labor avoided thanks to http://www.cambiaresearch.com/articles/15/javascript-char-codes-key-codes
	keySetToEnglish : function(charCode,location){
		if (charCode <= 0 || location < 0){return "";}
		tmp = "";
		if (charCode == 8) tmp = "backspc"; //  backspace
		else if (charCode == 9) tmp = "tab"; //  tab
		else if (charCode == 13) tmp = "enter"; //  enter
		else if (charCode == 16) tmp = "shft"; //  shift
		else if (charCode == 17) tmp = "ctrl"; //  ctrl
		else if (charCode == 18) tmp = "alt"; //  alt
		else if (charCode == 19) tmp = "ps/brk"; //  pause/break
		else if (charCode == 20) tmp = "caps"; //  caps lock
		else if (charCode == 27) tmp = "esc"; //  escape
		else if (charCode == 32) tmp = "spc"; //  space
		else if (charCode == 33) tmp = "pg↑"; // page up, to avoid displaying alternate character and confusing people
		else if (charCode == 34) tmp = "pg↓"; // page down
		else if (charCode == 35) tmp = "end"; // end
		else if (charCode == 36) tmp = "home"; // home
		else if (charCode == 37) tmp = "←"; // left arrow
		else if (charCode == 38) tmp = "↑"; // up arrow
		else if (charCode == 39) tmp = "→"; // right arrow
		else if (charCode == 40) tmp = "↓"; // down arrow
		else if (charCode == 45) tmp = "ins"; // insert
		else if (charCode == 46) tmp = "del"; // delete
		else if (charCode == 91) tmp = "win←"; // left window
		else if (charCode == 92) tmp = "win→"; // right window
		else if (charCode == 93) tmp = "sel"; // select key
		else if (charCode == 96) tmp = "n0"; // numpad 0
		else if (charCode == 97) tmp = "n1"; // numpad 1
		else if (charCode == 98) tmp = "n2"; // numpad 2
		else if (charCode == 99) tmp = "n3"; // numpad 3
		else if (charCode == 100) tmp = "n4"; // numpad 4
		else if (charCode == 101) tmp = "n5"; // numpad 5
		else if (charCode == 102) tmp = "n6"; // numpad 6
		else if (charCode == 103) tmp = "n7"; // numpad 7
		else if (charCode == 104) tmp = "n8"; // numpad 8
		else if (charCode == 105) tmp = "n9"; // numpad 9
		else if (charCode == 106) tmp = "mult"; // multiply
		else if (charCode == 107) tmp = "add"; // add
		else if (charCode == 109) tmp = "sub"; // subtract
		else if (charCode == 110) tmp = "dec"; // decimal point
		else if (charCode == 111) tmp = "div"; // divide
		else if (charCode == 112) tmp = "F1"; // F1
		else if (charCode == 113) tmp = "F2"; // F2
		else if (charCode == 114) tmp = "F3"; // F3
		else if (charCode == 115) tmp = "F4"; // F4
		else if (charCode == 116) tmp = "F5"; // F5
		else if (charCode == 117) tmp = "F6"; // F6
		else if (charCode == 118) tmp = "F7"; // F7
		else if (charCode == 119) tmp = "F8"; // F8
		else if (charCode == 120) tmp = "F9"; // F9
		else if (charCode == 121) tmp = "F10"; // F10
		else if (charCode == 122) tmp = "F11"; // F11
		else if (charCode == 123) tmp = "F12"; // F12
		else if (charCode == 144) tmp = "numloc"; // num lock
		else if (charCode == 145) tmp = "srcloc"; // scroll lock
		else if (charCode == 186) tmp = ";"; // semi-colon
		else if (charCode == 187) tmp = "="; // equal-sign
		else if (charCode == 188) tmp = ","; // comma
		else if (charCode == 189) tmp = "-"; // dash
		else if (charCode == 190) tmp = "."; // period
		else if (charCode == 191) tmp = "/"; // forward slash
		else if (charCode == 192) tmp = "`"; // grave accent
		else if (charCode == 219) tmp = "["; // open bracket
		else if (charCode == 220) tmp = "\\"; // back slash
		else if (charCode == 221) tmp = "]"; // close bracket
		else if (charCode == 222) tmp = "'"; // single quote
		else tmp = String.fromCharCode(charCode);
		return tmp;},
	shortenInt : function(value){
		value = Math.floor(value);
		var places = (value === 0)?(1):(Math.ceil(Math.log10(Math.abs(value))));
		switch (places){
			case  1:case  2:case  3:return value.toString();
			case  4:case  5:case  6:return Math.floor(value/1000)+"K";
			case  7:case  8:case  9:return Math.floor(value/1000000)+"M";
			case 10:case 11:case 12:return Math.floor(value/1000000000)+"B";
			default:return "missingno.";}},
	//
	byteCToFancy:function(byteC){
		byteC = Math.floor(byteC);
		var places = (byteC === 0)?(1):(Math.ceil(Math.log10(Math.abs(byteC))));
		switch (places){
			case  1:case  2:case  3:return Math.floor(byteC/Math.pow(1024,0))+"B";
			case  4:case  5:case  6:return Math.floor(byteC/Math.pow(1024,1))+"KiB";
			case  7:case  8:case  9:return Math.floor(byteC/Math.pow(1024,2))+"MiB";
			case 10:case 11:case 12:return Math.floor(byteC/Math.pow(1024,3))+"GiB";
			case 13:case 14:case 15:return Math.floor(byteC/Math.pow(1024,4))+"TiB";
			case 16:case 17:case 18:return Math.floor(byteC/Math.pow(1024,5))+"PiB";
			case 19:case 20:case 21:return Math.floor(byteC/Math.pow(1024,6))+"EiB";
			case 22:case 23:case 24:return Math.floor(byteC/Math.pow(1024,7))+"ZiB";
			case 25:case 26:case 27:return Math.floor(byteC/Math.pow(1024,8))+"YiB";
			default:return "missingno.";}},
	// make an array, like a for loop
	a : function(h=0,t=h,fxn=(v=>v+1)){
		var res = [];
		for (var i = h; i <= t; i = fxn(i)){
			res.push(i);}
		return res;},
	// make an array with specified fill, as a carbon copy
	af : function(len,m){return Array(len).fill(π.cc(m));},
	// make an array, like a for loop (weak tail)
	awt : function(h=0,t=h,fxn=(v=>v+1)){
		var res = [];
		for (var i = h; i < t; i = fxn(i)){
			res.push(i);}
		return res;},
	// JSON methods without the try catch blocks
	jsonEncode : function(m,fallback){return JSON.stringify(m);},
	jsonE      : function(m,fallback){return JSON.stringify(m);},
	jsonDecode : function(m,fallback){try{return JSON.parse(m);}catch(e){return fallback;}},
	jsonD      : function(m,fallback){try{return JSON.parse(m);}catch(e){return fallback;}},
	// !!! performance
	aunique : function(a){
		var res = [];
		a.forEach(v=>res.pushUnique(v));
		return res;},
	//
	byteAToBitA : function(byteA){
		return byteA.mapM(v=>[
			(v&0b10000000)===0?0:1,
			(v&0b01000000)===0?0:1,
			(v&0b00100000)===0?0:1,
			(v&0b00010000)===0?0:1,
			(v&0b00001000)===0?0:1,
			(v&0b00000100)===0?0:1,
			(v&0b00000010)===0?0:1,
			(v&0b00000001)===0?0:1,]);},
	//
	numToBitA : function(n){
		var res = n===0?[0]:[];
		while (n !== 0){
			var rem = n%2;
			res.unshift(rem);
			n -= rem;
			n /= 2;}
		return res;},
	//
	numToByteA : function(n){
		var res = n===0?[0]:[];
		while (n !== 0){
			var rem = n%256;
			res.unshift(rem);
			n -= rem;
			n /= 256;}
		return res;},
	// !!! imported blindly
	strToUTF8ByteA : function(str){
		str = str.replace(/\r\n/g,'\n');
		var out = [];
		var p = 0;
		for (var i = 0; i < str.length; i++){
			var c = str.charCodeAt(i);
			if (c < 128){
				out[p++] = c;}
			else if (c < 2048){
				out[p++] = (c >> 6) | 192;
				out[p++] = (c & 63) | 128;}
			else{
				out[p++] = (c >> 12) | 224;
				out[p++] = ((c >> 6) & 63) | 128;
				out[p++] = (c & 63) | 128;}}
		return out;},
	// char in str
	cins:function(c,s){
		var loopmax = s.length;
		for (var i = 0; i < loopmax; i++){
			if (s[i] === c){return true;}}
		return false;},
	// tester
	test:function(fxn,repC=10000){
		var a,b;
		a = performance.now();
		for (var i = 0; i < repC; i++){fxn();}
		b = performance.now();
		ll("<"+Math.ceil(((b*1000000)-(a*1000000))/repC)+"ns");},
	now : function(){return Math.trunc(performance.now()*1000 + Ω.timeUpgrade);},
	source : function(){
		return ((new XMLSerializer()).serializeToString(document.doctype)) + document.body.parentNode.outerHTML;},
	// delay execution of a function, and if another request comes in before it's time, drop the old and queue the new
	delay : function(o={}){
		π.ooaw(o,{
			tag : "",
			fxn : ()=>{},
			t   : 0,});
		if (typeof Ω.t[o.tag] !== "undefined"){clearTimeout(Ω.t[o.tag]);}
		Ω.t[o.tag] = setTimeout(fxn,t/1000);},
	strh : function(s,ss){return s.startsWith(ss);},
	strSplice : function(s,i,n,v){return s.substring(0,i)+v+s.substring(i+n);},
	base26 : function(n){
		var a = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
		var res = "";
		while (T){
			r = n%26;
			n = (n-r)/26;
			res = a[r] + res;
			if (n === 0){break;}}
		return res;},
	// does a given cell exist [because ugh JavaScript]
	cellDef : function(m,a){
		for (var i = 0; i < a.length; i++){
			if (typeof (m = m[a[i]]) === "undefined"){return F;}}
		return T;},
	// returns a shallow copy, doesn't touch original
	flat : function(a){var that = this;return a.reduce(((p,aa)=>p.concat(isA(aa)?that.flat(aa):aa)),[]);},
	esc : function(s,charA=[]){
		if (charA.length === 0){ll("WARNING : called esc() without specifying a charA of characters to escape - on string : "+s);}
		return s.replace(new RegExp("["+charA.map(v=>"\\"+v).join("")+"]","g"),"\\$&");},
	// works only as far as needs have pushed it
	getDecimalPlaceC:function(n){
		var s = str(n);
		var dotPos = s.indexOf(".");
		if (dotPos === -1){return 0;}
		return s.substr(dotPos+1).length;},
	IDToBlockString:function(n){
		if (!isI(n)){return U;}
		if (n < 0 || n > Number.MAX_SAFE_INTEGER){return U;}
		var sA = ["　","▝","▗","▖","▘","▐","▄","▌","▀","▞","▚","▟","▙","▛","▜","█"];
		var base = sA.length;
		var res = "";
		do{
			var rem = n % base;
			res = sA[rem]+res;
			n = (n-rem)/base;
		}while(n !== 0);
		return res;},
	
};

// they told me not to, but I did it anyway
// make this faster
Array.prototype.makeUnique = function(){
	var res = [];
	for (var I = 0,C = this.length; I < C; I++){
		res.pushUnique(this[I]);}
	return res;};
Array.prototype.pushUnique = function(el){if (!this.includes(el)){this.push(el);}};
Array.prototype.pushUniqueA = function(elA){elA.forEach(el=>{this.pushUnique(el);});}; // !!! make this faster
Array.prototype.sum = function(){return this.reduce(((p,v)=>p+v),0);};
Array.prototype.reduceSum = function(fxn=()=>T){return this.reduce((p,v,i,a)=>p+(fxn(v,i,a)?1:0),0);};
Array.prototype.min = function(init){return this.length===0 ? init : this.reduce(((p,v)=>p>v?v:p));};
Array.prototype.max = function(init){return this.length===0 ? init : this.reduce(((p,v)=>p<v?v:p));};
Array.prototype.average = function(){return (this.length === 0) ? 0 : this.sum()/this.length;};
Array.prototype.none = function(fxn){return !this.some(fxn);};
// may XceeD bless me in my confusion why my implementations are 10x faster than the native ones
// and may XceeD bless all the souls who told me not to do this
// and may XceeD bless us all when I'll have to scope all these functions in the future
Array.prototype.forEach = function(fxn){
	var length = this.length;
	for (var i = 0; i < length; i++){
		fxn(this[i],i,this);}};
Array.prototype.map = function(fxn){
	var res = new Array(this.length);
	var length = this.length;
	for (var i = 0; i < length; i++){
		res[i] = fxn(this[i],i,this);}
	return res;};
Array.prototype.mapFilter = function(fxn,vBlank=U){
	var res = [];
	var length = this.length;
	for (var i = 0; i < length; i++){var v = fxn(this[i],i,this);
		if (v !== vBlank){
			res.push(v);}}
	return res;};
Array.prototype.mapReverse = function(fxn){
	var res = new Array(this.length);
	var length = this.length;
	for (var i = 0; i < length; i++){
		res[i] = fxn(this[((length-1)-i)],((length-1)-i),this);}
	return res;};
Array.prototype.reduce = function(fxn,accumulator){
	var length = this.length;
	for (var i = 0; i < length; i++){
		if (i === 0 && typeof accumulator === "undefined"){accumulator = this[i];continue;}
		accumulator = fxn(accumulator,this[i],i,this);}
	return accumulator;};
Object.prototype.some = function(fxn){
	var length = this.length;
	for (var i = 0; i < length; i++){
		if (fxn(this[k],k,this)){
			return true;}}
	return false;};
Array.prototype.split = function(m){
	var res = [];
	var r = [];
	for (var i = 0; i < this.length; i++){
		if ((typeof m === "function" && m(this[i],i,this)) || (typeof m !== "function" && π.ooe(this[i],m))){
			res.push(r);r = [];}
		else{
			r.push(π.cc(this[i]));}}
	res.push(r);
	return res;};
Array.prototype.distribute = function(fxn){
	var o = {};
	this.forEach((v,i,a)=>{
		var k = fxn(v,i,a);
		if (typeof k === "undefined"){return;} // signal to toss out this value
		if (typeof o[k] === "undefined"){o[k] = [];}
		o[k].push(v);});
	return o;};
Array.prototype.forEachReverse = function(fxn){
	for (var i = this.length-1; i >= 0; i--){if (typeof this[i] === "undefined"){continue;}
		fxn(this[i],i,this);}};
Array.prototype.findLastIndex = function(fxn){
	for (var i = this.length-1; i >= 0; i--){
		if (fxn(this[i],i,this)){
			return i;}}
	return -1;};
Array.prototype.findLast = function(fxn){
	for (var i = this.length-1; i >= 0; i--){
		if (fxn(this[i],i,this)){
			return v;}}
	return undefined;};
Array.prototype.findLastNthIndex = function(fxn,n){
	if (n <= 0){return -1;}
	var nn = 0;
	for (var i = this.length-1; i >= 0; i--){
		if (fxn(this[i],i,this)){
			if (++nn >= n){
				return i;}}}
	return -1;};
Array.prototype.findLastNth = function(fxn,n){
	if (n <= 0){return undefined;}
	var nn = 0;
	for (var i = this.length-1; i >= 0; i--){
		if (fxn(this[i],i,this)){
			if (++nn >= n){
				return v;}}}
	return undefined;};
Array.prototype.findNthIndex = function(fxn,n){
	if (n <= 0){return -1;}
	var nn = 0;
	for (var i = 0; i < this.length; i++){
		if (fxn(this[i],i,this)){
			if (++nn >= n){
				return i;}}}
	return -1;};
Array.prototype.findNth = function(fxn,n){
	if (n <= 0){return undefined;}
	var nn = 0;
	for (var i = 0; i < this.length; i++){
		if (fxn(this[i],i,this)){
			if (++nn >= n){
				return v;}}}
	return undefined;};
Array.prototype.mapO = function(fxn){ // fxn returns {key:value} instead of just value as in the traditional map
	return this.map(fxn).reduce((p,v)=>π.ooAbsorb(p,v),{});};
Array.prototype.mapM = function(fxn){ // whatever fxn returns gets concated to the accumulator
	var res = [];
	this.forEach((v,i,a)=>{
		res = res.concat(fxn(v,i,a));});
	return res;};
Array.prototype.forAny = function(fxn){
	for (var k = 0; k < this.length; k++){
		if (fxn(this[k],k,this) === T){
			return;}}};
Array.prototype.findRemove = function(fxn){
	var i = this.findIndex(fxn);
	if (i !== -1){this.splice(i,1);return T;}
	return F;};
Object.values = function(o){
	var a = [];
	for (var k of Object.keys(o)){
		a.push(o[k]);}
	return a;};
Array.prototype.findRandom = function(fxn){
	var thisC = this.length;
	if (thisC === 0){return undefined;}
	return this[Math.floor(Math.random()*thisC)];};
Array.prototype.findIndexRandom = function(fxn){
	var thisC = this.length;
	if (thisC === 0){return -1;}
	return Math.floor(Math.random()*thisC);};
Object.prototype.mapK = function(fxn){return Object.keys  (this.map(fxn));};
Object.prototype.mapV = function(fxn){return Object.values(this.map(fxn));};
Object.prototype.mapO = function(fxn){ // fxn returns {key:value} instead of just value as in the traditional map
	return this.mapV(fxn).reduce((p,v)=>π.ooAbsorb(p,v),{});};
Object.prototype.map = function(fxn){
	var o = {};
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		o[k] = fxn(this[k],k,this);}
	return o;};
Object.prototype.reduce = function(fxn,initial){
	if (typeof initial !== "undefined"){accumulator = initial;}
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (typeof accumulator === "undefined"){accumulator = this[k];continue;}
		accumulator = fxn(accumulator,this[k],k,this);}
	return accumulator;};
Object.prototype.filterK = function(fxn){return Object.keys  (this.filter(fxn));};
Object.prototype.filterV = function(fxn){return Object.values(this.filter(fxn));};
Object.prototype.filter = function(fxn){
	var o = {};
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (fxn(this[k],k,this)){
			o[k] = this[k];}}
	return o;};
// by JS spec, object iteration is by arbitrary order
Object.prototype.forEach = function(fxn){
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		fxn(this[k],k,this);}};
Object.prototype.forAny = function(fxn){
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (fxn(this[k],k,this) === T){
			return;}}};
Object.prototype.some = function(fxn){
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (fxn(this[k],k,this)){
			return true;}}
	return false;};
Object.prototype.indexOf = function(m){return this.findIndex(v=>v===m);};
Object.prototype.find = function(fxn){
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (fxn(this[k],k,this)){
			return this[k];}}
	return undefined;};
Object.prototype.findIndex = function(fxn){
	var keyA = Object.keys(this);
	var length = keyA.length;
	for (var i = 0; i < keyA.length; i++){var k = keyA[i];
		if (fxn(this[k],k,this)){
			return k;}}
	return -1;};
Object.prototype.findRandom = function(fxn){
	var keyA = Object.keys(this);
	var keyAC = keyA.length;
	if (keyAC === 0){return undefined;}
	return this[keyA[Math.floor(Math.random()*keyAC)]];};
Object.prototype.findIndexRandom = function(fxn){
	var keyA = Object.keys(this);
	var keyAC = keyA.length;
	if (keyAC === 0){return -1;}
	return keyA[Math.floor(Math.random()*keyAC)];};
String.prototype.forEach = function(fxn){
	for (var i = 0; i < this.length; i++){
		fxn(this[i],i,this);}};

/**********************************************************************************************************************\
* BOOK : "TIMER" | LANGUAGE : "JAVASCRIPT"                                                               [KERN MANUAL] *
************************************************************************************************************************
*                                                                                                                      *
*                                                                                  TIMER METHODS [KERN MANUAL 0000002] *
*                                                                                                                      *
* Timer is primarily used when you have a regularly repeating event. By using the if() call, you can test whether the
* timer has expired, and if it has expired, it will automatically reset itself and run again.
* 
\**********************************************************************************************************************/

var Timer = {
	gen : function(o={}){π.p(o,{duration:N});
		return {
			headT    : π.now(),
			duration : o.duration,
			if       : function(o={}){π.p(o,{duration:this.duration});
				var _F = this.calcExpiredF({duration:o.duration,});
				if (_F){this.restart();}
				return _F;},
			calcExpiredF : function(o={}){π.p(o,{duration:this.duration});
				return o.duration !== N && π.now() - this.headT > o.duration;},
			restart  : function(o={}){π.p(o,{duration:this.duration});
				this.headT = π.now();
				this.duration = o.duration;},};},
};

/**********************************************************************************************************************\
* BOOK : "COLOR" | LANGUAGE : "JAVASCRIPT"                                                               [KERN MANUAL] *
************************************************************************************************************************
*                                                                                                                      *
*                                                         HSLA/RGBA DISPLAY/MANIPULATION METHODS [KERN MANUAL 0000003] *
*                                                                                                                      *
* For building color representation strings from control variables. Primarily used in CSS rules and in canvas logic.
* 
\**********************************************************************************************************************/

// css display strings
var hsla       = (coArr,                                    a=1)=>"hsla("+Math.round(360*coArr[0])+","+Math.round(100*coArr[1])+"%,"+Math.round(100*coArr[2])+"%,"+a+")";
var hslma      = (coArr,bgArr,      mixRatio =1,            a=1)=>hsla(hslmix(coArr,bgArr,mixRatio),a);
var hslmma     = (coArr,bgArr,exArr,mixRatioA=1,mixRatioB=1,a=1)=>hslma(hslmix(coArr,bgArr,mixRatioA),exArr,mixRatioB,a);
var hslmix     = (coArr,bgArr,      mixRatio =1                )=>rgbToHsl(rgbmix(hslToRgb(coArr),hslToRgb(bgArr),mixRatio)); // mix two colors in a specific ratio, ratio = co/bg
var hslmegamix = (coArrArr                                     )=>rgbToHsl(rgbmegamix(coArrArr.map(v=>hslToRgb(v)))); // mix many colors equally
var hslinvert  = (coArr                                        )=>{var _ = coArr[0]+0.5;return [(_>1?_-1:_),coArr[1],1-coArr[2]];};

var hslaExtract = (colorS)=>{
	var co = [];
	colorS.replace(/hsla?\((.+),(.+)%,(.+)%(?:,(.+))?\)/,(match,p1,p2,p3,p4,offset,string)=>{
		co[0] = num(p1)/360;
		co[1] = num(p2)/100;
		co[2] = num(p3)/100;
		if (typeof p4 !== "undefined"){
			co[3] = num(p4);}});
	return co;};

// rgb land
function rgbmix(coArr,bgArr,mixRatio=1){
	var r = coArr[0]*mixRatio + bgArr[0]*(1-mixRatio);
	var g = coArr[1]*mixRatio + bgArr[1]*(1-mixRatio);
	var b = coArr[2]*mixRatio + bgArr[2]*(1-mixRatio);
	return [r,g,b];}
function rgbmegamix(coArrArr){
	var r = coArrArr.reduce((acc,v)=>acc+v[0],0)/coArrArr.length;
	var g = coArrArr.reduce((acc,v)=>acc+v[1],0)/coArrArr.length;
	var b = coArrArr.reduce((acc,v)=>acc+v[2],0)/coArrArr.length;
	return [r,g,b];}

// http://en.wikipedia.org/wiki/HSL_color_space
// http://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion
var hueToRgb = function hueToRgb(p,q,t){
	if (t < 0  ){t += 1;}
	if (t > 1  ){t -= 1;}
	if (t < 1/6){return p + (q-p) * 6 * t;}
	if (t < 1/2){return q;}
	if (t < 2/3){return p + (q-p) * (2/3-t) * 6;}
	return p;}
function hslToRgb(coArr){
	var h = coArr[0];
	var s = coArr[1];
	var l = coArr[2];
	var r, g, b;
	// achromatic
	if (s === 0){
		r = g = b = l;}
	else{
		var q = (l < 0.5) ? (l * (1+s)) : (l + s - (l*s));
		var p = (2 * l) - q;
		r = hueToRgb(p,q,(h + (1/3)));
		g = hueToRgb(p,q,h);
		b = hueToRgb(p,q,(h - (1/3)));}
	return [r,g,b];}
function rgbToHsl(coArr){
	var r = coArr[0];
	var g = coArr[1];
	var b = coArr[2];
	var max = Math.max(r,g,b);
	var min = Math.min(r,g,b);
	var h;
	var s;
	var l = (max+min)/2;
	// achromatic
	if (max === min){
		h = s = 0;}
	else{
		var d = max - min;
		s = (l > 0.5) ? (d/(2-max-min)) : (d/(max+min));
		switch (max){default:
			break;case r: h = (g-b) / d + ((g<b) ? (6) : (0));
			break;case g: h = (b-r) / d + 2;
			break;case b: h = (r-g) / d + 4;}
		h /= 6;}
	return [h,s,l];}


/**********************************************************************************************************************\
* BOOK : "UNIANI" | LANGUAGE : "JAVASCRIPT"                                                              [KERN MANUAL] *
************************************************************************************************************************
*                                                                                                                      *
*                                                         UNIFIED ANIMATION REGISTRATION METHODS [KERN MANUAL 0000004] *
*                                                                                                                      *
* when you have objects with a drawFrame() method, register them all here to bunch up paints and get profiling data
* uniani.register("gameFrame",p.gf);
* uniani.unregister("gameFrame");
* uniani.dump();
* var output = uniani.dump(true);
* 
\**********************************************************************************************************************/

var uniani = {
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
		if (ret){return out;}else{console.log(out);}},
};
document.addEventListener("DOMContentLoaded",function(){
	uniani.start();});

/**********************************************************************************************************************\
* BOOK : "PANFLO" | LANGUAGE : "JAVASCRIPT"                                                              [KERN MANUAL] *
************************************************************************************************************************
*                                                                                                                      *
*                                                                PANEL FLOW REGISTRATION METHODS [KERN MANUAL 0000005] *
*                                                                                                                      *
* Register a "panel" and a "handle", and panflo will make "handle" grabbable, mirroring its special manipulation with
* the "panel". "Panel" may be resized in any of eight combinational directions, by grabbing the edges/corners of it.
* This functionality mirrors the graphical user interface of a graphical operating system, popularized in the 1980s.
* 
* Warning : This may make secretly assume that certain properties of your elements are set, such as display:absolute.
*           These should eventually be worked out, but until they are, bear this in mind if things "don't work".
*           top,left,width,height,zIndex
* 
\**********************************************************************************************************************/

// !!! this code is in need of cleanup, since it has weathered trials since FtB4, its birthplace

var panflo = {
	panelSelector : ".layer",
	aliveF : T,
	mousedownTriggeredGrabF : F,
	handleResizeOuterS : 6,
	handleResizeInnerS : 0, // !!! when >0, issue where interacting with part of interface gets obscured [the edges give priority to panflo, not the actual element, which is bad]
	registerArrKeys    : [],
	registerArrObjects : [],
	register_QUEUE     : [],
	unregister_QUEUE   : [],
	register : function(key,object){
		if (this.registerArrKeys.indexOf(key) == -1){ // no duplicates kthx
			this.registerArrKeys.push(key);
			this.registerArrObjects.push(object);
			
			var panel = object.panel;
			var handle = object.handle;
			panel.PANFLO = {grabbed:false,grabbedResize:false,xAnchor:0,yAnchor:0,leftAnchor:0,topAnchor:0,xAnchorResize:0,yAnchorResize:0,leftAnchorResize:0,topAnchorResize:0,widthAnchorResize:0,heightAnchorResize:0,handle:handle};
			if (panel == handle){handle.PANFLO.panel = panel;}
			else{handle.PANFLO = {panel:panel};}
			handle.addEventListener("mousedown",function(event){
				if (!panflo.aliveF){return;}
				panflo.mousedownTriggeredGrabF = T;
				panflo.bringFront(this.PANFLO.panel);
				this.PANFLO.panel.PANFLO.grabbed = true;
				this.PANFLO.panel.PANFLO.xAnchor = event.pageX;
				this.PANFLO.panel.PANFLO.yAnchor = event.pageY;
				this.PANFLO.panel.PANFLO.leftAnchor = µ.offsetLeftTotal(this.PANFLO.panel);
				this.PANFLO.panel.PANFLO.topAnchor  = µ.offsetTopTotal(this.PANFLO.panel);});
			}},
	unregister : function(key){
		var pos = this.registerArrKeys.indexOf(key);
		if (pos != -1){
			this.registerArrKeys.splice(pos,1);
			this.registerArrObjects.splice(pos,1);}},
	
	mousedown : function(event){
		if (!panflo.aliveF){return;}
		// handle drag (top priority, above resize)
		; // happens for the actual elements
		if (!this.mousedownTriggeredGrabF){
			// handle resize
			// if we are near an edge of a panel
			// resize anchor at that point, flip grabbedResize flag to true
			// horrible code that, regardless, gets the job done, of favoring layers with higher z-index
			var zIndex_CHAMPION = null;
			var champion = null;
			for (var i = 0; i < this.registerArrObjects.length; i++){var row = this.registerArrObjects[i].panel;
				var t = parseInt(row.style.top);
				var l = parseInt(row.style.left);
				var b = t+parseInt(row.offsetHeight);
				var r = l+parseInt(row.offsetWidth);
				var tGrab = event.pageY >= t-this.handleResizeOuterS && event.pageY <= t                         && event.pageX >= l-this.handleResizeOuterS && event.pageX <= r+this.handleResizeOuterS; //event.pageY <= t+this.handleResizeInnerS
				var lGrab = event.pageX >= l-this.handleResizeOuterS && event.pageX <= l+this.handleResizeInnerS && event.pageY >= t-this.handleResizeOuterS && event.pageY <= b+this.handleResizeOuterS;
				var bGrab = event.pageY >= b-this.handleResizeInnerS && event.pageY <= b+this.handleResizeOuterS && event.pageX >= l-this.handleResizeOuterS && event.pageX <= r+this.handleResizeOuterS;
				var rGrab = event.pageX >= r-this.handleResizeInnerS && event.pageX <= r+this.handleResizeOuterS && event.pageY >= t-this.handleResizeOuterS && event.pageY <= b+this.handleResizeOuterS;
				if (tGrab || lGrab || bGrab || rGrab){
					if (zIndex_CHAMPION === null || zIndex_CHAMPION<row.style.zIndex){
						zIndex_CHAMPION = row.style.zIndex;
						champion = row;}}}
			var row = champion;
			if (row !== null){
				var t = parseInt(row.style.top);
				var l = parseInt(row.style.left);
				var b = t+parseInt(row.offsetHeight);
				var r = l+parseInt(row.offsetWidth);
				var tGrab = event.pageY >= t-this.handleResizeOuterS && event.pageY <= t                         && event.pageX >= l-this.handleResizeOuterS && event.pageX <= r+this.handleResizeOuterS; //event.pageY <= t+this.handleResizeInnerS
				var lGrab = event.pageX >= l-this.handleResizeOuterS && event.pageX <= l+this.handleResizeInnerS && event.pageY >= t-this.handleResizeOuterS && event.pageY <= b+this.handleResizeOuterS;
				var bGrab = event.pageY >= b-this.handleResizeInnerS && event.pageY <= b+this.handleResizeOuterS && event.pageX >= l-this.handleResizeOuterS && event.pageX <= r+this.handleResizeOuterS;
				var rGrab = event.pageX >= r-this.handleResizeInnerS && event.pageX <= r+this.handleResizeOuterS && event.pageY >= t-this.handleResizeOuterS && event.pageY <= b+this.handleResizeOuterS;
				if (tGrab || lGrab || bGrab || rGrab){
					
					// it seems like a resize grab, but if the clicked element is above the element to resize, reject
					var elOver = document.elementFromPoint(event.pageX,event.pageY);
					if (µ.calcZIndex(elOver) > µ.calcZIndex(row)){return;}
					
					var vertical = "";
					var horizontal = "";
					if (tGrab){vertical = "N";}
					if (lGrab){horizontal = "W";}
					if (bGrab){vertical = "S";}
					if (rGrab){horizontal = "E";}
					row.PANFLO.grabbedResize = true;
					row.PANFLO.xAnchorResize = event.pageX;
					row.PANFLO.yAnchorResize = event.pageY;
					row.PANFLO.topAnchorResize = parseInt(row.style.top);
					row.PANFLO.leftAnchorResize = parseInt(row.style.left);
					row.PANFLO.widthAnchorResize = parseInt(row.offsetWidth);
					row.PANFLO.heightAnchorResize = parseInt(row.offsetHeight);
					row.PANFLO.directionVerticalResize = vertical;
					row.PANFLO.directionHorizontalResize = horizontal;
					event.stopPropagation();
					event.preventDefault();}}}
		this.mousedownTriggeredGrabF = F;},
	mousemove : function(event){
		if (!panflo.aliveF){return;}
		if (!Ω.mousedownF){return;}
		for (var i = 0; i < this.registerArrObjects.length; i++){var row = this.registerArrObjects[i].panel;
			var w_FREEZE = row.style.width ;
			var h_FREEZE = row.style.height;
			if (row.PANFLO.grabbed && !row.PANFLO.grabbedResize){
				event.preventDefault();
				row.style.top = row.PANFLO.topAnchor + (event.pageY-row.PANFLO.yAnchor) + "px";
				row.style.left = row.PANFLO.leftAnchor + (event.pageX-row.PANFLO.xAnchor) + "px";}
			if (row.PANFLO.grabbedResize){
				event.preventDefault();
				if (row.PANFLO.directionVerticalResize == "N"){
					row.style.top = row.PANFLO.topAnchorResize + (event.pageY-row.PANFLO.yAnchorResize) + "px";
					row.style.height = row.PANFLO.heightAnchorResize + (row.PANFLO.yAnchorResize-event.pageY) + "px";}
				if (row.PANFLO.directionHorizontalResize == "W"){
					row.style.left = row.PANFLO.leftAnchorResize + (event.pageX-row.PANFLO.xAnchorResize) + "px";
					row.style.width = row.PANFLO.widthAnchorResize + (row.PANFLO.xAnchorResize-event.pageX) + "px";}
				if (row.PANFLO.directionVerticalResize == "S"){
					row.style.height = row.PANFLO.heightAnchorResize + (event.pageY-row.PANFLO.yAnchorResize) + "px";}
				if (row.PANFLO.directionHorizontalResize == "E"){
					row.style.width = row.PANFLO.widthAnchorResize + (event.pageX-row.PANFLO.xAnchorResize) + "px";}
				if (typeof row.style.minWidth != "undefined" && row.style.minWidth !== ""){
					if (parseInt(row.style.width) > parseInt(row.style.minWidth)){row.style.width = row.style.minWidth;}}
				if (typeof row.style.maxWidth != "undefined" && row.style.maxWidth !== ""){
					if (parseInt(row.style.width) > parseInt(row.style.maxWidth)){row.style.width = row.style.maxWidth;}}
				if (typeof row.style.minHeight != "undefined" && row.style.minHeight !== ""){
					if (parseInt(row.style.height) > parseInt(row.style.minHeight)){row.style.height = row.style.minHeight;}}
				if (typeof row.style.maxHeight != "undefined" && row.style.maxHeight !== ""){
					if (parseInt(row.style.height) > parseInt(row.style.maxHeight)){row.style.height = row.style.maxHeight;}}
				}
			if (row.style.width  !== w_FREEZE
			||  row.style.height !== h_FREEZE){
				row.dispatchEvent(new Event("resize"));}
			}},
	mouseup : function(event){
		if (!panflo.aliveF){return;}
		for (var i = 0; i < this.registerArrObjects.length; i++){var row = this.registerArrObjects[i].panel;
			if (row.PANFLO.grabbed || row.PANFLO.grabbedResize){event.stopPropagation();}
			row.PANFLO.grabbed = false;
			row.PANFLO.grabbedResize = false;}},
	bringFront : function(el){el.style.zIndex = µ.qdA(this.panelSelector).map(el=>int(getComputedStyle(el).getPropertyValue("z-index"))).max(1)+1;},
};
document.addEventListener("DOMContentLoaded",function(){
	document.addEventListener("mousedown",function(e){panflo.mousedown(e);});
	document.addEventListener("mousemove",function(e){panflo.mousemove(e);});
	document.addEventListener("mouseup"  ,function(e){panflo.mouseup  (e);});});

/**********************************************************************************************************************\
* BOOK : "ANIPNT" | LANGUAGE : "JAVASCRIPT"                                                              [KERN MANUAL] *
************************************************************************************************************************
*                                                                                                                      *
*                                                                     ANIMATION PAINTING METHODS [KERN MANUAL 0000006] *
*                                                                                                                      *
* Created as a convenience for using canvas paint methods. Optimizations may slip in, since this is turning into an
* exclusively-used library, a change from originally being intended to be used alongside the built-in calls.
* 
\**********************************************************************************************************************/

var anipnt = {
	clearRect : function(ctx,x,y,w,h,pxd=1){
		ctx.clearRect(x*pxd,y*pxd,w*pxd,h*pxd);},
	drawRect : function(ctx,x,y,width,height,color,pxd=1){
		if (ctx.fillStyle !== color){ // !!! theory that this actually hurts performance
			ctx.fillStyle =   color;}
		ctx.beginPath();
		ctx.rect(x*pxd,y*pxd,width*pxd,height*pxd);
		//ctx.closePath();
		ctx.fill();},
	traceRect : function(ctx,x,y,width,height,color,pxd=1){
		if (ctx.strokeStyle !== color){ // !!! theory that this actually hurts performance
			ctx.strokeStyle =   color;}
		ctx.beginPath();
		ctx.rect(x*pxd,y*pxd,width*pxd,height*pxd);
		//ctx.closePath();
		ctx.stroke();},
	drawCirc : function(ctx,x,y,diameter,color,pxd=1){
		if (ctx.fillStyle !== color){ // !!! theory that this actually hurts performance
			ctx.fillStyle =   color;}
		ctx.beginPath();
		ctx.arc(x*pxd,y*pxd,pxd*diameter/2,0,Math.PI*2,true);
		//ctx.closePath();
		ctx.fill();},
	drawStar : function(ctx,xCenter,yCenter,r,color,pxd=1){
		if (ctx.fillStyle !== color){ // !!! theory that this actually hurts performance
			ctx.fillStyle =   color;}
		ctx.beginPath();
		ctx.moveTo(xCenter*pxd,(yCenter-r)*pxd);
		ctx.quadraticCurveTo(xCenter*pxd,yCenter*pxd,(xCenter+r)*pxd, yCenter   *pxd);
		ctx.quadraticCurveTo(xCenter*pxd,yCenter*pxd, xCenter   *pxd,(yCenter+r)*pxd);
		ctx.quadraticCurveTo(xCenter*pxd,yCenter*pxd,(xCenter-r)*pxd, yCenter   *pxd);
		ctx.quadraticCurveTo(xCenter*pxd,yCenter*pxd, xCenter   *pxd,(yCenter-r)*pxd);
		ctx.closePath();
		ctx.fill();},
	drawLine : function(ctx,x,y,xx,yy,w,color,lineCap="butt",pxd=1){
		if (ctx.strokeStyle !== color){ // !!! theory that this actually hurts performance
			ctx.strokeStyle =   color;}
		if (ctx.lineWidth !== w){ // !!! theory that this actually hurts performance
			ctx.lineWidth =   w;}
		if (ctx.lineCap !== lineCap){ // !!! theory that this actually hurts performance
			ctx.lineCap =   lineCap;}
		if (w === 0){return;} // canvas handles a 0-width improperly, so we need to ignore it here
		ctx.beginPath();
		ctx.moveTo(x*pxd,y*pxd);
		ctx.lineTo(xx*pxd,yy*pxd);
		//ctx.closePath();
		ctx.stroke();},
	drawRay  : function(ctx,x,y,angle,l,w,color,lineCap="butt",pxd=1){this.drawLine(ctx,x,y,x+Math.cos(angle)*l,y-Math.sin(angle)*l,w,color,lineCap,pxd);},
	fillText : function(ctx,s,x,y,color,pxd=1){
		textBaseline_FREEZE = ctx.textBaseline;
		ctx.textBaseline = "top";
		font_FREEZE = ctx.font;
		ctx.font = ctx.font.replace(/(\d+)px/,(match,p1,offset,string)=>(num(p1)*2)+"px"); // not great, but hey--
		if (ctx.fillStyle !== color){ // !!! theory that this actually hurts performance
			ctx.fillStyle =   color;}
		ctx.fillText(s,x*pxd,y*pxd);
		ctx.textBaseline = textBaseline_FREEZE;
		ctx.font = font_FREEZE;},
};

//--------------------

// write can be slow
// reads must be extremely quick
// ! pass me an array I have exclusive control over [including control of each element], π.cc() it if you aren't willing to give me that privilege
// searchCompareFxn should have the same basis as sortCompareFxn, but the search variant might have an extra filter
// L> example : an array of elements like ["John","Smith",28] might have the ability to search for "John" and return this entry as equivalent
// L> example : same as above, but perhaps you would search for {initials:"JS",ageRange:[20,30]}, with these query parts hooked up to return that John Smith (28) row
// ! searchCompareFxn will put your search term in the "a" slot, and the array terms in the "b" slot
var SortedArray = function(o={}){π.p(o,{arr:[],sortCompareFxn:U,searchCompareFxn:U});
	var res = {
		arr        : o.arr,
		sortCompareFxn   : o.sortCompareFxn,
		searchCompareFxn : o.searchCompareFxn,
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
		indexOf    : function(v,matchType=0){
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
		includes   : function(v){return (this.indexOf(v) !== -1);},
		map        : function(){return this.arr.map(arguments[0]);},
		mapO       : function(){return this.arr.mapO(arguments[0]);},
		every      : function(){return this.arr.every(arguments[0]);},
		forEach    : function(){this.arr.forEach(arguments[0]);},
		filter     : function(){return this.arr.filter(arguments[0]);},
		toString   : function(){return this.arr.toString();},
	};
	res.clean();
	return res;
};

//----

// ll-delayed, for a performant ll() that you are okay with being delayed to the uniani boundary [currently ~60fps]
var lld = (...m)=>{m.forEach(v=>{Ω.lldO.arr.push(v);});};
Ω.lldO = {
	arr : [],
	drawFrame:function(){
		if (this.arr.length > 0){
			console.log(this.arr.join("\n"));
			this.arr.length = 0;}},
};
uniani.register("lld",Ω.lldO);

//----

// this intends to measure browser-screen refresh rate, because although I think it's usually 60Hz, it might be different for some people
Ω.fpsO = {
	now_PREV : N,
	drawFrame:function(now){
		if (this.now_PREV !== N){
			Ω.fps = Math.round(1000000/(now-this.now_PREV));
		}
		this.now_PREV = now;},
};
uniani.register("fps",Ω.fpsO);
