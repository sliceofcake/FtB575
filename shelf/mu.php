<?
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
require_once("butler.php");
require_once("mysql.php");
require_once("specific.php");
//mt_srand(currentMicro());
function DB_ROW_LIMIT(){return 1000;} // general answer for "at most, how many rows should be fetched in a query"
function DB_TINYTEXT_LENGTH(){return intval(floor(255/4));} // max of 4 Bytes per characters in UTF-8
function DB_TEXT_LENGTH(){return intval(floor(65535/4));} // max of 4 Bytes per characters in UTF-8
function DB_MEDIUMTEXT_LENGTH(){return intval(floor(16777215/4));} // max of 4 Bytes per characters in UTF-8
function DB_BIGINT_MAX(){return 9223372036854775807;} //PHP_INT_MAX
function DB_BIGINT_MIN(){return -9223372036854775808;} //PHP_INT_MIN
function DB_INT_MAX(){return 2147483647;}
function DB_INT_MIN(){return -2147483648;}
function DB_ID_MIN(){return 0;} // 0 will never match a row, but allow it (for that purpose)
function DB_ID_MAX(){return 4294967295;}
function DB_SCORE_MIN(){return 0;}
function DB_SCORE_MAX(){return 999999999;}
function DB_USERNAME_LENGTH(){return 1000;}
function DB_PASSWORD_LENGTH(){return 1000;}






// !!! HERE
"tbl" => ( isset($row["tbl"]) ? strval($row["tbl"]) : "" ),
"act" => ( isset($row["act"]) ? strval($row["act"]) : "" ),
"dat" => ( isset($row["dat"]) ? arrval($row["dat"]) : [] ),
"fln" => ( isset($row["fln"]) ? arrval($row["fln"]) : [] ),
"prc" => ( isset($row["prc"]) ? strval($row["prc"]) : "" ),
"req" => ( isset($row["req"]) ? intval($row["req"]) :  0 ),
"a"   => ( isset($row["a"  ]) ? intval($row["a"  ]) :  0 ),
"ntq" => ( isset($row["ntq"]) ? intval($row["ntq"]) :  0 ),
"plu" => ( isset($row["plu"]) ? strval($row["plu"]) : "" ),]);

// make note of this plu and a possible userID connected to it
$GLOBALS["plu"] = $row["plu"];
$GLOBALS["userID"] = queryresult("SELECT ID FROM ftb7_user WHERE plu='".esc($GLOBALS["plu"])."'");

$o = array(
	"sta" =>         1 ,
	"msg" => ""        ,
	"dat" => []        ,
	"int" =>        -1 ,
	"mir" => $row      ,
	"a"   => $row["a"] ,
	"b"   =>         0 ,
	"c"   =>         0 ,
	"d"   =>         0 ,
	"e"   =>         0 ,
	"f"   =>         0);






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**********************************************************************************************************************\
* ERROR CODES (AND OTHER STUFF)                                                                                        *
\**********************************************************************************************************************/
// reserved error codes start at -1000 and go downward
function ERROR_CODE($which){
	switch ($which){default:return ["sta"=>-1001,"msg"=>"Unknown error ... congrats!"];
	break;case "BAD FUNCTION"                : return ["sta"=>-1072,"msg"=>"I have no instructions for that table-action pair."];
	break;case "ANONYMOUS"                   : return ["sta"=>-1073,"msg"=>"You need to be authenticated before you do that; you aren't."];
	break;case "DUPLICATE"                   : return ["sta"=>-1074,"msg"=>"You attempted to create a duplicate data row; request denied."];
	break;case "BAD AUTHENTICATION ID"       : return ["sta"=>-1075,"msg"=>"No account is currently assigned that ID."];
	break;case "BAD AUTHENTICATION NAME"     : return ["sta"=>-1076,"msg"=>"No account is currently using that name."];
	break;case "BAD AUTHENTICATION PASSWORD" : return ["sta"=>-1077,"msg"=>"No account with that ID/name uses that password."];
	break;case "BAD AUTHENTICATION PLUSHIE"  : return ["sta"=>-1078,"msg"=>"No account is currently assigned that plushie."];
	break;case "BAD RATE"                    : return ["sta"=>-9001,"msg"=>"Too... much... data... I can't handle this! ;~;"];}}
function INTERVAL_RARE(){return 60000000;}
//array("board","channel","chart","favorite","friendship","mail","message","participant","post","review","role","score","sticker","stickerOwned","subboard","tag","thread","user");
function DB_TABLE_ARR(){return ["board","post","subboard","thread","threadView","user"];}

$ERR_C_VAL = -1;
function ERR_C(){global $ERR_C_VAL;return $ERR_C_VAL;}
function ERR_C_SET($c){global $ERR_C_VAL;$ERR_C_VAL = $c;return TRUE;}

$ERR_M_VAL = "";
function ERR_M(){global $ERR_M_VAL;return $ERR_M_VAL;}
function ERR_M_SET($m){global $ERR_M_VAL;$ERR_M_VAL = $m;return TRUE;}

$RHO_TABLE = [];

