<?
global $CFG;
uxmHeader('Поиск по адресной книге');

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
<H1>Поиск пользователей</H1>
<Form Action='./' Method='GET' onSubmit='return Check()'>

<Table><TR vAlign='Bottom'><TD NoWrap>
<?
LoadLib('/forms');
Input('q', 'Я ищу:');BR();
?>

</TD><TD vAlign='Bottom'><Input Type=Submit Value=' Искать! ' />
</TD></TR></Table>
<? LoadLib(strlen($CFG->entry->q)>1? 'results' : 'help'); ?>
</Form>
