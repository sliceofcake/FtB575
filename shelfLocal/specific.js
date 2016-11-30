var p = {
	user : null,
	ID : 0,
	name : "",
	tx : [0,0,1      ],
	co : [0,1,0.5    ],
	bg : [0,0,0  ,0.85],
	rrx : 700,
	rry : 700,
	href : (append)=>history.pushState(null,"",append),
	timeUpgrade : function(){var a,b;a=Date.now();b=performance.now();return(a-b)*1000;}(),
	now         : function(){return Math.trunc(performance.now()*1000 + this.timeUpgrade);},
	clockOffsetArr : [],
	clockOffset    : 0,
	tblA        : [
		"board","post","subboard","thread","user",
		"channel","participant","message",
	],
	procO       : {},
	procSetup   : function(){return {tblxIDA:p.tblA.mapO(v=>({[v]:[]})),tblxIDA_pre:p.tblA.mapO(v=>({[v]:[]})),render:()=>{}};},
	procNeeds   : function(that,tbl,ID,pre=false){
		if (ID === 0){return;}
		var tblxIDA = pre ? that.tblxIDA_pre : that.tblxIDA;
		if (typeof tblxIDA[tbl]     === "undefined"){return undefined;}
		π.aaaw(tblxIDA[tbl],[ID]);
		return p.tblxleafO[tbl][ID];},
	procRush    : function(that,tbl,ID){
		if (ID === 0){return;}
		if (typeof this.tblxleafO[tbl]     === "undefined"){return undefined;}
		if (typeof this.tblxleafO[tbl][ID] !== "undefined"){
			this.tblxleafO[tbl][ID].expiration = p.now()-575;}
		return this.procNeeds(that,tbl,ID);},
	procNeedsOrRush : function(rush,that,tbl,ID,pre=false){return (rush === true) ? this.procRush(that,tbl,ID) : this.procNeeds(that,tbl,ID,pre);},
	pluAuth     : function(){return;
		var ID  = localStorage.getItem("FtB575_ID" );if (ID  === null){return;}
		if (str(int(ID)) === ID){ID = int(ID);}else{return;}
		var plu = localStorage.getItem("FtB575_plu");if (plu === null){return;}
		core.send({tbl:"n/a",act:"ftb575_authenticate",dat:{ID,plu}});},
	mName : (main,lo="",hi="")=>[".C¥nejname",[["span",main],["sub",lo],["sup",hi],]],
	onAuth : ()=>{},
	deAuth : function(){return;
		core.plu = "";
		localStorage.removeItem("FtB575_ID" );
		localStorage.removeItem("FtB575_plu");
		this.tblxleafO = this.tblA.mapO(v=>({[v]:{}}));
		this.onAuth();},
	fxnCheckbox : function(){
		var el = µ.qu(this,"label.toggle");
		el.classList.toggle("on");el.classList.toggle("off");},
};
p.tblxleafO = p.tblA.mapO(v=>({[v]:{}}));
p.asrFont = function(){
	var css = {
		"@font-face"    : "font-family:'tubular';src:url("+π.mainDirectory()+"shelf/font/tubular.woff) format('woff');font-weight:normal;font-style:normal;",
		"@font-face "   : "font-family:'tubular';src:url("+π.mainDirectory()+"shelf/font/tubular-italic.woff) format('woff');font-weight:normal;font-style:italic;",
		"@font-face  "  : "font-family:'tubular';src:url("+π.mainDirectory()+"shelf/font/tubular-medium.woff) format('woff');font-weight:500;font-style:normal;",
		"@font-face   " : "font-family:'tubular';src:url("+π.mainDirectory()+"shelf/font/tubular-bold.woff) format('woff');font-weight:bold;font-style:normal;",};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"font"},css:css}));};
