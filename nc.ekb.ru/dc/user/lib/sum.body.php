<?
LoadLib('/user');
setlocale(LC_ALL, "ru_RU.cp1251");

userInfo($CFG->params->u, 1);
?>
&raquo;<A hRef="/stat/<?=hRef()?>">����������</A> ����� ������������<BR />
&raquo;������� <A hRef='./<?=hRef('x', 'mail')?>'>������</A> ����� ������������<BR />
