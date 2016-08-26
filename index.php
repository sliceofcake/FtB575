<?
function calcDirBaseOfVer(){
	$pathPre  = $_SERVER["DOCUMENT_ROOT"]; // example: /home/ftbsliceofcake2/feelthebeats.se
	$pathPost = $_SERVER["PHP_SELF"]; // example: /575/index.php
	$beyondFinalCharPos = mb_strpos($pathPost,"/",1);
	if ($beyondFinalCharPos === FALSE){$beyondFinalCharPos = mb_strlen($pathPost);}
	return $pathPre.mb_substr($pathPost,0,$beyondFinalCharPos)."/";}
$DIR_BASE_OF_VER = calcDirBaseOfVer();
$dirBase = $DIR_BASE_OF_VER."homeCollection/";
$pathA = [];
$filenameA = scandir($dirBase,SCANDIR_SORT_NONE);
foreach ($filenameA as $i=>$filename){
	if (mb_strlen($filename) < mb_strlen(".php")){continue;}
	if (mb_substr($filename,-mb_strlen(".php")) !== ".php"){continue;}
	$pathA[] = $dirBase.$filename;}
if (count($pathA) === 0){echo "WSD forgot to include a valid home page...";}
require($pathA[random_int(0,count($pathA)-1)]);
?>
