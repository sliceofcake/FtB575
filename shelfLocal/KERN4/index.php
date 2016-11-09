<? require_once("/home/ftbsliceofcake2/gate/gate_575.php"); ?>

<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta name="description" content="Feel the Beats - Rhythm Game"><meta name="keywords" content="FtB,Rhythm,Game,XceeD"><meta name="author" content="XceeD Illuminati"><meta name="creator" content="XceeD Illuminati"><meta name="publisher" content="XceeD Illuminati"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 KERN4</title><link href="../../image/favicon.png" rel="icon" type="image/png">
<script><? require_once("KERN.js"); ?></script>
<script><? require_once("TEST000001.js"); ?></script>
<script>
var elKERNO = {};
document.addEventListener("DOMContentLoaded",()=>{
	elKERNO["el1"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el1']"),datA:[["continuousS","mole"]]});
	elKERNO["el2"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el2']"),datA:[]});
	elKERNO["el3"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el3']"),datA:[]});
	elKERNO["el4"] = KERN.create({partID:"TEST000001",elP:document.querySelector(":root>body>[data-type='el4']"),datA:[]});
	
	elKERNO["el1"].registerAssert({rcvRoot:elKERNO["el2"],portA:[[["edgeHiExportSignal"],["edgeHiImportSignal"]],[["edgeHiS"],["edgeHiS"]],[["continuousS"],["continuousS"]]]});
	elKERNO["el2"].registerAssert({rcvRoot:elKERNO["el3"],portA:[[["edgeHiExportSignal"],["edgeHiImportSignal"]],[["edgeHiS"],["edgeHiS"]],[["continuousS"],["continuousS"]]]});
	elKERNO["el1"].registerAssert({rcvRoot:elKERNO["el4"],portA:[[["edgeHiExportSignal"],["edgeHiImportSignal"]],[["edgeHiS"],["edgeHiS"]],[["continuousS"],["continuousS"]]]});
});
</script>
<style>
	.keybind {display:inline-block;width:160px;height:auto;border:1px solid black;margin:10px;}
	:root>body>[data-type='el1'] {}
	:root>body>[data-type='el2'] {}
	:root>body>[data-type='el3'] {}
	:root>body>[data-type='el4'] {}
</style>
<body>
	<div class="keybind" data-type="el1"></div>
	<div class="keybind" data-type="el2"></div>
	<div class="keybind" data-type="el3"></div><br>
	<div class="keybind" data-type="el4"></div>
</body></html>
