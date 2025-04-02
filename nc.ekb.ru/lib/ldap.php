<? // Библиотека доступа к AD via LDAP
if(!function_exists('ldap_connect'))	dl('ldap.so');

define('uac_ACCOUNTDISABLE', 0x0002);
define('uac_PASSWD_CANT_CHANGE', 0x0040);	// Не работает, реализовано через политики
define('uac_DONT_EXPIRE_PASSWORD', 0x10000);

global $CFG;
ReadConf();
/***
$CFG->h=ldap_connect($CFG->uri) or die("Cannot connect to LDAP!");
ldap_set_option($CFG->h, LDAP_OPT_REFERRALS, 0);
ldap_set_option($CFG->h, LDAP_OPT_PROTOCOL_VERSION, $CFG->ldapV);
ldap_start_tls($CFG->h)	or die(ldap_error($CFG->h).": Cannot StartTLS!");
stdBind() or die(ldap_error($CFG->h).": Invalid connection to LDAP!");
***/

# Преобразовать строку в кодировку UTF-8
function utf8($S)
{
 global $CFG;
 return iconv($CFG->charSet, "UTF-8", $S);
}

# Преобразовать строку из кодировки UTF-8
function utf2str($S)
{
 global $CFG;
 return iconv("UTF-8", $CFG->charSet, $S);
}

function utf2html($S)
{
 return htmlspecialchars(utf2str($S));
}

# Вспомогательная функция, аналог split, но учитывает \...
function &escSplit($char, $str, $count=0)
{
 $Res=Array();
 while(true):
  if($count>0 and count($Res)+1>=$count):
   array_push($Res, $str);
   return $Res;
  endif;
  $start='';
  while(true):
   $p=strpos($str, $char);
   if(false===$p):
    array_push($Res, $start.$str);
    return $Res;
   endif;
   $start.=substr($str, 0, $p);
   $str=substr($str, $p+strlen($char));
   if(!preg_match("/\\\\+$/", $start, $matches)) break;	// Нет \ перед разделителем
   if(0==(1&strlen($matches[0]))) break;		// Чётное число \ перед разделителем
   $start.=$char;
  endwhile;
  array_push($Res, $start);
 endwhile;
}

# Добавляет \ перед указанными символами, если уже не добавлено
function &smartAddSlashes($S, $Chars='(*)')
{
 for($i=strlen($Chars)-1; $i>0; $i--)
  if("\\"!=($c=$Chars{$i}))
   $S=join("\\$c", escSplit($c, $S));
 return $S;
}

function dnCanonify($dn)
{
 global $CFG;
 if(!($e=ldap_read($CFG->h, $dn, 'objectClass=*', array('distinguishedname')))) return;
 if(!($e=ldap_get_entries($CFG->h, $e))) return;
 return $e[0]['distinguishedname'][0]; 
}

class dn
{	// Содержит dn в разобранном виде (UTF-8)
 var $X=Array();
 function dn($dn)
 {
  foreach(escSplit(',', dnCanonify($dn)) as $rdn):
   $y=Array();
   foreach(escSplit('+', $rdn) as $pair):
    list($k, $v)=escSplit('=', $pair, 2);
    $y[stripSlashes(strtolower(trim($k)))]=stripSlashes($v);
   endforeach;
   $this->X[]=$y;
  endforeach;
 }

 function &Cut()	// Отрезать объект, оставшись контейнером
 {
  return array_shift($this->X);
 }

 function Paste($key, $value)	// Добавить потомка
 {
  array_unshift($this->X, array($key=>$value));
 }

 function rdn($n=1)	// Отрезать контейнер, оставив только rdn
 {
  while(count($this->X)>$n) array_pop($this->X);
 }

 function ufn()
 {
  global $CFG;
  if(!$CFG->dnBase) $CFG->dnBase=new dn($CFG->Base);
  $bdn=&$CFG->dnBase;
  for($i=count($this->X)-1, $j=count($bdn->X)-1; $j>=0; $i--, $j--)
    if($this->X[$i]!==$bdn->X[$j]) return;
  $R=new ufn('/');
  for(; $i>=0; $i--)
   $R->X[]=array_values($this->X[$i]);
  return $R;
 }

 function str()
 {
  define(dnMasqChars, "+,=\"\\");
  $S='';
  foreach($this->X as $y):
   $rdn='';
   foreach($y as $k=>$v):
    if($rdn)$rdn.='+';
    $rdn.=addCSlashes($k, dnMasqChars).'='.addCSlashes($v, dnMasqChars);
   endforeach;
   if($S) $S.=",";
   $S.=$rdn;
  endforeach;
  return $S;
 }

