<?
LoadLib('/userInfo');
setlocale(LC_ALL, "ru_RU.cp1251");

userInfo($CFG->params->u, 1);
?>
<? LoadLib('sum.unlock'); ?>
<!--
&raquo;
<Span><A hRef="/omz/stat/<?=hRef()?>">����������</A><? LoadLib('sum.popup'); ?></Span> ����� ������������<BR />
-->
&raquo;
������� <A hRef='./<?=hRef('x', 'mail')?>'>������</A> ����� ������������
<? if(inGroupX('#modifyDIT')) LoadLib('sum.json'); ?>
