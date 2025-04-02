<?
LoadLib('/forms');
$d=new DN($CFG->udn);
$d->Cut();
$d=$d->ufn();
?>
Компьютер <?=htmlspecialchars($CFG->params->u)?> находится в папке: <code><?=htmlspecialchars($d->str())?></code><HR />
<Form Action='./' Method='POST'>
<Table><TR vAlign='top'><TD>
Переместить в папку:<BR />
<?
foreach($CFG->entry->o as $k=>$v):
  RadioButton('f', $k, $v); 
  echo "<A Title='Открыть подразделение в отдельном окне' hRef='../ou/", htmlspecialchars(hRef('ou', $v, 'u', null, 'x')), 
    "' Target='_ou'><i class='fa fa-eye'></i></A><Input Type='Hidden' Name='o[", htmlspecialchars($k), "]' Value='", htmlspecialchars($v), "' />";
  BR();
endforeach;
HiddenInputs();
?>
</TD><TD>
<Input Type='Submit' Value=' Переместить! ' />
</TD></TR></Table>
</Form>
