// for integers of the range [0,Number.MAX_SAFE_INTEGER]
var vlq = {
	representation : "array", // "array" or "string"
	encode : function(n){
		var byteA = []; // minimum of one chunk enforced [value of 0]
		while (n !== 0 || byteA.length === 0){
			byteA.unshift((byteA.length===0?0b00000000:0b10000000) | (n & 0b01111111));
			n = Math.trunc(n/0b10000000);}
		if (this.representation === "string"){
			return byteA.reduce(function(p,v){return p + String.fromCharCode(v);},"");}
		else{return byteA;}},
	decode : function(m){
		var byteA = (typeof m === "string") ? Array.from(m).map(function(v){return v.charCodeAt(0);}) : m;
		if    (byteA.reduce(function(p,v,i,a){return p + (((v & 0b10000000)===0?1:0) * Math.pow(2,(a.length-1-i)*7));},0) !== 1){return false;}
		return byteA.reduce(function(p,v,i,a){return p +  ((v & 0b01111111)          * Math.pow(2,(a.length-1-i)*7));},0);},
};