 function Canonic()
 {
  return dnCanonify($this->str());
 }

 function isParentOf($dn)
 {
  if(!is_object($dn)) $dn=new dn($dn);
  for($i=count($this->X)-1, $j=count($dn->X)-1; $i>=0; $i--, $j--)
   if($this->X[$i]!=$dn->X[$j]) return false;
  return true;
 }
}

$CFG->DIT->attr='OU';		// Атрибут для перевода ufn->dn
$CFG->DIT->Root='uxm';		// Корень дерева (ufn='')

class ufn
{	// Содержит UserFriendlyName в разобранном виде (UTF-8)
 var $X=Array();

 function ufn($ufn='')
 {
  global $CFG;
  if('/'==$ufn{0}):
   $ufn=substr($ufn, 1);
  else:
   if(''!=$ufn) $ufn='/'.$ufn;
   $ufn=$CFG->DIT->Root.$ufn;
  endif;
  if(!$ufn) return;
  foreach(escSplit('/', $ufn) as $y):
   $z=Array();
   foreach(escSplit('+', $y) as $r) $z[]=utf8(StripSlashes($r));
   $this->X[]=$z;
  endforeach;
 }

 function &Cut()	// Отрезать объект, оставшись контейнером
 {
  return array_pop($this->X);
 }

 function Paste($value)	// Добавить потомка
 {
  $this->X[]=Array($value);
 }

 function &dn()
 {
  global $CFG;
  $d=new dn($CFG->Base);
  foreach($this->X as $y)
   array_unshift($d->X, Array($CFG->DIT->attr=>$y[0]));
  return $d;
 }

 function str()
 {
  global $CFG;
  define(ufnMasqChars, '/+\\');
  if(0>=count($this->X)) return '/';
  $S='';
  foreach($this->X as $y):
   $z='';
   foreach($y as $r):
    if($z) $z.='+';
    $z.=addCSlashes(utf2str($r), ufnMasqChars);
   endforeach;
   $S.='/';
   $S.=$z;
  endforeach;
  $R="/".$CFG->DIT->Root;
  if($R==$S) return '';
  $R.='/';
  if(substr($S, 0, strlen($R))==$R)
    $S=substr($S, strlen($R));
  return $S;
 }
}

# Прочитать файл /etc/ldap.conf
function ReadConf()
{
 global $CFG;
// foreach(array('posixgroup', 'posixaccount') as $k) $CFG->class->$k=$k;
// foreach(array('uid'=>'uid', 'gid'=>'cn') as $k=>$v) $CFG->attr->$k=$v;
 $CFG->ldapV=3;
 $CFG->charSet='Windows-1251';

 $optS=array('URI'=>'uri', 'BINDDN'=>'bindDn', 'BINDPW'=>'bindPw', 'BASE'=>'Base', 'LDAP_VERSION'=>'ldapV');
// $optA=array('NSS_MAP_ATTRIBUTE'=>'attr', 'NSS_MAP_OBJECTCLASS'=>'class');

 $f=fopen(dirname(__FILE__).'/ldap.ini', 'r');
 if(!$f) return;
 while(!feof($f)):
  list($k, $v)=preg_split('/\s+/', trim(preg_replace('/#.*$/', '', fgets($f))), 2);
  $k=strtoupper($k);
  if($x=$optS[$k]):
   $CFG->$x=$v;
//  elseif($x=$optA[$k]):
//   list($k, $v)=preg_split('/\s+/', $v);
//   $k=strtolower($k);
//   $CFG->$x->$k=$v;
  endif;
 endwhile;
 fclose($f);
// $CFG->uri=strtr($CFG->uri, Array('ldap://'=>'ldaps://'));
}

# Преобразовать строку в вид, подходящий для LDAP-фильтра
function str2ldap($s)
{
 return AddCSlashes(utf8($s), '(*)\\');
}

# Найти объект по полю sAMAccountName
function id2dn($id)
{
 global $CFG;
 if(!$id) return;
 $r=ldap_search($CFG->h, $CFG->Base, "sAMAccountName=".str2ldap($id), array(''));
 $dn='';
 if(1==ldap_count_entries($CFG->h, $r)):
  $dn=ldap_get_entries($CFG->h, $r);
  $dn=$dn[0]['dn'];
 endif;
 ldap_free_result($r);
 return $dn;
}

