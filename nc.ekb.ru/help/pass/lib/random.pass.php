<?	// Генерация случайного пароля
function strSpec()
{
 $S='';
 for($i=126; ($c=chr($i))>' '; $i--)
  if(!ctype_alnum($c))$S.=$c;
 return $S;
}

function strDigits()
{
 $S='';
 for($i=0; $i<10; $i++)
  $S.=chr(ord('0')+$i);
 return $S;
}

function strAlpha()
{
 $S='';
 for($i=ord('a'); $i<=ord('z'); $i++)
  $S.=chr($i);
 return $S;
}

function strChars()
{
 global $CFG;
 $S='';
 switch($_SESSION['chars'])
 {
  case 'w': $S=strAlpha(); break;
  case 'a': $S=strAlpha();
  default:  $S.=strDigits();
 }
 if($_SESSION['spec']):
  $SS=strSpec();
  while(strlen($S)<3*strlen($SS)) $S.=$S;
  $S.=$SS;
 endif;
 $CFG->Chars=$S;
}

strChars();

function newPass()
{
 global $CFG;
 $n=(int)$_SESSION['n'];
 if($n<5) $n=8;
 $S='';
 for($i=$n; $i>0; $i--):
  $c=$CFG->Chars{rand(0, strlen($CFG->Chars)-1)};
  switch($_SESSION['case'])
  {
   case 'mix': if(rand(0, 100)<70) break;
   case 'up'; $c=strtoupper($c);
  }
  $S.=$c;
 endfor;
 return $S;
}


?>
