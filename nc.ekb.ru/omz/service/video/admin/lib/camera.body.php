<Script><!--
function Sure(B)
{
 if(!confirm('Вы собираетесь удалить камеру #'+B.form.i.value+
    '\nЭту операцию невозможно будет отменить.\n\nВы уверены?')) return;
 B.form.i.value='#'+B.form.i.value;
 B.form.submit();
}

function Validate(F)
{
 var Z=['Host', 'name', 'user', 'pass'];
 for(var i in Z)
 {
  var p=F[Z[i]];
  if(p.value.length) continue;
  p.focus();
  return false;
 }
 return true;
}

function GPS()
{
 var f=document.forms[0];
 if(!f) return;
 var Z=['lat', 'lon'];
 for(var i in Z)
 {
  var z=f[Z[i]];
  if(!z) continue;
  var v=z.value;
  if(!v.length) continue;
  if(v.match(/^\s*(\+|-|)\d+(\.\d*)?\s*$/))
  {
   v=Math.abs(v);
   var d=Math.floor(v);
   v=(v-d)*60;
   var m=Math.floor(v);
   v=Math.round((v-m)*60*100)/100;
   if('-'==RegExp.$1)d='-'+d;
   z.value=(d+':'+m+':'+v).replace(/(:0+)+$/, '');
   continue;
  }
  if(v.match(/^\s*(\+|-|)(\d+)\D+(\d+)(\D+(\d+(\.\d*)?)\D*)?\s*$/))
  {
   z.value=('-'==RegExp.$1?'-':'')+((RegExp.$5/60+RegExp.$3/1.0)/60+RegExp.$2/1.0);
   continue;
  }
  z.focus();
  z.select();
  return;
 }
}
//--></Script>
<Form Action='./' Method='post' onSubmit='return Validate(this)'>
<? if($CFG->entry->id): ?>
<img id='preview' src="./?jpg&amp;w=320&amp;n=<?=$CFG->entry->id?>" Align='Right'/>
<?
endif; 
if($CFG->Errors->General) echo '<H2 Class="Error">', htmlspecialchars($CFG->Errors->General), '</H2>';

$Vs=Array();
$q=mssql_query('Select * From vendors');
while($r=mssql_fetch_object($q))$Vs[$r->id]=$r->Name;
?>
<Table><TR vAlign='top'><TD NoWrap>
<?
LoadLib('/forms');
HiddenInputs();
Select('vendor', $Vs, 'Модель'); BR();
Input('Host', 'Host'); BR();
Input('user', 'Пользователь'); BR();
Input('pass', 'Пароль'); 
echo "<P />";
CheckBox('skip', 'Отключить'); 
echo "<P />";
echo "</TD><TD NoWrap>";
Input('name', 'Имя'); BR();
Input('comment', 'Комментарий'); BR();
//$CFG->defaults->Input->extraAttr='readonly';
Input('lat', '[GPS]Широта'); BR();
Input('lon', '[GPS]Долгота');
//unset($CFG->defaults->Input->extraAttr);
//LoadLib('ztd');
?>
<BR /><Small>&raquo;
<A hRef='#' onClick='GPS(); return false'>Перевод</A> градусы/минуты
</TD></TR></Table>
<? LoadLib('buttons'); ?>
</Form>
<? if($CFG->intraNet): ?>
<Div>&raquo;
<A hRef="http://<?=htmlspecialchars($CFG->entry->Host)?>" Target="webCam">Вебморда</A></Div>
<? endif; ?>
&raquo;
Та же камера, интерфейс <A hRef="./<?=htmlspecialchars(hRef('x', 'cam'))?>">для диспетчера</A>
<BR />
&raquo;
GPS-координаты можно записывать в виде dd.ddd (градусы) или dd/dd/dd.d (градусы/минуты/секунды; разделитель любой)
