<?
LoadLib('/pages');

$SQL=" From remind Where u='".AddSlashes($CFG->u)."'\nAnd xtime<Now() And Seen is Null And Disable=0 ";
$N=$Hot=sqlGet("Select Count(*)$SQL");
if(!$Hot):
  $SQL=preg_replace('/\n(.*)/', '', $SQL);
  $N=sqlGet("Select Count(*)$SQL");
endif;

$p0=pageStart($N);

pageNavigator();
?>
<Table Border Width='100%' CellSpacing='0'>
<TR Class='tHeader'>
<TH>����</TH>
<TH>�����</TH>
<TH Title='���������'>#</TH>
<TH Title='��������� ����������� �� �����'>@</TH>
<TH Width='100%'>����������</TH>
</TR>
<?
$q=mysql_query("Select *, Date_Format(xtime, '%d.%m.%Y') As date, Date_Format(xtime, '%H:%i') As time, Now()>xtime As Gone".$SQL.
      "Order By xtime Desc Limit $p0, {$CFG->params->pagesize}");
while($r=mysql_fetch_object($q)):
  $Class=$r->Gone&&!$Hot?' Style="text-decoration: line-through;"':'';
  echo "<TR$Class><TD>", $r->date,
    '</TD><TD><A hRef="', htmlspecialchars(hRef('i', $r->id)), '">', $r->time, '</A>',
    "</TD><TD Align='Center'>", $r->Disable?'#':'<BR />',
    "</TD><TD Align='Center'>", $r->mail?'@':'<BR />',
    "</TD><TD><Small>", nl2br(htmlspecialchars($r->Info)), "</Small>";
  if($r->URL):
   echo ' <A hRef="', htmlspecialchars($Hot? './'.hRef('i', $r->id, 'go', ' '):$r->URL), '" Target="Remind">&raquo;</A>';
  endif;
  echo  "</TD></TR>\n";
endwhile;
?>
</Table>
<?
pageNavigator(); 

if($Hot>1):
?>
<P>
<Table Width='100%'><TR><TD>
<Form Action='./' Method='POST' Style='margin: 0;'>
<?
$CFG->params->mark=1;
hiddenInputs();
?>
<Input Type='Submit' Value='�������� ��� ��� ���������' />
</Form>
</TD><TD Width='100%'>
<Small>
� ��� <?=$Hot?> <?=pluralForm($Hot, '��������������� ���������', '��������������� ��������', '��������������� ���������')?>.
������� ������, ����� �������� �� ����� ��� ��� ���������.
</Small>
</TD></TR></Table>
<?
endif;

function pluralForm($n, $form1, $form2, $form5)
{
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}
?>