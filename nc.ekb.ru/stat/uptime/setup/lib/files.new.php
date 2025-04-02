<?
global $CFG;

$f='new';
for($i=1; $i<=12; $i++)
  $f.=rand(0, 10);

$ff=fopen($CFG->sqlPath.$f.'.sq3', 'w');
if($ff):
 fclose($ff);
 Header('Location: ./'.hRef('x', 'rename', 'f', $f));
else:
 Header('Location: ./');
endif;

?>
