<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

// PHP uses "copy-on-write", which will reference until a change to the variable, THEN it will duplicate it

define("T",TRUE);
define("F",FALSE);
define("N",NULL);
function int($m,$fallback=0){return is_numeric($m)?intval($m):$fallback;}
function str($m){return isA($m)?π_jsonE($m):strval($m);} // strval will fail on arrays beyond PHP 5.3ish
function num($m,$fallback=0){return is_numeric($m)?floatval($m):$fallback;}
function isI($m){return is_int($m);}
function isN($m){return is_int($m)||is_float($m);}
function isS($m){return is_string($m);}
function isF($m){return is_bool($m);}
function isA($m){return is_array($m);}
/*function isD($m){
	if (!is_array($m)){return F;}
	$kA = array_keys($arr);
	for ($kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){
		
	}
	return  && array_keys($arr);}*/
function isNumStr($m){return is_string($m) && is_numeric($m);}
function isBoringS($m){return is_string($m)&&mb_ereg_match('^[a-zA-Z0-9_]*$',$m);} // for some reason, this doesn't want surrounding slashes
function isFxn($m){return is_callable($m);}

function kInA($k,$a){return array_key_exists($k,$a);}
function vInA($v,$a){return in_array($v,$a,T);}

$RETURN_MSG = "";
function GET_RETURN_MSG(  ){global $RETURN_MSG;return $RETURN_MSG;}
function SET_RETURN_MSG($m){global $RETURN_MSG;$RETURN_MSG = str($m);}

// !!! HERE
//----------------------------------------------------------------------------------------------------------------------
// root scope injection
function π_now(){return intval(microtime(T)*1000000);}
function π_jsonE($m,$fallback=N){$_ = json_encode($m);return ($_===F?$fallback:$_);}
function π_jsonD($m,$fallback=N){return json_decode($m,T);} // returns N on error, regardless of fallback, because N could be a valid decoding
function π_forEach(&$vA,$fxn){
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		$fxn($v,$k,$vA);}}
function π_some(&$vA,$fxn){
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		if ($fxn($v,$k,$vA)){
			return T;}}
	return F;}
function π_map(&$vA,$fxn){
	$res = [];
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		$res[$k] = $fxn($v,$k,$vA);}
	return $res;}
function π_mapFilter(&$vA,$fxn,$vBlank=F){
	$res = [];
	$traditionalF = T;
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];
		if ($k !== $kAI){
			$traditionalF = F;
			break;}}
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		$vv = $fxn($v,$k,$vA);
		if ($vv !== $vBlank){
			if ($traditionalF){
				$res[] = $vv;}
			else{
				$res[$k] = $vv;}}}
	return $res;}
function π_reduce(&$vA,$fxn,$accumulator=N){ // cannot start accumulator to N on purpose, because this will treat that as not-set
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		if ($kAI === 0 && $accumulator === N){$accumulator = $v;continue;}
		$accumulator = $fxn($accumulator,$v,$k,$vA);}
	return $accumulator;}
function π_filter(&$vA,$fxn){ // !!! here for numbered arrays redo the keys
	$res = [];
	$traditionalF = T;
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];
		if ($k !== $kAI){
			$traditionalF = F;
			break;}}
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		if ($fxn($v,$k,$vA)){
			if ($traditionalF){
				$res[] = $v;}
			else{
				$res[$k] = $v;}}}
	return $res;}
function π_find(&$vA,$fxn){
	$res = [];
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		if ($fxn($v,$k,$vA)){
			return $v;}}
	return F;}
function π_findIndex(&$vA,$fxn){
	$res = [];
	for ($kA = array_keys($vA),$kAI = 0,$kAC = count($kA); $kAI < $kAC; $kAI++){$k = $kA[$kAI];$v = &$vA[$k];
		if ($fxn($v,$k,$vA)){
			return $k;}}
	return F;}
// array <- array absorb
function π_aaa(&$o,$oo){
	foreach ($oo as $k=>$v){
		$o[$k] = $v;}}
// random integer, doubly inclusive bounds
function π_rand($lo,$hi){
	return random_int($lo,$hi);}
function π_calcFileExtensionProvided($filenameS){
	if ($filenameS === "."){return ".";}
	$posN = mb_strrpos($filenameS,".");
	if ($posN === F){return "";}
	$extension = mb_substr($filenameS,$posN);
	if (!in_array($extension,FILE_EXTENSION_WHITELIST(),T)){return "";}
	return $extension;}
