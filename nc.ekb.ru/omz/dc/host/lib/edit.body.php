<Form Action='./' Method='POST'>
<Table><TR vAlign='top'><TD>
<?
LoadLib('/forms');
Input('employeeID', '����������� �');
BR();
Input('location', '������������');
BR();
Input('description', '��������');
echo "</TD><TD>";
TextArea('info', '�������');
?>
</TD></TR></Table>
<?
hiddenInputs();
Submit();
?>
</Form>
