<?
global $CFG;

$CFG->entry->newf=basename(trim($_REQUEST['newf']));
$CFG->entry->force=trim($_REQUEST['force']);

if(!strlen($CFG->entry->newf)):
 $CFG->Errors->newf='������� ��� �����';
else:
 $CFG->newFile=$CFG->sqlPath.$CFG->entry->newf.'.sq3';
 if(!$CFG->entry->force and file_exists($CFG->newFile))	
    $CFG->Errors->newf='���� ����������';
endif;

if(!$CFG->Errors):
 LoadLib($CFG->params->x.'.action');
endif;

if(!$CFG->Errors)
  Header('Location: ./'.hRef('f', $CFG->entry->newf, 'x'));

?>
