<?
LoadLib('/userInfo');
UserInfo($CFG->params->u, 1+2);
?>
&raquo;
<A hRef='./'>����� �������������</A>
<?
if($CFG->isAdmin)
  echo "<BR />&raquo;\n<A hRef='/omz/dc/user/", htmlspecialchars(hRef()),
    "'>���������� �������������</A><BR />&raquo;\n<A hRef='/omz/stat/", htmlspecialchars(hRef()), "'>����������</A>";
?>
