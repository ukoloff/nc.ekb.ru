<?
LoadLib('jpg10k');

updatePhoto();
header('Location: ./'.hRef());

function updatePhoto()
{
 global $CFG;
 if(!strlen($j=loadJpeg())) return;
 $X=Array();
 if('#'!=$j) $X[]=$j;
 ldap_modify($CFG->AD->h, $CFG->udn, Array(thumbnailPhoto=>$X, jpegPhoto=>$X));
// echo 'LDAP: ', ldap_error($CFG->AD->h);
}

function loadJpeg()
{
 global $CFG;
 switch($meth=trim($_POST['z']))
 {
  default: return;
  case '-'; return '#';
  case '/':
    $f=$_FILES['jpg'];
    if($f['error'] or !preg_match('/\.jp(e?)g$/', $f['name'])) return;
    $jpg = file_get_contents($f['tmp_name']);
#echo strlen($jpg);
    if ($_POST['j10k'])
      $jpg = jpgShrink10k($jpg);
#echo ">", strlen($jpg); exit;
    return $jpg;
  case 'v2011':
  case 'sigur':
    LoadLib("../db/{$meth}.photo");
    $e=getEntry($CFG->udn, 'employeeID');
    return getJpgByNo($e[$e[0]][0]);
 }
}
?>
