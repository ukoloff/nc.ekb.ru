<P />
<Center>
Пароль успешно изменён
</Center>
<?
$e=getEntry($CFG->udn, 'mssfu30nisdomain');
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
