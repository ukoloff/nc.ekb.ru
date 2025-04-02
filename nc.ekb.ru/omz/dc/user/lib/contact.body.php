<Script><!--

function translite(str){
 var arr={'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 
 'ж':'zh', 'з':'z', 'и':'i', 'й':'y', 'к':'k', 'л':'l', 'м':'m',
 'н':'n', 'о':'o', 'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u',
 'ф':'f', 'ы':'y', 'э':'e', 'А':'A', 'Б':'B', 'В':'V', 'Г':'G',
 'Д':'D', 'Е':'E', 'Ж':'Zh', 'З':'Z', 'И':'I', 'Й':'Y', 'К':'K',
 'Л':'L', 'М':'M', 'Н':'N', 'О':'O', 'П':'P', 'Р':'R', 'С':'S',
 'Т':'T', 'У':'U', 'Ф':'F', 'Ы':'Y', 'Э':'E', 'ё':'yo', 'х':'kh',
 'ц':'ts', 'ч':'ch', 'ш':'sh', 'щ':'shch', 'ю':'yu',
 'я':'ya', 'Ё':'Yo', 'Х':'Kh', 'Ц':'Ts', 'Ч':'Ch', 'Ш':'Sh', 'Щ':'Shch',
 'Ъ':'', 'Ь':'','Ю':'Yu', 'Я':'Ya'};
 var replacer=function(a){
if ((a=='ъ')||(a=='ь')){return '';}else
return arr[a]||a;
};
 return str.replace(/[А-яёЁ]/g,replacer)
}

function defNames()
{
 f=document.forms[0];
 cn=f.cn;
 cn.focus();
 s=f.sn.value;
 s2='';
 x=f.givenName.value.substring(0, 1);
 if(x)
 { 
  s2=x+'.';
  if(s) s+=' '; s+=s2; 
 }
 x=f.middleName.value.substring(0, 1);
 if(x)
 {
  s+=x+'.';
  s2+=x+'.';
 }
 if(!cn.value || (cn.value!=s && confirm('Изменить значения поля "<?= $CFG->Fields['cn']?>"?'))) 
  cn.value=s;
 s=(f.sn.value+' '+f.givenName.value+' '+f.middleName.value).replace(/\s+$/, '');
 cn=f.displayName;
 if(!cn.value || (cn.value!=s && confirm('Изменить значения поля "<?= $CFG->Fields['displayName']?>"?'))) 
  cn.value=s;
 u=f.u;
 if(!u.value){
 u.focus();
 u.value=translite(f.givenName.value.substring(0, 1) + '.' + f.sn.value);
 }
}

function Valid()
{
 f=document.forms[0];
 x=f.u;
 if(!x.value) { alert('Введите учётную запись!'); x.focus(); return false;}
 x=f.cn;
 if(!x.value) { alert('Введите имя пользователя!'); x.focus(); return false; }
 return true;
}
//--></Script>
<Form Action='./' Method='POST' onSubmit='return Valid()'>
<Input Type='Hidden' Name='imgURL' Value="<?=htmlspecialchars($CFG->entry->imgURL)?>" />
<?
LoadLib('/forms');

if(!$CFG->udn):		// Это не contact, это new
 Input('u', 'Учётная запись [<A hRef="../check/" Target="checkWindow">Проверить</A>]');
 BR();
 unset($CFG->params->u);
 echo "<Script Src='ajax.js'></Script>";
endif;
//$CFG->defaults->Input->W=45;
//$CFG->defaults->Input->maxWidth=1;
//Input('ou', 'Подразделение');
unset($CFG->params->ou);
//unset($CFG->defaults->Input->maxWidth);
$CFG->defaults->Input->W=31;
$CFG->defaults->Input->H=4;
?>
<Table Width='100%'><TR vAlign='top'>
<?
$N=0;
foreach($CFG->Fields as $k=>$v):
 switch($N++)
 {
  case 5:	echo "<Small>&raquo; <A hRef=# onClick='defNames(); return false;'>Установить</A> другие поля<BR />по Ф.И.О.</Small>";
  case 10:	echo "</TD>\n";
  case 0:	echo "<TD NoWrap>";
 }
 if('='==$v{0}):
  TextArea($k, substr($v, 1));
 else:
  Input($k, $v);
  echo "<BR />\n";
 endif;
endforeach;
hiddenInputs();
?>
</TD></TR></Table>
<? Submit(); ?>
</Form>
<HR /><Small>
<BR/>&raquo;
Поиск по 
<A hRef='../db/' Target='extDB'>внешним базам</A>
</Small>