//
function π_pathToContentType($pathS){
	$posN = mb_strrpos($pathS,"/");
	if ($posN === F){
		$filenameS = $pathS;}
	else{
		$filenameS = mb_substr($pathS,$posN);}
	switch (π_calcFileExtensionProvided($filenameS)){default:return "text/plain";
		break;case ".jpg":case ".jpeg":return "image/jpg";
		break;case ".png":return "image/png";
		break;case ".gif":return "image/gif";
		break;case ".txt":return "text/plain";
		break;case ".osu":return "text/plain";}}
//
function calcDBPath($internalOrExternalS,$tbl,$propertyS,$ID,$extension){
	if (!vInA($tbl,DB::$tblWhitelist)){return F;}
	if (!isBoringS($propertyS)){return F;}
	if (!isI($ID)){return F;}
	if (!vInA($extension,FILE_EXTENSION_WHITELIST())){return F;}
	switch ($internalOrExternalS){default:return F;
		break;case "internal":
			$root = ROOT()["DIR_FILE"];
			$path = $root.$tbl."/".$propertyS."/".str($ID).$extension;
			if (!isPathAboveBasePath($path,$root)){return F;} // the final gate of correctness
			return $path;
		break;case "external":
			$root = ROOT()["EXT_FILE"];
			$path = $root."?tbl=".$tbl."&propertyS=".$propertyS."&ID=".str($ID)."&extension=".$extension;
			; // no correctness checking, since the path is external, every possibility is considered safe
			return $path;}}
// returns a F fallback if any issue occurs - used like this : "if this returns true, it's safe to proceed, otherwise fail"
function isPathAboveBasePath($path,$pathBase){
	// !!! realpath() doesn't work on non-existent files, unfortunately. I'm not comfortable writing my own right now, so fail on dots
	if (preg_match('/^\./' ,$path    ) === 1){return F;} // starts with dot
	if (preg_match('/^\./' ,$pathBase) === 1){return F;} // starts with dot
	if (preg_match('/\.$/' ,$path    ) === 1){return F;} // ends with dot
	if (preg_match('/\.$/' ,$pathBase) === 1){return F;} // ends with dot
	if (preg_match('/\/\./',$path    ) === 1){return F;} // dot hugs start of slash
	if (preg_match('/\/\./',$pathBase) === 1){return F;} // dot hugs start of slash
	if (preg_match('/\.\//',$path    ) === 1){return F;} // dot hugs end of slash
	if (preg_match('/\.\//',$pathBase) === 1){return F;} // dot hugs end of slash
	//$path     = realpath($path    );if ($path     === F){return F;}
	//$pathBase = realpath($pathBase);if ($pathBase === F){return F;}
	if (mb_strlen($path) < mb_strlen($pathBase)){return F;} // not long enough so it can't possibly match [to avoid any possible issues with substr overflow]
	return mb_substr($path,0,mb_strlen($pathBase)) === $pathBase;}
// carbon copy [deep copy]
// "Why do you need carbon copy in PHP? I thought PHP had array assignment by copy!"
// 2 November 2016 - hit an extremely bizarre case where PHP array copies are not by assignment.
// Here is printout [via var_dump($_)] of two variables that should have been exactly the same
// array(11) { ["tbl"]=> string(3) "n/a" ["act"]=> string(20) "FtB575_1|plushie_gen" ["dat"]=> &array(2) { ["nameS"]=> string(11) "sliceofcake" ["passwordS"]=> string(11) "sliceofcake" } ["fil"]=> array(0) { } ["ntq"]=> int(0) ["req"]=> int(114) ["who"]=> int(0) ["plu"]=> string(0) "" ["a"]=> int(1478145732902090) ["flA"]=> &array(0) { } ["prc"]=> string(0) "" }
// array(11) { ["tbl"]=> string(4) "n/a" ["act"]=> string(20) "FtB575_1|plushie_gen" ["dat"]=> array(2) { ["nameS"]=> string(11) "sliceofcake" ["passwordS"]=> string(11) "sliceofcake" } ["fil"]=> array(0) { } ["ntq"]=> int(0) ["req"]=> int(114) ["who"]=> int(0) ["plu"]=> string(0) "" ["a"]=> int(1478139468066165) ["flA"]=> array(0) { } ["prc"]=> string(0) "" }
// as you can see, some of the variables are [somehow] referenced, and those references carry over when you attempt to use the equals-sign-operator to copy the array
function π_cc($m){
	if (is_array($m)){
		$res = [];
		foreach ($m as $k=>$v){
			$res[$k] = π_cc($v);}
		return $res;}
	else{return $m;}}