/**********************************************************************************************************************\
* VALIDATION TABLES                                                                                                    *
\**********************************************************************************************************************/
// retrieve rho core validation table
// [e] no
// [r] data
function DBM_VT($table,$action){
	switch ($action){default:return [];
		break;case "del":return ["ID"  => ["type"=>"int"                                   ,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()]];
		break;case "get":return ["IDA" => ["type"=>"intarr","mincount"=>1,"maxcount"=>10000,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()]];
		break;case "new":
			$t = RHO_VT_ALL($table);
			switch ($table){default      :$k = [];
				break;case "board"       :$k = ["name","info","order"];
				break;case "message"     :$k = ["channelID","message"];
				break;case "post"        :$k = ["threadID","message","censored"];
				break;case "subboard"    :$k = ["boardID","name","info","starC","order"];
				break;case "thread"      :$k = ["subboardID","name","message","sticky","locked","censored"];
				break;case "user"        :$k = ["name","password","hco","sco","lco","htx","stx","ltx","hbg","sbg","lbg","a","tzo","bio","iconPath","bgPath","netq","prf"];}
			return arrayKeyRestrict($t,$k);
		break;case "edt":
			$t = RHO_VT_ALL($table);
			switch ($table){default      :$k = [];
				break;case "board"       :$k = ["name","info","order"];
				break;case "message"     :$k = ["message"];
				break;case "post"        :$k = ["message","censored"];
				break;case "subboard"    :$k = ["boardID","name","info","starC","order"];
				break;case "thread"      :$k = ["subboardID","name","message","sticky","locked","censored"];
				break;case "user"        :$k = ["name","password","hco","sco","lco","htx","stx","ltx","hbg","sbg","lbg","a","tzo","bio","iconPath","bgPath","netq","prf"];}
			$res = arrayKeyRestrict($t,$k);
			$res["ID"] = ["type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()];
			return $res;}}

function RHO_VT_ALL($table){
	switch ($table){default:return [];
		break;case "board":return array(
			"name"            => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"info"            => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"order"           => array("type"=>"int","min"=>1,"default"=>1),);
		break;case "post":return array(
			"threadID"        => array("type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()),
			"message"         => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"censored"        => array("type"=>"int","min"=>0,"max"=>1,"default"=>0),);
		break;case "subboard":return array(
			"boardID"         => array("type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()),
			"name"            => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"info"            => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"order"           => array("type"=>"int","min"=>1,"default"=>1),
			"starC"           => array("type"=>"int","min"=>0,"max"=>1,"default"=>0),);
		break;case "thread":return array(
			"subboardID"      => array("type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()),
			"name"            => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"message"         => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"sticky"          => array("type"=>"int","min"=>-1,"max"=>1,"default"=>0),
			"locked"          => array("type"=>"int","min"=>0,"max"=>1,"default"=>0),
			"censored"        => array("type"=>"int","min"=>0,"max"=>1,"default"=>0),);
		break;case "message":return array(
			"channelID"       => array("type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()),
			"userID"          => array("type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()),
			"message"         => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),);
		break;case "user":$hue = random_int(0,1000);return array(
			"name"     => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"password" => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"hco"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>$hue),
			"sco"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>1000),
			"lco"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>500),
			"htx"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>$hue),
			"stx"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>1000),
			"ltx"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>random_int( 900,1000)),
			"hbg"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>0),
			"sbg"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>0),
			"lbg"      => array("type"=>"int","min"=>0,"max"=>1000,"default"=>0),
			"a"        => array("type"=>"int","min"=>0,"max"=>1000,"default"=>random_int( 800, 900)),
			"tzo"      => array("type"=>"int","min"=>DB_INT_MIN(),"max"=>DB_INT_MAX(),"default"=>0),
			"bio"      => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),
			"iconPath" => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>"http://feelthebeats.se/image/blank.png"),
			"bgPath"   => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>"http://feelthebeats.se/image/blank.png"),
			"netq"     => array("type"=>"int","values"=>array(-1,0,1),"default"=>0),
			"prf"      => array("type"=>"str","maxlength"=>DB_TEXT_LENGTH(),"default"=>""),);}}

//----------------------------------------------------------------------------------------------------------------------
// cleaning stuff, root scope injection
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Inbound Cleanse for FtB5 (ic5)
// takes a user input and strips zalgo text. anything else is okay.
function ic5($mystery,$depth=100){
	$depth--;
	if ($depth <= 0){return NULL;}
	if (is_string($mystery)){
		return ic5str($mystery);}
	else if (is_object($mystery)){
		foreach ($mystery as $key => $value){
			$mystery->$key = ic5($value,$depth);}
		return $mystery;}
	else if (is_array($mystery)){
		foreach ($mystery as $key => $value){
			$mystery[$key] = ic5($value,$depth);}
		return $mystery;}
	else{
		return $mystery;}}
function ic5str($mystery){
	return nomnomnomnomnomnomnom($mystery);}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// http://www.php.net/manual/en/function.ord.php comments section
function ords_to_unistr($ords, $encoding = 'UTF-8'){
	// Turns an array of ordinal values into a string of unicode characters
	$str = '';
	for($i = 0; $i < sizeof($ords); $i++){
		// Pack this number into a 4-byte string
		// (Or multiple one-byte strings, depending on context.)
		$v = $ords[$i];
		$str .= pack("N",$v);}
	$str = mb_convert_encoding($str,$encoding,"UCS-4BE");
	return($str);}
function unistr_to_ords($str, $encoding = 'UTF-8'){
	// Turns a string of unicode characters into an array of ordinal values,
	// Even if some of those characters are multibyte.
	$str = mb_convert_encoding($str,"UCS-4BE",$encoding);
	$ords = array();
	// Visit each unicode character
	for($i = 0; $i < mb_strlen($str,"UCS-4BE"); $i++){
		// Now we have 4 bytes. Find their total
		// numeric value.
		$s2 = mb_substr($str,$i,1,"UCS-4BE");
		$val = unpack("N",$s2);
		$ords[] = $val[1];}
	return($ords);}
// weed out combining characters, in UNICODE decimal format #zalgo
function nomnomnomnomnomnomnom($chaosStr){return $chaosStr;
	$chaosArr = unistr_to_ords($chaosStr);
	$orderlyArr = array();
	foreach ($chaosArr as $u){
		if (($u >= 768 && $u <= 879) || ($u >= 1155 && $u <= 1161) || ($u >= 7616 && $u <= 7654) || ($u >= 7676 && $u <= 7679) || ($u >= 8400 && $u <= 8432) || ($u >= 65056 && $u <= 65062) || ($u == 160 /* non breaking space */)){/* combining character sets, manually located from the massive unicode set ;~; */}
		else{$orderlyArr[] = $u;}}
	return ords_to_unistr($orderlyArr);}
