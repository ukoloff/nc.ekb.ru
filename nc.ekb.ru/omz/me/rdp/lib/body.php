�� ���� �������� �� ������� ������������� RDP-���� ��� �������� ������� � ������������� ������� �����
<A hRef='/omz/help/TSG/'>���� ����������</A>.
<P>
<Center>
<Table><TR><TD>
<Form Action='./' Method='POST'>
<? LoadLib('/forms'); ?>
<? Input('s', '������������ ������'); ?>
<P />
<? CheckBox('d', '���������� �����'); ?>
<BR />
<? CheckBox('m', '���������� ��������'); ?>
<P />
<Center>
<Input Type='Submit' Value=' ������������� RDP! ' />
</Center>
<? hiddenInputs(); ?>
</Form>
</TD></TR></Table>
</Center>
�� ������ ������� ����� ��� ������� (��� ������, ����� ����� ����� � ������ ����������) ��� ������� ������
�� ����� ����������������:
<? 
LoadLib('/sqlite');
$db=sqlite3_open(dirname(__FILE__)."/../data/data.db");
$q=sqlite3_query($db, "Select Distinct s from Log where u=".sqlite3_escape($CFG->u)." and not ip like '192.168.%' union select 't' Order By 1");
while($r=sqlite3_fetch($q)):
?>
<A hRef='#' onClick='s(this); return false;'><?=htmlspecialchars($r[0])?></A>
<?
endwhile;
?>
<HR />
<Small>
&raquo;
���������� ���� - ���������, ��� ��� ��� ������ ����� ��������������� �� �������
<BR />
&raquo;
�� ����� ������ �������� �� ����������� RDP-����� ������ �������, ������� "Edit/������" � ��������������� ��� � ������� ���������� �� M$
</Small>