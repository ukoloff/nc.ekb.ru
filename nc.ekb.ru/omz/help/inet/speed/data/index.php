<?
Header('Content-Type: application/octet-stream');

exec(dirname(__FILE__).'/entropy'); 

if(!preg_match('/\d+/', $_POST['n'], $match)) return;
$n=$match[0];
Header("Content-disposition: attachment; filename=$n.bin");

//readfile('/var/tmp/random7'); exit;
$R='/var/tmp/random7';
$l=filesize($R);
$f=fopen($R, 'r');
while($n>0)
{
 $w=$n<$l? $n : rand(0.9*$l, $l);
 fseek($f, mt_rand(0, $l-$w));
 $blob=fread($f, $w);
 echo $blob;
 $n-=strlen($blob);
}
fclose($f);
?>
