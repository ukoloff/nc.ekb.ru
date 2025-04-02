<Form Action='./' Method='Post'>
<?
//global $CFG;

LoadLib('/forms');

if(!$CFG->Directum->h)
  echo "<H2 Class='Error'>Вы не имеете права на просмотр этой информации</H2>\n";

HiddenInputs();
?>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>База</TH><TH>Пользователь Directum</TH><TH>Пользователь SQL</TH></TR>
<?
$N=0;
foreach($CFG->Directum->DBs As $DB):
 echo "<TR><TD>", htmlspecialchars($DB), "</TD><TD><Input Type='CheckBox' Disabled ";
 $x='User'.$N;
 if($CFG->Directum->Entry->$x) echo " Checked />\n", 
    htmlspecialchars($CFG->Directum->Entry->$x->Mode), 
    userStatus($CFG->Directum->Entry->$x->X), 
    ": ", htmlspecialchars($CFG->Directum->Entry->$x->Name);
 else echo "/>";
 echo "</TD><TD>";
 CheckBox("Role".$N, $CFG->Directum->Entry->$x->U);
 echo "</TD></TR>\n";
 $N++;
endforeach;
?>
</Table>
<Table Width='100%'><TR><TD>
<?
CheckBox("Login", 'Право входа на сервер');
echo "</TD><TD Align='Right'>";
Submit();
echo "</TD></TR></Table></Form>";

function userStatus($s)
{
 switch($s)
 {
  case 'П': return '';
  case 'А': return '!';	//админ
  case 'О': return '#';	//отключён
  case 'Р': return '*';	//разработчик
 }
 return '?';
}

?>
<Small>
&raquo;
Для того, чтобы пользователь мог войти в БД Directum, необходимо, чтобы было:
<UL>
<LI><s>Право входа на сервер</s> (не требуется в Directum 5)
<LI>Создан пользователь SQL в этой БД
<LI>Создан пользователь Directum в этой БД
<LI>Тип авторизации пользователя - Windows (W)
<LI>Пользователь не заблокирован (#)
</UL>
&raquo;
Пользователь Directum может создаваться/удаляться только в самом Directum

<HR />
<h2>Сертификаты</h2>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>База</TH><TH>№</TH><TH>CN</TH><TH>Info</TH><TH>Тип</TH><TH>Default</TH><TH>Кол-во</TH></TR>
<?
foreach($CFG->Directum->DBs As $DB):
 mssql_select_db($DB, $CFG->Directum->h);
 $q=mssql_query(<<<SQL
Select
 T.*,
 (Select Count(*)From SBEDocSignature Where Author=P.Analit) As N
From
 mbUser U, mbAnalit P, mbVidAn V, MBAnValR2 T
Where
 U.NeedEncode='W' And U.UserKod=P.Dop And
 P.Vid=V.Vid And V.Kod='ПОЛ' And T.Analit=P.Analit
 And U.UserLogin=
SQL
    .mssql_escape($CFG->params->u));
 while($r=mssql_fetch_assoc($q)):
  echo "<!--"; print_r($r); echo "-->";
  echo "<TR><TD>", htmlspecialchars($DB),
    "<BR /></TD><TD>", '<A hRef="./', htmlspecialchars(hRef('cer', $r[NumStr], 'db', $DB)), '">', htmlspecialchars($r[NumStr]), '</A>',
    "<BR /></TD><TD>", htmlspecialchars($r[StrokaT2]), 
    "<BR /></TD><TD>", htmlspecialchars($r[CertificateInfo]), 
    "<BR /></TD><TD>", cerType($r[CertificateType]), 
    "<BR /></TD><TD>", cerDef($r[DefaultCert]), 
    "<BR /></TD><TD>", '<A hRef="/omz/stat/?x=sig&u=', htmlspecialchars(urlencode($CFG->params->u)), '" Target="_blank">', htmlspecialchars($r[N]), '</A>',
    "<BR /></TD></TR>\n";
 endwhile;

endforeach;

function cerType($c)
{
 switch($c)
 {
  case 'и': return 'ЭЦП и шифрование';
  case 'Э': return 'ЭЦП';
  case 'Ш': return 'Шифрование';
 }
 return '?';
}

function cerDef($c)
{
 switch($c)
 {
  case 'Д': return 'Да';
  case 'Н': return 'Нет';
 }
 return '?';
}

?>
</Table>
<!--
&raquo;
Если у пользователя есть <A hRef="./<?=htmlspecialchars(hRef('x', 'rsa'))?>">сертификат</A>, то он будет добавлен в Directum автоматически
-->
<? if($CFG->intraNet): ?>
&raquo;
Если в этом списке есть не все сертификаты с вкладки <A hRef="./<?=htmlspecialchars(hRef('x', 'pki'))?>">ЭЦП</A>, то можно ускорить их копирование в СЭД, запустив соответствующее задание на сервере Directum.
<?  endif; ?>
