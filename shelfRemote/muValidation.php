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
	switch ($p["act"]){default:return F;
		break;case "del":$vt =     ["ID"      => ["type"=>"int"                          ,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()                     ],];
		break;case "get":$vt =     ["IDA"     => ["type"=>"intarr","minC"=>1,"maxC"=>1000,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()                     ],
		                            "_exrelA" => ["type"=>"strarr","minC"=>0,"maxC"=>count(DB_TABLE_ARR())                     ,"default"=>[]       ],];
		break;case "new":$vt = $DBM_VT_COMPLETE[$p["tbl"]];
		break;case "edt":$vt = $DBM_VT_COMPLETE[$p["tbl"]];
		                 π_aaa($vt,["ID"      => ["type"=>"int"                          ,"min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()                     ],]);}
	return vc6($p,$vt);}
// reminder
// L> these are properties accepted by the mu core, not necessarily matching the database ["user" accepts "password", even though that gets converted to "hash" in logic]
// L> yet, for the most part, they should mirror the database
$DBM_VT_COMPLETE = [
	"chart" => [
		"titleS"             => ["type"=>"str","min"=>          0,"max"=>        300                               ],
		"originS"            => ["type"=>"str","min"=>          0,"max"=>        300                               ],
		"infoAudioS"         => ["type"=>"str","min"=>          0,"max"=>       3000,"default"=>""                 ],
		"infoS"              => ["type"=>"str","min"=>          0,"max"=>       3000,"default"=>""                 ],
		"durationN"          => ["type"=>"int","min"=>          0,"max"=>86400000000                               ], // 24 hours
		//"npsN"               => ["type"=>"int","min"=>          0,"max"=>       1000                               ],
		"safeTri"            => ["type"=>"int","vA" =>[-1,0,1]                      ,"default"=>                  0],
		"hN"                 => ["type"=>"int","min"=>          0,"max"=>       1000,"default"=>$hue=π_rand(0,1000)],
		"sN"                 => ["type"=>"int","min"=>          0,"max"=>       1000,"default"=>                500],
		"lN"                 => ["type"=>"int","min"=>          0,"max"=>       1000,"default"=>               1000],
		//"formatS"            => ["type"=>"str","min"=>          0,"max"=>        100                               ],
		//"laneC"              => ["type"=>"int","min"=>          0,"max"=>        128                               ],
		"txtR"               => ["type"=>"fil","min"=>          0,"max"=>    1048576                               ],
		"icoR"               => ["type"=>"fil","min"=>          0,"max"=>    1048576,"default"=>N                  ],],
	"user" => [
		"nameS"              => ["type"=>"str","min"=>0,"max"=>DB_USERNAME_LENGTH_MAX()                               ],
		"passwordS"          => ["type"=>"str","min"=>0,"max"=>DB_PASSWORD_LENGTH_MAX()                               ],
		"hTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>$hue=π_rand(0,1000)],
		"sTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000],
		"lTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000],
		"aTxN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000],
		"hCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>$hue               ],
		"sCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000],
		"lCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                500],
		"aCoN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>               1000],
		"hBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>$hue               ],
		"sBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                  0],
		"lBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                  0],
		"aBgN"               => ["type"=>"int","min"=>0,"max"=>                    1000,"default"=>                900],
		"bioS"               => ["type"=>"str","min"=>0,"max"=>                    3000,"default"=>""                 ],
		"netqN"              => ["type"=>"int","vA" =>[-1,0,1]                         ,"default"=>                  0],],
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
	if ($v === N){return T;}
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
