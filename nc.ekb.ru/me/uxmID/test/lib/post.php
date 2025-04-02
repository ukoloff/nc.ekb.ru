<?
global $CFG;

function newRand()
{
 $S='';
 while(strlen($S)<3*5)
  $S.=chr(rand(0, 255));
 return strtr(base64_encode($S), '+/', '-.');
}

$_SESSION['nonce']=$n=newRand();

Header('Location: '.$CFG->authURL.'?to=&n='.urlencode($n));
?>
