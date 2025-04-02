<? 
$lib = 'list';
if(isset($_REQUEST['dept'])) $lib = '.dept';
else if(isset($_REQUEST['h'])) $lib = 'item';

if ('.'==$lib[0]) $lib = $CFG->params->x.$lib;

LoadLib($lib);
?>
