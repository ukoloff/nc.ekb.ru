<?
# Загрузка результатов авторизации
global $CFG;

$c=curl_init($CFG->authURL);

//curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

foreach(Array(
 CURLOPT_CAINFO=>"/etc/security/certs/ca.crt",
 CURLOPT_USERAGENT=>'uxmID Authorizator',
 CURLOPT_POST=>true,
 CURLOPT_POSTFIELDS=>'i='.urlencode($_GET['i']),
 CURLOPT_FOLLOWLOCATION=>true,
 CURLOPT_RETURNTRANSFER=>true,
 CURLOPT_HEADER=>false,
) as $k=>$v)
  curl_setopt($c, $k, $v);

$Z=xParse(curl_exec($c));
if(isset($Z['g'])) $Z['g']=xParse($Z['g']);
$Z['ok']=$Z['n']==$_SESSION['nonce'];
unset($Z['n']);
$_SESSION['res']=&$Z;

Header('Location: ./');

function xParse($S)
{
 $Res=Array();
 $c='=';
 $prev='';
 while(strlen($S)):
  if(preg_match('/[\\\\'.$c.']/', $S, $match, PREG_OFFSET_CAPTURE)):
   $prev.=substr($S, 0, $match[0][1]);
   $S=substr($S, 1+$match[0][1]);
   if("\\"==$match[0][0]):
    $prev.=$S{0};
    $S=substr($S, 1);
    if(strlen($S)) continue;
   endif;
  else:
   $prev.=$S;
   $S='';
  endif;
  if('='==$c):
   $c="\n";
   $Res[$k=$prev]="";
  else:
   $c="=";
   $Res[$k]=$prev;
  endif;
  $prev='';
 endwhile;
 return $Res;
}

?>
