<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /lab/</title><link href="../image/favicon.png" rel="icon" type="image/png">
<style>
body {width:90%;margin:0px;}

</style>
<script>
<?
require_once("../shelf/butler.js");
require_once("../shelf/color.js"); ?>
</script>
<script>
var p = {
	tree : N,
	gen  : function(o={}){
		π.ooaw(o,{
			tree : N,});
		if (o.tree === N || o.tree.length === 0){return;}
		ll(o.tree[0]);
		o.tree[1].forEach(tree=>{
			p.gen({tree});});},
};
p.tree =
["¥A",[
	["¥A",[
		["¥A",[]],
		["¥B",[]],
		["¥C",[]],
	]],
	["¥B",[
		["¥A",[]],
		["¥B",[]],
	]],
	["¥C",[
		["¥A",[]],
		["¥B",[]],
	]],
]];
p.gen({tree:p.tree});
</script>
<body>

</body></html>
