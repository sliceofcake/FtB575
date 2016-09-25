# FtB575  
Version 575 of Online Rhythm Game, Feel the Beats  

Some Reminders Copy-Pasted From [The FtB5 /boards/ Dev News Subboard](https://feelthebeats.se/boards/?nyan=13):  

**Use the newest version of the Google Chrome web browser.**  
If you don't have Chrome, this link will probably take you to the official download page [https://www.google.com/chrome/browser/desktop/](https://www.google.com/chrome/browser/desktop/). "Why only Chrome?" : [https://feelthebeats.se/boards/?nyan=13&cat=432](https://feelthebeats.se/boards/?nyan=13&cat=432). The newest versions of Firefox and Safari are now somewhat compatible with FtB575.  

**Use a bogus password, if the build has server connectivity.**  
Do not submit private/confidential information to FtB575. The system is not currently secure.  

**Use CBR [Constant Bit Rate] audio files. Don't use VBR [Variable Bit Rate] audio files.**  
The gameframe will do a terrible job when it tries to seek to a specific point in a VBR song.  

**If your audio is frequently skipping by small amounts, increase the leeway.**  
With the panel called something like "audio leeway", you can control how tightly FtB575 will enforce audio synchronization. Unfortunately, the HTML5 audio wrapper does a very poor job at accurately reporting its current position, so as you lower the audio leeway, there's a higher chance that FtB575 will see false positives telling it the audio is out of sync. If you want to make sure your audio is synced with your chart, pause and play; pause is the most reliable way to currently set a specific position in the audio and the chart.  

**Remember that the gameframe will play osu files.**  
(1) Visit [https://osu.ppy.sh/p/beatmaplist?m=3&r=0](https://osu.ppy.sh/p/beatmaplist?m=3&r=0) to find an osu!mania beatmap.  
(2) Download the beatmap, change/rename its file extension to ".zip", open it.  
(3) Find the audio file (probably ends with ".mp3"), find the map/chart file (ends with ".osu").  
(4) Use these files to load the gameframe as usual [we currently support the o!m14 spec.]  

**Usage instructions:**  
(1) Drag&drop your audio file to the panel that says something like "audio file" on the handle [aim for the dashed-line box that says "file" in the south-east corner].  
(2) Drag&drop your chart file to the panel that says something like "chart file" on the handle [aim for the dashed-line box that says "file" in the south-east corner].  
(3) Once you've dragged&dropped your chart file, the chart will automatically start. If you aren't ready, you can pause and/or reset the chart [see the grid of key bindings, pause is probably labeled "k lo" and reset is probably labeled "k reset"]. If you start typing and your key-inputs are going to the wrong place [like your browser's url bar], click anywhere within the FtB575 page to refocus.  

**Link[s]/URL[s] to this build:**  
[https://feelthebeats.se/575_2016_09_24/edit/](https://feelthebeats.se/575_2016_09_24/edit/)  

**Where can I find charts?**  
[http://osusearch.com/search/?statuses=Ranked&modes=Mania](http://osusearch.com/search/?statuses=Ranked&modes=Mania)  
[https://osu.ppy.sh/p/beatmaplist?m=3&r=0](https://osu.ppy.sh/p/beatmaplist?m=3&r=0)  
[https://feelthebeats.se/gomi/ballroomoflostmemories.php](https://feelthebeats.se/gomi/ballroomoflostmemories.php)  

**Remember that you can save FtB575 /edit/ and play offline, without internet connection.**  
If you have FtB575 /edit/ loaded and you save it through your web browser [probably "File>Save Page As..."], you should be able to load it whenever you want and play it mostly without issues. /edit/ should be able to operate without server connectivity.  
