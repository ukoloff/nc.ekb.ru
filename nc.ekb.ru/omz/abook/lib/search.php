<Form Action='./' Method='GET' onSubmit='return Check()'>
<Table><TR vAlign='Bottom'><TD NoWrap>
<?
LoadLib('/forms');
$CFG->entry->q=trim($_REQUEST['q']);
$CFG->defaults->Input->extraAttr='Type="search" Required';
Input('q', 'Я ищу:');BR();
unset($CFG->defaults->Input->extraAttr);
//hiddenInputs();
$CFG->params->q=$CFG->entry->q;
?>
</TD><TD vAlign='Bottom'><Input Type=Submit Value=' Искать! ' />
</TD></TR></Table>
</Form>
<?
LoadLib(strlen($CFG->entry->q)>1?'list':'empty');
?>

