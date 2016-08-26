<? require_once("/home/ftbsliceofcake2/feelthebeats.se/staff/librarian.php"); ?>
<? require_once($INTERNAL_ROOT_PATH."shelf/mysql.php"); ?>
<? require_once($INTERNAL_ROOT_PATH."shelf/color.php"); ?>
<? require_once($INTERNAL_ROOT_PATH."staff/maid.php"); ?>
<?
if (session_status() == PHP_SESSION_NONE){session_start();}
$HANDLE_HEIGHT = 16;
$qCurrentUser = selectCurrentUser("SELECT r,g,b,rTx,gTx,bTx,rBg,gBg,bBg,layerAlpha");
$co = array(result($qCurrentUser,0,"r"),result($qCurrentUser,0,"g"),result($qCurrentUser,0,"b"));
$tx = array(result($qCurrentUser,0,"rTx"),result($qCurrentUser,0,"gTx"),result($qCurrentUser,0,"bTx"));
$bg = array(result($qCurrentUser,0,"rBg"),result($qCurrentUser,0,"gBg"),result($qCurrentUser,0,"bBg"));
$userAlterTxColor = rgbamix($co,$tx,0.2); // the Tx color, with a drop of color
$userAlterBgColor = rgbamix($co,$bg,0.4); // the Bg color, with a drop of color
$userHalfColor = rgbamix($co,$bg,0.5); // 50-50 of color and Bg color
$bgSnap = array_sum($bg)/3<=127?0:1;
$layerAlpha = result($qCurrentUser,0,"layerAlpha")/100;
?>
<?
$LAYER_TRANSITION_DURATION = "0.25s";
$LAYER_TRANSITION_DELAY = "0s";
$LAYER_TRANSITION_EASING = "ease";

$DRAWER_TRANSITION_DURATION = "0.3s";
$DRAWER_TRANSITION_DELAY = "0s";
$DRAWER_TRANSITION_EASING = "ease";

$TRIGGER_H = 50;
?>



