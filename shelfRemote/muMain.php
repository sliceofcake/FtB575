<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

mb_internal_encoding("UTF-8");
require_once("butler.php");
require_once("mysql.php");
require_once("specific.php");
require_once("librarian.php");
require_once("muValidation.php");

//======================================================================================================================
// MU
function MU_process($in){
	$bTime = π_now();
	if (!isA($in)){return N;}
	foreach ($in as $row){
		if (!isA($row)){return N;}}
	$responseA = π_map($in,function($row){return MU_processSub($row,$in);});
	$eTime = π_now();
	π_forEach($responseA,function(&$row)use($bTime,$eTime){π_aaa($row,["b"=>$bTime,"e"=>$eTime]);});
	return $responseA;}
// ??? $_FILES[] index is [[[requestID]]]_[[[filename]]]
function MU_processSub($row,&$in){
	$cTime = π_now();
	/*
	Array(
		[AudioFile] => Array(
			[name] => Lia - My Soul Your Beats.mp3
			[type] => audio/mp3
			[tmp_name] => /tmp/phpb5AHOS
			[error] => 0
			[size] => 3799168)
		[ImageFile] => Array(
			[name] => YourBeatsSong.png
			[type] => image/png
			[tmp_name] => /tmp/phpoNhagR
			[error] => 0
			[size] => 426296))
	*/
	π_aaa($row,[
		"tbl" => ( isset($row["tbl"]) && isS($row["tbl"]) ? strval($row["tbl"]) : "" ),
		"act" => ( isset($row["act"]) && isS($row["act"]) ? strval($row["act"]) : "" ),
		"dat" => ( isset($row["dat"]) && isA($row["dat"]) ? arrval($row["dat"]) : [] ),
		"flO" => [],
		"prc" => ( isset($row["prc"]) && isS($row["prc"]) ? strval($row["prc"]) : "" ),
		"req" => ( isset($row["req"]) && isI($row["req"]) ? intval($row["req"]) :  0 ),
		"a"   => ( isset($row["a"  ]) && isI($row["a"  ]) ? intval($row["a"  ]) :  0 ),
		"ntq" => ( isset($row["ntq"]) && isI($row["ntq"]) ? intval($row["ntq"]) :  0 ),
		"who" => ( isset($row["who"]) && isI($row["who"]) ? intval($row["who"]) :  0 ),
		"plu" => ( isset($row["plu"]) && isS($row["plu"]) ? strval($row["plu"]) : "" ),]);
	// rewrite the $_FILES collection to a more sensible format
	foreach ($_FILES as $officialname=>$fileE){
		$prefixS = $row["req"]."_";
		if (mb_substr($officialname,0,mb_strlen($prefixS)) === $prefixS && $fileE["error"]!==UPLOAD_ERR_NO_FILE){
			$row["flO"][mb_substr($officialname,mb_strlen($prefixS))] = $fileE;}}
	$o = [
		"sta" =>         1 ,
		"msg" => ""        ,
		"dat" => []        ,
		"int" =>        -1 ,
		"req" => $row["req"] ,
		"a"   => $row["a"] ,
		"b"   =>         0 ,
		"c"   =>         0 ,
		"d"   =>         0 ,
		"e"   =>         0 ,
		"f"   =>         0];
	
	// if the user is claiming to be someone, verify it
	if ($row["who"] !== 0){
		// !!! implement db write locks so that this validUserF flag stays constant
		$plushieEA = db_qrra("SELECT hashS,t0,tEnd FROM user_plushie WHERE userID='".esc($row["who"])."'");
		$validUserClaimF = π_some($plushieEA,function($v)use($row){
			return (π_now() < $v["tEnd"] && pluVerify($row["plu"],$v["hashS"]));});
		//ll("v");
		//ll($plushieEA);
		if ($validUserClaimF){
			$GLOBALS["userID"] = $row["who"];}
		else{
			π_aaa($o,[
				"sta"=>-1002,
				"msg"=>"bad authentication plushie",]);}}
	
	if ($o["sta"] > 0){
		$returnF = MU_fxn($row,$o,$in);
		if (!$returnF){
			π_aaa($o,[
				"sta"=>-1001,
				"msg"=>GET_RETURN_MSG(),]);}}
	
	π_aaa($o,[
		"c"=>$cTime,
		"d"=>π_now(),]);
	return $o;}

