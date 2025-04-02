<?
system('/usr/bin/zip -uqj '.
    escapeshellarg($CFG->sqlPath.'/'.$CFG->params->f.'.zip').' '.
    escapeshellarg($CFG->sqlFile));

Header('Location: ./'.hRef('x', 'zipped'));
?>
