<P />
<Center>
������ ������� ������
</Center>
<?
$e=getEntry($CFG->udn, 'mail');
if($e['count']):
?>
<HR />
<Small>
&raquo;������������� ������� ������������ <A hRef='./<?=hRef('x', 'mail', 'subject' , 'pass')?>'>������</A>
�� ���� ��������� �������...
</Small>
<?
endif;
?>
