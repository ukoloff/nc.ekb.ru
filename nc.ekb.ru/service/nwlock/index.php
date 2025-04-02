<?
require("../../lib/uxm.php");

setlocale(LC_ALL, "ru_RU.cp1251");

$Prefix='D:\\Netware\\';

uxmHeader('Захваченные файлы');
?>
<Script Src='nwlock.js'></Script>
<H1>Захваченные файлы</H1>
<Center Class='Error'>
В связи с миграцией в ОМЗ эта страничка переехала <A hRef='/omz/service/nwlock/'>вот сюда</A>
</Center>
<?
$Tree=Array();
$N=0;
$S=exec("/usr/bin/net rpc file -S dbServ -U OMZGLOBAL\\\\".$_SERVER['PHP_AUTH_USER']."%".$_SERVER['PHP_AUTH_PW'], $A);

foreach($A as $S):
 $X=preg_split('/\s+/', $S, 5);
 if(substr($X[4], 0, strlen($Prefix))!=$Prefix or !preg_match('/^\d+$/', $X[0])) continue;
 $X[4]=utf2str(substr($X[4], strlen($Prefix)));

// echo htmlspecialchars(join('=', $X)), "\n";

 $z=&$Tree;
 foreach(explode('\\', $X[4]) as $n):
  $l=strtolower($n);
  if(!isset($z[$l]))
    $z[$l]=Array('Name'=>$n);
  $z=&$z[$l];
 endforeach;
 $z['Lock'][strtolower($X[1])]=$X[0];
 $N++;
endforeach;

PrintList(&$Tree);

function PrintList(&$List)
{
 global $CFG;
 if($List['Lock']):
  foreach($List['Lock'] as $u=>$n):
   echo "&raquo;\n<A Target='_blank' hRef='/abook/person/", htmlspecialchars(hRef('u', $u)),"'>", htmlspecialchars($u),
    "</A>, <A Class='Break' Target='_blank' hRef='break/", htmlspecialchars(hRef('id', $n)), "'>отключить!</A><BR />";
  endforeach;
 endif;
 foreach($List as $k=>$z):
  if(strtolower($k)!=$k) continue;
  $CFG->N++;
  echo "<Span Class='Q' id='p{$CFG->N}' onClick='Toggle({$CFG->N})'>+</Span> ", htmlspecialchars($z['Name']), "<BR /><Div id='x{$CFG->N}' Class='Indent'>";
  PrintList(&$z);
  echo "</Div>";
 endforeach;
}
?>
<HR />
&raquo;
Найдено захватов: <?=$N?>
</body></html>
