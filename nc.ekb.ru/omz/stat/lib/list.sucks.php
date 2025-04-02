<?
LoadLib('/sort');
$CFG->sort=Array(
    u=>Array(field=>u, 'name'=>'Юзер'),
    n=>Array(field=>'n', 'name'=>'Кол-во', rev=>1),
    b=>Array(field=>'b', 'name'=>'Расход', rev=>1),
    q=>Array(field=>'q', 'name'=>'Квота, Мб', rev=>1));
$CFG->defaults->sort='n';

AdjustSort();
sortedHeader('nuqb');

$q=mysql_query(<<<SQL
Select
 u, Count(*) As n,
 (Select b From uTotals Where u=ipUse.u And `When`='{$CFG->params->m}')As b,
 (Select limitMb From Limits Where u=ipUse.u)As q
From ipUse
Where b>0 And Month LIKE '{$CFG->params->m}'
Group By u
Having Count( * ) >1
SQL
.sqlOrderBy()
);
while($r=mysql_fetch_object($q)):
 echo "<TR><TD>", $r->n,
    '<BR /></TD><TD><A hRef="./?x=where&amp;u=', urlencode($r->u), '" Target="sucks">',
    $r->u, "</A><BR /></TD><TD Align='Right'>",
    $r->q, "<BR /></TD><TD Align='Right'>",
    b2k($r->b), "<BR /></TD></TR>\n";
endwhile;

?>
</Table>
<P Align='Left'>
<Small>
&raquo;
Показан список пользователей, лазивших в Интернет с нескольких машин (в данном месяце)
</P>

<H3>Все данные</H3>

<?
LoadLib('summary');
$X=sqlGet("Select min(`When`) Min, max(`When`) Max From uTotals");
$i=new monthIterator($X->Min, $X->Max); 
while($i->Advance())
 if($m=$i->m())
   echo '<Center><A Class="X" hRef="./', hRef('m', $m), "\">&raquo;</A></Center>";
 else
   echo "<BR />";
?>
