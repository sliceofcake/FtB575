<!DOCTYPE html><html><head id="head"><meta charset="UTF-8"><title>FtB575 test</title>
<body>
<?
$x = 1;
for ($i = 0; $i < $x; $i++){
	echo "<div class=\"p\">";}
echo "<div class=\"z\"></div>";
for ($i = 0; $i < $x; $i++){
	echo "</div>";}
?>
<script>
var a,b,c,d,e,f;
a = performance.now();
document.querySelector("<?for ($i = 0; $i < $x; $i++){echo ".p>";};?>.z");
b = performance.now();
document.querySelector(".z");
c = performance.now();

document.write((b-a)/(c-b));
</script>
</body></html>
