<?
LoadLib('/forms');
$d=new DN($CFG->udn);
$d->Cut();
$d=$d->ufn();
?>
��������� <?=htmlspecialchars($CFG->params->u)?> ��������� � �����: <code><?=htmlspecialchars($d->str())?></code><HR />
<Form Action='./' Method='POST'>
<Table><TR vAlign='top'><TD>
����������� � �����:<BR />
<?
foreach($CFG->entry->o as $k=>$v):
  RadioButton('f', $k, $v); 
  echo "<A Title='������� ������������� � ��������� ����' hRef='../ou/", htmlspecialchars(hRef('ou', $v, 'u', null, 'x')), 
    "' Target='_ou'><i class='fa fa-eye'></i></A><Input Type='Hidden' Name='o[", htmlspecialchars($k), "]' Value='", htmlspecialchars($v), "' />";
  BR();
endforeach;
HiddenInputs();
?>
</TD><TD>
<Input Type='Submit' Value=' �����������! ' />
</TD></TR></Table>
</Form>
