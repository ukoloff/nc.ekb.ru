<?
LoadLib('/sort');

$CFG->sort=Array(
    'i'=>Array('field'=>'id', 'name'=>'Id'),
    'b'=>Array('field'=>'block', 'name'=>'!', title=>'������������'),
    'l'=>Array('field'=>'login', 'name'=>'������'),
    'u'=>Array('field'=>'ufn', 'name'=>'AD-����'),
    'c'=>Array('field'=>'cameras', 'name'=>'������'),
    's'=>Array('field'=>'lists', 'name'=>'������'),
    'x'=>Array(field=>'comment', name=>'�����������'),
);
$CFG->defaults->sort='i';
adjustSort();

$q=mssql_query('Select * From login');
unset($Z);
while($r=mssql_fetch_object($q)):
 if($u=user2dn($r->login)):
  $u=new DN($u);
  $u=$u->ufn();
  $r->ufn=$u->str();
 endif;
 $r->block=!inGroupX('Video@uxm', $r->login);
 $Z[]=$r;
 unset($r);
endwhile;

sortArray($Z);
sortedHeader('bilucsx');
unset($CFG->params->sort);
foreach($Z as $x):
 echo '<TR><TD Align="Center">', $x->block? '#':'',
    '<BR /></TD><TD Align="Right" onMouseMove="userThumb(this, ', jsEscape($x->login),
	')"><A hRef="./', htmlspecialchars(hRef('x', 'login', 'i', $x->id)), '">', $x->id, '</A>',
    '<BR /></TD><TD>', htmlspecialchars($x->login),
    '<BR /></TD><TD>', htmlspecialchars($x->ufn),
	$x->ufn? '<A hRef="/omz/abook/?u='.htmlspecialchars(urlencode($x->login)).'" Target="AD">&raquo</A>':'',
    '<BR /></TD><TD>', htmlspecialchars($x->cameras),
    '<BR /></TD><TD>', htmlspecialchars($x->lists),
    '<BR /></TD><TD><i>', htmlspecialchars($x->comment), '</i>',
    '<BR /></TD></TR>';
endforeach;
?>
<TR Class='tHeader'><TD ColSpan='7'>&raquo;
<A hRef='./<?=htmlspecialchars(hRef('x', 'login', 'i', ' '))?>'><i>�������� ������������ ������</i></A></TD></TR>
<? sortedFooter(); ?>
&raquo;
��������� ������������ ���� ����� ������ ����� ���������� ��� �� ��� ������
<BR />
&raquo;
����� ������� � ��������������� ������������ ��������� � <A hRef="/omz/dc/group/?x=list&amp;g=Video%40uxm">������</A>
