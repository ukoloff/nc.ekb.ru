<table border cellspacing='0' width='100%'>
<tr class='tHeader'>
<th>№</th>
<th>Таб. №</th>
<th>ФИО</th>
<th>Орг.</th>
<th colspan="2">Отдел</th>
<th>Должность</th>
<th>Ставка</th>
</tr>
<?
$F=Array(
  ''=>'F',
  'i'=>'I',
  'o'=>'O',
  'n'=>'Rab.tabNo',
  '.'=>'Dept.id',
);

$F=$F[$CFG->entry->as];
if ('.' == $CFG->entry->as):
  $Filter = preg_replace('/\W+/', '', $CFG->entry->q);
  if(!$Filter) $Filter = '0';
  $Where = "$F = 0x$Filter";
else:
  $Filter=strtr(strtolower($CFG->entry->q), Array("'"=>"''"));
  $Where = "$F Like '$Filter%'";
endif;

$q = mssql_query($sss =
<<<SQL
With 
  {$CFG->cte->Rab},
  {$CFG->cte->Fiz},
  {$CFG->cte->Hist},
  {$CFG->cte->Evnt},
  {$CFG->cte->Dept},
  {$CFG->cte->Org},
  {$CFG->cte->Tit}
Select
 Rab.id,
 Rab.tabNo, Rab.FIO,
 Wage,
 nickname,
 Dept.Kod As deptNo,
 Dept.name As dname,
 Tit.name As title,
 Evnt.value As event
From
  Rab 
  Join Fiz On fiz_id = Fiz.id
  Join Hist On Hist.rab_id = Rab.id
  Left Join Dept On dept_id = Dept.id
  Join Tit On pos_id = Tit.id
  Left Join Org On Hist.org_id=Org.id
  Join Evnt On event_id=Evnt.id
Where 
  $Where
Order By 3
SQL
, $CFG->sql);
//echo "<!-- $sss -->";
$Line = 0;
while($r = mssql_fetch_assoc($q)):
  $sOn = ''; $sOff = '';
  if ($r['event']==2):
   $sOn = '<s>'; $sOff = '</s>';
  endif;
  echo '<tr><td align="right"><small>', ++$Line, '</small>.',
    "<br /></td><td>", htmlspecialchars(trim($r['tabNo'])),
    '<br /></td><td><a href="./', hRef('h', bin2hex($r['id'])), '">', $sOn, htmlspecialchars($r['FIO']), $sOff, '</a>',
    "<br /></td><td>", htmlspecialchars(trim($r['nickname'])),
    "<br /></td><td>", htmlspecialchars(trim($r['deptNo'])),
    "<br /></td><td>", htmlspecialchars(trim($r['dname'])),
    "<br /></td><td>", htmlspecialchars($r['title']),
    "<br /></td><td>", number_format($r['Wage'], 1),
    "<br /></td></tr>\n";
endwhile;
?>
</Table>
