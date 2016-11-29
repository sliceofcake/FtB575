<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

mb_internal_encoding("UTF-8");
require_once("butler.php");
require_once("specific.php");
// maximum safe integers:
//     9007199254740991 JavaScript, because every number is secretly a floating point value
//  9223372036854775807 PHP, PHP_INT_MAX on 64-bit server
// 18446744073709551615 MySQL, UNSIGNED BIGINT
//======================================================================================================================
// THIS INFORMATION MUST BE CHANGED BEFORE RELEASING
// THIS INFORMATION MUST BE CHANGED BEFORE RELEASING
// THIS INFORMATION MUST BE CHANGED BEFORE RELEASING
// THIS INFORMATION MUST BE CHANGED BEFORE RELEASING
// THIS INFORMATION MUST BE CHANGED BEFORE RELEASING
// THIS INFORMATION MUST BE CHANGED BEFORE RELEASING
// THIS INFORMATION MUST BE CHANGED BEFORE RELEASING
function ROOT(){ // PHP and globals smh
	$ROOT = [];
	$ROOT["STABLE_F"        ] = mb_strstr(getcwd(),"/575_unstable/")===F;
	
	$ROOT["DIR_SUBROOT"     ] = "/home/ftbsliceofcake2/";
	
	$ROOT["DIR_DATABASE"    ] = $ROOT["DIR_SUBROOT"]."db".($ROOT["STABLE_F"]?"":"_unstable")."/";
	$ROOT["DIR_FILE"        ] = $ROOT["DIR_SUBROOT"]."file".($ROOT["STABLE_F"]?"":"_unstable")."/";
	$ROOT["DIR_FILE_DEFAULT"] = $ROOT["DIR_SUBROOT"]."fileDefault".($ROOT["STABLE_F"]?"":"_unstable")."/";
	$ROOT["DIR_WEBROOT"     ] = $ROOT["DIR_SUBROOT"]."feelthebeats.se/";
	$ROOT["EXT_WEBROOT"     ] = "/";
	
	$ROOT["DIR_VERSION"     ] = $ROOT["DIR_WEBROOT"]."575".($ROOT["STABLE_F"]?"":"_unstable")."/";
	$ROOT["EXT_VERSION"     ] = $ROOT["EXT_WEBROOT"]."575".($ROOT["STABLE_F"]?"":"_unstable")."/";
	$ROOT["EXT_FILE"        ] = $ROOT["EXT_VERSION"]."file/";
	
	return $ROOT;}
//======================================================================================================================
/**********************************************************************************************************************\
* VALIDATION TABLES                                                                                                    *
\**********************************************************************************************************************/
// reminder
// L> these are properties accepted by the mu core, not necessarily matching the database ["user" accepts "password", even though that gets converted to "hash" in logic]
// L> yet, for the most part, they should mirror the database
function DESCRIPTION_PARTIAL(){
	return [
		"hue"        => "0 ≤ x ≤ 1000, resembles a rainbow stretched from 0 red, 83 orange, 167 yellow, 250-417 green, 500 cyan, 583-667 blue, 750 purple, 833 pink, wraps to 1000 red, same as 0 red",
		"saturation" => "0 ≤ x ≤ 1000, lower is more faded and washed out",
		"lightness"  => "0 ≤ x ≤ 1000, 500 is normal, lower is toward black, higher is toward white",
		"opacity"    => "0 ≤ x ≤ 1000, 1000 is solid, lower is toward transparent",
		"co"         => "0 ≤ count ≤ 4, [hue,saturation,lightness,opacity] each 0 ≤ x ≤ 1000 | hue 0-red color wheel loops back to 1000-red | saturation lower is washed out | lightness 500 is normal, higher is toward white, lower is toward black | opacity low is more transparent",
	];}
