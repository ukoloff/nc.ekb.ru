<? 
foreach(explode(' ', 'pass pics') as $x)
  if(isset($_REQUEST[$x])) return LoadLib($CFG->params->x.'.'.$x);
LoadLib('common.body');
?>
