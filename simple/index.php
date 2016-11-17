<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
ob_start("ob_gzhandler");
require_once("/home/ftbsliceofcake2/gate/gate_575.php");
require_once("../shelfRemote/butler.php");
require_once("../shelfRemote/librarian.php");
//require_once("../shelfRemote/mu.php");
require_once("../shelfRemote/muValidation.php");
require_once("../shelfRemote/specific.php");
function head(){
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head id=\"head\">";
	echo "<meta charset=\"UTF-8\">";
	echo "<meta name=\"description\" content=\"Feel the Beats - Rhythm Game\">";
	echo "<meta name=\"keywords\" content=\"FtB,Rhythm,Game,XceeD\">";
	echo "<meta name=\"author\" content=\"XceeD Illuminati\">";
	echo "<meta name=\"creator\" content=\"XceeD Illuminati\">";
	echo "<meta name=\"publisher\" content=\"XceeD Illuminati\">";
	echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
	echo "<meta name=\"viewport\" content=\"width=device-width,user-scalable=yes,initial-scale=1\">";
	echo "<title>FtB575 /simple/</title>";
	echo "<link href=\"../../image/favicon.png\" rel=\"icon\" type=\"image/png\">";
	echo "<link rel=\"stylesheet\" href=\"../harbor/bootstrap-3.3.7-dist/css/bootstrap.min.css\">";
	echo "<link rel=\"stylesheet\" href=\"../harbor/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css\">";
	echo "<link rel=\"stylesheet\" href=\"../harbor/DataTables/datatables.min.css\">";
	echo "<script src=\"../harbor/jquery-2.2.4.min.js\"></script>";
	echo "<script src=\"../harbor/bootstrap-3.3.7-dist/js/bootstrap.min.js\"></script>";
 	echo "<script src=\"../harbor/DataTables/datatables.min.js\"></script>";
	echo "<style>";
	echo "body{margin:40px;}";
	echo "[data-toggle='collapse']::after{content:'▼';cursor:pointer;}";
	echo "[data-toggle='collapse'].collapsed::after{content:'►';cursor:pointer;}";
	echo "</style>";
	echo "</head>";
	echo "<body>";}
function tail(){
	echo "</body></html>";
	ob_end_flush();
	die;}
function fail($m){
	echo $m;
	tail();}
function pass($m){
	echo $m;
	tail();}
function br(){
	echo "<br>";}
function ruleToEnglish($ruleE){
	if (array_key_exists("min",$ruleE) || array_key_exists("max",$ruleE)){
		if (array_key_exists("min",$ruleE)){echo $ruleE["min"]." ≤ ";}
		switch ($ruleE["type"]){default:;
			break;case "int":echo "whole number";
			break;case "str":echo "symbol-count";
			break;case "fil":echo "Bytes";}
		if (array_key_exists("max",$ruleE)){echo " ≤ ".$ruleE["max"];}
	}
}
//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
head();?>
<h1>Navigation<span data-toggle="collapse" data-target="#collapse-navigation"></span></h1>
<h6>&nbsp;</h6>
<div id="collapse-navigation" class="collapse in">
	<a class="btn btn-info" href="?signin">Go To Sign In/Up Page</a>
	<a class="btn btn-info" href="?signin" target="_blank">Go To Sign In/Up Page [new tab/window]</a>
	<br>
	<?
	$url = "?";
	if (isset($_GET["who"])){$url .= ($url==="?"?"":"&")."who=".str($_GET["who"]);}
	if (isset($_GET["plu"])){$url .= ($url==="?"?"":"&")."plu=".str($_GET["plu"]);}
	?>
	<a class="btn btn-info" href="<?=$url;?>">Go To Action Page</a>
	<a class="btn btn-info" href="<?=$url;?>" target="_blank">Go To Action Page [new tab/window]</a>
