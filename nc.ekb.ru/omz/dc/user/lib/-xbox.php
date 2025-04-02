<Style><!--
Div#xBox {
    width: 100%;
    display: none;
}
Div#xBox  * {
    width: 100%;
}
--></Style>
&raquo;
<A hRef='#' onClick='toggleX(); return false;'>Команды</A> создания почтового ящика
<Div id='xBox'>
<?
unset($A2);
$A2[]="\"SMTP:{$CFG->params->u}@ekb.ru\"";
$A2[]="\"smtp:{$CFG->params->u}@migrationomzglobal.com\"";
if($CFG->params->u!=$CFG->uxm)
  $A2[]="\"smtp:{$CFG->uxm}@ekb.ru\"";
?>
<A hRef="/dc/user/<?=hRef('u', $CFG->uxm, 'x', 'mail', 'subject', 'xch')?>" Target='_blank'>Первое письмо</A>
<TextArea Rows='2' Wrap='Off'>
$mb=Enable-Mailbox '<?=$CFG->AD->Domain?>\<?=htmlspecialchars($CFG->params->u)?>' -Alias '<?=htmlspecialchars($CFG->params->u)?>' -Database 'mbx-base24'
$mb|Set-Mailbox -EmailAddressPolicyEnabled:$false -EmailAddresses (<?=htmlspecialchars(join(', ', $A2))?>)
</TextArea><BR />
<Input Value="<?=htmlspecialchars($CFG->uxm)?>:	<?=htmlspecialchars($CFG->params->u)?>@migrationomzglobal.com" /><BR />
<A hRef="./<?=hRef('x', 'mail', 'subject', 'xch')?>">Второе письмо</A>
</Div>
<Script><!--
function toggleX()
{
 var z=findId('xBox');
 z.style.display='block'==z.style.display?'none':'block';
}
//--></Script>
