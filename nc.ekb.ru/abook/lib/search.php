<?
global $CFG;
uxmHeader('����� �� �������� �����');

$CFG->entry->q=trim($_REQUEST['q']);

?>
<Script> <!--
function Check()
{
 q=document.forms[0].q;
 if(q.value.length>1) return true;
 q.focus();
 return false;
}
//--></Script>
<H1>����� �������������</H1>
<Form Action='./' Method='GET' onSubmit='return Check()'>

<Table><TR vAlign='Bottom'><TD NoWrap>
<?
LoadLib('/forms');
Input('q', '� ���:');BR();
?>

</TD><TD vAlign='Bottom'><Input Type=Submit Value=' ������! ' />
</TD></TR></Table>
<? LoadLib(strlen($CFG->entry->q)>1? 'results' : 'help'); ?>
</Form>
