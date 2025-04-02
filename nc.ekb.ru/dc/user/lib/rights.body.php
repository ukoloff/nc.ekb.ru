<Form Action='./' Method='POST'>
<Table><TR vAlign='Top'><TD NoWrap>
<?
LoadLib('/forms');
hiddenInputs();
CheckBox('disable', 'Заблокирован');
BR();
?>
<Div id='Notify'>
<?
  CheckBox('notify', 'Уведомить'); 
?>
</Div>
<?
CheckBox('dontExpire', 'Не требовать смены пароля');
BR();
//CheckBox('nopass', 'Не может менять пароль'); BR();
$email=htmlspecialchars($CFG->params->u)."@ekb.ru";
CheckBox('nis', "Электронная почта <Sup><A hRef=\"mailto:$email\" Title=\"&lt;$email&gt;\">*</A></Sup>");
BR();
foreach($CFG->rList as $k=>$v):
 CheckBox("g$k", htmlspecialchars($v)); BR();
endforeach;
?>
</TD><TD NoWrap>
<?
Input('free', 'Бесплатный трафик, Мб');
echo "<P />";
Input('limit', 'Лимит трафика, Мб');
echo "<P />";
Submit();
?>
</TD></TR></Table>
</Form>
<HR />
<Small>
&raquo; При снятом флажке "Не требовать смены пароля" каждые 42 дня пароль будет автоматически сбрасываться ;-)
<BR />
&raquo; Если флажок "Доступ в Интернет закрыт" включён, то выключать флажок "Доступ в Интернет" не надо
<BR />
&raquo; Для неограниченного трафика - не вводите ничего в поле "Лимит трафика"
</Small>
<Script><!--

if(Statistics.Smart) document.forms[0].disable.onclick=xNotify;

function xNotify()
{
 findId('Notify').style.display=document.forms[0].disable.checked? 'block' : 'none';
}
--></Script>
