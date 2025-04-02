<?
global $CFG;

$q=odbtp_query("Select ID, Name, FirstName, MidName, TabNumber, Address, DataLength(Picture) As szPic,
CONVERT(varchar(100), BirthDate, 104) AS Birth, CONVERT(varchar(100), ChangeTime, 121) AS Chg,
(Select Name From pDivision Where ID=Section) As Dept,
(Select Name From pPost Where ID=Post) As Title,
(Select Name From pCompany Where ID=Company) As Org,
(Select CONVERT(varchar(100), Max(TimeVal), 121) From pLogData Where Event=32 And HozOrgan=ID) As PassTime
From pList
Where ID=".$CFG->i);

$r=odbtp_fetch_assoc($q);

$CFG->Attrs[]=Array('Name'=>'Фамилия', 'Value'=>$r['Name'], 'Field'=>'sn');
$CFG->Attrs[]=Array('Name'=>'Имя', 'Value'=>$r['FirstName'], 'Field'=>'givenName');
$CFG->Attrs[]=Array('Name'=>'Отчество', 'Value'=>$r['MidName'], 'Field'=>'middleName');
$CFG->Attrs[]=Array('Name'=>'Табельный №', 'Value'=>preg_replace('/^0+/', '', $r['TabNumber']), 'Field'=>'employeeID');
$CFG->Attrs[]=Array('Name'=>'Должность', 'Value'=>$r['Title'], 'Field'=>'title');
$CFG->Attrs[]=Array('Name'=>'Подразделение', 'Value'=>$r['Dept']);
$CFG->Attrs[]=Array('Name'=>'Крайний проход', 'Value'=>$r['PassTime']);
$CFG->Attrs[]=Array('Name'=>'Компания', 'Value'=>$r['Org']);
$CFG->Attrs[]=Array('Name'=>'Дата рождения', 'Value'=>preg_match('/\.1899$/', $r['Birth'])? '-':$r['Birth']);
$CFG->Attrs[]=Array('Name'=>'Адрес', 'Value'=>$r['Address']);
$CFG->Attrs[]=Array('Name'=>'Модификация', 'Value'=>$r['Chg']);
if($r['szPic'])
$CFG->Attrs[]=Array('Name'=>'Фотка', 'Value'=>'Есть', 'X-Value'=>'v2010/'.$CFG->i, 'URL'=>'/dc/ext/img/?i='.$CFG->i, 'Field'=>'imgURL');

/*
$dn=user2dn('stas');
$q=odbtp_query('Select Picture From pList Where ID=2181');
$r=odbtp_fetch_array($q);
echo "//LDAP_ADD=", ldap_mod_add($CFG->h, $dn, Array('jpegPhoto'=>$r[0])), "\n";
echo "// ", ldap_error($CFG->h), ": $dn \n";

//ldap_modify($CFG->h, user2dn('stas'), Array('jpegPhoto'=>Array()));
$e=getEntry(user2dn('stas'));
$f=fopen('/var/tmp/xxx.jpg', 'w'); fwrite($f, 'E='.user2dn('stas')."\n".var_export($e, true)."\n..."); fclose($f);
*/
/*
$f=fopen('/var/tmp/yyy.jpg', 'w'); 
$q=ldap_read($CFG->h, user2dn('stas'), 'objectClass=*');
fwrite($f, "q=$q\n");
$r=ldap_get_values_len($CFG->h, ldap_first_entry($CFG->h, $q), 'jpegPhoto');
fwrite($f, var_export($r, true)); fclose($f);
*/
?>
