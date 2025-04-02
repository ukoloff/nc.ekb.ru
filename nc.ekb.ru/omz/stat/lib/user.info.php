<?
LoadLib('/userInfo');
userInfo($CFG->params->u);
?>
<P />
<Div Align='Left'>
<?
/*if($CFG->u==$CFG->params->u)
 echo '&raquo;<A hRef="/pass/">Сменить пароль</A><BR />';*/
unset($CFG->defaults->u);
if(inGroupX('#browseDIT')) 
 echo '&raquo;<A hRef="/omz/dc/user/', hRef('x'), '">Просмотр/редактирование пользователя</A><BR />';
?>
</Div>
