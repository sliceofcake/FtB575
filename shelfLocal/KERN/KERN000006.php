<script id="KERN000006CartridgeJS">
document.addEventListener("DOMContentLoaded",()=>{
	var css = {
		".KERN000006A,.KERN000006A *"                                :"box-sizing:border-box;",
		".KERN000006A::-moz-selection,.KERN000006A *::-moz-selection":"¥bgc:transparent;",
		".KERN000006A::selection,.KERN000006A *::selection"          :"¥bgc:transparent;",
		".KERN000006A"                                               :"¥:relative;¥s:1000‰;cursor:crosshair;",
		".KERN000006AA"                                              :"¥:absolute;¥h:1000‰;",
		".KERN000006AB"                                              :"¥:absolute;¥h:1000‰;",
		".KERN000006AC"                                              :"¥:absolute;¥h:1000‰;",
		".KERN000006AD"                                              :"¥:absolute;¥h:1000‰;",
		".KERN000006AE"                                              :"¥:absolute;¥h:1000‰;",};
	µ.ma(document.head,µ.m({type:"style",d:{"data-unique":"KERN000006"},css}));
});
window.addEventListener("resize",()=>{µ.qdA(".KERN000006A").forEach(el=>{el.KERN.refresh();});});
var KERN000006 = {
	gen : function(o={}){π.p(o,{});
		// temporary, fed into arrays
		var colornameA = ["noteFadedCoA","noteCoA","noteActiveCoA","laneWarningPreCoA","laneWarningPostCoA","laneCoA","laneActiveCoA","hitboxCoA","hitboxActiveCoA"];
		
		var oo = π.ooas(KERN(),{
			name      : "KERN000006",
			o : {
				pxd : 2,
				
				playbackRate       : 1,
				chartR             : N,
				chartTxt           : "",
				chartTxtF          : F,
				chartBox           : {bpmA:[],noteA:[],keyC:0},
				tx                 : [0,0,1    ], // ???
				co                 : [0,1,0.5  ], // ???
				bg                 : [0,0,0  ,1], // ???
				width              : 0,
				height             : 0,
				widthField         : 0, // width of the field, regardless of view-rectangle size
				
				// time keeping mechanisms
				// ex : started/unpaused at anchorP:2000000,anchorT:1467262923902510
				//      chartT : π.now() ... which is 1467262924902510
				//      chartP : anchorP+(chartT-anchorT) ... which is 3000000
				chartP  : 0, // current microsecond-timestamp, chart time
				chartT  : 0, // current microsecond-timestamp, real-world time
				anchorP : 0, // anchor point microsecond-timestamp, chart time
				anchorT : 0, // anchor point microsecond-timestamp, real-world time
				
				// time to jump to, tentatively, this is filled by another KERN element
				// only pay attention to this value if the signal has been flipped [or initially set]
				tTentativeSignal : N,
				tTentative : 0,
				
				renderRegisterA    : [],
				missBoundary       : 125000,
				state              : "lo",
				
				lanexnoteA         : [],
				duration           : 0,
				snapA              : [],
				nSnapErrorTolerance : 0.001, // amount of error in complex snap math - example value of 0.001 means that if a time is 1‰ deviant from a snap to the distance to the next snap, it counts as being exactly on that first snap
				keyC               : 7,
				score              : 0,
				stat               : [],
				introWaitTime      : 2000000       ,
				playbackRate       :       1       ,
				volume             :       0.5     ,
				laneDividerW       :       1       ,
				noteW              :      40       ,
				noteH              :      16       ,
				snapH              :       1       ,
				snapMultiplier     :       4       ,
				warningPreH        :       4       ,
				warningPostH       :       4       ,
				noteOffset         :       0       ,
				errorOffset        :       0       , // error from not being able to play the audio within 1ms of chart starting
				syncOffset         :       0       , // error from audio video desync
				speedMultiplier    :       0.00055 ,
				speedMultiplierAdjusted :  0       , // adjusted to work with playbackRate to keep at constant speed
				judgeLineRaise     :       0       ,
				noteShape          : "rectangle"   ,
				keyStateA          : [],
				noteInstantStatA   : [], // for sending raw score-ish data to an external element
				passedHeadC : 0,
				passedTailC : 0,
				earnedHeadC : 0,
				earnedTailC : 0,
				scoreResetSignal : F, // outbound signal to the score computer
				
				dontBeLazy : F, // while in the "lo" state, certain things [such as [re]drawing notes] will not be done in drawFrame, normally
				
				translateSignalO : {},
				translatedSO : [],
				
				layernameA : ["S","J","Decon082_ver1","N","L"],
				modO_Decon082_ver1  : {overlayA:[]},
				
				// utilities [optimizations]
				errorToScore : function(error,boundary=this.missBoundary){return (error>boundary)?0:Math.cos(Math.PI*error/(2*boundary))*boundary;},
				sizeAll      : function(){this.preclWH();this.canvasO.forEach(el=>{el.width=this.cachedW()*this.pxd;el.style.width=this.cachedW()+"px";el.height=this.cachedH()*this.pxd;el.style.height=this.cachedH()+"px";});},
				jumpRelative : function(delta){this.jump(this.chartP+delta);},
				jump         : function(location){
					this.anchorP=Math.round(location);
					this.anchorT=this.chartT;
					this.chartP=((this.chartT-this.anchorT)*this.playbackRate)+this.anchorP;
					this.score=0;
					this.stat=[];
					this.resetNoteA();
					this.earnedHeadC = 0;
					this.earnedTailC = 0;
					this.renderRegister("N");
					this.scoreResetSignal = !this.scoreResetSignal;
					this.root.changed({datA:[["chartP",this.chartP],["scoreResetSignal",this.scoreResetSignal]]});
					this.root.outbound();},
				calcScoreMaxSoFar : function(){
					return; // !!! not currently used and was taking forever
					return this.missBoundary*π.flat(this.lanexnoteA).filter(note=>this.chartP>=this.timeAdjust(note.head)).reduce(((p,note)=>p+((typeof note.tail==="undefined"||this.chartP<this.timeAdjust(note.tail))?1:2)),0);},
				resetNoteA       : function(                         ){this.lanexnoteA.forEach(noteA=>noteA.forEach(note=>{π.ooas(note,{started:F,ended:F});}));},
				placeHit         : function({lane=1,head=0       }={}){this.lanexnoteA[lane].push({lane,head     ,started:F,ended:F});this.lanexnoteASort();},
				placeHold        : function({lane=1,head=0,tail=0}={}){this.lanexnoteA[lane].push({lane,head,tail,started:F,ended:F});this.lanexnoteASort();},
				removeNote       : function({lane=1,head=0       }={}){this.lanexnoteA[lane]=this.lanexnoteA[lane].filter(note=>!(note.lane===lane&&this.timeAdjust(note.head)===head));},
				lanexnoteASort   : function(){this.lanexnoteA.forEach((noteA,lane)=>{noteA.sort((a,b)=>{var h=a.head-b.head;return (h!==0)?h:a.tail-b.tail;});});},
				calcFinalTime    : function(){
					var pass1 = F,pass2 = F;
					if (this.snapA.length    > 0){pass1 = T;var finalHeadSnap = this.snapA[this.snapA.length-1].head;}
					if (this.hitC+this.holdC > 0){pass2 = T;var finalTailNote = this.lanexnoteA.mapV(noteA=>noteA.length===0?0:noteA.map(note=>(typeof note.tail === "undefined" ? note.head : note.tail)).max(),0).max();}
					if (!pass1 && !pass2){return 0;}
					if ( pass1 && !pass2){return finalHeadSnap;}
					if (!pass1 &&  pass2){return finalTailNote;}
					if ( pass1 &&  pass2){return Math.max(finalHeadSnap,finalTailNote)}},
				timeToPixel      : function(t){return this.const1 - t*this.speedMultiplierAdjusted;},
				pixelToTime      : function(p){return (this.speedMultiplierAdjusted === 0) ? -1 : (this.const1 - p)/this.speedMultiplierAdjusted;},
				nearestSnapGroup : function(majorOnlyF=F){
					if (this.snapMultiplier === 0 || this.snapA.length === 0){return {prev:null,curr:null,next:null};}
					
					// t = snap.head + (snap.value * n)
					// therefore, n = (t - snap.head) / snap.value
					var snapCurrI = 0;for (var snapI = this.snapA.length-1; snapI >= 0; snapI--){var snap = this.snapA[snapI];if (snap.head <= this.chartP){snapCurrI = snapI;break;}}
					var snapCurr = this.snapA[snapCurrI];
					var valueCurr = (snapCurr.value/(majorOnlyF?1:this.snapMultiplier)); // as in snap.value
					var nCurr = (this.chartP - snapCurr.head) / valueCurr;
					var prevTentative,nextTentative; // values if they existed within the same snap group as curr
					// exactly [nCurr is deemed close enough to a whole number]
					//ll("---------------------------------------");
					//ll("snapCurr : "+π.jsonE(snapCurr));
					//ll("valueCurr : "+valueCurr);
					//ll("nCurr : "+nCurr);
					var exactF = F; // whether we are current on top of a snap, by design or by chance
					if (Math.abs(Math.round(nCurr)-nCurr) < this.nSnapErrorTolerance){
						nCurr = Math.round(nCurr);
						curr = this.chartP;
						exactF = T;}
					else{
						curr = N;}
					
					prevTentative = snapCurr.head + (valueCurr * (exactF?(nCurr-1):Math.floor(nCurr)));
					if (snapCurrI === 0 || prevTentative >= snapCurr.head){prev = prevTentative;}
					else{
						// this will be the final snap of the previous snap group
						var snapPrev = this.snapA[snapCurrI-1];
						var valuePrev = (snapPrev.value/(majorOnlyF?1:this.snapMultiplier)); // as in snap.value
						var nPrev = (this.chartP - snapPrev.head) / valuePrev;
						if (Math.abs(Math.round(nPrev)-nPrev) < this.nSnapErrorTolerance){nPrev = Math.round(nPrev);nPrev--;} // if we're at an overlapping valid line, nope, go back one more
						var prev = snapPrev.head + (valuePrev * Math.floor(nPrev));}
					
					nextTentative = snapCurr.head + (valueCurr * (exactF?(nCurr+1):Math.ceil(nCurr)));
					if (snapCurrI === this.snapA.length-1 || nextTentative < snapCurr.tail){next = nextTentative;}
					else{
						// this will be the head snap of the next snap group
						var snapNext = this.snapA[snapCurrI+1];
						next = snapNext.head;}
					ll(this.chartP+" "+π.jsonE({prev,curr,next}));
					return {prev,curr,next};},
				nearestSnapUp        : function(){return this.nearestSnapGroup().next;},
				nearestSnapDown      : function(){return this.nearestSnapGroup().prev;},
				nearestSnapMajorUp   : function(){return this.nearestSnapGroup(T).next;},
				nearestSnapMajorDown : function(){return this.nearestSnapGroup(T).prev;},
				timeAdjust           : function(n){return n+this.noteOffset+this.errorOffset+this.syncOffset;},
				timeDejust           : function(n){return n-this.noteOffset-this.errorOffset-this.syncOffset;},
				renderRegister       : function(){for (var argument of arguments){this.renderRegisterA.pushUnique(argument);}},
				chartTxtDecode : function(res){
					var box = {bpmA:[],noteA:[],keyC:0};
					var type = "FtB4";
					if      (res.match(/\[HitObjects\]/) !== N){type = "o!m14";}
					else if (res.match(/HEADER\sFIELD/ ) !== N){type = "bms"  ;}
					else                                       {type = "FtB4" ;}
					
					switch (type){default:
						// !!! the following is only for BME, and does not yet have handling to determine "yes, this file is BME, not any of those other file types"
						break;case "bms":case "bme":case "bml":case "pms":
							var kO = {11:1,12:2,13:3,14:4,15:5,18:6,19:7,16:8};
							var kKA = Object.keys(kO);
							box.keyC = 8;
							// bpm
							res.replace(/^#BPM\s(\-?\d+(?:\.\d+)?)$/gm,function(match,p1,offset,string){box.bpmA.push({head:0,value:num(p1)});return "";});
							// hit
							res.replace(/^#(.{3})(.{2}):((?:.{2})+)$/gm,function(match,p1,p2,p3,offset,string){
								if (!kKA.includes(p2)){return "";}
								var bpm = box.bpmA[0].value; // !!! temporary, need to account for bpm changes
								var codeA = p3.match(/.{2}/g);
								var codeAC = codeA.length;
								codeA.forEach((code,codeAI)=>{
									if (code==="00"){return;}
									var expandN = codeAI/codeAC;
									box.noteA.push({head:(240000000/bpm)*(int(p1)+expandN),lane:int(kO[p2])});});
								return "";});
							// hold
							//res.replace(/^(\-?\d+(?:\.\d+)?)\-(\-?\d+(?:\.\d+)?)\s\d+\s(\d+)$/gm,function(match,p1,p2,p3,offset,string){box.noteA.push({head:π.chop(num(p1)*1000),tail:π.chop(num(p2)*1000),lane:int(p3)});return "";});
						break;case "o!m12":case "o!m13":case "o!m14":
							// notes
							// holds have exactly one more colon pair than hits
							// hits and holds may end with the name of an audio file, such as "F6S_s.wav", after the trailing colon
							//----
							box.keyC = ((_=res.match(/CircleSize\s*:\s*(\d+)/))===N)?0:int(_[1]);
							// bpm
							res.replace(/^(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?)$/gm,function(match,p1,p2,p3,p4,p5,p6,p7,p8,offset,string){box.bpmA.push({head:π.chop(num(p1)*1000),value:((num(p2)===0)?(0):(60000/num(p2)))});return "";});
							// hit
							res.replace(/^(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?):(\-?\d+(?:\.\d+)?):(\-?\d+(?:\.\d+)?):(\-?\d+(?:\.\d+)?):([^:]*)$/gm,function(that){return function(match,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,offset,string){box.noteA.push({head:π.chop(num(p3)*1000),lane:that.lane_osu_to_ftb4(int(p1),box.keyC)});return "";};}(this));
							// hold
							res.replace(/^(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?),(\-?\d+(?:\.\d+)?):(\-?\d+(?:\.\d+)?):(\-?\d+(?:\.\d+)?):(\-?\d+(?:\.\d+)?):(\-?\d+(?:\.\d+)?):([^:]*)$/gm,function(that){return function(match,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,offset,string){box.noteA.push({head:π.chop(num(p3)*1000),tail:π.chop(num(p6)*1000),lane:that.lane_osu_to_ftb4(int(p1),box.keyC)});return "";};}(this));
						break;case "FtB2":case "FtB3":case "FtB4":
							// bpm
							res.replace(/^BPM\s(\-?\d+(?:\.\d+)?)\s(\-?\d+(?:\.\d+)?)$/gm,function(match,p1,p2,offset,string){box.bpmA.push({head:π.chop(num(p1)*1000),value:num(p2)});return "";});
							// hit
							res.replace(/^(\-?\d+(?:\.\d+)?)\s\d+\s(\d+)$/gm,function(match,p1,p2,offset,string){box.noteA.push({head:π.chop(num(p1)*1000),lane:int(p2)});return "";});
							// hold
							res.replace(/^(\-?\d+(?:\.\d+)?)\-(\-?\d+(?:\.\d+)?)\s\d+\s(\d+)$/gm,function(match,p1,p2,p3,offset,string){box.noteA.push({head:π.chop(num(p1)*1000),tail:π.chop(num(p2)*1000),lane:int(p3)});return "";});
							box.keyC = box.noteA.reduce(((p,v)=>Math.max(p,v.lane)),0);}
						box.noteA.sort(function(a,b){
							var h = a.head-b.head;
							return (h !== 0) ? h : a.tail-b.tail;});
					box.noteA = box.noteA.filter(note=>note.head>=0&&(typeof note.tail === "undefined" || note.tail>=0)); // positive notes
					box.noteA = box.noteA.filter(note=>typeof note.tail === "undefined" || note.tail>=note.head); // well-formed hold notes
					box.bpmA = box.bpmA.filter(bpm=>bpm.value!==0); // divide by zero issue when flipping bpm to µspb
					box.bpmA.forEach(bpm=>{bpm.value = π.chop(60000000/bpm.value);});
					box.bpmA = box.bpmA.filter(bpm=>bpm.value>0); // position bpms
					return box;},
				lane_osu_to_ftb4 : function(lane,keyC){
					var range = 512/keyC;
					for (var i = 1; i <= 128; i++){
						if (lane < range*i){
							return i;}}},
				lane_ftb4_to_osu : function(lane,keyC){
					var range = 512/keyC;
					return Math.trunc(lane*range);},
				chartTextEncode : function(o={}){π.p(o,{which:"FtB4"});var _ = this;
					var box = _.chartBox;
					switch (o.which){default : ;
						break;case "FtB4" :
							return "###FILE ALREADY PARSED###\n"
							+ box.bpmA.map(v=>"BPM "+π.chop(v.head/1000,3)+" "+π.chop(60000000/v.value,3)+"\n").join("")
							+ box.noteA.map(v=>π.chop(v.head/1000,3)+((typeof v.tail === "undefined")?(""):("-"+π.chop(v.tail/1000,3)))+" 0 "+π.chop(v.lane)+"\n").join("");
						break;case "o!m12" :case "o!m13" :case "o!m14" :
							return "[TimingSection]\n"
							+ box.bpmA.map(v=>π.chop(v.head/1000,3)+","+((v.value==0)?(0):(π.chop(60000/v.value,3)))+",4,1,0,0,0,0\n").join("")
							+ "\n[HitObjects]\n"
							+ box.noteA.map(v=>π.chop(this.lane_ftb4_to_osu(v.lane,box.keyC),2)+",192,"+π.chop(v.head/1000,3)+","+((typeof v.tail === "undefined")?("1"):("128"))+",0,"+((typeof v.tail === "undefined")?("0"):(π.chop(v.tail/1000,3)))+((typeof v.tail === "undefined")?(""):(":0"))+":0:0:0:\n").join("")
				}},
				render : function(){var _ = this;
					this.preclConst1();
					var {tx,co,bg} = p;
					var a = bg[3];
					var w = this.cachedW();
					var h = this.cachedH();
					var noteH_actual = Math.sign(_.speedMultiplier)*_.noteH;
					for (var which of this.renderRegisterA){
						var ctx = this.ctxO[which];
						switch (which){default:
						// [s] shield
						break;case "S":
						// [j] judgement line, with key hitboxes
						break;case "J":
							anipnt.clearRect(ctx,0,0,w,h,_.pxd);
							for (var lane = 1; lane <= this.keyC; lane++){
								x = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
								color = (this.keyStateA[lane]===1)?this.hitboxActiveCoA[lane]:this.hitboxCoA[lane];
								anipnt.drawRect(ctx,x,this.timeToPixel(this.chartP),this.noteW,noteH_actual,color,_.pxd);}
						// mod : Decon082_ver1
						break;case "Decon082_ver1":
							anipnt.clearRect(ctx,0,0,w,h,_.pxd);
							_.modO_Decon082_ver1.overlayA.forEach(overlay=>{
								// look, I'm tired, okay? only Decon082 ever uses this mod. please. errors. go away. go. away.
								if (typeof overlay     === "undefined"
								||  typeof overlay.p1  === "undefined"
								||  typeof overlay.p2  === "undefined"
								||  typeof overlay.co1 === "undefined"
								||  typeof overlay.co2 === "undefined"){ll("decon's overlay is messed up");return;}
								// yy ≥ y, meaning yy is further down, since canvas origin is NW
								var {p1,p2,co1,co2} = overlay;
								if (p1 > p2){
									[p1,p2] = [p2,p1];
									[co1,co2] = [co2,co1];}
								var gradient = ctx.createLinearGradient(0,p1*h*_.pxd/1000,0,p2*h*_.pxd/1000);
								gradient.addColorStop(0,co1);
								gradient.addColorStop(1,co2);
								anipnt.drawRect(ctx,0,p1*h/1000,w,(p2-p1)*h/1000,gradient,_.pxd);});
						// [n] notes
						break;case "N":
							anipnt.clearRect(ctx,0,0,w,h,_.pxd);
							var tH = this.timeDejust(this.pixelToTime( -this.snapH)); // H here means the top    [when notes fall downward], not temporal head
							var tT = this.timeDejust(this.pixelToTime(h+this.snapH)); // T here means the bottom [when notes fall downward], not temporal tail
							if (this.speedMultiplierAdjusted < 0){var swap = tH;tH = tT;tT = swap;}
							// draw bar lines
							var tStopBefore = tT;
							var endBefore = Math.trunc(this.duration);
							if (_.snapMultiplier !== 0 && _.snapA.length > 0){
								var snapFirstNeededI = 0;for (var snapI = _.snapA.length-1; snapI >= 0; snapI--){if (_.snapA[snapI].head<=tT){snapFirstNeededI = snapI;break;}}
								for (var snapI = snapFirstNeededI;;snapI++){var snap = _.snapA[snapI];
									if (typeof snap === "undefined"){break;} // stop if we're out of snaps
									if (snapI !== 0 && snap.head > tH){break;} // stop if the next snap is out of visual range, into the future
									// draw snap from snap.head to (_.snapA[snapI+1].head or endBefore) while updating t;
									// t = snap.head + (snap.value * n)
									// therefore, n = (t - snap.head) / snap.value
									var value = snap.value/_.snapMultiplier; // as in snap.value
									var nHead = (tStopBefore - snap.head) / value;
									if (Math.abs(Math.round(nHead)-nHead) < _.nSnapErrorTolerance){nHead = Math.round(nHead);}
									else{nHead = Math.ceil(nHead);}
									var tick = nHead%_.snapMultiplier;
									var t = snap.head + (value * nHead); // get the time of that nearest snap
									tStopBefore = Math.min(tH,snap.tail); // when is the earliest indication that we should stop drawing
									// draw before we hit the stop point
									for (;t < tStopBefore; t += value,tick++,tick%=_.snapMultiplier){
										var y = _.timeToPixel(_.timeAdjust(t));
										anipnt.drawRect(ctx,0,y,_.widthField,_.snapH,(tick===0?_.snapMajorCo:_.snapMinorCo),_.pxd);}}}
							// draw them per lane, to optimize away color swaps in canvas
							// y is from the top origin, positive going down
							//if (ctx.lineW !== 4){ctx.lineW = 4;}
							// when notes fall, tT doesn't need the +this.noteH part, but it will[?] when notes rise
							var tH = this.timeDejust(this.pixelToTime(0-this.noteH-this.warningPreH )); // H here means the top    [when notes fall downward], not temporal head
							var tT = this.timeDejust(this.pixelToTime(h+this.noteH+this.warningPostH)); // T here means the bottom [when notes fall downward], not temporal tail
							if (this.speedMultiplierAdjusted < 0){var swap = tH;tH = tT;tT = swap;}
							_.passedHeadC = 0;
							_.passedTailC = 0;
							for (var lane = 1; lane <= this.keyC; lane++){
								//if (ctx.strokeStyle !== this.laneCoA[lane]){ctx.strokeStyle = this.laneCoA[lane];}
								var noteA = this.lanexnoteA[lane];
								if (typeof noteA === "undefined" || noteA.length === 0){continue;}
								
								/*hit note with (hi > head > lo)
								OR
								hold note with (hi > head > lo)
								OR
								hold note with (hi > tail > lo)
								OR
								hold note with (tail > hi AND lo > head)
								
								hi > head
								UNLESS
								lo > tail*/
								
								// stats
								var recentlyPassedHeadI = _.lanexnoteIndexHeadPairP[lane].indexOf(tT-_.missBoundary,-2);
								var passedHeadC = (recentlyPassedHeadI === -1 ? 0 : recentlyPassedHeadI+1); // the special -1 case happens to align with the general case, don't count on this
								_.passedHeadC += passedHeadC;
								var recentlyPassedTailI = _.lanexnoteIndexTailPairP[lane].indexOf(tT-_.missBoundary,-2);
								var passedTailC = (recentlyPassedTailI === -1 ? 0 : recentlyPassedTailI+1); // the special -1 case happens to align with the general case, don't count on this
								_.passedTailC += passedTailC;
								
								var lastHeadI = _.lanexnoteIndexHeadPairP[lane].indexOf(tH, 2); // index[of sorted heads] of the closest note offscreen above
								if (lastHeadI === -1){lastHeadI = _.lanexnoteIndexHeadPairP[lane].length-1;}
								lastHeadI -= 1;
								if (lastHeadI === -1){lastHeadI += 1;}
								firstHeadI = 0;
								
								var firstTailI = _.lanexnoteIndexTailPairP[lane].indexOf(tT,-2); // index[of sorted tailss] of the closest note offscreen below
								if (firstTailI === -1){firstTailI = 0;}
								firstTailI += 1;
								if (firstTailI === _.lanexnoteIndexTailPairP[lane].length){lastHeadI -= 1;;}
								var lastTailI = _.lanexnoteIndexTailPairP[lane].length-1;
								
								// look through heads
								if ((lastHeadI-firstHeadI) < (lastTailI-firstTailI)){
									var iLo = firstHeadI;
									var iHi = lastHeadI;
									var type = "head";
									var arr = _.lanexnoteIndexHeadPairP[lane].arr;} // use cautiously, we're reaching directly into an object that we, by law, shouldn't have control over
								// look through tails
								else{
									var iLo = firstTailI;
									var iHi = lastTailI;
									var type = "tail";
									var arr = _.lanexnoteIndexTailPairP[lane].arr;} // use cautiously, we're reaching directly into an object that we, by law, shouldn't have control over
								//lld(lane+" : ["+iLo+","+iHi+"]"+" of "+type);
								for (var i = iLo; i <= iHi; i++){var note = noteA[arr[i].index];
									if      (type === "head" && ((typeof note.tail === "undefined" && note.head < tT) || note.tail < tT)){continue;}
									else if (type === "tail" && (                                                        note.head > tH)){continue;}
									//if (this.timeAdjust(note.head) > tH && (typeof note.tail === "undefined" || this.timeAdjust(note.tail) > tH)){continue;} // note, it's too early for you
									//if (this.timeAdjust(note.head) < tT && (typeof note.tail === "undefined" || this.timeAdjust(note.tail) < tT)){continue;} // note already went by
									var y = this.timeToPixel(this.timeAdjust(note.head));
									var yy = (typeof note.tail==="undefined")
										? null
										: this.timeToPixel(this.timeAdjust(note.tail));
									var l = lane;
									var x = ((l-1)*this.noteW)+(l*this.laneDividerW);
									var color = (note.started)
										? (!note.ended
											? (this.noteActiveCoA[l])
											: (this.noteFadedCoA[l]))
										: (this.noteCoA[l]);
									
									if (this.warningPreH > 0){
										if (ctx.fillStyle !== this.laneWarningPreCoA[lane]){ctx.fillStyle = this.laneWarningPreCoA[lane];}
//										ctx.fillStyle = "yellow";
										ctx.beginPath();
										if (this.noteShape === "rectangle"){
											if (yy === null){
												ctx.rect(x*_.pxd,(y+noteH_actual+(_.speedMultiplier<0?-this.warningPreH:0))*_.pxd,this.noteW*_.pxd,this.warningPreH *_.pxd);}
											else{
												ctx.rect(x*_.pxd,(y+noteH_actual+(_.speedMultiplier<0?-this.warningPreH:0))*_.pxd,this.noteW*_.pxd,this.warningPreH *_.pxd);}}
										ctx.closePath();
										ctx.fill();}
									if (this.warningPostH > 0){
										if (ctx.fillStyle !== this.laneWarningPostCoA[lane]){ctx.fillStyle = this.laneWarningPostCoA[lane];}
//										ctx.fillStyle = "red";
										ctx.beginPath();
										if (this.noteShape === "rectangle"){
											if (yy === null){
												ctx.rect(x*_.pxd,(y -this.warningPostH+(_.speedMultiplier<0?this.warningPostH:0))*_.pxd,this.noteW*_.pxd,this.warningPostH*_.pxd);}
											else{
												ctx.rect(x*_.pxd,(yy-this.warningPostH+(_.speedMultiplier<0?this.warningPostH:0))*_.pxd,this.noteW*_.pxd,this.warningPostH*_.pxd);}}
										ctx.closePath();
										ctx.fill();}
									if (ctx.fillStyle !== color){ctx.fillStyle = color;}
									ctx.beginPath();
									if (this.noteShape === "rectangle"){
										if (yy === null){
											ctx.rect(x*_.pxd,y*_.pxd,this.noteW*_.pxd,noteH_actual*_.pxd);}
										else{
											ctx.rect(x*_.pxd,yy*_.pxd,this.noteW*_.pxd,(y-yy+noteH_actual)*_.pxd);}}
									ctx.closePath();
									ctx.fill();}}
							this.root.changed({datA:[["passedHeadC",_.passedHeadC],["passedTailC",_.passedTailC]]});
							this.root.outbound();
						// [l] lanes and lane dividers
						break;case "L":
							anipnt.clearRect(ctx,0,0,w,h,_.pxd);
							// draw lane textures
							for (var lane = 1; lane <= this.keyC; lane++){
								x = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
								color = (this.keyStateA[lane] === 1)?this.laneActiveCoA[lane]:this.laneCoA[lane];
								anipnt.drawRect(ctx,x,0,this.noteW,h,color,_.pxd);}
							// draw lane dividers
							for (var l = 1; l <= this.keyC+1; l++){
								x = ((l-1)*this.noteW)+(l*this.laneDividerW)-this.laneDividerW;
								anipnt.drawRect(ctx,x,0,this.laneDividerW,h,this.laneDividerCo,_.pxd);}}}
					this.renderRegisterA = [];},
				preclConst1 : function(){
					// !!! does noteH really need to be adjusted here?
					var noteH_actual = Math.sign(this.speedMultiplier)*this.noteH;
					this.const1 = this.cachedH()+((this.chartP)*this.speedMultiplierAdjusted)-noteH_actual-Math.round((this.cachedH()-noteH_actual)*this.judgeLineRaise/1000);},
				cachedW     : function(){return this.width;},
				cachedH     : function(){return this.height;},
				preclWH     : function(){this.preclW();this.preclH();},
				preclW      : function(){return (this.width=(this.state==="lo")?this.canvasContainer.clientWidth:(this.keyC*this.noteW)+((this.keyC+1)*this.laneDividerW));},
				preclH      : function(){return (this.height=this.canvasContainer.clientHeight);},
				mousemove   : function(x,y){
					if (Ω.mousedownF){this.mousedown(x,y);} // ???
					/*if (e.KERN.initF && (y <= e.KERN.progressH || y >= e.KERN.height-e.KERN.progressH)){
							e.KERN.jump((e.KERN.audio.duration===0)?0:(x/e.KERN.width)*e.KERN.audio.duration*1000000);}*/},
				mousedown   : function(x,y){ll("mousedown : ("+x+","+y+")");
					var validF = F;
					var lane = 0;
					for (lane = 1; lane <= this.keyC; lane++){
						var _x  = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
						var _xx = _x+this.noteW;
						if (_x <= x && x <= _xx){validF = T;break;}}
					if (validF){
						this.root.inbound({datA:[["keyStateA",lane,1]]});
						//this.keyStateA[lane] = 1;
						//this.renderRegister("N","L");
						//this.keydown({key:-lane,loc:-575}); // iffy
						}},
				mouseup     : function(x,y){
					var validF = F;
					var lane = 0;
					for (lane = 1; lane <= this.keyC; lane++){
						var _x  = ((lane-1)*this.noteW)+(lane*this.laneDividerW);
						var _xx = _x+this.noteW;
						if (_x <= x && x <= _xx){validF = T;break;}}
					if (validF){
						this.root.inbound({datA:[["keyStateA",lane,0]]});
						//this.keyStateA[lane] = 0;
						//this.renderRegister("N","L");
						//this.keyup({key:-lane,loc:-575}); // iffy
						}},
			},
			validateFxnO : {
				//fil : function(_,base,access){_.url = (_.fil===N?"":URL.createObjectURL(_.fil));},
			},
			stabilize_SUB  : function(){π.p(o,{});var _ = this.o;
				if (this.if("chartR")){
					/*ll("WARNING : chartR");
					ll("this.alteredPropertyAllF : "+this.alteredPropertyAllF);
					ll("this.if(\"chartR\") : "+this.if("chartR"));
					ll("this.if(\"fluffybunny\") : "+this.if("fluffybunny"));
					ll("this.if.toString() : "+this.if.toString());
					ll("this.alteredPropertyP.includes(\"chartR\") : "+this.alteredPropertyP.includes("chartR"));
					ll("this.alteredPropertyP.searchCompareFxn.toString() : ",this.alteredPropertyP.searchCompareFxn.toString());
					ll("π.cc(this.alteredPropertyP.arr) v");
					ll(π.cc(this.alteredPropertyP.arr));*/
					var fxn = txt=>{ll("++++ CHART PREVIEW ++++",txt.substr(0,100));
						_.chartTxt   = txt;
						_.chartTxtF  = T;
						_.chartBox   = _.chartTxtDecode(_.chartTxt);
						ll(_.chartBox);
						_.keyC       = _.chartBox.keyC;
						_.hitC       = _.chartBox.noteA.reduceSum(note=>typeof note.tail === "undefined");
						_.holdC      = _.chartBox.noteA.reduceSum(note=>typeof note.tail !== "undefined");
						_.root.changed({datA:[["hitC",_.hitC],["holdC",_.holdC]]});
						_.root.outbound();
						_.scoreMax   = (_.hitC*_.missBoundary) + (_.holdC*_.missBoundary*2);
						_.lanexnoteA = _.chartBox.noteA.map(note=>π.ooas(note,{started:F,ended:F})).distribute(note=>note.lane);
						_.lanexnoteASort();
						var sortCompareFxn   = (a,b)=>a.head-b.head;
						var searchCompareFxn = (a,b)=>a     -b.head;
						_.lanexnoteIndexHeadPairP = _.lanexnoteA.map(noteA=>new SortedArray({arr:noteA.map((note,index)=>({index,head:note.head})),sortCompareFxn,searchCompareFxn}));
						var sortCompareFxn   = (a,b)=>a.tail-b.tail;
						var searchCompareFxn = (a,b)=>a     -b.tail;
						_.lanexnoteIndexTailPairP = _.lanexnoteA.map(noteA=>new SortedArray({arr:noteA.map((note,index)=>({index,tail:(typeof note.tail === "undefined"?note.head:note.tail)})),sortCompareFxn,searchCompareFxn}));
						_.snapA = _.chartBox.bpmA;
						_.snapA.sort((a,b)=>a.head-b.head);
						_.snapA = _.snapA.filter(snap=>snap.value>0);
						_.duration = _.calcFinalTime();
						var tail = _.duration;
						_.snapA.forEachReverse(snap=>{
							snap.tail = tail;
							tail = snap.head;});
						_.widthField = _.noteW*_.keyC + _.laneDividerW*(_.keyC+1);
						_.renderRegister("J","N","L");
						//ll(π.cc(_.chartTxt));
						//ll(π.cc(_.chartBox));
						//ll(π.cc(_.lanexnoteA));
						for (var lane = 1; lane <= _.keyC; lane++){
							if (typeof _.lanexnoteA[lane] === "undefined"){
								_.lanexnoteA[lane] = [];}}
						var pink      = rgbToHsl([255,  0,170].map(v=>v/255));
						var orange    = rgbToHsl([255,170,  0].map(v=>v/255));
						var purple    = rgbToHsl([170,  0,255].map(v=>v/255));
						var green     = rgbToHsl([170,255,  0].map(v=>v/255));
						var blue      = rgbToHsl([  0,170,255].map(v=>v/255));
						var turquoise = rgbToHsl([  0,255,170].map(v=>v/255));
						switch (this.keyC){default:noteCoA_RAW = [null];
							break;case  1:noteCoA_RAW = [null,pink                                                       ];
							break;case  2:noteCoA_RAW = [null,pink                                                  ,pink];
							break;case  3:noteCoA_RAW = [null,pink,orange                                           ,pink];
							break;case  4:noteCoA_RAW = [null,pink,orange                                    ,orange,pink];
							break;case  5:noteCoA_RAW = [null,pink,orange,green                              ,orange,pink];
							break;case  6:noteCoA_RAW = [null,pink,orange,green                        ,green,orange,pink];
							break;case  7:noteCoA_RAW = [null,pink,orange,green,blue                   ,green,orange,pink];
							break;case  8:noteCoA_RAW = [null,pink,orange,green,blue              ,blue,green,orange,pink];
							break;case  9:noteCoA_RAW = [null,pink,orange,green,blue,purple       ,blue,green,orange,pink];
							break;case 10:noteCoA_RAW = [null,pink,orange,green,blue,purple,purple,blue,green,orange,pink];}
						// fill in unspecified note colors
						for (var i = 1; i <= _.keyC.length; i++){if (typeof noteCoA_RAW[i] === "undefined"){noteCoA_RAW[i] = p.co;}}
						for (var lane = 1; lane <= _.keyC; lane++){_.keyStateA[lane] = 0;}
						_.state = "hi";this.changed({datA:[["state",_.state]]});
						_.jump(-_.introWaitTime);};
					if (!(_.chartTxt === "" && _.chartR === N)){π.flTx(_.chartR,fxn);} // a really shoddy way of blocking the initialization setup push with a null chartR value
					;}
				// color fallbacks (comes after we potentially figure out what keyC is)
				if (typeof _.laneDividerCo      === "undefined"){_.laneDividerCo      = hslma(_.tx,_.bg,0.2);}
				if (typeof _.snapMajorCo        === "undefined"){_.snapMajorCo        = hslma(_.tx,_.bg,0.8);}
				if (typeof _.snapMinorCo        === "undefined"){_.snapMinorCo        = hslma(_.tx,_.bg,0.4);}
				if (typeof _.laneWarningPreCoA  === "undefined"){_.laneWarningPreCoA  = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hsla (_.bg                    ,_.bg[3]));}
				if (typeof _.laneWarningPostCoA === "undefined"){_.laneWarningPostCoA = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hsla (_.bg                    ,_.bg[3]));}
				if (typeof _.laneCoA            === "undefined"){_.laneCoA            = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hsla (_.bg                    ,_.bg[3]));}
				if (typeof _.noteFadedCoA       === "undefined"
				||  typeof _.noteCoA            === "undefined"
				||  typeof _.noteActiveCoA      === "undefined"
				||  typeof _.laneActiveCoA      === "undefined"
				||  typeof _.hitboxCoA          === "undefined"
				||  typeof _.hitboxActiveCoA    === "undefined"){
					var pink      = rgbToHsl([255,  0,170].map(v=>v/255));
					var orange    = rgbToHsl([255,170,  0].map(v=>v/255));
					var purple    = rgbToHsl([170,  0,255].map(v=>v/255));
					var green     = rgbToHsl([170,255,  0].map(v=>v/255));
					var blue      = rgbToHsl([  0,170,255].map(v=>v/255));
					var turquoise = rgbToHsl([  0,255,170].map(v=>v/255));
					var noteCoA_RAW = [null,pink,orange,green,blue                   ,green,orange,pink];}
				if (typeof _.noteFadedCoA       === "undefined"){_.noteFadedCoA       = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hslma(noteCoA_RAW[i],_.bg,0.5 ,    0.5));}
				if (typeof _.noteCoA            === "undefined"){_.noteCoA            = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hsla (noteCoA_RAW[i]                  ));}
				if (typeof _.noteActiveCoA      === "undefined"){_.noteActiveCoA      = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hslma(noteCoA_RAW[i],_.tx,0.3         ));}
				if (typeof _.laneActiveCoA      === "undefined"){_.laneActiveCoA      = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hslma(noteCoA_RAW[i],_.bg,0.2 ,_.bg[3]));}
				if (typeof _.hitboxCoA          === "undefined"){_.hitboxCoA          = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hsla (noteCoA_RAW[i]          ,    0.5));}
				if (typeof _.hitboxActiveCoA    === "undefined"){_.hitboxActiveCoA    = Array(_.keyC+1).fill(0).map((v,i)=>(i===0)?"transparent":hslma(noteCoA_RAW[i],_.tx,0.3 ,    1  ));}
				if (this.if("noteFadedCoA","noteCoA","noteActiveCoA","laneWarningPreCoA","laneWarningPostCoA","laneCoA","laneActiveCoA","hitboxCoA","hitboxActiveCoA")){_.renderRegister("N");}
				if (this.if("missBoundary")){
					_.hitC     = _.chartBox.noteA.reduceSum(note=>typeof note.tail === "undefined");
					_.holdC    = _.chartBox.noteA.reduceSum(note=>typeof note.tail !== "undefined");
					_.scoreMax = (_.hitC*_.missBoundary) + (_.holdC*_.missBoundary*2);}
				if (this.if("pxd")){_.renderRegister("S","J","Decon082_ver1","N","L");_.sizeAll();}
				if (this.if("laneDividerCo","laneDividerW")){_.renderRegister("J","L");_.widthField = _.noteW*_.keyC + _.laneDividerW*(_.keyC+1);}
				if (this.if("laneDividerW")){_.renderRegister("N");}
				if (this.if("chartP")){_.renderRegister("N");}
				if (this.if("introWaitTime")){_.renderRegister("N");}
				if (this.if("snapMultiplier")){_.renderRegister("N");}
				if (this.if("judgeLineRaise")){_.renderRegister("J","N");}
				if (this.if("snapH")){_.renderRegister("N");}
				if (this.if("noteW","noteH")){_.renderRegister("J","N","L");}
				if (this.if("noteW")){_.widthField = _.noteW*_.keyC + _.laneDividerW*(_.keyC+1);}
				if (this.if("warningPreH","warningPostH")){_.renderRegister("N");}
				if (this.if("noteOffset")){_.renderRegister("N");}
				if (this.if("speedMultiplier","playbackRate")){
					_.speedMultiplierAdjusted = (_.playbackRate === 0 ? Infinity : _.speedMultiplier/_.playbackRate);
					_.anchorT = _.chartT;
					_.anchorP = _.chartP;
					_.renderRegister("N");}
				if (this.if("keyStateA")){
					var t = _.chartP;
					var tDejusted = _.timeDejust(t); // instead of wasting time Adjusting every note t, just Dejust our one comparison t
					var noteRenderF = F;
					if (_.hitC > 0 || _.holdC > 0){
						_.noteInstantStatA.length = 0;
						var noteChange = F;
						for (var laneI = 1; laneI <= _.keyC; laneI++){var laneS = str(laneI);
							if (this.ifFull(["keyStateA",laneS])){
								// keydown
								if         (_.keyStateA[laneS] === 1)  {
									//var tDebug_a = performance.now();
									//lld(laneS+" down");
									noteRenderF = T;
									//ll("---------------------");
									// this will land us approximately around our closest notes, but it may land us a little farther away than expected
									// really treat this as just a vague suggestion-search-starting-point
									var recommendedHeadPairI = _.lanexnoteIndexHeadPairP[laneI].indexOf(tDejusted,100);
									var recommendedNoteI = _.lanexnoteIndexHeadPairP[laneI].get(recommendedHeadPairI).index;
									var noteBestI = -1;
									var distanceBest = N;
									var noteFinalI = _.lanexnoteIndexHeadPairP[laneI].length-1;
									// look down
									//ll("down");
									for (var noteI = recommendedNoteI; noteI >= 0; noteI--){var note = _.lanexnoteA[laneI][noteI];
										if (note.started){continue;} // ignore notes that have already been triggered
										var distance = Math.abs(tDejusted-note.head);
										//ll(π.jsonE(note)+" "+distance);
										if (tDejusted-note.head > _.missBoundary){break;} // ! NOT absolute valued, our SortedArray Lazy Recommendation algorithm may land us somewhere strange
										if (distanceBest === N || distance < distanceBest){/*ll("store");*/distanceBest = distance;noteBestI = noteI;}}
									// look up
									//ll("up");
									for (var noteI = recommendedNoteI+1; noteI <= noteFinalI; noteI++){var note = _.lanexnoteA[laneI][noteI];
										if (note.started){continue;} // ignore notes that have already been triggered
										var distance = Math.abs(tDejusted-note.head);
										//ll(π.jsonE(note)+" "+distance);
										if (note.head-tDejusted > _.missBoundary){break;} // ! NOT absolute valued, our SortedArray Lazy Recommendation algorithm may land us somewhere strange
										if (distanceBest === N || distance < distanceBest){/*ll("store");*/distanceBest = distance;noteBestI = noteI;}}
									// use the closest note for the comparison
									if (noteBestI !== -1 && distanceBest <= _.missBoundary){var note = _.lanexnoteA[laneI][noteBestI];
										//ll("distanceBest : "+distanceBest);
										//ll("noteBestI : "+noteBestI);
										//ll(note);
										//var err = Math.abs(note.head-tDejusted);
										//lld(err);
										//this.score += this.errorToScore(err);
										//this.stat.push([noteI,0,err]);
										note.started = T;
										_.noteInstantStatA.push({whichEnd:"head",note:π.cc(note),t:tDejusted,timeUntilExact:note.head-tDejusted,missBoundary:_.missBoundary});
										_.earnedHeadC++;
										this.changed({datA:[["earnedHeadC",_.earnedHeadC]]});
										note.ended = (typeof note.tail === "undefined");
										if (typeof note.tail === "undefined"){
											_.noteInstantStatA.push({whichEnd:"tail",note:π.cc(note),t:tDejusted,timeUntilExact:note.head-tDejusted,missBoundary:_.missBoundary});
											_.earnedTailC++;
											this.changed({datA:[["earnedTailC",_.earnedTailC]]});}
										noteChange = T;}
									//var tDebug_b = performance.now();
									//lld(Math.ceil((tDebug_b-tDebug_a)*1000)+"µs");
									;}
								// keyup
								else /* if (_.keyStateA[laneS] === 0)*/{
									noteRenderF = T;
//									// this will land us approximately around our closest notes, but it may land us a little farther away than expected
//									// really treat this as just a vague suggestion-search-starting-point
//									var recommendedTailPairI = _.lanexnoteIndexTailPairP[laneI].indexOf(tDejusted,100);
//									var recommendedNoteI = _.lanexnoteIndexTailPairP[laneI].get(recommendedTailPairI).index;
//									var noteBestI = -1;
//									var distanceBest = N;
//									var noteFinalI = _.lanexnoteIndexTailPairP[laneI].length-1;
//									// look down
//									for (var noteI = recommendedNoteI; noteI >= 0; noteI--){var note = _.lanexnoteA[laneI][noteI];
//										if (!note.started || typeof note.ended === "undefined" || note.ended){continue;}
//										var distance = Math.abs(tDejusted-note.tail);
//										if (tDejusted-note.tail > _.missBoundary){break;} // ! NOT absolute valued, our SortedArray Lazy Recommendation algorithm may land us somewhere strange
//										if (distanceBest === N || distance < distanceBest){/*ll("store");*/distanceBest = distance;noteBestI = noteI;}}
//									// look up
//									for (var noteI = recommendedNoteI+1; noteI <= noteFinalI; noteI++){var note = _.lanexnoteA[laneI][noteI];
//										if (!note.started || typeof note.ended === "undefined" || note.ended){continue;}
//										var distance = Math.abs(tDejusted-note.tail);
//										if (note.tail-tDejusted > _.missBoundary+(note.tail-note.head)){break;} // ! NOT absolute valued, our SortedArray Lazy Recommendation algorithm may land us somewhere strange
//										if (distanceBest === N || distance < distanceBest){/*ll("store");*/distanceBest = distance;noteBestI = noteI;}}
									
									// close all open notes
									var noteFinalI = _.lanexnoteA[laneI].length-1;
									for (var noteI = 0; noteI <= noteFinalI; noteI++){var note = _.lanexnoteA[laneI][noteI];
										if (note.started === T && note.ended === F){
											note.ended = T;
											_.noteInstantStatA.push({whichEnd:"tail",note:π.cc(note),t:tDejusted,timeUntilExact:note.tail-tDejusted,missBoundary:_.missBoundary});
											_.earnedTailC++;
											this.changed({datA:[["earnedTailC",_.earnedTailC]]});
											noteChange = T;}}
									
									
//									// use the closest note for the comparison
//									if (noteBestI !== -1){var note = _.lanexnoteA[laneI][noteBestI];
//										//var err = Math.abs(note.tail-tDejusted);
//										//lld(err);
//										//this.score += this.errorToScore(err);
//										//this.stat.push([noteI,0,err]);
//										note.ended = T;
//										_.noteInstantStatA.push({whichEnd:"tail",note:π.cc(note),t:tDejusted,timeUntilExact:note.tail-tDejusted,missBoundary:_.missBoundary});
//										noteChange = T;}
									;}}}
						if (noteChange){
							this.changed({datA:[["noteInstantStatA",_.noteInstantStatA]]});}
					}
					if (noteRenderF){
						_.renderRegister("N");}
					_.renderRegister("J","L");}
				/*
				// keydown
				// if note is close by, trigger it, cap out at 1 note maximum
				this.lanexnoteA[lane].some(note=>{
					if (note.started || note.ended){return F;} // ignore notes that have already been triggered
					var err = Math.abs(this.timeAdjust(note.head)-instantT);
					var breakF = F;
					if (err <= this.missBoundary){
						this.score += this.errorToScore(err);
						this.stat.push([noteI,0,err]);
						note.started = T;
						note.ended = (typeof note.tail === "undefined");
						breakF = T;}
					return breakF;});
				// keyup
				// if hold-note is close by, untrigger it, cap out at 1 note maximum
				this.lanexnoteA[lane].some(note=>{
					if (!note.started || note.ended || typeof note.tail === "undefined"){return F;} // ignore these notes
					var errEarly = this.timeAdjust(note.tail)-instantT;
					var errLate = -1*errEarly;
					var early = (errEarly > 0);
					var exact = (errEarly === 0);
					var late  = (errLate > 0);
					var breakF = F;
					if (exact){this.score+=this.errorToScore(                                                             0);this.stat.push([noteI,1,       0]);breakF=T;}
					if (late ){this.score+=this.errorToScore(errLate ,this.timeAdjust(note.tail)-this.timeAdjust(note.head));this.stat.push([noteI,1,errLate ]);breakF=T;}
					if (early){this.score+=this.errorToScore(errEarly,this.timeAdjust(note.tail)-this.timeAdjust(note.head));this.stat.push([noteI,1,errEarly]);breakF=T;}
					note.ended = T;
					return breakF;});
				*/
				if (this.if(colornameA)){_.renderRegister("J","L");}
				if (this.if("modO_Decon082_ver1")){_.renderRegister("Decon082_ver1");}
				if (this.if("tTentativeSignal") && _.tTentativeSignal !== N){_.jump(_.tTentative*_.duration);}
				if (this.ifFull(["keyStateA","reset"]) && _.keyStateA.reset    === 1){_.jump(-_.introWaitTime);}
				if (this.ifFull(["keyStateA","hi"   ]) && _.keyStateA.hi       === 1){_.state = "hi";this.changed({datA:[["state",_.state]]});}
				if (this.ifFull(["keyStateA","lo"   ]) && _.keyStateA.lo       === 1){_.state = "lo";this.changed({datA:[["state",_.state]]});}
				if (this.ifFull(["keyStateA","hop↑" ]) && _.keyStateA["hop↑"]  === 1){if (_.snapMultiplier !== 0){_.jump(_.timeAdjust(_.nearestSnapUp()));_.dontBeLazy = T;}}
				if (this.ifFull(["keyStateA","hop↓" ]) && _.keyStateA["hop↓"]  === 1){if (_.snapMultiplier !== 0){_.jump(_.timeAdjust(_.nearestSnapDown()));_.dontBeLazy = T;}}
				if (this.ifFull(["keyStateA","jump↑"]) && _.keyStateA["jump↑"] === 1){if (_.snapMultiplier !== 0){_.jump(_.timeAdjust(_.nearestSnapMajorUp()));_.dontBeLazy = T;}}
				if (this.ifFull(["keyStateA","jump↓"]) && _.keyStateA["jump↓"] === 1){if (_.snapMultiplier !== 0){_.jump(_.timeAdjust(_.nearestSnapMajorDown()));_.dontBeLazy = T;}}
				if (this.ifFull(["translateSignalO","FtB4" ])){_.translatedSO["FtB4" ] = _.chartTextEncode({which:"FtB4" });this.changed({datA:[["translatedSO","FtB4" ,_.translatedSO["FtB4" ]]]});this.outbound();}
				if (this.ifFull(["translateSignalO","o!m14"])){_.translatedSO["o!m14"] = _.chartTextEncode({which:"o!m14"});this.changed({datA:[["translatedSO","o!m14",_.translatedSO["o!m14"]]]});this.outbound();}
				if (this.if("state")){
					this.changed({datA:[["chartP",_.chartP],["state",_.state]]});}
				; // we don't need to to call outbound here, because the end of a stabilize() fxn always trails into an outbound() call, because we're within the inbound() fxn
				; // additionally, calling outbound() here would be incorrect, since outbound wipes the if() array, which currently serves a dual inbound/outbound purpose
			},
			setup_SUB : function(){var _ = this.o;
				µ.rr(this.elP,µ.m([[
					[".KERN000006A"+this.base,{z:{KERN:this}},π.cc(_.layernameA).reverse().map(v=>["canvas.KERN000006AA"+this.base+"[data-layer='"+v+"']"])]
				]]));
				_.canvasContainer = µ.qd(this.elP,".KERN000006A"+this.base);
				_.canvasO = _.layernameA.mapO(v=>({[v]:µ.qd(this.elP,".KERN000006AA"+this.base+"[data-layer='"+v+"']")}));
				_.ctxO = _.canvasO.map(canvas=>canvas.getContext("2d"));
				_.ctxO.forEach(ctx=>{ctx.imageSmoothingEnabled = F;});
				_.canvasO.S.addEventListener("mousemove",function(_){return function(e){var x = e.pageX - µ.offsetLeftTotal(this);var y = e.pageY - µ.offsetTopTotal(this);_.mousemove(x,y);};}(this.o));
				_.canvasO.S.addEventListener("mousedown",function(_){return function(e){var x = e.pageX - µ.offsetLeftTotal(this);var y = e.pageY - µ.offsetTopTotal(this);_.mousedown(x,y);};}(this.o));
				_.canvasO.S.addEventListener("mouseup"  ,function(_){return function(e){var x = e.pageX - µ.offsetLeftTotal(this);var y = e.pageY - µ.offsetTopTotal(this);_.mouseup  (x,y);};}(this.o));
				_.sizeAll();},
			refreshResize_SUB : function(){var _ = this.o;
				_.sizeAll();
				_.renderRegister("S","J","Decon082_ver1","N","L");},
			drawFrame_SUB : function(now){//now *= 1000;//if (Math.random()<0.1){ll(this.state);}
				var _ = this.o;
				_.chartT = now;
				switch (_.state){default:
					break;case "lo":
						_.anchorT = _.chartT;
						_.anchorP = _.chartP;
						// !!! random color noise so I know when debugging that the gf is reponsive
						if (π.rand(0,29)===0){
							var ctx = _.ctxO.S;
							anipnt.clearRect(ctx,0,0,_.cachedW(),_.cachedH(),_.pxd);
							var size = 20;
							for (var i = 0; i < 7; i++){
								anipnt.drawRect(ctx,π.rand(0,_.cachedW()-size),π.rand(0,_.cachedH()-size),size,size,hsla([π.rand(0,1000)*0.001,π.rand(0,1000)*0.001,π.rand(0,1000)*0.001],π.rand(0,1000)*0.001),_.pxd);}
							_.renderRegister("S");}
						if (_.dontBeLazy){
							_.renderRegister("N");
							this.outbound();}
					break;case "hi":
						_.chartP = _.anchorP+((_.chartT-_.anchorT)*_.playbackRate);
						anipnt.clearRect(_.ctxO.S,0,0,_.cachedW(),_.cachedH(),_.pxd);
						_.renderRegister("N");
						this.changed({datA:[["chartP",_.chartP]]});
						this.outbound();
				}
				_.scoreMaxSoFar = _.calcScoreMaxSoFar();
				_.render();
				_.dontBeLazy = F;},
		});
		oo.o.root = oo;
		oo.portInP .pushA([
			["pxd",KERNTypeO.number],
			["laneDividerCo",KERNTypeO.string],
			["laneDividerW",KERNTypeO.number],
			["chartR",KERNTypeO.complexReference],
			["chartP",KERNTypeO.number],
			["state",KERNTypeO.string],
			["introWaitTime",KERNTypeO.number],
			["playbackRate",KERNTypeO.number],
			["volume",KERNTypeO.number],
			["snapMultiplier",KERNTypeO.number],
			["judgeLineRaise",KERNTypeO.number],
			["snapH",KERNTypeO.number],
			["noteW",KERNTypeO.number],
			["noteH",KERNTypeO.number],
			["warningPreH",KERNTypeO.number],
			["warningPostH",KERNTypeO.number],
			["noteOffset",KERNTypeO.number],
			["speedMultiplier",KERNTypeO.number],
			["keyStateA",KERNTypeO.array,KERNTypeO.number],
			["translateSignalO",KERNTypeO.object,KERNTypeO.signal],
			["modO_Decon082_ver1",KERNTypeO.object,KERNTypeO.array,KERNTypeO.object,KERNTypeO.complex],
			["tTentativeSignal",KERNTypeO.signal],
			["tTentative",KERNTypeO.number],
		].concat(colornameA.map(colorname=>[colorname,KERNTypeO.array,KERNTypeO.complex])));
		oo.portOutP.pushA([
			["noteInstantStatA",KERNTypeO.complex],
			["hitC",KERNTypeO.number],
			["holdC",KERNTypeO.number],
			["passedHeadC",KERNTypeO.number],
			["passedTailC",KERNTypeO.number],
			["scoreResetSignal",KERNTypeO.signal],
			["earnedHeadC",KERNTypeO.number],
			["earnedTailC",KERNTypeO.number],
			["translatedSO",KERNTypeO.object,KERNTypeO.string],["duration",KERNTypeO.number],["score",KERNTypeO.number],["scoreMaxSoFar",KERNTypeO.number],["playbackRate",KERNTypeO.number],["state",KERNTypeO.string],["chartP",KERNTypeO.number],["volume",KERNTypeO.number]]);
		return oo;},
	};
</script>
