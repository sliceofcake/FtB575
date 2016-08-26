<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta name="description" content="Feel the Beats - Rhythm Game"><meta name="keywords" content="FtB,Rhythm,Game,XceeD"><meta name="author" content="XceeD Illuminati"><meta name="creator" content="XceeD Illuminati"><meta name="publisher" content="XceeD Illuminati"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /edit/</title><link href="../image/favicon.png" rel="icon" type="image/png">
<script>
<?
require_once("../shelf/butler.js");
require_once("../shelf/specific.js"); ?>
</script>
<?
require_once("../shelf/KERN/KERN.php");
require_once("../shelf/KERN/ZACH.php");
require_once("../shelf/KERN/KERN000005.php");
require_once("../shelf/KERN/KERN000006.php");
require_once("../shelf/KERN/KERN000007.php");
require_once("../shelf/KERN/KERN000008.php");
require_once("../shelf/KERN/KERN000009.php");
require_once("../shelf/KERN/KERN000010.php");
require_once("../shelf/KERN/KERN000011.php");
require_once("../shelf/KERN/KERN000012.php");
require_once("../shelf/KERN/KERN000013.php");
require_once("../shelf/KERN/KERN000014.php"); ?>
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
			".layer"                 : "¥:block;¥:absolute;¥t:200px;¥l:100px;¥w:auto;¥h:auto;¥wmin:"+20+"px;¥hmin:"+20+"px;¥c:"+hsla(tx)+";¥bsw:var(--bsw-layer);overflow:hidden;¥z:1;",
			".layer>.handle"         : "¥w:1000‰;¥h:"+handleH+"px;¥fs:"+(handleH*0.8)+"px;¥c:var(--c-layer-handle);¥bgc:var(--bgc-layer-handle);¥tsw:var(--tsw-layer-handle);cursor:move;¥pl:2px;¥:one-row;",
			".layer>.handle>.faded"  : "¥pl:"+6+"px;¥op:0.35;",
			".layer>:not(.handle)"   : "¥w:1000‰;¥h:calc(1000‰ - "+handleH+"px);¥c:var(--c);¥bgc:var(--bgc-layer-not-handle);",
			
			// bg number should correspond to negative z-index
			"body>¥bg1"              : "¥:absolute;¥:NW;¥s:1000‰;¥z:-1;",
			"body>¥innerBody"        : "¥:absolute;¥:NW;¥s:1000‰;¥z:0;",
			
			"body>¥toolbar"          : "¥:absolute;¥:SW;¥w:1000‰;¥z:1;",
			"body>¥toolbar>*"        : "¥:block;¥f:right;",
			"body>¥toolbar>¥lock"    : "¥w:"+rrn(120)+"px;",
			"body>¥toolbar>¥unlock"  : "¥w:"+rrn(120)+"px;",
			"body>¥toolbar>¥showGf"  : "¥w:"+rrn(180)+"px;",
			"body>¥toolbar>¥showAll" : "¥w:"+rrn(180)+"px;",
			"body>¥toolbar>¥tx,\
			 body>¥toolbar>¥co,\
			 body>¥toolbar>¥bg"      : "¥:block;¥w:"+rrn(150)+"px;¥h:"+rrn(30)+"px;",
			"body>¥toolbar>¥bgi"     : "¥:block;¥w:"+rrn(300)+"px;¥h:"+rrn(30)+"px;",
			
			});}
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":dataUnique},css:css}));};
// !!! sigh this is going to be difficult
p.genSaveFile = function(){return;
	var partHead = document.head.forEach();
	var partBody = document.body.forEach();
	var partKERN = KERNA.map(root=>({
		name     : root.name,
		counter  : root.counter,
		oPartial : π.cc(root.portInSP.mapO(portS=>({[portS]:root.o[portS]}))),
	}));
	return π.jsonE({partHead,partBody,partKERN});};
p.loadSaveFile = function(s){return;
	KERNA.forEach(root=>{root.destroy();});
	KERNA.length = 0;
	var res = π.jsonD(s);
	res.forEach(v=>{});};
