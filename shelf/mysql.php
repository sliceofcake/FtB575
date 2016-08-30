<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

/* sliceofcake.se */
mb_internal_encoding("UTF-8");
/* use utf8 or better for character encoding */
/* use double quotes for your php query strings, and single quotes for the params */
$ERROR_LOG_PATH = "/home/ftbsliceofcake2/logs/feelthebeats.se/mysql/";
$SQL_HOSTNAME="127.0.0.1";
$SQL_USERNAME="ftbdb";
require("/home/ftbsliceofcake2/secret/mysql_7.php");
$SQL_DB="ftbdb7";
$SQL_LINK = mysqli_connect($SQL_HOSTNAME,$SQL_USERNAME,$SQL_PASSWORD,$SQL_DB);
$DB_LINK = $SQL_LINK;
// check connection
if (mysqli_connect_errno()){
	$bigData = file_get_contents($ERROR_LOG_PATH."mysql_errors.txt");
	$bigData = $bigData.date("F j, Y [H:i]",time()).":".mysqli_connect_error()."\n";
	file_put_contents($ERROR_LOG_PATH."mysql_errors.txt",$bigData,LOCK_EX);
	echo "Connect failed: ".mysqli_connect_error();
	exit();}
mysqli_set_charset($SQL_LINK,"utf8mb4");
//----
function isValidQuery($res){
	return $res !== FALSE && $res instanceof mysqli_result;}
function query($query){
	global $SQL_LINK;
	return mysqli_query($SQL_LINK,$query);}
//----^converted



// http://php.net/manual/en/mysqli.constants.php
// TINYINT   - MYSQLI_TYPE_TINY
// SMALLINT  - MYSQLI_TYPE_SHORT
// MEDIUMINT - MYSQLI_TYPE_INT24
// INT       - MYSQLI_TYPE_LONG
// BIGINT    - MYSQLI_TYPE_LONGLONG
// TEXT      - MYSQLI_TYPE_TINY_BLOB
function result($res,$row,$field=0){
	if (!isValidQuery($res)){return FALSE;} // validate $res
	if (!($res->data_seek($row))){return FALSE;} // validate $row
	$datarow = $res->fetch_array(MYSQLI_ASSOC);
	$keys = array_keys($datarow);
	// validate $field
	if ($field === 0){
		if (count($datarow) == 0){return FALSE;}
		$fieldIndex = array_search($keys[$field],$keys);
		$field = $keys[$field];}
	else{
		if (!array_key_exists($field,$datarow)){return FALSE;}
		$fieldIndex = array_search($field,$keys);}
	$castToInt = in_array(mysqli_fetch_field_direct($res,$fieldIndex)->type,array(MYSQLI_TYPE_TINY,MYSQLI_TYPE_SHORT,MYSQLI_TYPE_INT24,MYSQLI_TYPE_LONG,MYSQLI_TYPE_LONGLONG));
	//mysqli_free_result($res);
	return ($castToInt) ? (int)$datarow[$field] : $datarow[$field];}
// transforms a query string into an array of transformed row arrays
function queryresultrowarray($str){
	$q = query($str);
	if ($q !== FALSE){
		return resultrowarray($q);}
	else{
		return FALSE;}}
// transforms all the rows of a query into arrays, stores in one large, numerically-indexed array
function resultrowarray($res,$onlyTheseColumns=array()){
	$arr = array();
	for ($i = 0; $i < rows($res); $i++){
		$arr[] = resultrow_HELPER($res,$i,$onlyTheseColumns);}
	return $arr;}
// transforms the first row of a query into an array
function resultrow($res,$row=0,$onlyTheseColumns=array()){
	return resultrow_HELPER($res,$row,$onlyTheseColumns);}
function resultrow_HELPER($res,$row,$onlyTheseColumns=array()){
	if (!isValidQuery($res)){return FALSE;} // validate $res
	if (!($res->data_seek($row))){return FALSE;} // validate $row
	$onlyTheseColumns_COUNT = count($onlyTheseColumns);
	$datarow = $res->fetch_array(MYSQLI_ASSOC);
	$keys = array_keys($datarow);
	$ret = array();
	foreach ($keys as $value){
		if ($onlyTheseColumns_COUNT == 0 || in_array($value,$onlyTheseColumns,TRUE)){
			$ret[$value] = result($res,$row,$value);}}
	return $ret;}
function rows($query){
	if (!isValidQuery($query)){
		return 0;}
	else{
		return mysqli_num_rows($query);}}
function queryresult($str){
	if (mb_stripos($str,"limit ") === FALSE && mb_stripos($str,"count(") === FALSE){
		$str .= " LIMIT 1";}
	$q = query($str);
	if ($q !== FALSE){
		return result($q,0);}
	else{
		return FALSE;}}
function queryresultarray($str){
	$arr = array();
	$q = query($str);
	if ($q !== FALSE){
		for ($i = 0; $i < rows($q); $i++){
			$arr[] = result($q,$i);}
		return $arr;}
	else{
		return FALSE;}}
function esc($str){
	global $SQL_LINK;
	return mysqli_real_escape_string($SQL_LINK,$str);}
function escl($str){
	$str = esc($str);
	$str = str_replace('%','\%',$str);
	$str = str_replace('%','\%',$str);
	return $str;}
function rowexists($str){
	// validate str
	$q = query("SELECT 1 ".$str);
	if (!isValidQuery($q)){return FALSE;}
	return queryresult("SELECT EXISTS (SELECT 1 ".$str.")")?TRUE:FALSE;}
function queryErrorDescription(){
	global $SQL_LINK;
	return mysqli_error($SQL_LINK);}
function queryInsertId(){
	global $SQL_LINK;
	return (int)mysqli_insert_id($SQL_LINK);}
function queryAffectedRows(){
	global $SQL_LINK;
	return (int)mysqli_affected_rows($SQL_LINK);}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// test if returned query data object is valid
function db_isValidQuery($res){return ($res !== FALSE && $res instanceof mysqli_result);}

// start a transaction
function db_head($type=MYSQLI_TRANS_START_READ_WRITE){global $DB_LINK;
	mysqli_begin_transaction($DB_LINK,$type);}

// commit the transaction
function db_tail(){global $DB_LINK;
	mysqli_commit($DB_LINK);}

// make a query
function db_q($queryS){global $DB_LINK;
	return mysqli_query($DB_LINK,$queryS);}

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

// get a string of stats
function db_stat(){global $DB_LINK;return mysqli_stat($DB_LINK);}

?>
