<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

require_once("butler.php");
//require_once("mysql.php");
//----------------------------------------------------------------------------------------------------------------------
// DATABASE-SPECIFIC TO FTB7
// query UPDATE
function D_qu($tbl,$ID,$arr){
	if (!in_array($tbl,DB_TABLE_ARR(),T)){SET_RETURN_MSG("invalid table:".str($tbl)." passed to D_qu()");return F;}
	if (!isI($ID)){SET_RETURN_MSG("invalid ID:".str($ID)." passed to D_qu()");return F;}
	if (!isA($arr)){SET_RETURN_MSG("invalid arr:".str($paramArr)." passed to D_qu()");return F;}
	π_aaa($arr,["t1"=>π_now()]);
	$partSA = [];
	foreach ($arr as $k=>$v){
		if (isBoringS($k)){
			$partSA[] = "`".$k."`='".esc($v)."'";}}
	// this gate will always return T, but keep it here just in case this code changes in the future, allowing $partSA to be an empty array at this step
	if (count($partSA) > 0){
		$queryS = "UPDATE `".$tbl."` SET ".implode(",",$partSA)." WHERE ID='".esc($ID)."' LIMIT 1";}
	$q = db_q($queryS);if ($q === F){SET_RETURN_MSG("query failed in D_qu() : ".queryErrorDescription()." : ".$queryS);return F;}
	return T;}
function D_qi($tbl,$arr){
	if (!in_array($tbl,DB_TABLE_ARR(),T)){SET_RETURN_MSG("invalid table:".str($tbl)." passed to D_qu()");return F;}
	if (!isA($arr)){SET_RETURN_MSG("invalid arr:".str($paramArr)." passed to D_qu()");return F;}
	$ID = K_genID($tbl);
	$t = π_now();
	π_aaa($arr,["ID"=>$ID,"t0"=>$t,"t1"=>$t]);
	$kSA = [];
	$vSA = [];
	foreach ($arr as $k=>$v){
		if (isBoringS($k)){
			$kSA[] = "`".$k."`";
			$vSA[] = "'".esc($v)."'";}}
	if (count($kSA) === 0){SET_RETURN_MSG("failure in D_qi() : empty property collection");return F;}
	$queryS = "INSERT INTO ".$tbl." (".implode(",",$kSA).") VALUES (".implode(",",$vSA).")";
	$q = db_q($queryS);if ($q === F){SET_RETURN_MSG("query failed in D_qi() : ".db_errInfo()." : ".$queryS);return F;}
	return $ID;}
function D_qd($tbl,$ID){
	if (!in_array($tbl,DB_TABLE_ARR(),T)){SET_RETURN_MSG("invalid table:".str($tbl)." passed to D_qu()");return F;}
	if (!isI($ID)){SET_RETURN_MSG("invalid ID:".str($ID)." passed to D_qu()");return F;}
	// !!! hardcoded files to delete, maybe in the #next-core, we'll have files treated in an even more standardized way
	switch ($tbl){default:;
		break;case "chart":
			$oldE = D_qs($tbl,$ID);
			if ($oldE === F){SET_RETURN_MSG("could not retrieve entity while trying to get its metadata in order to properly delete it");return F;}
			unlink(ROOT()["DIR_FILE"].$tbl."/txtR_".str($ID).$oldE["txtRExtension_DERIVED"]);
			unlink(ROOT()["DIR_FILE"].$tbl."/icoR_".str($ID).$oldE["icoRExtension_DERIVED"]);
	}
	db_q("DELETE FROM ".$tbl." WHERE ID='".esc($ID)."' LIMIT 1");
	return T;}
// query SELECT COUNT(*)
function D_qc($tbl,$fragment){
	if (!in_array($tbl,DB_TABLE_ARR(),T)){SET_RETURN_MSG("invalid table:".str($tbl)." passed to D_qu()");return F;}
	return queryresult("SELECT COUNT(*) FROM ".$tbl." WHERE ".$fragment);}
