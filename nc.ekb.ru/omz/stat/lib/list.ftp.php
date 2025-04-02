<?
$DB=Array(Array(file=>'data', Name=>'ОМЗ', link=>'omz/'), Array(file=>'galfind', Name=>'Галфинд', link=>'omz/galfind/'));

//ini_set('display_errors', true);
//ini_set('log_errors', false);
LoadLib('summary');

if(!function_exists('sqlite3_open')) dl('sqlite3.so');
$h=sqlite3_open(':memory:');

$N=0;
foreach($DB as $k=>$v):
 $N++;
 sqlite3_exec($h, 'Attach Database '.sqlite3_escape('/var/lib/omz/'.$v['file'].'.db').' As DB'.$N);
 $DB[$k]['N']=$N;
endforeach;
?>
<Table Border CellSpacing='0'>
<TR Class='tHeader'><TH>Партнёр</TH><TH ColSpan='2'>Отправлено</TH><TH ColSpan='2'>Получено</TH></TR>
<?
function printEmpty()
{
 echo "<TD Align='Center' ColSpan='2'>-</TD>";
}

function printPair($r)
{
 echo "<TD>", $r['N'], "<BR /></TD><TD>", b2k($r['B']), "<BR /></TD>";
}

foreach($DB as $v):
 $q=sqlite3_query($h,
    "Select Side, Count(*) As N, 1.0*Sum(Size) As B From DB".$v['N'].".Log Where /* Op='+' And */ Time Like '".chunk_split($CFG->params->m, 4, '-').
    "%' Group By Side Order By Side");
 $r=sqlite3_fetch_array($q);
 if(!$r) continue;
 echo "<TR Align='Right'><TH>", htmlspecialchars($v['Name']), "<Sup><A Target='_blank' hRef='http://net.ekb.ru/help/", $v['link'], 
    "'>*</A></Sup></TH>";
 if($r['Side']):
   printEmpty();
 else:
   printPair($r);
   $r=sqlite3_fetch_array($q);
 endif;
 if($r)
   printPair($r);
 else
   printEmpty();
 echo "</TR>";
 sqlite3_query_close($q);
endforeach;
?>
</Table>
<H3>Все данные</H3>
<?
$S='';
foreach($DB as $v):
 if($S)$S.=' Union ';
 $S.='Select Time From DB'.$v['N'].'.Log';
endforeach;

$q=sqlite3_query($h, "Select Replace(SubStr(Min(Time), 1, 7), '-', ''), Replace(SubStr(Max(Time), 1, 7), '-', '') From($S)");
$r=sqlite3_fetch($q);
sqlite3_query_close($q);

$i=new monthIterator($r[0], $r[1]);
while($i->Advance()):
 $N=0;
 if($i->m())
  foreach($DB as $v):
   $q=sqlite3_query($h, "Select 1 Where Exists(Select * From DB".$v['N'].".Log Where Time Like '".chunk_split($i->m(), 4, '-')."%')");
   $r=sqlite3_fetch($q);
   sqlite3_query_close($q);
   if($r) $N++;
  endforeach;
 if($N)
  echo '<Center><A hRef="', hRef('m', $i->m()), '">', $N, '</A></Center>';
 else
  echo "<BR />";
endwhile;

function sqlite3_escape($S)
{
 if(isset($S)) return "'".strtr($S, array("'"=>"''"))."'";
 return 'NULL';
}

?>