</div>
<hr>
<?
if (isset($_GET["signin"])){
	if (isset($_POST["type"]) && $_POST["type"]==="account"){
		require_once("../shelfRemote/muMain.php");
		$dat = [];
		if (isset($_POST["ID"       ])){$dat["ID"       ] = intval($_POST["ID"       ]);}
		if (isset($_POST["nameS"    ])){$dat["nameS"    ] = strval($_POST["nameS"    ]);}
		if (isset($_POST["passwordS"])){$dat["passwordS"] = strval($_POST["passwordS"]);}
		$req_custom = MU_process([["tbl" => "n/a","act" => "FtB575_1|plushie_gen","dat" => $dat]]);
		if ($req_custom[0]["sta"] < 0){fail("error : ".$req_custom[0]["msg"]);}
		else{pass("everything worked out alright<br>Your userID is : ".$req_custom[0]["dat"]["ID"]."<br>Your plushie is : ".$req_custom[0]["dat"]["plu"]."<br><a class=\"btn btn-info\" href=\"?who=".$req_custom[0]["dat"]["ID"]."&plu=".$req_custom[0]["dat"]["plu"]."\">Go To Action Page With This Information Filled In</a>");}
		}?>
	<h1>Sign In (w/username)<span data-toggle="collapse" data-target="#collapse-signinusername"></span></h1>
	<h6>&nbsp;</h6>
	<div id="collapse-signinusername" class="collapse in">
		<form class="form-horizontal" method="post">
			<input type="hidden" name="type" value="account">
			<? $k = "nameS"; ?>
			<div class="form-group">
				<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" size="<?=DB_USERNAME_LENGTH_MAX();?>">
					<p class="help-block">
						Username.
					</p>
				</div>
			</div>
			<? $k = "passwordS"; ?>
			<div class="form-group">
				<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" size="<?=DB_PASSWORD_LENGTH_MAX();?>">
					<p class="help-block">
						Your password.
					</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-info">Sign In w/username</button>
					<button type="submit" class="btn btn-info" formtarget="_blank">Sign In w/username [new tab/window]</button>
					<p class="help-block">
						For most cases, go with "Sign In w/username", since you'll want it to replace this current page.<br>
					</p>
				</div>
			</div>
		</form>
	</div>
	<hr>
	<h1>Sign In (w/userID)<span data-toggle="collapse" data-target="#collapse-signinuserid"></span></h1>
	<h6>&nbsp;</h6>
	<div id="collapse-signinuserid" class="collapse in">
		<form class="form-horizontal" method="post">
			<input type="hidden" name="type" value="account">
			<? $k = "ID"; ?>
			<div class="form-group">
				<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
				<div class="col-sm-10">
					<input type="number" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" min="<?=DB_ID_MIN();?>" max="<?=DB_ID_MAX();?>">
					<p class="help-block">
						Your unique account ID.
					</p>
				</div>
			</div>
			<? $k = "passwordS"; ?>
			<div class="form-group">
				<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" size="<?=DB_PASSWORD_LENGTH_MAX();?>">
					<p class="help-block">
						Your password.
					</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-info">Sign In w/userID</button>
					<button type="submit" class="btn btn-info" formtarget="_blank">Sign In w/userID [new tab/window]</button>
					<p class="help-block">
						For most cases, go with "Sign In w/userID", since you'll want it to replace this current page.<br>
					</p>
				</div>
			</div>
		</form>
	</div>
	<hr>
	<h1>Sign Up (w/username)<span data-toggle="collapse" data-target="#collapse-signupusername"></span></h1>
	<h6>&nbsp;</h6>
	<div id="collapse-signupusername" class="collapse in">
		<a class="btn btn-info" href="?tbl=user&amp;act=new">Go To Account Creation Page</a>
	</div>
	<?tail();}
//======================================================================================================================




