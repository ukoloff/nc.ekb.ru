<Form Action='./' Method='POST'>
<Table><TR><TD RowSpan='2' NoWrap>
<FieldSet>
<Legend><Small>�����</Small>
</Legend>
<?
LoadLib('/forms');
hiddenInputs();
CheckBox('Disable', '������ ������');	BR();
CheckBox('int', '� ��������� ����');	BR();
CheckBox('ext', '� ��������');		BR();
?>
</FieldSet></TD><TD vAlign='Top'>
<?
Input('maxConn', '������������ �������');
?>
</TD></TR>
<TR><TD vAlign='Bottom' Align='Right'>
<Input Type='Submit' Value=' ����������! ' />
</TR></TD></Table>
</Form>
<P>
<? if($CFG->WiFi->user) LoadLib('wifi.online'); ?>
