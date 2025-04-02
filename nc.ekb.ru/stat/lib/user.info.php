<?
LoadLib('/user');
userInfo($CFG->params->u);
?>
<P />
<Div Align='Left'>
<?
if($CFG->u==$CFG->params->u)
 echo '&raquo;<A hRef="/pass/">Сменить пароль</A><BR />';
if(inGroupX('#browseDIT')) 
 echo '&raquo;<A hRef="/dc/user/', hRef('x'), '">Просмотр/редактирование пользователя</A><BR />';
?>
</Div>
