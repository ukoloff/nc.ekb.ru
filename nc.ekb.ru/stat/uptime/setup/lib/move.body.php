<?
LoadLib('/forms');
?>
����� ������ ��� ����� ������� - <B><?=$CFG->params->n?></B>. 
������� ��� ������� �������, ���� ������ ��������� ��� � ���������� �����.
<P>
������� ����� �������, �������� �������� �� ������ ������� ���� ������:<BR />
<Center>
<Form Action='./' Method='POST'>
<Table><TR><TD>
<?
Input('p', '��� ��������');
HiddenInputs();
?>
</TD></TR><TR><TD>
<Input Type='Submit' Value=' ���������! ' />
</TR></Table>
</Form>
</Center>
