<?
/*
LoadLib('/nw');
//if('ec'==$CFG->params->u)userDataSheet('ec1');

if(userDataSheet($CFG->params->u)):
 echo "&raquo; �� �� �����, �� <A hRef='../ou/", htmlspecialchars(hRef('id', $CFG->params->u, 'u')), "'>���������</A>...";
else:
 echo "<H3>������������ �� ����� ������� � �������� Novell Netware</H3>";
endif;
*/
?>
������������ ������ �� ���������� ������� � �������� Novell Netware ��������
<A Target='_blank' hRef='../ou/<?=htmlspecialchars(hRef('id', $CFG->params->u, 'u'))?>'>���</A>.
