<Form Action='./' Method='POST'>
<Table><TR><TD RowSpan='2' NoWrap>
<FieldSet>
<Legend><Small>Права</Small>
</Legend>
<?
LoadLib('/forms');
hiddenInputs();
CheckBox('Disable', 'Доступ закрыт');	BR();
CheckBox('int', 'В локальную сеть');	BR();
CheckBox('ext', 'В Интернет');		BR();
?>
</FieldSet></TD><TD vAlign='Top'>
<?
Input('maxConn', 'Одновременно сеансов');
?>
</TD></TR>
<TR><TD vAlign='Bottom' Align='Right'>
<Input Type='Submit' Value=' Установить! ' />
</TR></TD></Table>
</Form>
<P>
<? if($CFG->WiFi->user) LoadLib('wifi.online'); ?>
