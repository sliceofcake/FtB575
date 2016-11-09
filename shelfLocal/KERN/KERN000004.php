<script id="KERN000004CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000004A,\
		 .KERN000004A *" : "box-sizing:border-box;",
		".KERN000004A"   : "¥:flex;¥s:1000‰;flex-flow:column;",
		".KERN000004AA"  : "¥:block;¥w:1000‰;¥ta:center;flex:1;",
		".KERN000004AB"  : "¥:block;¥w:1000‰;¥ta:center;¥fs:800‰;",
		};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000004"},css:css}));
});
window.addEventListener("resize",()=>{
	KERN000004.refresh();
});
var KERN000004 = π.ooa(KERN("KERN000004"),{
	name : "KERN000004",
	gen : function(o={}){
		π.ooaw(o,{
			tx       : [0,0,1],
			co       : [0,0,0.5],
			bg       : [0,0,0,1],
			info     : "",
			which    : 220,
			location : 0,
			callback : ()=>{},});
		var refresh = function(o={}){
			π.ooa(this.KERN,o);
			µ.qd(this,".KERN000004AA").value = π.keySetToEnglish(this.KERN.which,this.KERN.location);
			µ.qd(this,".KERN000004AB").style.backgroundColor = hslma(this.KERN.bg,this.KERN.co,0.8,this.KERN.bg[3]);};
		var drive = function(o={}){
			π.ooaw(o,{
				strong : false});
			this.KERN.callback({which:this.KERN.which,location:this.KERN.location,});};
		var flow = function(o={}){
			var A   = this;
			A.KERN.refresh.call(A,{which:o.which,location:o.location,});
			A.KERN.drive.call(A);};
		return {d:{class:"KERN000004A"},z:{KERN:π.ooa(o,{refresh,drive,flow,}),},childA:[
			["input.KERN000004AA",{keydown:function(e){
				e.preventDefault();
				var A = µ.qu(this,".KERN000004A");
				A.KERN.refresh.call(A,{which:e.which,location:e.location,});
				A.KERN.drive.call(A);
				this.blur();},}],
			[".KERN000004AB",o.info],]};}
});
</script>