// query SELECT * FROM tbl matching ID
function D_qs($tbl,$ID,$exrelA=[],$readLock=F){
	if (!isI($ID)||$ID<1){return F;}
	$qrra = db_qrra("SELECT * FROM ".$tbl." WHERE ID='".esc($ID)."' LIMIT 1".($readLock?" FOR UPDATE":""));
	if ($qrra === F || count($qrra) === 0){
		return F;}
	else{
		rowReturnFilter($tbl,$qrra[0],$exrelA,F);
		return $qrra[0];}}
// query SELECT * FROM tbl matching IDA
function D_qsA($tbl,$IDA,$exrelA,$readLock=F){
	$IDA = π_filter($IDA,function($v){return isI($v)&&$v>=1;});
	if (count($IDA) === 0){return [];}
	$qrra = db_qrra("SELECT * FROM ".$tbl." WHERE ID IN (".implode(",",π_map($IDA,function($v){return "'".esc($v)."'";})).")".($readLock?" FOR UPDATE":""));
	if ($qrra === F || count($qrra) === 0){
		return F;}
	else{
		π_forEach($qrra,function(&$row)use($tbl,$exrelA,$IDA){rowReturnFilter($tbl,$row,$exrelA,count($IDA)>=1);});
		return $qrra;}}
// performs basic post-processing on a row NOT having to do with permissions
function rowReturnFilter($tbl,&$row,$exrelA,$multiGrab=F){
	// • add relation fields
	// • likely expiration tagging
	$t = π_now();
	switch ($tbl){default:
		break;case "channel":
			if (in_array("message"    ,$exrelA,T)){$row["messageIDA"    ] = D_exrel($tbl,$row["ID"],"message"    );}
			if (in_array("participant",$exrelA,T)){$row["participantIDA"] = D_exrel($tbl,$row["ID"],"participant");}
		break;case "message":
		break;case "participant":
		break;case "user_plushie":
		break;case "user":
			if (in_array("message"    ,$exrelA,T)){$row["messageIDA"    ] = D_exrel($tbl,$row["ID"],"message"    );}
			if (in_array("participant",$exrelA,T)){$row["participantIDA"] = D_exrel($tbl,$row["ID"],"participant");}
			if (in_array("plushie"    ,$exrelA,T)){$row["plushieIDA"    ] = D_exrel($tbl,$row["ID"],"plushie"    );}}
	$row["_tStale"] = int(min($t + INTERVAL_RARE(),($t + ($t - $row["t1"])/2)));}

// extract relational IDs
function D_exrel($tbl,$ID,$tblRel){
	return db_qra("SELECT DISTINCT(ID) FROM ".$tblRel." WHERE ".$tbl."ID='".esc($ID)."' ORDER BY ID ASC");}



function ll($m,$level=0){db_q("INSERT INTO debug (lvl,msg,t) VALUES ('".esc($level)."','".esc(π_jsonE($m))."','".esc(π_now())."')");}

function generateBgPath($userID){global $EXTERNAL_BGS_GATE_PATH;
	return $EXTERNAL_BGS_GATE_PATH."?userID=".$userID;}


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
	if (!isI($GLOBALS["userID"])){return 0;}
	if ($GLOBALS["userID"] < 1){return 0;}
	return $GLOBALS["userID"];}
// is current user signed in with a valid userID? [Signed-In User]
// [e] yes
// [r] status
function DBM_SIU(){
	$res = (DBM_UID() >= 1);
	if (!$res){SET_RETURN_MSG("anonymous");return F;}
	return $res;}
// does the current user have the given clearance level?
// 0 - unknown user
// 1 - signed in
// 2 - staff member
// 3 - division leader
function DBM_CLR($starC){
	return F;}
// does ID exist in table?
function DBM_validID($tbl,$ID){
	if (!is_string($tbl)){return FALSE;}
	if (!is_int($ID)){return FALSE;}
	return rowexists("FROM ".$tbl." WHERE ID='".esc($ID)."'");}
// does current user own this row?
function DBM_rowCLR($tbl,$ID){
	if ($table == "mail"){
		return rowexists("FROM ".$tbl." WHERE ID ='".esc($ID)."' AND userID_target='".esc(DBM_UID())."'");}
	else{
		return rowexists("FROM ".$tbl." WHERE ID ='".esc($ID)."' AND userID='".esc(DBM_UID())."'");}}