// example : vc5(array("a"=>0,"b"=>0,"c"=>0),array("a"=>0),TRUE ) --> array("a"=>0) ... "a" has been validated
// [e] yes
// [r] status
function vc5(&$d,$o,$copyDefaults=TRUE){
	$res = array();
	if (!is_array($d) || !is_array($o)){ERR_M_SET("ERROR : TYPE MISMATCH [WSD'S FAULT]");return FALSE;}
	foreach ($o as $name=>$var){
		if (isset($d[$name])){
			$res[$name] = $d[$name];}
		else if ($copyDefaults){
			if (!isset($var["default"])){ERR_M_SET("ERROR : REQUIRED VARIABLE MISSING : ".$name."[".$var["type"]."]");return FALSE;}
			$res[$name] = $var["default"];}
		if (!isset($var["type"])){ERR_M_SET("ERROR : UNSPECIFIED TYPE [WSD'S FAULT]");return FALSE;}
		// only clean parameters that actually get put in $res
		if (isset($res[$name])){
			// mostly-read-only validation, writes when doing symmetrical type conversions
			switch ($var["type"]){default:ERR_M_SET("ERROR : UNSUPPORTED TYPE [WSD'S FAULT]");return FALSE;
				// type int : min, max, values, gate
				break;case "int"   :if (""!=($_=vc5int($res,$name,$var))){ERR_M_SET($_);return FALSE;}
				// type str : min, max, values, gate
				break;case "str"   :if (""!=($_=vc5str($res,$name,$var))){ERR_M_SET($_);return FALSE;}
				// type int : mincount, maxcount, min, max, values, gate
				break;case "intarr":if (""!=($_=vc5intarr($res,$name,$var))){ERR_M_SET($_);return FALSE;}
				// type str : mincount, maxcount, min, max, values, gate
				break;case "strarr":if (""!=($_=vc5strarr($res,$name,$var))){ERR_M_SET($_);return FALSE;}}}}
	$d = $res;
	return TRUE;}
// validate integer
// [e] no
// [r] blank string on success, filled string on failure, with status information
function vc5int($p,$name,$var){
	// type [re]check
	if (!is_int($p[$name])){
		return "ERROR : ".$name.":".var_export($p[$name],TRUE)." NOT INT";}
	// lower bound [inclusive]
	if (array_key_exists("min",$var)){
		if (!is_int($var["min"])){return "ERROR : MIN NOT INT [WSD'S FAULT]";}
		if ($p[$name] < $var["min"]){return "ERROR : ".$name.":".$p[$name]." IS LESS THAN ".$var["min"];}}
	// upper bound [inclusive]
	if (array_key_exists("max",$var)){
		if (!is_int($var["max"])){return "ERROR : MAX NOT INT [WSD'S FAULT]";}
		if ($p[$name] > $var["max"]){return "ERROR : ".$name.":".$p[$name]." IS GREATER THAN ".$var["max"];}}
	// test against a list of acceptable values
	if (array_key_exists("values",$var)){
		if (!is_array($var["values"])){return "ERROR : VALUES NOT ARR [WSD'S FAULT]";}
		if (!in_array($p[$name],$var["values"],TRUE)){return "ERROR : ".$name.":".$p[$name]." NOT A LEGAL VALUE";}}
	// test against a list of acceptable values
	if (array_key_exists("gate",$var)){
		if (!is_callable($var["gate"])){return "ERROR : GATE NOT FUNCTION [WSD'S FAULT]";}
		if ($var["gate"]($p[$name]) === FALSE){return "ERROR : ".$var["gate"]." GATE CONDITION FAILED";}}
	return "";}
// validate integer array
// [e] no
// [r] blank string on success, filled string on failure, with status information
function vc5intarr($p,$name,$var){
	// type [re]check
	if (!is_array($p[$name])){return "ERROR : ".$name." NOT ARR";}
	// minimum count [inclusive]
	if (array_key_exists("mincount",$var)){
		if (!is_int($var["mincount"])){return "ERROR : MINCOUNT NOT INT [WSD'S FAULT]";}
		if (count($p[$name]) < $var["mincount"]){return "ERROR : ".$name." HAS ".count($p[$name])." ELEMENTS WHEN AT LEAST ".$var["mincount"]." REQUIRED";}}
	// maximum count [inclusive]
	if (array_key_exists("maxcount",$var)){
		if (!is_int($var["maxcount"])){return "ERROR : MAXCOUNT NOT INT [WSD'S FAULT]";}
		if (count($p[$name]) > $var["maxcount"]){return "ERROR : ".$name." HAS ".count($p[$name])." ELEMENTS WHEN NO MORE THAN ".$var["mincount"]." ALLOWED";}}
	// validate each element within
	$loopmax = count($p[$name]);
	for ($iEl = 0; $iEl < $loopmax; $iEl++){
		if (""!=($_=vc5int($p[$name],$iEl,$var))){return $_;}}
	return "";}

