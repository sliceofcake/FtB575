<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1"><title>FtB575 /boards/</title><link href="../image/favicon.png" rel="icon" type="image/png">
<script>
var v1,v2,v3;
function f1(){v1 = Date.now();}
function f2(){v2 = Date.now();}
function f3(){v3 = Date.now();setTimeout(function(){
	console.log("mousedown : "+(v1-v1));
	console.log("mouseup   : "+(v2-v1));
	console.log("mouseclick: "+(v3-v1));
},0);}
</script>
<body>
<button onmousedown='f1();' onmouseup='f2();' onclick='f3();'>click me</button>
</div>
</body></html>
