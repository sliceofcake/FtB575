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
$ROOT = [
	"STABLE_F"  => T,
	"VERSION"   => 1,
];
$ROOT["DIR_WEBROOT"   ] = "/home/ftbsliceofcake2/feelthebeats.se/";
$ROOT["DIR_VERSION"   ] = $ROOT["DIR_WEBROOT"].($ROOT["STABLE_F"]?"575/":"575_unstable/");
$ROOT["DIR_FILE_CHART"] = $ROOT["DIR_VERSION"]."file/chart/";
$ROOT["DB_NAME"       ] = "FtB575_".$ROOT["VERSION"];
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
function DB_TABLE_ARR(){return ["chart","user","user_plushie"];}
function FILE_EXTENSION_WHITELIST(){return [".jpg",".jpeg",".png",".gif",".txt",".osu"];}
function INTERVAL_RARE(){return 60000000;}