// validate string
// [e] no
// [r] blank string on success, filled string on failure, with status information
function vc5str($p,$name,$var){
	// type [re]check
	if (!is_string($p[$name])){
		return "ERROR : ".$name.":".var_export($p[$name],TRUE)." NOT STR";}
	// lower bound on length [inclusive]
	if (array_key_exists("minlength",$var)){
		if (!is_int($var["minlength"])){return "ERROR : MINLENGTH NOT INT [WSD'S FAULT]";}
		if (mb_strlen($p[$name]) < $var["minlength"]){return "ERROR : ".$name.":".$p[$name]." LENGTH IS LESS THAN ".$var["minlength"];}}
	// upper bound on length [inclusive]
	if (array_key_exists("maxlength",$var)){
		if (!is_int($var["maxlength"])){return "ERROR : MAXLENGTH NOT INT [WSD'S FAULT]";}
		if (mb_strlen($p[$name]) > $var["maxlength"]){return "ERROR : ".$name.":".$p[$name]." LENGTH IS GREATER THAN ".$var["maxlength"];}}
	// test against a list of acceptable values
	if (array_key_exists("values",$var)){
		if (!is_array($var["values"])){return "ERROR : VALUES NOT ARR [WSD'S FAULT]";}
		if (!in_array($p[$name],$var["values"],TRUE)){return "ERROR : ".$name.":".$p[$name]." NOT A LEGAL VALUE";}}
	// test against a list of acceptable values
	if (array_key_exists("gate",$var)){
		if (!is_callable($var["gate"])){return "ERROR : GATE NOT FUNCTION [WSD'S FAULT]";}
		if ($var["gate"]($p[$name]) === FALSE){return "ERROR : ".$var["gate"]." GATE CONDITION FAILED";}}
	return "";}
// validate string array
// [e] no
// [r] blank string on success, filled string on failure, with status information
function vc5strarr($p,$name,$var){
	// type [re]check
	if (!is_array($p[$name])){return "ERROR : ".$name." NOT ARR";}
	// minimum count [inclusive]
	if (array_key_exists("mincount",$var)){
		if (!is_int($var["mincount"])){return "ERROR : MINCOUNT NOT INT [WSD'S FAULT]";}
		if (count($p[$name]) < $var["mincount"]){return "ERROR : ".$name." HAS ".count($p[$name])." ELEMENTS WHEN AT LEAST ".$var["mincount"]." REQUIRED";}}
	// maximum count [inclusive]
	if (array_key_exists("maxcount",$var)){
		if (!is_int($var["maxcount"])){return "ERROR : MAXCOUNT NOT INT [WSD'S FAULT]";}
		if (count($p[$name]) > $var["maxcount"]){return "ERROR : ".$name." HAS ".count($p[$name])." ELEMENTS WHEN NO MORE THAN ".$var["mincount"]." ALLOWED";}}
	// validate each element within
	$loopmax = count($p[$name]);
	for ($iEl = 0; $iEl < $loopmax; $iEl++){
		if (""!=($_=vc5str($p[$name],$iEl,$var))){return $_;}}
	return "";}

//----------------------------------------------------------------------------------------------------------------------
// RHO
function RHO_process($in){
	$bTime = currentMicro();
	$out = [];
	while (count($in) > 0){
		$inEx = [];
		foreach ($in as &$row){$out[] = RHO_processSub($row,$inEx);}unset($row);
		$in = $inEx;}
	$eTime = currentMicro();
	foreach ($out as &$row){π_ooAbsorb($row,["b"=>$bTime,"e"=>$eTime]);}unset($row);
	return $out;}
// ??? $_FILES[] index is [[[requestID]]]_[[[filename]]]
function RHO_processSub($row,&$in){
	$cTime = currentMicro();
	π_ooAbsorb($row,[
		"tbl" => ( isset($row["tbl"]) ? strval($row["tbl"]) : "" ),
		"act" => ( isset($row["act"]) ? strval($row["act"]) : "" ),
		"dat" => ( isset($row["dat"]) ? arrval($row["dat"]) : [] ),
		"fln" => ( isset($row["fln"]) ? arrval($row["fln"]) : [] ),
		"prc" => ( isset($row["prc"]) ? strval($row["prc"]) : "" ),
		"req" => ( isset($row["req"]) ? intval($row["req"]) :  0 ),
		"a"   => ( isset($row["a"  ]) ? intval($row["a"  ]) :  0 ),
		"ntq" => ( isset($row["ntq"]) ? intval($row["ntq"]) :  0 ),
		"plu" => ( isset($row["plu"]) ? strval($row["plu"]) : "" ),]);
	
	// make note of this plu and a possible userID connected to it
	$GLOBALS["plu"] = $row["plu"];
	$GLOBALS["userID"] = queryresult("SELECT ID FROM ftb7_user WHERE plu='".esc($GLOBALS["plu"])."'");
	
	$o = array(
		"sta" =>         1 ,
		"msg" => ""        ,
		"dat" => []        ,
		"int" =>        -1 ,
		"mir" => $row      ,
		"a"   => $row["a"] ,
		"b"   =>         0 ,
		"c"   =>         0 ,
		"d"   =>         0 ,
		"e"   =>         0 ,
		"f"   =>         0);
	
	$limitedStop = FALSE;
	if ($GLOBALS["userID"] !== FALSE){
		// add entry to log array
		query("INSERT INTO ftb7_log (plu,t) VALUES ('".esc($GLOBALS["plu"])."','".esc(currentMicro())."')");
		// keep only 100 entries, newest
		$tArr = queryresultarray("SELECT t FROM ftb7_log WHERE plu='".esc($GLOBALS["plu"])."' ORDER BY t DESC LIMIT 100");
		$tArrC = count($tArr);
		if ($tArrC > 0){
			foreach ($tArr as &$t){$t = "'".esc($t)."'";}unset($t);
			query("DELETE FROM ftb7_log WHERE plu='".esc($GLOBALS["plu"])."' AND t NOT IN (".implode(",",$tArr).")");}
		// throttle traffic if log array is super dense, if all requests in log are within such a time distance
		if ($tArrC >= 100){
			$qrra = queryresultrowarray("SELECT MAX(t) AS hi,MIN(t) AS lo FROM ftb7_log WHERE plu='".esc($GLOBALS["plu"])."'");
			if ($qrra[0]["hi"] - $qrra[0]["lo"] < 10000000){
				$limitedStop = TRUE;}}}
	
	if ($limitedStop){π_ooAbsorb($o,ERROR_CODE("BAD RATE"));}
	else{RHO_fxn($row,$row["dat"],$o,$in);}
	
	// outgoing data with post cleaning
	π_ooAbsorb($o,[
		"c"=>$cTime,
		"d"=>currentMicro(),]);
	return $o;}

