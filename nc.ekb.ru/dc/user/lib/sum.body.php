<?
LoadLib('/user');
setlocale(LC_ALL, "ru_RU.cp1251");

userInfo($CFG->params->u, 1);
?>
&raquo;<A hRef="/stat/<?=hRef()?>">Статистика</A> этого пользователя<BR />
&raquo;Послать <A hRef='./<?=hRef('x', 'mail')?>'>письмо</A> этому пользователю<BR />
