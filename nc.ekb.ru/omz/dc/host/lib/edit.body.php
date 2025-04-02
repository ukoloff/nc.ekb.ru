<Form Action='./' Method='POST'>
<Table><TR vAlign='top'><TD>
<?
LoadLib('/forms');
Input('employeeID', 'Инвентарный №');
BR();
Input('location', 'Расположение');
BR();
Input('description', 'Описание');
echo "</TD><TD>";
TextArea('info', 'Заметки');
?>
</TD></TR></Table>
<?
hiddenInputs();
Submit();
?>
</Form>
