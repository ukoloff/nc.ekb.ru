<?
$i=0+$_GET['i'];
$q=sqlite3_query($CFG->db, 'Select * From Mig Where No='.$i);
$r=sqlite3_fetch_array($q);
$CFG->r=$r;
if(!$r):
  echo "Запись #{$i} не найдена!";
else:
  $r['Смена пароля']=sqlGet("Select `When` From uxmJournal.password Where u='".AddSlashes($r['u'])."' Order By 1 Desc");
  foreach($r as $k=>$v):
    echo "<LI><B>$k</B>=", nl2br(htmlspecialchars($v));
    if('u'==$k) echo checkU($v);
    if('Host'==$k) echo "<A hRef='../../dc/ou/", htmlspecialchars(hRef('q', $v, 'in', 'C', 'x', 'search')), "' Target='_blank'>&raquo;</A>";
    if('dsig'==$k and $v) echo " \\\\{$r['Host']}\\", preg_replace('/^([a-z]):/i', '$1$', $r['appData']), "\\Microsoft\\SystemCertificates\\My\\";
    if('Time'==$k) echo " [GMT]";
  endforeach;
endif;
?>
<HR />
<? 
if('2ms'==$_GET['x'])LoadLib('2ms');

if('2ms'!=$_GET['x'] and 'stas'==$CFG->u) echo "&raquo; <A hRef='./", htmlspecialchars(hRef('i', $i, 'x', '2ms')), "'>Скопировать</A> в MS SQL<BR />";
?>
<Center>
&lt;<A hRef='./<?=hRef('i', 1+$_GET['i'])?>'>Вперёд</A>|<A hRef='./'>Список</A>|<A hRef='./<?=hRef('i', -1+$_GET['i'])?>'>Назад</A>&gt;
</Center>



