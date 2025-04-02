<?
global $CFG;
LoadLib('/user');
$isAdmin=!!$CFG->Menu->findItem('/dc/');
uxmHeader('Пользователь');

?>
<H1>Пользователь</H1>

<?
UserInfo($CFG->params->u, 1+2);
?>
&raquo;
<A hRef='./'>Поиск пользователей</A>
<?
global $CFG;

if($isAdmin)
  echo "<BR />&raquo;\n<A hRef='/dc/user/", htmlspecialchars(hRef()),
    "'>Управление пользователем</A><BR />&raquo;\n<A hRef='/stat/", htmlspecialchars(hRef()), "'>Статистика</A>";
?>
</body></html>
