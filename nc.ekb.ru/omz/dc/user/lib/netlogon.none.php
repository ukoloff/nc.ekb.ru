<?
global $CFG;
if('create'==strtolower(trim($_REQUEST['mode']))):
 echo "&raquo;\n����� ����<BR />\n";
 $CFG->entry->Bat=<<<BAT
@Call %0\\..\\..\\..\\Group\\All.bat

BAT
;
 LoadLib($CFG->params->x.'.file');
else:
?>
&raquo;
���� �� ������, <A hRef='./<?= htmlspecialchars(hRef('mode', 'create'))?>'>�������</A>
<?
endif;
?>
