<?
LoadLib('summary');

unset($Min); unset($Max);

$q=mysql_query("Select * From Mails Where u={$CFG->uSQL} Order by Month");
while($r=mysql_fetch_object($q)):
 $X[$Max=$r->Month]=$r;
 if(!$Min) $Min=$Max;
endwhile;

unset($Demo);
$i=new monthIterator($Min, $Max); 
while($i->Advance())
 if($m=$i->m()):
  if(!isset($Demo) or $m==$CFG->params->m) $Demo=$n;
  PrintCell($n=$X[$m]);
 else:
  echo "<BR />";
 endif;

if(!isset($Demo)) 
 $Demo=Array(
    'extB'=>1024+rand(10*1024*1024), 
    'extN'=>1+rand(100), 
    'intB'=>1024+rand(10*1024*1024), 
    'intN'=>1+rand(100));

function PrintCell($n)
{
  printf("<Table Class='MailMonth' CellSpacing='0'><TR><TD Class='Upper'><U>%.1f</U><BR />%d</TD></TR>
<TR><TD><U>%.1f</U><BR />%d</TD></TR></Table>
", $n->extB/(1024*1024), $n->extN, $n->intB/(1024*1024), $n->intN);
}

?>
<HR />
<Table><TR><TD>
<Table Border CellSpacing='0' Class='Summary'><TR><TD Class='Select'>
<? PrintCell($Demo) ?>
</TD></TR></Table>
</TD><TD>
<Table Class='MailMonth'>
<TR><TD Class='Upper' Align='Center'>Почта<BR />извне
</TD></TR><TR><TD NoWrap Align='Center'>Почта<BR />из сети
</TD></TR></Table>
</TD><TD Width='100%'><Small>
В каждой ячейке указаны: 
<LI>В <U>числителе</U> - количество мегабайт входящего почтового трафика
<LI>В знаменателе - количество полученных писем
<HR />
<LI>Верхняя пара - почта, полученная из внешнего мира
<LI>Нижняя пара - почта, полученная из локальной сети
</Small>
</TD></TR></Table>
