<? // Поиск пользователей без картинок
//doDebug();
$F=explode(' ', 'sAMAccountName cn employeeID');

$z=new UFN();
$z=$z->dn();

$Users = Array();
$tabNos = Array();

$q=ldap_search($CFG->AD->h, $z->str(),
    '(&(!(thumbnailPhoto=*))(!(jpegPhoto=*))(objectCategory=user)(!(UserAccountControl:1.2.840.113556.1.4.803:=2))(sn=*)(employeeID=*))', $F);
for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
  $z=ldap_get_attributes($CFG->AD->h, $e);
  unset($i);
  foreach($F as $x)
    $i->$x=utf2str($z[$x][0]);
  if(!preg_match('/^\d+$/', $tabN=$i->employeeID)) continue;
  $i->dn = ldap_get_dn($CFG->AD->h, $e);
  $Users[] = $i;
  $tabNos[$tabN] = 0;
  $tabNos['0'.$tabN] = 0;
endfor;

if(count($tabNos)):
  dbConnect();
  $Qs = str_repeat('?,', count($tabNos)-1).'?';
  $s = $CFG->sigur->prepare(<<<SQL
    Select ID, TABID
    From personal P
    Where TABID in ($Qs)
    And Exists(Select * From photo X Where X.ID=P.ID)
SQL
  );
  $s->execute(array_keys($tabNos));
  $tabNos = Array();
  while($row = $s->fetch()):
    $tabNos[$row[1]][]=$row[0];
  endwhile;
endif;

function toArray($x) {
    return is_array($x)? $x : Array();
}

$Us = Array();
foreach($Users as $u):
  $ids = toArray($tabNos[$u->employeeID]) + toArray($tabNos['0'.$u->employeeID]);
  if(!count($ids)) continue;
  $u->ids = $ids;
  $dn=new DN($u->dn);
  $ufn=$dn->ufn();
  $ufn->Cut();
  $u->ou=$ufn->str();
  $Us[] = $u;
endforeach;
$Users = Array();
$tabNos = Array();

$CFG->params->blind=' ';
LoadLib('/sort');
$CFG->sort=Array(
    'u'=>Array('field'=>'sAMAccountName', 'name'=>'Юзер', 'title'=>'Пользователь'),
    'c'=>Array('field'=>'cn', 'name'=>'Имя'),
    'd'=>Array('field'=>'ou', 'name'=>'Подразделение'),
    'n'=>Array('field'=>'employeeID', 'name'=>'Табельный №'),
    'v'=>Array('field'=>'vID', 'name'=>'ВОХР'),
);
$CFG->defaults->sort='Vc';
AdjustSort();

sortArray($Us);
sortedHeader('ucdnv');
$CFG->params->blind='';
foreach($Us as $u):
  echo '<tr><td><a href="../user/', htmlspecialchars(hRef('u', $u->sAMAccountName, 'x', 'photo')), '" target="userPhoto">', 
	htmlspecialchars($u->sAMAccountName), '</a><br /></td><td>', 
	htmlspecialchars($u->cn), '<br /></td><td>', 
	htmlspecialchars($u->ou), '<br /></td><td>', 
	htmlspecialchars($u->employeeID), '</td><td align="center">';
  if (count($u->ids)==1):
    echo '<a href="./', htmlspecialchars(hRef('i', $u->ids[0])), '" target="sigur">&raquo;</a>';
  else:
    echo '<a href="./', htmlspecialchars(hRef('q', $u->employeeID, 'as', 'n')), '" target="sigur">', count($u->ids), '</a>';
  endif;
  echo	'<br /></td></tr>';
endforeach;
sortedFooter();
?>
