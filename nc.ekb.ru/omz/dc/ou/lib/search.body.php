<Script> <!--
function Check()
{
 q=document.forms[0].q;
 if(q.value) return true;
 q.focus();
 return false;
}
setTimeout(function(){if((q=document.forms[0]) && (q=q.q) && !q.value.length)q.focus();}, 0);
//--></Script>
<Form Action='./' Method='GET' onSubmit='return Check()'>
<Table><TR vAlign='Bottom'><TD NoWrap>
<?
$CFG->scopes=Array(
  'd'=>'Весь домен',
  't'=>'Всё подразделение',
  'u'=>'Всё УМЗ',
  'o'=>'Только подразделение',
  'c'=>'Компьютеры [uxm]',
  'z'=>'Компьютеры [umz]',
  'C'=>'Все компьютеры'
);
$CFG->defaults->in='t';

$CFG->entry->in=trim($_REQUEST['in']);
if(!$CFG->scopes[$CFG->entry->in])$CFG->entry->in=$CFG->defaults->in;
$CFG->entry->q=trim($_REQUEST['q']);

LoadLib('/forms');
LoadLib('/sort');
$CFG->defaults->Input->extraAttr='Type="search" Required';
Input('q', 'Текст');BR();
unset($CFG->defaults->Input->extraAttr);
echo "</TD><TD NoWrap>";
Select('in', $CFG->scopes, 'Где');
echo "</TD><TD><Input Type=Submit Value='Искать' />";

unset($CFG->params->in);
unset($CFG->params->q);
hiddenInputs();
$CFG->params->in=$CFG->entry->in;
$CFG->params->q=$CFG->entry->q;
?>
</TD></TR></Table>
</Form>
<SMALL>Посмотреть какой пользователь и когда заходил на определенный компьютер можно в <A href='https://ekb.ru/omz/stat/host/'>статистике по компьютерам</A></SMALL>
<?

//функции для коррекции раскладки клавиатуры
function LayToR($s)
{
 $s = strtr($s,"qwertyuiop[]asdfghjkl;'zxcvbnm,./`QWERTYUIOP{}ASDFGHJKL:\"ZXCVBNM<>?~",
"йцукенгшщзхъфывапролджэячсмитьбю.ёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ,Ё");

 return $s;
}

function LayToE($s)
{
 $s = strtr($s,"йцукенгшщзхъфывапролджэячсмитьбю.ёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ,Ё",
"qwertyuiop[]asdfghjkl;'zxcvbnm,./`QWERTYUIOP{}ASDFGHJKL:\"ZXCVBNM<>?~");

 return $s;
}


function searchInLDAP($params_q,$params_in,$odn_str,$AD_baseDN,$AD_h)
{
 LoadLib('/ADobj');
 $func=ldap_search;
 $classFilter=objectClassFilter();
 $Base=$odn_str; //$CFG->odn->str();
 switch($params_in)//$CFG->params->in)
 {
  case 'C':
   $Base=$AD_baseDN;//$CFG->AD->baseDN;
   $classFilter='(objectClass=computer)';
   break;
  case 'c':
   $classFilter='(objectClass=computer)';
   $Base=computersDN();
   break;
  case 'd': 
   $Base=$AD_baseDN;//$CFG->AD->baseDN;
   break;
  case 'o':
   $func=ldap_list;
   break;
  case 'z':
   $classFilter='(objectClass=computer)';
  case 'u':
   $Base = umzDN();
   break;
 }

 $q=$func($AD_h, $Base, $ff="(&$classFilter(anr=".str2ldap($params_q)."*))", Array('objectClass'));
 $e=ldap_get_entries($AD_h, $q);
 ldap_free_result($q);
 for($i=$e['count']-1; $i>=0; $i--)
  if($x=getObject($e[$i]['dn'])) $foundItems[]=$x;

 sortArray($foundItems);
 //echo "<PRE>"; print_r($CFG->currentSort); echo "</PRE>";
 return $foundItems;
}

function printResults($Items)
{
if ($Items):
 sortedHeader('tnfoid');
 foreach($Items as $x):
  echo "<TR><TD>";
  echoObject($x, 'tnfoid');
  echo "</TD></TR>\n";
 endforeach;
 sortedFooter();
endif;

if (!$Items):
echo "<TR><TD>";
echo "Ничего не найдено :-(";
echo "</TD></TR>\n";
endif;

return true;
}

if(!$CFG->params->q) return;

$Items=searchInLDAP($CFG->params->q,$CFG->params->in,$CFG->odn->str(),$CFG->AD->baseDN,$CFG->AD->h);

if (!$Items): //если результат пустой - пробуем восстановить раскладку
//сия шляпа может восстановить как целое слово, так и часть слова в неправильной кодировке
$rItems=searchInLDAP(LayToR($CFG->params->q),$CFG->params->in,$CFG->odn->str(),$CFG->AD->baseDN,$CFG->AD->h);
if ($rItems) $Items=$rItems;
if (!$Items):
$eItems=searchInLDAP(LayToE($CFG->params->q),$CFG->params->in,$CFG->odn->str(),$CFG->AD->baseDN,$CFG->AD->h);
if ($eItems) $Items=$eItems;
endif;
endif;

if ($Items):
 unset($CFG->params->x);
 unset($CFG->params->q);
 unset($CFG->params->in);
endif;
printResults($Items);


function computersDN()
{
 $X=new ufn('../Computers');
 $X=$X->dn();
 return $X->str();
}

function umzDN()
{
 $X=new ufn('../UMZ');
 $X=$X->dn();
 return $X->str();
}

?>
