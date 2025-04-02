<?
system("/usr/bin/net rpc file close {$CFG->params->id} -S dbServ -U ".$CFG->AD->Domain."\\\\".$_SERVER['PHP_AUTH_USER']."%".$_SERVER['PHP_AUTH_PW'], $A);
?>
<Script><!--
window.close();
//--></Script>
<H2>Соединение разорвано</H2>