//----------------------------------------------------------------------------------------------------------------------
// K
// expects $tbl to be cleaned/valid
function K_genID($tbl){
	do{$ID = π_rand(DB_ID_MIN(),DB_ID_MAX());}
	while($ID<=99999 || db_rowExists("FROM ".$tbl." WHERE ID='".esc($ID)."'"));
	return $ID;}



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





//----------------------------------------------------------------------------------------------------------------------
// VC6 - Variable Cleanse Version 6
// return whether input data comforms to normative set, with first issue message
function vc6(&$p,$normative){
	$dat = [];
	$flO = [];
	// remove extra data
	//$p["dat"] = π_filter($p["dat"],function($v,$propertyS)use($normative){return kInA($propertyS,$normative)&&$normative[$propertyS]["type"]!=="fil";});
	//$p["flO"] = π_filter($p["flO"],function($v,$propertyS)use($normative){return kInA($propertyS,$normative)&&$normative[$propertyS]["type"]==="fil";});
	// verify normative template
	foreach ($normative as $propertyS=>$rule){
		if (!kInA("type"       ,$rule)){SET_RETURN_MSG("ERROR(VC6) : rule.type missing"    );return F;}
		if (!kInA("requiredNow",$rule)){SET_RETURN_MSG("ERROR(VC6) : rule.required missing");return F;} // whether the property must be included, depending on the action
		if (!kInA("required"   ,$rule)){$rule["required"] = $rule["requiredNow"];} // whether the property must always exist
		if (!kInA("help"       ,$rule)){SET_RETURN_MSG("ERROR(VC6) : rule.help missing"    );return F;}
		//----
		switch ($rule["type"]){default:SET_RETURN_MSG("ERROR(VC6) : rule.type illegal value");return F;
			break;case "int"   :
			/***/;case "intarr":
			/***/;case "str"   :
			/***/;case "strarr":if (!kInA($propertyS,$p["dat"])){if ($rule["requiredNow"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." not defined");return F;}else{continue 2;}}
			break;case "fil"   :if (!kInA($propertyS,$p["flO"])){if ($rule["requiredNow"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." not defined");return F;}else{continue 2;}}}
		switch ($rule["type"]){default:SET_RETURN_MSG("ERROR(VC6) : rule.type illegal value");return F;
			break;case "int"   :if (!vc6int   ($propertyS,$p["dat"][$propertyS],$rule)){return F;}
			break;case "intarr":if (!vc6intarr($propertyS,$p["dat"][$propertyS],$rule)){return F;}
			break;case "str"   :if (!vc6str   ($propertyS,$p["dat"][$propertyS],$rule)){return F;}
			break;case "strarr":if (!vc6strarr($propertyS,$p["dat"][$propertyS],$rule)){return F;}
			break;case "fil"   :if (!vc6fil   ($propertyS,$p["flO"][$propertyS],$rule)){return F;}}
		switch ($rule["type"]){default:SET_RETURN_MSG("ERROR(VC6) : rule.type illegal value");return F;
			break;case "int"   :
			/***/;case "intarr":
			/***/;case "str"   :
			/***/;case "strarr":$dat[$propertyS] = $p["dat"][$propertyS];
			break;case "fil"   :$flO[$propertyS] = $p["flO"][$propertyS];}}
	$p["dat"] = $dat;
	$p["flO"] = $flO;
	return T;}
function vc6fil($propertyS,$v,$rule){
	if ($v["size"] === 0){ // dessert // !!! eventually change this to somehow be N-set, because a blank file should be valid
		if (kInA("required",$rule) && $rule["required"]){
			SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." CANNOT BE REMOVED");return F;}
		else{return T;}}
	if (!isA($v)                                                     ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT FIL"                                        );return F;}
	if ($v["error"] !== 0                                            ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." RETURNED PHP ERROR CODE : ".$v["error"]         );return F;}
	if (array_key_exists("min" ,$rule) && $v["size"] < $rule["min"]  ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS SMALLER THAN ".$rule["min"]." Bytes"         );return F;}
	if (array_key_exists("max" ,$rule) && $v["size"] > $rule["max"]  ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS LARGER THAN ".$rule["max"]." Bytes"          );return F;}
	if (array_key_exists("gate",$rule) && !$rule["gate"]($v)         ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." DID NOT PASS GATE FUNCTION"                     );return F;}
	return T;}
