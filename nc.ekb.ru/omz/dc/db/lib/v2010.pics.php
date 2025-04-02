<?
$CFG->params->pics=' ';
LoadLib('/sort');
$CFG->sort=Array(
    'u'=>Array('field'=>'sAMAccountName', 'name'=>'Юзер', 'title'=>'Пользователь'),
    'c'=>Array('field'=>'cn', 'name'=>'Имя'),
    'd'=>Array('field'=>'ou', 'name'=>'Подразделение'),
    'n'=>Array('field'=>'employeeID', 'name'=>'Табельный №'),
    'j'=>Array('field'=>'jpg', 'name'=>'Фотка'),
    'v'=>Array('field'=>'vID', 'name'=>'ВОХР'),
);
$CFG->defaults->sort='Vc';
AdjustSort();

dbConnect();
$F=explode(' ', 'sAMAccountName cn employeeID');

$z=new UFN();
$z=$z->dn();

$q=ldap_search($CFG->AD->h, $z->str(),
//    '(&(!(thumbnailPhoto=*))(objectCategory=user)(!(UserAccountControl:1.2.840.113556.1.4.803:=2))(employeeID=*))', $F);
    '(&(!(thumbnailPhoto=*))(objectCategory=user)(!(UserAccountControl:1.2.840.113556.1.4.803:=2))(sn=*))', $F);
for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
  $z=ldap_get_attributes($CFG->AD->h, $e);
  unset($i);
  foreach($F as $x)
   $i->$x=utf2str($z[$x][0]);
  if(preg_match('/^\d+$/', $tabN=$i->employeeID)):
   $q=mssql_query("Select Count(*), Max(DataLength(Picture)), Max(ID) From pList Where TabNumber In('$tabN', '0$tabN')");
   $r=mssql_fetch_array($q);
   if(1==$r[0]): $i->jpg=$r[1]; $i->vID=$r[2]; endif;
  endif;
  $u=new DN(ldap_get_dn($CFG->AD->h, $e));
  $u=$u->ufn();
  $u->Cut();
  $i->ou=$u->str();
  $X[]=$i;
endfor;

sortArray($X);
sortedHeader(ucdnjv);
foreach($X as $z):
 echo '<TR><TD><A hRef="../user/', htmlspecialchars(hRef('u', $z->sAMAccountName, 'x', 'photo')), '" Target="userPhoto">', htmlspecialchars($z->sAMAccountName), '</A>',
    '<BR /></TD><TD>', htmlspecialchars($z->cn),
    '<BR /></TD><TD>', htmlspecialchars($z->ou),
    '<BR /></TD><TD>', htmlspecialchars($z->employeeID),
    '<BR /></TD><TD Align="Center">', $z->jpg? '+':'-',
    '<BR /></TD><TD Align="Center">', $z->vID? '<A hRef="./'.htmlspecialchars(hRef('i', $z->vID, 'pics')).'" Target="v2010Card">+</A>':'-',
    '<BR /></TD></TR>';
endforeach;
sortedFooter();
?>
