<?
apache_setenv('no-gzip', '1');	# Disable gzip output

global $CFG;
require('../../../lib/uxm.php');

LoadLib('../v2010.connect');

$q=odbtp_query('Select Picture From pList Where ID='.($ii=0+$_GET['i']));
$r=odbtp_fetch_array($q);
if(!$r):
  Header('HTTP/1.0 404');
  exit;
endif;

Header('Content-Type: image/jpg');
Header("Content-disposition: attachment; filename=\"$ii.jpg\"");

if(!isset($_GET['w'])):
 echo $r[0];
 exit;
endif;

$w=0+$_GET['w'];
if($w<=0)$w=150;

$tmp=tempnam('/var/tmp', 'voxr');
$f=fopen($tmp, 'w'); fwrite($f, $r[0]); fclose($f);
$z=imagecreatefromjpeg($tmp);
unlink($tmp);

$Sz[0]=imagesx($z);
$Sz[1]=imagesy($z);
$n=0; if($Sz[1]>$Sz[0])$n=1;
$Dz[$n]=$w;
$Dz[1-$n]=round($w*$Sz[1-n]/$Sz[$n]);
$zz=imagecreatetruecolor($Dz[0], $Dz[1]);
imagecopyresampled($zz, $z, 0, 0, 0, 0, $Dz[0], $Dz[1], $Sz[0], $Sz[1]);
echo imagejpeg($zz);

exit;
?>
