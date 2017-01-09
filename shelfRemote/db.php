<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

// PHP preserves order in its associative arrays
mb_internal_encoding("UTF-8");
require_once("librarian.php");
require_once("butler.php");
// maximum safe integers:
//     9007199254740991 JavaScript, because every number is secretly a floating point value
//  9223372036854775807 PHP, PHP_INT_MAX on 64-bit server
// 18446744073709551615 MySQL, UNSIGNED BIGINT
class DB{
	public static $tblWhitelist = ["board","subboard","thread","threadView","post","chart","tag","user"];
	public static $errA = [];
	public static $dbPath = N; // filled immediately after
	public static $filePath = N; // filled immediately after
	public static $IDMin = 0;
	public static $IDMinArtificial = 1000000; // the first some number are reserved
	public static $IDMax = 9007199254740991; // JavaScript max
	public static function genID(){
		return π_rand(self::$IDMinArtificial,self::$IDMax);}
	public static function calcPathRow($tbl,$ID){ // specific row
		if (!vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		if (!isI($ID)){self::$errA[] = "illegal ID";return F;}
		$path = self::$dbPath.$tbl."/".$ID.".txt";
		if (!isPathAboveBasePath($path,self::$dbPath)){self::$errA[] = "path not above (".$path." ... ".self::$dbPath.")";return F;} // the final gate of correctness
		return $path;}
	public static function calcPathTbl($tbl){ // base table folder for rows
		if (!vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		$path = self::$dbPath.$tbl."/";
		if (!isPathAboveBasePath($path,self::$dbPath)){self::$errA[] = "path not above";return F;} // the final gate of correctness
		return $path;}
	public static function calcPathTblFil($tbl){ // base table folder for files
		if (!vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		$path = self::$filPath.$tbl."/";
		if (!isPathAboveBasePath($path,self::$filPath)){self::$errA[] = "path not above";return F;} // the final gate of correctness
		return $path;}
	public static function calcPathFil($tbl,$ID,$k,$extension=N){ // specific file property of a row
		if ($extension === N){
			$E = DB::get($tbl,$ID);
			if ($E === F){self::$errA[] = "get failed";return F;}
			if (!kInA($k."Extension_DERIVED",$E)){self::$errA[] = "extension not found";return F;}
			$extension = $E[$k."Extension_DERIVED"];}
		if (!isBoringS($tbl)){self::$errA[] = "ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-1]";return F;}
		if (!isBoringS($k)){self::$errA[] = "ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-2]";return F;}
		if (!vInA($extension,FILE_EXTENSION_WHITELIST())){self::$errA[] = "ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-3]";return F;}
		if (!isI($ID)){self::$errA[] = "ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-4]";return F;}
		$path = ROOT()["DIR_FILE"]."/".$tbl."/".$k."/".str($ID).$extension;
		if (!isPathAboveBasePath($path,ROOT()["DIR_FILE"])){return F;} // the final gate of correctness
		return $path;}
	// the obstinate logic goes in locking the file ... I wrote this function without paying attention to why I was doing it, but keeping it here just in case for the future
	/*public static function fopenObstinate($path,$mode){
		$waitCycleT = 1000;
		$waitTotalT = 0;
		$waitMaxT = 1000000;
		for (;;){
			$handle = @fopen($path,$mode);if ($handle === F){
				$waitTotalT += $waitCycleT;
				if ($waitTotalT > $waitMaxT){
					return F;}
				usleep($waitCycleT);
				$waitCycleT = ceil($waitCycleT*1.1);}
			else{break;}}
		return $handle;}*/
	// by default, flock blocks. OR the mode with LOCK_NB for NoBlock
	public static function flockObstinate($handle,$type){
		$waitCycleT = 1000;
		$waitTotalT = 0;
		$waitMaxT = 1000000;
		for (;;){
			$status = flock($handle,$type);if ($status === F){
				$waitTotalT += $waitCycleT;
				if ($waitTotalT > $waitMaxT){
					return F;}
				usleep($waitCycleT);
				$waitCycleT = ceil($waitCycleT*1.1);}
			else{break;}}
		return T;}
	//----
	public static function calcModificationT($tbl,$ID){
		if (!isS($tbl) || !vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		if (!isI($ID) || $ID < self::$IDMin || $ID > self::$IDMax){self::$errA[] = "illegal ID";return F;}
		//----
		$path = self::calcPathRow($tbl,$ID);if ($path === F){return F;}
		clearstatcache(); // !!! for filemtime ... but I hope to someday rely on the cache
		$secondC = @filemtime($path);if ($secondC === F){return F;}
		return $secondC*1000000;}
	//----
	// for setup purposes, run before ever doing db stuff
	public static function verifyFileStructure(){
		clearstatcache(); // for is_dir
		
		// ---- db ----
		if (!is_dir(self::$dbPath)){
			$status = @mkdir(self::$dbPath,0755);if ($status === F){self::$errA[] = "mkdir failed";return F;}}
		// delete extra folders
		$filenameA = @scandir(self::$dbPath,SCANDIR_SORT_NONE);if ($filenameA === F){self::$errA[] = "scandir failed";return F;}
		foreach ($filenameA as $filename){
			if ($filename === "." || $filename === ".."){continue;}
			if (vInA($filename,self::$tblWhitelist)){continue;}
			$status = rmComplete(self::$dbPath.$filename);if ($status === F){self::$errA[] = "rmComplete failed";return F;}}
		// add missing folders
		foreach (self::$tblWhitelist as $tbl){
			$path = self::$dbPath.$tbl;
			$dirExistsF = is_dir($path);if ($dirExistsF === F){
				$status = @mkdir($path,0755);if ($status === F){self::$errA[] = "mkdir failed";return F;}}}
		
		// ---- file ----
		if (!is_dir(self::$filePath)){
			$status = @mkdir(self::$filePath,0755);if ($status === F){self::$errA[] = "mkdir failed";return F;}}
		// delete extra folders
		$filenameA = @scandir(self::$filePath,SCANDIR_SORT_NONE);if ($filenameA === F){self::$errA[] = "scandir failed";return F;}
		foreach ($filenameA as $filename){
			if ($filename === "." || $filename === ".."){continue;}
			if (vInA($filename,self::$tblWhitelist)){continue;}
			$status = rmComplete(self::$filePath.$filename);if ($status === F){self::$errA[] = "rmComplete failed";return F;}}
		// add missing folders
		foreach (self::$tblWhitelist as $tbl){
			$path = self::$filePath.$tbl;
			$dirExistsF = is_dir($path);if ($dirExistsF === F){
				$status = @mkdir($path,0755);if ($status === F){self::$errA[] = "mkdir failed";return F;}}
			$normative = DBM_VT_COMPLETE();if (!kInA($tbl,$normative)){continue;} // ignore-case
			foreach ($normative[$tbl] as $propertyS=>$ruleE){
				if (kInA("type",$ruleE) && $ruleE["type"] === "fil"){
					$path = self::$filePath.$tbl."/".$propertyS;
					$dirExistsF = is_dir($path);if ($dirExistsF === F){
						$status = @mkdir($path,0755);if ($status === F){self::$errA[] = "mkdir failed";return F;}}}}}
		return T;}
	
	// LOCKING
	
	/*public static function acquireGlobalLock($exclusiveF=F){
		$path = self::$pathGlobalLock;
		// ensure the file exists, or ... at least ~attempt~
		$handle = @fopen($path,"x");if ($handle !== F){
			$status = fclose($handle);if ($status === F){self::$errA[] = "[acquireGlobalLock] fclose-x failed";return F;}}
		$handle = @fopen($path,"r");if ($handle === F){self::$errA[] = "[acquireGlobalLock] fopen-r failed";return F;}
		$status = self::flockObstinate($handle,($exclusiveF?LOCK_EX:LOCK_SH)|LOCK_NB);if ($status === F){self::$errA[] = "[acquireGlobalLock] flock-".($exclusiveF?"EX":"SH")." failed too many times";return F;}
		return $handle;}
	
	public static function releaseGlobalLock($handle){
		$status = flock($handle,LOCK_UN|LOCK_NB);if ($status === F){self::$errA[] = "[releaseGlobalLock] flock-UN failed";return F;}
		$status = fclose($handle);if ($status === F){self::$errA[] = "[releaseGlobalLock] fclose failed";return F;}
		return T;}*/
	
	//----
	
	// !!!
	public static function clrAll(){
		// wipe the file and db folders
		rmComplete(self::$filePath);
		rmComplete(self::$dbPath);
		self::verifyFileStructure();}
	
	// !!! needs to call del() to properly clean up file-files
	// for testing purposes
	public static function clr($tbl){
		if (!isS($tbl) || !vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		//----
		$path = self::calcPathTbl($tbl);if ($path === F){return F;}
		rmComplete($path);
		$path = self::calcPathTblFil($tbl);if ($path === F){return F;}
		rmComplete($path);
		self::verifyFileStructure();
		/*$filenameA = @scandir($path,SCANDIR_SORT_NONE);if ($filenameA === F){self::$errA[] = "[clr] scandir failed";return F;}
		foreach ($filenameA as $filename){
			if ($filename === "." || $filename === ".."){continue;}
			$status = @unlink($path.$filename);if ($status === F){self::$errA[] = "[clr] unlink failed";return F;}}*/
		return T;}
	
	// !!! poke to see if row exists
	public static function pke($tbl){}
	
	// dump IDA
	public static function dmp($tbl){
		if (!isS($tbl) || !vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		//----
		$IDA = [];
		$path = self::calcPathTbl($tbl);if ($path === F){return F;}
		$filenameA = @scandir($path,SCANDIR_SORT_NONE);if ($filenameA === F){self::$errA[] = "[clr] scandir failed";return F;}
		foreach ($filenameA as $filename){
			if ($filename === "." || $filename === ".."){continue;}
			$dotPosN = mb_strpos($filename,".");
			if ($dotPosN === F){continue;} // ! normally not an error, but what the heck is this not having an extension for?
			$IDS = mb_substr($filename,0,$dotPosN);
			if (!isNumStr($IDS)){continue;}
			$ID = int($IDS);
			$IDA[] = $ID;}
		return $IDA;}
	
	// note : even though LOCK_SH seems like it shouldn't do anything, it's a blank opt-in for the locking system - without it, it would plow through the locking system without caring
	public static function get($tbl,$ID){
		if (!isS($tbl) || !vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		if (!isI($ID) || $ID < self::$IDMin || $ID > self::$IDMax){self::$errA[] = "illegal ID";return F;}
		//----
		$path = self::calcPathRow($tbl,$ID);if ($path === F){return F;}
		$handle = @fopen($path,"r");if ($handle === F){self::$errA[] = "[get] fopen failed";return F;}
		$status = self::flockObstinate($handle,LOCK_SH|LOCK_NB);if ($status === F){self::$errA[] = "[get] flock-SH failed too many times";return F;}
		clearstatcache(); // for filesize
		$byteC = @filesize($path);if ($byteC === F){self::$errA[] = "[get] filesize failed";return F;}
		$raw = fread($handle,$byteC);if ($raw === F){self::$errA[] = "[get] fread failed";return F;}
		$dat = json_decode($raw,T);if ($dat === N){self::$errA[] = "[get] json_decode failed ".$byteC;return F;}
		return $dat;}
	
	public static function new($tbl,$row,$fileEA=[]){
		if (!isS($tbl) || !vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		if (!isA($row)){self::$errA[] = "illegal row";return F;}
		//----
		// we may get unlucky with ID collisions and end up having to try many possibilities
		$i = 0;
		for (;;){
			$ID = self::genID();
			$path = self::calcPathRow($tbl,$ID);if ($path === F){return F;}
			$handle = @fopen($path,"x");if ($handle === F){
				if ($i >= 10){
					self::$errA[] = "[new] fopen failed too many times";return F;}
				$i++;}
			else{break;}}
		$row["_ID"] = $ID;
		// file storage
		foreach ($fileEA as $filename=>$fileE){
			$extension = π_calcFileExtensionProvided($fileE["name"]);
			$filPath = DB::calcPathFil($tbl,$ID,$filename,$extension);
			move_uploaded_file($fileE["tmp_name"],$filPath);
			$row[$filename."Extension_DERIVED"] = $extension;}
		$raw = json_encode($row);if ($raw === F){self::$errA[] = "[new] json_encode failed";return F;}
		$status = self::flockObstinate($handle,LOCK_EX|LOCK_NB);if ($status === F){self::$errA[] = "[new] flock-EX failed too many times";return F;}
		$byteC = fwrite($handle,$raw);if ($byteC === F){self::$errA[] = "[new] fwrite failed";return F;}
		// ! flush output before releasing the lock
		$status = fflush($handle);if ($status === F){self::$errA[] = "[new] fflush failed";return F;}
		$status = flock($handle,LOCK_UN|LOCK_NB);if ($status === F){self::$errA[] = "[new] flock-UN failed";return F;}
		$status = fclose($handle);if ($status === F){self::$errA[] = "[new] fclose failed";return F;}
		return $ID;}
	
	public static function edt($tbl,$ID,$row,$fileEA=[]){
		if (!isS($tbl) || !vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		if (!isI($ID) || $ID < self::$IDMin || $ID > self::$IDMax){self::$errA[] = "illegal ID";return F;}
		if (!isA($row)){self::$errA[] = "illegal row";return F;}
		//----
		$path = self::calcPathRow($tbl,$ID);if ($path === F){return F;}
		$handle = @fopen($path,"r+");if ($handle === F){self::$errA[] = "[edt] fopen failed";return F;}
		$status = self::flockObstinate($handle,LOCK_EX|LOCK_NB);if ($status === F){self::$errA[] = "[edt] flock-EX failed too many times";return F;}
		clearstatcache(); // for filesize
		$byteC = @filesize($path);if ($byteC === F){self::$errA[] = "[edt] filesize failed";return F;}
		$raw = fread($handle,$byteC);if ($raw === F){self::$errA[] = "[edt] fread failed";return F;}
		$dat = json_decode($raw,T);if ($dat === N){self::$errA[] = "[edt] json_decode failed";return F;}
		foreach ($row as $k=>$v){
			if ($v === N){
				unset($dat[$k]);}
			else{
				$dat[$k] = $v;}}
		// file storage
		foreach ($fileEA as $filename=>$fileE){
			$extension = π_calcFileExtensionProvided($fileE["name"]);
			$filPath = DB::calcPathFil($tbl,$ID,$filename,$extension);
			if ($fileE["size"] === 0){
				$status = @unlink($filPath);if ($status === F){self::$errA[] = "[edt] unlink failed";return F;}
				unset($dat[$filename."Extension_DERIVED"]);}
			else{
				$status = move_uploaded_file($fileE["tmp_name"],$filPath);if ($status === F){self::$errA[] = "[edt] move_uploaded_file failed";return F;}
				$dat[$filename."Extension_DERIVED"] = $extension;}}
		$raw = json_encode($dat);if ($raw === F){self::$errA[] = "[edt] json_encode failed";return F;}
		$status = ftruncate($handle,0);if ($status === F){self::$errA[] = "[edt] ftruncate failed";return F;}
		$status = rewind($handle);if ($status === F){self::$errA[] = "[edt] rewind failed";return F;}
		$byteC = fwrite($handle,$raw);if ($byteC === F){self::$errA[] = "[edt] fwrite failed";return F;}
		// ! flush output before releasing the lock
		$status = fflush($handle);if ($status === F){self::$errA[] = "[edt] fflush failed";return F;}
		$status = flock($handle,LOCK_UN|LOCK_NB);if ($status === F){self::$errA[] = "[edt] flock-UN failed";return F;}
		$status = fclose($handle);if ($status === F){self::$errA[] = "[edt] fclose failed";return F;}
		return T;}
	
	public static function del($tbl,$ID){
		if (!isS($tbl) || !vInA($tbl,self::$tblWhitelist)){self::$errA[] = "illegal tbl";return F;}
		if (!isI($ID) || $ID < self::$IDMin || $ID > self::$IDMax){self::$errA[] = "illegal ID";return F;}
		//----
		$path = self::calcPathRow($tbl,$ID);if ($path === F){return F;}
		$E = DB::get($tbl,$ID);if ($E === F){self::$errA[] = "get failed";return F;}
		if (!kInA($tbl,DBM_VT_COMPLETE())){self::$errA[] = "tbl not found";return F;}
		// foreach data pair
		$ruleA = DBM_VT_COMPLETE()[$tbl];
		foreach ($ruleA as $k=>$rule){
			// if the type if a file
			if (kInA("type",$rule) && $rule["type"] === "fil"){
				// if the extension is set and not N, find it and delete it
				if (!kInA($k."Extension_DERIVED",$E)){continue;}
				$extension = $E[$k."Extension_DERIVED"];if ($extension === N){continue;}
				$filPath = DB::calcPathFil($tbl,$ID,$k,$extension);if ($filPath === F){return F;}
				$status = @unlink($filPath);if ($status === F){self::$errA[] = "[del] unlink failed";return F;}}}
		$status = @unlink($path);if ($status === F){self::$errA[] = "[del] unlink failed";return F;}
		return T;}
}
DB::$dbPath               = ROOT()["DIR_DATABASE"];
DB::$filePath             = ROOT()["DIR_FILE"];
/*
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// test if returned query data object is valid
function db_isValidQuery($res){return ($res !== F && $res instanceof mysqli_result);}

// start a transaction
function db_head($type=MYSQLI_TRANS_START_READ_WRITE){global $DB_LINK;
	mysqli_begin_transaction($DB_LINK,$type);}

// commit the transaction
function db_tail(){global $DB_LINK;
	mysqli_commit($DB_LINK);}

// rollback the transaction, instead of committing it
function db_tailUndo(){global $DB_LINK;
	mysqli_rollback($DB_LINK);}

// query
// make a query
function db_q($queryS){global $DB_LINK;
	return mysqli_query($DB_LINK,$queryS);}

// http://php.net/manual/en/mysqli.constants.php
// TINYINT   - MYSQLI_TYPE_TINY
// SMALLINT  - MYSQLI_TYPE_SHORT
// MEDIUMINT - MYSQLI_TYPE_INT24
// INT       - MYSQLI_TYPE_LONG
// BIGINT    - MYSQLI_TYPE_LONGLONG
// TEXT      - MYSQLI_TYPE_TINY_BLOB
// result
// get the result from a query
function db_r($res,$row,$field=0){
	if (!db_isValidQuery($res)){return F;} // validate $res
	if (!($res->data_seek($row))){return F;} // validate $row
	$datarow = $res->fetch_array(MYSQLI_ASSOC);
	$keys = array_keys($datarow);
	// validate $field
	if ($field === 0){
		if (count($datarow) === 0){return F;}
		$fieldIndex = array_search($keys[$field],$keys);
		$field = $keys[$field];}
	else{
		if (!array_key_exists($field,$datarow)){return F;}
		$fieldIndex = array_search($field,$keys);}
	$castToInt = in_array(mysqli_fetch_field_direct($res,$fieldIndex)->type,array(MYSQLI_TYPE_TINY,MYSQLI_TYPE_SHORT,MYSQLI_TYPE_INT24,MYSQLI_TYPE_LONG,MYSQLI_TYPE_LONGLONG));
	//mysqli_free_result($res);
	return ($castToInt) ? (int)$datarow[$field] : $datarow[$field];}

// queryresult
// make a query and return the first row on success or F on failure
function db_qr($queryS){global $DB_LINK;
	if (mb_stripos($queryS,"LIMIT ") === F && mb_stripos($queryS,"COUNT(") === F){ // not diamond, but works for how I use it
		$queryS .= " LIMIT 1";}
	$q = db_q($queryS);
	return ($q === F) ? F : db_r($q,0);}

// queryresultarray
function db_qra($str){
	$arr = [];
	$q = db_q($str);
	if ($q !== F){
		for ($rowMI = 0,$rowMC = db_calcRowC($q); $rowMI < $rowMC; $rowMI++){
			$arr[] = result($q,$rowMI);}
		return $arr;}
	else{
		return F;}}

// queryresultrowarray
// transforms a query string into an array of transformed row arrays
function db_qrra($queryS,$onlyTheseColumns=N){//ll("db_qrra()");
	$q = db_q($queryS);
	return ($q === F ? F : db_rra($q,$onlyTheseColumns));}

// resultrowarray
// transforms all the rows of a query into arrays, stores in one large, numerically-indexed array
function db_rra($res,$onlyTheseColumns=N){//ll("db_rra()");
	$arr = [];
	for ($resI = 0,$C = db_calcRowC($res); $resI < $C; $resI++){
		$arr[] = db_rrSub($res,$resI,$onlyTheseColumns);}
	return $arr;}

// resultrow
// transforms the first row of a query into an array
function q_rr($res,$row=0,$onlyTheseColumns=N){//ll("db_rr()");
	return db_rrSub($res,$row,$onlyTheseColumns);}

// resultrowSub
function db_rrSub($res,$row,$onlyTheseColumns=N){//ll("db_rrSub()");
	if (!db_isValidQuery($res)){return F;} // validate $res
	if (!($res->data_seek($row))){return F;} // validate $row
	$datarow = $res->fetch_array(MYSQLI_ASSOC);
	$keyA = array_keys($datarow);
	$ret = [];
	foreach ($keyA as $key){
		if ($onlyTheseColumns === N || in_array($key,$onlyTheseColumns,T)){
			$ret[$key] = result($res,$row,$key);}}
	return $ret;}

// return the number of rows in a result
function db_calcRowC($query){
	return (db_isValidQuery($query) ? mysqli_num_rows($query) : 0);}

function db_rowExists($str){
	// validate str
	$q = db_q("SELECT 1 ".$str);
	if (!db_isValidQuery($q)){return F;}
	return db_qr("SELECT EXISTS (SELECT 1 ".$str.")")?T:F;}

// make a multi-query
// Use "FOR UPDATE" at the end of SELECT queries to lock properly [http://dev.mysql.com/doc/refman/5.7/en/innodb-locking-reads.html]
// " [QUOTE HEAD]
// To implement reading and incrementing the counter, first perform a locking read of the counter using FOR UPDATE, and then increment the counter. For example:
// SELECT counter_field FROM child_codes FOR UPDATE;
// UPDATE child_codes SET counter_field = counter_field + 1;
// A SELECT ... FOR UPDATE reads the latest available data, setting exclusive locks on each row it reads. Thus, it sets the same locks a searched SQL UPDATE would set on the rows.
// " [QUOTE TAIL]
function db_mq($querySA){global $DB_LINK;
	$resA = [];
	foreach($querySA as $i=>$queryS){
		db_head(MYSQLI_TRANS_START_READ_WRITE);
		$resA[] = db_q($queryS);
		db_tail();}
	return $resA;}

// error information
function db_errInfo(){
	global $SQL_LINK;
	return mysqli_error($SQL_LINK);}

function db_insertID(){
	global $SQL_LINK;
	return (int)mysqli_insert_id($SQL_LINK);}

// get a string of stats
function db_stat(){global $DB_LINK;return mysqli_stat($DB_LINK);}
*/
?>
