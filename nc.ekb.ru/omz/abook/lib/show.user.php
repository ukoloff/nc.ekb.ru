<?
LoadLib('/userInfo');
UserInfo($CFG->params->u, 1+2);
?>
&raquo;
<A hRef='./'>Поиск пользователей</A>
<?
if($CFG->isAdmin)
  echo "<BR />&raquo;\n<A hRef='/omz/dc/user/", htmlspecialchars(hRef()),
    "'>Управление пользователем</A><BR />&raquo;\n<A hRef='/omz/stat/", htmlspecialchars(hRef()), "'>Статистика</A>";
?>