function DBM_VT_COMPLETE(){
	return [
		"chart" => [
			"_userIDA_charter"   => ["type"=>"intarr","minC"=>0,"maxC"=> 100,"min"=>0,"max"=> DB::$IDMax,"required"=>F,"help"=>"List of charters' userIDs [recommendation : include at least yourself]."],
			"_userIDA_favorite"  => ["type"=>"intarr","minC"=>0,"maxC"=>1000,"min"=>0,"max"=> DB::$IDMax,"required"=>F,"help"=>"List of favorite chart chartIDs [recommendation : leave this alone]."],
			"_tagIDA"            => ["type"=>"intarr","minC"=>0,"maxC"=> 100,"min"=>0,"max"=> DB::$IDMax,"required"=>F,"help"=>"List of tags' tagIDs [recommendation : include at least one genre tag]."],
			//....
			"titleS"             => ["type"=>"str"                         ,"min"=>0,"max"=>        300,"required"=>T,"help"=>"Title of the song."],
			"originS"            => ["type"=>"str"                         ,"min"=>0,"max"=>        300,"required"=>T,"help"=>"Composer/Artist/Performer/etc."],
			"infoAudioS"         => ["type"=>"str"                         ,"min"=>0,"max"=>       3000,"required"=>T,"help"=>"Information on how to obtain the audio file."],
			"infoS"              => ["type"=>"str"                         ,"min"=>0,"max"=>       3000,"required"=>F,"help"=>"Information on anything you want."],
			"durationN"          => ["type"=>"int"                         ,"min"=>0,"max"=>86400000000,"required"=>T,"help"=>"Duration of the song, in microseconds."], // 24 hours
			"safeTri"            => ["type"=>"int"                         ,"vA" =>[-1,0,1]            ,"required"=>F,"help"=>"Whether this song and chart should be considered safe for innocent/underage/light-of-heart players [-1 means unsafe, 0 means uncertain, 1 means safe]."],
			"co"                 => ["type"=>"intarr","minC"=>0,"maxC"=>  4,"min"=>0,"max"=>       1000,"required"=>F,"help"=>"Theme's color [".DESCRIPTION_PARTIAL()["co"]."]."],
			"txtR"               => ["type"=>"fil"                         ,"min"=>0,"max"=>    1048576,"required"=>T,"help"=>"Chart's textual notes file."],
			"icoR"               => ["type"=>"fil"                         ,"min"=>0,"max"=>    1048576,"required"=>F,"help"=>"Chart's icon/thumbnail file."],],
		"tag" => [
			"_chartIDA" => ["type"=>"intarr","minC"=>0,"maxC"=>100000,"min"=>0,"max"=> DB::$IDMax,"required"=>F,"help"=>"List of charts' chartIDs [recommendation : leave this alone]."],
			//....
			"nameS"     => ["type"=>"str","min"=>0,"max"=>100,"required"=>T,"help"=>"Name of the tag."],],
		"user" => [
			"_chartIDA_charter"  => ["type"=>"intarr","minC"=>0,"maxC"=>100000,"min"=>0,"max"=> DB::$IDMax,"required"=>F,"help"=>"List of charted charts' chartIDs [recommendation : leave this alone]."],
			"_chartIDA_favorite" => ["type"=>"intarr","minC"=>0,"maxC"=>  1000,"min"=>0,"max"=> DB::$IDMax,"required"=>F,"help"=>"List of favorite charts' chartIDs [recommendation : mark your favorite charts]."],
			//....
			"nameS"              => ["type"=>"str"                       ,"min"=>0,"max"=>DB_USERNAME_LENGTH_MAX(),"required"=>T,"help"=>"Username."],
			"passwordS"          => ["type"=>"str"                       ,"min"=>0,"max"=>DB_PASSWORD_LENGTH_MAX(),"required"=>T,"help"=>"Password."],
			"tx"                 => ["type"=>"intarr","minC"=>0,"maxC"=>4,"min"=>0,"max"=>                    1000,"required"=>F,"help"=>"Text's color [".DESCRIPTION_PARTIAL()["co"]."]."],
			"co"                 => ["type"=>"intarr","minC"=>0,"maxC"=>4,"min"=>0,"max"=>                    1000,"required"=>F,"help"=>"Theme's color [".DESCRIPTION_PARTIAL()["co"]."]."],
			"bg"                 => ["type"=>"intarr","minC"=>0,"maxC"=>4,"min"=>0,"max"=>                    1000,"required"=>F,"help"=>"Background's color [".DESCRIPTION_PARTIAL()["co"]."]."],
			"bioS"               => ["type"=>"str"                       ,"min"=>0,"max"=>                    3000,"required"=>F,"help"=>"Information that you'd like to provide about yourself, public for anyone else to read [you probably should avoid posting detailed personal information here]."],
			"netqN"              => ["type"=>"int"                       ,"vA" =>[-1,0,1]                         ,"required"=>F,"help"=>"Self-reported internet connection quality [-1 means bad connection, 0 means average connection, 1 means superb connection]."],],
	];}
//======================================================================================================================
function DB_ROW_LIMIT(){return 1000;} // general answer for "at most, how many rows should be fetched in a query"
function DB_TINYTEXT_LENGTH(){return intval(floor(255/4));} // max of 4 Bytes per characters in UTF-8
function DB_TEXT_LENGTH(){return intval(floor(65535/4));} // max of 4 Bytes per characters in UTF-8
function DB_MEDIUMTEXT_LENGTH(){return intval(floor(16777215/4));} // max of 4 Bytes per characters in UTF-8
function DB_BIGINT_MAX(){return 9223372036854775807;} // weakest of [PHP(64-bit),MySQL], which is PHP(64-bit) as of October 2016
function DB_BIGINT_MIN(){return -9223372036854775808;} // weakest of [PHP(64-bit),MySQL], which is PHP(64-bit) as of October 2016
function DB_INT_MAX(){return 2147483647;}
function DB_INT_MIN(){return -2147483648;}
function DB_ID_MIN(){return 0;} // 0 will never match a row, but allow it (for that purpose)
function DB_ID_MAX(){return 9007199254740991;} // weakest of [JavaScript,PHP(64-bit),MySQL], which is JavaScript as of October 2016
function DB_SCORE_MIN(){return 0;}
function DB_SCORE_MAX(){return 999999999;}
function DB_USERNAME_LENGTH_MAX(){return 100;}
function DB_PASSWORD_LENGTH_MAX(){return 100;} // CRYPT_BLOWFISH -> 72-Byte max
function DB_PLUSHIE_LENGTH_MAX(){return 60;}
function FILE_EXTENSION_WHITELIST(){return [".jpg",".jpeg",".png",".gif",".txt",".osu"];}
function INTERVAL_RARE(){return 60000000;}
