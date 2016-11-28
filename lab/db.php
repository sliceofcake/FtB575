<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

require_once("../shelfRemote/mysql.php");
require_once("../shelfRemote/db.php");

$a = microtime(TRUE);
var_export(DB::verifyFileStructure());
$b = microtime(TRUE);
echo " | verifyFileStructure : " . ceil(($b-$a)*1000000);

echo "<br>";

$a = microtime(TRUE);
var_export(DB::clr("chart"));
$b = microtime(TRUE);
echo " | clr : " . ceil(($b-$a)*1000000);

for ($i = 0; $i < 100; $i++){
	echo "<br><br>";
	
	$a = microtime(TRUE);
	var_export($_=(DB::new("chart",["title"=>"Pallet Town","dbg"=>$i],[])));
	$b = microtime(TRUE);
	echo " | new : " . ceil(($b-$a)*1000000);
	
	echo "<br>";
	
	$a = microtime(TRUE);
	var_export(DB::edt("chart",$_,["also"=>"this"],[]));
	$b = microtime(TRUE);
	echo " | edt : " . ceil(($b-$a)*1000000);
	
	echo "<br>";
	
	$a = microtime(TRUE);
	var_export(DB::get("chart",$_));
	$b = microtime(TRUE);
	echo " | get : " . ceil(($b-$a)*1000000);
	
	echo "<br>";
	
	$a = microtime(TRUE);
	var_export(DB::dmp("chart"));
	$b = microtime(TRUE);
	echo " | dmp : " . ceil(($b-$a)*1000000);
	
	echo "<br>";
	
	$a = microtime(TRUE);
	var_export(DB::del("chart",$_));
	$b = microtime(TRUE);
	echo " | del : " . ceil(($b-$a)*1000000);
	
	echo "<br>";
	
	$a = microtime(TRUE);
	var_export(DB::get("chart",$_));
	$b = microtime(TRUE);
	echo " | get : " . ceil(($b-$a)*1000000);}


die;die;die;

$db_row = ["ID"=>0,"msg"=>"","t"=>0,];

//----
echo "<br><br>";
echo "SERIALIZE";
echo "<br><br>";
file_put_contents("serial.txt",serialize([]));

$a = microtime(TRUE);
$db = unserialize(file_get_contents("serial.txt"));
$db[] = $db_row;
file_put_contents("serial.txt",serialize($db));
$b = microtime(TRUE);
$db = unserialize(file_get_contents("serial.txt"));
$c = microtime(TRUE);
echo "write : " . ceil(($b-$a)*1000000) . " | read : " . ceil(($c-$b)*1000000);
echo "<br>";
var_export($db);

//----
echo "<br><br>";
echo "JSON";
echo "<br><br>";
file_put_contents("json.txt",json_encode([]));

$a = microtime(TRUE);
$db = json_decode(file_get_contents("json.txt"),TRUE);
$db[] = $db_row;
file_put_contents("json.txt",json_encode($db));
$b = microtime(TRUE);
$db = json_decode(file_get_contents("json.txt"),TRUE);
$c = microtime(TRUE);
echo "write : " . ceil(($b-$a)*1000000) . " | read : " . ceil(($c-$b)*1000000);
echo "<br>";
var_export($db);

//----
echo "<br><br>";
echo "MYSQL";
echo "<br><br>";
db_q("DELETE FROM debug");

$a = microtime(TRUE);
db_q("INSERT INTO debug (lvl,msg,t) VALUES ('".esc(0)."','".esc("")."','".esc(0)."')");
$b = microtime(TRUE);
db_q("SELECT * FROM debug");
$c = microtime(TRUE);
echo "write : " . ceil(($b-$a)*1000000) . " | read : " . ceil(($c-$b)*1000000);
?>