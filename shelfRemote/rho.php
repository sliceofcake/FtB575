<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");
die;
require_once("all.php");
ob_start("ob_gzhandler");
if (isset($_POST["sks"])){
	$m = json_decode($_POST["sks"],TRUE);
	if ($m !== NULL){
		echo json_encode(RHO_PROCESS(ic5($m)));}}
ob_end_flush();
die;
?>
