<? require_once("/home/ftbsliceofcake2/gate/gate_575.php"); ?>
<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta name="description" content="Feel the Beats - Rhythm Game"><meta name="keywords" content="FtB,Rhythm,Game,XceeD"><meta name="author" content="XceeD Illuminati"><meta name="creator" content="XceeD Illuminati"><meta name="publisher" content="XceeD Illuminati"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /edit/</title><link href="../image/favicon.png" rel="icon" type="image/png">
<script>
<?
require_once("../shelfLocal/butler.js");
require_once("../shelfLocal/specific.js"); ?>
</script>
<?
require_once("../shelfLocal/KERN/KERN.php");
require_once("../shelfLocal/KERN/ZACH.php");
require_once("../shelfLocal/KERN/KERN000005.php");
require_once("../shelfLocal/KERN/KERN000006.php");
require_once("../shelfLocal/KERN/KERN000007.php");
require_once("../shelfLocal/KERN/KERN000008.php");
require_once("../shelfLocal/KERN/KERN000009.php");
require_once("../shelfLocal/KERN/KERN000010.php");
require_once("../shelfLocal/KERN/KERN000011.php");
require_once("../shelfLocal/KERN/KERN000012.php");
require_once("../shelfLocal/KERN/KERN000013.php");
require_once("../shelfLocal/KERN/KERN000014.php");
require_once("../shelfLocal/KERN/KERN000015.php");
require_once("../shelfLocal/KERN/KERN000016.php"); ?>
<script>
p.handleH_base = 12;
p.handleH = p.handleH_base; // subject to change every style recompute cycle
p.asrStyle = function(mode="root",dataUnique="root",o={}){
	var rr = π.reductionRatio(p.rrx,p.rry);
	var {tx,co,bg} = p;
	var a = (typeof bg[3] === "undefined" ? 1 : bg[3]);
	var fxnFilter = m=>Math.ceil(m);
	var rrn = (n)=>fxnFilter(rr*n);
	var handleH = rrn(p.handleH_base);
	p.handleH = handleH;
	
	var css = ø.asrStyle(tx,co,bg,rr);
	switch (mode){default:
	break;case "root":
		π.ooas(css,{
			"body " : "background-image:"
			+"repeating-linear-gradient(transparent,transparent 50px,hsla(0,0%,0%,0.4) 50px,hsla(0,0%,0%,0.4) 53px,transparent 53px,transparent 63px,hsla(0,0%,0%,0.4) 63px,hsla(0,0%,0%,0.4) 66px,transparent 66px,transparent 116px,hsla(0,0%,0%,0.5) 116px,hsla(0,0%,0%,0.5) 166px,hsla(0,0%,100%,0.1) 166px,hsla(0,0%,100%,0.1) 169px,hsla(0,0%,0%,0.5) 169px,hsla(0,0%,0%,0.5) 179px,hsla(0,0%,100%,0.1) 179px,hsla(0,0%,100%,0.1) 182px,hsla(0,0%,0%,0.5) 182px,hsla(0,0%,0%,0.5) 232px,transparent 232px),"
			+"repeating-linear-gradient(270deg,transparent,transparent 50px,hsla(0,0%,0%,0.4) 50px,hsla(0,0%,0%,0.4) 53px,transparent 53px,transparent 63px,hsla(0,0%,0%,0.4) 63px,hsla(0,0%,0%,0.4) 66px,transparent 66px,transparent 116px,hsla(0,0%,0%,0.5) 116px,hsla(0,0%,0%,0.5) 166px,hsla(0,0%,100%,0.1) 166px,hsla(0,0%,100%,0.1) 169px,hsla(0,0%,0%,0.5) 169px,hsla(0,0%,0%,0.5) 179px,hsla(0,0%,100%,0.1) 179px,hsla(0,0%,100%,0.1) 182px,hsla(0,0%,0%,0.5) 182px,hsla(0,0%,0%,0.5) 232px,transparent 232px),"
			+"repeating-linear-gradient(125deg,transparent,transparent 2px,hsla(0,0%,0%,0.2) 2px,hsla(0,0%,0%,0.2) 3px,transparent 3px,transparent 5px,hsla(0,0%,0%,.2) 5px);"
			+"background-color:var(--bgc-tartan);",
			
			".layer"                 : "¥:block;¥:absolute;¥t:200px;¥l:100px;¥w:auto;¥h:auto;¥wmin:"+20+"px;¥hmin:"+20+"px;¥c:"+hsla(tx)+";¥bsw:var(--bsw-layer);overflow:hidden;¥z:1;",
			".layer>.handle"         : "¥w:1000‰;¥h:"+handleH+"px;¥fs:"+(handleH*0.8)+"px;¥c:var(--c-layer-handle);¥bgc:var(--bgc-layer-handle);¥tsw:var(--tsw-layer-handle);cursor:move;¥pl:2px;¥:one-row;",
			".layer>.handle>.faded"  : "¥pl:"+6+"px;¥op:0.35;",
			".layer>:not(.handle)"   : "¥w:1000‰;¥h:calc(1000‰ - "+handleH+"px);¥c:var(--c);¥bgc:var(--bgc-layer-not-handle);",
			
			// bg number should correspond to negative z-index
			"body>¥bg1"              : "¥:absolute;¥:NW;¥s:1000‰;¥z:-1;",
			"body>¥innerBody"        : "¥:absolute;¥:NW;¥s:1000‰;¥z:0;",
			
			"body>¥toolbar"          : "¥:absolute;¥:SW;¥w:1000‰;¥z:1;",
			"body>¥toolbar>*"        : "¥:block;¥w:"+rrn(120)+"px;¥f:right;",
			"body>¥toolbar>¥lock"    : "¥w:"+rrn(120)+"px;",
			"body>¥toolbar>¥unlock"  : "¥w:"+rrn(120)+"px;",
			
			"body>¥innerBody>.shield" : "¥:block;¥:NW;¥:full-screen;",
			
			});}
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":dataUnique},css:css}));};
// !!! sigh this is going to be difficult
p.genSaveFile = function(){
	var partKERN = KERNA.filter(root=>typeof root !== "undefined").map(root=>({
		name     : root.name,
		ID  : root.ID,
		oPartial : π.cc(root.portInSP.filter(portS=>{
			var guideK = root.portInP.indexOf(portS);
			var guide = root.portInP.get(guideK);
			var typeLeaf = guide[guide.length-1];
			return typeLeaf !== KERNTypeO.function && typeLeaf !== KERNTypeO.complexReference;
		}).mapO(portS=>({[portS]:root.o[portS]}))),
	}));
	return π.jsonE({partKERN});};
p.loadSaveFile = function(s){
	var json = π.jsonD(s);
	if (typeof json === "undefined"){return;} // passed some bogus data
	var partKERN = json.partKERN;
	partKERN.forEach(root=>{
		//ll(root.ID,root.oPartial);
		//KERNA[root.ID].inbound({datA:root.oPartial.mapV((v,i)=>[i,v])});
		var elKERN = KERNA.find(v=>typeof v !== "undefined" && v.ID===root.ID);
		if (elKERN !== U){
			π.ooas(elKERN.o,root.oPartial);
			elKERN.inbound({setupF:T});}
	});};
//----
var t = 0;var l = 0;var _;var z = 1;var elP = N;var mode = "layer"; // elP filled on DOM load
var tAnchor = 0;var lAnchor = 0;
var elKERNDimO  = {};
var elKERNPreO  = {};
var elKERNPostO = {}; // what ZACH returns
var elKERNLinkA = [];
p.shift = function(dir){
	switch (dir){default:;
		break;case "↑↑":t = tAnchor;
		break;case "↑" :t -= elKERNDimO[_].i;
		break;case "→" :l += elKERNDimO[_].w;
		break;case "↓" :t += elKERNDimO[_].i;
		break;case "←←":l = lAnchor;
		break;case "←" :l -= elKERNDimO[_].w;}};
p.preBuild = function(){
	//ll(_);//if (typeof elKERNDimO[_] === "undefined"){ll(_);}
	π.ooaw(elKERNPreO[_],{mode,elP,style:{w:elKERNDimO[_].w,h:elKERNDimO[_].h,t,l,z:z++}});};
p.panelHideAllFxn = function(){
	var counterA = [];
	KERNA.forEach(root=>{if (typeof root === "undefined"){return;}
		var ID = root.ID;
		if (ID.startsWith("gfKey") && !["gfKey1","gfKey2","gfKey3","gfKey4","gfKey5","gfKey6","gfKey7","gfKey8","gfKey9","gfKey10"].includes(ID)){counterA.push(root.counter);return;}
		if (["gameframe0","score0","hidePanels0","showPanels0","audioFile0","chartFile0","chartAudio0","gfSeek0"].includes(ID)){counterA.push(root.counter);return;}
	});
	µ.qdA(".layer"+counterA.map(v=>":not(¥KERN_"+v+")").join("")).forEach(el=>{el.style.visibility = "hidden";});
};
p.panelShowAllFxn = function(){µ.qdA(".layer").forEach(el=>{el.style.visibility = "visible";});};
var elKERNO = {};
document.addEventListener("DOMContentLoaded",()=>{
	var startGlobalT = π.now();
	panflo.aliveF = F;
	µ.rr(document.body,µ.m([[
		["¥bg1"],
		["¥innerBody",[
			[".shield¥A"],
			[".shield¥B"],
			[".shield¥C"],
			[".shield¥D"],
			[".shield¥E"],
			[".shield¥F"],
		]],
		["¥toolbar",[
			µ.bscss("main"                       ,[".button",{click:function(){var me = "A";µ.qdA(".shield:not(¥"+me+")").forEach(el=>{el.style.display = "none";});µ.qd(".shield¥"+me).style.display = "block";}}],".trigger"),
			µ.bscss("key bindings\n& lane colors",[".button",{click:function(){var me = "B";µ.qdA(".shield:not(¥"+me+")").forEach(el=>{el.style.display = "none";});µ.qd(".shield¥"+me).style.display = "block";}}],".trigger"),
			µ.bscss("gameframe misc"             ,[".button",{click:function(){var me = "C";µ.qdA(".shield:not(¥"+me+")").forEach(el=>{el.style.display = "none";});µ.qd(".shield¥"+me).style.display = "block";}}],".trigger"),
			µ.bscss("overall"                    ,[".button",{click:function(){var me = "D";µ.qdA(".shield:not(¥"+me+")").forEach(el=>{el.style.display = "none";});µ.qd(".shield¥"+me).style.display = "block";}}],".trigger"),
			µ.bscss("mods"                       ,[".button",{click:function(){var me = "E";µ.qdA(".shield:not(¥"+me+")").forEach(el=>{el.style.display = "none";});µ.qd(".shield¥"+me).style.display = "block";}}],".trigger"),
			µ.bscss("conversions"                ,[".button",{click:function(){var me = "F";µ.qdA(".shield:not(¥"+me+")").forEach(el=>{el.style.display = "none";});µ.qd(".shield¥"+me).style.display = "block";}}],".trigger"),
		]],
	]]));
	
//	var t = 0; // top, because the interface is row-based
//	var t_FREEZE = 0; // memory variable for top before entering a multi-row for loop
	elP = µ.qd("¥innerBody");
	
	
	
	
	
	
	
	
	
	
	// BG
	// -----------------------------------------------------------------------------------------------------------------
	p.shift("←←");
	p.shift("↑↑");
	/***/elKERNPreO[  "bgImg0" ] = {mode:"embed",partID:"KERN000012",elP:µ.qd("body>¥bg1"),initial:[["bgs","cover"]]};
	
	
	
	
	
	
	
	
	
	
	// SHIELD A
	// -----------------------------------------------------------------------------------------------------------------
	elP = µ.qd(".shield¥A");
	p.shift("←←");
	p.shift("↑↑");
	var h = 30;
	elKERNDimO["gameframe0"     ] = {w:300,h:600};
	elKERNDimO["score0"         ] = {w:350,h};
	elKERNDimO["audioFile0"     ] = {w:350,h};
	elKERNDimO["chartFile0"     ] = {w:350,h};
	elKERNDimO["chartAudio0"    ] = {w:350,h};
	elKERNDimO["audioLeeway0"   ] = {w:150,h:20};
	elKERNDimO["gfSeek0"        ] = {w:350,h};
	elKERNDimO["gfPlaybackRate0"] = {w:350,h};
	elKERNDimO["gfVolume0"      ] = {w:350,h};
	elKERNDimO["gfNoteDelay0"   ] = {w:350,h};
	elKERNDimO["gfScrollSpeed0" ] = {w:350,h};
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	/***/elKERNPreO[_="score0"         ] = {partID:"KERN000014",title:"score"                     };p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="audioFile0"     ] = {partID:"KERN000009",title:"audio file"  };p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="chartFile0"     ] = {partID:"KERN000009",title:"chart file"  };p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="chartAudio0"    ] = {partID:"KERN000010",title:"chart audio" };p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="audioLeeway0"   ] = {partID:"KERN000005",title:"audio leeway",initial:[["value",100000],["dirAsc","E"],["min",0],["max",500000],["snap",10000],["valueFxn",v=>(v/1000)+"ms"]]};p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="gfSeek0"        ] = {partID:"KERN000005",title:"gf seek"     ,initial:[["value",0],["dirAsc","E"],["ascRoot",0],["min",0],["max",1],["snap",0.000001],["ascMode","additive"],["valueFxn",v=>Math.floor(v*1000)+"‰"]]};p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="gfVolume0"      ] = {partID:"KERN000005",title:"volume"         ,initial:[["value",      0.8    ],["dirAsc","E"],["ascRoot",0],["min",      0     ],["max",      1     ],["snap",     0.05   ],["ascMode","additive"],["valueFxn",v=>v+"?"]]};p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="gfNoteDelay0"   ] = {partID:"KERN000005",title:"note delay"     ,initial:[["value",      0      ],["dirAsc","E"],["ascRoot",0],["min",-750000     ],["max", 500000     ],["snap",  1000      ],["ascMode","additive"],["valueFxn",v=>(v/1000)+"ms"]]};p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="gfPlaybackRate0"] = {partID:"KERN000005",title:"playback rate"  ,initial:[["value",      1      ],["dirAsc","E"],["ascRoot",1],["min",      0.1   ],["max",      2     ],["snap",     0.1    ],["ascMode","additive"],["valueFxn",v=>v+"x"]]};p.preBuild();
	p.shift("↓");
	/***/elKERNPreO[_="gfScrollSpeed0" ] = {partID:"KERN000005",title:"scroll speed"   ,initial:[["value",      0.00055],["dirAsc","E"],["ascRoot",0],["min",     -0.0015],["max",      0.0015],["snap",     0.00005],["ascMode","additive"],["valueFxn",(v,c)=>(c===0?(v*1000):(v*1000).toPrecision(c))+"x"]]};p.preBuild();
	p.shift("→");
	p.shift("↑↑");
	/***/elKERNPreO[_="gameframe0"     ] = {partID:"KERN000006",title:"gameframe"                 };p.preBuild();
	
	elKERNLinkA.push({from:"gameframe0",to:"score0"     ,portA:[[["noteInstantStatA"],["noteInstantStatA"]],[["hitC"],["hitC"]],[["holdC"],["holdC"]],[["passedHeadC"],["passedHeadC"]],[["passedTailC"],["passedTailC"]],[["scoreResetSignal"],["scoreResetSignal"]],[["earnedHeadC"],["earnedHeadC"]],[["earnedTailC"],["earnedTailC"]]]});
	elKERNLinkA.push({from:"gameframe0",to:"chartAudio0",portA:[[["state"],["state"]],[["chartP"],["t"]],[["playbackRate"],["playbackRate"]],[["volume"],["volume"]]]});
	elKERNLinkA.push({from:"gameframe0",to:"gfFtB4TransTarget0" ,portA:[[["translatedSO","FtB4"],["txt"]]]});
	elKERNLinkA.push({from:"gameframe0",to:"gfo!m14TransTarget0",portA:[[["translatedSO","o!m14"],["txt"]]]});
	elKERNLinkA.push({from:"audioFile0"  ,to:"chartAudio0",portA:[[["fil"],["fil"]]]});
	elKERNLinkA.push({from:"chartFile0"  ,to:"gameframe0" ,portA:[[["fil"],["chartR"]]]});
	elKERNLinkA.push({from:"audioLeeway0",to:"chartAudio0",portA:[[["value"],["leeway"]]]});
	elKERNLinkA.push({from:"gfSeek0"     ,to:"gameframe0" ,portA:[[["value"],["tTentative"]],[["valueValidSignal"],["tTentativeSignal"]]]});
	elKERNLinkA.push({from:"gfNoteDelay0"     ,to:"gameframe0",portA:[[["value"],["noteOffset"]]]});
	elKERNLinkA.push({from:"gfScrollSpeed0"   ,to:"gameframe0",portA:[[["value"],["speedMultiplier"]]]});
	elKERNLinkA.push({from:"gfPlaybackRate0"  ,to:"gameframe0",portA:[[["value"],["playbackRate"]]]});
	elKERNLinkA.push({from:"gfVolume0"        ,to:"gameframe0",portA:[[["value"],["volume"]]]});
	
	
	
	
	
	
	
	
	
	// SHIELD B
	// -----------------------------------------------------------------------------------------------------------------
	elP = µ.qd(".shield¥B");
	p.shift("←←");
	p.shift("↑↑");
	var w = 25;
	var h = 90;
	for (var s = 1; s <= 10; s++){
		elKERNDimO["gfNoteFadedCo"      +s] = {w,h};
		elKERNDimO["gfNoteCo"           +s] = {w,h};
		elKERNDimO["gfNoteActiveCo"     +s] = {w,h};
		elKERNDimO["gfLaneWarningPreCo" +s] = {w,h};
		elKERNDimO["gfLaneWarningPostCo"+s] = {w,h};
		elKERNDimO["gfLaneCo"           +s] = {w,h};
		elKERNDimO["gfLaneActiveCo"     +s] = {w,h};
		elKERNDimO["gfHitboxCo"         +s] = {w,h};
		elKERNDimO["gfHitboxActiveCo"   +s] = {w,h};}
	
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	var pink      = rgbToHsl([255,  0,170].map(v=>v/255));
	var orange    = rgbToHsl([255,170,  0].map(v=>v/255));
	var purple    = rgbToHsl([170,  0,255].map(v=>v/255));
	var green     = rgbToHsl([170,255,  0].map(v=>v/255));
	var blue      = rgbToHsl([  0,170,255].map(v=>v/255));
	var turquoise = rgbToHsl([  0,255,170].map(v=>v/255));
	var coA = [N,pink,orange,green,blue,green,orange,pink,purple,purple,purple];
	for (var s = 1; s <= 10; s++){
		p.shift("↑↑");
		/***/elKERNPreO[_="gfLaneWarningPostCo"+s] = {partID:"KERN000008",title:"l> k"+s+" co5",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0   ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("→");
		/***/elKERNPreO[_="gfLaneWarningPreCo" +s] = {partID:"KERN000008",title:"l< k"+s+" co4",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0   ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("←");
		p.shift("↓");
		/***/elKERNPreO[_="gfHitboxCo"         +s] = {partID:"KERN000008",title:"h- k"+s+" co8",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0.5 ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("→");
		/***/elKERNPreO[_="gfHitboxActiveCo"   +s] = {partID:"KERN000008",title:"h↑ k"+s+" co9",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0.75],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("←");
		p.shift("↓");
		/***/elKERNPreO[_="gfNoteCo"           +s] = {partID:"KERN000008",title:"n- k"+s+" co2",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0.5 ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("→");
		/***/elKERNPreO[_="gfNoteActiveCo"     +s] = {partID:"KERN000008",title:"n↑ k"+s+" co3",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0.9 ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("←");
		p.shift("↓");
		/***/elKERNPreO[_="gfNoteFadedCo"      +s] = {partID:"KERN000008",title:"n↓ k"+s+" co1",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0.1 ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("→");
		/***/elKERNPreO[_="gfLaneCo"           +s] = {partID:"KERN000008",title:"l- k"+s+" co6",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0   ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("→");
		/***/elKERNPreO[_="gfLaneActiveCo"     +s] = {partID:"KERN000008",title:"l↑ k"+s+" co7",initial:[["hValue",coA[s][0]],["sValue",1],["lValue",0.1 ],["aValue",1],["orientation","vertical"]]};p.preBuild();
		p.shift("→");
		
		elKERNLinkA.push({from:"gfNoteFadedCo"      +s,to:"gameframe0",portA:[[["coValueS"],["noteFadedCoA"      ,s]]]});
		elKERNLinkA.push({from:"gfNoteCo"           +s,to:"gameframe0",portA:[[["coValueS"],["noteCoA"           ,s]]]});
		elKERNLinkA.push({from:"gfNoteActiveCo"     +s,to:"gameframe0",portA:[[["coValueS"],["noteActiveCoA"     ,s]]]});
		elKERNLinkA.push({from:"gfLaneWarningPreCo" +s,to:"gameframe0",portA:[[["coValueS"],["laneWarningPreCoA" ,s]]]});
		elKERNLinkA.push({from:"gfLaneWarningPostCo"+s,to:"gameframe0",portA:[[["coValueS"],["laneWarningPostCoA",s]]]});
		elKERNLinkA.push({from:"gfLaneCo"           +s,to:"gameframe0",portA:[[["coValueS"],["laneCoA"           ,s]]]});
		elKERNLinkA.push({from:"gfLaneActiveCo"     +s,to:"gameframe0",portA:[[["coValueS"],["laneActiveCoA"     ,s]]]});
		elKERNLinkA.push({from:"gfHitboxCo"         +s,to:"gameframe0",portA:[[["coValueS"],["hitboxCoA"         ,s]]]});
		elKERNLinkA.push({from:"gfHitboxActiveCo"   +s,to:"gameframe0",portA:[[["coValueS"],["hitboxActiveCoA"   ,s]]]});}
	
	p.shift("↓");
	p.shift("←←");
	var w = 75;
	var h = 45;
	π.a(1,10).forEach(s=>{elKERNDimO["gfKey"+s] = {w,h};});
	["reset","hi","hop↑","jump↑","pbr↑","spd↑","snap↑","vol↑","show","N/A","lo","hop↓","jump↓","pbr↓","spd↓","snap↓","vol↓","hide"].forEach(s=>{elKERNDimO["gfKey"+s] = {w,h};});
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	// key bindings
	({1:65,2:83,3:68,4:70,5:71,6:72,7:74,8:75,9:76,10:186}).forEach((which,s)=>{
		/***/elKERNPreO[_="gfKey"+s] = {partID:"KERN000011",title:"k lane"+s,initial:[["which",which],["location",0]]};p.preBuild();
		p.shift("→");
		elKERNLinkA.push({from:"gfKey"+s,to:"gameframe0",portA:[[["state"],["keyStateA",s]]]});});
	p.shift("↓");
	p.shift("←←");
	({"reset":48,"hi":81,"hop↑":38,"jump↑":39,"pbr↑":0,"spd↑":0,"snap↑":36,"vol↑":33,"show":88}).forEach((which,s)=>{
		/***/elKERNPreO[_="gfKey"+s] = {partID:"KERN000011",title:"k "+s,initial:[["which",which],["location",0]]};p.preBuild();
		p.shift("→");
		switch (s){default    :elKERNLinkA.push({from:"gfKey"+s,to:"gameframe0"     ,portA:[[["state"],["keyStateA",s]]]});
			break;case "pbr↑" :elKERNLinkA.push({from:"gfKey"+s,to:"gfPlaybackRate0",portA:[[["edgeHiSignal"],["incSignal"]]]});
			break;case "spd↑" :elKERNLinkA.push({from:"gfKey"+s,to:"gfScrollSpeed0" ,portA:[[["edgeHiSignal"],["incSignal"]]]});
			break;case "snap↑":elKERNLinkA.push({from:"gfKey"+s,to:"gfSnap0"        ,portA:[[["edgeHiSignal"],["incSignal"]]]});
			break;case "vol↑" :elKERNLinkA.push({from:"gfKey"+s,to:"gfVolume0"      ,portA:[[["edgeHiSignal"],["incSignal"]]]});
			break;case "show" :elKERNLinkA.push({from:"gfKey"+s,to:"showPanels0"    ,portA:[[["edgeHiSignal"],["edgeHiInSignal"]],[["edgeLoSignal"],["edgeLoInSignal"]]]});}});
	p.shift("↓");
	p.shift("←←");
	({"N/A":0,"lo":87,"hop↓":40,"jump↓":37,"pbr↓":0,"spd↓":0,"snap↓":35,"vol↓":34,"hide":90}).forEach((which,s)=>{
		/***/elKERNPreO[_="gfKey"+s] = {partID:"KERN000011",title:"k "+s,initial:[["which",which],["location",0]]};p.preBuild();
		p.shift("→");
		switch (s){default    :elKERNLinkA.push({from:"gfKey"+s,to:"gameframe0"     ,portA:[[["state"],["keyStateA",s]]]});
			break;case "pbr↓" :elKERNLinkA.push({from:"gfKey"+s,to:"gfPlaybackRate0",portA:[[["edgeLoSignal"],["decSignal"]]]});
			break;case "spd↓" :elKERNLinkA.push({from:"gfKey"+s,to:"gfScrollSpeed0" ,portA:[[["edgeLoSignal"],["decSignal"]]]});
			break;case "snap↓":elKERNLinkA.push({from:"gfKey"+s,to:"gfSnap0"        ,portA:[[["edgeLoSignal"],["decSignal"]]]});
			break;case "vol↓" :elKERNLinkA.push({from:"gfKey"+s,to:"gfVolume0"      ,portA:[[["edgeLoSignal"],["decSignal"]]]});
			break;case "hide" :elKERNLinkA.push({from:"gfKey"+s,to:"hidePanels0"    ,portA:[[["edgeHiSignal"],["edgeHiInSignal"]],[["edgeLoSignal"],["edgeLoInSignal"]]]});}});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// SHIELD C
	// -----------------------------------------------------------------------------------------------------------------
	elP = µ.qd(".shield¥C");
	p.shift("←←");
	p.shift("↑↑");
	var w = 240;
	var h =  30;
	elKERNDimO["gfIntroWaitTime0" ] = {w    ,h};
	elKERNDimO["gfSnap0"          ] = {w    ,h};
	elKERNDimO["gf0JudgeLineRaise"] = {w    ,h};
	elKERNDimO["gfSnapLineH0"     ] = {w    ,h};
	elKERNDimO["gfNoteW0"         ] = {w    ,h};
	elKERNDimO["gfNoteH0"         ] = {w    ,h};
	elKERNDimO["gfPreSepH0"       ] = {w    ,h};
	elKERNDimO["gfPostSepH0"      ] = {w    ,h};
	elKERNDimO["gfPxd0"           ] = {w    ,h};
	elKERNDimO["divCo0"           ] = {w    ,h};
	elKERNDimO["divW0"            ] = {w    ,h};
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	/***/elKERNPreO[_="gfPxd0"           ] = {partID:"KERN000005",title:"gf pxd"         ,initial:[["value",2],["dirAsc","E"],["min",0],["max",2],["snap",1],["valueFxn",v=>v+"x"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfIntroWaitTime0" ] = {partID:"KERN000005",title:"intro wait time",initial:[["value",1000000      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",5000000    ],["snap",100000      ],["ascMode","additive"],["valueFxn",v=>(v/1000000)+"sec"]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	
	/***/elKERNPreO[_="gfNoteW0"         ] = {partID:"KERN000005",title:"note width"     ,initial:[["value",     40      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",    100    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfNoteH0"         ] = {partID:"KERN000005",title:"note height"    ,initial:[["value",     16      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",     50    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfPreSepH0"       ] = {partID:"KERN000005",title:"pre-sep height" ,initial:[["value",      4      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",     20    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfPostSepH0"      ] = {partID:"KERN000005",title:"post-sep height",initial:[["value",      4      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",     20    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	
	/***/elKERNPreO[_="divW0"            ] = {partID:"KERN000005",title:"div width"      ,initial:[["value",1],["dirAsc","E"],["ascRoot",0],["min",0],["max",10],["snap",1],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="divCo0"           ] = {partID:"KERN000008",title:"div co"         ,initial:[["hValue",0],["sValue",0],["lValue",0.2],["aValue",1]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	
	/***/elKERNPreO[_="gf0JudgeLineRaise"] = {partID:"KERN000005",title:"jdgmnt line pos",initial:[["value",    100      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",   1000    ],["snap",    10      ],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfSnap0"          ] = {partID:"KERN000005",title:"snap"           ,initial:[["value",      0      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",     32    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"x"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfSnapLineH0"     ] = {partID:"KERN000005",title:"snap line thick",initial:[["value",      1      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",     20    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	
	elKERNLinkA.push({from:"gfIntroWaitTime0" ,to:"gameframe0",portA:[[["value"],["introWaitTime"]]]});
	elKERNLinkA.push({from:"gfSnap0"          ,to:"gameframe0",portA:[[["value"],["snapMultiplier"]]]});
	elKERNLinkA.push({from:"gf0JudgeLineRaise",to:"gameframe0",portA:[[["value"],["judgeLineRaise"]]]});
	elKERNLinkA.push({from:"gfSnapLineH0"     ,to:"gameframe0",portA:[[["value"],["snapH"]]]});
	elKERNLinkA.push({from:"gfNoteW0"         ,to:"gameframe0",portA:[[["value"],["noteW"]]]});
	elKERNLinkA.push({from:"gfNoteH0"         ,to:"gameframe0",portA:[[["value"],["noteH"]]]});
	elKERNLinkA.push({from:"gfPreSepH0"       ,to:"gameframe0",portA:[[["value"],["warningPreH"]]]});
	elKERNLinkA.push({from:"gfPostSepH0"      ,to:"gameframe0",portA:[[["value"],["warningPostH"]]]});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// SHIELD D
	// -----------------------------------------------------------------------------------------------------------------
	p.shift("←←");
	p.shift("↑↑");
	elP = µ.qd(".shield¥D");
	var h = 40;
	elKERNDimO["globalTx0"    ] = {w:150,h};
	elKERNDimO["globalCo0"    ] = {w:250,h};
	elKERNDimO["globalBg0"    ] = {w:150,h};
	elKERNDimO["prefLoad0"    ] = {w:300,h};
	elKERNDimO["prefSave0"    ] = {w:150,h};
	elKERNDimO["bgLoad0"      ] = {w:300,h};
	elKERNDimO["unlockPanels0"] = {w:150,h};
	elKERNDimO["lockPanels0"  ] = {w:150,h};
	var s = elKERNDimO["audioFile0"].h+elKERNDimO["chartFile0"].i+elKERNDimO["chartAudio0"].i;
	var h = 20;
	elKERNDimO["clock0" ] = {w:s ,h:s  };
	["hr","mn","sc"].forEach(v=>{elKERNDimO[v+"-handH0" ] = {w:20,h:s-h-p.handleH};});
	["hr","mn","sc"].forEach(v=>{elKERNDimO[v+"-handW0" ] = {w:50,h:h            };});
	["hr","mn","sc"].forEach(v=>{elKERNDimO[v+"-handCo0"] = {w:30,h:s-h-p.handleH};});
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	/***/elKERNPreO[_="globalTx0"   ] = {partID:"KERN000008",title:"overall text color"           ,initial:[["hValue",0    ],["sValue",0],["lValue",1  ],["aValue",1  ]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="globalCo0"   ] = {partID:"KERN000008",title:"overall detail color"         ,initial:[["hValue",0.116],["sValue",1],["lValue",0.5],["aValue",1  ]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="globalBg0"   ] = {partID:"KERN000008",title:"overall background color"     ,initial:[["hValue",0    ],["sValue",0],["lValue",0  ],["aValue",0.7]]};p.preBuild();
	p.shift("←←");
	p.shift("↓");
	/***/elKERNPreO[_="prefLoad0"   ] = {partID:"KERN000009",title:"preference file"              };p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="prefSave0"   ] = {partID:"KERN000016",title:"save/download preference file",initial:[["labelS","save/DL"],["fxnEdgeHi",function(){π.saveTextAsFile("FtB575_Preferences.txt",p.genSaveFile());}]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="bgLoad0"     ] = {partID:"KERN000009",title:"background image"             };p.preBuild();
	/***/elKERNPreO[  "prefLoadFxn0"] = {partID:"KERN000015",elP:N                                ,initial:[["fxn",function(){π.flTx(this.o.fil,txt=>{if (txt !== ""){p.loadSaveFile(txt);}});}]]};
	p.shift("←←");
	p.shift("↓");
	/***/elKERNPreO[_="lockPanels0"  ] = {partID:"KERN000016",title:"lock panels"               ,initial:[["labelS","lock panels"],["fxnEdgeHi",function(){panflo.aliveF = F;}]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="unlockPanels0"] = {partID:"KERN000016",title:"unlock panels"             ,initial:[["labelS","unlock panels"],["fxnEdgeHi",function(){panflo.aliveF = T;}]]};p.preBuild();
	p.shift("←←");
	p.shift("↓");
	/***/elKERNPreO[_="clock0"   ] = {partID:"KERN000007",title:"clock [24h]"      };p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="hr-handH0" ] = {partID:"KERN000005",title:"hr-hand ‰ length" ,initial:[["value", 500],["dirAsc","N"],["min",0],["max",1000],["snap",20],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="hr-handCo0"] = {partID:"KERN000008",title:"hr-hand co"       ,initial:[["orientation","vertical"],["hValue",0.2],["sValue",1],["lValue",0.4],["aValue",1]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="mn-handH0" ] = {partID:"KERN000005",title:"min-hand ‰ length",initial:[["value", 900],["dirAsc","N"],["min",0],["max",1000],["snap",20],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="mn-handCo0"] = {partID:"KERN000008",title:"min-hand co"      ,initial:[["orientation","vertical"],["hValue",0.1],["sValue",1],["lValue",0.4],["aValue",1]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="sc-handH0" ] = {partID:"KERN000005",title:"sec-hand ‰ length",initial:[["value",0],["dirAsc","N"],["min",0],["max",1000],["snap",20],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="sc-handCo0"] = {partID:"KERN000008",title:"sec-hand co"      ,initial:[["orientation","vertical"],["hValue",0  ],["sValue",1],["lValue",0.4],["aValue",1]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	_="clock0";p.shift("→");
	/***/elKERNPreO[_="hr-handW0" ] = {partID:"KERN000005",title:"hr-hand width"    ,initial:[["value",4],["dirAsc","E"],["min",0],["max",10],["snap",1],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="mn-handW0" ] = {partID:"KERN000005",title:"min-hand width"   ,initial:[["value",3],["dirAsc","E"],["min",0],["max",10],["snap",1],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="sc-handW0" ] = {partID:"KERN000005",title:"sec-hand width"   ,initial:[["value",2],["dirAsc","E"],["min",0],["max",10],["snap",1],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	
	// !!! [? - stale comment?] these currently must go last in order to push initially
	//,outboundAllF:T,outboundAllPortA:[[["coValue"],["tx"]]]
	elKERNLinkA.push({from:"globalTx0",to:T             ,portA:[[["coValue"],["tx"]]]});
	elKERNLinkA.push({from:"globalCo0",to:T             ,portA:[[["coValue"],["co"]]]});
	elKERNLinkA.push({from:"globalBg0",to:T             ,portA:[[["coValue"],["bg"]]]});
	elKERNLinkA.push({from:"prefLoad0",to:"prefLoadFxn0",portA:[[["fil"],["fil"]]]});
	elKERNLinkA.push({from:"bgLoad0"  ,to:"bgImg0"      ,portA:[[["fil"],["fil"]]]});
	elKERNLinkA.push({from:"gfPxd0"      ,to:"gameframe0" ,portA:[[["value"],["pxd"]]]});
	elKERNLinkA.push({from:"divCo0"      ,to:"gameframe0" ,portA:[[["coValueS"],["laneDividerCo"]]]});
	elKERNLinkA.push({from:"divW0"       ,to:"gameframe0" ,portA:[[["value"],["laneDividerW"]]]});
	
	elKERNLinkA.push({from:"hr-handCo0",to:"clock0",portA:[[["coValue"],["hHandCo"]]]});
	elKERNLinkA.push({from:"mn-handCo0",to:"clock0",portA:[[["coValue"],["mHandCo"]]]});
	elKERNLinkA.push({from:"sc-handCo0",to:"clock0",portA:[[["coValue"],["sHandCo"]]]});
	elKERNLinkA.push({from:"hr-handW0" ,to:"clock0",portA:[[["value"  ],["hHandW" ]]]});
	elKERNLinkA.push({from:"mn-handW0" ,to:"clock0",portA:[[["value"  ],["mHandW" ]]]});
	elKERNLinkA.push({from:"sc-handW0" ,to:"clock0",portA:[[["value"  ],["sHandW" ]]]});
	elKERNLinkA.push({from:"hr-handH0" ,to:"clock0",portA:[[["value"  ],["hHandH" ]]]});
	elKERNLinkA.push({from:"mn-handH0" ,to:"clock0",portA:[[["value"  ],["mHandH" ]]]});
	elKERNLinkA.push({from:"sc-handH0" ,to:"clock0",portA:[[["value"  ],["sHandH" ]]]});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// SHIELD E
	// -----------------------------------------------------------------------------------------------------------------
	elP = µ.qd(".shield¥E");
	p.shift("↑↑");
	p.shift("←←");
	
	// hannanos's mod
	var h = 30;
	elKERNDimO["bubbleHanna0"  ] = {w: 50,h};
	elKERNDimO["textHanna0"    ] = {w: 50,h};
	elKERNDimO["durationHanna0"] = {w:200,h};
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	
	/***/elKERNPreO[_="bubbleHanna0"  ] = {partID:"KERN000005",title:"bubble?hanna",initial:[["value",0],["dirAsc","N"],["ascRoot",0],["min",0],["max",1],["snap",1],["ascMode","additive"],["valueFxn",v=>v===1?"on":"off"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="textHanna0"    ] = {partID:"KERN000005",title:"text?hanna"  ,initial:[["value",0],["dirAsc","N"],["ascRoot",0],["min",0],["max",1],["snap",1],["ascMode","additive"],["valueFxn",v=>v===1?"on":"off"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="durationHanna0"] = {partID:"KERN000005",title:"time-hanna"  ,initial:[["value",1000000],["dirAsc","E"],["ascRoot",0],["min",0],["max",3000000],["snap",100000],["ascMode","additive"],["valueFxn",v=>Math.floor(v/1000)+"ms"]]};p.preBuild();
	p.shift("→");
	
	elKERNLinkA.push({from:"bubbleHanna0"  ,to:"gameframe0",portA:[[["value"],["modO_hannanos_ver1","bubbleF"  ]]]});
	elKERNLinkA.push({from:"textHanna0"    ,to:"gameframe0",portA:[[["value"],["modO_hannanos_ver1","textF"    ]]]});
	elKERNLinkA.push({from:"durationHanna0",to:"gameframe0",portA:[[["value"],["modO_hannanos_ver1","durationT"]]]});
	
	
	// Decon's mod
	p.shift("↓");
	t += 30;
	p.shift("←←");
	var h = 120;
	elKERNDimO["1‰Deco0" ] = {w: 30,h};
	elKERNDimO["2‰Deco0" ] = {w: 30,h};
	elKERNDimO["3‰Deco0" ] = {w: 30,h};
	elKERNDimO["4‰Deco0" ] = {w: 30,h};
	elKERNDimO["5‰Deco0" ] = {w: 30,h};
	elKERNDimO["6‰Deco0" ] = {w: 30,h};
	elKERNDimO["2coDeco0"] = {w: 40,h};
	elKERNDimO["3coDeco0"] = {w: 40,h};
	elKERNDimO["4coDeco0"] = {w: 40,h};
	elKERNDimO["5coDeco0"] = {w: 40,h};
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	
	/***/elKERNPreO[_="1‰Deco0" ] = {partID:"KERN000005",title:"1‰Deco" ,initial:[["value",   0],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="2‰Deco0" ] = {partID:"KERN000005",title:"2‰Deco" ,initial:[["value", 200],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="3‰Deco0" ] = {partID:"KERN000005",title:"3‰Deco" ,initial:[["value", 400],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="2coDeco0"] = {partID:"KERN000008",title:"2coDeco",initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="3coDeco0"] = {partID:"KERN000008",title:"3coDeco",initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	/***/elKERNPreO[_="4‰Deco0" ] = {partID:"KERN000005",title:"4‰Deco" ,initial:[["value",1000],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="5‰Deco0" ] = {partID:"KERN000005",title:"5‰Deco" ,initial:[["value", 800],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="6‰Deco0" ] = {partID:"KERN000005",title:"6‰Deco" ,initial:[["value", 600],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="4coDeco0"] = {partID:"KERN000008",title:"4coDeco",initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="5coDeco0"] = {partID:"KERN000008",title:"5coDeco",initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]};p.preBuild();
	
	elKERNLinkA.push({from:"1‰Deco0" ,to:"gameframe0",portA:[[["value"],["modO_Decon082_ver1","overlayA",0,"p1"]]]});
	elKERNLinkA.push({from:"2‰Deco0" ,to:"gameframe0",portA:[[["value"],["modO_Decon082_ver1","overlayA",0,"p2"]],[["value"],["modO_Decon082_ver1","overlayA",1,"p1"]]]});
	elKERNLinkA.push({from:"3‰Deco0" ,to:"gameframe0",portA:[                                                     [["value"],["modO_Decon082_ver1","overlayA",1,"p2"]]]});
	elKERNLinkA.push({from:"2coDeco0",to:"gameframe0",portA:[[["coValueS"],["modO_Decon082_ver1","overlayA",0,"co1"]],[["coValueS"],["modO_Decon082_ver1","overlayA",0,"co2"]],[["coValueS"],["modO_Decon082_ver1","overlayA",1,"co1"]]]});
	elKERNLinkA.push({from:"3coDeco0",to:"gameframe0",portA:[                                                                                                                  [["coValueS"],["modO_Decon082_ver1","overlayA",1,"co2"]]]});
	elKERNLinkA.push({from:"4‰Deco0" ,to:"gameframe0",portA:[[["value"],["modO_Decon082_ver1","overlayA",2,"p1"]]]});
	elKERNLinkA.push({from:"5‰Deco0" ,to:"gameframe0",portA:[[["value"],["modO_Decon082_ver1","overlayA",2,"p2"]],[["value"],["modO_Decon082_ver1","overlayA",3,"p1"]]]});
	elKERNLinkA.push({from:"6‰Deco0" ,to:"gameframe0",portA:[                                                     [["value"],["modO_Decon082_ver1","overlayA",3,"p2"]]]});
	elKERNLinkA.push({from:"4coDeco0",to:"gameframe0",portA:[[["coValueS"],["modO_Decon082_ver1","overlayA",2,"co1"]],[["coValueS"],["modO_Decon082_ver1","overlayA",2,"co2"]],[["coValueS"],["modO_Decon082_ver1","overlayA",3,"co1"]]]});
	elKERNLinkA.push({from:"5coDeco0",to:"gameframe0",portA:[                                                                                                                  [["coValueS"],["modO_Decon082_ver1","overlayA",3,"co2"]]]});
	
	// nejuer's mod
	p.shift("↓");
	t += 30;
	p.shift("←←");
	var h = 30;
	elKERNDimO["modeNej0" ] = {w:100,h};
	elKERNDimO["hueNej0"  ] = {w:200,h};
	elKERNDimO["tLoopNej0"] = {w:300,h};
	elKERNDimO["yLoopNej0"] = {w:300,h};
	elKERNDimO["warningNej0"] = {w:600,h:100};
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	
	/***/elKERNPreO[_="modeNej0" ] = {partID:"KERN000005",title:"modeNej" ,initial:[["value",0],["dirAsc","E"],["ascRoot",0],["min",0],["max",2],["snap",1],["ascMode","additive"],["valueFxn",v=>v===2?("physical"):(v===1?"temporal":"off")]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="hueNej0"  ] = {partID:"KERN000008",title:"hueNej"  ,initial:[["hValue",0],["sValue",1],["lValue",0.5],["aValue",1]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	/***/elKERNPreO[_="tLoopNej0"] = {partID:"KERN000005",title:"tLoopNej",initial:[["value",3000000],["dirAsc","E"],["ascRoot",0],["min",0],["max",20000000],["snap",250000],["ascMode","additive"],["valueFxn",v=>(v/1000000)+"s"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="yLoopNej0"] = {partID:"KERN000005",title:"yLoopNej",initial:[["value",8000],["dirAsc","E"],["ascRoot",0],["min",0],["max",15000],["snap",1000],["ascMode","additive"],["valueFxn",v=>v+"‰"]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	/***/elKERNPreO[_="warningNej0"] = {partID:"KERN000013",title:"warningNej" ,initial:[["lineWrap",T],["txt","Health Warning\nUsing small values for tLoop or yLoop may cause notes to change color rapidly, which may cause discomfort, or, in susceptible individuals, a negative health reaction. Either (1) don't use this mod or (2) use the largest possible values and slowly lower them as you still feel comfortable."]]};p.preBuild();
	
	elKERNLinkA.push({from:"modeNej0" ,to:"gameframe0",portA:[[["value" ],["modO_nejuer_ver1","mode"   ]]]});
	elKERNLinkA.push({from:"hueNej0"  ,to:"gameframe0",portA:[[["hValue"],["modO_nejuer_ver1","hueRoot"]]]});
	elKERNLinkA.push({from:"tLoopNej0",to:"gameframe0",portA:[[["value" ],["modO_nejuer_ver1","tLoop"  ]]]});
	elKERNLinkA.push({from:"yLoopNej0",to:"gameframe0",portA:[[["value" ],["modO_nejuer_ver1","yLoop"  ]]]});
	
	// sliceofcake's mod
	p.shift("↑↑");
	p.shift("←←");
	l += 350;
	var h = 30;
	elKERNDimO["opacitySlice0"] = {w:200,h};
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	/***/elKERNPreO[_="opacitySlice0"] = {partID:"KERN000005",title:"opacitySlice",initial:[["value",1],["dirAsc","E"],["ascRoot",0],["min",0],["max",1],["snap",0.1],["ascMode","additive"],["valueFxn",v=>(v*1000)+"‰"]]};p.preBuild();
	elKERNLinkA.push({from:"opacitySlice0" ,to:"gameframe0",portA:[[["value"],["modO_sliceofcake_ver1","op"]]]});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// SHIELD F
	// -----------------------------------------------------------------------------------------------------------------
	elP = µ.qd(".shield¥F");
	p.shift("↑↑");
	p.shift("←←");
	elKERNDimO["gfFtB4TransTrig0"     ] = {w:100,h: 30};
	elKERNDimO["gfFtB4TransFontSize0" ] = {w:100,h: 30};
	elKERNDimO["gfFtB4TransTarget0"   ] = {w:200,h:200};
	elKERNDimO["gfo!m14TransTrig0"    ] = {w:100,h: 30};
	elKERNDimO["gfo!m14TransFontSize0"] = {w:100,h: 30};
	elKERNDimO["gfo!m14TransTarget0"  ] = {w:200,h:200};
	elKERNDimO.forEach(elKERNDim=>{elKERNDim.i = elKERNDim.h + p.handleH;});
	
	/***/elKERNPreO[_="gfFtB4TransTrig0"     ] = {partID:"KERN000016",title:"→FtB4"       ,initial:[["labelS","translate"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfFtB4TransFontSize0" ] = {partID:"KERN000005",title:"font size"   ,initial:[["value",10],["dirAsc","E"],["ascRoot",0],["min",0],["max",16],["snap",0.5],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfo!m14TransTrig0"    ] = {partID:"KERN000016",title:"→o!m14"      ,initial:[["labelS","translate"]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfo!m14TransFontSize0"] = {partID:"KERN000005",title:"font size"   ,initial:[["value",10],["dirAsc","E"],["ascRoot",0],["min",0],["max",16],["snap",0.5],["ascMode","additive"],["valueFxn",v=>v+"px"]]};p.preBuild();
	p.shift("↓");
	p.shift("←←");
	/***/elKERNPreO[_="gfFtB4TransTarget0"   ] = {partID:"KERN000013",title:"FtB4 trans." ,initial:[["lineWrap",F],["txt",""]]};p.preBuild();
	p.shift("→");
	/***/elKERNPreO[_="gfo!m14TransTarget0"  ] = {partID:"KERN000013",title:"o!m14 trans.",initial:[["lineWrap",F],["txt",""]]};p.preBuild();
	
	elKERNLinkA.push({from:"gfFtB4TransTrig0"     ,to:"gameframe0"         ,portA:[[["edgeHiOutSignal"],["translateSignalO","FtB4"]]]});
	elKERNLinkA.push({from:"gfFtB4TransFontSize0" ,to:"gfFtB4TransTarget0" ,portA:[[["value"],["fs"]]]});
	elKERNLinkA.push({from:"gfo!m14TransTrig0"    ,to:"gameframe0"         ,portA:[[["edgeHiOutSignal"],["translateSignalO","o!m14"]]]});
	elKERNLinkA.push({from:"gfo!m14TransFontSize0",to:"gfo!m14TransTarget0",portA:[[["value"],["fs"]]]});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//	/***/elKERNPreO[_=""] = {};p.preBuild();
//	elKERNLinkA.push({from:"",to:"",portA:[]});
	//elKERNPreO.forEach(v=>{/*ll(v.style);*/ZACH.new(v);});return; // -------------------------------------------
	// build everything
	var globalSenderWaitA = [];
	elKERNLinkA.forEach(v=>{if (v.to === T){globalSenderWaitA.push(v.from);}});
	elKERNPreO.forEach((v,i)=>{
		if (globalSenderWaitA.indexOf(i) === -1){
			elKERNPostO[i] = ZACH.new(v);elKERNPostO[i].ID = i;}});
	elKERNLinkA.forEach(v=>{
		if (v.to === T){
			//ll(v.from,π.cc(elKERNPreO[v.from]),π.cc(elKERNPreO));
			elKERNPostO[v.from] = ZACH.new(π.ooas(elKERNPreO[v.from],{outboundAllF:T,outboundAllPortA:v.portA}));elKERNPostO[v.from].ID = v.from;}
		else{
			elKERNPostO[v.from].registerAssert({rcvRoot:elKERNPostO[v.to],portA:v.portA});}});
	
	
	
	
	
	
	
	
	
	µ.qdA(".shield:not(¥A)").forEach(el=>{el.style.display = "none";});
	var endGlobalT = π.now();
	lld("page initialization time : "+Math.ceil((endGlobalT-startGlobalT)/1000)+"ms");
});
</script>
<body></body></html>