// the one to call for all your MU needs ; it has some divert logic, and some hand-off logic
function MU_fxn(&$p,&$o,&$in){global $MU_TABLE;
	$d = &$p["dat"];
	$f = &$p["flO"];
	if (in_array($p["act"],["get","new","edt","del","dmp"],T)){
		if (!in_array($p["tbl"],DB_TABLE_ARR(),T)){SET_RETURN_MSG("ERROR : INVALID TBL");return F;}
		$returnF = DBM_VT($p);
		if (!$returnF){return F;}
		switch ($p["act"]){default:;
			
			//---- DMP ----
			break;case "dmp":
				// !!! a debatable tradeoff - incredible performance boost for an esoteric stance on security that holds that "any unauthorized information can be important in the worst situation" 
				$o["dat"]["IDA"] = db_qra("SELECT ID FROM ".$p["tbl"]." ORDER BY ID ASC"); // !!! HERE returning false...why? db not connected?
			
			//---- GET ----
			break;case "get":
				switch ($p["tbl"]){default:;
					break;case "chart"       :;
					break;case "user"        :;
					break;case "user_plushie":;
				}
				//....
				$o["dat"][$p["tbl"]] = D_qsA($p["tbl"],$d["IDA"],$d["_exrelA"]);
				//....
				switch ($p["tbl"]){default:;
					break;case "chart"       :
					break;case "user"        :
						foreach ($o["dat"][$p["tbl"]] as &$userE){$userID = $userE["ID"];
							unset($userE["hashS"]);
							if ($userID !== DBM_UID()){
								unset($userE["netqN"]);
								unset($userE["t1"]);}} // !!! maybe friends should have access to t1
					break;case "user_plushie":
						foreach ($o["dat"][$p["tbl"]] as &$user_plushieE){$user_plushieID = $user_plushieE["ID"];
							if ($user_plushieE["userID"] !== DBM_UID()){
								unset($o["dat"][$p["tbl"]][$user_plushieID]);}}
				}
			
			//---- NEW ----
			break;case "new":
				switch ($p["tbl"]){default:;
					break;case "chart"       :
						if (!DBM_SIU()){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
						π_aaa($d,[
							"userID"            => DBM_UID(),
							"npsN_DERIVED"      => 0,
							"formatS_DERIVED"   => "",
							"laneC_DERIVED"     => 7,
							"viewC_DERIVED"     => 0,
							"favoriteC_DERIVED" => 0,
						]);
					break;case "user"        :
						if (array_key_exists("passwordS",$d)){$d["hashS"] = pHash($d["passwordS"]);unset($d["passwordS"]);}
					break;case "user_plushie":
						SET_RETURN_MSG("ERROR : NO ONE HAS ACCESS TO THIS COMMAND");return F;
				}
				//....
				$insertID = D_qi($p["tbl"],$d);
				if ($insertID === F){
					SET_RETURN_MSG("ERROR : ".db_errInfo()." [ESOTERIC]");return F;}
				foreach ($f as $filename=>$fileE){
					// these parts are clean, but let's make sure
					if (isS($fileE)){$extension = π_calcFileExtensionProvided($fileE);}
					else            {$extension = π_calcFileExtensionProvided($fileE["name"]);}
					if (!is_boring($p["tbl"])){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-1]");return F;}
					if (!is_boring($filename)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-2]");return F;}
					if (!in_array($extension,FILE_EXTENSION_WHITELIST(),T)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-3]");return F;}
					if (!isI($insertID)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-4]");return F;}
					$dst = ROOT()["DIR_FILE"].$p["tbl"]."/".$filename."_".str($insertID).$extension;
					//chmod(ROOT()["DIR_FILE"].$p["tbl"]."/",0755);
					if (isS($fileE)){
						if (is_path_breaker($fileE)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-5]");return F;}
						copy(ROOT()["DIR_FILE_DEFAULT"].$fileE,$dst);}
					else{
						move_uploaded_file($fileE["tmp_name"],$dst);}
					D_qu($p["tbl"],$insertID,[$filename."Extension_DERIVED"=>$extension]);}
				$o["dat"][$p["tbl"]]["new"] = D_qs($p["tbl"],$insertID);
				//....
				switch ($p["tbl"]){default:;
					break;case "chart"       :;
					break;case "user"        :;
					break;case "user_plushie":;
				}
			
			//---- EDT ----
			break;case "edt":
				switch ($p["tbl"]){default:;
					break;case "chart"       :;
					break;case "user"        :;
					break;case "user_plushie":
						SET_RETURN_MSG("ERROR : NO ONE HAS ACCESS TO THIS COMMAND");return F;
				}
				//....
				if (!db_rowExists("FROM ".$p["tbl"]." WHERE ID='".esc($d["ID"])."'")){SET_RETURN_MSG("ERROR : specified database row [ID:'".esc($d["ID"])."'] doesn't exist");return F;}
				$o["dat"][$p["tbl"]]["old"] = D_qs($p["tbl"],$d["ID"]);
				// you have to own it
				switch ($p["tbl"]){default:;
					break;case "chart"       :
						if ($o["dat"][$p["tbl"]]["old"]["userID"] !== DBM_UID()){
							SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "user"        :
						if ($o["dat"][$p["tbl"]]["old"]["userID"] !== DBM_UID()){
							SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "user_plushie":
						if ($o["dat"][$p["tbl"]]["old"]["userID"] !== DBM_UID()){
							SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
				}
				//....
				$propertyA = $d;unset($propertyA["ID"]); // copy $d, without the ID property
				D_qu($p["tbl"],$d["ID"],$propertyA);
				foreach ($f as $filename=>$fileE){
					// these parts are clean, but let's make sure
					$extension = π_calcFileExtensionProvided($fileE["name"]);
					if (!is_boring($p["tbl"])){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-1]");return F;}
					if (!is_boring($filename)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-2]");return F;}
					if (!in_array($extension,FILE_EXTENSION_WHITELIST(),T)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-3]");return F;}
					if (!isI($d["ID"])){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-4]");return F;}
					$dst = ROOT()["DIR_FILE"].$p["tbl"]."/".$filename."_".str($d["ID"]).$extension;
					move_uploaded_file($fileE["tmp_name"],$dst);
					D_qu($p["tbl"],$d["ID"],[$filename."Extension_DERIVED"=>$extension]);}
				$o["dat"][$p["tbl"]]["new"] = D_qs($p["tbl"],$d["ID"]);
				//....
				switch ($p["tbl"]){default:;
					break;case "chart"       :;
					break;case "user"        :;
					break;case "user_plushie":;
				}
			
			//---- DEL ----
			break;case "del":
				switch ($p["tbl"]){default:;
					break;case "chart"       :;
					break;case "user"        :;
					break;case "user_plushie":;
				}
				//....
				$o["dat"][$p["tbl"]]["old"] = D_qs($p["tbl"],$d["ID"]);
				if ($o["dat"][$p["tbl"]]["old"] === F){SET_RETURN_MSG("ERROR : SPECIFIED ENTITY DOESN'T EXIST");return F;}
				// you have to own it
				switch ($p["tbl"]){default:;
					break;case "chart"       :
						if ($o["dat"][$p["tbl"]]["old"]["userID"] !== DBM_UID()){
							SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "user"        :
						if ($o["dat"][$p["tbl"]]["old"]["ID"] !== DBM_UID()){
							SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "user_plushie":
						if ($o["dat"][$p["tbl"]]["old"]["userID"] !== DBM_UID()){
							SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
				}
				//....
				D_qd($p["tbl"],$d["ID"]);
		}
		return T;}
	else{
		if (!isset($MU_TABLE[$p["tbl"]][$p["act"]])){SET_RETURN_MSG("BAD FUNCTION");return F;}
		$returnF = $MU_TABLE[$p["tbl"]][$p["act"]]($p,$p["dat"],$o,$in);
		if (!$returnF){return F;}
		return T;}}

//----------------------------------------------------------------------------------------------------------------------

// !!! when post-recalcs are needed, you'll need to spread this call where it's needed
// recalculate DERIVED attributes of a table
// [e] yes
// [r] status
function DBM_recalc($tbl,$ID){
	switch ($tbl){default:
		break;case "user":}
	return T;}

/**********************************************************************************************************************\
* SPECIALIZED MU COMMANDS                                                                                             *
\**********************************************************************************************************************/

$MU_TABLE["n/a"]["KERN|clock"] = function(&$p,&$d,&$o){
	$o["dat"]["timeN"] = π_now();
	return T;};

$MU_TABLE["n/a"]["KERN|ping"] = function(&$p,&$d,&$o){
	$o["dat"]["res"] = DB_TEXT_LENGTH();
	return T;};

$MU_TABLE["n/a"]["KERN|debug"] = function(&$p,&$d,&$o){
	$o["dat"]["res"] = "";
	return T;};

$MU_TABLE["n/a"]["KERN|FEED_HAMSTER"] = function(&$p,&$d,&$o){
	return T;};

$MU_TABLE["n/a"]["KERN|who_am_i"] = function(&$p,&$d,&$o){
	if (DBM_SIU()){
		$o["dat"]["userID"] = DBM_UID();return T;}
	else{
		$o["dat"]["userID"] = 0;return T;}
};

// AUTHENTICATION AND NEW ACCOUNTS
//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv

$MU_TABLE["n/a"]["FtB575_1|plushie_gen"] = function(&$p,&$d,&$o){
	// attempt ID sign in
	// !!! use π_cc() for all array copies - find π_cc in butler.php
	$pCopy1=π_cc($p);
	$pCopy2=π_cc($p);
	$successF1 = vc6($pCopy1,[
		"ID"        => ["type"=>"int","min"=>DB_ID_MIN(),"max"=>DB_ID_MAX()],
		"passwordS" => ["type"=>"str","max"=>DB_PASSWORD_LENGTH_MAX()],]);
	$successF2 = vc6($pCopy2,[
		"nameS"     => ["type"=>"str","max"=>DB_USERNAME_LENGTH_MAX()],
		"passwordS" => ["type"=>"str","max"=>DB_PASSWORD_LENGTH_MAX()],]);
	if ($successF1){
		$row = D_qs("user",$pCopy1["dat"]["ID"]);
		if ($row === F){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION ID");return F;}
		if (!pVerify($pCopy1["dat"]["passwordS"],$row["hashS"])){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION PASSWORD");return F;}
		$ID = $pCopy1["dat"]["ID"];}
	// then attempt name sign in
	else if ($successF2){
		$userA = db_qrra("SELECT ID,hashS FROM user WHERE nameS='".esc($pCopy2["dat"]["nameS"])."'");
		if ($userA === F || count($userA) === 0){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION NAME");return F;}
		$dCopy2 = &$pCopy2["dat"]; // because PHP syntax issues with function()use(&$_[""]){}
		$user = π_find($userA,function($row)use(&$dCopy2){return pVerify($dCopy2["passwordS"],$row["hashS"]);});
		if ($user === F){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION PASSWORD");return F;}
		$ID = $user["ID"];}
	else{return F;}
	$plu = DBM_genPlushie();
	$t = π_now();
	$user_plushieID = D_qi("user_plushie",["hashS"=>pluHash($plu),"userID"=>$ID,"t0"=>$t,"t1"=>$t,"tEnd"=>$t+(28*24*60*60*1000*1000)]);
	π_aaa($o["dat"],["ID"=>$ID,"plu"=>$plu,"user_plushieID"=>$user_plushieID]);
	return T;
};

$MU_TABLE["n/a"]["FtB575_1|password_assert"] = function(&$p,&$d,&$o){
	if (!DBM_SIU()){SET_RETURN_MSG("ERROR : NOT AUTHENTICATED");return F;}
	$pCopy1=π_cc($p);
	$successF1 = vc6($pCopy1,[
		"password_oldS" => ["type"=>"str","max"=>DB_PASSWORD_LENGTH_MAX()],
		"password_newS" => ["type"=>"str","max"=>DB_PASSWORD_LENGTH_MAX()],]);
	if (!$successF1){return F;}
	db_head();
	$row = D_qs("user",DBM_UID(),[],T);
	if ($row !== F){
		D_qu("user",DBM_UID(),["hashS",pHash($d["password_newS"])]);}
	db_tail();
	return T;
};

$MU_TABLE["n/a"]["FtB575_1|chart_list"] = function(&$p,&$d,&$o){
	$o["dat"]["chartIDA"] = db_qra("SELECT ID FROM chart ORDER BY ID ASC");
	return T;
};
