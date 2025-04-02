<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>День</TH>
<TH>Число</TH>
<TH>Время</TH>
<TH>За кого</TH>
<TH>Документ</TH>
<TH>Тип</TH>
<TH>Комментарий</TH>
</TR>
<?
LoadLib('directum');

$d1=chunk_split($CFG->params->m, 4, '-').'01';

$xu=mssql_escape($CFG->params->u);
$q=mssql_query(<<<SQL
Select *,
    CONVERT(varchar(100), SignDate, 121) As t, DatePart(dw, SignDate) as wd, DatePart(d, SignDate) as d
From SignaturesII
Where
    uAuthor=$xu
    And (SignDate Between '$d1' And dateAdd(m, 1, '$d1'))
Order By SignDate
SQL
);
/*
$q=mssql_query("Select CONVERT(varchar(100), SignDate, 121) As t, DatePart(dw, SignDate) as wd, DatePart(d, SignDate) as d, ".
    "uAs, SignatureType, Comment, * ".
    "From SignaturesII Where uAuthor=".mssql_escape($CFG->params->u).
    " And (SignDate Between '$d1' And dateAdd(m, 1, '$d1')) Order By SignDate");
*/

$wd=explode(' ', 'вс пн вт ср чт пт сб');

while($r=mssql_fetch_array($q)):
//echo "<!--"; print_r($r); echo "-->";
  $t=explode(' ', $r['t']);
  $t=$t[1];
  echo "<TR><TD>", $wd[$r['wd']-1],
    "<BR /></TD><TD Align='Right'>", $r['d'],
    "<BR /></TD><TD>", $t,
    "<BR /></TD><TD>", htmlspecialchars($r['uAs']);
  if($CFG->Who and $r['uAs']<>$CFG->params->u)
    echo "<A hRef='", htmlspecialchars(hRef('u', $r['uAs'])), "' Title='Просмотреть его ЭЦП' Target='_blank'>&raquo;</A>";
  echo
    '<BR /></TD><TD Title="', htmlspecialchars($r[Title]), '">', $r['EDocID'];
  if($CFG->intraNet) echo "<A hRef='http://directum/doc.asp?id=", $r['EDocID'],
    "' Title='Открыть документ в СЭД Directum' Target='Directum'>&raquo;</A>";
  echo
    "<BR /></TD><TD Align='Center'>", $r['SignatureType'],
    "<BR /></TD><TD><Small>", htmlspecialchars($r['Comment']), "</Small>",
    "<BR /></TD></TR>\n";
endwhile;

echo "</Table>";

$q=mssql_query("Select m, Count(*) As N From ".
    "(Select Convert(VarChar(6), SignDate, 112) As m From SignaturesII Where uAuthor=".mssql_escape($CFG->params->u).
    ") As X Group By m Order By m");
unset($X); unset($Min); unset($Max);
while($r=mssql_fetch_array($q)):
 $X[$Max=$r['m']]=$r['N'];
 if(!$Min)$Min=$Max;
endwhile;
if($Min):
 echo "<H2>Все данные</H2>";
 LoadLib('summary');
 $i=new monthIterator($Min, $Max); 
 while($i->Advance())
  if($m=$i->m() and $n=$X[$m])
   echo '<A hRef="./', hRef('m', $m), '">', $n, "</A>";
  else
   echo "<BR />";
endif;

?>
