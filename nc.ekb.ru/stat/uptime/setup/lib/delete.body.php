<?
global $CFG;
//LoadLib('/forms');
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
<P>
<Center>������������� ������� ���� ������?


<Form Action='./' Method='Post'>
<Input Type='Submit' Value=' ��, ������� ' />
<?
HiddenInputs();
?>
</Form>
