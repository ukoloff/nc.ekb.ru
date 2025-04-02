<Script><!--
setTimeout(function()
{
 var x=document.forms[0].set;
 x.checked=(window.opener && window.opener.onSetPass)?1:0;
 x.disabled=!x.checked;
}, 0);
//--></Script>
Перед Вами список сгенерированных паролей. Выберите тот, который Вам легче будет запомнить или больше Вам нравится :-)
<P />
<Table><TR vAlign='top'><TD NoWrap RowSpan='2'>
<FieldSet><Legend>Пароли</Legend>
<?
global $CFG;
LoadLib('/forms');

if('random'==$_SESSION['type']) LoadLib('random.pass');
else LoadLib('word.pass');

$XXX=1;
for($i=16; $i>0; $i--):
 $p=newPass();
 $p64=base64_encode($p);
 if($XXX)$CFG->entry->p=$p64;
 $XXX=0;
 RadioButton('p', $p64, htmlspecialchars(preg_replace('/^\S*\s+/', '', $p)));
 echo "<BR />\n";
endfor;
echo "</FieldSet></TD><TD><FieldSet><Legend>Дополнительно</Legend>\n";
CheckBox('set', "Послать пароль в окно ввода пароля");

?>
<Div Class='Comment'>
Выбранный Вами пароль будет на следующем шаге автоматически вставлен в окно ввода нового пароля, если этот флажок отмечен.
Вам всё равно следует записать выбранный пароль и сохранить его в надёжном месте.
</Div></FieldSet>
</TD></TR>
<TR><TD vAlign='bottom' Align='Center'>
Если ни один из предложенных паролей Вам не нравится - нажмите на панели браузера кнопку
<A hRef='#' onClick='location.reload(); return false;'>Обновить</A>.
</TD></TR></Table>
