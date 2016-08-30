<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

require_once("butler.php");
require_once("mysql.php");
//----------------------------------------------------------------------------------------------------------------------
// DATABASE-SPECIFIC TO FTB7
// query UPDATE
function D_qu($tbl,$ID,$arr){
	if (!in_array($tbl,DB_TABLE_ARR(),TRUE)){ERR_M_SET("invalid table:".strval($tbl)." passed to D_qu()");return FALSE;}
	if (!is_int($ID)){ERR_M_SET("invalid ID:".strval($ID)." passed to D_qu()");return FALSE;}
	if (!is_array($arr) || count($arr) === 0){ERR_M_SET("invalid arr:".strval($paramArr)." passed to D_qu()");return FALSE;}
	query("UPDATE ftb7_".$tbl." SET ".implode(",",π_map($arr,function($v,$i){return "`".$i."`='".esc($v)."'";}))." WHERE ID='".esc($ID)."' LIMIT 1");}
// query SELECT COUNT(*)
function D_qc($tbl,$fragment){
	if (!in_array($tbl,DB_TABLE_ARR(),TRUE)){ERR_M_SET("invalid table:".strval($tbl)." passed to D_qu()");return FALSE;}
	return queryresult("SELECT COUNT(*) FROM ftb7_".$tbl." WHERE ".$fragment);}
// query SELECT *
function D_qs($tbl,$ID){
	$qrra = queryresultrowarray("SELECT * FROM ftb7_".$tbl." WHERE ID='".esc($ID)."' LIMIT 1");
	return ($qrra === FALSE || count($qrra) === 0) ? FALSE : $qrra[0];}
// extract relational IDs
function D_exrel($tbl,$ID,$tblRel,$tblVia=NULL){
	if ($tblVia === NULL){
		return queryresultarray("SELECT DISTINCT(ID) FROM ftb7_".$tblRel." WHERE ".$tbl."ID='".esc($ID)."' ORDER BY ID ASC");}
	else{
		return queryresultarray("SELECT DISTINCT(ID) FROM ftb7_".$tblVia." WHERE ".$tbl."ID='".esc($ID)."' ORDER BY ID ASC");}}
// rowexists
function D_re($tbl,$ID){return rowexists("FROM ftb7_".$tbl." WHERE ID='".esc($ID)."'");}
// query
function D_q($q){return query($q);}
// queryresult
function D_qr($q){return queryresult($q);}
// queryresultarray
function D_qra($q){return queryresultarray($q);}
// queryresultrowarray
function D_qrra($q){return queryresultrowarray($q);}
//----------------------------------------------------------------------------------------------------------------------
// K
function K_signedIn(){return (K_GID() !== FALSE);}
function K_gstID(){
	if (!isset($GLOBALS["userID"])){return FALSE;}
	if (!is_int($GLOBALS["userID"])){return FALSE;}
	if ($GLOBALS["userID"] < 1){return FALSE;}
	return $GLOBALS["userID"];}
function K_validGstID($ID){
	if (!is_int($ID)){return FALSE;}
	return rowexists("FROM `ftb7_".$table."` WHERE ID='".esc($ID)."'");}
function K_possibleGID($m){return K_possibleID($m,G_GID_MIN(),G_GID_MAX());}
function K_possibleDID($m){return K_possibleID($m,G_DID_MIN(),G_DID_MAX());}
function K_possibleID($m,$lo,$hi){
	if (!is_string($m)){return FALSE;}
	return (preg_match('/^[▝▗▖▘▐▄▌▀▞▚▟▙▛▜█]{'.$lo.','.$hi.'}$/u',$m) === 1);}
// generate relation data for this data row, by guessing
function K_rel($ID){
	query("DELETE FROM ftb0_rel WHERE ID_dat='".esc($ID)."'");
	$txt = queryresult("SELECT dat FROM ftb0_dat WHERE ID='".esc($ID)."' LIMIT 1");
	if ($txt === FALSE){return;}
	$IDFoundArr = array();
	preg_match_all('/(?<=^|[^▝▗▖▘▐▄▌▀▞▚▟▙▛▜█])([▝▗▖▘▐▄▌▀▞▚▟▙▛▜█]{'.G_DID_MIN().','.G_DID_MAX().'})(?=$|[^▝▗▖▘▐▄▌▀▞▚▟▙▛▜█])/u',$txt,$IDFoundArr);
	$groupArr = array();foreach ($IDFoundArr as $IDFound){if (count($IDFound) === 0){continue;}$groupArr[] = "'".esc($ID)."','".esc($IDFound[0])."'";}
	query("INSERT INTO ftb0_rel (ID_dat,ID) VALUES (".implode("),(",$groupArr).")");}
// !!! when to give up and move from the min toward the max
function K_randGID(){return K_randID(G_GID_MIN(),G_GID_MAX());}
function K_randDID(){return K_randID(G_DID_MIN(),G_DID_MAX());}
function K_randID($lo,$hi){
	$charArr = array("▝","▗","▖","▘","▐","▄","▌","▀","▞","▚","▟","▙","▛","▜","█");
	$charArrC = count($charArr);
	$res = "";for ($_ = 0; $_ < $lo; $_++){$res .= $charArr[random_int(0,$charArrC-1)];}
	return $res;}
