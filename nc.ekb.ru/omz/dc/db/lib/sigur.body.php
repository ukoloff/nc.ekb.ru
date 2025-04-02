<? 
foreach(explode(' ', 'pass blind dept') as $x)
  if(isset($_REQUEST[$x])) return LoadLib($CFG->params->x.'.'.$x);

LoadLib('common.body');
?>
