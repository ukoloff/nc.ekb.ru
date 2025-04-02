&raquo;
Уведомить о <!--<A hRef="./<?=hRef('x', 'mail', 'subject', 'xch')?>">завершении миграции</A>
или о --><A hRef="./<?=hRef('x', 'mail', 'subject', 'mail')?>">создании почтового ящика</A>
<BR />
&raquo;
Послать произвольное
<A hRef="./<?=hRef('x', 'mail')?>">письмо</A>

<H2>Удаление ящика</H2>

<?
if(!$CFG->entry->PoSH):
  $CFG->entry->PoSH="Disable-Mailbox '{$CFG->AD->Domain}\\{$CFG->params->u}' -Confirm:\$false {$CFG->DC}";
endif;
Input('PoSH', 'Настройка Exchange');
$CFG->params->mail0=1;
?>
