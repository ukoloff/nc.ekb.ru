<?
require('../../../lib/uxm.php');
LoadLib('/sort');

global $CFG;
$CFG->sort=Array(
    'c'=>Array('field'=>'c', 'name'=>'Класс'),
    'n'=>Array('field'=>'n', 'name'=>'Кол-во'),
    'd'=>Array('field'=>'Desc', 'name'=>'Описание'),
);
$CFG->defaults->sort='c';


uxmHeader('Почтовые классы');
?>
<H1>Почтовые классы</H1>

<?

$q=ldap_search($CFG->h, $CFG->Base, 
    "(&(objectClass=sendmailMTAClass)(sendmailMTAHost=".str2ldap($CFG->Sendmail->Domain)."))", 
    Array('sendmailMTAClassName', 'Description', 'sendmailMTAClassValue'));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
for($i=$e['count']-1; $i>=0; $i--):
 unset($z);
 $z->c=utf2str($e[$i]['sendmailmtaclassname'][0]);
 $z->n=0+$e[$i]['sendmailmtaclassvalue']['count'];
 $z->Desc=utf2str($e[$i]['description'][0]);
 $X[]=$z;
endfor;

sortArray($X);

sortedHeader('cnd');

foreach($X as $z)
 echo "<TR><TD Align='Center'><A hRef='../class/", hRef('c', $z->c), "'>", 
    htmlspecialchars($z->c), "</A><BR /></TD><TD Align='Right'>", $z->n, 
    "</TD><TD><Small>", htmlspecialchars($z->Desc), "<BR /></Small></TD></TR>\n";

sortedFooter();

?>
&raquo;
<A hRef='../class/?x=new'>Создать новый класс</A>
</body></html>
