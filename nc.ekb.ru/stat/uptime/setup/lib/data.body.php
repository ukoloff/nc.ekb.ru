<?
global $CFG;

LoadLib('/forms');

if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";

?>
<Form Action='./' Method='Post'>
<Table><TR><TD>
<Table>
<?

$CFG->defaults->Input->BR="</TD>\n<TD>";

foreach($CFG->oldAttrs as $v):
 echo "<TR><TD Align='Right'>";
 $varName="v".$v['No'];
 $CFG->entry->$varName=$v['Value'];
 Input($varName, htmlspecialchars($v['Name']));
 echo "</TD></TR>\n";
 unset($CFG->entry->$varName);
endforeach;

$CFG->defaults->Input->BR="";

$attrSelect=Array(''=>'');

foreach($CFG->Attrs as $v):
 $attrSelect[$v['No']]=htmlspecialchars($v['Name']);
endforeach;

foreach($CFG->newAttrs as $v):
 echo "<TR vAlign='top'><TD Align='Right'>";
 $varName='a[]';
 $CFG->entry->$varName=$v['No'];
 Select($varName, $attrSelect);
 unset($CFG->entry->$varName);
 echo "</TD><TD>";
 $varName='v[]';
 $CFG->entry->$varName=$v['Value'];
 unset($CFG->Errors->$varName);
 if($v['Error']) $CFG->Errors->$varName='Это в какой атрибут поместить?';
 Input($varName, '');
 unset($CFG->entry->$varName);
 unset($CFG->Errors->$varName);
 echo "</TD></TR>\n";
endforeach;

?>
</Table></TD><TD vAlign='top'>
<?
HiddenInputs();
Submit()
?>
</TD></TR></Table>
</Form>
