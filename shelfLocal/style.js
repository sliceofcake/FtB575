// some elements have styles defined globally [these are what I use "."s for, for non-global styles, I use "¥"s]
// lo : low state, not active
// md : medium state, in-between, such as a mouse-over
// m2 : medium state, in-between, unfortunately needed when, for example, a mouseover and a focus need to be distinguishable - m2 is the more stable of [md,mh]
// hi : high state, most active, such as being currently clicked, with the mouse still down
var ø = {
	rrx : 1200,
	rry : 800,
	genCSSVarS:function(o={}){π.p(o,{tx:[0,0,1],co:[0,0,0.5],bg:[0,0,0,0.85]});
		var {tx,co,bg} = o;
		var res = "--c:"+hsla(tx)+";--bgc:"+hsla(bg)+";"
		        + "--c-placeholder:"+hslmma(tx,co,bg,0.6,0.6)+";--c-highlight:"+hslma(co,tx,0.6,0.5)+";"
		        + "--bgc-button-lo:"+hslma(co,bg,0.4,bg[3])+";--bc-button-lo:"+hslmma(co,tx,bg,0.8,0.8)+";--bsw-button-lo:0px 0px 12px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset,0px 0px 6px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset;"
		        + "--bgc-button-hf:"+hslma(co,bg,0.6,bg[3])+";--bc-button-hf:"+hslmma(co,tx,bg,0.8,0.8)+";--bsw-button-hf:0px 0px 12px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset,0px 0px 6px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset;"
		        + "--bgc-button-hi:"+hslma(co,bg,0.8,bg[3])+";--bc-button-hi:"+hslmma(co,tx,bg,0.8,0.8)+";--bsw-button-hi:0px 0px 12px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset,0px 0px 6px 0px "+hslmma(co,tx,bg,0.8,0.8)+" inset;"
		        + "--c-panel-handle:"+hsla(bg)+";--bgc-panel-handle:"+hsla(co,bg[3])+";--bgc-panel-not-handle:"+"transparent"/*hsla(bg,bg[3])*/+";--bsw-panel:0px 0px 4px 0px "+hsla(co)+";--tsw-panel-handle:0px 0px 6px "+hsla(co)+";"
		        + "--c-button-label:"+hslma(co,tx,1)+";--c-label:"+hsla(co,0.6)+";--tsw-label:0px 0px 6px "+hsla(bg)+",0px 0px 6px "+hsla(bg)+";"
		        + "--c-input:"+hslma(tx,co,0.6)+";--bgc-input:"+hsla(bg,bg[3])+";--bc-input-lo:"+hslma(co,bg,0.6)+";--bc-input-md:"+hslma(co,bg,0.8)+";--bc-input-m2:"+hsla(co)+";--bc-input-hi:"+hslma(co,tx,0.8)+";"
		        + "--bg-input-disabled:repeating-linear-gradient(-45deg,"+hslma(bg,co,0.65,bg[3])+","+hslma(bg,co,0.65,bg[3])+" 10px,"+hsla(bg,bg[3])+" 10px,"+hsla(bg,bg[3])+" 20px);"
		        + ";"
		        + ";"
		        + ";";
		return res;},
	asrStyle:function(o={}){π.p(o,{tx:[0,0,1],co:[0,0,0.5],bg:[0,0,0,0.85],pre:""});
		var {tx,co,bg,pre} = o;
		var a = (typeof bg[3] === "undefined" ? 1 : bg[3]);
		var rr = π.reductionRatio(this.rrx,this.rry);
		var fxnFilter = m=>Math.ceil(m);
		var rrn = n=>fxnFilter(rr*n);
		
		var txHF        = fxnFilter(rr*13);
		var bgPath      = "/image/books.jpg";//π.mainDirectory()++"trash/bg.jpg";
		var tabH        = fxnFilter(rr*30);
		var inputW      = fxnFilter(rr*210);
		var inputH      = fxnFilter(rr*30);
		var textareaH   = fxnFilter(rr*90);
		var selectH     = fxnFilter(rr*30);
		var buttonH     = fxnFilter(rr*30);
		var toggleH     = fxnFilter(rr*30);
		var BSCSSH      = fxnFilter(rr*30);
		var symbolPartS = fxnFilter(rr*15);
		var handleH     = fxnFilter(rr*15);
		
		var css = {
			":root" : this.genCSSVarS({tx,co,bg})+"--fs-label:"+txHF+"px;--fs-button-label:"+txHF+"px;",
			"*" : "box-sizing:border-box;line-height:1.2;transition-property:background-color,color,border-color;"
				+ "transition-timing-function:cubic-bezier(0.22,0.61,0.36,1);transition-duration:0.6s;transition-delay:0s;"
				+ "background-clip:padding-box;",
			"*:hover,*:focus,*:active" : "transition-timing-function:linear;transition-duration:0s;transition-delay:0s;",
			"html" : "¥s:1000‰;",
			"body" : "¥s:1000‰;¥ff:Verdana,Geneva,sans-serif;¥fs:"+txHF+"px;¥p:0px;¥m:0px;¥c:var(--c);¥bgc:var(--bgc);"/*¥bgi:url("+bgPath+");*/+"¥bgr:no-repeat;¥bgs:cover;¥bgo:content-box;¥bgp:center center;¥bga:fixed;¥o:hidden;",
			"table" : "border-collapse:collapse;table-layout:fixed;", // the following: "table-layout:fixed;" uses the first row it encounters as the definitive widths for the entire table
			"a,a:link,a:visited,.link"                : "¥:hand;¥c:"+hsla(co)        +";text-decoration:none;",
			"a:hover,a:focus,.link:hover,.link:focus" : "¥:hand;¥c:"+hslma(co,tx,0.5)+";text-decoration:underline;",
			"a:active,link:active"                    : "¥:hand;¥c:"+hsla(tx)        +";text-decoration:underline;",
			"textarea,input,select,label" : "¥:inline-block;¥ff:inherit;¥fs:inherit;¥c:var(--c-input);¥bgc:var(--bgc-input);¥bo:1px solid transparent;outline:none;"
			                              + "¥bc:var(--bc-input-lo);",
			"textarea:hover, input:hover, select:hover ,label:hover"  : "¥bc:var(--bc-input-md);",
			"textarea:focus, input:focus, select:focus ,label:focus"  : "¥bc:var(--bc-input-m2);",
			"textarea:active,input:active,select:active,label:active" : "¥bc:var(--bc-input-hi);",
			"textarea[disabled],input[disabled],select[disabled],label[disabled]"  : "¥bg:var(--bg-input-disabled);¥bc:var(--bc-input-lo) !important;",
			"textarea"  : "¥h:"+textareaH+"px;resize:none;",
			"input"     : "¥h:"+inputH+"px;¥p:0px 3px;",
			"select"    : "¥h:"+selectH+"px;¥brad:0px;¥p:3px;",
			"label"              : "¥:relative;cursor:pointer;border-style:dashed;",
			".file"              : "¥:absolute;¥:NW;¥bgc:transparent;¥bo:none;",
			"input[type='file']" : "¥:absolute;¥:NW;¥op:0;¥:hand;",
			// these placeholder styles need to be separate rules
			"::-webkit-input-placeholder"  : "¥c:var(--c-placeholder);¥op:1;",
			":-moz-placeholder"            : "¥c:var(--c-placeholder);¥op:1;",
			"::-moz-input-placeholder"     : "¥c:var(--c-placeholder);¥op:1;",
			":-ms-input-placeholder"       : "¥c:var(--c-placeholder);¥op:1;",
			// these selection styles need to be separate rules
			"::selection"      : "¥bgc:var(--c-highlight);",
			"::-moz-selection" : "¥bgc:var(--c-highlight);",
			"img[src='']" : "visibility:hidden;",
			
			// for example, reserving space in main page flow matching the space taken by an position:absolute top:0px height:auto element
			".shadow" : "position:relative !important;¥t:auto;¥r:auto;¥b:auto;¥l:auto;visibility:hidden;",
			
			".BSCSS"                       : "¥:inline-block;¥:relative;¥w:1000‰;¥h:"+BSCSSH+"px;¥o:hidden;",
			".BSCSS>*:not(.symbol)"        : "¥:block;¥:absolute;",
			".BSCSS>.label"                : "¥fs:var(--fs-label);¥b:1px;¥r:3px;font-weight:bold;¥c:var(--c-label);¥tsw:var(--tsw-label);¥bgc:transparent;pointer-events:none;white-space:nowrap;",
			".BSCSS>.button+.label"        : "¥fs:var(--fs-button-label);¥c:var(--c-button-label);¥tsw:none;",
			".BSCSS:hover>input+.label,\
			 .BSCSS:hover>textarea+.label" : "¥op:0.4;",
			".BSCSS>*:not(.label):not(.symbol)" : "¥:NW;¥s:1000‰;",
			
			".icon" : "¥bgr:no-repeat;¥bgs:cover;¥bgo:content-box;¥bgp:center center;",
			
			".pin" : "¥:inline-block;¥bgc:"+hslma(bg,co,0.9)+";¥bo:1px solid "+hslma(bg,co,0.7)+";¥brad:"+rrn(2)+"px;¥p:"+rrn(2)+"px;¥fs:600‰;font-weight:normal;",
			
			".panel"                  : "¥:block;¥:absolute;¥t:200px;¥l:100px;¥w:auto;¥h:auto;¥wmin:"+20+"px;¥hmin:"+20+"px;¥c:"+hsla(tx)+";¥bsw:var(--bsw-panel);overflow:hidden;¥z:1;",
			".panel>.handle"          : "¥w:1000‰;¥h:"+handleH+"px;¥fs:"+(handleH*0.8)+"px;¥c:var(--c-panel-handle);¥bgc:var(--bgc-panel-handle);¥tsw:var(--tsw-panel-handle);cursor:move;¥pl:2px;¥:one-row;",
			".panel>.handle>.faded"   : "¥pl:"+6+"px;¥op:0.35;",
			".panel>.buttonC"         : "¥:absolute;¥:NE;¥w:auto;¥h:"+handleH+"px;¥fs:"+(handleH*0.8)+"px;¥c:var(--c-panel-handle);¥bgc:var(--bgc-panel-handle);¥tsw:var(--tsw-panel-handle);cursor:auto;¥pl:0px;",
			".panel>.buttonC>.button" : "¥w:30px;¥h:1000‰;¥o:hidden;¥p:0px;",
			".panel>.main"            : "¥w:1000‰;¥h:calc(1000‰ - "+handleH+"px);¥c:var(--c);¥bgc:var(--bgc-panel-not-handle);",
			".panel>.log"             : "¥:none;¥:absolute;¥t:"+handleH+"px;¥l:0px;¥w:1000‰;¥h:calc(1000‰ - "+handleH+"px);¥c:var(--c);¥bgc:var(--bgc-panel-not-handle);",
			
			".C¥nejname"           : "¥:inline;",
			".C¥nejname>:nth-child(1)" : "¥:inline;",
			".C¥nejname>sub"       : "¥:relative;¥b:-0.1em;¥fs:650‰;vertical-align:bottom;",
			".C¥nejname>sup"       : "¥fs:800‰;vertical-align:top;",
			
			".button"                       : "¥:inline-block;¥h:"+buttonH+"px;¥bo:1px solid transparent;¥p:1px 3px;¥ta:center;¥:hand;"
			                                + "¥bgc:var(--bgc-button-lo);¥bc:var(--bc-button-lo);¥bsw:var(--bsw-button-lo);",
			".button:hover,.button:focus"   : "¥bgc:var(--bgc-button-hf);¥bc:var(--bc-button-hf);¥bsw:var(--bsw-button-hf);",
			".button:active,.button.active" : "¥bgc:var(--bgc-button-hi);¥bc:var(--bc-button-hi);¥bsw:var(--bsw-button-hi);",
			".button.active"                : "transition-duration:0s;",
			
			".toggle"                             : "¥:inline-block;¥h:"+toggleH+"px;¥c:"+hslma(co,tx,0.5)+";¥bo:1px solid transparent;¥ta:center;¥:hand;",
			".toggle.off"                         : "¥bgc:"+hslmma(co,bg,bg,0.5,0.4)+";¥bc:"+hslmma(co,tx,bg,0.6,0.4)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.2 )+" inset;",
			".toggle.off:hover,.toggle.off:focus" : "¥bgc:"+hslmma(co,bg,bg,0.5,0.7)+";¥bc:"+hslmma(co,tx,bg,0.6,0.7)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.35)+" inset;",
			".toggle.off:active"                  : "¥bgc:"+hslmma(co,bg,bg,0.5,1  )+";¥bc:"+hslmma(co,tx,bg,0.6,1  )+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.5 )+" inset;",
			".toggle.on"                          : "¥bgc:"+hslmma(co,bg,bg,0.8,0.8)+";¥bc:"+hslmma(co,tx,bg,0.8,0.8)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.4 )+" inset;",
			".toggle.on:hover,.toggle.on:focus"   : "¥bgc:"+hslmma(co,bg,bg,0.8,0.9)+";¥bc:"+hslmma(co,tx,bg,0.8,0.9)+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.45)+" inset;",
			".toggle.on:active"                   : "¥bgc:"+hslmma(co,bg,bg,0.8,1  )+";¥bc:"+hslmma(co,tx,bg,0.8,1  )+" !important;¥bsw:0px 0px 4px 0px "+hslmma(co,tx,bg,0.6,0.5 )+" inset;",
			"label.toggle>input[type='checkbox']" : "display:none;",
			
			".bb_link" : "",
			".bb_line" : "¥:block;¥w:100%;¥h:1px;¥bo:0px solid transparent;border-top-width:1px;",
			".bb_fixedwidth" : "¥ff:Monaco,Menlo,monospace;",
			".bb_size" : "¥:inline-block;",
			".bb_bold" : "font-weight:bold;",
			".bb_italic" : "font-style:italic;",
			".bb_image" : "¥wmax:600px;¥hmax:600px;",
			".bb_strikethrough" : "text-decoration:line-through;",
			".bb_underline"     : "text-decoration:underline;",
			".bb_rainbow"       : "",
			".bb_spoiler"       : "¥c:"+hsla(tx,0)+";¥tsw:0px 0px 10px "+hslma(tx,bg,0.8)+";",
			".bb_spoiler:hover" : "¥c:"+hsla(tx)+";¥tsw:0px 0px 10px "+hslma(tx,bg,0.8,0.3)+";",
			".bb_quote"         : "¥:inline-block;¥w:auto;¥p:0px 2px;¥bo:1px solid "+hslma(tx,bg,0.6)+";",
			
			/*"@keyframes rainbowC" : function(){
				var res = "";
				for (var i = 0; i <= 100; i++){
					res += i+"%{¥c:"+hsla([π.chop(i*0.01,2),co[1],co[2]])+";}";}
				return res;}(),
			"@keyframes rainbowTsw1" : function(){
				var res = "";
				for (var i = 0; i <= 100; i++){
					res += i+"%{¥tsw:0px 0px 10px "+hslma([π.chop(i*0.01,2),co[1],co[2]],bg,0.8)+";}";}
				return res;}(),
			"@keyframes rainbowTsw2" : function(){
				var res = "";
				for (var i = 0; i <= 100; i++){
					res += i+"%{¥tsw:0px 0px 10px "+hslma([π.chop(i*0.01,2),co[1],co[2]],bg,0.8,0.3)+";}";}
				return res;}(),*/
			};
		if (pre === ""){cssNew = css;}
		else{
			var cssNew = {};
			css.forEach((v,i)=>{
				π.split(i,",").map(v=>pre+" "+v).forEach(iNew=>{π.ooa(cssNew,{[iNew]:v});});
			});}
		µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"asrStyle"},css:cssNew}));},
};
document.addEventListener("DOMContentLoaded",()=>{
	ø.asrStyle();window.addEventListener("resize",function(){ø.asrStyle();});
});
