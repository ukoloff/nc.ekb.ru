<?	// Генерация login-script'а для юзверя

function echoLoginScript($u)
{
 if(!$u) return;
 $udn=user2dn($u);
 if(!$udn) return;

 Header("Content-type: text/plain");

// Сценарии подразделений
 $dn=new dn($udn);
 for($pdn=new dn(''); count($pdn->X)<count($dn->X); array_unshift($pdn->X, $dn->X[count($dn->X)-count($pdn->X)-1]))
  putScript($pdn->str());
 unset($dn); unset($pdn);

// Сценарии групп
 $X=Array();		// Матрица полной соподчинённости групп
 $dns=Array();		// Список всех групп
 $newdns=Array();	// Список необработанных групп
 $dn=$udn;
 unset($child);
 while(true):
  $e=getEntry($dn, 'memberOf');
  $e=$e[$e[0]];
  for($ii=$e['count']-1; $ii>=0; $ii--):
   $gdn=$e[$ii];
   $n=$dns[$gdn];
   if(!$n):
    $dns[$gdn]=$n=1+count($dns);
    $newdns[]=$gdn;
    $X[$n]=Array();
   endif;
   if(!$child or $child==$n or $X[$child][$n])
    continue;
   $X[$child][$n]=1;						// Пополняем таблицу соподчинённости
   foreach($X[$n] as $i=>$Y) $X[$child][$i]=1;			// Предки $n - предки $child
   foreach($X as $i=>$Y) if($X[$i][$child]) $X[$i][$n]=1;	// Потомки $child - потомки $n
   foreach($X as $i=>$Y):					// Нормализация таблицы $X
    unset($X[$i][$i]);						// Группа не подчинена себе
    foreach($X[$i] as $j=>$Z):
     if(!$X[$j][$i]) continue;
     unset($X[$j]);						// Группы $i и $j эквивалентны, вычёркиваем $j
     foreach($X as $k=>$ZZ) unset($X[$k][$j]);
     foreach($dns as $adn=>$m)
      if($m==$j) $dns[$adn]=$i;					// Меняем номер $j--->$i
    endforeach;
   endforeach;
  endfor;

// Занесли все группы, куда входит $dn. Выбираем одну из них и ищем её над-группы
  $dn=array_pop($newdns);
  if(!isset($dn)) break;						// Больше групп не осталось
  $child=$dns[$dn];
 endwhile;
// Теперь в $X - полная матрица соподчинённости групп
// Для начала выбросим из неё косвенные соподчинённости (хотя в данном случае это не обязательно)
 foreach($X as $i=>$Y)
  foreach($X as $j=>$Z)
   if($X[$j][$i])
    foreach($X[$i] as $k=>$ZZ) unset($X[$j][$k]);		// $j<$i<$k, значит $j<$k - непрямая подчинённость
// Теперь собираем DN групп в кластеры эквивалентных групп
 foreach($dns as $dn=>$n) $newdns[$n][]=$dn;
 unset($dns);
 while(count($X)>0):
  foreach($X as $i=>$Y):
   if(count($X[$i])>0) continue;					// У группы $i есть предки, её - позже
   if(is_array($newdns[$i]))foreach($newdns[$i] as $dn)
    putScript($dn);
   unset($newdns[$i]);
   unset($X[$i]);						// Вычёркиваем группу $i
   foreach($X as $j=>$Z) unset($X[$j][$i]);
  endforeach;
 endwhile;

// Личный сценарий пользователя
 putScript($udn);
}

// Login Script объекта AD
function putScript($dn)
{
 $e=getEntry($dn, 'desktopProfile');
 $S=utf2str($e[$e[0]][0]);
 if(!$S) return;
 $ufn=new dn($dn);
 $ufn=$ufn->ufn();
 echo "@REM Script: ", $ufn->str(), "\n$S\n\n";
}

?>