<?
$boxP = 6;
$LRP = 6;
$TP = 12;
?>
<style id="KERN000002CartridgeCSS">
.KERN000002A,
.KERN000002A * {box-sizing:border-box;}
.KERN000002A,
.KERN000002A *::-moz-selection {background-color:transparent;}
.KERN000002A,
.KERN000002A *::selection      {background-color:transparent;}
.KERN000002A        {¥:block;¥:relative;cursor:pointer;}
.KERN000002AA       {¥:block;¥:absolute;¥:NW;}
.KERN000002AAA      {¥:block;¥:absolute;¥t:<?=$boxP-1;?>px;¥l:<?=$boxP-1;?>px;}
.KERN000002AB       {¥:none;¥:absolute;cursor:default;}
.KERN000002ABA      {¥:block;¥p:<?=$TP;?>px <?=$LRP;?>px 0px <?=$LRP;?>px;}
.KERN000002ABB      {¥:block;¥p:<?=$TP;?>px <?=$LRP;?>px 0px <?=$LRP;?>px;}
.KERN000002ABC      {¥:block;¥p:<?=$TP;?>px <?=$LRP;?>px 0px <?=$LRP;?>px;}
</style>
<script id="KERN000002CartridgeJS">
// markArr:[mark:{left,display,majorFlag}...]
function KERN000002(params){params = deepCopy(params);
	if (typeof params == "undefined"){params = {};}
	if (typeof params.boxW == "undefined"){params.boxW = 50;}
	if (typeof params.boxH == "undefined"){params.boxH = 50;}
	if (typeof params.sheetW == "undefined"){params.sheetW = 450;}
	if (typeof params.sheetH == "undefined"){params.sheetH = 200;}
	if (typeof params.zIndex == "undefined"){params.zIndex = "auto";}
	if (typeof params.tx == "undefined"){params.tx = [0,0,0];}
	if (typeof params.co == "undefined"){params.co = [127,127,127];}
	if (typeof params.bg == "undefined"){params.bg = [255,255,255];}
	if (typeof params.titleArr == "undefined"){params.titleArr = ["HUE","SATURATION","BRIGHTNESS"];}
	if (typeof params.initialH == "undefined"){params.initialH = 0;}
	if (typeof params.initialS == "undefined"){params.initialS = 0;}
	if (typeof params.initialB == "undefined"){params.initialB = 0;}
	if (typeof params.valueSetCallback == "undefined"){params.valueSetCallback = function(value){};}
	var innerH = params.boxH - <?=$boxP*2;?>;
	var innerW = params.boxW - <?=$boxP*2;?>;
	var borderColor = rgbma(params.tx,params.tx,1,1);
	var bgc = rgbma(params.bg,params.bg,1,0.9);
	//----
	var A = ooyodo.newElement({class:"KERN000002A",style:"width:"+params.boxW+"px;height:"+params.boxH+"px;border:1px solid "+borderColor+";"});
	A.KERN = {valueSetCallback:params.valueSetCallback,valuePreviewCallback:function(value){var AAA = this.hook.querySelector(".KERN000002AAA");AAA.style.backgroundColor = rgba(value,1);},h:params.initialH,s:params.initialS,b:params.initialB,hook:A};
		var AA = ooyodo.newElement({class:"KERN000002AA",style:"width:"+(params.boxW-2)+"px;height:"+(params.boxH-2)+"px;background-color:"+bgc+";"});ooyodo.assertElement(A,AA);
			var AAA = ooyodo.newElement({class:"KERN000002AAA",style:"width:"+innerW+"px;height:"+innerH+"px;"});ooyodo.assertElement(AA,AAA);
		var AB = ooyodo.newElement({class:"KERN000002AB",style:"top:"+params.boxH+"px;left:-1px;width:"+params.sheetW+"px;height:"+params.sheetH+"px;border:1px solid "+borderColor+";background-color:"+bgc+";z-index:"+params.zIndex+";"});ooyodo.assertElement(A,AB);
			var markArr = [];for (var i = 0; i <= 359; i++){markArr.push({left:i,display:i,majorFlag:(i%30==0)});}
			var ABA = ooyodo.newElement({class:"KERN000002ABA"});ooyodo.assertElement(AB,ABA);
				ooyodo.assertElement(ABA,KERN000001({title:params.titleArr[0],width:params.sheetW-<?=$LRP*2;?>,height:params.sheetH*0.25,markArr:markArr,initialValue:params.initialH,tx:params.tx,co:params.co,bg:params.bg,valueSetCallback:function(value){var A = this.hook.parentNode.parentNode.parentNode;A.KERN.h = value;A.KERN.valuePreviewCallback(hsbtorgb([A.KERN.h,A.KERN.s,A.KERN.b]));}}));
			var markArr = [];for (var i = 0; i <= 100; i++){markArr.push({left:i,display:i,majorFlag:(i%10==0)});}
			var ABB = ooyodo.newElement({class:"KERN000002ABB"});ooyodo.assertElement(AB,ABB);
				ooyodo.assertElement(ABB,KERN000001({title:params.titleArr[1],width:params.sheetW-<?=$LRP*2;?>,height:params.sheetH*0.25,markArr:markArr,initialValue:params.initialS,tx:params.tx,co:params.co,bg:params.bg,valueSetCallback:function(value){var A = this.hook.parentNode.parentNode.parentNode;A.KERN.s = value;A.KERN.valuePreviewCallback(hsbtorgb([A.KERN.h,A.KERN.s,A.KERN.b]));}}));
			var ABC = ooyodo.newElement({class:"KERN000002ABC"});ooyodo.assertElement(AB,ABC);
				ooyodo.assertElement(ABC,KERN000001({title:params.titleArr[2],width:params.sheetW-<?=$LRP*2;?>,height:params.sheetH*0.25,markArr:markArr,initialValue:params.initialB,tx:params.tx,co:params.co,bg:params.bg,valueSetCallback:function(value){var A = this.hook.parentNode.parentNode.parentNode;A.KERN.b = value;A.KERN.valuePreviewCallback(hsbtorgb([A.KERN.h,A.KERN.s,A.KERN.b]));}}));
	A.KERN.valuePreviewCallback(hsbtorgb([A.KERN.h,A.KERN.s,A.KERN.b]));
	AA.addEventListener("click",function(){
		var A = this.parentNode;
		var AB = A.querySelector(".KERN000002AB");
		if (AB.style.display == "block"){
			AB.style.display = "none";
			A.KERN.valueSetCallback([A.KERN.h,A.KERN.s,A.KERN.b]);}
		else{AB.style.display = "block";}});
	return A;}
</script>
