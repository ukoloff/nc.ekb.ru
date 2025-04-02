<?
$i=$CFG->Menu->findItem('/omz/service/inet/');
if(!$i->href):
  Header('Location: /');
  uxmHeader();
  exit;
endif;

$CFG->title='Провайдер Интернет';
$CFG->Z=Array(101=>'Энфорта', 102=>'Билайн', 103=>'УТК');
$CFG->URL='https://l3.ekb.ru/ipTables/';

?>