function accountUsed($u)
{
 return id2dn($u)? true : false;
}

# Найти юзеря в AD
function user2dn($u='')
{
 global $CFG;
 if(!$u) $u=$CFG->u;
 if(!$u) return;
 if(isset($CFG->users->$u)) return $CFG->users->$u;
 $r=ldap_search($CFG->h, $CFG->Base, "(&(objectClass=User)(sAMAccountName=".str2ldap($u)."))", array(''));
 $dn='';
 if(1==ldap_count_entries($CFG->h, $r)):
  $dn=ldap_get_dn($CFG->h, ldap_first_entry($CFG->h, $r));
 endif;
 ldap_free_result($r);
 return $CFG->users->$u=$dn;
}

# Найти группу в AD
function group2dn($g)
{
 global $CFG;
 if(!$g) return;
 if(isset($CFG->groups->$g)) return $CFG->groups->$g;
 $r=@ldap_search($CFG->h, $CFG->Base, "(&(objectClass=Group)(sAMAccountName=".str2ldap($g)."))", array(''));
 if(!$r) return;
 $dn='';
 if(1==ldap_count_entries($CFG->h, $r)):
  $dn=ldap_get_dn($CFG->h, ldap_first_entry($CFG->h, $r));
 endif;
 ldap_free_result($r);
 return $CFG->groups->$g=$dn;
}

# Подключиться к AD вспомогательным пользователем
function stdBind()
{
 return;
 global $CFG;
 return ldap_bind($CFG->h, utf8($CFG->bindDn), utf8($CFG->bindPw));
}

# Попытка войти в AD с именем/паролем
function ldapCheckPass($u, $p)
{
 return;

 global $CFG;
 if(!strlen($u) or !strlen($p)) return false;
 $dn=user2dn($u);
 if(!$dn) return false;
 if(@ldap_bind($CFG->h, $dn, utf8($p))) return true;
 stdBind();
 return false;
}

# Объект прямо прописан в группе?
function dnInGroup($odn, $gdn)
{
 global $CFG;
 if(!$odn or !$gdn)	return 0;
 $r=ldap_read($CFG->h, $odn, "memberOf=".AddCSlashes($gdn, '(*)\\'), array(""));
 $n=ldap_count_entries($CFG->h, $r);
 ldap_free_result($r);
 return $n>0;
}

# Юзверь прямо прописан в группе?
function inGroup($g, $u='')
{
 return dnInGroup(user2dn($u), group2dn($g));
}

# Объект прописан в группе прямо или через подгруппы?
function dnInGroupX($odn, $gdn)
{
 global $CFG;
 if(!$odn or !$gdn)	return 0;
 $dns[$odn]=1;
 while(count($dns)):
  reset($dns);
  $dn=key($dns);
  $level=$dns[$dn];
  unset($dns[$dn]);
  $xdns[$dn]=1;
  $r=ldap_read($CFG->h, $dn, "objectClass=*", array("memberOf"));
  $e=ldap_get_entries($CFG->h, $r);
  ldap_free_result($r);
  $e=$e[0][$e[0][0]];
  for($i=$e['count']-1; $i>=0; $i--):
   $cdn=$e[$i];
   if($cdn==$gdn) return $level;
   if($dns[$cdn] or $xdns[$cdn]) continue;
   $r=ldap_read($CFG->h, $cdn, "objectClass=Group", array(""));
   $n=ldap_count_entries($CFG->h, $r);
   ldap_free_result($r);
   if($n==1)	$dns[$cdn]=1+$level;
  endfor;
 endwhile;
 return 0;
}

# Юзверь прописан в группе прямо или через подгруппы?
function inGroupX($g, $u='')
{
 return dnInGroupX(user2dn($u), group2dn($g));
}

# Получить все (или указанные) атрибуты
function getEntry($dn, $attrs='')
{
 global $CFG;
 if(!$dn) return;
 if(is_array($attrs));
 elseif($attrs)$attrs=preg_split('/\s+/', $attrs);
 else $attrs=array();
 $r=@ldap_read($CFG->h, $dn, "objectClass=*", $attrs);
 if(!$r) return;
 $e=ldap_get_entries($CFG->h, $r);
 ldap_free_result($r);
 $e=$e[0];
 return $e;
}

function dn2user($dn)
{
 $e=getEntry($dn, 'sAMAccountName');
 if(!$e) return $e;
 return $e['samaccountname'][0];
}

?>
