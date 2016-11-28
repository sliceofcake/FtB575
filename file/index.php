<?
require_once("../shelfRemote/librarian.php");
require_once("../shelfRemote/butler.php");
require_once("../shelfRemote/db.php");

if (!isset($_GET["tbl"])){die;}
$tbl = $_GET["tbl"];

if (!isset($_GET["propertyS"])){die;}
$propertyS = $_GET["propertyS"];

if (!isset($_GET["ID"])){die;}
$ID = $_GET["ID"];if (!isNumStr($ID)){die;}$ID = int($ID);

if (!isset($_GET["extension"])){die;}
$extension = $_GET["extension"];

$path = calcDBPath("internal",$tbl,$propertyS,$ID,$extension);if ($path === F){die;}
//echo $path;die;
header("Cache-Control: public");
header("Pragma: cache");
header("Content-Type: ".π_pathToContentType($path));
readfile($path);
die;die;die;
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
/*function last($m){
	if (is_array($m)){
		$i = 0;
		while (isset($m[$i])){$i++;}
		$i--;
		if ($i === -1){return NULL;}
		return $m[$i];}
	else if (is_string($m)){
		return $m;}
	return NULL;}
stream_context_set_default(["http"=>["method"=>"HEAD"]]);
$headerArr = get_headers($path,1);
stream_context_set_default(["http"=>["method"=>"GET"]]);
$ETag          = (isset($headerArr["etag"          ])) ? last($headerArr["etag"          ]) : NULL;
$ContentType   = (isset($headerArr["Content-Type"  ])) ? last($headerArr["Content-Type"  ]) : NULL;
$ContentLength = (isset($headerArr["Content-Length"])) ? last($headerArr["Content-Length"]) : NULL;
header("Cache-Control: public");
header("Pragma: cache");
// cache processing, possibly ending execution immediately
if ($ETag !== NULL){
	header("ETag: \"".$ETag."\"");
	if (isset($_SERVER["HTTP_IF_NONE_MATCH"]) && str_replace("\"","",stripslashes($_SERVER["HTTP_IF_NONE_MATCH"])) === $ETag){
		header("HTTP/1.1 304 Not Modified");
		die;}}
if ($ContentType === NULL){die;}
if ($ContentLength === NULL){die;}
header("Content-Type: ".$ContentType);
header("Content-Length: ".$ContentLength);
readfile($path);*/
?>