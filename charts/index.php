<? require_once("/home/ftbsliceofcake2/gate/gate_575.php"); ?>
<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta name="description" content="Feel the Beats - Rhythm Game"><meta name="keywords" content="FtB,Rhythm,Game,XceeD"><meta name="author" content="XceeD Illuminati"><meta name="creator" content="XceeD Illuminati"><meta name="publisher" content="XceeD Illuminati"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /charts/</title><link href="../../image/favicon.png" rel="icon" type="image/png">
<script><? require_once("../shelfLocal/butler.js"); ?></script>
<script><? require_once("../shelfLocal/style.js"); ?></script>
<script><? require_once("../shelfLocal/mu.js"); ?></script>
<script><? require_once("../shelfLocal/KERN4/KERN.js"); ?></script>
<script><? require_once("../shelfLocal/KERN4/TEST000001.js"); ?></script>
<script><? require_once("../shelfLocal/KERN4/KERN000018.js"); ?></script>
<script><? require_once("../shelfLocal/KERN4/KERN000019.js"); ?></script>
<script><? require_once("../shelfLocal/KERN4/KERN000020.js"); ?></script>
<script><? require_once("../shelfLocal/KERN4/KERN000022.js"); ?></script>
<script><? require_once("../shelfLocal/KERN4/KERN000023.js"); ?></script>
<script>
core.socketO["MU"]["pre"] = function(o){
	var tFxn = (t,tt)=>Math.ceil(tt-t);
	//ll(o.mir.tbl+" | "+o.mir.act+" | Specific Execution "+(o.d-o.c)+"µs"+" | SKS Execution : "+(o.e-o.b)+" µs | Round-Trip Network-Specific Time : "+Math.ceil((o.b-o.a)+(o.f-o.e)/1000)+"ms");
	//ll(π.jsonE(o));
	};
var p = {
	registerPart : function(o){π.p(o,{k:"",el:null,datO:{},titleS:"",t:10,l:10,w:200,h:100,z:1});
		µ.ma(document.body,µ.m(
			[".panel¥"+o.k,[
				[".handle",o.titleS],
				[".buttonC",[
					[".button",{click:function(){µ.tg(µ.qud(this,".panel",".panel>.log"));}},"log"],
				]],
				[".main"],
				[".log"],
			]]
		));
		var el = µ.qd(".panel¥"+o.k);
		this.elKERNO[o.k       ] = KERN.create(π.ooa(o.datO,{elP:µ.qd(".panel¥"+o.k+">.main"    )}));
		this.elKERNO[o.k+"_log"] = KERN.create({partID:"KERN000022",elP:µ.qd(".panel¥"+o.k+">.log")});
		this.elKERNO[o.k].registerAssert({rcvRoot:this.elKERNO[o.k+"_log"],portA:[[["log"],["log"]]]});
		el.style.top    = o.t+"px";
		el.style.left   = o.l+"px";
		el.style.width  = o.w+"px";
		el.style.height = o.h+"px";
		el.style.zIndex = o.z+"px";
		panflo.register(o.k,{handle:µ.qd(".panel¥"+o.k+">.handle"),panel:el});},
	elKERNO : {},
};
document.addEventListener("DOMContentLoaded",()=>{
	/*p.elKERNO["el1"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el1']"),datA:[["continuousS","mole"]]});
	p.elKERNO["el2"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el2']"),datA:[]});
	p.elKERNO["el3"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el3']"),datA:[]});
	p.elKERNO["el4"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el4']"),datA:[]});
	
	p.elKERNO["el1"].registerAssert({rcvRoot:p.elKERNO["el2"],portA:[[["edgeHiExportSignal"],["edgeHiImportSignal"]],[["edgeHiS"],["edgeHiS"]],[["continuousS"],["continuousS"]]]});
	p.elKERNO["el2"].registerAssert({rcvRoot:p.elKERNO["el3"],portA:[[["edgeHiExportSignal"],["edgeHiImportSignal"]],[["edgeHiS"],["edgeHiS"]],[["continuousS"],["continuousS"]]]});
	p.elKERNO["el1"].registerAssert({rcvRoot:p.elKERNO["el4"],portA:[[["edgeHiExportSignal"],["edgeHiImportSignal"]],[["edgeHiS"],["edgeHiS"]],[["continuousS"],["continuousS"]]]});*/
	
	//----
	
	p.registerPart({k:"auth1",titleS:"Authentication"   ,t: 10,l: 10,w:400,h:230,z:1,datO:{partID:"KERN000018",datA:[]}});
	p.registerPart({k:"edit1",titleS:"Chart Submit/Edit",t: 10,l:420,w:500,h:400,z:2,datO:{partID:"KERN000020",datA:[]}});
	p.registerPart({k:"chrt1",titleS:"Chart Search"     ,t:250,l: 10,w:800,h:400,z:3,datO:{partID:"KERN000019",datA:[]}});
	p.registerPart({k:"chrt2",titleS:"Chart Search #2"  ,t:320,l:120,w:800,h:400,z:4,datO:{partID:"KERN000019",datA:[]}});
	p.tx = [0,1,1,1];
	p.co = [0,1,0.5,1];
	p.bg = [0,0,0,0.65];
	ø.asrStyle(p);
});
</script>
<style>
	/*:root>body>[data-type='auth1'] {top: 10px;left: 10px;width:400px;height:300px;}*/
</style>
</head>
<body>
</body></html>
