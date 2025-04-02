<?
LoadLib('/userInfo');
setlocale(LC_ALL, "ru_RU.cp1251");

userInfo($CFG->params->u, 1);
?>
<? LoadLib('sum.unlock'); ?>
<!--
&raquo;
<Span><A hRef="/omz/stat/<?=hRef()?>">Статистика</A><? LoadLib('sum.popup'); ?></Span> этого пользователя<BR />
-->
&raquo;
Послать <A hRef='./<?=hRef('x', 'mail')?>'>письмо</A> этому пользователю
<? if(inGroupX('#modifyDIT')) LoadLib('sum.json'); ?>
