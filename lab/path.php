<?
require_once("/home/ftbsliceofcake2/gate/gate_575.php");

require_once("../shelfRemote/butler.php");

echo isPathAboveBasePath(".","..")?1:0;
echo isPathAboveBasePath("..",".")?1:0;
echo "<br><br>";
echo isPathAboveBasePath("/home/ftbsliceofcake2/feelthebeats.se/575_unstable/simple/","/home/ftbsliceofcake2/feelthebeats.se/575_unstable/")?1:0;
echo isPathAboveBasePath("/home/ftbsliceofcake2/feelthebeats.se/575_unstable/simple","/home/ftbsliceofcake2/feelthebeats.se")?1:0;
echo isPathAboveBasePath("/home/ftbsliceofcake2/db/chart","/home/ftbsliceofcake2/feelthebeats.se")?1:0;

?>