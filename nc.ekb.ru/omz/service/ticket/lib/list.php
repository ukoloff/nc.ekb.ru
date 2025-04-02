<?
loadLib('/sort');
loadLib('/pages');

$CFG->sort=Array(
    'c'=>Array(field=>'ctime', name=>'Создан', rev=>1),
    'x'=>Array(field=>'xtime', name=>'Истекает', rev=>1),
    'a'=>Array(field=>'creator', name=>'Создатель', title=>'Что за комиссия, создатель?'),
    'u'=>Array(field=>'u', name=>'Виртуал', title=>'Псевдопользователь'),
    'm'=>Array(field=>'Access', name=>'Доступ'),
    'n'=>Array(field=>'N', name=>'Входов'),
    'i'=>Array(field=>'', name=>'Сведения'),
);
$CFG->defaults->sort='c';

$s=$CFG->WiFi->db->query("Select Count(*) as N From ticket Inner Join user Using(id)");
$p=pageStart($s->fetchObject()->N);
pageNavigator();
AdjustSort();
sortedHeader('umnacxi');

$s=$CFG->WiFi->db->prepare(<<<SQL
Select *,
 (`int`<>0)+2*(ext<>0) as Access,
 (Select Count(*) From conn Where u=ticket.id) As N
From ticket Inner Join user Using(id)
SQL
    .sqlOrderBy()."\nLimit $p, {$CFG->params->pagesize}");
$s->execute();

$X=explode('/', 'Закрыт/Локальная сеть/Интернет/Полный');

while($r=$s->fetchObject()):
  echo "<TR>", 
    '<TD><A hRef="./', htmlspecialchars(hRef('i', $r->id)), '">', htmlspecialchars($r->u), "</A><BR /></TD>",
    '<TD Align="Center">', $r->Disable?'<s>':'', $X[$r->Access], $r->Disable?'</s>':'', "<BR /></TD>",
    '<TD Align="Right">', $r->N, '<BR /></TD>',
    '<TD><A hRef="/omz/', (inGroupX('#browseDIT')?'dc/user/':'abook/'), htmlspecialchars(hRef('u', $r->creator)), '">', htmlspecialchars($r->creator), '</A><BR /></TD>',
    '<TD>', $r->ctime, '<BR /></TD>',
    '<TD>', $r->xtime, '<BR /></TD>',
    '<TD><Small>', nl2br(htmlspecialchars($r->Notes)), '</Small><BR /></TD>',
    "</TR>\n";
endwhile;


?>
<TR Class='tHeader'>
<TD ColSpan='7'>
<A hRef="./?i=+">Создать билет</A>
</TD>
</TR>
</Table>
<? pageNavigator(); ?>
