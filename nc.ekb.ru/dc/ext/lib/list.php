<xScript Src='list.js'></xScript>
<Script><!--
function onClick(No)
{
<?
global $CFG;

LoadLib($CFG->params->x.'.attr');
$as=trim($_REQUEST['as']);
if(!$CFG->Attrs[$as])$as='';
$CFG->entry->as=$as;
?>
}
//--></Script>
<Form Action='./' Method='Get' onSubmit='return Validate()'>
<Table><TR><TD>
<? Select('as', $CFG->Attrs, '�������'); ?>
</TD><TD>
<?
//$CFG->defaults->Input->BR=' ';
Input('q', '�����');
unset($CFG->params->q);
HiddenInputs();
$CFG->params->q=$CFG->entry->q;
?>
</TD><TD vAlign='Bottom'><Input Type='Submit' Value=' ������! ' />
<TD><Small>
<Script><!--
Hints();
//--></Script>
</Small><BR /></TD>
</TD></TR></Table>
</Form>
<?
if($CFG->entry->q):
 LoadLib($CFG->params->x.'.connect');

 LoadLib($CFG->params->x.'.list');

else:
?>
<Script><!--
Focus();
//--></Script>
<?
 LoadLib('help');
endif;
?>
