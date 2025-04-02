<?
$CFG->entry->y=trim($_REQUEST['y']);
$ff=$CFG->params->f.'.schema';
$fn=$CFG->sqlPath.'/'.$ff.'.sq3';
if(file_exists($fn) and !$CFG->entry->y):
  $CFG->Errors->y='Файл существует';
elseif(!copy($CFG->sqlFile, $fn)):
  $CFG->Errors->y='Ошибка копирования';
else:
  $h=sqlite3_open($fn);
  sqlite3_exec($h, 'Delete From Status; Vacuum;');
  sqlite3_close($h);

  Header('Location: ./'.hRef('f', $ff, 'x', 'file'));
endif;
?>
