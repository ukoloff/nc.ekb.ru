<?
$CFG->entry->plain=!!trim($_GET[plain]);
$CFG->entry->as=trim($_GET['as']);

LoadLib('build');
LoadLib('backup');

switch($CFG->entry->as)
{
 case 'html': 
 case 'csv':
 case 'txt':
 case 'xls':
 case 'js':
 case 'yaml':
  Header('Content-Type: application/octet-stream');
  Header('Content-Disposition: attachment; filename="dns-'.strftime('%Y-%m-%dT%H-%M-%S').'.'.$CFG->entry->as.'"');
  LoadLib($CFG->entry->as);
  exit;
}

?>
