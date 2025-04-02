<?	// Генерация пароля словами
global $CFG;
LoadLib('/mysql');

switch($_SESSION['cyr'])
{
 case 'kbd': LoadLib('kbd'); break;
 default: LoadLib('translit');	
}

$CFG->maxN=sqlGet("Select Max(N) From spell");

function getWord($min, $max=1000)
{
 global $CFG;
 $SQL="Select word From spell Where Length(word) Between ".(int)$min." And ".(int)$max;
 switch($_SESSION['lang'])
 {
  case 'en':
  case 'ru': $SQL.=" And lang='".$_SESSION['lang']."'";
 }
 $SQL.=" And N=";
 while(!$W=sqlGet($SQL.rand(1, $CFG->maxN)));
 switch($_SESSION['case'])
 {
  case 'up': $W=strtoupper($W); break;
  case 'word': $W=ucfirst($W); break;
  case 'random':
   for($i=strlen($W)-1; $i>=0; $i--)
    if(rand(0, 100)>80) $W{$i}=strtoupper($W{$i});
 }
 return $W;
}

function newPass()
{
 if(1==$_SESSION['n']):
  $W=getWord(6,10);
  $i=rand(2, strlen($W)-2);
  $W=substr($W, 0, $i).rand(10, 99).substr($W, $i);
 else:
  $W=getWord(3,5).rand(0, 9).getWord(3, 5);
 endif;
 return word2en($W);
}

?>