// the one to call for all your RHO needs ; it has some divert logic, and some hand-off logic
function RHO_fxn(&$p,&$d,&$o,&$in){global $RHO_TABLE;
	$tbl = in_array($p["act"],["dmp","get","new","edt","del"],TRUE) ? "*" : $p["tbl"] ;
	if (!isset($RHO_TABLE[$tbl]) || !isset($RHO_TABLE[$tbl][$p["act"]]) || !is_callable($RHO_TABLE[$tbl][$p["act"]])){π_ooAbsorb($o,ERROR_CODE("BAD FUNCTION"));return;}
	$RHO_TABLE[$tbl][$p["act"]]($p,$d,$o,$in);}


$RHO_TABLE["*"]["dmp"] = function(&$p,&$d,&$o){
	(  DBM_SIU()
	&& vc5($d,DBM_VT($p["tbl"],$p["act"]),TRUE)
	&& DBM_giga($p["tbl"],$p["act"],$d)
	&& DBM_clusterDmp($p["tbl"],$o)
	)||($o["sta"] = ERR_C() xor $o["msg"] = ERR_M());};

$RHO_TABLE["*"]["get"] = function(&$p,&$d,&$o){
	(  DBM_SIU()
	&& vc5($d,DBM_VT($p["tbl"],$p["act"]),TRUE)
	&& DBM_giga($p["tbl"],$p["act"],$d)
	&& DBM_clusterGet($p["tbl"],$d["IDA"],$o)
	)||($o["sta"] = ERR_C() xor $o["msg"] = ERR_M());};

$RHO_TABLE["*"]["new"] = function(&$p,&$d,&$o){
	(  (DBM_SIU() || $p["tbl"]==="user")
	&& vc5($d,DBM_VT($p["tbl"],$p["act"]),TRUE)
	&& DBM_giga($p["tbl"],$p["act"],$d)
	&& DBM_derive($p["tbl"],$p["act"],$d)
	&& DBM_batchNew($p["tbl"],$d,$o)
	)||($o["sta"] = ERR_C() xor $o["msg"] = ERR_M());};

$RHO_TABLE["*"]["edt"] = function(&$p,&$d,&$o){
	(  DBM_SIU()
	&& vc5($d,DBM_VT($p["tbl"],$p["act"]),FALSE)
	&& DBM_giga($p["tbl"],$p["act"],$d)
	&& DBM_derive($p["tbl"],$p["act"],$d)
	&& DBM_batchSet($p["tbl"],$d["ID"],$d,$o)
	)||($o["sta"] = ERR_C() xor $o["msg"] = ERR_M());};

$RHO_TABLE["*"]["del"] = function(&$p,&$d,&$o){
	(  DBM_SIU()
	&& vc5($d,DBM_VT($p["tbl"],$p["act"]),TRUE)
	&& DBM_giga($p["tbl"],$p["act"],$d)
	&& DBM_gigaDelete($p["tbl"],$d["ID"])
	)||($o["sta"] = ERR_C() xor $o["msg"] = ERR_M());};



/**********************************************************************************************************************\
* DMP/GET/NEW/EDIT/DELETE HELPERS                                                                                          *
\**********************************************************************************************************************/

// get database rows by table ... all of them, but limit it by some amount
// meant to be used on parent-less types like board
// !!! allow filter rules to replace some interface-specific things with DMP-class things
// [e] yes
// [r] status
function DBM_clusterDmp($tbl,&$o){
	return DBM_clusterGet($tbl,D_qra("SELECT ID FROM ftb7_".$tbl." ORDER BY ID ASC"),$o);}

// get database rows by table and ID array, stores data in passed o
// [e] yes
// [r] status
function DBM_clusterGet($tbl,$IDA,&$o){
	// get the specified rows
	$o["dat"][$tbl] = D_qrra("SELECT * FROM ftb7_".$tbl." WHERE ID IN (".implode(",",π_map($IDA,function($v){return "'".esc($v)."'";})).")");
	
	// add relation fields
	// hide fields based on performance and permissions
	// likely expiration tagging
	$t = currentMicro();
	$multiGrab = (count($IDA) > 1);
	foreach ($o["dat"][$tbl] as &$v){
		switch ($tbl){default:
		break;case "board":
			$v["subboardIDA"] = D_exrel($tbl,$v["ID"],"subboard");
		break;case "subboard":
			$v["threadIDA"] = D_exrel($tbl,$v["ID"],"thread");
		break;case "thread":
			$v["postIDA"] = D_exrel($tbl,$v["ID"],"post");
		break;case "user":
			unset($v["passwordHash"],$v["human"]);
			if (DBM_UID() !== $v["ID"]){unset($v["plu"],$v["bgPath"]);}
			$v["postIDA"                ] = D_exrel($tbl,$v["ID"],"post");}
		$v["expiration"] = intval(min($t + INTERVAL_RARE(),($t + ($t - $v["timeUpdate"])/2)));}unset($v);
	
	return TRUE;}

// take a batch of key-value pairs and make a new database row of it
// [e] yes
// [r] status
function DBM_batchNew($tbl,$d,&$o){
	// insert
	$queryS = "INSERT INTO `ftb7_".$tbl."` (".implode(",",π_map($d,function($v,$i){return "`".$i."`";})).") VALUES (".implode(",",π_map($d,function($v,$i){return "'".esc($v)."'";})).")";
	$q = query($queryS);if ($q === FALSE){ERR_M_SET("query failed in DBM_batchNew() : ".queryErrorDescription()." : ".$queryS);return FALSE;}
	$insertID = queryInsertId();
	
	// on-insert triggers ; will fail quietly
	if (in_array($tbl,["post","thread","subboard"])){RECALC_boards($tbl,$insertID);}
	
	$o["dat"][$tbl]["new"] = D_qs($tbl,$insertID);
	
	return TRUE;}

