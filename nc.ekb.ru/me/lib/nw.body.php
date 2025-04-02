<?
LoadLib('/nw');
if(userDataSheet($CFG->u))
 echo "<P /><Small>&raquo; На этой странице отображаются все сервера Novell Netware, к которым Вы имеете доступ</Small>";
else
 echo "<H3>Вы не имеете доступа к серверам Novell Netware</H3>";
?>
