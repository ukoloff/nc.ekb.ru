<H1>Проверка группы</H1>
<?
global $CFG;
$g=trim($_REQUEST['g']);
if(!$g):
 echo "Имя не введено!";
 return;
endif;
echo "Проверяемое имя группы: <B>", htmlspecialchars($g), "</B><P />";

$CFG->params->g=$g;

if($gdn=group2dn($g)):
 $ufn=new dn($gdn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 echo 'Полное имя: <A hRef="../group/', hRef(), '">', htmlspecialchars($ufn), '</A>';
 echo "<P />Такая группа имеется, введённое имя <B>можно</B> использовать";
 return;
endif;

echo "Группа не найдена";
LoadLib('guess');

if(!guessList($g, 'g'))
  echo '... и не найдено других групп, начинающихся с "', htmlspecialchars($g), '"... :-(';
?>
