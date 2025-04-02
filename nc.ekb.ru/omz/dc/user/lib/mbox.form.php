<Form Action='./' Method='POST' autocomplete="off"
onSubmit='return confirm("Вы точно уверены, что хотите запустить\nкоманды управления почтовым ящиком?")'>
<?
LoadLib('/forms');
$CFG->defaults->Input->maxWidth=1;

$CFG->DC="-DomainController '".preg_replace('/\s+.*/', '', $CFG->AD->Srv)."'";

$e=getEntry($CFG->udn, 'homeMDB');
LoadLib($CFG->params->x.'.'.($e[$e[0]][0]?'disable':'enable'));
hiddenInputs();
?>
<P />
<Input Type='Submit' Value='Исполнить команды!' <?=inGroupX('#modifyDIT')?'':'x-Disabled'?>  />
&raquo;
<small>Команды могут исполняться не мгновенно, а с задержкой в несколько секунд...</small>
</Form>
