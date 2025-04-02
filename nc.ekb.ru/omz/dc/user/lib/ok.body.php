<P />
<Center>
Пароль успешно изменён
</Center>
<?
$e=getEntry($CFG->udn, 'mail');
if($e['count']):
?>
<HR />
<Small>
&raquo;Рекомендуется послать пользователю <A hRef='./<?=hRef('x', 'mail', 'subject' , 'pass')?>'>письмо</A>
об этом радостном событии...
</Small>
<?
endif;
?>
