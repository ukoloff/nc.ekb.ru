<Table Border CellSpacing=0><TR><TH Align=Right>
<?
$e=getEntry($CFG->gdn, "sAMAccountName groupType description info whenCreated whenChanged");
$groupType=$e['grouptype'][0];
echo "���</TH><TD>", (($groupType & 0x80000000) ? 'Security' : 'Distribution'), "</TD></TR>
<TR><TH Align='Right'>Scope</TH><TD>";
$S='';
foreach(Array(1=>'���������', 2=>'����������', 4=>'�����', 8=>'�������������') as $k=>$v)
 if($groupType & $k):
  if($S)$S.="<BR />";
  $S.=$v;
 endif;
echo $S;
?>
<BR /></TD></TR>
<TR><TH Align='Right'>��������</TD><TD><Small><?=utf2html($e['description'][0])?>
<BR /></Small></TD></TR>
<TR><TH Align='Right'>�������</TD><TD><?=nl2br(utf2html($e['info'][0]))?>
<BR /></TD></TR>
<?
 setlocale(LC_ALL, "ru_RU.cp1251");

 foreach(Array('��������'=>'created', '���������'=>'changed') as $k=>$v):
  echo "<TR><TH>$k</TH><TD>";
  $DT=utf2str($e["when$v"][0]);
  $DT=gmmktime(substr($DT, 8, 2), substr($DT, 10, 2), substr($DT, 12, 2), 
	    substr($DT, 4, 2), substr($DT, 6, 2), substr($DT, 0, 4));
  echo strftime("%x %X", $DT),  "</TD></TR>\n";
 endforeach;

?>
<TR><TH Align='Right'>������</TD><TD>
<?
$q=ldap_read($CFG->h, $CFG->gdn, 'member=*', array(''));
$n=ldap_count_entries($CFG->h, $q);
ldap_free_result($q);
echo ($n? "���" : "��, <A hRef='./".hRef('x', 'delete')."'>�������</A>");
?>
</TD></TR></Table>
