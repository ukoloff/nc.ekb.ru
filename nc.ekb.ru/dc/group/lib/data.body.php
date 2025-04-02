<Script><!--
function defName()
{
 f=document.forms[0];
 f.cn.focus();
 if(f.cn.value && f.cn.value!=f.sAMAccountName.value)
  if(!confirm('Изменить поле "Название"?')) return;
 f.cn.value=f.sAMAccountName.value;
}

function Valid()
{
 f=document.forms[0];
 x=f.sAMAccountName;
 if(!x.value) { alert('Введите имя группы!'); x.focus(); return false;}
 x=f.cn;
 if(!x.value) { alert('Введите название группы!'); x.focus(); return false; }
 return true;
}
//--></Script>
<Form Action='./' Method='POST' onSubmit='return Valid()'>
<Table><TR vAlign='Top'><TD NoWrap>
<?
LoadLib('/forms');
Input('sAMAccountName', 'Группа'); 
echo "</TD><TD>";
$CFG->defaults->Input->W=50;
Input('description', 'Описание');
echo "</TD></TR></Table>";
#if(!$CFG->gdn):
  echo "<Table><TR vAlign='Top'><TD>";
  Select('type', Array('s'=>'Security', 'd'=>'Distribution'), 'Тип');
  echo "</TD><TD>";
  Select('scope', Array('g'=>'Глобальная', 'd'=>'Домен', 'u'=>'Универсальная'), 'Scope');
  echo "</TD></TR></Table>\n";
#endif;
echo "<Small>Рекомендуется <A hRef=# onClick='defName(); return false;'>установить название</A>
такое же, как имя группы</Small>
<Table><TR vAlign='Top'><TD>";
$CFG->defaults->Input->W=45;
Input('ou', 'Подразделение'); 
unset($CFG->params->ou);
echo "</TD><TD NoWrap>\n";
$CFG->defaults->Input->W=30;
Input('cn', 'Название');
echo "</TD></TR>
<TR><TD>";
TextArea('info', 'Заметки');
echo "</TD><TD Align='Right' vAlign='bottom'>";
if(!$CFG->gdn) unset($CFG->params->g);
hiddenInputs();
Submit();
?>
</TD></TR></Table>
<?
if($CFG->gdn)
  echo "<Small>&raquo; Иногда scope изменить напрямую не удаётся, но как правило через \"Универсальная\" всё получается</Small>";
?>