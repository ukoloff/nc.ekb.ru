<?
LoadLib('/sort');
$CFG->sort=Array(
    'i'=>Array(field=>'id', name=>'Id'),
    's'=>Array(field=>'show', name=>'!', title=>'�������� � ����� ������� ��� ���������'),
    'n'=>Array(field=>'name', name=>'���'),
    'c'=>Array(field=>'cameras', name=>'������'),
    'x'=>Array(Xfield=>'comment', name=>'�����������'),
);
$CFG->defaults->sort='i';
adjustSort();

sortedHeader(isncx);
$q=mssql_query('Select * From list '.sqlOrderBy());
unset($CFG->params->sort);
while($r=mssql_fetch_object($q)):
 echo '<TR><TD Align="Right"><A hRef="', htmlspecialchars(hRef('x', 'list', 'i', $r->id)), '">', $r->id, '</A>',
    '<BR /></TD><TD Align="Center">', $r->show? '+':'',
    '<BR /></TD><TD>', htmlspecialchars($r->name),
    '<BR /></TD><TD>', htmlspecialchars($r->cameras),
    '<BR /></TD><TD><i>', htmlspecialchars($r->comment), '</i>',
    "</BR></TD></TR>\n";
endwhile;
?>
<TR Class='tHeader'><TD ColSpan='5'>&raquo;
<A hRef='./<?=htmlspecialchars(hRef('x', 'list', 'i', ' '))?>'><i>������� ������</i></A></TD></TR>
<? sortedFooter(); ?>
