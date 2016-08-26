<? //<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /boards/</title><link href="../image/favicon.png" rel="icon" type="image/png">?>
<? //<body></body></html>?>
<? //die; ?>
<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /boards/</title><link href="../image/favicon.png" rel="icon" type="image/png">

<script>
<?
require_once("../shelf/butler.js");
require_once("../shelf/specific.js");
require_once("../shelf/rho.js"); ?>
</script>
<script>
p.colorMash = function(tx,co,bg){
	return [tx.concat(co).concat(bg).map(v=>Math.round(v*1000))].toString();};
p.asrColorProfile = function(tx,co,bg){
	var colorMash = p.colorMash(tx,co,bg);
	var css = ø.asrStyle(tx,co,bg,π.reductionRatio(p.rrx,p.rry),"[data-color='"+colorMash+"']");
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":colorMash},css:css}));
	return p.colorMash(tx,co,bg);};
p.draftToggle = function(dataFor){
	var el = µ.qd("body>¥draft[data-for='"+dataFor+"']");
	if (getComputedStyle(el).display === "none"){p.draftAssert(dataFor);}
	else{p.draftDessert(dataFor);}};
p.draftAssert = function(dataFor){
	for (var el of µ.qdA("body>¥draft")){
		el.style.display = (µ.matches(el,"[data-for='"+dataFor+"']")) ? "block" : "none";}};
p.draftDessert = function(dataFor){
	var el = µ.qd("body>¥draft[data-for='"+dataFor+"']");
	if (el !== null){
		el.style.display = "none";}};
