<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

mb_internal_encoding("UTF-8");
require_once("butler.php");
require_once("specific.php");
/**********************************************************************************************************************\
* VALIDATION TABLES                                                                                                    *
\**********************************************************************************************************************/
/*
INPUT
calcValidateTable("channel","edt",[???]])

OUTPUT
["name"               => ["typeS"=>"str",           "maxN"=> 100,             "default"=>K_genChannelName()],
 "maxMessageC"        => ["typeS"=>"int","minN"=> 0,"maxN"=> 300,             "default"=>               100],
 "maxMessageLen"      => ["typeS"=>"int","minN"=>-1,"maxN"=>1000,             "default"=>              1000],
 "publiclyVisibleTri" => ["typeS"=>"int",                        "vA"=>[-1,1],"default"=>                -1],]

SUMMARY
You have a user who wants to perform an action.
(1) If tbl-act doesn't exist, fail with error message
(2) Calculate the corresponding tbl-act property list for this user
(3) If property list is empty, fail with error message
(4) If $rowImport["dat"] has too few or too many properties that can't be default-filled, or violates the existing rules, fail with error message
(5) Return true
DBM_SIU
DBM_UID
*/
function DBM_VT(&$p){global $DBM_VT_COMPLETE;
	if (!array_key_exists($p["tbl"],$DBM_VT_COMPLETE)){SET_RETURN_MSG("tbl not found");return F;}
	$vt = DBM_VT_FILTERED($p["tbl"],$p["act"]);
	return vc6($p,$vt);}
function DBM_VT_FILTERED($tbl,$act){global $DBM_VT_COMPLETE;
	switch ($act){default:return F;
		break;case "dmp":$vt =     [];
		break;case "del":$vt =     ["ID"      => ["type"=>"int"                          ,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()                     ,"help"=>"The unique ID of this entity."],];
		break;case "get":$vt =     ["IDA"     => ["type"=>"intarr","minC"=>1,"maxC"=>1000,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()                     ,"help"=>"The unique IDs of the desired entities."],
		                            "_exrelA" => ["type"=>"strarr","minC"=>0,"maxC"=>count(DB_TABLE_ARR())                     ,"default"=>[]       ,"help"=>"Table-names, extra relational data is brought in, if relevant, such as a \"message\" exrel on the \"channel\" table will include messageIDs for that channel."],];
		break;case "new":$vt = $DBM_VT_COMPLETE[$tbl];
		break;case "edt":$vt = $DBM_VT_COMPLETE[$tbl];
		                 π_aaa($vt,["ID"      => ["type"=>"int"                          ,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()                     ,"help"=>"The unique ID of this entity."],]);}
	return $vt;}
