<?
global $CFG;
LoadLib('/user');
$isAdmin=!!$CFG->Menu->findItem('/dc/');
uxmHeader('������������');

?>
<H1>������������</H1>

<?
UserInfo($CFG->params->u, 1+2);
?>
&raquo;
<A hRef='./'>����� �������������</A>
<?
global $CFG;

if($isAdmin)
  echo "<BR />&raquo;\n<A hRef='/dc/user/", htmlspecialchars(hRef()),
    "'>���������� �������������</A><BR />&raquo;\n<A hRef='/stat/", htmlspecialchars(hRef()), "'>����������</A>";
?>
</body></html>