p.asrStyle = function(mode="root",dataUnique="root",o={}){
	var rr = π.reductionRatio(p.rrx,p.rry);
	var {tx,co,bg} = p;
	var a = (typeof bg[3] === "undefined" ? 1 : bg[3]);
	var fxnFilter = m=>Math.ceil(m);
	var rrn = (n)=>fxnFilter(rr*n);
	var bottomDraftW   = rrn(100);
	var bottomButtonW  = rrn(70);
	var bottomIDW      = rrn(70);
	var bottomControlW = rrn(70);
	var postControlButtonW = rrn(40);
	var iconS          = rrn(22);
	
	var css = ø.asrStyle(tx,co,bg,rr);
	switch (mode){default:
	break;case "root":
		π.ooAbsorb(css,{
			".C"             : "¥w:auto;",
			".C>.row"        : "¥:relative;¥w:1000‰;",
			".C>.row>.BSCSS" : "¥:inline-block;¥w:1000‰;",
			
			"body>¥nav" : "¥:absolute;¥:NW;¥:flex-row;¥w:1000‰;¥bgc:"+hslma(bg,co,0.8,0.8)+";¥bb:5px double "+hslma(co,bg,0.6)+";",
			"body>¥nav>¥breadcrumb"        : "¥flex-ls:none;¥:one-row;¥fs:1300‰;¥p:"+rrn(3)+"px;",
			"body>¥nav>¥breadcrumb>*"      : "¥:inline;",
			"body>¥nav>¥breadcrumb>a"      : "",
			"body>¥nav>¥breadcrumb>¥split" : "",
			"body>¥nav>¥who"               : "¥flex-rw:"+rrn(100)+"px;¥:one-row;¥fs:1300‰;¥p:"+rrn(3)+"px;",
			"body>¥nav>¥who>span"  : "¥f:right;",
			
			"body>¥bst"                                       : "¥s:1000‰;¥oy:auto;",
			"body>¥bst>*"                      : "¥f:left;",
			"body>¥bst>.shadow"                               : "¥w:1000‰;",
			"body>¥bst>.C"                                    : "¥w:1000‰;",
			"body>¥bst>.C>*"                                  : "¥w:1000‰;¥f:left;",
			"body>¥bst>.C>*>¥top"                             : "¥w:1000‰;¥p:"+rrn(4)+"px;background:linear-gradient(90deg,"+hslma(co,bg,0.15,a)+","+hsla(bg,a)+");",
			"body>¥bst>.C>*>¥top>¥A"                          : "¥w:1000‰;¥fs:1500‰;¥c:"+hslma(co,tx,0.8)+";font-weight:bold;white-space:nowrap;¥o:hidden;",
			"body>¥bst>.C>*>¥top>¥B"                          : "¥w:1000‰;¥fs:1000‰;¥c:"+hslma(co,bg,0.8)+";white-space:nowrap;¥o:hidden;",
			"body>¥bst>.C>*>.C"                      : "¥w:1000‰;",
			"body>¥bst>.C>*>.C>*"                    : "¥f:left;",
			"body>¥bst>.C>*>.C>.split"               : "¥w:1000‰;¥h:0px;¥bgc:"+hsla(bg,a)+";¥bt:1px dotted "+hslma(bg,tx,0.8)+";",
			"body>¥bst>.C>*>.C:not(¥post)>*:not(.split)"        : /*¥:block;*/"¥w:1000‰;¥bgc:"+hsla(bg,a)+";¥bo:1px solid transparent;¥:hand;",
			"body>¥bst>.C>*>.C:not(¥post)>*:not(.split):hover"  : "¥w:1000‰;¥bgc:"+hslma(bg,co,0.8,a)+";¥bc:"+hslma(bg,co,0.6,a)+";",
			//"body>¥bst>.C>*>.C:not(¥post)>*>*"          : "¥:inline-block;¥p:"+rrn(4)+"px;",
			//"body>¥bst>.C>*>.C:not(¥post)>*>*>¥A"       : "¥w:1000‰;¥fs:1200‰;¥c:"+hslma(tx,co,0.6)+";white-space:nowrap;¥o:hidden;",
			//"body>¥bst>.C>*>.C:not(¥post)>*>*>¥B"       : "¥w:1000‰;¥fs: 800‰;¥c:"+hslmma(tx,co,bg,0.8,0.6)+";white-space:nowrap;¥o:hidden;",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥A"         : "¥w: 500‰;",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥A>¥A"      : "",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥A>¥B"      : "",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥B"         : "¥w: 100‰;",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥B>*"       : "¥ta:center;",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥B>¥A"      : "",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥B>¥B"      : "",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥D"         : "¥w: 300‰;",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥D>¥A"      : "",
			//"body>¥bst>.C>*>.C:not(¥post)>*>¥D>¥B"      : "",
			
			"body>¥bst>.C>*>.C>¥subboard>*"      : "¥p:"+rrn(3)+"px;",
			"body>¥bst>.C>*>.C>¥thread>*"        : "¥p:"+rrn(3)+"px;",
			
			"body>¥bst>.C>*>.C>¥subboard"        : "¥:flex-row;¥w:1000‰;text-decoration:none;",
			"body>¥bst>.C>*>.C>¥subboard>*>¥A"   : "¥fs:1200‰;¥c:"+hslma(tx,co,0.6)+";¥:one-row;",
			"body>¥bst>.C>*>.C>¥subboard>*>¥B"   : "¥fs: 800‰;¥c:"+hslmma(tx,co,bg,0.8,0.6)+";¥:one-row;",
			"body>¥bst>.C>*>.C>¥subboard>¥A"     : "¥flex-ls:none;¥:one-row;",
			"body>¥bst>.C>*>.C>¥subboard>¥B"     : "¥flex-ss:"+rrn( 50)+"px;¥:one-row;¥ta:center;",
			"body>¥bst>.C>*>.C>¥subboard>¥C"     : "¥flex-ss:"+rrn( 50)+"px;¥:one-row;¥ta:center;",
			"body>¥bst>.C>*>.C>¥subboard>¥D"     : "¥flex-ss:"+rrn( 50)+"px;¥:one-row;¥ta:center;",
			"body>¥bst>.C>*>.C>¥subboard>¥E"     : "¥flex-ss:"+rrn(180)+"px;¥:one-row;",
			
			"body>¥bst>.C>*>.C>¥thread"          : "¥:flex-row;¥w:1000‰;text-decoration:none;",
			"body>¥bst>.C>*>.C>¥thread>*>¥A"     : "¥fs:1200‰;¥c:"+hslma(tx,co,0.6)+";¥:one-row;",
			"body>¥bst>.C>*>.C>¥thread>*>¥B"     : "¥fs: 800‰;¥c:"+hslmma(tx,co,bg,0.8,0.6)+";¥:one-row;",
			"body>¥bst>.C>*>.C>¥thread>¥A"       : "¥flex-ls:none;¥:one-row;¥p:"+rrn(3)+"px;",
			"body>¥bst>.C>*>.C>¥thread>¥B"       : "¥flex-ss:"+rrn( 50)+"px;¥:one-row;¥ta:center;",
			"body>¥bst>.C>*>.C>¥thread>¥C"       : "¥flex-ss:"+rrn( 50)+"px;¥:one-row;¥ta:center;",
			"body>¥bst>.C>*>.C>¥thread>¥D"       : "¥flex-ss:"+rrn( 50)+"px;¥:one-row;¥ta:center;",
			"body>¥bst>.C>*>.C>¥thread>¥E"       : "¥flex-ss:"+rrn( 50)+"px;¥:one-row;¥ta:center;",
			"body>¥bst>.C>*>.C>¥thread>¥F"       : "¥flex-ss:"+rrn(180)+"px;¥:one-row;",
			
			"body>¥bst>.C>*>.C>¥post"            : "¥w:1000‰;",
			"body>¥bst>.C>*>.C>¥post>¥A"         : "¥:flex-row;¥h:"+iconS+"px;",
			"body>¥bst>.C>*>.C>¥post>¥A>¥A"      : "¥flex-ss:"+iconS+"px;",
			"body>¥bst>.C>*>.C>¥post>¥A>¥B"      : "¥flex-lw:"+rrn(100)+"px;¥:one-row;¥p:"+rrn(3)+"px;",
			"body>¥bst>.C>*>.C>¥post>¥A>¥C"      : "¥flex-rs:none;¥:one-row;¥p:"+rrn(3)+"px;",
			"body>¥bst>.C>*>.C>¥post>¥A>¥C>span" : "¥f:right;",
			"body>¥bst>.C>*>.C>¥post>¥A>¥C *"    : "¥:inline;",
			"body>¥bst>.C>*>.C>¥post>¥A>.BSCSS"  : "¥flex-ss:"+postControlButtonW+"px;¥h:auto;",
			"body>¥bst>.C>*>.C>¥post>¥B"         : "word-wrap:break-word;¥p:"+rrn(6)+"px;¥w:1000‰;¥hmax:"+rrn(400)+"px;¥o:auto;",
			
			"body>.C¥control"         : "¥:absolute;¥:SW;¥w:calc(1000‰ - "+(2*bottomDraftW)+"px);",
			"body>.C¥control>.BSCSS"  : "¥:block;¥w:"+bottomControlW+"px;¥f:left;",
			
			"body>¥draft"                               : "¥:absolute;¥:SE;¥w:1000‰;¥bgc:"+hslma(bg,co,0.6,0.6)+";¥bt:5px double "+hslma(co,bg,0.6)+";",
			"body>¥draft>[data-label='Thread Title']"   : "¥:block;¥w:1000‰;",
			"body>¥draft>[data-label='Thread Message']" : "¥:block;¥w:1000‰;¥h:140px;",
			"body>¥draft>[data-label='Post Message']"   : "¥:block;¥w:1000‰;¥h:140px;",
			"body>¥draft>¥bottom"                       : "¥:block;",
			"body>¥draft>¥bottom>*"                     : "¥:block;¥f:left;",
			"body>¥draft[data-for='post']>¥bottom>[data-label='Post']"    : "¥w:calc(1000‰ - "+(bottomDraftW*2+bottomButtonW+bottomIDW)+"px);",
			"body>¥draft[data-for='post']>¥bottom>[data-label='Edit']"    : "¥w:"+bottomButtonW+"px;",
			"body>¥draft[data-for='post']>¥bottom>[data-label='Post ID']" : "¥w:"+bottomIDW+"px;",
			"body>¥draft[data-for='thread']>¥bottom>[data-label='Post']"    : "¥w:calc(1000‰ - "+(bottomDraftW)+"px);",
			"body>¥draft[data-for='thread']>¥bottom>[data-label='Edit']"    : "¥w:calc(1000‰ - "+(bottomDraftW*2)+"px);",
			"body>.C¥draftTrigger"                             : "¥:absolute;¥:SE;",
			"body>.C¥draftTrigger>.BSCSS"                      : "¥:block;¥w:"+bottomDraftW+"px;¥f:right;",
			});}
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":dataUnique},css:css}));};
p.asrStyleDynamic = function(){
	var el,elA,elShadow;
	if ((el=µ.qd("body>¥nav"  )) !== null && (elShadow=µ.qd("body>¥bst>.shadow¥nav"  )) !== null){
		var display = getComputedStyle(el).display;
		el.style.display = "flex";
		elShadow.style.height = el.offsetHeight+"px";
		el.style.display = display;}
	if ((elA=µ.qdA("body>¥draft")).length !== 0 && (elShadow=µ.qd("body>¥bst>.shadow¥draft")) !== null){
		var heightA = [];
		for (var el of elA){
			var display = getComputedStyle(el).display;
			el.style.display = "block";
			heightA.push(el.offsetHeight);
			el.style.display = display;}
		elShadow.style.height = heightA.reduce((p,v)=>Math.max(p,v))+"px";};}
document.addEventListener("DOMContentLoaded",()=>{
	p.onAuth = function(){
		core.send({tbl:"board",act:"dmp",prc:"root"});
		p.procO.root.render();};
	p.procO.root = p.procSetup();
	p.procO.root.name     = "root";
	p.procO.root.rcv = function(o={}){
		π.ooaw(o,{
			o          : {},
			intersectF : false,});
		switch (o.o.mir.act){default:
		break;case "new":case "del":
			switch (o.o.mir.tbl){default:
			break;case "thread"   : p.procRush(this,"subboard",this.subboardID);p.memexe();
			break;case "post"     : p.procRush(this,"thread"  ,this.threadID  );p.memexe();}
		break;case "edt":
			switch (o.o.mir.tbl){default:
			break;case "subboard" : p.procRush(this,"subboard",o.mir.dat.ID);p.memexe();
			break;case "thread"   : p.procRush(this,"thread"  ,o.mir.dat.ID);p.memexe();
			break;case "post"     : p.procRush(this,"post"    ,o.mir.dat.ID);p.memexe();}}};
	p.procO.root.poke = function(){};
	p.procO.root.subboardID = undefined;
	p.procO.root.threadID   = undefined;
	p.procO.root.postID     = undefined;
	p.procO.root.render = function(o={}){
		π.ooaw(o,{
			rush    : F,
			display : T,
			o       : {},});
		var tA = p.now();
		//ll("render start : "+0);
		π.ooAbsorb(o,{hashOverride:undefined},{blockDuplicates:true});
		var [_,subboardID,threadID,postID] = /(?:#([^>]*)(?:>([^>]*))?(?:>([^>]*))?)?/g.exec((typeof o.hashOverride === "undefined") ? window.location.hash : o.hashOverride);
		subboardID = (typeof subboardID !== "undefined" && str(int(subboardID)) === subboardID) ? int(subboardID) : undefined;
		threadID   = (typeof threadID   !== "undefined" && str(int(threadID  )) === threadID  ) ? int(threadID  ) : undefined;
		postID     = (typeof postID     !== "undefined" && str(int(postID    )) === postID    ) ? int(postID    ) : undefined;
		var which;
		if      (typeof postID     !== "undefined"){which = "thread"  ;}
		else if (typeof threadID   !== "undefined"){which = "thread"  ;}
		else if (typeof subboardID !== "undefined"){which = "subboard";}
		else                                       {which = "board"   ;}
		if (o.display){π.ooAbsorb(this,{subboardID,threadID,postID});}
		//------------------------------------------------------------------------------------------------------------------------
		// boards and subboards
		if (which === "board"){
			this.tblxIDA.subboard = [];
			var macro = ["body",[
				["¥bst",[
					[".shadow¥nav"],
					[".C¥board",p.tblxleafO.board.mapV((board,boardID)=>int(boardID)).sort((a,b)=>{
						var board_a = p.procNeedsOrRush(o.rush,this,"board",a);
						var board_b = p.procNeedsOrRush(o.rush,this,"board",b);
						return jj(board_a,"order",0)-jj(board_b,"order",0);
					}).map(boardID=>{
						var board = p.procNeeds(this,"board",boardID);
						return ["¥board",[
							["¥top",[
								["¥A",[
									p.mName(jj(board,"name"),jj(board,"ID")),]],
								["¥B",board.info],]],
							[".C¥subboard",µ.msplit(board.subboardIDA.sort((a,b)=>{
								var subboard_a = p.procNeedsOrRush(o.rush,this,"subboard",a);
								var subboard_b = p.procNeedsOrRush(o.rush,this,"subboard",b);
								return jj(subboard_a,"order",0)-jj(subboard_b,"order",0);
							}).map(subboardID=>{
								var subboard = p.procNeeds(this,"subboard",subboardID);
								return ["a¥subboard[href='#"+subboardID+"']",{mouseenter:()=>{this.render({rush:false,display:false,o:{hashOverride:"#"+subboardID}});},},[
									["¥A",[
										["¥A",[
											p.mName(jj(subboard,"name"),jj(subboard,"ID")),]],
										["¥B",jj(subboard,"info")],]],
									["¥B",[
										["¥A",jj(subboard,"threadC_DERIVED")],
										["¥B",(jj(subboard,"threadC_DERIVED")===1)?"Thread":"Threads"],]],
									["¥C",[
										["¥A",jj(subboard,"postC_DERIVED")],
										["¥B",(jj(subboard,"postC_DERIVED")===1)?"Post":"Posts"],]],
									["¥D",[
										["¥A",π.multiChar("✦",jj(subboard,"starC",0))],
										["¥B",(jj(subboard,"starC",0)===0?"":"draft")],]],
									["¥E",[
										["¥A",π.timestampToEnglish(jj(subboard,"timeUpdate_DERIVED",null),"minute")],
										["¥B","Most Recent Post/Edit"],]],
								]];}),[".split"])],]]})],]],
				["¥nav",[
					["¥breadcrumb",[
						["a[href='..']",[
							p.mName("FtB",575),]],
						["¥split"," → "],
						["a[href='#']","/boards/"],]],
					[".C¥control"],
					["¥who",[
						["span"],]],]],
			]];
			if (o.display){µ.rr(document.body,µ.m(macro));}}
		//------------------------------------------------------------------------------------------------------------------------
		// subboard and threads
		if (which === "subboard"){
			this.tblxIDA.subboard = [];
			this.tblxIDA.thread   = [];
			this.tblxIDA.user     = [];
			var subboard = p.procNeedsOrRush(o.rush,this,"subboard",subboardID);
			var macro = ["body",[
				["¥bst",[
					[".shadow¥nav"],
					[".C¥subboard",[
						["¥subboard",[
							["¥top",[
								["¥A",[
									p.mName(jj(subboard,"name"),jj(subboard,"ID")),]],
								["¥B",jj(subboard,"info")],]],
							[".C¥thread",µ.msplit(jj(subboard,"threadIDA",[]).sort((a,b)=>{
								var thread_a = p.procNeedsOrRush(o.rush,this,"thread",a);
								var thread_b = p.procNeedsOrRush(o.rush,this,"thread",b);
								var sort_a = jj(thread_b,"sticky",0)-jj(thread_a,"sticky",0);
								var sort_b = jj(thread_b,"timeUpdate_DERIVED",0)-jj(thread_a,"timeUpdate_DERIVED",0);
								return (sort_a === 0) ? sort_b : sort_a;
							}).map(threadID=>{
								var thread = p.procNeedsOrRush(o.rush,this,"thread",threadID);
								var user   = p.procNeedsOrRush(o.rush,this,"user",jj(thread,"userID",0));
								var [tx,co,bg,a] = [
									[jj(user,"htx",p.bg[0]*1000)*0.001,jj(user,"stx",p.bg[1]*1000)*0.001,jj(user,"ltx",p.bg[2]*1000)*0.001],
									[jj(user,"hco",p.bg[0]*1000)*0.001,jj(user,"sco",p.bg[1]*1000)*0.001,jj(user,"lco",p.bg[2]*1000)*0.001],
									[jj(user,"hbg",p.bg[0]*1000)*0.001,jj(user,"sbg",p.bg[1]*1000)*0.001,jj(user,"lbg",p.bg[2]*1000)*0.001,jj(user,"a",p.bg[3]*1000)*0.001],
									jj(user,"a",p.bg[3]*1000)*0.001,];
								var colorMash = p.asrColorProfile(tx,co,bg);
								return ["a¥thread[href='#"+subboardID+">"+threadID+"'][data-color='"+colorMash+"']",{mouseenter:()=>{this.render({rush:false,display:false,o:{hashOverride:"#"+subboardID+">"+threadID}});},},[
									["¥A",[
										["¥A",[
											p.mName(jj(thread,"censored",0)===0?jj(thread,"name"):"▬▬censored▬▬",jj(thread,"ID")),
											(jj(thread,"censored",0)===0?null:[".pin","✕ censored"]),]],
										["¥B",[
											p.mName(jj(user,"name"),jj(thread,"userID")),]],]],
									["¥B",[
										["¥A",jj(thread,"replyC_DERIVED")],
										["¥B",(jj(thread,"replyC_DERIVED")===1)?"Reply":"Replies"],]],
									["¥C",[
										["¥A",jj(thread,"viewC_DERIVED")],
										["¥B",(jj(thread,"viewC_DERIVED")===1)?"View":"Views"],]],
									["¥D",[
										["¥A",{"1":"Ⓧ","0":""}[jj(thread,"locked",0).toString()]],
										["¥B",{"1":"locked","0":""}[jj(thread,"locked",0).toString()]],]],
									["¥E",[
										["¥A",{"1":"↑","0":"","-1":"↓"}[jj(thread,"sticky",0).toString()]],
										["¥B",{"1":"light","0":"","-1":"heavy"}[jj(thread,"sticky",0).toString()]],]],
									["¥F",[
										["¥A",π.timestampToEnglish(jj(thread,"timeUpdate_DERIVED",null),"minute")],
										["¥B","Most Recent Post/Edit"],]],
								]];}),[".split"])],]],]],
					[".shadow¥draft"],]],
				["¥draft[data-for='thread'][style='¥:none;']",[
					µ.bscss("Thread Title",["input[placeholder='I Love FtB! <3']"]),
					µ.bscss("Thread Message",["textarea[placeholder='Yeah.']"]),
					["¥bottom",[
						µ.bscss("Post",[".button",{click:function(subboardID){return function(){core.send({tbl:"thread",act:"new",dat:{subboardID,name:µ.qbscss(this.parentNode,"Thread Title").value,message:µ.qbscss(this.parentNode,"Thread Message").value}});};}(subboardID),}]),]],]],
				[".C¥draftTrigger",[
					µ.bscss("Draft Thread",[".button",{click:function(){p.draftToggle("thread");},}]),]],
				["¥nav",[
					["¥breadcrumb",[
						["a[href='..']",[
							p.mName("FtB",575),]],
						["¥split"," → "],
						["a[href='#']","/boards/"],
						["¥split"," → "],
						["a[href='#"+subboardID+"']",[
							p.mName(jj(subboard,"name"),jj(subboard,"ID")),]],]],
					[".C¥control"],
					["¥who",[
						["span"],]],]],
			]];
			if (o.display){µ.rr(document.body,µ.m(macro));}}
		//------------------------------------------------------------------------------------------------------------------------
		// thread and posts
		if (which === "thread"){
			// stalker log, with mini gate to just make the server's life better
			if (o.display && threadID >= 1){core.send({tbl:"n/a",act:"ftb575_threadView",dat:{threadID},patient:1000000});}
			this.tblxIDA.thread   = [];
			this.tblxIDA.user     = [];
			this.tblxIDA.post     = [];
			var subboard = p.procNeedsOrRush(o.rush,this,"subboard",subboardID);
			var thread   = p.procNeedsOrRush(o.rush,this,"thread",threadID);
			var user     = p.procNeedsOrRush(o.rush,this,"user",jj(thread,"userID",0));
			var _ = jj(thread,"subboardID",null);
			if (_ !== null && _ !== subboardID){window.location.hash = "#"+subboardID+">"+threadID;}
			var macro = ["body",[
				["¥bst",[
					[".shadow¥nav"],
					[".C¥thread",[
						["¥thread",[
							["¥top",[
								["¥A",[
									p.mName(jj(thread,"censored",0)===0?jj(thread,"name"):"▬▬censored▬▬",jj(thread,"ID")),
									(jj(thread,"locked",0).toString()==="0"?null:[".pin",{"1":"Ⓧ locked","0":""}[jj(thread,"locked",0).toString()]]),
									(jj(thread,"sticky",0).toString()==="0"?null:[".pin",{"1":"↑ light","0":"","-1":"↓ heavy"}[jj(thread,"sticky",0).toString()]]),
									(jj(thread,"censored",0)===0?null:[".pin","✕ censored"]),]],
								["¥B",[
									p.mName(jj(user,"name"),jj(thread,"userID")),]],]],
							[".C¥post",µ.msplit([threadID].concat(jj(thread,"postIDA",[])).map((postID,i)=>{
								var threadF = (i === 0);
								var post = threadF ? thread : p.procNeedsOrRush(o.rush,this,"post",postID);
								//var path = "#"+subboardID+">"+threadID+(threadF?"":(">"+postID));
								var user = p.procNeedsOrRush(o.rush,this,"user",jj(post,"userID",0));
								var [tx,co,bg,a] = [
									[jj(user,"htx",p.bg[0]*1000)*0.001,jj(user,"stx",p.bg[1]*1000)*0.001,jj(user,"ltx",p.bg[2]*1000)*0.001],
									[jj(user,"hco",p.bg[0]*1000)*0.001,jj(user,"sco",p.bg[1]*1000)*0.001,jj(user,"lco",p.bg[2]*1000)*0.001],
									[jj(user,"hbg",p.bg[0]*1000)*0.001,jj(user,"sbg",p.bg[1]*1000)*0.001,jj(user,"lbg",p.bg[2]*1000)*0.001,jj(user,"a",p.bg[3]*1000)*0.001],
									jj(user,"a",p.bg[3]*1000)*0.001,];
								var colorMash = p.asrColorProfile(tx,co,bg);
								return ["¥post"+(threadF?"":"[data-id='"+postID+"'][data-color='"+colorMash+"']"),[
									["¥A[style='¥c:"+hslma(tx,co,0.85)+";¥bgc:"+hslma(bg,co,0.85,a)+";']",[
										[".icon¥A[style='¥bgi:url("+π.urlEncode(jj(user,"iconPath"))+");']"],
										["¥B",[
											p.mName(jj(user,"name"),jj(user,"ID")),]],
										["¥C",[
											["span",[
												(jj(post,"censored",0)===0
												? null
												: ["","✕ "]),
												["¥A",π.timestampToEnglish(jj(post,"time",null),"minute")],
												(jj(post,"time")===jj(post,"timeUpdateMessage")
													? null
													: ["¥split"," → "]),
												(jj(post,"time")===jj(post,"timeUpdateMessage")
													? null
													: ["¥B",π.timestampToEnglish(jj(post,"timeUpdateMessage",null),"minute")]),
												(threadF
													? null
													: ["","#"+postID]),]],]],
										(threadF
											? null
											: ((jj(p.user,"ID",0) === jj(post,"userID",0))
												? µ.bscss("Edt.",[".button",{click:()=>{
													µ.qd("¥draft[data-for='post']>[data-label='Post Message']>:not(.label)").value = jj(post,"message");
													µ.qd("¥draft[data-for='post']>¥bottom>[data-label='Post ID']>:not(.label)").value = postID;
													p.draftAssert("post");},}])
												: null)),
										(threadF
											? null
											: ((jj(p.user,"starC",0) >= 1)
												? ((jj(post,"censored",0) === 0)
													? µ.bscss("Cen.",[".button",{click:()=>{core.send({tbl:"post",act:"edt",dat:{ID:postID,censored:1}});},}])
													: µ.bscss("Unc.",[".button",{click:()=>{core.send({tbl:"post",act:"edt",dat:{ID:postID,censored:0}});},}]))
												: null)),
										(threadF
											? null
											: (((jj(p.user,"starC",0) >= 1) || (jj(p.user,"ID",0) === jj(post,"userID",0)))
												? µ.bscss("Del.",[".button",{click:()=>{core.send({tbl:"post",act:"del",dat:{ID:postID}});},}])
												: null)),]],
									{d:{"data-type":"B",style:"¥c:"+hslma(tx,co,0.95)+";¥bgc:"+hslma(bg,co,0.95,a)+";"},markupF:true,html:jj(post,"censored",0)===0?jj(post,"message"):"▬▬censored▬▬"},]];}),[".split"])],]],]],
					[".shadow¥draft"],]],
				[".C¥control",[
					(jj(thread,"sticky",0)=== 1
						? null
						: µ.bscss("Light",[".button",{click:()=>{core.send({tbl:"thread",act:"edt",dat:{ID:threadID,sticky:1}});},}])),
					(jj(thread,"sticky",0)=== 0
						? null
						: µ.bscss("Neutral",[".button",{click:()=>{core.send({tbl:"thread",act:"edt",dat:{ID:threadID,sticky:0}});},}])),
					(jj(thread,"sticky",0)===-1
						? null
						: µ.bscss("Heavy",[".button",{click:()=>{core.send({tbl:"thread",act:"edt",dat:{ID:threadID,sticky:-1}});},}])),
					(jj(thread,"locked",0)=== 0
						? µ.bscss("Lock",[".button",{click:()=>{core.send({tbl:"thread",act:"edt",dat:{ID:threadID,locked:1}});},}])
						: µ.bscss("Unlock",[".button",{click:()=>{core.send({tbl:"thread",act:"edt",dat:{ID:threadID,locked:0}});},}])),
					µ.bscss("Edt.",[".button",{click:()=>{
						var thread = p.procNeeds(this,"thread",threadID); // sigh ... µ.rr won't replace this for a listener fxn
						µ.qd("¥draft[data-for='thread']>[data-label='Thread Title']>:not(.label)").value = jj(thread,"name");
						µ.qd("¥draft[data-for='thread']>[data-label='Thread Message']>:not(.label)").value = jj(thread,"message");
						p.draftAssert("thread");},}]),
					((jj(p.user,"starC",0) >= 1)
						? ((jj(thread,"censored",0) === 0)
							? µ.bscss("Cen.",[".button",{click:()=>{core.send({tbl:"thread",act:"edt",dat:{ID:threadID,censored:1}});},}])
							: µ.bscss("Unc.",[".button",{click:()=>{core.send({tbl:"thread",act:"edt",dat:{ID:threadID,censored:0}});},}]))
						: null),
					µ.bscss("Del.",[".button",{click:()=>{core.send({tbl:"thread",act:"del",dat:{ID:threadID}});},}]),]],
				["¥draft[data-for='thread'][style='¥:none;']",[
					µ.bscss("Thread Title",["input[placeholder='I Love FtB! <3']"]),
					µ.bscss("Thread Message",["textarea[placeholder='Yeah.']"]),
					["¥bottom",[
						µ.bscss("Edit",[".button",{click:function(threadID){return function(){core.send({tbl:"thread",act:"edt",dat:{ID:threadID,name:µ.qbscss(this.parentNode,"Thread Title").value,message:µ.qbscss(this.parentNode,"Thread Message").value}});};}(threadID),}]),]],]],
				["¥draft[data-for='post'][style='¥:none;']",[
					µ.bscss("Post Message",["textarea[placeholder='Yeah.']"]),
					["¥bottom",[
						µ.bscss("Post",[".button",{click:function(threadID){return function(){core.send({tbl:"post",act:"new",dat:{threadID,message:µ.qbscss(this.parentNode,"Post Message").value}});};}(threadID),}]),
						µ.bscss("Edit",[".button",{click:function(){core.send({tbl:"post",act:"edt",dat:{ID:int(µ.qbscss(this,"Post ID").value),message:µ.qbscss(this.parentNode,"Post Message").value}});},}]),
						µ.bscss("Post ID",["input"]),]],]],
				[".C¥draftTrigger",[
					µ.bscss("Draft Post",[".button",{click:function(){p.draftToggle("post");},}]),
					µ.bscss("Draft Thread",[".button",{click:function(){p.draftToggle("thread");},}]),]],
				["¥nav",[
					["¥breadcrumb",µ.msplit([
						["a[href='..']",[
							p.mName("FtB",575),]],
						["a[href='#']",{mouseenter:()=>{this.render({rush:false,display:false,o:{hashOverride:"#"}});},},"/boards/"],
						["a[href='#"+subboardID+"']",{mouseenter:()=>{this.render({rush:false,display:false,o:{hashOverride:"#"+subboardID}});},},[
							p.mName(jj(subboard,"name"),jj(subboard,"ID")),]],
						["a[href='#"+subboardID+">"+threadID+"']",{mouseenter:()=>{this.render({rush:false,display:false,o:{hashOverride:"#"+subboardID+">"+threadID}});},},[
							p.mName(jj(thread,"censored",0)===0?jj(thread,"name"):"▬▬censored▬▬",jj(thread,"ID"))]],],["¥split"," → "],{top:false,bottom:false})],
					["¥who",[
						["span"],]],]],
			]];
			if (o.display){
				//ll("about to assert : "+(p.now() - tA));var tA = p.now();
				µ.rr(document.body,µ.m(macro));
				//ll("asserted : "+(p.now() - tA));var tA = p.now();
				/*if (typeof postID !== "undefined"){
					var el = µ.qd("¥post[data-id='"+postID+"']");
					if (el !== null){
						el.scrollIntoView();
						µ.qd("¥bst").scrollTop -= µ.qd("body>¥nav").offsetHeight;
						p.href("#"+subboardID+">"+threadID+"");}}*/}}
		if (o.display){
			//ll("about to assert name : "+(p.now() - tA));var tA = p.now();
			µ.rr(µ.qd("body>¥nav>¥who>span"),µ.m([[
				p.mName(p.name,p.ID),
			]]));
			//ll("about to asr style dynamic : "+(p.now() - tA));var tA = p.now();
			p.asrStyleDynamic();}
		//ll("about to memexe : "+(p.now() - tA));var tA = p.now();
		p.memexe();
		ll("done : "+(p.now() - tA));var tA = p.now();
	};
	window.addEventListener("hashchange",()=>{
		p.procO.root.render({rush:true,display:true});
	});
});
</script>
<body></body></html>