// reminder
// L> these are properties accepted by the mu core, not necessarily matching the database ["user" accepts "password", even though that gets converted to "hash" in logic]
// L> yet, for the most part, they should mirror the database
$DESCRIPTION_PARTIAL = [
	"hue"        => "0 ≤ x ≤ 1000, resembles a rainbow stretched from 0 red, 30 orange, 60 yellow, 90-150 green, 180 cyan, 210-240 blue, 270 purple, 300 pink, wraps to 1000 red, same as 0 red",
	"saturation" => "0 ≤ x ≤ 1000, lower is more faded and washed out",
	"lightness"  => "0 ≤ x ≤ 1000, 500 is normal, lower is toward black, higher is toward white",
	"opacity"    => "0 ≤ x ≤ 1000, 1000 is solid, lower is toward transparent",
];
$DBM_VT_COMPLETE = [
	"chart" => [
		"titleS"             => ["type"=>"str","min"=>          0,"max"=>        300                               ,"help"=>"Title of the song."],
		"originS"            => ["type"=>"str","min"=>          0,"max"=>        300                               ,"help"=>"Composer/Artist/Performer/etc."],
		"infoAudioS"         => ["type"=>"str","min"=>          0,"max"=>       3000,"default"=>""                 ,"help"=>"Information on how to obtain the audio file."],
		"infoS"              => ["type"=>"str","min"=>          0,"max"=>       3000,"default"=>""                 ,"help"=>"Information on anything you want."],
		"durationN"          => ["type"=>"int","min"=>          0,"max"=>86400000000                               ,"help"=>"Duration of the song, in microseconds."], // 24 hours
		"safeTri"            => ["type"=>"int","vA" =>[-1,0,1]                      ,"default"=>                  0,"help"=>"Whether this song and chart should be considered safe for innocent/underage/light-of-heart players [-1 means unsafe, 0 means uncertain, 1 means safe]."],
		"hN"                 => ["type"=>"int","min"=>          0,"max"=>       1000,"default"=>$hue=π_rand(0,1000),"help"=>"Theme's color hue [".$DESCRIPTION_PARTIAL["hue"]."]."],
		"sN"                 => ["type"=>"int","min"=>          0,"max"=>       1000,"default"=>                500,"help"=>"Theme's color saturation [".$DESCRIPTION_PARTIAL["saturation"]."]."],
		"lN"                 => ["type"=>"int","min"=>          0,"max"=>       1000,"default"=>               1000,"help"=>"Theme's color lightness [".$DESCRIPTION_PARTIAL["lightness"]."]."],
		"txtR"               => ["type"=>"fil","min"=>          0,"max"=>    1048576                               ,"help"=>"Chart's textual notes file."],
		"icoR"               => ["type"=>"fil","min"=>          0,"max"=>    1048576,"default"=>"chart_icoR.png"   ,"help"=>"Chart's icon/thumbnail file."],],
	"user" => [
		"nameS"              => ["type"=>"str","min"=>0,"max"=>DB_USERNAME_LENGTH_MAX()                               ,"help"=>"Username."],
		"passwordS"          => ["type"=>"str","min"=>0,"max"=>DB_PASSWORD_LENGTH_MAX()                               ,"help"=>"Password."],
		"hTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>$hue=π_rand(0,1000),"help"=>"Text's color hue [".$DESCRIPTION_PARTIAL["hue"]."]."],
		"sTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000,"help"=>"Text's color saturation [".$DESCRIPTION_PARTIAL["saturation"]."]."],
		"lTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000,"help"=>"Text's color lightness [".$DESCRIPTION_PARTIAL["lightness"]."]."],
		"aTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000,"help"=>"Text's color opacity [".$DESCRIPTION_PARTIAL["opacity"]."]."],
		"hCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>$hue               ,"help"=>"Detail's color hue [".$DESCRIPTION_PARTIAL["hue"]."]."],
		"sCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000,"help"=>"Detail's color saturation [".$DESCRIPTION_PARTIAL["saturation"]."]."],
		"lCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                500,"help"=>"Detail's color lightness [".$DESCRIPTION_PARTIAL["lightness"]."]."],
		"aCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000,"help"=>"Detail's color opacity [".$DESCRIPTION_PARTIAL["opacity"]."]."],
		"hBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>$hue               ,"help"=>"Background's color hue [".$DESCRIPTION_PARTIAL["hue"]."]."],
		"sBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                  0,"help"=>"Background's color saturation [".$DESCRIPTION_PARTIAL["saturation"]."]."],
		"lBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                  0,"help"=>"Background's color lightness [".$DESCRIPTION_PARTIAL["lightness"]."]."],
		"aBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                900,"help"=>"Background's color opacity [".$DESCRIPTION_PARTIAL["opacity"]."]."],
		"bioS"               => ["type"=>"str","min"=>0,"max"=>                    3000,"default"=>""                 ,"help"=>"Information that you'd like to provide about yourself, public for anyone else to read [you probably should avoid posting detailed personal information here]."],
		"netqN"              => ["type"=>"int","vA" =>[-1,0,1]                         ,"default"=>                  0,"help"=>"Self-reported internet connection quality [-1 means bad connection, 0 means average connection, 1 means superb connection]."],],
	// "user_plushie" -> only del
];

//----------------------------------------------------------------------------------------------------------------------
// VC6 - Variable Cleanse Version 6
// return whether input data comforms to normative set, with first issue message
function vc6(&$p,$normative){
	// remove extra properties from $p["dat"]
	foreach ($p["dat"] as $propertyS=>$v){
		if (!array_key_exists($propertyS,$normative)){unset($p["dat"][$propertyS]);}}
	// remove extra properties from $p["flO"]
	foreach ($p["flO"] as $propertyS=>$v){
		if (!array_key_exists($propertyS,$normative)){unset($p["flO"][$propertyS]);}}
	// ensure that all $normative properties exist in $p["dat"]/$p["flO"], and are valid - fill in defaults where applicable
	foreach ($normative as $propertyS=>$rule){
		// if not edt, fill defaults or fail if need to fill and can't
		if ($p["act"] === "edt" && !array_key_exists($propertyS,$p["dat"])){continue;}
		switch ($rule["type"]){default:SET_RETURN_MSG("ERROR(VC6) : rule.type illegal value");return F;
			break;case "fil"   :
				if (!array_key_exists($propertyS,$p["flO"])){
					if (array_key_exists("default",$rule)){$p["flO"][$propertyS] = $rule["default"];}
					else{SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." not defined");return F;}}
			break;case "int"   :case "intarr":case "str"   :case "strarr":
				if (!array_key_exists($propertyS,$p["dat"])){
					if (array_key_exists("default",$rule)){$p["dat"][$propertyS] = $rule["default"];}
					else{SET_RETURN_MSG("ERROR(VC6) : ".$propertyS." not defined");return F;}}}
		switch ($rule["type"]){default:SET_RETURN_MSG("ERROR(VC6) : rule.type illegal value");return F;
			break;case "fil"   :if (!vc6fil   ($propertyS,$p["flO"][$propertyS],$rule)){return F;}
			break;case "int"   :if (!vc6int   ($propertyS,$p["dat"][$propertyS],$rule)){return F;}
			break;case "intarr":if (!vc6intarr($propertyS,$p["dat"][$propertyS],$rule)){return F;}
			break;case "str"   :if (!vc6str   ($propertyS,$p["dat"][$propertyS],$rule)){return F;}
			break;case "strarr":if (!vc6strarr($propertyS,$p["dat"][$propertyS],$rule)){return F;}}}
	return T;}
