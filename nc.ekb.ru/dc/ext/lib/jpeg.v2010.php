<?
require_once(dirname(__FILE__).'/v2010.connect.php');

function getJPG($N)
{
 $q=odbtp_query("Select DataLength(Picture) As szPic, Picture From pList Where ID=".(0+$N));
 $r=odbtp_fetch_array($q);
 odbtp_free_query($q);
 if(!$r) return;
 if(!$r[0]) return;
 
 $tmp=tempnam('/var/tmp', 'voxr');
 $f=fopen($tmp, 'w'); fwrite($f, $r[1]); fclose($f);
 $r=0;
 $z=imagecreatefromjpeg($tmp);
 unlink($tmp);
 if(!$z) return;

 $w=180;
 $Sz[0]=imagesx($z);
 $Sz[1]=imagesy($z);
 $n=0; if($Sz[1]>$Sz[0])$n=1;
 $Dz[$n]=$w;
 $Dz[1-$n]=round($w*$Sz[1-n]/$Sz[$n]);
 $zz=imagecreatetruecolor($Dz[0], $Dz[1]);
 imagecopyresampled($zz, $z, 0, 0, 0, 0, $Dz[0], $Dz[1], $Sz[0], $Sz[1]);
 $z=0;
 $tmp=tempnam('/var/tmp', 'voxr');
 if(!imagejpeg($zz, $tmp))return;
 $zz=0;
 $z=file_get_contents($tmp);
 unlink($tmp);
 return $z;
}

?>