//----
var elKERNO = {};
document.addEventListener("DOMContentLoaded",()=>{
	var startGlobalT = π.now();
	panflo.aliveF = F;
	µ.rr(document.body,µ.m([[
		["¥bg1"],
		["¥innerBody"],
		["¥toolbar",[
			["¥tx"],
			["¥co"],
			["¥bg"],
			["¥bgi"],
			µ.bscss("lock panels",[".button",{click:function(){panflo.aliveF = F;}}],"¥lock"),
			µ.bscss("unlock panels",[".button",{click:function(){panflo.aliveF = T;}}],"¥unlock"),
			µ.bscss("show all panels",[".button",{click:function(){µ.qdA(".layer").forEach(el=>{el.style.visibility = "visible";});}}],"¥showGf"),
			// ! chances are, this line will get out of date after moving elements around
			// intention : show gf, score, seeker, audio player
			µ.bscss("hide unimportants\n[performance↑↑]",[".button",{click:function(){µ.qdA(".layer:not(¥KERN_1):not(¥KERN_2):not(¥KERN_5):not(¥KERN_8)").forEach(el=>{el.style.visibility = "hidden";});}}],"¥showAll"),
		]],
	]]));
	
	var h = p.handleH;
	var elP = µ.qd("¥innerBody");
	var mode = "layer";
	var t = 0; // top, because the interface is row-based
	var t_FREEZE = 0; // memory variable for top before entering a multi-row for loop
	
	
	
	
	var gf_W = 300;var gf_H = 550;var gf_I = gf_H+h;
	var scrW = 300;var scrH =  50;var scrI = scrH+h;
	var filW = 400;var filH =  30;var filI = filH+h;
	var audW = 260;var audH =  30;var audI = audH+h;
	var leeW =  70;var leeH =  30;var leeI = leeH+h;
	var pxdW =  70;var pxdH =  30;var pxdI = pxdH+h;
	var gskW = 260;var gskH =  20;var gskI = gskH+h;
	var co_W = 140;var co_H =  20;var co_I = co_H+h;
	var sliW =  80;var sliH =  20;var sliI = sliH+h;
	t = 0;
	elKERNO.b_gf1        = ZACH.new({mode,partID:"KERN000006",elP,title:"gameframe"   ,style:{w:gf_W,h:gf_H,t     ,l:             0,z:1}});
	elKERNO.b_score1     = ZACH.new({mode,partID:"KERN000014",elP,title:"score"       ,style:{w:scrW,h:scrH,t:gf_I,l:             0,z:1}});
	elKERNO.b_fileIn1    = ZACH.new({mode,partID:"KERN000009",elP,title:"audio file"  ,style:{w:filW,h:filH,t     ,l:gf_W          ,z:1}});
	t += filI;
	elKERNO.b_fileIn2    = ZACH.new({mode,partID:"KERN000009",elP,title:"chart file"  ,style:{w:filW,h:filH,t,l:gf_W          ,z:1}});
	t += filI;
	elKERNO.b_audio1     = ZACH.new({mode,partID:"KERN000010",elP,title:"chart audio" ,style:{w:audW,h:audH,t,l:gf_W          ,z:1}});
	elKERNO.b_slider13   = ZACH.new({mode,partID:"KERN000005",elP,title:"audio leeway",style:{w:leeW,h:leeH,t,l:gf_W+audW     ,z:1},initial:[["value",100000],["dirAsc","E"],["min",0],["max",300000],["snap",10000],["valueFxn",v=>(v/1000)+"ms"]]});
	elKERNO.b_slider13_1 = ZACH.new({mode,partID:"KERN000005",elP,title:"gf pxd"      ,style:{w:pxdW,h:pxdH,t,l:gf_W+audW+leeW,z:1},initial:[["value",2],["dirAsc","E"],["min",0],["max",2],["snap",1],["valueFxn",v=>v+"x"]]});
	t += audI;
	elKERNO.b_slider13_2 = ZACH.new({mode,partID:"KERN000005",elP,title:"gf seek"     ,style:{w:gskW,h:gskH,t,l:gf_W          ,z:1},initial:[["value",0],["dirAsc","E"],["ascRoot",0],["min",0],["max",1],["snap",0.000001],["ascMode","additive"],["valueFxn",v=>Math.floor(v*1000)+"‰"]]});
	elKERNO.b_color11    = ZACH.new({mode,partID:"KERN000008",elP,title:"div co"      ,style:{w:co_W,h:co_H,t,l:gf_W+gskW     ,z:1},initial:[["hValue",0],["sValue",0],["lValue",0.2],["aValue",1]]});
	elKERNO.b_slider13_3 = ZACH.new({mode,partID:"KERN000005",elP,title:"div width"   ,style:{w:sliW,h:sliH,t,l:gf_W+gskW+co_W,z:1},initial:[["value",1],["dirAsc","E"],["ascRoot",0],["min",0],["max",10],["snap",1],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	//----
	elKERNO.b_fileIn1   .registerAssert({rcvRoot:elKERNO.b_audio1,portA:[[["fil"],["fil"]]]});
	elKERNO.b_fileIn2   .registerAssert({rcvRoot:elKERNO.b_gf1   ,portA:[[["fil"],["chartR"]]]});
	elKERNO.b_gf1       .registerAssert({rcvRoot:elKERNO.b_score1,portA:[[["noteInstantStatA"],["noteInstantStatA"]],[["hitC"],["hitC"]],[["holdC"],["holdC"]],[["passedHeadC"],["passedHeadC"]],[["passedTailC"],["passedTailC"]],[["scoreResetSignal"],["scoreResetSignal"]],[["earnedHeadC"],["earnedHeadC"]],[["earnedTailC"],["earnedTailC"]]]});
	elKERNO.b_gf1       .registerAssert({rcvRoot:elKERNO.b_audio1,portA:[[["state"],["state"]],[["chartP"],["t"]],[["playbackRate"],["playbackRate"]],[["volume"],["volume"]]]});
	elKERNO.b_slider13  .registerAssert({rcvRoot:elKERNO.b_audio1,portA:[[["value"],["leeway"]]]});
	elKERNO.b_slider13_1.registerAssert({rcvRoot:elKERNO.b_gf1   ,portA:[[["value"],["pxd"]]]});
	elKERNO.b_slider13_2.registerAssert({rcvRoot:elKERNO.b_gf1   ,portA:[[["value"],["tTentative"]],[["valueValidSignal"],["tTentativeSignal"]]]});
	elKERNO.b_color11   .registerAssert({rcvRoot:elKERNO.b_gf1   ,portA:[[["coValueS"],["laneDividerCo"]]]});
	elKERNO.b_slider13_3.registerAssert({rcvRoot:elKERNO.b_gf1   ,portA:[[["value"],["laneDividerW"]]]});
	
	
	
	
	var kcoW =  20;var kcoH =  80;var kcoI = kcoH+h;
	var ky1W = 100;var ky1H =  40;var ky1I = ky1H+h;
	var ky2W =  50;var ky2H =  40;var ky2I = ky2H+h;
	var s1_W = 140;var s1_H =  20;var s1_I = s1_H+h;
	var s2_W = 280;var s2_H =  20;var s2_I = s2_H+h;
	var co_W = 140;var co_H =  20;var co_I = co_H+h;
	var pink      = rgbToHsl([255,  0,170].map(v=>v/255));
	var orange    = rgbToHsl([255,170,  0].map(v=>v/255));
	var purple    = rgbToHsl([170,  0,255].map(v=>v/255));
	var green     = rgbToHsl([170,255,  0].map(v=>v/255));
	var blue      = rgbToHsl([  0,170,255].map(v=>v/255));
	var turquoise = rgbToHsl([  0,255,170].map(v=>v/255));
	var coA = [null,pink,orange,green,blue,green,orange,pink,purple,purple,purple];
	t_FREEZE = t;
	for (var l = 1; l <= 10; l++){
		t = t_FREEZE;
		t += gskI;
		elKERNO["b_color"+l+"_1"] = ZACH.new({mode,partID:"KERN000008",elP,title:"n↓ k"+l+" co1",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(0+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0.1 ],["aValue",1],["orientation","vertical"]]}); // noteFadedCo
		elKERNO["b_color"+l+"_2"] = ZACH.new({mode,partID:"KERN000008",elP,title:"n- k"+l+" co2",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(1+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0.5 ],["aValue",1],["orientation","vertical"]]}); // noteCo
		elKERNO["b_color"+l+"_3"] = ZACH.new({mode,partID:"KERN000008",elP,title:"n↑ k"+l+" co3",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(2+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0.9 ],["aValue",1],["orientation","vertical"]]}); // noteActiveCo
		elKERNO["b_color"+l+"_4"] = ZACH.new({mode,partID:"KERN000008",elP,title:"l< k"+l+" co4",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(3+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0   ],["aValue",1],["orientation","vertical"]]}); // laneWarningPreCo
		elKERNO["b_color"+l+"_5"] = ZACH.new({mode,partID:"KERN000008",elP,title:"l> k"+l+" co5",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(4+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0   ],["aValue",1],["orientation","vertical"]]}); // laneWarningPostCo
		t += kcoI;
		elKERNO["b_color"+l+"_6"] = ZACH.new({mode,partID:"KERN000008",elP,title:"l- k"+l+" co6",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(0+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0   ],["aValue",1],["orientation","vertical"]]}); // laneCo
		elKERNO["b_color"+l+"_7"] = ZACH.new({mode,partID:"KERN000008",elP,title:"l↑ k"+l+" co7",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(1+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0.1 ],["aValue",1],["orientation","vertical"]]}); // laneActiveCo
		elKERNO["b_color"+l+"_8"] = ZACH.new({mode,partID:"KERN000008",elP,title:"h- k"+l+" co8",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(2+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0.5 ],["aValue",1],["orientation","vertical"]]}); // hitboxCo
		elKERNO["b_color"+l+"_9"] = ZACH.new({mode,partID:"KERN000008",elP,title:"h↑ k"+l+" co9",style:{w:kcoW,h:kcoH,t,l:gf_W+(kcoW)*(3+(l-1)*5),z:1},initial:[["hValue",coA[l][0]],["sValue",1],["lValue",0.75],["aValue",1],["orientation","vertical"]]});} // hitboxActiveCo
	
	// key bindings
	t += kcoI;
	({1:65,2:83,3:68,4:70,5:71,6:72,7:74,8:75,9:76,10:186}).forEach((which,l)=>{
		elKERNO["b_key"+l] = ZACH.new({mode,partID:"KERN000011",elP,title:"k lane"+l,style:{w:ky1W,h:ky1H,t,l:gf_W+(ky1W)*(l-1),z:1},initial:[["which",which],["location",0]]});
		elKERNO["b_key"+l].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["state"],["keyStateA",l]]]});});
	t += ky1I;
	var i = 0;
	({"reset":48,"hi":81,"hop↑":38,"jump↑":39,"pbr↑":0,"spd↑":0,"snap↑":36,"vol↑":33}).forEach((which,l)=>{
		elKERNO["b_key"+l] = ZACH.new({mode,partID:"KERN000011",elP,title:"k "+l,style:{w:ky2W,h:ky2H,t,l:gf_W+(ky2W)*(i  ),z:1},initial:[["which",which],["location",0]]});
		if (!["pbr↑","spd↑","snap↑","vol↑"].includes(l)){elKERNO["b_key"+l].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["state"],["keyStateA",l]]]});}
		i++;});
	
	// Decon's mod
	var dpaW =  20;var dpaH = ky1H*2+h;var dpaI = dpaH+h;
	var dcoW =  40;var dcoH = ky1H*2+h;var dcoI = dcoH+h;
	elKERNO.b_slider21 = ZACH.new({mode,partID:"KERN000005",elP,title:"1‰Deco" ,style:{w:dpaW,h:dpaH,t,l:gf_W+(s1_W*5)                    ,z:1},initial:[["value",   0],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]});
	elKERNO.b_slider22 = ZACH.new({mode,partID:"KERN000005",elP,title:"2‰Deco" ,style:{w:dpaW,h:dpaH,t,l:gf_W+(s1_W*5)+dpaW               ,z:1},initial:[["value", 200],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]});
	elKERNO.b_slider23 = ZACH.new({mode,partID:"KERN000005",elP,title:"3‰Deco" ,style:{w:dpaW,h:dpaH,t,l:gf_W+(s1_W*5)+dpaW+dpaW          ,z:1},initial:[["value", 400],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]});
	elKERNO.b_color22  = ZACH.new({mode,partID:"KERN000008",elP,title:"2coDeco",style:{w:dcoW,h:dcoH,t,l:gf_W+(s1_W*5)+dpaW+dpaW+dpaW     ,z:1},initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]});
	elKERNO.b_color23  = ZACH.new({mode,partID:"KERN000008",elP,title:"3coDeco",style:{w:dcoW,h:dcoH,t,l:gf_W+(s1_W*5)+dpaW+dpaW+dpaW+dcoW,z:1},initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]});
	
	elKERNO.b_slider24 = ZACH.new({mode,partID:"KERN000005",elP,title:"4‰Deco" ,style:{w:dpaW,h:dpaH,t:t+dcoI,l:gf_W+(s1_W*5)                    ,z:1},initial:[["value",1000],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]});
	elKERNO.b_slider25 = ZACH.new({mode,partID:"KERN000005",elP,title:"5‰Deco" ,style:{w:dpaW,h:dpaH,t:t+dcoI,l:gf_W+(s1_W*5)+dpaW               ,z:1},initial:[["value", 800],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]});
	elKERNO.b_slider26 = ZACH.new({mode,partID:"KERN000005",elP,title:"6‰Deco" ,style:{w:dpaW,h:dpaH,t:t+dcoI,l:gf_W+(s1_W*5)+dpaW+dpaW          ,z:1},initial:[["value", 600],["dirAsc","S"],["ascRoot",0],["min",0],["max",1000],["snap",10],["ascMode","additive"],["valueFxn",v=>v+"‰"]]});
	elKERNO.b_color24  = ZACH.new({mode,partID:"KERN000008",elP,title:"4coDeco",style:{w:dcoW,h:dcoH,t:t+dcoI,l:gf_W+(s1_W*5)+dpaW+dpaW+dpaW     ,z:1},initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]});
	elKERNO.b_color25  = ZACH.new({mode,partID:"KERN000008",elP,title:"5coDeco",style:{w:dcoW,h:dcoH,t:t+dcoI,l:gf_W+(s1_W*5)+dpaW+dpaW+dpaW+dcoW,z:1},initial:[["orientation","vertical"],["hValue",0],["sValue",0],["lValue",0],["aValue",0]]});
	
	t += ky2I;
	var i = 0;
	({"N/A":0,"lo":87,"hop↓":40,"jump↓":37,"pbr↓":0,"spd↓":0,"snap↓":35,"vol↓":34}).forEach((which,l)=>{
		elKERNO["b_key"+l] = ZACH.new({mode,partID:"KERN000011",elP,title:"k "+l,style:{w:ky2W,h:ky2H,t,l:gf_W+(ky2W)*(i  ),z:1},initial:[["which",which],["location",0]]});
		if (!["pbr↓","spd↓","snap↓","vol↓"].includes(l)){elKERNO["b_key"+l].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["state"],["keyStateA",l]]]});}
		i++;});
	
	// sliders
	t += ky2I;
	elKERNO.b_slider1  = ZACH.new({mode,partID:"KERN000005",elP,title:"intro wait time",style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*0),z:1},initial:[["value",1000000      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",5000000    ],["snap",100000      ],["ascMode","additive"],["valueFxn",v=>(v/1000000)+"sec"]]});
	elKERNO.b_slider2  = ZACH.new({mode,partID:"KERN000005",elP,title:"playback rate"  ,style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*1),z:1},initial:[["value",      1      ],["dirAsc","E"],["ascRoot",1],["min",      0.1  ],["max",      2    ],["snap",     0.1    ],["ascMode","additive"],["valueFxn",v=>v+"x"]]});
	elKERNO.b_slider3  = ZACH.new({mode,partID:"KERN000005",elP,title:"volume"         ,style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*2),z:1},initial:[["value",      0.8    ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",      1    ],["snap",     0.05   ],["ascMode","additive"],["valueFxn",v=>v+"?"]]});
	elKERNO.b_slider4  = ZACH.new({mode,partID:"KERN000005",elP,title:"snap"           ,style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*3),z:1},initial:[["value",      4      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",     32    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"x"]]});
	elKERNO.b_slider5  = ZACH.new({mode,partID:"KERN000005",elP,title:"jdgmnt line pos",style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*4),z:1},initial:[["value",      0      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",   1000    ],["snap",    10      ],["ascMode","additive"],["valueFxn",v=>v+"‰"]]});
	t += s1_I;
	elKERNO.b_slider6  = ZACH.new({mode,partID:"KERN000005",elP,title:"snap line thick",style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*0),z:1},initial:[["value",      1      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",    100    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	elKERNO.b_slider7  = ZACH.new({mode,partID:"KERN000005",elP,title:"note width"     ,style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*1),z:1},initial:[["value",     40      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",    100    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	elKERNO.b_slider8  = ZACH.new({mode,partID:"KERN000005",elP,title:"note height"    ,style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*2),z:1},initial:[["value",     16      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",    100    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	elKERNO.b_slider9  = ZACH.new({mode,partID:"KERN000005",elP,title:"pre-sep height" ,style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*3),z:1},initial:[["value",      4      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",    100    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	elKERNO.b_slider10 = ZACH.new({mode,partID:"KERN000005",elP,title:"post-sep height",style:{w:s1_W,h:s1_H,t,l:gf_W+(s1_W*4),z:1},initial:[["value",      4      ],["dirAsc","E"],["ascRoot",0],["min",      0    ],["max",    100    ],["snap",     1      ],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	t += s1_I;
	elKERNO.b_slider11 = ZACH.new({mode,partID:"KERN000005",elP,title:"note delay"     ,style:{w:s2_W,h:s2_H,t,l:gf_W+(s2_W*0),z:1},initial:[["value",      0      ],["dirAsc","E"],["ascRoot",0],["min",-500000    ],["max", 500000    ],["snap",  1000      ],["ascMode","additive"],["valueFxn",v=>(v/1000)+"ms"]]});
	elKERNO.b_slider12 = ZACH.new({mode,partID:"KERN000005",elP,title:"scroll speed"   ,style:{w:s2_W,h:s2_H,t,l:gf_W+(s2_W*1),z:1},initial:[["value",      0.00055],["dirAsc","E"],["ascRoot",0],["min",     -0.002],["max",      0.002],["snap",     0.00005],["ascMode","additive"],["valueFxn",(v,c)=>(c===0?(v*1000):(v*1000).toPrecision(c))+"x"]]});
	
	// backpedal because now we actually have the sliders made
	elKERNO["b_key"+"pbr↑" ].registerAssert({rcvRoot:elKERNO.b_slider2 ,portA:[[["edgeHiSignal"],["incSignal"]]]});
	elKERNO["b_key"+"spd↑" ].registerAssert({rcvRoot:elKERNO.b_slider12,portA:[[["edgeHiSignal"],["incSignal"]]]});
	elKERNO["b_key"+"snap↑"].registerAssert({rcvRoot:elKERNO.b_slider4 ,portA:[[["edgeHiSignal"],["incSignal"]]]});
	elKERNO["b_key"+"vol↑" ].registerAssert({rcvRoot:elKERNO.b_slider3 ,portA:[[["edgeHiSignal"],["incSignal"]]]});
	elKERNO["b_key"+"pbr↓" ].registerAssert({rcvRoot:elKERNO.b_slider2 ,portA:[[["edgeHiSignal"],["decSignal"]]]});
	elKERNO["b_key"+"spd↓" ].registerAssert({rcvRoot:elKERNO.b_slider12,portA:[[["edgeHiSignal"],["decSignal"]]]});
	elKERNO["b_key"+"snap↓"].registerAssert({rcvRoot:elKERNO.b_slider4 ,portA:[[["edgeHiSignal"],["decSignal"]]]});
	elKERNO["b_key"+"vol↓" ].registerAssert({rcvRoot:elKERNO.b_slider3 ,portA:[[["edgeHiSignal"],["decSignal"]]]});
	
	// chart translations
	var sg1W =  70;var sg1H =  20;var sg1I = sg1H+h;
	var sl1W =  70;var sl1H =  20;var sl1I = sl1H+h;
	var tx1W = 140;var tx1H =  80;var tx1I = tx1H+h;
	t += s2_I;
	elKERNO.b_slider31 = ZACH.new({mode,partID:"KERN000005",elP,title:"→FtB4"       ,style:{w:sg1W,h:sg1H,t       ,l:gf_W               ,z:1},initial:[["value",0],["dirAsc","E"],["ascRoot",0],["min",0],["max",1],["snap",1],["ascMode","additive"],["valueFxn",v=>v===0?"→":"←"]]});
	elKERNO.b_slider32 = ZACH.new({mode,partID:"KERN000005",elP,title:"font size"  ,style:{w:sg1W,h:sg1H,t       ,l:gf_W+sl1W          ,z:1},initial:[["value",10],["dirAsc","E"],["ascRoot",0],["min",0],["max",16],["snap",0.5],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	elKERNO.b_text31   = ZACH.new({mode,partID:"KERN000013",elP,title:"FtB4 trans."  ,style:{w:tx1W,h:tx1H,t:t+sg1I,l:gf_W               ,z:1},initial:[["txt",""]]});
	elKERNO.b_slider41 = ZACH.new({mode,partID:"KERN000005",elP,title:"→o!m14"      ,style:{w:sg1W,h:sg1H,t       ,l:gf_W     +sl1W+sl1W,z:1},initial:[["value",0],["dirAsc","E"],["ascRoot",0],["min",0],["max",1],["snap",1],["ascMode","additive"],["valueFxn",v=>v===0?"→":"←"]]});
	elKERNO.b_slider42 = ZACH.new({mode,partID:"KERN000005",elP,title:"font size"  ,style:{w:sg1W,h:sg1H,t       ,l:gf_W+sl1W+sl1W+sl1W,z:1},initial:[["value",10],["dirAsc","E"],["ascRoot",0],["min",0],["max",16],["snap",0.5],["ascMode","additive"],["valueFxn",v=>v+"px"]]});
	elKERNO.b_text41   = ZACH.new({mode,partID:"KERN000013",elP,title:"o!m14 trans." ,style:{w:tx1W,h:tx1H,t:t+sg1I,l:gf_W     +sl1W+sl1W,z:1},initial:[["txt",""]]});
	
	elKERNO.b_slider31.registerAssert({rcvRoot:elKERNO.b_gf1   ,portA:[[["value"],["translateSignalO","FtB4"]]]});
	elKERNO.b_slider32.registerAssert({rcvRoot:elKERNO.b_text31,portA:[[["value"],["fs"]]]});
	elKERNO.b_gf1     .registerAssert({rcvRoot:elKERNO.b_text31,portA:[[["translatedSO","FtB4"],["txt"]]]});
	elKERNO.b_slider41.registerAssert({rcvRoot:elKERNO.b_gf1   ,portA:[[["value"],["translateSignalO","o!m14"]]]});
	elKERNO.b_slider42.registerAssert({rcvRoot:elKERNO.b_text41,portA:[[["value"],["fs"]]]});
	elKERNO.b_gf1     .registerAssert({rcvRoot:elKERNO.b_text41,portA:[[["translatedSO","o!m14"],["txt"]]]});
	
	elKERNO.b_slider21.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["modO_Decon082_ver1","overlayA",0,"p1"]]]});
	elKERNO.b_slider22.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["modO_Decon082_ver1","overlayA",0,"p2"]],[["value"],["modO_Decon082_ver1","overlayA",1,"p1"]]]});
	elKERNO.b_slider23.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[                                                     [["value"],["modO_Decon082_ver1","overlayA",1,"p2"]]]});
	elKERNO.b_color22 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["modO_Decon082_ver1","overlayA",0,"co1"]],[["coValueS"],["modO_Decon082_ver1","overlayA",0,"co2"]],[["coValueS"],["modO_Decon082_ver1","overlayA",1,"co1"]]]});
	elKERNO.b_color23 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[                                                                                                                  [["coValueS"],["modO_Decon082_ver1","overlayA",1,"co2"]]]});
	
	elKERNO.b_slider24.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["modO_Decon082_ver1","overlayA",2,"p1"]]]});
	elKERNO.b_slider25.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["modO_Decon082_ver1","overlayA",2,"p2"]],[["value"],["modO_Decon082_ver1","overlayA",3,"p1"]]]});
	elKERNO.b_slider26.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[                                                     [["value"],["modO_Decon082_ver1","overlayA",3,"p2"]]]});
	elKERNO.b_color25 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["modO_Decon082_ver1","overlayA",2,"co1"]],[["coValueS"],["modO_Decon082_ver1","overlayA",2,"co2"]],[["coValueS"],["modO_Decon082_ver1","overlayA",3,"co1"]]]});
	elKERNO.b_color24 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[                                                                                                                  [["coValueS"],["modO_Decon082_ver1","overlayA",3,"co2"]]]});
	
	for (var s of π.a(1,10)){
		// !!! HERE
		// b_gf1.noteFadedCoA[36] = b_color[765][2];
		// define the types [is it an array or an object] in the specific KERN configurations, at compile time
		// L> portOutO : [["b_color",[],{},""],["dog",""]], // means we have a b_color which is an array of objects of strings, and a dog, which is a string
		//elKERNO["b_color"+s+"_1"].registerAssert({rcvRoot:elKERNO.b_gf1,portAAA:[[["coValueA",765,2],["noteFadedCoA",36]],[["dog"],["cat"]]]});
		elKERNO["b_color"+s+"_1"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["noteFadedCoA",s]]]});
		elKERNO["b_color"+s+"_2"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["noteCoA",s]]]});
		elKERNO["b_color"+s+"_3"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["noteActiveCoA",s]]]});
		elKERNO["b_color"+s+"_4"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["laneWarningPreCoA",s]]]});
		elKERNO["b_color"+s+"_5"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["laneWarningPostCoA",s]]]});
		elKERNO["b_color"+s+"_6"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["laneCoA",s]]]});
		elKERNO["b_color"+s+"_7"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["laneActiveCoA",s]]]});
		elKERNO["b_color"+s+"_8"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["hitboxCoA",s]]]});
		elKERNO["b_color"+s+"_9"].registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["coValueS"],["hitboxActiveCoA",s]]]});}
	elKERNO.b_slider1 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["introWaitTime"]]]});
	elKERNO.b_slider2 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["playbackRate"]]]});
	elKERNO.b_slider3 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["volume"]]]});
	elKERNO.b_slider4 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["snapMultiplier"]]]});
	elKERNO.b_slider5 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["judgeLineRaise"]]]});
	elKERNO.b_slider6 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["snapH"]]]});
	elKERNO.b_slider7 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["noteW"]]]});
	elKERNO.b_slider8 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["noteH"]]]});
	elKERNO.b_slider9 .registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["warningPreH"]]]});
	elKERNO.b_slider10.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["warningPostH"]]]});
	elKERNO.b_slider11.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["noteOffset"]]]});
	elKERNO.b_slider12.registerAssert({rcvRoot:elKERNO.b_gf1,portA:[[["value"],["speedMultiplier"]]]});
	
	var l = gf_W+filW;
	var clkW = filI+filI+audI-h;var clkH = clkW;var clkI = clkH+h;
	var w__W =        60;var w__H =        20;var w__I = w__H+h;
	var h__W =        20;var h__H = clkH-w__I;var h__I = h__H+h;
	var co_W = w__W-h__W;var co_H = clkH-w__I;var co_I = co_H+h;
	elKERNO.a_clock1  = ZACH.new({mode,partID:"KERN000007",elP,title:"clock"            ,style:{w:clkW,h:clkH,t:   0,l:l                    ,z:1}});
	elKERNO.a_slider1 = ZACH.new({mode,partID:"KERN000005",elP,title:"hr-hand width"    ,style:{w:w__W,h:w__H,t:h__I,l:l+clkW               ,z:1},initial:[["value",4],["dirAsc","E"],["min",0],["max",10],["snap",1],["valueFxn",v=>v+"px"]]});
	elKERNO.a_color1  = ZACH.new({mode,partID:"KERN000008",elP,title:"hr-hand co"       ,style:{w:co_W,h:co_H,t:   0,l:l+clkW          +h__W,z:1},initial:[["orientation","vertical"],["hValue",0.2],["sValue",1],["lValue",0.4],["aValue",1]]});
	elKERNO.a_slider4 = ZACH.new({mode,partID:"KERN000005",elP,title:"hr-hand ‰ length" ,style:{w:h__W,h:h__H,t:   0,l:l+clkW               ,z:1},initial:[["value", 500],["dirAsc","N"],["min",0],["max",1000],["snap",20],["valueFxn",v=>v+"‰"]]});
	elKERNO.a_slider2 = ZACH.new({mode,partID:"KERN000005",elP,title:"min-hand width"   ,style:{w:w__W,h:w__H,t:h__I,l:l+clkW+w__W          ,z:1},initial:[["value",3],["dirAsc","E"],["min",0],["max",10],["snap",1],["valueFxn",v=>v+"px"]]});
	elKERNO.a_color2  = ZACH.new({mode,partID:"KERN000008",elP,title:"min-hand co"      ,style:{w:co_W,h:co_H,t:   0,l:l+clkW+w__W     +h__W,z:1},initial:[["orientation","vertical"],["hValue",0.1],["sValue",1],["lValue",0.4],["aValue",1]]});
	elKERNO.a_slider5 = ZACH.new({mode,partID:"KERN000005",elP,title:"min-hand ‰ length",style:{w:h__W,h:h__H,t:   0,l:l+clkW+w__W          ,z:1},initial:[["value", 900],["dirAsc","N"],["min",0],["max",1000],["snap",20],["valueFxn",v=>v+"‰"]]});
	elKERNO.a_slider3 = ZACH.new({mode,partID:"KERN000005",elP,title:"sec-hand width"   ,style:{w:w__W,h:w__H,t:h__I,l:l+clkW+w__W+w__W     ,z:1},initial:[["value",2],["dirAsc","E"],["min",0],["max",10],["snap",1],["valueFxn",v=>v+"px"]]});
	elKERNO.a_color3  = ZACH.new({mode,partID:"KERN000008",elP,title:"sec-hand co"      ,style:{w:co_W,h:co_H,t:   0,l:l+clkW+w__W+w__W+h__W,z:1},initial:[["orientation","vertical"],["hValue",0  ],["sValue",1],["lValue",0.4],["aValue",1]]});
	elKERNO.a_slider6 = ZACH.new({mode,partID:"KERN000005",elP,title:"sec-hand ‰ length",style:{w:h__W,h:h__H,t:   0,l:l+clkW+w__W+w__W     ,z:1},initial:[["value",0],["dirAsc","N"],["min",0],["max",1000],["snap",20],["valueFxn",v=>v+"‰"]]});
	elKERNO.a_color1 .registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["coValue"],["hHandCo"]]]});
	elKERNO.a_color2 .registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["coValue"],["mHandCo"]]]});
	elKERNO.a_color3 .registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["coValue"],["sHandCo"]]]});
	elKERNO.a_slider1.registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["value"  ],["hHandW" ]]]});
	elKERNO.a_slider2.registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["value"  ],["mHandW" ]]]});
	elKERNO.a_slider3.registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["value"  ],["sHandW" ]]]});
	elKERNO.a_slider4.registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["value"  ],["hHandH" ]]]});
	elKERNO.a_slider5.registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["value"  ],["mHandH" ]]]});
	elKERNO.a_slider6.registerAssert({rcvRoot:elKERNO.a_clock1,portA:[[["value"  ],["sHandH" ]]]});
	
	elKERNO.c_imgview1 = ZACH.new({mode:"embed",partID:"KERN000012",elP:µ.qd("body>¥bg1"         ),initial:[["bgs","cover"]]});
	elKERNO.c_fileIn1  = ZACH.new({mode:"embed",partID:"KERN000009",elP:µ.qd("body>¥toolbar>¥bgi")});
	elKERNO.c_fileIn1.registerAssert({rcvRoot:elKERNO.c_imgview1,portA:[[["fil"],["fil"]]]});
	
	// these currently must go last in order to push initially
	elKERNO.c_color1   = ZACH.new({mode:"embed",partID:"KERN000008",elP:µ.qd("body>¥toolbar>¥tx"),initial:[["hValue",0    ],["sValue",0],["lValue",1  ],["aValue",1   ]],outboundAllF:T,outboundAllPortA:[[["coValue"],["tx"]]]});
	elKERNO.c_color2   = ZACH.new({mode:"embed",partID:"KERN000008",elP:µ.qd("body>¥toolbar>¥co"),initial:[["hValue",0.116],["sValue",1],["lValue",0.5],["aValue",1   ]],outboundAllF:T,outboundAllPortA:[[["coValue"],["co"]]]});
	elKERNO.c_color3   = ZACH.new({mode:"embed",partID:"KERN000008",elP:µ.qd("body>¥toolbar>¥bg"),initial:[["hValue",0    ],["sValue",0],["lValue",0  ],["aValue",0.65]],outboundAllF:T,outboundAllPortA:[[["coValue"],["bg"]]]});
	var endGlobalT = π.now();
	lld("page initialization time : "+Math.ceil((endGlobalT-startGlobalT)/1000)+"ms");
});
</script>
<body></body></html>
