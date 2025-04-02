<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>№</TH>
<TH>Имя</TH>
<TH>Отозван</TH>
</TR>
<?
if($CFG->Auth):

$h=pfxDB();
#$h->busyTimeout(300);
$s=@$h->prepare("Select Attrs.*, DateTime(Revoke, 'localtime') As Rvk From Certs, Attrs Where Certs.id=Attrs.id And u=?");
if(!$s) return Locked();
$s->bindValue(1, $CFG->rsa->u);
$r=@$s->execute();
if(!$r) return Locked();
$Found=0;
while($z=$r->fetchArray()):
  $Found++;
  echo '<TR><TD><A hRef="/omz/abook/users.ca/?n=', $z[id], '">',  htmlspecialchars($z[serial]), '</A>',
    "<BR /></TD><TD><small>", str_replace('=', '=<WBR>', str_replace('/', '<WBR>/', htmlspecialchars($z[subj]))),
    '<BR /></small></TD><TD title="', htmlspecialchars($z[Rvk]), '">', htmlspecialchars(preg_replace('/\s.*/', '', $z[Rvk])),
    "<BR /></TD></TR>\n";
endwhile;
$Running=0;
$s=@$h->prepare("Select DateTime(ctime, 'localtime') As Start, StrFTime('%s', 'now')-StrFTime('%s', ctime) As s From Run Where Name Collate NoCase=:n");
if(!$s) return Locked();
$s->bindValue(':n', '+'.$CFG->rsa->u);
$r=@$s->execute();
if(!$r) return Locked();
while($z=$r->fetchArray()):
  if(!$Running) echo "<Script><!--\nsetTimeout(function(){location=location.href}, 1024);\n//--></Script>";
  $Running++;
  echo "<TR><TD>?",
    "<BR /></TD><TD>В процессе (", $z[s], " сек)...",
    "<BR /></TD><TD>", htmlspecialchars($z[Start]),
    "<BR /></TD></TR>\n";
endwhile;

if($Found)
 echo '<TR Class="tHeader"><TD ColSpan="3"><A hRef="/omz/abook/?pkcs7&u=', htmlspecialchars(urlencode($CFG->rsa->u)), '">Все</A> в формате PKCS7</TD></TR>';

endif;	// if($CFG->Auth):
?>
</Table>
<?
if(!$CFG->Auth) LoadLib('auth');

if(!$Found) echo "Сертификаты не найдены";

if($CFG->rsa->Creator and 0==$Found+$Running)
 LoadLib('rsa.form', 1);

if($Found)
 LoadLib('rsa.install', 1);

if(!$CFG->params->u) LoadLib('rsa.test', 1);

function Locked()
{ // SQLite3::busyTimeout not implemented -> reload page
?>
</Table>
<Center>
Удостоверяющий центр занят обработкой запросов. Обновите страницу через некоторое время.
</Center>
<Script><!--
setTimeout(function(){location=location.href}, 1234);
//--></Script>
<?
}
?>
