<?
global $CFG;

require("../../../lib/uxm.php");

if('POST'==$_SERVER['REQUEST_METHOD']):
  for($n=0+$_POST['N']-1; $n>=0; $n--)
    if($_POST["c$n"])
      sqlite3_exec($CFG->db, "Insert Into Switch(Host) Values(".sqlite3_escape($_POST["n$n"]).")");
endif;

uxmHeader('Добавление коммутаторов');
?>
<H1>Добавление коммутаторов</H1>

<Form Action='./' Method='POST'>
<Table><TR vAlign='top'><TD>
<?
$q=ldap_search($CFG->h, $CFG->Base, 'DC=*.switch', Array('DC'));
$i=0;
$All=Array();
for($e=ldap_first_entry($CFG->h, $q); $e; $e=ldap_next_entry($CFG->h, $e)):
  $a=ldap_get_attributes($CFG->h, $e);
  $z=$a['dc'][0];
  if(!$z) continue;
  $z.='.uxm';
//  $i++;
  $All[]=$z;
endfor;

sort($All);

for($i=0; $i<count($All); $i++):
  $q=sqlite3_query($CFG->db, "Select Count(*) From Switch Where Host=".sqlite3_escape($All[$i]));
  $q=sqlite3_fetch($q);
  $q=$q[0]? '': 'Checked ';
  
  echo "<Input Type='Checkbox' Name='c$i' id='i$i' $q/> <Label For='i$i'>{$All[$i]}</Label><Input Type='Hidden' Name='n$i' Value='", 
    htmlspecialchars($All[$i]), "' /><BR />";
endfor;
?>
<Input Type='Hidden' Name='N' Value='<?=count($All)?>' />
</TD><TD>
<Input Type='Submit' Value=' Добавить! ' />
</TD></TR></Table>
</Form>

</body></html>
