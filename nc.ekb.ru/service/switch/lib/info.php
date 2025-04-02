<?
global $CFG;

LoadSwitches();

function LoadInfo($n)
{
 global $CFG;
 $s=sqlite3_query($CFG->db, "Select * From SwitchX Where No=".$n);
 $r=sqlite3_fetch_array($s);
 sqlite3_query_close($s);
 return $r;
}

function PutTable($r)
{
 echo "<Table Border CellSpacing='0'>";
 foreach(Array(
    'Host'=>'Имя',
    'Name'=>'Название',
    'snmpName'=>'SNMP-название',
    'Location'=>'Расположение',
    'Contact'=>'Контакт',
    'Descr'=>'Описание',
    'IP'=>'IP-Адрес',
    'Mac'=>'MAC-Адрес',
    'Ports'=>'Активных портов',
    'Macs'=>'Активных MAC-ов',
    )as $k=>$v)
   echo "<TH Align='Right'>$v</TH><TD>", nl2br(htmlspecialchars($r[$k])), "<BR /></TD></TR>\n";
 echo "<TH Align='Right'>Управление</TH><TD><A Target='_blank' hRef='http://",
    urlencode($r['Host']), "'>http://", htmlspecialchars($r['Host']), "</A></TD></TR></Table>\n";
}

function LoadSwitches()
{
 global $CFG;
 $CFG->Sw=Array();
 $s=sqlite3_query($CFG->db, "Select No, Host, Name From SwitchX Order By Host");
 
 while($r=sqlite3_fetch_array($s))
   $CFG->Sw[]=$r;
 sqlite3_query_close($s);
}

function SwitchSelector($param='n')
{
 global $CFG;

 echo "<Small>";
 foreach($CFG->Sw as $k=>$v)
  echo "&raquo;<A hRef='./", htmlspecialchars(hRef($param, $v['No'])),
    "' Title='", htmlspecialchars($v['Name']), "'>",
    htmlspecialchars(preg_replace('/(\.switch)?\.uxm$/', '', $v['Host'])), "</A>\n";
 echo "</Small>";
}

?>
