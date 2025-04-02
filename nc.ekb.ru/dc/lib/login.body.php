<Form Action='./' Method='POST'>
<?
LoadLib('/forms');
if($CFG->udn):
 Input('scriptPath', 'Скрипт подключения [Установить <A hRef="#" onClick="stdLogin(); return false;">стандартный</A>]');
?>
<BR />
<Script><!--
function stdLogin()
{
 var f=document.forms[0];
 f.scriptPath.value='uxmlogin.exe';
 f.scriptPath.focus();
}
//--></Script>
<?
endif;
$CFG->defaults->Input->maxWidth=1;
$CFG->defaults->Input->H=10;
TextArea('script', 'Процедура подключения');
BR();
hiddenInputs();
Submit();
?>
</Form>
<Script><!--
document.forms[0].script.focus();
--></Script>
<Small>
Процедуры подключения исполняются (для каждого пользователя) в следующем порядке:
<UL>
<LI>Сценарии подразделений, начиная от корня Active Directory
<LI>Сценарии всех групп, куда (прямо или косвенно) включён пользователь, по правилу: если группа A включает 
группу B, то процедура A выполняется раньше процедуры B
<LI>Личный сценарий пользователя
</UL></Small>
<?
if($CFG->udn)
  echo "&raquo;См. также: Полный (результирующий) <A hRef='../script/", hRef('x', null), 
    "' Target='loginScript'>Login Script</A>";
?>