//----------------------------------------------------------------------------------------------------------------------
if (!isset($_GET["tbl"])){$import_tbl = NULL;}
else{$import_tbl = $_GET["tbl"];}
//----------------------------------------------------------------------------------------------------------------------
if (!isset($_GET["act"])){$import_act = NULL;}
else{$import_act = $_GET["act"];}
//----------------------------------------------------------------------------------------------------------------------
if (!isset($_GET["id"]) || !is_numeric($_GET["id"]) || intval($_GET["id"]) != floatval($_GET["id"])){$import_id = 0;} // yes, double equals, not triple equals
else{$import_id = intval($_GET["id"]);}
//----------------------------------------------------------------------------------------------------------------------
if (!isset($_GET["who"])){$import_who = NULL;}
else{$import_who = $_GET["who"];}
//----------------------------------------------------------------------------------------------------------------------
if (!isset($_GET["plu"])){$import_plu = NULL;}
else{$import_plu = $_GET["plu"];}
//----------------------------------------------------------------------------------------------------------------------
$closedF = ($import_tbl!==NULL);
?>
<h1>Select A Type Of Form <span<?=($closedF?" class=\"collapsed\"":"");?> data-toggle="collapse" data-target="#collapse-type"></span></h1>
<h6>&nbsp;</h6>
<div id="collapse-type" class="collapse<?=($closedF?"":" in");?>">
	<form class="form-horizontal" method="get">
		<? $k = "tbl"; ?>
		<div class="form-group">
			<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
			<div class="col-sm-10">
				<select class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" required>
					<?foreach (DB_TABLE_ARR() as $v){?>
						<option<?=($import_tbl!==NULL&&$import_tbl===$v?" selected":"");?>><?=$v;?></option><?}?>
				</select>
				<p class="help-block">
					The type of entity.
				</p>
			</div>
		</div>
		<? $k = "act"; ?>
		<div class="form-group">
			<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
			<div class="col-sm-10">
				<select class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" required>
					<?foreach (["dmp","get","new","edt","del"] as $v){?>
						<option<?=($import_act!==NULL&&$import_act===$v?" selected":"");?>><?=$v;?></option><?}?>
				</select>
				<p class="help-block">
					The type of action. [dmp - return all existing entities | get - return a specific existing entity | new - create an entity | edt - edit an existing entity | del - delete an existing entity]
				</p>
			</div>
		</div>
		<? $k = "id"; ?>
		<div class="form-group">
			<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
			<div class="col-sm-10">
				<input type="number" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" min="<?=DB_ID_MIN();?>" max="<?=DB_ID_MAX();?>" value="<?=($import_id!==NULL?$import_id:"");?>">
				<p class="help-block">
					The unique ID of an entity (optional, used for get[get], edt[edit], del[delete]).<br>
					<?=DB_ID_MIN();?> ≤ whole number ≤ <?=DB_ID_MAX();?>
				</p>
			</div>
		</div>
		<? $k = "who"; ?>
		<div class="form-group">
			<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
			<div class="col-sm-10">
				<input type="number" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" min="<?=DB_ID_MIN();?>" max="<?=DB_ID_MAX();?>" value="<?=($import_who!==NULL?$import_who:"");?>">
				<p class="help-block">
					Your identification number (optional, provide along with plushie to access certain actions).<br>
					<?=DB_ID_MIN();?> ≤ whole number ≤ <?=DB_ID_MAX();?>
				</p>
			</div>
		</div>
		<? $k = "plu"; ?>
		<div class="form-group">
			<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" size="60" value="<?=($import_plu!==NULL?$import_plu:"");?>">
				<p class="help-block">
					Your plushie - the identifier used to gain access to certain actions - you get one by signing in.<br>
					0 ≤ symbol-count ≤ 60
				</p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-info">Load</button>
				<button type="submit" class="btn btn-info" formtarget="_blank">Load [new tab/window]</button>
				<p class="help-block">
					For most cases, go with "Load", since you'll want it to replace this current page.<br>
					<span class="text-warning">If you are using the "del" [delete] command, this button will immediately run that delete action on the provided ID.</span>
				</p>
			</div>
		</div>
	</form>
