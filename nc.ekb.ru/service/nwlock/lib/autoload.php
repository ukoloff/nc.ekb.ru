<?
global $CFG;

if(!inGroupX('Domain Admins') and !inGroupX('progs@nw')):
 forceAuth();
 uxmHeader('��������� �����������');
 exit;
endif;

?>
