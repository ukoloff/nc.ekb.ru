<?
$i=$CFG->Menu->findItem('/omz/service/inet/');
if(!$i->href):
  Header('Location: /');
  uxmHeader();
  exit;
endif;

$CFG->title='��������� ��������';
$CFG->Z=Array(101=>'�������', 102=>'������', 103=>'���');
$CFG->URL='https://l3.ekb.ru/ipTables/';

?>