function vc6fil($propertyS,$v,$rule){
	if (isS($v)){return T;} // default path
	if (!isA($v)                                                     ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT FIL"                                        );return F;}
	if ($v["error"] !== 0                                            ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." RETURNED PHP ERROR CODE : ".$v["error"]         );return F;}
	if (array_key_exists("min" ,$rule) && $v["size"] < $rule["min"]  ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS SMALLER THAN ".$rule["min"]                  );return F;}
	if (array_key_exists("max" ,$rule) && $v["size"] > $rule["max"]  ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS LARGER THAN ".$rule["max"]                   );return F;}
	if (array_key_exists("gate",$rule) && !$rule["gate"]($v)         ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." DID NOT PASS GATE FUNCTION"                     );return F;}
	return T;}
function vc6int($propertyS,$v,$rule){
	if (!isI($v)                                                     ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT INT"                                        );return F;}
	if (array_key_exists("min" ,$rule) && $v < $rule["min"]          ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS LESS THAN ".$rule["min"]                     );return F;}
	if (array_key_exists("max" ,$rule) && $v > $rule["max"]          ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS GREATER THAN ".$rule["max"]                  );return F;}
	if (array_key_exists("vA"  ,$rule) && !in_array($v,$rule["vA"],T)){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT A LEGAL VALUE FROM ".var_export($rule["vA"]));return F;}
	if (array_key_exists("gate",$rule) && !$rule["gate"]($v)         ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." DID NOT PASS GATE FUNCTION"                     );return F;}
	return T;}
function vc6str($propertyS,$v,$rule){
	if (!isS($v)                                                      ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT STR"                                        );return F;}
	if (array_key_exists("min" ,$rule) && mb_strlen($v) < $rule["min"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS SHORTER THAN ".$rule["min"]                  );return F;}
	if (array_key_exists("max" ,$rule) && mb_strlen($v) > $rule["max"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." IS LONGER THAN ".$rule["max"]                   );return F;}
	if (array_key_exists("vA"  ,$rule) && !in_array($v,$rule["vA"],T) ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT A LEGAL VALUE FROM ".var_export($rule["vA"]));return F;}
	if (array_key_exists("gate",$rule) && !$rule["gate"]($v)          ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." DID NOT PASS GATE FUNCTION"                     );return F;}
	return T;}
function vc6intarr($propertyS,$v,$rule){
	if (!isA($v)                                                   ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT ARR"                                                                          );return F;}
	if (array_key_exists("minC",$rule) && count($v) < $rule["minC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO FEW ELEMENTS - ".count($v)." WHEN AT LEAST ".$rule["minC"]." REQUIRED"    );return F;}
	if (array_key_exists("maxC",$rule) && count($v) > $rule["maxC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO MANY ELEMENTS - ".count($v)." WHEN NO MORE THAN ".$rule["maxC"]." ALLOWED");return F;}
	foreach ($v as $propertyS_sub=>$v_sub){
		if (!vc6int($propertyS_sub,$v_sub,$rule)){return F;}}
	return T;}
function vc6strarr($propertyS,$v,$rule){
	if (!isA($v)                                                   ){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." NOT ARR"                                                                          );return F;}
	if (array_key_exists("minC",$rule) && count($v) < $rule["minC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO FEW ELEMENTS - ".count($v)." WHEN AT LEAST ".$rule["minC"]." REQUIRED"    );return F;}
	if (array_key_exists("maxC",$rule) && count($v) > $rule["maxC"]){SET_RETURN_MSG("ERROR(VC6) : ".$propertyS.":".var_export($v,T)." HAS TOO MANY ELEMENTS - ".count($v)." WHEN NO MORE THAN ".$rule["maxC"]." ALLOWED");return F;}
	foreach ($v as $propertyS_sub=>$v_sub){
		if (!vc6str($propertyS_sub,$v_sub,$rule)){return F;}}
	return T;}
