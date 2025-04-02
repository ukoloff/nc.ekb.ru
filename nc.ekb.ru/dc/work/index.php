<?
require("../../lib/uxm.php");

require('samba.php');

$c=new smbClient('//omega/test$');

$f=$c->tempFile();
$ff=fopen($f, 'w');
fclose($ff);

$X=$c->listFolder('„етыре ѕ-ть');
echo "<PRE>";
print_r($X);

//$c->createDirsFor('1/n2/r3/x04/5');
//$c->putFile(__FILE__, $ff='1/n2/r3 14/x04/5файл.рјсширение', 1);

print_r($c->fileAttrs('1/n2/r3 14/x04/5файл.расЎирени≈'));
?>
Hello!
