<? // Показать фотку в браузере
dbConnect();

apache_setenv('no-gzip', '1');	# Disable gzip output
Header('Content-Type: image/jpg');

$s = $CFG->sigur->prepare(<<<SQL
Select
  HIRES_RASTER
From
  photo
Where
  ID=?
SQL
);
$s->execute(Array(trim($_REQUEST['i'])));
$row = $s->fetch();
if(!$row or !strlen($row[0])):
  Header('HTTP/1.0 404');
  exit;
endif;

if(!isset($_GET['w'])):
 echo $row[0];
 exit;
endif;

$w=(int)$_GET['w'];
if($w<=0)$w=222;

$tmp=tempnam('/var/tmp', 'voxr');
$f=fopen($tmp, 'w'); fwrite($f, $row[0]); fclose($f);
$z=imagecreatefromjpeg($tmp);
unlink($tmp);

$Sz[0]=imagesx($z);
$Sz[1]=imagesy($z);
$n=0; if($Sz[1]>$Sz[0])$n=1;
$Dz[$n]=$w;
$Dz[1-$n]=round($w*$Sz[1-$n]/$Sz[$n]);
$zz=imagecreatetruecolor($Dz[0], $Dz[1]);
imagecopyresampled($zz, $z, 0, 0, 0, 0, $Dz[0], $Dz[1], $Sz[0], $Sz[1]);
imagejpeg($zz);
?>
