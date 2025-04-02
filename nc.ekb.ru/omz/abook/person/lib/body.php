<?
LoadLib('/userInfo');

userInfo($u=trim($_REQUEST['u']), 1+2);
?>
&raquo;
<A hRef='../'>Поиск пользователей</A>
<?
if($CFG->isAdmin)
  echo "<BR />&raquo;\n<A hRef='/omz/dc/user/", htmlspecialchars(hRef('u', $u)),
    "'>Управление пользователем</A><BR />&raquo;\n<A hRef='/omz/stat/", htmlspecialchars(hRef('u', $u)), "'>Статистика</A>";