p.asrStyle = function(mode="root",dataUnique="root",o={}){
	var rr = π.reductionRatio(p.rrx,p.rry);
	var {tx,co,bg} = p;
	var a = (typeof bg[3] === "undefined" ? 1 : bg[3]);
	var fxnFilter = m=>Math.ceil(m);
	var rrn = (n)=>fxnFilter(rr*n);
	var bottomDraftW = rrn(80);
	var bottomEditW  = rrn(80);
	var bottomIDW    = rrn(80);
	var iconS        = rrn(22);
	
	var css = ø.asrStyle(tx,co,bg,rr);
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":dataUnique},css:css}));};
p.asrStyleDynamic = ()=>{};
// some elements have styles defined globally [these are what I use "."s for, for non-global styles, I use "¥"s]
// lo : low state, not active
// md : medium state, in-between, such as a mouse-over
// m2 : medium state, in-between, unfortunately needed when, for example, a mouseover and a focus need to be distinguishable - m2 is the more stable of [md,mh]
// hi : high state, most active, such as being currently clicked, with the mouse still down
p.genCSSVarS = function(o={}){π.p(o,{tx:[0,0,1],co:[0,0,0.5],bg:[0,0,0,0.85]});
	var {tx,co,bg} = o;
	var res = "--c:"+hsla(tx)+";--bgc:"+hsla(bg)+";"
	        + "--bgc-tartan:"+hslma(co,bg,0.5)+";"
	        + "--c-placeholder:"+hslmma(tx,co,bg,0.6,0.6)+";--c-highlight:"+hslma(co,tx,0.6,0.5)+";"
	        + "--bgc-button-lo:"+hslma(co,bg,0.4,bg[3])+";--bc-button-lo:"+hslmma(co,tx,bg,0.8,0.8)+";--bsw-button-lo:0px 0px 12px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset,0px 0px 6px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset;"
	        + "--bgc-button-hf:"+hslma(co,bg,0.6,bg[3])+";--bc-button-hf:"+hslmma(co,tx,bg,0.8,0.8)+";--bsw-button-hf:0px 0px 12px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset,0px 0px 6px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset;"
	        + "--bgc-button-hi:"+hslma(co,bg,0.8,bg[3])+";--bc-button-hi:"+hslmma(co,tx,bg,0.8,0.8)+";--bsw-button-hi:0px 0px 12px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset,0px 0px 6px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset;"
	        + "--c-layer-handle:"+hsla(bg)+";--bgc-layer-handle:"+hsla(co,bg[3])+";--bgc-layer-not-handle:"+hsla(bg,bg[3])+";--bsw-layer:0px 0px 4px 0px "+hsla(co)+";--tsw-layer-handle:0px 0px 6px "+hsla(co)+";"
	        + "--c-button-label:"+hslma(co,tx,1)+";--c-label:"+hsla(co,0.6)+";--tsw-label:0px 0px 6px "+hsla(bg)+",0px 0px 6px "+hsla(bg)+";"
	        + "--c-input:"+hslma(tx,co,0.6)+";--bgc-input:"+hsla(bg,bg[3])+";--bc-input-lo:"+hslma(co,bg,0.6)+";--bc-input-md:"+hslma(co,bg,0.8)+";--bc-input-m2:"+hsla(co)+";--bc-input-hi:"+hslma(co,tx,0.8)+";"
	        + ";"
	        + ";"
	        + ";";
	return res;};
var ø = {
	asrStyle:function(tx,co,bg,rr,pre=""){
		var a = (typeof bg[3] === "undefined" ? 1 : bg[3]);
		var fxnFilter = m=>Math.ceil(m);
		var rrn = (n)=>fxnFilter(rr*n);
		
		var txHF        = fxnFilter(rr*13);
		var bgPath      = "/image/books.jpg";//π.mainDirectory()++"trash/bg.jpg";
		var tabH        = fxnFilter(rr*30);
		var inputW      = fxnFilter(rr*210);
		var inputH      = fxnFilter(rr*30);
		var textareaH   = fxnFilter(rr*90);
		var selectH     = fxnFilter(rr*30);
		var buttonH     = fxnFilter(rr*30);
		var toggleH     = fxnFilter(rr*30);
		var BSCSSH      = fxnFilter(rr*30);
		var symbolPartS = fxnFilter(rr*15);
		
		var css = {
			":root" : p.genCSSVarS({tx,co,bg})+"--fs-label:"+txHF+"px;--fs-button-label:"+txHF+"px;",
			"*" : "box-sizing:border-box;line-height:1.2;transition-property:background-color,color,border-color;"
				+ "transition-timing-function:cubic-bezier(0.22,0.61,0.36,1);transition-duration:0.6s;transition-delay:0s;"
				+ "background-clip:padding-box;",
			"*:hover,*:focus,*:active" : "transition-timing-function:linear;transition-duration:0s;transition-delay:0s;",
			"html" : "¥s:1000‰;",
			"body" : "¥s:1000‰;¥ff:Verdana,Geneva,sans-serif;¥fs:"+txHF+"px;¥p:0px;¥m:0px;¥c:var(--c);¥bgc:var(--bgc);"/*¥bgi:url("+bgPath+");*/+"¥bgr:no-repeat;¥bgs:cover;¥bgo:content-box;¥bgp:center center;¥bga:fixed;¥o:hidden;",
			"table" : "border-collapse:collapse;table-layout:fixed;", // the following: "table-layout:fixed;" uses the first row it encounters as the definitive widths for the entire table
			"a,a:link,a:visited,.link"                : "¥:hand;¥c:"+hsla(co)        +";text-decoration:none;",
			"a:hover,a:focus,.link:hover,.link:focus" : "¥:hand;¥c:"+hslma(co,tx,0.5)+";text-decoration:underline;",
			"a:active,link:active"                    : "¥:hand;¥c:"+hsla(tx)        +";text-decoration:underline;",
			"textarea,input,select,label" : "¥:inline-block;¥ff:inherit;¥fs:inherit;¥c:var(--c-input);¥bgc:var(--bgc-input);¥bo:1px solid transparent;outline:none;"
			                              + "¥bc:var(--bc-input-lo);",
			"textarea:hover, input:hover, select:hover ,label:hover"  : "¥bc:var(--bc-input-md);",
			"textarea:focus, input:focus, select:focus ,label:focus"  : "¥bc:var(--bc-input-m2);",
			"textarea:active,input:active,select:active,label:active" : "¥bc:var(--bc-input-hi);",
			"textarea"  : "¥h:"+textareaH+"px;resize:none;",
			"input"     : "¥h:"+inputH+"px;¥p:0px 3px;",
			"select"    : "¥h:"+selectH+"px;¥brad:0px;¥p:3px;",
			"label"     : "cursor:pointer;border-style:dashed;",
			".file"     : "¥bgc:transparent;",
			// these placeholder styles need to be separate rules
			"::-webkit-input-placeholder"  : "¥c:var(--c-placeholder);¥op:1;",
			":-moz-placeholder"            : "¥c:var(--c-placeholder);¥op:1;",
			"::-moz-input-placeholder"     : "¥c:var(--c-placeholder);¥op:1;",
			":-ms-input-placeholder"       : "¥c:var(--c-placeholder);¥op:1;",
			// these selection styles need to be separate rules
			"::selection"      : "¥bgc:var(--c-highlight);",
			"::-moz-selection" : "¥bgc:var(--c-highlight);",
			"img[src='']" : "visibility:hidden;",
			
			// for example, reserving space in main page flow matching the space taken by an position:absolute top:0px height:auto element
			".shadow" : "position:relative !important;¥t:auto;¥r:auto;¥b:auto;¥l:auto;visibility:hidden;",
			
			".BSCSS"                       : "¥:inline-block;¥:relative;¥w:1000‰;¥h:"+BSCSSH+"px;¥o:hidden;",
			".BSCSS>*:not(.symbol)"        : "¥:block;¥:absolute;",
			".BSCSS>.label"                : "¥fs:var(--fs-label);¥b:1px;¥r:3px;font-weight:bold;¥c:var(--c-label);¥tsw:var(--tsw-label);¥bgc:transparent;pointer-events:none;white-space:nowrap;",
			".BSCSS>.button+.label"        : "¥fs:var(--fs-button-label);¥c:var(--c-button-label);¥tsw:none;",
			".BSCSS:hover>input+.label,\
			 .BSCSS:hover>textarea+.label" : "¥op:0.2;",
			".BSCSS>*:not(.label):not(.symbol)" : "¥:NW;¥s:1000‰;",
			
			".icon" : "¥bgr:no-repeat;¥bgs:cover;¥bgo:content-box;¥bgp:center center;",
			
			".pin" : "¥:inline-block;¥bgc:"+hslma(bg,co,0.9)+";¥bo:1px solid "+hslma(bg,co,0.7)+";¥brad:"+rrn(2)+"px;¥p:"+rrn(2)+"px;¥fs:600‰;font-weight:normal;",
			
			".C¥nejname"           : "¥:inline;",
			".C¥nejname>:nth-child(1)" : "¥:inline;",
			".C¥nejname>sub"       : "¥:relative;¥b:-0.1em;¥fs:650‰;vertical-align:bottom;",
			".C¥nejname>sup"       : "¥fs:800‰;vertical-align:top;",
			
			".button"                       : "¥:inline-block;¥h:"+buttonH+"px;¥bo:1px solid transparent;¥p:1px 3px;¥ta:center;¥:hand;"
			                                + "¥bgc:var(--bgc-button-lo);¥bc:var(--bc-button-lo);¥bsw:var(--bsw-button-lo);",
			".button:hover,.button:focus"   : "¥bgc:var(--bgc-button-hf);¥bc:var(--bc-button-hf);¥bsw:var(--bsw-button-hf);",
			".button:active,.button.active" : "¥bgc:var(--bgc-button-hi);¥bc:var(--bc-button-hi);¥bsw:var(--bsw-button-hi);",
			".button.active"                : "transition-duration:0s;",
			
			".toggle"                             : "¥:inline-block;¥h:"+toggleH+"px;¥c:"+hslma(co,tx,0.5)+";¥bo:1px solid transparent;¥ta:center;¥:hand;",
			".toggle.off"                         : "¥bgc:"+hslmma(co,bg,bg,0.5,0.4)+";¥bc:"+hslmma(co,tx,bg,0.6,0.4)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.2 )+" inset;",
			".toggle.off:hover,.toggle.off:focus" : "¥bgc:"+hslmma(co,bg,bg,0.5,0.7)+";¥bc:"+hslmma(co,tx,bg,0.6,0.7)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.35)+" inset;",
			".toggle.off:active"                  : "¥bgc:"+hslmma(co,bg,bg,0.5,1  )+";¥bc:"+hslmma(co,tx,bg,0.6,1  )+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.5 )+" inset;",
			".toggle.on"                          : "¥bgc:"+hslmma(co,bg,bg,0.8,0.8)+";¥bc:"+hslmma(co,tx,bg,0.8,0.8)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.4 )+" inset;",
			".toggle.on:hover,.toggle.on:focus"   : "¥bgc:"+hslmma(co,bg,bg,0.8,0.9)+";¥bc:"+hslmma(co,tx,bg,0.8,0.9)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.45)+" inset;",
			".toggle.on:active"                   : "¥bgc:"+hslmma(co,bg,bg,0.8,1  )+";¥bc:"+hslmma(co,tx,bg,0.8,1  )+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.5 )+" inset;",
			"label.toggle>input[type='checkbox']" : "display:none;",
			
			".bb_link" : "",
			".bb_line" : "¥:block;¥w:100%;¥h:1px;¥bo:0px solid transparent;border-top-width:1px;",
			".bb_fixedwidth" : "¥ff:Monaco,Menlo,monospace;",
			".bb_size" : "¥:inline-block;",
			".bb_bold" : "font-weight:bold;",
			".bb_italic" : "font-style:italic;",
			".bb_image" : "¥wmax:600px;¥hmax:600px;",
			".bb_strikethrough" : "text-decoration:line-through;",
			".bb_underline"     : "text-decoration:underline;",
			".bb_rainbow"       : "",
			".bb_spoiler"       : "¥c:"+hsla(tx,0)+";¥tsw:0px 0px 10px "+hslma(tx,bg,0.8)+";",
			".bb_spoiler:hover" : "¥c:"+hsla(tx)+";¥tsw:0px 0px 10px "+hslma(tx,bg,0.8,0.3)+";",
			".bb_quote"         : "¥:inline-block;¥w:auto;¥p:0px 2px;¥bo:1px solid "+hslma(tx,bg,0.6)+";",
			
			/*"@keyframes rainbowC" : function(){
				var res = "";
				for (var i = 0; i <= 100; i++){
					res += i+"%{¥c:"+hsla([π.chop(i*0.01,2),co[1],co[2]])+";}";}
				return res;}(),
			"@keyframes rainbowTsw1" : function(){
				var res = "";
				for (var i = 0; i <= 100; i++){
					res += i+"%{¥tsw:0px 0px 10px "+hslma([π.chop(i*0.01,2),co[1],co[2]],bg,0.8)+";}";}
				return res;}(),
			"@keyframes rainbowTsw2" : function(){
				var res = "";
				for (var i = 0; i <= 100; i++){
					res += i+"%{¥tsw:0px 0px 10px "+hslma([π.chop(i*0.01,2),co[1],co[2]],bg,0.8,0.3)+";}";}
				return res;}(),*/
			};
		if (pre === ""){return css;}
		else{
			var cssNew = {};
			css.forEach((v,i)=>{
				π.split(i,",").map(v=>pre+" "+v).forEach(iNew=>{π.ooa(cssNew,{[iNew]:v});});
			});
			return cssNew;}},
};
document.addEventListener("DOMContentLoaded",()=>{
	p.asrFont();
	p.asrStyle();window.addEventListener("resize",function(){p.asrStyle();p.asrStyleDynamic();Ω.css.forEach(v=>{µ.csse(v);});});
	/*//------------------------------------------------------------------------------------------------------------------------
	for (var tbl of p.tblA){
		core.socketO[tbl] = {
			dmp:{
				success:o=>{
					// "you need everything that was dumped"
					if (typeof p.procO[o.mir.prc] === "undefined"){return;} // !!! temp shut-up gate
					π.aaaw(p.procO[o.mir.prc].tblxIDA[o.mir.tbl],o.dat[o.mir.tbl].map(v=>v.ID));
					core.socketO[tbl].get.success(o);},
				failure:o=>{;},},
			get:{
				success:o=>{
					π.oaa(p.tblxleafO[o.mir.tbl],o.dat[o.mir.tbl],"ID");
					var IDA = o.dat[o.mir.tbl].map(v=>v.ID);
					p.procO.forEach(proc=>{
						proc.rcv({o,intersectF:π.aaIntersect(proc.tblxIDA[o.mir.tbl],IDA),});});},
				failure:o=>{;},},
			new:{
				success:o=>{
					if (o.mir.tbl === "user"){
						var user = (typeof o.dat.user[0] !== "undefined") ? o.dat.user[0] : o.dat.user["new"] ;
						core.plu = user.plu;
						localStorage.setItem("FtB575_ID" ,user.ID );
						localStorage.setItem("FtB575_plu",user.plu);
						p.who();
						p.onAuth();}
					var IDA = [o.dat[o.mir.tbl].new.ID,];
					p.procO.forEach(proc=>{
						proc.rcv({o,intersectF:π.aaIntersect(proc.tblxIDA[o.mir.tbl],IDA),});});},
				failure:o=>{;},},
			edt:{
				success:o=>{
					var IDA = π.uniqueA([o.dat[o.mir.tbl].old.ID,o.dat[o.mir.tbl].new.ID,]);
					p.procO.forEach(proc=>{
						proc.rcv({o,intersectF:π.aaIntersect(proc.tblxIDA[o.mir.tbl],IDA),});});},
				failure:o=>{;},},
			del:{
				success:o=>{
					var IDA = [o.dat[o.mir.tbl].old.ID,];
					p.procO.forEach(proc=>{
						proc.rcv({o,intersectF:π.aaIntersect(proc.tblxIDA[o.mir.tbl],IDA),});});},
				failure:o=>{;},},};}
	// memory getter, refresher, deleter
	π.intervalCall(1000000,p.memexe=()=>{
		core.down();
		for (var tbl of p.tblA){
			var IDA_ask = [];
			// get overall IDA for this tbl by grouping all process IDAs
			var IDA = π.uniqueA(p.procO.mapV(proc=>proc.tblxIDA[tbl].concat(proc.tblxIDA_pre[tbl])).reduce((p,IDA)=>p.concat(IDA),[]));
			// for each leaf in memory
			p.tblxleafO[tbl].forEach((leaf,ID)=>{
				// if leaf has expired
				if (leaf.expiration < p.now()){
					// if some process wants it
					if (IDA.includes(ID)){
						// refresh the leaf [defer until later for performance]
						IDA_ask.pushUnique(ID);}
					// else no process wants it
					else{
						// remove the leaf
						delete p.tblxleafO[tbl][ID];}}}); // ??? is this okay to do in a forEach block
			// if some process needs a leaf that we don't have in memory, ask for it [defer until later for performance]
			for (var ID of IDA){
				if (typeof p.tblxleafO[tbl][ID] === "undefined"){
					IDA_ask.pushUnique(ID);}}
			// if a leaf ID of 0 somehow gets into the mix, ignore it
			// !!! we might ask for a non-existent leaf, and it will currently take a while before we stop asking for it
			π.dessertA(IDA_ask,[0]);
			// if there were any leaves to refresh or obtain for the first time
			if (IDA_ask.length !== 0){
				// send the request in an IDA batch for performance
				core.send({tbl,act:"get",dat:{IDA:IDA_ask}});}}
		p.procO.forEach(proc=>{proc.poke();});
		core.up();
	});
	π.intervalCall(60000000,p.who=()=>{
		core.send({tbl:"n/a",act:"ftb575_who"});});
	//------------------------------------------------------------------------------------------------------------------------
	core.socketO["RHO"] = {
		"preGlobal":(len,lenCompress)=>{
			ll(" ".repeat(55)+π.padLMin(lenCompress,6," ")+"B @ "+π.padLMin(int(1000*lenCompress/len),4," ")+"‰ v");},
		"pre":(o)=>{
			var a = o.b - o.a;
			var b = o.f - o.e;
			var ttif = a + b; // total time in flight
			ll("["+" "+o.msg+" "+"] "+π.padRAbs(o.mir.tbl,10," ")+" "+π.padRAbs(o.mir.act,11," ")+" "+π.padLMin(o.d    -o.c  ,6," ")+"µs[exe] "+π.padLMin(Math.ceil(ttif*0.001),4," ")+"ms[ttif]");
			//ll(o);
			if (o.sta < 0){ll(o);}
			var serverClockOffsetFromLocal = a - (ttif/2);
			p.clockOffsetArr.push(serverClockOffsetFromLocal);
			while (p.clockOffsetArr.length > 100){p.clockOffsetArr.shift();}
			p.clockOffset = p.clockOffsetArr.reduce(function(a,b){return a+b;})/p.clockOffsetArr.length;},
		"post":(o)=>{},
		"postGlobal":(len,lenCompress)=>{},
	};
	core.socketO["n/a"] = {
		ftb575_authenticate : {
			success:o=>{
				core.plu = o.dat.plu;
				localStorage.setItem("FtB575_ID" ,o.dat.ID );
				localStorage.setItem("FtB575_plu",o.dat.plu);
				p.who();
				p.onAuth();},},
		ftb575_who : {
			success:o=>{
				if ((typeof o.dat.user["new"] !== "undefined") || (typeof o.dat.user[0] !== "undefined")){
					var first = (typeof p.user === "undefined" || p.user === null);
					var user = (typeof o.dat.user[0] !== "undefined") ? o.dat.user[0] : o.dat.user["new"];
					core.plu = user.plu;
					p.user   = user;
					p.ID     = user.ID  ;
					p.name   = user.name;
					p.tx = [π.chop(user.htx/1000,3),π.chop(user.stx/1000,3),π.chop(user.ltx/1000,3)];
					p.co = [π.chop(user.hco/1000,3),π.chop(user.sco/1000,3),π.chop(user.lco/1000,3)];
					p.bg = [π.chop(user.hbg/1000,3),π.chop(user.sbg/1000,3),π.chop(user.lbg/1000,3),π.chop(user.a/1000,3)];
					if (typeof KERN000001 !== "undefined"){KERN000001.refresh({tx:p.tx,co:p.co,bg:p.bg,});}
					if (typeof KERN000004 !== "undefined"){KERN000004.refresh({tx:p.tx,co:p.co,bg:p.bg,});}
					if (first && typeof p.load !== "undefined"){p.load();}
					p.asrStyle();}},},};
	p.pluAuth();
	uniani.register("rainbow",{
		latchN:0,
		drawFrame:function(){
			this.latchN = (this.latchN+1)%3;
			if (this.latchN !== 0){return;}
			var bb_rainbowA         = µ.qdA(".bb_rainbow");
			var bb_rainbow_spoilerA = µ.qdA(".bb_rainbow .bb_spoiler");
			var bb_spoiler_rainbowA = µ.qdA(".bb_spoiler .bb_rainbow");
			var bb_allA             = bb_rainbowA.concat(bb_rainbow_spoilerA); // intentional, watch out for redundancy
			for (var el of bb_allA){
				var dir = µ.ga(el,"data-rainbow-dir");if (dir === ""){dir = [-1,1][π.rand(0,1)].toString();µ.sa(el,"data-rainbow-dir",dir);}
				var hue = µ.ga(el,"data-rainbow-hue");if (hue === ""){hue = π.rand(0,1000).toString();     µ.sa(el,"data-rainbow-hue",hue);}
				hue = π.wmod(int(hue)+(int(dir)*(6+π.rand(0,2))),0,999);
				if (π.rand(0,200) === 0){
					dir = (dir==="-1")?"1":"-1";
					µ.sa(el,"data-rainbow-dir",dir);}
				µ.sa(el,"data-rainbow-hue",hue);}
			for (var el of bb_rainbowA        ){el.style.color      =                 hsla([int(µ.ga(el,"data-rainbow-hue"))*0.001,p.co[1],p.co[2]]);}
			for (var el of bb_rainbow_spoilerA){el.style.textShadow = "0px 0px 10px "+hsla([int(µ.ga(el,"data-rainbow-hue"))*0.001,p.co[1],p.co[2]]);}
			for (var el of bb_spoiler_rainbowA){el.style.textShadow = "0px 0px 10px "+hsla([int(µ.ga(el,"data-rainbow-hue"))*0.001,p.co[1],p.co[2]]);}},
	});*/
});
/*
// a toggle button
[".row[data-type='customGame noteDelay']",[
	µ.bscss("override",["label.toggle.off",[
		["input[type='checkbox']",{change:function(){p.fxnCheckbox.call(this);fxnNoteDelay();}}],]]),
	µ.bscss("note delay (µs)",KERN000001.gen({title:"",markA:noteDelayMarkA,initialValue:0,centerValue:0,tx:p.tx,co:p.co,bg:p.bg,valueSetCallback:fxnNoteDelay})),]],
*/
