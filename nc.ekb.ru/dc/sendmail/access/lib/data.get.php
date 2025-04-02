<?
$F=array('cn', 'description');
$e=getEntry($CFG->cdn->str(), $F);

foreach($F as $k)
 $CFG->entry->$k=utf2str($e[$k][0]);

$z=new ufn($CFG->params->in);
$z->Cut();
$CFG->entry->up=$z->str();
?>