// set a batch of key-value pairs of a certain database row
// [e] yes
// [r] status
function DBM_batchSet($tbl,$ID,$d,&$o){
	if (!rowexists("FROM `ftb7_".$tbl."` WHERE ID='".esc($ID)."'")){ERR_M_SET("specified database row [ID:'".esc($ID)."'] missing in DBM_batchSet()");return FALSE;}
	
	$o["dat"][$tbl]["old"] = D_qs($tbl,$ID);
	
	$queryS = "UPDATE `ftb7_".$tbl."` SET ".implode(",",π_map($d,function($v,$i){return "`".$i."`='".esc($v)."'";}))." WHERE ID='".esc($ID)."' LIMIT 1";
	$q = query($queryS);if ($q === FALSE){ERR_M_SET("query failed in DBM_batchSet() : ".queryErrorDescription()." : ".$queryS);return FALSE;}
	
	// on-update triggers ; will fail quietly
	if (in_array($tbl,["post","thread","subboard"])){RECALC_boards($tbl,$ID);}
	
	$o["dat"][$tbl]["new"] = D_qs($tbl,$ID);
	
	return TRUE;}

// delete the row's dependents [chaining], then delete the row [now does this with SQL foreign key relations "cascading delete"]
// [e] yes
// [r] status
function DBM_gigaDelete($tbl,$ID){
	$o["dat"][$tbl]["old"] = D_qs($tbl,$ID);
	
	$row = D_qs($tbl,$ID);
	query("DELETE FROM `ftb7_".$tbl."` WHERE ID='".esc($ID)."'");
	
	// on-delete triggers ; will fail quietly
	if (in_array($tbl,["post","thread","subboard"])){RECALC_boards($tbl,$row[["post"=>"threadID","thread"=>"subboardID","subboard"=>"boardID"][$tbl]],FALSE);}
	
	return TRUE;}

// recalculate DERIVED attributes of a table
// [e] yes
// [r] status
function DBM_recalc($tbl,$ID){
	switch ($tbl){default:
	break;case "subboard":
		$threadC = D_qc("thread","subboardID='".esc($ID)."'");
		$replyC  = array_sum(queryresultarray("SELECT replyC_DERIVED FROM ftb7_thread WHERE subboardID='".esc($ID)."'"));
		$timeUpdateA = queryresultarray("SELECT timeUpdate_DERIVED FROM ftb7_thread WHERE subboardID='".esc($ID)."'");
		$timeUpdate  = (count($timeUpdateA)===0) ? 0 : max($timeUpdateA) ;
		D_qu($tbl,$ID,[
			"threadC_DERIVED"    => $threadC,
			"postC_DERIVED"      => $threadC+$replyC,
			"timeUpdate_DERIVED" => $timeUpdate,]);
	break;case "thread":
		$replyC = D_qc("post","threadID='".esc($ID)."'");
		$viewC  = D_qc("threadView","threadID='".esc($ID)."'");
		$timeUpdateA = queryresultrowarray("(SELECT userID,timeUpdateMessage FROM ftb7_post WHERE threadID='".esc($ID)."') UNION (SELECT userID,timeUpdateMessage FROM ftb7_thread WHERE ID='".esc($ID)."' LIMIT 1)");
		$maxRow = π_reduce($timeUpdateA,function($p,$v){return $p["timeUpdateMessage"]>$v["timeUpdateMessage"]?$p:$v;},["timeUpdateMessage"=>0,"userID"=>0]);
		D_qu($tbl,$ID,[
			"replyC_DERIVED"     => $replyC,
			"viewC_DERIVED"      => $viewC,
			"userID_DERIVED"     => $maxRow["userID"],
			"timeUpdate_DERIVED" => $maxRow["timeUpdateMessage"],]);}
	
	return TRUE;}

// sets derived column values during a "new" or "edt"
// [e] yes
// [r] status
function DBM_derive($tbl,$act,&$d){
	$t = currentMicro();
	switch ($act){default:
	break;case "new":$d["time"] = $t;
	/****/case "edt":$d["timeUpdate"] = $t;}
	switch ($tbl." ".$act){default:
	break;case "board edt"       :
	break;case "board new"       :
	break;case "message edt"     :
	break;case "message new"     :$d["userID"] = DBM_UID();
	break;case "post edt"        :if (isset($d["message"])){$d["timeUpdateMessage"] = $t;}
	break;case "post new"        :if (isset($d["message"])){$d["timeUpdateMessage"] = $t;}$d["userID"] = DBM_UID();
	break;case "subboard edt"    :
	break;case "subboard new"    :
	break;case "thread edt"      :if (isset($d["message"])){$d["timeUpdateMessage"] = $t;}
	break;case "thread new"      :if (isset($d["message"])){$d["timeUpdateMessage"] = $t;}$d["userID"] = DBM_UID();
	break;case "user edt"        :if (isset($d["password"])){$d["passwordHash"] = pHash($d["password"]);unset($d["password"]);}
	break;case "user new"        :
		$d["passwordHash"] = pHash($d["password"]);unset($d["password"]);
		$d["plu"] = DBM_genPlushie();
		$d["starC"] = 0;
		$d["divisionID"] = 0;
		$d["human"] = 1;}
	return TRUE;}

function RECALC_boards($tbl,$ID,$recalcSelf=TRUE){
	$newID = $ID;
	$firstF = TRUE;
	switch ($tbl){default:
	break;case "post"     : if (!($firstF && !$recalcSelf)){DBM_recalc("post"    ,$newID);$newID = D_qs("post"    ,$newID)["threadID"  ];$firstF = FALSE;}DBM_recalc("thread"  ,$newID);
	/****/case "thread"   : if (!($firstF && !$recalcSelf)){DBM_recalc("thread"  ,$newID);$newID = D_qs("thread"  ,$newID)["subboardID"];$firstF = FALSE;}DBM_recalc("subboard",$newID);
	/****/case "subboard" : if (!($firstF && !$recalcSelf)){DBM_recalc("subboard",$newID);$newID = D_qs("subboard",$newID)["boardID"   ];$firstF = FALSE;}DBM_recalc("board"   ,$newID);}}

