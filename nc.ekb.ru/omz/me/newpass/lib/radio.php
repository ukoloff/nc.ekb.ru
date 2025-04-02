<?
LoadLib('/forms');

function RadioGroupX($var, $X)
{
 global $CFG;
 if(!$X[$CFG->entry->$var]):
  reset($X);
  if(!$CFG->defaults->$var) $CFG->defaults->$var=key($X);
  $CFG->entry->$var=$CFG->defaults->$var;
 endif;
foreach($X as $k=>$v):
 RadioButton($var, $k, $v['l']);
 echo "<Div Class='Comment'>", $v['comment'], "</Div>\n";
endforeach;
}

?>
