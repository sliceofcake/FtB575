<? require_once("/home/ftbsliceofcake2/gate/gate_575.php"); ?>

<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /chat/</title><link href="../image/favicon.png" rel="icon" type="image/png">
<body></body></html>
<? die; ?>
<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /chat/</title><link href="../image/favicon.png" rel="icon" type="image/png">
<script>
<?
require_once("../shelf/butler.js");
require_once("../shelf/specific.js");
require_once("../shelf/color.js");
require_once("../shelf/rho.js"); ?>
</script>
<script>
π.ooa(p,{
	asrStyle : function(mode="root",dataUnique="root",o={}){
		var rr = π.reductionRatio(800,800);
		var {tx,co,bg} = p;
		var css = ø.asrStyle(tx,co,bg,rr)
		µ.ma(document.head,µ.m({type:"style",d:{"data-unique":dataUnique},css}));},
});
p.procO.channelC = π.ooa(p.procSetup(),{
	name : "channelC",
	messageT : Timer.gen({duration:1000000,}),
	channelT : Timer.gen({duration:1000000,}),
	channelID : N,
	rcv : function(o={}){
		π.ooaw(o,{
			o          : {},
			intersectF : F,});
		if (o.intersectF){
			this.render();}},
	poke : function(){
		if (this.messageT.if()){
			core.down();
			p.tblxleafO.channel.forEach((channel,channelID)=>{core.send({tbl:"message",act:"dmp",prc:this.name,dat:{channelID}});});
			core.up();}
		if (this.channelT.if()){
			core.down();
			core.send({tbl:"channel",act:"dmp",prc:"channelC"});
			core.up();}},
	render : function(o={}){
		π.ooaw(o,{
			rush    : F,
			display : T,
			o       : {},});
		var rrChangeF = µ.rr(document.body,lol=µ.m([[
			//var board = p.procNeeds(this,"board",boardID);
			["¥A",[
				["¥A",{z:{DECO:{co:p.co,},},},p.tblxleafO.channel.mapV((channel,channelID)=>
					["¥A§"+channelID,{z:{DECO:{iconPath:jj(channel,"iconPath"),},},click:()=>{this.channelID = int(channelID);this.render();},},[
						[".icon¥A",jj(channel,"ID")],
						["¥B"],
						["¥C","+1"],]])],
				["¥B",[
					["¥A",p.tblxleafO.message.filter(message=>message.channelID===this.channelID).mapV((message,messageID)=>{
						var user = p.procNeeds(this,"user",int(jj(message,"userID")));
						return ["¥A",[
							["¥A",jj(user,"name")+jj(user,"ID")],
							[".icon¥B",{z:{DECO:{iconPath:jj(user,"iconPath"),},},},],
							["¥C",[
								["¥A",jj(message,"message")],]],]];}
					)],
					["¥B",[
						µ.bscss("message",["textarea"],"¥A"),
						µ.bscss("send",[".button",{click:function(that){return function(){core.send({tbl:"message",act:"new",prc:that.name,dat:{channelID:that.channelID,message:µ.qbscss(this,"message").value,},});};}(this),}],"¥B"),]],]],
				["¥C",[]],
				["¥D",[
					["","hi"],]],
			]],
		]]));
		if (rrChangeF){µ.csse("channelC");}},
});
Ω.css["channelC"] = ()=>{
	a = [];
	
	var headerH = 30;
	
	// all
	a.push([s=>":scope>body>¥A"+s                , o=>[]            , [[N,o=>"¥:relative;¥w:1000‰;¥h:1000‰;¥o:auto;",],],]);
	
	// channels
	var iconChannelS = 50;
	a.push([s=>":scope>body>¥A>¥A"+s             , o=>[o.bg,]       , [[N,o=>"¥w:"+o.rrn(iconChannelS)+"px;¥h:1000‰;¥bgc:"+hsla(o.bg,o.bg[3])+";¥pt:"+o.rrn(headerH)+"px;¥o:auto;¥f:left;",],],]);
	a.push([s=>":scope>body>¥A>¥A>¥A"+s          , o=>[]            , [[N,o=>"¥:relative;¥s:"+o.rrn(iconChannelS)+"px;¥:hand;",],],]);
	a.push([s=>":scope>body>¥A>¥A>¥A>¥A"+s       , o=>[o.iconPath,] , [[N,o=>"¥:absolute;¥s:1000‰;¥bgi:url("+o.iconPath+");",],],]);
	a.push([s=>":scope>body>¥A>¥A>¥A>¥B"+s       , o=>[o.bg,]       , [[N,o=>"¥:absolute;¥s:1000‰;¥bgc:"+hsla(o.bg,0.1)+";",],
	                                                                   [":hover",o=>"¥bgc:"+hsla(o.bg,0)+";",],],]);
	a.push([s=>":scope>body>¥A>¥A>¥A>¥C"+s       , o=>[o.co,]       , [[N,o=>"¥:absolute;¥:NE;¥bgc:"+hsla(o.co)+";",],],]);
	
	// messages
	var iconMessageS =  30;
	var bottomH      =  30;
	var sendW        = 120;
	a.push([s=>":scope>body>¥A>¥B"+s             , o=>[o.bg,]       , [[N,o=>"¥w:calc(1000‰ - "+o.rrn(50)+"px - "+o.rrn(50)+"px);¥h:1000‰;¥bgc:"+hsla(o.bg,o.bg[3])+";¥f:left;",],],]);
	a.push([s=>":scope>body>¥A>¥B>¥A"+s          , o=>[]            , [[N,o=>"¥w:1000‰;¥h:calc(1000‰ - "+o.rrn(bottomH)+"px);¥pt:"+o.rrn(headerH)+"px;¥o:auto;",],],]);
	// message
	a.push([s=>":scope>body>¥A>¥B>¥A>¥A"+s       , o=>[]            , [[N,o=>"¥w:1000‰;",],],]);
	a.push([s=>":scope>body>¥A>¥B>¥A>¥A>¥A"+s    , o=>[o.tx,o.bg,]  , [[N,o=>"¥w:1000‰;¥f:left;¥pl:"+o.rrn(iconMessageS)+"px;¥:one-row;¥fs:800‰;¥c:"+hslma(o.tx,o.bg,0.5,o.bg[3])+";",],],]); // meta splitter
	a.push([s=>":scope>body>¥A>¥B>¥A>¥A>¥B"+s    , o=>[o.iconPath,] , [[N,o=>"¥s:"+o.rrn(iconMessageS)+"px;¥bgi:url("+o.iconPath+");¥f:left;",],],]); // icon
	a.push([s=>":scope>body>¥A>¥B>¥A>¥A>¥C"+s    , o=>[]            , [[N,o=>"¥w:calc(1000‰ - "+o.rrn(iconMessageS)+"px);¥f:left;",],],]); // message area
	a.push([s=>":scope>body>¥A>¥B>¥A>¥A>¥C>¥A"+s , o=>[o.tx,o.bg,]  , [[N,o=>"¥:inline-block;¥wmax:1000‰;¥hmin:"+o.rrn(iconMessageS)+"px;¥:multi-row;background:linear-gradient(135deg,"+hslma(o.bg,o.co,0.5,o.bg[3])+","+hslma(o.bg,o.co,0.6,o.bg[3])+");¥p:"+o.rrn(6)+"px;",],],]); // bubble
	
	a.push([s=>":scope>body>¥A>¥B>¥B"+s          , o=>[]            , [[N,o=>"¥w:1000‰;¥h:"+o.rrn(bottomH)+"px;",],],]);
	a.push([s=>":scope>body>¥A>¥B>¥B>¥A"+s       , o=>[]            , [[N,o=>"¥:block;¥f:left;¥w:calc(1000‰ - "+o.rrn(sendW)+"px);¥h:1000‰;",],],]);
	a.push([s=>":scope>body>¥A>¥B>¥B>¥B"+s       , o=>[]            , [[N,o=>"¥:block;¥f:left;¥w:"+o.rrn(sendW)+"px;¥h:1000‰;",],],]);
	
	// participants
	a.push([s=>":scope>body>¥A>¥C"+s             , o=>[]            , [[N,o=>"¥w:"+o.rrn(50)+"px;¥h:1000‰;¥pt:"+o.rrn(headerH)+"px;¥f:left;",],],]);
	
	// header
	a.push([s=>":scope>body>¥A>¥D"+s             , o=>[o.co,o.bg,]  , [[N,o=>"¥:absolute;¥:NW;¥w:1000‰;¥h:"+o.rrn(headerH)+"px;¥bgc:"+hslma(o.bg,o.co,0.9,o.bg[3])+";",],],]);
	
	return a;
};
document.addEventListener("DOMContentLoaded",()=>{
	p.onAuth = ()=>{p.procO.channelC.render();};
});
</script>
</head><body></body></html>