function K_adjectiveArr(){return array("Dubious","Dastardly","Fantastic","Confusing","Misunderstood","Limited Edition","Upgraded","CG","Unrivaled","Relocated","Offshore","Akiba","Angry","Forgotten","Infamous","Sparkling","After-School","Poorly-Hidden","Sekrit","Embarrassing","World-Famous","Saucy","Unlimited","Brilliant","Pre-Ordered","Over-Hyped","Wondrous","Shiny","Distracting","Discontinued","Underground","Evanescent","Shocking","Bankrupt","Overdue","Tsundere");}
function K_animalArr(){return array("Penguin","Cat","Turtle","Giraffe","Lion","Polar Bear","Dolphin","Elephant","Dog","Lamb","Sheep","Budgie","Bunny","Rabbit","Tea","Grizzly Bear","Koi","Hippo","Llama","Alpaca","Amagi","Hen","Rooster","Horse","Trout","Rhinoceros","Squirrel","Seal");}
function K_nounArr(){return array("Planetarium","Debate","Forest","Island","Doujinshi","Meteor","Software","Database","Museum","Maid Café","Bite","Detective","Hideout","Time","Cosplay","Novel","Sticker Book","Arcade Game","Park","Headquarters","Guild","Magazine","Manor","Shrine","Pond","Reef","Mountain","Jungle","Onsen","Paradise","Oasis","Dystopia","Collection","Pillow","Blanket","Box","Plot","Sticker","Party","Tower","Monument","Airlift","Airdrop");}
function K_genChannelName(){
	$adjective = K_adjectiveArr()[random_int(0,count(K_adjectiveArr())-1)];
	$animal    = K_animalArr()   [random_int(0,count(K_animalArr()   )-1)];
	$noun      = K_nounArr()     [random_int(0,count(K_nounArr()     )-1)];
	return $adjective." ".$animal." ".$noun;}






function rmComplete($basename,$firstRunF=T){
	if ($firstRunF){
		clearstatcache();} // for is_dir and is_file
	if (mb_substr($basename,mb_strlen($basename)-1,1) === "/"){
		$basename = mb_substr($basename,0,mb_strlen($basename)-1);}
	if (is_dir($basename)){
		$filenameA = @scandir($basename);if ($filenameA === F){return F;}
		foreach ($filenameA as $filename){
			if ($filename !== "." && $filename !== ".."){
				$status = rmComplete($basename."/".$filename,F);if ($status === F){return F;}}}
		$status = @rmdir($basename);if ($status === F){return F;}
		return T;}
	else if (is_file($basename)){
		$status = @unlink($basename);if ($status === F){return F;}
		return T;}
	return F;}
// ! untested
function cpComplete($src,$dst){return;
	$res = T;
	$dir = @opendir($src);if ($dir === F){return F;}
	$status = @mkdir($dst,0755);if ($status === F){return F;}
	while(($file = readdir($dir)) !== F){
		if ($file !== "." && $file !== ".."){
			if (@is_dir($src."/".$file)){
				$status = cpComplete($src."/".$file,$dst."/".$file);
				$res = $res && $status;}
			else if (@is_file($src."/".$file)){
				$status = copy($src."/".$file,$dst."/".$file);if ($status === F){return F;}}
			else{return F;}}}
	closedir($dir);
	return $res;}



// PASSWORD_BCRYPT --> first 72Bytes maximum considered
function pHash($password){return password_hash($password,PASSWORD_BCRYPT,array("cost"=>10));} // cost:10 takes 84ms on 13 Feb 2016, varies by multiples of 2
function pVerify($password,$hash){return password_verify($password,$hash);}
function pluHash($plushie){return password_hash($plushie,PASSWORD_BCRYPT,array("cost"=>4));} // lowest cost, according to the note [above, hopefully] on a cost:10, this will take 1.3ms
function pluVerify($plushie,$hash){return password_verify($plushie,$hash);}
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
	if (!is_string($m)){return F;}
	if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/',$m) !== 1){return F;}
	return T;}
// it doesn't have to be correct all the time, it just has to never return FALSE incorrectly - when in doubt, assume it breaks paths
function is_path_breaker($m){
	if (!is_string($m)){return T;}
	if ($m === ""  ){return T;}
	if ($m === "." ){return T;}
	if ($m === ".."){return T;}
	if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_\.]*$/',$m) !== 1){return T;}
	return F;}

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
/*function π_map($A,$fxn){
	$res = [];
	foreach ($A as $i=>$k){
		$res[] = $fxn($k,$i);} // leaving off $A, scared yet unsure about performance hit
	return $res;}*/
//
/*function π_reduce($A,$fxn,$initial=NULL){
	$accumulator = $initial;
	foreach ($A as $k=>$v){
		if ($accumulator === NULL){$accumulator = $A[$k];continue;}
		$accumulator = $fxn($accumulator,$A[$k],$k);} // leaving off $A, scared yet unsure about performance hit
	return $accumulator;};*/
?>
