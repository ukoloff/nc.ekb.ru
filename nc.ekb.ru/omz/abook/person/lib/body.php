<?
LoadLib('/userInfo');

userInfo($u=trim($_REQUEST['u']), 1+2);
?>
&raquo;
<A hRef='../'>����� �������������</A>
<?
if($CFG->isAdmin)
  echo "<BR />&raquo;\n<A hRef='/omz/dc/user/", htmlspecialchars(hRef('u', $u)),
    "'>���������� �������������</A><BR />&raquo;\n<A hRef='/omz/stat/", htmlspecialchars(hRef('u', $u)), "'>����������</A>";
