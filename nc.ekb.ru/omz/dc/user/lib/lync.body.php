<P>
<Form Action='./' Method='POST' autocomplete="off"
onSubmit='return confirm("Вы точно уверены, что хотите запустить\nкоманды управления учётной записью Lync?")'>
<?
LoadLib('/forms');
$e=getEntry($CFG->udn, 'msrtcsip-primaryuseraddress');
LoadLib($CFG->params->x.'.'.($e[$e[0]][0]?'disable':'enable'));
//$CFG->entry->PoSH.=" -DomainController '".preg_replace('/\s+.*/', '', $CFG->AD->Srv)."'";
hiddenInputs();
$CFG->defaults->Input->maxWidth=1;
Input('PoSH', 'PowerShell-команда настройки Lync');
?>
<P />
<Input Title='Lync должен ставиться всем автоматом' Type='Submit' Value='<?=$CFG->entry->Command?>!' <?=inGroupX('#modifyDIT')?'':'x-Disabled'?>  />
&raquo;
Команды могут исполняться не мгновенно, а с задержкой в несколько секунд...
<P />
Если команда не сработала, а очень надо - можно воспользоваться <a href='http://srvsfb-ekbh1.omzglobal.com/Cscp' target='_blank'>штатной веб-мордой</a> (откроется в новом окне)
</Form>
<? LoadLib('lync.patch'); ?>
