<Script Src='list.js'></Script>
<?
$CFG->entry->q=trim($_REQUEST['q']);

LoadLib($CFG->params->x.'.attr');
$as=trim($_REQUEST['as']);
if(!$CFG->Attrs[$as] && !$CFG->extraAttrs[$as]) $as='';
$CFG->entry->as=$as;

LoadLib('/forms');
?>
<Form Action='./' Method='Get' onSubmit='return Validate()'>
<Table><TR><TD>
<? Select('as', $CFG->Attrs, 'Атрибут'); ?>
</TD><TD>
<?
$CFG->defaults->Input->extraAttr='Type="search" Required';
Input('q', 'Текст');
unset($CFG->defaults->Input->extraAttr);
unset($CFG->params->q);
HiddenInputs();
?>
</TD><TD vAlign='Bottom'><Input Type='Submit' Value=' Искать! ' />
<TD><Small>
<Script><!--
Hints();
//--></Script>
</Small><BR /></TD>
</TD></TR></Table>
</Form>
<?
if($CFG->entry->q):
 dbConnect();
 LoadLib($CFG->params->x.'.list');
else:
 LoadLib('help');
endif;
?>