/**********************************************************************************************************************\
* SPECIALIZED RHO COMMANDS                                                                                             *
\**********************************************************************************************************************/
// EXPERIMENTAL

$RHO_TABLE["KERN"]["clock"] = function(&$p,&$d,&$o){
	$o["dat"]["time"] = currentMicro();
};

$RHO_TABLE["KERN"]["ping"] = function(&$p,&$d,&$o){
	$o["dat"]["res"] = DB_TEXT_LENGTH();
	$o["dat"]["clr"] = DBM_CLR(1)?"T":"F";
};

// feeds the historical hamster
// doing this cleans up some server-side data
$RHO_TABLE["KERN"]["FEED_HAMSTER"] = function(&$p,&$d,&$o){};

// AUTHENTICATION AND NEW ACCOUNTS

$RHO_TABLE["n/a"]["ftb575_authenticate"] = function(&$p,&$d,&$o){
	// attempt plushie sign in
	if (vc5($d,[
		"plu" => ["type"=>"str","maxlength"=>DB_TEXT_LENGTH()],
	])){
		$ID = D_qr("SELECT ID FROM ftb7_user WHERE plu='".esc($d["plu"])."' LIMIT 1");
		if ($ID === FALSE){π_ooAbsorb($o,ERROR_CODE("BAD AUTHENTICATION PLUSHIE"));return;}}
	// then attempt ID sign in
	else if (vc5($d,[
		"ID"       => ["type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()],
		"password" => ["type"=>"str","maxlength"=>DB_PASSWORD_LENGTH()],
	])){
		$row = D_qs("user",$d["ID"]);
		if ($row === FALSE){π_ooAbsorb($o,ERROR_CODE("BAD AUTHENTICATION ID"));return;}
		if (!pVerify($d["password"],$row["passwordHash"])){π_ooAbsorb($o,ERROR_CODE("BAD AUTHENTICATION PASSWORD"));return;}
		$ID = $d["ID"];}
	// then attempt name sign in
	else if (vc5($d,[
		"name"     => ["type"=>"str","maxlength"=>DB_USERNAME_LENGTH()],
		"password" => ["type"=>"str","maxlength"=>DB_PASSWORD_LENGTH()],
	])){
		$userO = D_qrra("SELECT ID,passwordHash FROM ftb7_user WHERE name='".esc($d["name"])."'");
		if ($userO === FALSE || count($userO) === 0){π_ooAbsorb($o,ERROR_CODE("BAD AUTHENTICATION NAME"));return;}
		$ID = FALSE;
		foreach ($userO as $row){
			if (pVerify($d["password"],$row["passwordHash"])){
				$ID = $row["ID"];
				break;}}
		if ($ID === FALSE){π_ooAbsorb($o,ERROR_CODE("BAD AUTHENTICATION PASSWORD"));}}
	else{$o["sta"] = ERR_C();$o["msg"] = ERR_M();return;}
	$plu = DBM_genPlushie();
	π_ooAbsorb($o["dat"],["ID"=>$ID,"plu"=>$plu]);
	D_qu("user",$ID,["plu"=>$plu]);
};
$RHO_TABLE["n/a"]["ftb575_threadView"] = function(&$p,&$d,&$o){
	if (!vc5($d,[
		"threadID" => ["type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()],
	])){π_ooAbsorb($o,["sta"=>-1,"msg"=>ERR_M()]);return;}
	$t = currentMicro();
	if (query("INSERT INTO ftb7_threadView (threadID,userID,time,timeUpdate) VALUES ('".esc($d["threadID"])."','".esc(DBM_UID())."','".esc($t)."','".esc($t)."')") === FALSE){
		query("UPDATE ftb7_threadView SET timeUpdate='".esc($t)."' WHERE threadID='".esc($d["threadID"])."' AND userID='".esc(DBM_UID())."' LIMIT 1");}
	RECALC_boards("thread",$d["threadID"]);};
$RHO_TABLE["n/a"]["ftb575_who"] = function(&$p,&$d,&$o){
	DBM_clusterGet("user",[DBM_UID()],$o);}; //$o["dat"]["user"][0] = D_qs("user",DBM_UID());

/**********************************************************************************************************************\
* PERMISSIONS GATE                                                                                                     *
\**********************************************************************************************************************/
// whether current guest has adequate permissions to perform an action
// get/new/edt/del clr/all tableArr[] $d
// DBM_giga("channel","get",$d);
// [e] no
// [r] status
function DBM_giga($tbl,$act,$d){
	ERR_M_SET("Invalid Permissions");
	switch ($tbl){default:
	break;case "board":
		switch ($act){default:
		break;case "dmp":return DBM_CLR(-1);
		break;case "get":return DBM_CLR(-1);
		break;case "new":return DBM_CLR( 1);
		break;case "edt":return DBM_CLR( 1);
		break;case "del":return DBM_CLR( 1);}
	// !!!
	break;case "channel":
		switch ($act){default:
		break;case "dmp":return T;
		break;case "get":return T;
		break;case "new":return T;
		break;case "edt":return T;
		break;case "del":return T;}
	break;case "post":
		$directPostOwnership = isset($d["ID"]) && rowexists("FROM ftb7_post p WHERE p.ID='".esc($d["ID"])."' AND p.userID='".esc(DBM_UID())."'");
		$theoreticalSubboardClearance = isset($d["threadID"]) && DBM_CLR(queryresult("SELECT s.starC FROM ftb7_subboard s,ftb7_thread t WHERE s.ID=t.subboardID AND t.ID='".esc($d["threadID"])."'"));
		$threadNotLocked = isset($d["threadID"]) && rowexists("FROM ftb7_thread WHERE ID='".esc($d["threadID"])."' AND locked='".esc(0)."'");
		$blockConditionCensored = (isset($d["censored"]) && !DBM_CLR(1));
		$blockConditionMessage = (isset($d["message"]) && !$directPostOwnership);
		switch ($act){default:
		break;case "dmp":return FALSE;
		break;case "get":return DBM_CLR(-1);
		break;case "new":return $theoreticalSubboardClearance && $threadNotLocked && !$blockConditionCensored;
		break;case "edt":return ($directPostOwnership && !$blockConditionCensored) || (DBM_CLR( 1) && !$blockConditionMessage);
		break;case "del":return DBM_CLR(1) || $directPostOwnership;}
	break;case "subboard":
		switch ($act){default:
		break;case "dmp":return FALSE;
		break;case "get":return DBM_CLR(-1);
		break;case "new":return DBM_CLR( 1);
		break;case "edt":return DBM_CLR( 1);
		break;case "del":return DBM_CLR( 1);}
	break;case "thread":
		$directThreadOwnership = isset($d["ID"]) && rowexists("FROM ftb7_thread t WHERE t.ID='".esc($d["ID"])."' AND t.userID='".esc(DBM_UID())."'");
		$theoreticalSubboardClearance = isset($d["subboardID"]) && DBM_CLR(queryresult("SELECT s.starC FROM ftb7_subboard s WHERE s.ID='".esc($d["subboardID"])."'"));
		$blockConditionSticky = (isset($d["sticky"]) && !DBM_CLR(1));
		$blockConditionMessage = (isset($d["message"]) && !$directThreadOwnership);
		switch ($act){default:
		break;case "dmp":return FALSE;
		break;case "get":return DBM_CLR(-1);
		break;case "new":return $theoreticalSubboardClearance && !$blockConditionSticky;
		break;case "edt":return ($directThreadOwnership && !$blockConditionSticky) || (DBM_CLR( 1) && !$blockConditionMessage);
		break;case "del":return DBM_CLR( 1) || $directThreadOwnership;}
	// !!!
	break;case "message":
		switch ($act){default:
		break;case "dmp":return T;
		break;case "get":return T;
		break;case "new":return T;
		break;case "edt":return T;
		break;case "del":return T;}
	break;case "user":
		$directUserOwnership = isset($d["ID"]) && $d["ID"]===DBM_UID();
		switch ($act){default:
		break;case "dmp":return DBM_CLR(-1);
		break;case "get":return DBM_CLR(-1);
		break;case "new":return DBM_CLR(-1);
		break;case "edt":return $directUserOwnership;
		break;case "del":return DBM_CLR( 1) || $directUserOwnership;}}
	return F;}

// !!! need a way to point to current core, not hardcoded
function KERN_selfCore($command="",$parameters=array()){
	return;
	$shinkansen = array(
		"command"=>$command,
		"parameters"=>$parameters,
		"process"=>"",
		"sequence"=>0,
		"timestamp"=>0,
		"quality"=>0,
		"files"=>0);
	return KERN_selfCoreEX($shinkansen);}
function KERN_selfCoreEX($shinkansen){return;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://feelthebeats.se/shelf/core/chi.php");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // return the transfer as a string
	curl_setopt($ch,CURLOPT_POST,count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS,"shinkansen=".urlencode(json_encode($shinkansen)));
	$output = curl_exec($ch);
	curl_close($ch);
	
	return $output;}

function DBM_genPlushie(){
	$charSet = array(
		"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
		"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
		"0","1","2","3","4","5","6","7","8","9");
	$charSetC = count($charSet);
	$plu = "";for ($_ = 0; $_ < 60; $_++){$plu .= $charSet[random_int(0,$charSetC-1)];}
	return $plu;}

function DBM_UID(){
	if (!isset($GLOBALS["userID"])){return 0;}
	if (!is_int($GLOBALS["userID"])){return 0;}
	if ($GLOBALS["userID"] < 1){return 0;}
	return $GLOBALS["userID"];}
// is current user signed in with a valid userID? [Signed-In User]
// [e] yes
// [r] status
function DBM_SIU(){
	$res = (DBM_UID() >= 1);
	if (!$res){ERR_M_SET(ERROR_CODE("ANONYMOUS")["msg"]);}
	return $res;}
// does ID exist in table?
function DBM_validID($table,$ID){
	if (!is_string($table)){return FALSE;}
	if (!is_int($ID)){return FALSE;}
	return rowexists("FROM `ftb7_".$table."` WHERE ID='".esc($ID)."'");}
// does current user have high enough clearance for FtB?
function DBM_CLR($min){
	if (!DBM_SIU()){return -1;}
	if (!is_int($min)){return FALSE;}
	$access = queryresult("SELECT starC FROM ftb7_user WHERE ID='".esc(DBM_UID())."'");
	if ($access === FALSE){$access = -1;}
	if (!is_int($access)){return FALSE;}
	return $access >= $min;}
// does current user own this row?
function DBM_rowCLR($table,$ID){
	if ($table == "mail"){
		return rowexists("FROM ftb7_".$table." WHERE ID ='".esc($ID)."' AND userID_target='".esc(UID())."'");}
	else{
		return rowexists("FROM ftb7_".$table." WHERE ID ='".esc($ID)."' AND userID='".esc(UID())."'");}}

function KERN_MSG($m,$level=0){query("INSERT INTO ftbX_log (level,msg,time) VALUES ('".esc($level)."','".esc($m)."','".esc(currentMicro())."')");}
function ll($m){KERN_MSG($m);}

function generateBgPath($userID){global $EXTERNAL_BGS_GATE_PATH;
	return $EXTERNAL_BGS_GATE_PATH."?userID=".$userID;}
?>
