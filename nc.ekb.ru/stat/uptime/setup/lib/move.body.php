<?
LoadLib('/forms');
?>
Номер записи для этого сервиса - <B><?=$CFG->params->n?></B>. 
Укажите его другому сервису, если хотите перенести его в подчинение этому.
<P>
Укажите номер сервиса, потомком которого Вы хотите сделать этот сервис:<BR />
<Center>
<Form Action='./' Method='POST'>
<Table><TR><TD>
<?
Input('p', 'Код родителя');
HiddenInputs();
?>
</TD></TR><TR><TD>
<Input Type='Submit' Value=' Перенести! ' />
</TR></Table>
</Form>
</Center>
