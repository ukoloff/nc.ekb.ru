<?
$e=getEntry($CFG->idn, 'memberOf');
$e=$e['memberof'];
$n=0;
for($i=$e['count']-1; $i>=0; $i--):
 $g=getEntry($e[$i], "sAMAccountName");
 $g=utf2str($g[$g[0]][0]);
 if(!$g) continue;
 $Name="g".($n++);
 $CFG->entry->$Name=$g;
 $Name="x$Name";
 $CFG->entry->$Name=1;
endfor;
$CFG->entry->gcount=$n;
unset($e);
?>
