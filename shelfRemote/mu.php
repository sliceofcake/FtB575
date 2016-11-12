<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
require_once("butler.php");
require_once("muMain.php");

ob_start("ob_gzhandler");
if (isset($_POST["sks"])){ // shinkansen because when this core type debuted, it was "fast", and the first to support multiple sections per mega-request
	if (($m = π_jsonD($_POST["sks"])) !== N){
		echo π_jsonE(MU_process($m));}}
ob_end_flush();
die;
