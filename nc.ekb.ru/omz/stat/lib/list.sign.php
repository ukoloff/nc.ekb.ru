<?
LoadLib('directum');
LoadLib('/sort');

$CFG->sort=Array(
    u=>Array(field=>'uAuthor', 'name'=>'Кто'),
    b=>Array(field=>'uAs', 'name'=>'За кого'),
    n=>Array(field=>'N', 'name'=>'Кол-во', rev=>1));
$CFG->defaults->sort='ub';

AdjustSort();
sortedHeader('nub');

$d1=chunk_split($CFG->params->m, 4, '-').'01';

$xu=mssql_escape($CFG->params->u);
$q=mssql_query(<<<SQL
Select 
 uAuthor, uAs, Count(*) As N
From SignaturesII
Where (SignDate Between '$d1' And dateAdd(m, 1, '$d1'))
Group By uAuthor, uAs
SQL
.sqlOrderBy()
);

while($r=mssql_fetch_object($q)):
  if($r->uAs==$r->uAuthor) $r->uAs='';
  echo "<TR><TD Align='Right'>", htmlspecialchars($r->N), 
    "<BR /></TD><TD>", htmlspecialchars($r->uAuthor), '<A hRef="', htmlspecialchars(hRef('x', 'sig', 'u', $r->uAuthor, 'list')), '">&raquo;</A>',
    "<BR /></TD><TD>", htmlspecialchars($r->uAs);
  if($r->uAs) echo '<A hRef="', htmlspecialchars(hRef('x', 'sig', 'u', $r->uAs, 'list')), '">&raquo;</A>';
    echo "<BR /></TD></TR>\n";
endwhile;
?>
</Table>

<H2>Все данные</H2>

<?
LoadLib('summary');

$q=mssql_query(<<<SQL
Select Replace(Convert(VarChar(7), Month, 121), '-', '')M, N, UN From
(Select 
 DateAdd(m, DateDiff(m, 0, SignDate), 0) As Month,
 Count(*) As N,
 Count(Distinct uAuthor) As UN
From SignaturesII
Group By DateAdd(m, DateDiff(m, 0, SignDate), 0))Z
Order By 1
SQL
);

unset($X); unset($Min); unset($Max);
while($r=mssql_fetch_object($q)):
 $X[$Max=$r->M]=$r->N.'/'.$r->UN;
 if(!$Min)$Min=$Max;
endwhile;

if($Min):
 $i=new monthIterator($Min, $Max); 
 while($i->Advance())
  if($m=$i->m() and $n=$X[$m])
   echo '<A hRef="./', hRef('m', $m), '">', $n, "</A>";
  else
   echo "<BR />";
endif;

?>
