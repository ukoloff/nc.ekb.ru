<? 
foreach(explode(' ', 'pass pics') as $x)
  if(isset($_REQUEST[$x])) return LoadLib($CFG->params->x.'.'.$x);
LoadLib('common.body');

function utc2unix($time)
{
 $t=preg_split('/\D+/', $time);
 return gmmktime($t[3], $t[4], $t[5], $t[1], $t[2], $t[0]);
}

function utc2str($time)
{
 if(!$time) return;
 return strftime('%Y-%m-%d %T', utc2unix($time));
}

?>