function vc6int($propertyS,$v,$rule){
	if ($v === N){ // dessert
		if (kInA("required",$rule) && $rule["required"]){
			SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." CANNOT BE REMOVED");return F;}
		else{return T;}}
	if (!isI($v)                                                     ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT INT"                                        );return F;}
	if (array_key_exists("min" ,$rule) && $v < $rule["min"]          ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS LESS THAN ".$rule["min"]                     );return F;}
	if (array_key_exists("max" ,$rule) && $v > $rule["max"]          ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS GREATER THAN ".$rule["max"]                  );return F;}
	if (array_key_exists("vA"  ,$rule) && !in_array($v,$rule["vA"],T)){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT A LEGAL VALUE FROM ".var_export($rule["vA"]));return F;}
	if (array_key_exists("gate",$rule) && !$rule["gate"]($v)         ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." DID NOT PASS GATE FUNCTION"                     );return F;}
	return T;}
function vc6str($propertyS,$v,$rule){
	if ($v === N){ // dessert
		if (kInA("required",$rule) && $rule["required"]){
			SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." CANNOT BE REMOVED");return F;}
		else{return T;}}
	if (!isS($v)                                                      ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT STR"                                        );return F;}
	if (array_key_exists("min" ,$rule) && mb_strlen($v) < $rule["min"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS SHORTER THAN ".$rule["min"]                  );return F;}
	if (array_key_exists("max" ,$rule) && mb_strlen($v) > $rule["max"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS LONGER THAN ".$rule["max"]                   );return F;}
	if (array_key_exists("vA"  ,$rule) && !in_array($v,$rule["vA"],T) ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT A LEGAL VALUE FROM ".var_export($rule["vA"]));return F;}
	if (array_key_exists("gate",$rule) && !$rule["gate"]($v)          ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." DID NOT PASS GATE FUNCTION"                     );return F;}
	return T;}
function vc6intarr($propertyS,$v,$rule){
	if ($v === N){ // dessert
		if (kInA("required",$rule) && $rule["required"]){
			SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." CANNOT BE REMOVED");return F;}
		else{return T;}}
	if (!isA($v)                                                   ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT ARR"                                                                          );return F;}
	if (array_key_exists("minC",$rule) && count($v) < $rule["minC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO FEW ELEMENTS - ".count($v)." WHEN AT LEAST ".$rule["minC"]." REQUIRED"    );return F;}
	if (array_key_exists("maxC",$rule) && count($v) > $rule["maxC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO MANY ELEMENTS - ".count($v)." WHEN NO MORE THAN ".$rule["maxC"]." ALLOWED");return F;}
	foreach ($v as $propertyS_sub=>$v_sub){
		if (!vc6int($propertyS_sub,$v_sub,$rule)){return F;}}
	return T;}
function vc6strarr($propertyS,$v,$rule){
	if ($v === N){ // dessert
		if (kInA("required",$rule) && $rule["required"]){
			SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." CANNOT BE REMOVED");return F;}
		else{return T;}}
	if (!isA($v)                                                   ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT ARR"                                                                          );return F;}
	if (array_key_exists("minC",$rule) && count($v) < $rule["minC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO FEW ELEMENTS - ".count($v)." WHEN AT LEAST ".$rule["minC"]." REQUIRED"    );return F;}
	if (array_key_exists("maxC",$rule) && count($v) > $rule["maxC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO MANY ELEMENTS - ".count($v)." WHEN NO MORE THAN ".$rule["maxC"]." ALLOWED");return F;}
	foreach ($v as $propertyS_sub=>$v_sub){
		if (!vc6str($propertyS_sub,$v_sub,$rule)){return F;}}
	return T;}




?>
