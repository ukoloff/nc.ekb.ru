<?
global $CFG;
if('create'==strtolower(trim($_REQUEST['mode']))):
 echo "&raquo;\nНовый файл<BR />\n";
 $CFG->entry->Bat=<<<BAT
@Call %0\\..\\..\\..\\Group\\All.bat

BAT
;
 LoadLib($CFG->params->x.'.file');
else:
?>
&raquo;
Файл не найден, <A hRef='./<?= htmlspecialchars(hRef('mode', 'create'))?>'>создать</A>
<?
endif;
?>
