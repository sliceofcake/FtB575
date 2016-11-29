<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

mb_internal_encoding("UTF-8");
require_once("butler.php");
//require_once("mysql.php");
require_once("db.php");
require_once("specific.php");
require_once("librarian.php");

//======================================================================================================================
// MU
function MU_process($in){
	$bTime = π_now();
	if (!isA($in)){return N;}
	foreach ($in as $row){
		if (!isA($row)){return N;}}
	DB::verifyFileStructure();
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
	
	// !!! implement db write locks so that this validUserF flag stays constant
	// if the user is claiming to be someone, verify it
	for ($successF = F; $successF === F; $successF = T){
		if ($row["who"] !== 0){
			$userE = DB::get("user",$row["who"]);
			if ($userE === F){π_aaa($o,["sta"=>-1001,"msg"=>"invalid userID claim"]);break;}
			if (!kInA("plushieA",$userE)){π_aaa($o,["sta"=>-1001,"msg"=>"no plushie assigned"]);break;}
			$plushieEA = $userE["plushieA"];
			$matchF = F;
			foreach ($plushieEA as $plushieE){
				if (!kInA("hashS",$plushieE)){continue;} // not enough info
				if (kInA("tEnd",$plushieE) && $plushieE["tEnd"] <= π_now()){continue;} // tEnd specified, and this has expired [!!! do something with it [when to delete it]]
				if (!pluVerify($row["plu"],$plushieE["hashS"])){continue;} // hashS specified, and this doesn't match
				$matchF = T;}
			if (!$matchF){π_aaa($o,["sta"=>-1001,"msg"=>"bad authentication plushie"]);break;}
			$GLOBALS["userID"] = $row["who"];}}
	
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
		if (!vInA($p["tbl"],DB::$tblWhitelist)){SET_RETURN_MSG("ERROR : INVALID TBL");return F;}
		if (!kInA($p["tbl"],DBM_VT_COMPLETE())){SET_RETURN_MSG("tbl not found");return F;}
		switch ($p["act"]){default:;
			
			//---- DMP ----
			break;case "dmp":
				$vt = [];
				$statusF = vc6($p,$vt);if ($statusF === F){return F;}
				//....
				// !!! a debatable tradeoff - incredible performance boost for an esoteric stance on security that holds that "any unauthorized information can be important in the worst situation" 
				$o["dat"]["_IDA"] = DB::dmp($p["tbl"]);
			
			//---- GET ----
			break;case "get":
				$vt = ["_IDA" => ["type"=>"intarr","minC"=>1,"maxC"=>1000,"min"=>DB::$IDMin,"max"=>DB::$IDMax,"requiredNow"=>T,"help"=>"The unique IDs of the desired entities."],];
				$statusF = vc6($p,$vt);if ($statusF === F){return F;}
				//....
				switch ($p["tbl"]){default:;
					break;case "board"     :;
					break;case "subboard"  :;
					break;case "thread"    :;
					break;case "threadView":;
					break;case "post"      :;
					
					break;case "chart"     :;
					break;case "tag"       :;
					break;case "favorite"  :;
					
					break;case "user"      :;
				}
				//....
				$o["dat"][$p["tbl"]] = π_mapFilter($d["_IDA"],function($ID)use(&$p){return DB::get($p["tbl"],$ID);},F);
				//....
				switch ($p["tbl"]){default:;
					break;case "board"     :;
					break;case "subboard"  :;
					break;case "thread"    :;
					break;case "threadView":
						$o["dat"][$p["tbl"]] = π_filter($o["dat"][$p["tbl"]],function($E){return kinA("_userID",$E) && $E["_userID"] === DBM_UID();});
					break;case "post"      :;
					
					break;case "chart"     :;
					break;case "tag"       :;
					break;case "favorite"  :
						$o["dat"][$p["tbl"]] = π_filter($o["dat"][$p["tbl"]],function($E){return kinA("_userID",$E) && $E["_userID"] === DBM_UID();});
					
					break;case "user"      :
						foreach ($o["dat"][$p["tbl"]] as &$E){$userID = $E["_ID"];
							unset($E["hashS"]);
							if ($userID !== DBM_UID()){
								unset($E["netqN"]);
								unset($E["t1"]);
								unset($E["plushieA"]);}} // !!! maybe friends should have access to t1
				}
			
			//---- NEW ----
			break;case "new":
				$vt = DBM_VT_COMPLETE()[$p["tbl"]];
				foreach ($vt as $k=>$v){
					$vt[$k]["requiredNow"] = $vt[$k]["required"];}
				$statusF = vc6($p,$vt);if ($statusF === F){return F;}
				//....
				switch ($p["tbl"]){default:;
					break;case "board"     :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "subboard"  :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "thread"    :
						if (!DBM_SIU()){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
						π_aaa($d,["_userIDA"=>[DBM_UID()]]);
					break;case "threadView":
						SET_RETURN_MSG("ERROR : TABLE NOT MANUALLY HANDLED");return F;
					break;case "post"      :
						if (!DBM_SIU()){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
						π_aaa($d,["_userIDA"=>[DBM_UID()]]);
					
					break;case "chart"     :
						if (!DBM_SIU()){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
						π_aaa($d,["_userIDA"=>[DBM_UID()]]);
					break;case "tag"       :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "favorite"  :
						if (!DBM_SIU()){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
						π_aaa($d,["_userIDA"=>[DBM_UID()]]);
					
					break;case "user"      :
						if (kInA("passwordS",$d)){
							$d["hashS"] = pHash($d["passwordS"]);
							unset($d["passwordS"]);}
				}
				//....
				$d["t1"] = $d["t0"] = π_now();
				$insertID = DB::new($p["tbl"],$d,$f);if ($insertID === F){SET_RETURN_MSG("ERROR : ".print_r(DB::$errA,T)." [ESOTERIC]");return F;}
				$o["dat"][$p["tbl"]]["_ID"] = $insertID;
				//....
				switch ($p["tbl"]){default:;
					break;case "board"     :;
					break;case "subboard"  :;
					break;case "thread"    :;
					break;case "threadView":;
					break;case "post"      :;
					
					break;case "chart"     :;
					break;case "tag"       :;
					break;case "favorite"  :;
					
					break;case "user"      :;
				}
			
			//---- EDT ----
			break;case "edt":
				$vt = DBM_VT_COMPLETE()[$p["tbl"]];
				foreach ($vt as $k=>$v){
					$vt[$k]["requiredNow"] = F;}
				π_aaa($vt,["_ID" => ["type"=>"int","min"=>DB::$IDMin,"max"=>DB::$IDMax,"requiredNow"=>T,"help"=>"The unique ID of this entity."],]);
				$statusF = vc6($p,$vt);if ($statusF === F){return F;}
				//....
				$E = DB::get($p["tbl"],$d["_ID"]);
				if ($E === F){SET_RETURN_MSG("ERROR : specified database row [ID:'".$d["_ID"]."'] doesn't exist");return F;}
				switch ($p["tbl"]){default:;
					break;case "board"     :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "subboard"  :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "thread"    :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "threadView":
						SET_RETURN_MSG("ERROR : TABLE NOT MANUALLY HANDLED");return F;
					break;case "post"      :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					
					break;case "chart"     :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "tag"       :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "favorite"  :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					
					break;case "user"      :
						if (!kInA("_ID",$E)){SET_RETURN_MSG("ERROR : PANIC");return F;}
						if (DBM_UID() !== $E["_ID"]){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
						if (kInA("passwordS",$d)){
							$d["hashS"] = pHash($d["passwordS"]);
							unset($d["passwordS"]);}
				}
				//....
				$d["t1"] = π_now();
				$dd = π_cc($d);unset($dd["_ID"]); // copy $d, without the ID property
				DB::edt($p["tbl"],$d["_ID"],$dd);
				foreach ($f as $filename=>$fileE){
					DB::calcPathFil($p["tbl"],$d["_ID"],$filename);
					// these parts are clean, but let's make sure
					$extension = π_calcFileExtensionProvided($fileE["name"]);
					if (!is_boring($p["tbl"])){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-1]");return F;}
					if (!is_boring($filename)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-2]");return F;}
					if (!in_array($extension,FILE_EXTENSION_WHITELIST(),T)){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-3]");return F;}
					if (!isI($d["_ID"])){SET_RETURN_MSG("ERROR : INVALID FILEPATH COMPONENT [ESOTERIC-4]");return F;}
					$dst = ROOT()["DIR_FILE"]."/".$p["tbl"]."/".$filename."/".str($d["_ID"]).$extension;
					move_uploaded_file($fileE["tmp_name"],$dst);
					DB::edt($p["tbl"],$d["_ID"],[$filename."Extension_DERIVED"=>$extension]);}
				//....
				switch ($p["tbl"]){default:;
					break;case "board"     :;
					break;case "subboard"  :;
					break;case "thread"    :;
					break;case "threadView":;
					break;case "post"      :;
					
					break;case "chart"     :;
					break;case "tag"       :;
					break;case "favorite"  :;
					
					break;case "user"      :;
				}
			
			//---- DEL ----
			break;case "del":
				$vt = ["_ID" => ["type"=>"int","min"=>DB::$IDMin,"max"=>DB::$IDMax,"requiredNow"=>T,"help"=>"The unique ID of this entity."],];
				$statusF = vc6($p,$vt);if ($statusF === F){return F;}
				//....
				$E = DB::get($p["tbl"],$d["_ID"]);
				if ($E === F){SET_RETURN_MSG("ERROR : specified database row [ID:'".$d["_ID"]."'] doesn't exist");return F;}
				switch ($p["tbl"]){default:;
					break;case "board"     :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "subboard"  :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "thread"    :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "threadView":
						SET_RETURN_MSG("ERROR : TABLE NOT MANUALLY HANDLED");return F;
					break;case "post"      :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					
					break;case "chart"     :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "tag"       :
						if (!DBM_CLR(3)){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					break;case "favorite"  :
						if (!kInA("_userIDA",$E)){SET_RETURN_MSG("ERROR : LONE ROW");return F;}
						if (!vInA(DBM_UID(),$E["_userIDA"])){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
					
					break;case "user"      :
						if (!kInA("_ID",$E)){SET_RETURN_MSG("ERROR : PANIC");return F;}
						if (DBM_UID() !== $E["_ID"]){SET_RETURN_MSG("ERROR : ACCESS DENIED");return F;}
				}
				//....
				DB::del($p["tbl"],$d["_ID"]);
				//....
				switch ($p["tbl"]){default:;
					break;case "board"     :;
					break;case "subboard"  :;
					break;case "thread"    :;
					break;case "threadView":;
					break;case "post"      :;
					
					break;case "chart"     :;
					break;case "tag"       :;
					break;case "favorite"  :;
					
					break;case "user"      :;
				}
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
* SPECIALIZED MU COMMANDS                                                                                              *
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
	$pCopy1 = π_cc($p);
	$pCopy2 = π_cc($p);
	$successF1 = vc6($pCopy1,[
		"_ID"       => ["type"=>"int","min"=>DB::$IDMin,"max"=>DB::$IDMax,"requiredNow"=>T,"help"=>"Your userID."],
		"passwordS" => ["type"=>"str","max"=>DB_PASSWORD_LENGTH_MAX(),"requiredNow"=>T,"help"=>"Your password."],]);
	$successF2 = vc6($pCopy2,[
		"nameS"     => ["type"=>"str","max"=>DB_USERNAME_LENGTH_MAX(),"requiredNow"=>T,"help"=>"Your username."],
		"passwordS" => ["type"=>"str","max"=>DB_PASSWORD_LENGTH_MAX(),"requiredNow"=>T,"help"=>"Your password."],]);
	if ($successF1){
		$user = DB::get("user",$pCopy1["dat"]["_ID"]);if ($user === F){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION ID");return F;}
		if (!pVerify($pCopy1["dat"]["passwordS"],$user["hashS"])){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION PASSWORD");return F;}
		$ID = $pCopy1["dat"]["_ID"];}
	// then attempt name sign in
	else if ($successF2){
		$userIDA = DB::dmp("user");
		$userA = π_mapFilter($userIDA,function($userID)use($pCopy2){
			$user = DB::get("user",$userID);if ($user === F){return F;}
			if (!kInA("nameS",$user)){return F;}
			if ($user["nameS"] !== $pCopy2["dat"]["nameS"]){return F;}
			return $user;
		},F);if (count($userA) === 0){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION NAME");return F;}
		$dCopy2 = &$pCopy2["dat"]; // because PHP syntax issues with function()use(&$_[$__]){}
		$user = π_find($userA,function($row)use(&$dCopy2){return pVerify($dCopy2["passwordS"],$row["hashS"]);});if ($user === F){SET_RETURN_MSG("ERROR : BAD AUTHENTICATION PASSWORD");return F;}
		$ID = $user["_ID"];}
	else{return F;}
	$plu = DBM_genPlushie();
	$t = π_now();
	// !!! unlocked hail mary
	$plushieA = kInA("plushieA",$user) ? $user["plushieA"] : [];
	// while we have it open, do cleanup on old plushies
	$plushieA = π_filter($plushieA,function($plushie){return kInA("tEnd",$plushie)&&$plushie["tEnd"]>π_now();}); // !!! esoteric : decide on what the equals case should do, and code it consistently
	$plushieA[] = ["hashS"=>pluHash($plu),"t0"=>$t,"t1"=>$t,"tEnd"=>$t+(28*24*60*60*1000*1000)];
	DB::edt("user",$ID,["plushieA"=>$plushieA]);
	π_aaa($o["dat"],["_ID"=>$ID,"plu"=>$plu]);
	return T;
};
