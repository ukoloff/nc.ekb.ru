<link REL=STYLESHEET TYPE='text/css' HREF='/omz/stat/stat.css'>
<?
$CFG->params->pass=1;
dbConnect();

$CFG->params->i=0+trim($_GET['i']);
if($CFG->params->i<=0)$CFG->params->i=-112;
?>
<?
//odbtp_execute('Set Language Russian');
//$q=odbtp_allocate_query();
/*
odbtp_prepare('Select Count(*) From pLogData Where Event=32 And HozOrgan=? Order By 1 Desc');
odbtp_input($q, 1);
odbtp_set($q, 1, $CFG->params->i);
odbtp_execute($q);
$r=odbtp_fetch_array($q);
$Start=pageStart($r[0]);

pageNavigator();
*/
?>
<Table Border Width='100%' CellSpacing='0'><TR Class='tHeader'>
<TH>����</TH>
<TH>����</TH>
<TH>�����</TH>
<TH>��������</TH>
<TH>�����������</TH>
<TH>��������</TH>
</TR>
<?
$CFG->defaults->m=date("Ym");
if(!preg_match('/^\d{6}$/', $CFG->params->m=trim($_REQUEST['m']))
    or !checkdate(substr($CFG->params->m, 4, 2), 1, substr($CFG->params->m, 0, 4)))
 $CFG->params->m=$CFG->defaults->m;

$d1=chunk_split($CFG->params->m, 4, '-').'01';

//odbtp_prepare('Select CONVERT(varchar(100), TimeVal, 121) As t, Remark, DoorIndex, Mode From pLogData Where Event=32 And HozOrgan=? Order By 1 Desc');
//$q=odbtp_query('Select CONVERT(varchar(100), TimeVal, 121) From pLogData Where Event=32 And HozOrgan='.(0+trim($_GET['i'])).' Order By 1 Desc');
//odbtp_prepare("Select CONVERT(varchar(100), TimeVal, 121) As t, Remark, DoorIndex, Mode From pLogData ".
//    "Where Event=32 And HozOrgan={$CFG->params->i} And Convert(varchar(100), TimeVal, 112) Like '{$CFG->params->m}%' Order By 1");
//odbtp_prepare
$q=mssql_query("Select CONVERT(varchar(100), TimeVal, 120) As t, DatePart(dw, TimeVal) as wd, Remark, DoorIndex, Mode From pLogData ".
    "Where Event=32 And HozOrgan={$CFG->params->i} And (TimeVal Between '$d1' And dateAdd(m, 1, '$d1')) Order By 1");
//odbtp_input($q, 1);
//odbtp_input($q, 2);
//odbtp_set($q, 1, $CFG->params->i);
//odbtp_set($q, 2, $CFG->params->m.'%');
//odbtp_execute($q);
//odbtp_data_seek($q, $Start);
$Modes=Array('����', '�����');
$wd=explode(' ', '�� �� �� �� �� �� ��');
while($r=mssql_fetch_array($q)):
 $Mode=$Modes[$r['Mode']-1];
 if(!$Mode)$Mode='?';
 echo "<TR Align='Right'><TD>", $wd[$r['wd']-1],
    "<BR /></TD><TD>", implode('</TD><TD>', explode(' ', $r['t'])),
    "<BR /></TD><TD>", $r['DoorIndex'],
    "<BR /></TD><TD Align='Center'>", $Mode,
    "<BR /></TD><TD Align='Left'><Small>", $r['Remark'], "</Small>",
    "<BR /></TD></TR>\n";
// $Start++;
// if(isLastLine($Start)) break;
endwhile;
echo "</Table>";
//pageNavigator();

$q=mssql_query("Select m, Count(*) As N".
    " From (Select Convert(varchar(6), TimeVal, 112) As m From pLogData Where Event=32 And HozOrgan={$CFG->params->i}) As T ".
    "Group By m Order By m"); 
//odbtp_input($q, 1);
//odbtp_set($q, 1, $CFG->params->i);
//odbtp_execute($q);
unset($X); unset($Min); unset($Max);
while($r=mssql_fetch_array($q)):
 $X[$Max=$r['m']]=$r['N'];
 if(!$Min)$Min=$Max;
endwhile;
if($Min):
 echo "<Center><H2>��� ������</H2>";
 LoadLib('/stat/summary');
 $i=new monthIterator($Min, $Max); 
 while($i->Advance())
  if($m=$i->m() and $n=$X[$m])
   echo '<A hRef="./', hRef('m', $m), '">', $n, "</A>";
  else
   echo "<BR />";
endif;

?>
