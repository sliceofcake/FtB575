<?

define("T",TRUE);
define("F",FALSE);
define("N",NULL);

//----------------------------------------------------------------------------------------------------------------------
// root scope injection
// PASSWORD_BCRYPT --> first 72Bytes maximum considered
function pHash($password){return password_hash($password,PASSWORD_BCRYPT,array("cost"=>10));} // cost:10 takes 84ms on 13 Feb 2016, varies by multiples of 2
function pVerify($password,$hash){return password_verify($password,$hash);}
// split each char in unicode mode
function mb_str_split($str){
	return preg_split('//u',$str,-1,PREG_SPLIT_NO_EMPTY);}
function is_assoc($arr){
	return array_keys($arr) !== range(0,count($arr) - 1);}
function normalize($n){return ($n > 0) ? 1 : (($n < 0) ? -1 : 0);}
function currentMicro(){
	return intval(microtime(TRUE)*1000000);}
function arrval($mystery){
	if (!is_array($mystery)){return array();}
	return $mystery;}
// whether passed variable is a boring string ; boring means letters, numbers, underscores - also not starting with a number
// [e] no
// [r] status
function is_boring($m){
	if (!is_string($m)){return FALSE;}
	if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/',$m) !== 1){return FALSE;}
	return TRUE;}

// only allow keys from keyArr to appear in modified arr
// [e] no
// [r] data
function arrayKeyRestrict($arr,$keyArr){
	$res = array();
	foreach ($arr as $key=>$value){
		if (in_array($key,$keyArr)){$res[$key] = $value;}}
	return $res;}
//
function π_ooAbsorb(&$o,$oo){
	foreach ($oo as $k=>$v){
		$o[$k] = $v;}}
//
function π_map($A,$fxn){
	$res = [];
	foreach ($A as $i=>$k){
		$res[] = $fxn($k,$i);} // leaving off $A, scared yet unsure about performance hit
	return $res;}
//
function π_reduce($A,$fxn,$initial=NULL){
	$accumulator = $initial;
	foreach ($A as $k=>$v){
		if ($accumulator === NULL){$accumulator = $A[$k];continue;}
		$accumulator = $fxn($accumulator,$A[$k],$k);} // leaving off $A, scared yet unsure about performance hit
	return $accumulator;};
?>