</div>
<?
if ($import_tbl === NULL || $import_act === NULL || $import_id === NULL){tail();}
//if (!array_key_exists($import_tbl,$DBM_VT_COMPLETE)){fail("invalid tbl");}
//$tblE = $DBM_VT_COMPLETE[$import_tbl];
$tblE = DBM_VT_FILTERED($import_tbl,$import_act);
if ($tblE === F){fail("invalid tbl");}?>
<hr>
<h1><?=$_GET["tbl"];?> - <?=$_GET["act"];?> <span data-toggle="collapse" data-target="#collapse-main"></span></h1>
<h6>&nbsp;</h6>
<div id="collapse-main" class="collapse in"><?
	switch ($import_act){default:;
		break;case "get":
		/***/;case "dmp":
			require_once("../shelfRemote/muMain.php");
			if ($import_act === "dmp"){
				$req_dmp = MU_process([["tbl" => $import_tbl,"act" => "dmp","who"=>intval($import_who),"plu"=>$import_plu]]);
				if ($req_dmp[0]["sta"] < 0){fail("error : ".$req_dmp[0]["msg"]);}
				if (count($req_dmp[0]["dat"]["IDA"]) === 0){fail("there aren't any entities to display");}
				$req_get = MU_process([["tbl" => $import_tbl,"act" => "get","dat" => ["IDA"=>$req_dmp[0]["dat"]["IDA"]],"who"=>intval($import_who),"plu"=>$import_plu]]);}
			else if ($import_act === "get"){
				$req_get = MU_process([["tbl" => $import_tbl,"act" => "get","dat" => ["IDA"=>[$import_id]],"who"=>intval($import_who),"plu"=>$import_plu]]);}
			if ($req_get[0]["sta"] < 0){fail("error : ".$req_get[0]["msg"]);}
			if (!isset($req_get[0]["dat"][$import_tbl][0])){fail("no entries");}
			
			// !!! hardcoded file downloads, deal with it until the next core
			foreach ($req_get[0]["dat"][$import_tbl] as &$row){
				if ($import_tbl === "chart"){
					$row["txtR"] = "<a class=\"btn btn-primary\" href=\"".ROOT()["EXT_FILE_CHART"]."txtR_".$row["ID"].$row["txtRExtension_DERIVED"]."\" download>download notes</a>";
					$row["icoR"] = "<a class=\"btn btn-primary\" href=\"".ROOT()["EXT_FILE_CHART"]."icoR_".$row["ID"].$row["icoRExtension_DERIVED"]."\" download>download icon</a>";}}unset($row);
			
			// some rows will have fewer columns than others, so get the max columns
			$headerKA = [];
			foreach ($req_get[0]["dat"][$import_tbl] as $row){
				foreach ($row as $k=>$v){
					if (!in_array($k,$headerKA,TRUE)){
						$headerKA[] = $k;}}}
			
			?>
			<table class="table table-striped table-bordered" cellspacing="0" width="100%" style="display:none;">
				<thead>
					<tr>
						<?foreach ($headerKA as $k){?>
						<td><?=$k;?></td>
						<?}?>
					</tr>
				</thead>
				<tbody><?
			foreach ($req_get[0]["dat"][$import_tbl] as $row){?>
				<tr>
					<?foreach ($headerKA as $k){?>
					<td><?=(array_key_exists($k,$row)?$row[$k]:"<span class=\"text-danger\">[hidden]</span>");?></td>
					<?}?>
				</tr><?}?>
				</tbody>
			</table>
			<script>
			var resTable;
			$(document).ready(function(){
				$("table").show();
				resTable = $("table").DataTable({
					scrollY : (window.innerHeight-300),
					scrollCollapse: true,
					scrollX : true,
					paging  : false,
				});
				$(window).resize(function(){
					var table = $("table").DataTable();
					$(".dataTables_scrollBody").css("height",(window.innerHeight-300)+"px");
					table.draw();
				});
			});
			</script>
			<?
		break;case "del":
			require_once("../shelfRemote/muMain.php");
			$req_del = MU_process([["tbl" => $import_tbl,"act" => "del","dat" => ["ID"=>intval($import_id)],"who"=>intval($import_who),"plu"=>$import_plu]]);
			if ($req_del[0]["sta"] < 0){fail("error : ".$req_del[0]["msg"]);}
			else{pass("everything worked out alright");}
		break;case "new":
		/***/;case "edt":
			if (isset($_POST["type"]) && $_POST["type"]==="main"){
				//echo "_POST<br>";var_export($_POST);echo "<br><br>";
				//echo "_FILES<br>";var_export($_FILES);echo "<br><br>";
				$dat = [];
				if ($import_act === "edt"){
					$dat["ID"] = intval($_POST["id"]);}
				// get a list of checkmarked properties
				$kApprovedA = [];
				foreach ($_POST as $k=>$v){
					if (mb_substr($k,0,mb_strlen("checkbox-")) !== "checkbox-"){continue;}
					$kApprovedA[] = mb_substr($k,mb_strlen("checkbox-"));}
				// resolve that list to actual properties, set them
				//var_export($_POST);echo"<br><br>";
				//var_export($kApprovedA);echo"<br><br>";
				foreach ($kApprovedA as $k){//echo "[".$k."]";
					if (!array_key_exists($k,$_POST)){continue;}
					if (!array_key_exists("type-".$k,$_POST)){continue;}
					$type = $_POST["type-".$k];
					//echo "[".$type."]";
					$v = $_POST[$k];
					switch ($type){default:;
						break;case "int":$dat[$k] = intval($v);
						break;case "str":$dat[$k] = strval($v);}}
				//var_export($dat);
				require_once("../shelfRemote/muMain.php");
				$req_dmp = MU_process([["tbl" => $import_tbl,"act" => $import_act,"dat" => $dat,"who"=>intval($import_who),"plu"=>$import_plu]]);
				if ($req_dmp[0]["sta"] < 0){fail("error : ".$req_dmp[0]["msg"]);}
				else{pass("everything worked out alright");}
			}
			?>
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="type" value="main">
				<input type="hidden" name="id" value="<?=$import_id;?>">
			<?
			foreach ($tblE as $k=>$ruleE){
				if ($k === "ID"){continue;} // we already account for ID
				if (array_key_exists("vA",$ruleE)){?>
					<div class="form-group">
						<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
						<div class="col-sm-10">
							<input type="hidden" name="type-<?=$k;?>" value="<?=$ruleE["type"];?>">
							<select class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>"<?=($import_act==="edt"||array_key_exists("default",$ruleE)?"":" required");?>>
								<?foreach ($ruleE["vA"] as $v){?>
									<option<?=(array_key_exists("default",$ruleE)&&$ruleE["default"]===$v?" selected":"");?>><?=$v;?></option><?}?>
							</select>
							<p class="help-block">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox-<?=$k;?>" value="on" oninput="document.getElementById('').setAttribute('name','')">
										I want to set to this property.
									</label>
								</div>
								<?=$ruleE["help"];?><br>
								<?=ruleToEnglish($ruleE);?>
							</p>
						</div>
					</div><?}
				else{
					switch ($ruleE["type"]){default:;
						break;case "int":?>
							<div class="form-group">
								<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
								<div class="col-sm-10">
									<input type="hidden" name="type-<?=$k;?>" value="<?=$ruleE["type"];?>">
									<input type="number" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" placeholder="<?=(array_key_exists("default",$ruleE)?$ruleE["default"]:"");?>"<?=(array_key_exists("min",$ruleE)?" min=\"".$ruleE["min"]."\"":"");?><?=(array_key_exists("max",$ruleE)?" max=\"".$ruleE["max"]."\"":"");?><?=($import_act==="edt"||array_key_exists("default",$ruleE)?"":" required");?>>
									<p class="help-block">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="checkbox-<?=$k;?>" value="on">
												I want to set to this property.
											</label>
										</div>
										<?=$ruleE["help"];?><br>
										<?=ruleToEnglish($ruleE);?>
									</p>
								</div>
							</div><?
						//echo "<textarea class=\"form-control\" rows=\"3\"></textarea>";
						break;case "str":?>
							<div class="form-group">
								<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
								<div class="col-sm-10">
									<input type="hidden" name="type-<?=$k;?>" value="<?=$ruleE["type"];?>"><?
									if (array_key_exists("max",$ruleE) && $ruleE["max"] < 500){?>
										<input type="text" class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" placeholder="<?=(array_key_exists("default",$ruleE)?$ruleE["default"]:"");?>"<?=(array_key_exists("max",$ruleE)?" size=\"".$ruleE["max"]."\"":"");?><?=($import_act==="edt"||array_key_exists("default",$ruleE)?"":" required");?>><?}
									else{?>
										<textarea class="form-control" id="slot-<?=$k;?>" name="<?=$k;?>" placeholder="blah" rows="3"<?=(array_key_exists("max",$ruleE)?" size=\"".$ruleE["max"]."\"":"");?><?=($import_act==="edt"||array_key_exists("default",$ruleE)?"":" required");?>></textarea><?}?>
									<p class="help-block">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="checkbox-<?=$k;?>" value="on">
												I want to set to this property.
											</label>
										</div>
										<?=$ruleE["help"];?><br>
										<?=ruleToEnglish($ruleE);?>
									</p>
								</div>
							</div><?
						break;case "fil":?>
							<div class="form-group">
								<label for="slot-<?=$k;?>" class="col-sm-2 control-label"><?=$k;?></label>
								<div class="col-sm-10">
									<input type="hidden" name="type-0_<?=$k;?>" value="<?=$ruleE["type"];?>">
									<input type="file" class="form-control" id="slot-<?=$k;?>" name="0_<?=$k;?>"<?=($import_act==="edt"||array_key_exists("default",$ruleE)?"":" required");?>>
									<p class="help-block">
										This property will always be asserted if you provide a file.<br>
										<?=$ruleE["help"];?><br>
										<?=ruleToEnglish($ruleE);?>
									</p>
								</div>
							</div><?}}}?>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<?switch ($import_act){default:;
							break;case "get":;
							break;case "new":?>
								<button type="submit" class="btn btn-info" formtarget="_blank">Attempt To Create This "<?=$import_tbl;?>" [new tab/window]</button>
								<button type="submit" class="btn btn-info">Attempt To Create This "<?=$import_tbl;?>"</button><?;
							break;case "edt":?>
								<button type="submit" class="btn btn-info" formtarget="_blank">Attempt To Edit This "<?=$import_tbl;?>" [new tab/window]</button>
								<button type="submit" class="btn btn-info">Attempt To Edit This "<?=$import_tbl;?>"</button><?;
						}?>
					<?if ($import_act!=="get"){?>
						<p class="help-block">
							For most cases, go with the "[new tab/window]" button. Then, if there's an error, you can look back at the data you entered and try to submit it again, easily.
						</p>
						<?}?>
					</div>
				</div>
			</form><?
	// end switch(act)
	}?>
</div><?
/*

//has-success
//has-warning
//has-error

<label class="sr-only" for="inputHelpBlock">Input with help text</label>
<input type="text" id="inputHelpBlock" class="form-control" aria-describedby="helpBlock">
...
<span id="helpBlock" class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>

// white
<button type="button" class="btn btn-default">Default</button>
// blue
<button type="button" class="btn btn-primary">Primary</button>
<button type="button" class="btn btn-success">Success</button>
// cyan
<button type="button" class="btn btn-info">Info</button>
<button type="button" class="btn btn-warning">Warning</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-link">Link</button>

<img src="..." alt="..." class="img-rounded">
<img src="..." alt="..." class="img-circle">
<img src="..." alt="..." class="img-thumbnail">

<p class="text-muted">...</p>
<p class="text-primary">...</p>
<p class="text-success">...</p>
<p class="text-info">...</p>
<p class="text-warning">...</p>
<p class="text-danger">...</p>

<p class="bg-primary">...</p>
<p class="bg-success">...</p>
<p class="bg-info">...</p>
<p class="bg-warning">...</p>
<p class="bg-danger">...</p>*/
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
tail(); ?>