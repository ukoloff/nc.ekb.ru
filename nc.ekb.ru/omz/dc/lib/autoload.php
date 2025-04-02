<?
$CFG->AAA=1;
$i=$CFG->Menu->findItem('/omz/dc/');
if(!$i->href):
//  Header('Location: /');
//  exit;
  $CFG->AAA=2;
endif;

?>
