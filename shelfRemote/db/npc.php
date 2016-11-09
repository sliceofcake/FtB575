<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

$NPC = array(
	array("NPC","hello"), /* FtB3 had a ghost trigger macro to echo "hello" from a random possessed account randomly upon processing a "hello" message in the chat */
	array("NPC","I love FtB!"),
	array("NPC","This site sucks!"), /* something we hear a lot */
	array("NPC","The FtB dev team is wonderful!"), /* something we never hear */
	array("NPC","FtB is so much cooler than osu!"),
	array("NPC","Where did XceeD go?"), /* Xceed is the creator of FtB and has abandoned FtB */
	array("xxReimu","We need this from bandmaster! http://www.bandmaster.com.ph/wp-content/uploads/2010/09/BandMaster2010%C2%B3%C3%A209%C2%BF%C3%B906%C3%80%C3%8F20%C2%BD%C3%8336%C2%BA%C3%9033%C3%83%C3%8A_07%C3%88%C2%B8.jpg"), /* AGIPS: Anime Girls In Penguin Suits; FtB3 dev team inside joke */
	array("Jakob","I just FCed Circus Galop!"), /* Full Complete exploit in FtB2 used on the hardest [at the time] chart */
	array("NPC","Stop cheating!"), /* FtB2 had many exploits */
	array("NPC","My flair key isn't working!"), /* FtB3 introduced the flair key */
	array("NPC","I love my new background."), /* FtB3 introduced background images */
	array("NPC","My avatar won't upload!"), /* a class of complaints that we hear a lot */
	array("NPC","How do I find really easy songs?"), /* a common question */
	/* self-referential humor */
	array("NPC","What does #slap:".$name." do?"),
	array("NPC","#slap:".$name),
	array("NPC","Hey look, it's ".$name."!"),
	array("NPC","..."),
	array("NPC","ping"), /* dev team filler word for testing whether something could receive, store, retrieve, and send arbitrary text data */
	array("NPC","pong"), /* Decon082's humorous response to "ping" */
	array("NPC","[tc]"), /* -----'s "time check" to check the horribly messed up FtB2 chat time, which abided by a non-existent timezone */
	array("NPC","Guys, I need a new keyboard. Can anyone recommend one?"), /* an increasingly common question */
	array("yukijudai","I HATE JACK NOTES!!11!1"), /* a skilled player who made his hate for jack notes [and his poor English / keyboard accuracy] public */
	array("nivrad00","#spacebarisourwayoflife #protectFtBvalues"), /* in response to a wave of people who don't use spacebar in their key layout */
	array("NPC","What keyboard layout do you guys use?"), /* FtB水 allowed users to see each other's key layouts */
	array("NPC","I just jumped 7 levels lol"), /* playing a difficult chart in FtB3 caused a user to level up by a large amount */
	array("NPC","I can't find any pokémon charts"),
	array("Reisys VI Felicity Sumeragi","Someone chart this! https://www.youtube.com/watch?v=Z-vtOKppCjc"), /* gatchaman crowds OST "Unbeatable Network"; the last thing nejuer wanted charted before he left */
	array("NPC","OMG guys type NYAN_CAT in the chat box that \"does nothing\"!!"), /* the "box that does nothing" in FtB火 and FtB3 was a commands box with unlisted easter egg commands */
	array("air22x","GOD. IS. DEAD. D:"), /* the response when ----- left FtB */
	array("NPC","I keep failing at ".rand(0,99)."%!"), /* a common phrase among players attempting to complete a difficult chart */
	array("NPC","This chat is lagging so badly"), /* a common complaint in FtB3 */
	array("NPC","Have you heard about Bill?"), /* a reference to a character in Pokémon Gen I, specifically for the NPC's appearance in TPP (Twitch Plays Pokémon) */
	array("Nejuer","こど◯のじ◯ん teaches family values."),/* nejer's love for こどものじかん manga */
	/* air's renaming streak when he was a three-star admin ✦✦✦ */
	/* air's default message */
	array("air","o"),
	array("airstrike","o"),
	array("airbag","o"),
	array("airdrop","o"),
	array("airport","o"),
	array("airline","o"),
	array("airplane","o"),
	array("airsick","o"),
	array("airflow","o"),
	array("airmail","o"),
	array("airship","o"),
	array("airwave","o"),
	array("airlift","o"),
	array("airbrush","o"),
	array("nejuer",":O"), /* nejuer's default emoticon */
	array("NO.2841","I finally figured out how to make a j-note! This'll be a charting revolution!"), /* when NO.2841 discovered the j-note in one of Jxyden's pokémon charts, marking the beginning of a charter exploit wave */
	array("kanra","oops okay NO ONE open the chat for the next 10 minutes! o_o;;"), /* kanra was known for editing live FtB code, often causing particularly alarming repercusions should the user perform an action that wasn't properly hooked up to its corresponding action, such as using the chat; the chat was the most-changed part of FtB3 */
	array("Tullse","Say goodbye to FtB. It's LOIC time!"), /* a script kiddie who made frequent use of the LOIC */
	/* an easter egg in FtB火 that, when the user issued a MAKE_CONTRACT command, drained a user's fp until it hit zero and they turned into a witch; a reference to Puella Magi Madoka Magica */
	array("／人◕ ‿‿ ◕人＼﻿","Make a contract with me and become a magical girl!"),
	array("NPC","What does MAKE_CONTRACT do?"),
	array("ζ*'ヮ')ζ﻿","My scores won't submit! D:"), /* pre-FtB4 versions would not properly handle certain MySQL-sensitive characters, such as the apostrophe in this user's name */
	array("zach72","INSTIGATE_APOCALYPSE oops wrong box x_x"), /* the joke-that-was-later-not-a-joke admin two-star command that actually did something rather dire if issued; it was never issued in production */
	array("Decon082","http://a.pomf.se/vzxumq.png"), /* a reference to AGIPS (Anime Girls In Penguin Suits; FtB3 dev team inside joke) */
	array("Shimakaze","SNOW MIKU http://www.youtube.com/watch?v=79N1O0lF0GY"), /* Shimakaze's love for snow miku */
	array("Lenfried","I have more than 100% FtB completion ..."), /* an FtB3 bug where the total charts playable was greater than the charts the system considered playable, resulting in this dedicated user (who completed every chart on the site at one point in time) seeing their FtB completion go over 100% */
	array("NPC","Get on the skype chat!"), /* following the FtB2 Apocalypse, zach72 started a persistent skype chatroom for FtB */
	array("NPC","Maintain 575!"), /* for several months, charts were being added and deleted and coincidently evened out to 575 each time */
	array("bookkid900","Help! I can't edit God Knows!"), /* FtB2 set a cap so that charters couldn't edit a chart that had 100 or more votes */
	array("NPC","Someone join my guild!"), /* FtB3 had guilds; real-time multiplayer */
	array("Julzboiy","This class system is genius!"), /* paraphrased comment when the FtB3 class system was announced and released */
	array("NPC","I can't find anything on this site anymore..."), /* a common complaint, especially when FtB was rapidly changing */
	array($name,"Guys ... what's going on? I'm seeing all these messages that no one else is seeing. What's happening?"), /* self-referential humor */
	array("NPC","Everyone turn your FtB weather option on! command:WEATHER_ON"), /* FtB火 had weather as an option, weather was pulled from three real-world location weather feeds */
	array("NPC","So much lag!!1!1"), /* a somewhat common complaint */
	array("Merlin","Has anyone really been far even as decided to use even go want to do look more like?"), /* Merlin's avatar was a raptor */
	array("NPC","How do I get more fp?"), /* when fp was a public stat, many users asked how to gain more */
	array("NPC","peppy messed up the pp system D:"), /* at the height of FtB dev, peppy was changing the pp system and breaking a lot of things */
	array("NPC","unsafe_mysql_query(\"DELETE FROM *\");"), /* one potentially alarming SQL injection possibility */
	array("NPC","help me! my keyboard isn't working!"),
	array("NPC","Is anyone here a programmer?"), /* FtB is understaffed */
	array("NPC","Is anyone here a web developer?"), /* FtB is understaffed */
	array("NPC","Is anyone here a lawyer?"), /* FtB is understaffed and possibly illegal */
	array("NPC","Can anyone here help me with my homework?"), /* at one time during FtB火, this was a common question / conversation topic */
	array("NPC","Should I keep playing FtB ... or go to class?"), /* at one time during FtB火, this was a common wonder, especially by xxReimu */
	array("NPC","Guys, I'm using Netscape right now and nothing is working! I also tried using IE5. What could possibly be wrong?"), /* some users were using really old browsers */
	array("NPC","LEEEROOOY! JENKIIINS!"), /* the force start button for FtB3 guilds multiplayer mode was titled this */
	/* a reference to TPP (Twitch Plays Pokémon) */
	array("NPC","start9"),
	array("NPC","CONSULT THE HELIX FOSSIL"),
	array("NPC","HELIX GIVE US GUIDANCE"),
	array("NPC","ヽ༼ຈل͜ຈ༽ノ RIOT OR RIOT ヽ༼ຈل͜ຈ༽ノ"),
	array("NPC","r.i.p. ABBBBBBK ("),
	array("NPC","r.i.p. JLVWNNOOOO"),
	array("NPC","r.i.p. fluff"), /* FtB fluff was a sandbox version of FtB that never took off */
	array("NPC","&#63743;→♞"), /* FtH: Feed the Horse; FtB3 dev team inside joke */
	array("Inori Aizawa","What if we took FtB ... and pushed it somewhere else?"), /* nejuer's often stated idea (originally stated by partick star) that had odd validity in every applied situation */
	array("海","Worry not; our world-renowned team of coding monkeys is working around the clock on a fix!"), /* the message when an error happened on FtB火, taken from youtube's old error page */
	/* MISAKA ##### guest accounts in FtB火 */
	array(("MISAKA ".(rand(0,999999)%(20000-10032+1)+10032)),"\"...?\", says MISAKA with a confused look."),
	array("NPC","What is \"".rand(0,100)." MISAKA\"?"), /* MISAKA accounts appeared in chat along with proper users, and just a count was given */
	array("MISAKA 20001","\"Are you used to this by now?\", asks MISAKA as MISAKA."), /* MISAKA 20001 was the special misaka for the dev team's use */
	array("YUKI.N>","We should just delete one account per day at the bell toll of midnight"), /* FtB post apoc cleanup idea, after deleting thousands of stale accounts for the first time */
	array("NPC","FEED_HAMSTER"), /* FtB apoc idea: users would have to feed the FtB hamster every 24 hours or it would die and destroy FtB */
	array("NPC","GUILE_ROOM"), /* easter egg that brought up guile's theme acapella version */
	array("NPC","NEJUER_SPIN"), /* easter egg that spun every major element on the page; reference to nejuer's obsession with animating things on FtB; reimplemented in FtB4 by "doing a barrel roll" by pressing R or Z twice */
	array("NPC","Everyone, go play my new chart!"),
	array("peppy","osu! tablets are now shipping!"), /* reference to when peppy started selling osu! tablets */
	array("SilvaHD","I found a way to post in the news thread. Why aren't the mods doing anything about it?"), /* one of many FtB2 exploits */
	array("NPC","Who is Renard?"), /* following a wave of Renard charts in FtB2 */
	array("NPC","People die if they are killed... That's the way it should be."), /* reference to the Fate anime series */
	array("XceeD","Hi everyone! Thanks for waiting for FtB3! It'll be amazing!"), /* XceeD's grand empty promise to deliver FtB3 for years */
	array("NPC","Hey, remember F2Jam?"),
	array("NPC","Hey, remember Feel the Beat?"),
	array("NPC","Hey, remember FtB B2?"),
	array("NPC","Hey, remember FtB水?"),
	array("NPC","Hey, remember FtB火?"),
	array("NPC","Hey, remember FtB▢?"),
	array("NPC","Hey, remember fortepiano?"),
	array("NPC","Hey, remember FtB花火?"),
	array("NPC","Hey, remember FtB2?"),
	array("NPC","Hey, remember FtB3?"),
	array("NPC","Hey, remember FtB4?"),
	array("NPC","Hey, remember FtB5?"),
	array("NPC","Hey, remember FtB6?"),
	array("NPC","Hey, remember FtB7?"),
	array("NPC","Hey, remember FtB8?"),
	array("NPC","Hey, remember FtB0?"),
	array("NPC","Is this FtB3?"), /* confusion because FtB3 was a reserved term for XceeD's work in progress */
	array("NPC","When will FtB3 be released?"), /* never, unless you ask XceeD */
	array("NPC","When will FtB7 be released?"), /* good question */
	array("NPC","The white theme is too bright."), /* a common complaint when the white theme came out in FtB3, which almost no one used */
	array("NPC","How do I change my color?"), /* a lot of our users are silly */
	array("NPC","How do you guys use the spacebar?"), /* some users don't use the spacebar in their key layout */
	array("NPC","My rank went down! D:"), /* a common complaint for people who didn't properly understand how the fp system worked */
	array("NPC","How do I chart a song? HELP"),
	array("NPC","Come join our match on osu!"), /* many FtB regulars play osu! */
	array("NPC","Did any of you play Hit Machine on omgpop?"), /* some FtB regulars came over from omgpop's rhythm game: Hit Machine */
	/* zach72 did something silly and deleted salp's account, which removed a popular chart: ryuuseigun midi version */
	array("NPC","I can't find ryuuseigun!"),
	array("Salp","Why is my account gone?"),
	array("NPC","So many users online ..."), /* during the height of FtB dev, we saw up to 20 online users at a time */
	//array("NPC","What, ".$name.", you're still here? Looks like you still have ... ".mysql_result(unsafe_mysql_query("SELECT TIMEDIFF(reviveDate,NOW()) FROM users WHERE id='$user_id'"),0)." ... time left before you wake from your slap-induced coma."),
	array("NPC","rm -rf *"), /* a scary command to run, but one that our silly users would follow if instructed to */
	array("Yondaime","You should use grep for that."), /* Yondaime was putting his ignorance on display one day in a talk with FtB devs */
	array("Yurippe","Hey, you must be new around here. Welcome to the Like-Hell-I'm-Dead Battlefront [name subject to change]."), /* reference to Angel Beats */
	/* self-referential */
	array("NPC","Hi ".$name."!"),
	array("NPC",$name.", why aren't you answering me? D:"),
	array("NPC","Hey ".$name.", how've ya been?"),
	array("NPC","Hey look guys, it's ".$name."!"),
	array("NPC","Why isn't anyone responding?"),
	array("NPC","Hello? Is anybody out there?"),
	array("NPC","oww ... my wrists!"), /* playing high density charts and/or marathon charts causes wrist pain */
	array("Tom","Hey guys this is Tom from www.thorgaming.com I have provided free hosting for feel the beats and also paid for the domain for about 5 years, the hosting is about $180 per month, I am going to need links back to thorgaming.com and also some contributions to the hosting."), /* literal from the chat one day */
	array("NPC","Hello, this is Domino's Pizza. What would you like to order?"),
	array("NPC","Would you like to super-size that?"),
	array("ＮＰＣ","お前はもう死んでいる"), /* you are already dead meme */
	array("ＮＰＣ","この場所はどこですか"), /* where is this place? */
	array("NPC","Haneda Airport has a giant miku statue!"), /* noted by Lenfried and temporarily added to the FtB3 FtB世界 map */
	array("EpikPhail","Just FPed Big Black."),
	array("Volere","desudesudesudesudesu degeso"), /* Volere is an otaku */
	array("NPC","How do I fix game lag?"), /* a common question in FtB火 */
	array("NPC","My profile picture isn't uploading! Someone help me!"), /* our users always complain */
	array("Paulnet","Okay, it's time for a new chart dump!"), /* certain users stock up charts and release many at once for some reason */
	array("Paulets","We're now collecting votes for the best charts of 2012! It's our first \"Best of ____\" poll!"), /* a yearly poll and video that started in 2012 */
	array("NPC","1 away from FCing!"), /* FC: Full Complete: 100% */
	array("NPC","I missed a note at the very end of this song! C'mon! D:<"), /* especially annoying on long charts */
	array("NPC","I can't FP this chart!!! D:< It's driving me crazy. How do you guys FP stuff?"), /* certain users, like GabrielRabaioli */
	array("NPC","YES! I finally made it on the top 10 list."), /* silly people and their attachment to the leaderboards */
	array("NPC","ggrks"), /* go google it ... no seriously */
	array("NPC","うぼあああああああああああ"), /* google it, reference from an old chart */
	array("AmyXx","Why aren't there any other girls on the FtB skype chat?"), /* AmyXx was the first user to emphasize her gender */
	array("Charlotte","It's time for another FtB tournament! Read about it in the recent news section!"), /* most of these were failures */
	array("JS","We now have negative BPMs!"), /* he talked with XceeD to make this a feature */
	array("NPC","When I search for \"zl\", nothing comes up!"), /* FtB2 had a min character limit of 3 characters, yet some entries had fewer than 3 characters */
	array("NPC","When I search for \"JS\", nothing comes up!"), /* FtB2 had a min character limit of 3 characters, yet some entries had fewer than 3 characters */
	//array("NPC","You still haven't woken up yet, ".$name."?"),
	array("NPC","Why are you still here?"), /* self-referential humor */
	array("NPC","What are you still doing here?"), /* self-referential humor */
	array("NPC","We're all going to make FtB the best site ever. We can do it together!"), /* that's what we all thought once upon a time */
	array("NPC","Why isn't XceeD responding to us?! D:<"), /* he never responds ... but when he does, it takes a month or two */
	array("Silva","Eventually, everyone is going to leave FtB. How long do you plan on staying? We'll just have to see."), /* this is pretty much on the mark */
	array("AceOfSpades702","#aceformod2013"), /* being a mod in FtB2 was a big deal */
	//array("NPC","No one told you what's happening? You're in a coma right now. You've been out for a while now ..."),
	/* self-referential humor */
	array("NPC","Is ".$name." seriously trying to converse with us? We can't hear them ... surely they've figured at least that much out by now ..."),
	array("NPC","Is ".$name." ignoring us?"),
	array("NPC","Are you going to leave too, ".$name."?"),
	array("NPC",$name."? Who's ".$name."?"),
	array("NPC","What kind of name is ".$name."?"),
	array("ZombiiPanda","Can someone change my name to Panda? When I joined this site, I thought that name would have been taken already."), /* name change requests come in from time to time */
	array("LunaStik","Everyone, please begin transitioning to the AIR charter."), /* pre-FtB4 offered the Flash charter as an option */
	array("ImHellaBored","We'll discuss that with XceeD. He's in the middle of coding the forums though, so expect there to be bugs and issues."), /* literal */
	array("Lucien Greathouse","I'm working on Project Electricity right now. It's an offline game client. Look forward to it."), /* most promises on FtB are empty */
	array("ripazhakgggdkp","Remember to set up your BPMs before you start placing notes. It'll save you a lot of time."), /* almost-literal */
	array("aawidget","¡Que chévere! Me encantan FtB."), /* spanish users */
	array("gabrielrabaioli","I really want to try out charting, but I don't have enough experience."), /* he started a decent chart before he left FtB */
	array("Finchy","#FinchyforSpoopy2013"), /* literal */
	array("Seiryu","Try from scratch, find out the bpm with a bpm analyzer, then try to figure out the snap by experimenting. Test your chart very regularly."), /* literal */
	array("hounddog397","Doing hound stuff"), /* hound had a custom "what users are doing now" in the FtB2 chat */
	array("c4ss0k4","I ~must~ pass Circus Galop!"), /* and he did; he was the first one to do it, too */
	array("darkmark","Hmm ... needs more xenoblade chronicles music."), /* he refuses to chart, himself, but wants these songs charted */
	array("Blinded","I think I missed the memo to change my profile pic to a little girl."), /* literal */
	array("Jfinchy","Someone should delete FTB."), /* literal */
	array("Lockiex3","Both 3y3s got featured :D"), /* literal */
	array("Jxyden","Died because of lag so I'll try to pass it Friday when I'm on a better computer."), /* literal */
	array("ChronoX77","Wizard, don't forget to send your scores to Julz before Saturday."), /* literal */
	array("NPC","Want a long read? Try this http://feelthebeats.se/FtBLegendaryChatLog.txt"), /* the source of the literal text */
	array("(banned)","My goal is to keep FtB drug-free and anti-communist!"), /* literal */
	array("NPC","*pst* Hey. Did you hear? The FtB museum team has restored FtB2! All you have to do is type \"LEGACY\" into the secret box and hit enter. You won't be able to use it after you wake up though ..."), /* this used to be true */
	array("NPC","How do I favorite a chart?"), /* silly users asking silly questions */
	array("NPC","What happened to badges?"), /* FtB4 eliminated badges */
	array("NPC","How does Lenfried have 107% FtB completion?"), /* FtB3 had a peculiar FtB completion algorithm that allowed old users to obtain more than 100% completion */
	array("NPC","When is FtB3 coming out?"), /* an inside joke among FtB2 regulars, reference to XceeD's multi-year long promise to deliver FtB3 */
	array("NPC","YES! My new keyboard came in the mail today."), /* Jxyden actually said this, roughly */
	array("NPC","I think I need a new computer -_- mine lags too much"), /* lag is a common complaint */
	array("NPC","Is FtB laggy for anyone else?"), /* lag is a common complaint */
	array("NPC","Hey ... I found an exploit on FtB ... who can I tell?"), /* keep it to yourself, SilvaHD found an exploit and asked a similar question */
	//array("NPC","OMG look http://www.thorgaming.com/feelthebeats/words/?r=forums&a=topic&fid=11&tid=17011"),
	array("NPC","Can I be banned for posting something obscene in the FtB Underworld?"), /* not back in the days when ----- was in charge */
	array("NPC","Why are the forums called \"Words\"? Like, seriously, who came up with that?"), /* nejuer and ----- came up with it, thank you very much; reference to how the main interface was originally designed to include as few words as possible */
	array("NPC","Let's overthrow XceeD!"), /* we did; it wasn't as amazing as we thought it would be */
	array("NPC","No one will ever discover my secret alts."), /* *cough* we used to log IPs actually UPDATE: and now we do again lol */
	array("NPC","What is MISAKA?"), /* MISAKA ##### guest accounts in FtB火 */
	array("NPC","What is love?"), /* baby don't hurt me */
	array("NPC","What is a man? A miserable little pile of secrets."), /* but enough talk! have at you! */
	array("NPC","Why are we even bothering with the best of 2012 if the world is going to end?"), /* December 21, 2012 hype */
	array("NPC","What happened to all the charts?! None of them them have images!"), /* FtB apocalypse */
	array("NPC","People of FtB! Stay calm! FtB was recently hacked and we lost all of our media files. Charters: please reupload your charts as soon as you can. Everyone else, why not try recharting lost charts?"), /* ----- actually said this before becoming a mod for this very reason */
	array("NPC","Nothing is working! Someone help! Who runs this site anyways?!"), /* we like pointing to XceeD for any blame */
	array("NPC","What is \"thorgaming\"?"), /* good question, go ask Tom */
	array("NPC","Who is Tom?"), /* oh, well uhh ... */
	array("NPC","Who is XceeD?"), /* he started FtB. he died. just kidding ... probably UPDATE: confirmed living */
	array("NPC","It's snowing!"), /* FtB火 random weather */
	array("NPC","It's raining!"), /* FtB火 random weather */
	array("NPC","Let's make a guild guys!"), /* FtB3 guilds for multiplayer */
	array("NPC","How do I make a guild?"), /* FtB3 guilds for mulitplayer */
	array("NPC","How many members do I need to make a guild? I know you need five members to make a club ... and do we need a club advisor?"), /* reference to a club-making requirement in most anime series */
	array("NPC","I'm done charting for a while."), /* everyone needs a break sometimes */
	array("NPC","How do I join the FtB skype chat?"), /* ask zach72, the starter of said group */
	array("NPC","Does anyone remember the old FtB chat? I'm so glad we have this one now."), /* the FtB2 chat was really scary, especially the lag and freeze rate */
	array("NPC","Wow, my message just posted a bunch of times."), /* FtB3 bug before a major patch was added to the chat system */
	array("NPC","I'd like to give thanks to all the recharters out there! You guys are the best!"), /* they were. reference to FtB apocalypse */
	array("NPC","Hey look everyone! It's XceeD! Hi XceeD!"), /* XceeD used to come online for about 5 seconds at a time. he rarely responded in the chat */
	array("NPC","Wow, I suck at this game"),
	array("NPC","This game is so hard!"), /* FtB is home to few easy charts */
	array("NPC","Everybody's Russian!"), /* reference to Brock's dub of Friday */
	array("NPC","Everybody's looking forward to the weekend."), /* reference to Brock's dub of Friday */
	array("NPC","For your first chart, you should probably use a MIDI. If you do, you won't have to worry about BPM changes."), /* seriously helpful advice for new charters */
	array("NPC","What the hell is a funyarinpa?"), /* "Say you're sorry!", actually a picture of a dog */
	array("NPC","What's a \"flair\"?"), /* an oddly named game mechanic */
	array("wizardoffail","...speed latency."), /* nejuer made light of the nonesensicality of this term */
	array("NPC","Does anyone here play bandmaster?"), /* Lenfried actually said this */
	array("NPC","Why don't the chat commands work for me?"), /* FtB3 chat commands required a certain amount of plays before becoming available */
	array("NPC","Who's in charge around here?"), /* XceeD */
	array("NPC","What happened to all the mods?"), /* mods were removed in FtB3 */
	array("NPC","Whoa. What happened to this site?"), /* many of our users leave and then return to see a new FtB version rolled out */
	array("NPC","Give us the old FtB back!"), /* bookkid900 actually said this UPDATE: *says */
	array("NPC","I love that you guys added the LEGACY feature <3"), /* people like nostalgia waves */
	array("ellondu","Someone help me debug my Java homework!"), /* almost literal */
	array("NPC","The source for this site is a mess"), /* FtB2 used to be table-ception, right, nejuer? */
	array("NPC","Why isn't the CSS for this site in a separate file?"), /* ripaz actually said this */
	array("NPC","XceeD isn't writing me back!"), /* don't worry, he never writes anyone back */
	array("NPC","This site is illegal ... it's only a matter of time ..."), /* true */
	array("NPC","What does ¬ mean?"), /* FtB3 had a secret "renaming" feature for the chat. this logical "not" sign was prepended to user names to indicate a nickname */
	array("NPC","Why can't I level up past Lv.90?"), /* FtB3 had a level cap at Lv.90 that was only removed if the user achieved 100% or higher [yes, "or higher"] FtB completion at some point in time */
	array("NPC","Check your private messages."), /* a PM system has been around since FtB2, but was integrated into the chat system in FtB火 */
	array("NPC","I just sent you a private message."), /* a common public message ... directing attention to a private message ... kinda silly, huh? */
	array("NPC","Does anyone here write music?"), /* a somewhat common question */
	array("NPC","Is anyone here a charter?"), /* a somewhat common question */
	array("NPC","Does anyone here play piano?"), /* a somewhat common question */
	array("NPC","How did you guys find this site?"), /* reference to an old forums thread */
	array("NPC","I found this site from Kongregate."), /* how many users, especially the older ones, found FtB */
	array("NPC","All hail Finchy!"),
	//array("NPC",""),
	
	// v FtB5 v
	array("Joey","Remember my super cool RATTATA? My RATTATA is different from regular RATTATA. It’s like my RATTATA is in the top percentage of all RATTATA."), // Twitch Plays Pokémon
	/* FtB3 chat commands */
	array("NPC","#throwcookieat:".$name),
	array("NPC","#bakecookies"),
	array("NPC","#buymilk"),
	
	array("NPC","Ahh! D:")
);
?>