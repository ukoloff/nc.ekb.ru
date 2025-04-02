<?
AuthorizedOnly();
$i=$CFG->Menu->findItem('/dc/');
if(!$i->href):
  Header('Location: /');
  uxmHeader();
  exit;
endif;

?>
