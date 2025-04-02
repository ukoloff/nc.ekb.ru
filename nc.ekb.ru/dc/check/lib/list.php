<H1>Проверка пользователя/группы</H1>
<?
global $CFG;
$ug=trim($_REQUEST['ug']);
if(!$ug):
 echo "Имя не введено!";
 return;
endif;
echo "Проверяемое имя объекта: <B>", htmlspecialchars($ug), "</B><P />";

$CFG->params->ug=$ug;

if($dn=group2dn($ug)):
 $hRef='group';
 $Name='группы';
elseif($dn=user2dn($ug)):
 $hRef='user';
 $Name='пользователя';
endif;

if($dn):
 $ufn=new dn($dn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 echo "Полное имя $Name: <A hRef=\"../$hRef/", hRef(), '">', htmlspecialchars($ufn), '</A>';
 echo "<P />Такой объект имеется, введённое имя <B>можно</B> использовать";
 return;
endif;

echo "Объект не найден";
LoadLib('guess');

if(!guessList($ug, 'ug'))
  echo '... и не найдено других объектов, начинающихся с "', htmlspecialchars($ug), '"... :-(';
?>
