<script id="KERN000015CartridgeJS">
var KERN000015 = {
	gen : function(o={}){π.p(o,{});
		var oo = π.ooas(KERN(),{
			name      : "KERN000015",
			o : {
				tx    : [0,0,1  ],
				co    : [0,1,0.5],
				bg    : [0,0,0  ,1],
				fil   : N,
				fxn   : ()=>{},
				// utilities
			},
			validateFxnO : {},
			stabilize_SUB   : function(){var _ = this.o;
				if (this.if("fil","fxn") && !this.alteredPropertyAllF){_.fxn.call(this);}
			},
		});
		oo.portInP .pushA([
			["fil",KERNTypeO.complexReference],
			["fxn",KERNTypeO.function],
		]);
		oo.portOutP.pushA([]);
		return oo;},
	};
</script>
