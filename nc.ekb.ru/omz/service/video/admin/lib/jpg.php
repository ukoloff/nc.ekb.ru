<?
if(!$CFG->Dispatcher):
 header('HTTP/1.0 403 Forbidden');
 exit;
endif;
$c=getCamera();
if(!$c):
 header('HTTP/1.0 404 Not found');
 exit;
endif;

function getCamera()
{
 $n=(int)trim($_REQUEST['n']);
 if($n<=0) return;
 return mssql_fetch_object(mssql_query("Select *, (Select path From vendors Where id=vendor) As path From cam Where id=$n And skip=0"));
}

set_time_limit(3);
$URL="http://{$c->user}:{$c->pass}@{$c->Host}/{$c->path}";

apache_setenv('no-gzip', '1');	# Disable gzip output
Header('Content-Type: image/jpeg');
Header('Expires: 0');
Header('Pragma: no-cache');

$w=(int)$_GET['w'];
$h=(int)$_GET['h'];
$q=(int)$_GET['q'];
if($w<0)$w=0;
if($h<0)$h=0;
if($q<=0)$q=null;

if($w || $h || $q):
 $i=imagecreatefromjpeg($URL);
 if($i and $ow=imagesx($i) and $oh=imagesy($i)):
  if($w>$ow)$w=$ow;
  if($h>$oh)$h=$oh;
  if($w and !$h) $h=round($w*$oh/$ow);
  if(!$w and $h) $w=round($h*$ow/$oh);
  if(!$w) $w=$ow;
  if(!$h) $h=$oh;
  if($w!=$ow or $h!=$oh):
   Header("X-Orig-WxH: {$ow}x{$oh}");
   $i2=imagecreatetruecolor($w, $h);
   imagecopyresampled($i2, $i, 0, 0, 0, 0, $w, $h, $ow, $oh);
   imagedestroy($i);
   $i=$i2;
  endif;
  Header("X-WxH: {$w}x{$h}");
  if($q)imagejpeg($i, null, $q);
  else imagejpeg($i);
 endif;
else:
 $n=@readfile($URL);
endif;

?>