function K_getIP1(){
	if      (getenv("REMOTE_ADDR"         ) !== FALSE){$ipaddress = getenv("REMOTE_ADDR"         );}
	else if (getenv("HTTP_CLIENT_IP"      ) !== FALSE){$ipaddress = getenv("HTTP_CLIENT_IP"      );}
	else if (getenv("HTTP_X_FORWARDED_FOR") !== FALSE){$ipaddress = getenv("HTTP_X_FORWARDED_FOR");}
	else if (getenv("HTTP_X_FORWARDED"    ) !== FALSE){$ipaddress = getenv("HTTP_X_FORWARDED"    );}
	else if (getenv("HTTP_FORWARDED_FOR"  ) !== FALSE){$ipaddress = getenv("HTTP_FORWARDED_FOR"  );}
	else if (getenv("HTTP_FORWARDED"      ) !== FALSE){$ipaddress = getenv("HTTP_FORWARDED"      );}
	else                                              {$ipaddress = "UNKNOWN"                     ;}
	return $ipaddress;}
function K_getIP2(){
	if      (isset($_SERVER["REMOTE_ADDR"         ]) && $_SERVER["REMOTE_ADDR"         ]){$ipaddress = $_SERVER["REMOTE_ADDR"];}
	else if (isset($_SERVER["HTTP_CLIENT_IP"      ]) && $_SERVER["HTTP_CLIENT_IP"      ]){$ipaddress = $_SERVER["HTTP_CLIENT_IP"];}
	else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && $_SERVER["HTTP_X_FORWARDED_FOR"]){$ipaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];}
	else if (isset($_SERVER["HTTP_X_FORWARDED"    ]) && $_SERVER["HTTP_X_FORWARDED"    ]){$ipaddress = $_SERVER["HTTP_X_FORWARDED"];}
	else if (isset($_SERVER["HTTP_FORWARDED_FOR"  ]) && $_SERVER["HTTP_FORWARDED_FOR"  ]){$ipaddress = $_SERVER["HTTP_FORWARDED_FOR"];}
	else if (isset($_SERVER["HTTP_FORWARDED"      ]) && $_SERVER["HTTP_FORWARDED"      ]){$ipaddress = $_SERVER["HTTP_FORWARDED"];}
	else                                                                                 {$ipaddress = "UNKNOWN";}
	return $ipaddress;}
function K_adjectiveArr(){return array("Dubious","Dastardly","Fantastic","Confusing","Misunderstood","Limited Edition","Upgraded","CG","Unrivaled","Relocated","Offshore","Akiba","Angry","Forgotten","Infamous","Sparkling","After-School","Poorly-Hidden","Sekrit","Embarrassing","World-Famous","Saucy","Unlimited","Brilliant","Pre-Ordered","Over-Hyped","Wondrous","Shiny","Distracting","Discontinued","Underground","Evanescent","Shocking","Bankrupt","Overdue","Tsundere");}
function K_animalArr(){return array("Penguin","Cat","Turtle","Giraffe","Lion","Polar Bear","Dolphin","Elephant","Dog","Lamb","Sheep","Budgie","Bunny","Rabbit","Tea","Grizzly Bear","Koi","Hippo","Llama","Alpaca","Amagi","Hen","Rooster","Horse","Trout","Rhinoceros","Squirrel","Seal");}
function K_nounArr(){return array("Planetarium","Debate","Forest","Island","Doujinshi","Meteor","Software","Database","Museum","Maid Café","Bite","Detective","Hideout","Time","Cosplay","Novel","Sticker Book","Arcade Game","Park","Headquarters","Guild","Magazine","Manor","Shrine","Pond","Reef","Mountain","Jungle","Onsen","Paradise","Oasis","Dystopia","Collection","Pillow","Blanket","Box","Plot","Sticker","Party","Tower","Monument","Airlift","Airdrop");}
function K_genChannelName(){
	$adjective = K_adjectiveArr()[random_int(0,count(K_adjectiveArr())-1)];
	$animal    = K_animalArr()   [random_int(0,count(K_animalArr()   )-1)];
	$noun      = K_nounArr()     [random_int(0,count(K_nounArr()     )-1)];
	return $adjective." ".$animal." ".$noun;}
// in bytes. negative integer on error
function K_retrieveFileSize($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_NOBODY, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); //not necessary unless the file redirects (like the PHP example we're using here)
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data === FALSE) {
		// cURL failed
		return -2;}
	
	$contentLength = -1;
	// grab the last occurrence because a "follow" may generate multiple results in a row
	if (preg_match_all('/Content-Length:\s(\d+)/', $data, $matches) >= 1){//!== FALSE
		$matches = $matches[1];
		$contentLength = (int)$matches[count($matches)-1];}
	
	return $contentLength;}
function K_urlExists($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_NOBODY, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); //not necessary unless the file redirects (like the PHP example we're using here)
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data === FALSE) {
		// cURL failed
		return FALSE;}
	
	$contentLength = -1;
	$status = -1;
	// grab the last occurrence because a "follow" may generate multiple results in a row
	if (preg_match_all('/HTTP\/1\.[01]\s(\d\d\d)/', $data, $matches) >= 1){//!== FALSE
		$matches = $matches[1];
		$status = (int)$matches[count($matches)-1];}
	if (preg_match_all('/Content-Length:\s(\d+)/', $data, $matches) >= 1){//!== FALSE
		$matches = $matches[1];
		$contentLength = (int)$matches[count($matches)-1];}
	
	return ($status==200);}
// includes the dot
function K_getFileExtension($filename){
	$dotPos = strrpos($filename,".");
	if ($dotPos === FALSE){return "";}
	return substr($filename,strrpos($filename,"."));}

function K_validURL($url){return K_urlExists($url) && K_retrieveFileSize($url) !== 0;}

// attempts to discern the actual extension of an image file
// input: externalUrl
// output: extension, including the dot
// expects nothing
function K_getImageFileExtension($filename){
	switch (exif_imagetype($filename)){
		case IMAGETYPE_PNG:return ".png";
		case IMAGETYPE_JPEG:return ".jpg";
		case IMAGETYPE_GIF:return ".gif";
		default:return FALSE;}}
?>
