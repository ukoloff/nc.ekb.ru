<?
global $CFG;

LoadLib('/forms');
$CFG->defaults->Input->BR=' ';
$CFG->entry->q=trim($_REQUEST['q']);
LoadLib('/pages');
$CFG->defaults->pagesize=30;
?>
<Form Action='./' Method='GET'>
<Table>
<TR><TD><? Input('q', 'Поиск:'); HiddenInputs(); ?></TD>
<TD><Input Type='Submit' Value=' Искать! ' />
</TD></TR>
</Table>
</Form>

<?

$Where='';
if($CFG->entry->q) $Where=" Where Name Like '".strtr($CFG->entry->q, Array("'"=>"''"))."%'";

$X=Array();
foreach($CFG->nwServers as $s):
 $q=sqlite3_query($CFG->h, "Select Name From $s.Objects$Where");
 while($r=sqlite3_fetch($q))$X[$r[0]]++;
 sqlite3_query_close($q);
endforeach;
ksort($X);
$Y=Array();
foreach($X as $k=>$v)
  $Y[]=Array('id'=>$k, 'n'=>$v);
unset($X);
$i=pageStart(count($Y));
$CFG->params->q=$CFG->entry->q;
pageNavigator();
?>
<Table Border CellSpacing='0' Width='100%'>
<?
for($n=0 ;$i<count($Y); $i++, $n++):
 if(!($n&1)) echo "<TR>";
 echo "<TD><A hRef='./", htmlspecialchars(hRef('id', $Y[$i]['id'], 'q')), "'>", htmlspecialchars($Y[$i]['id']), 
    "</A><BR /></TD>"; // "<TD>", $Y[$i]['n'], "</TD>";
 if($n&1) echo "</TR>\n";
 if(isLastLine($i))break;
endfor;
//if(!($n&1))echo "<TD><BR /></TD></TR>";
?>
</Table>
<?
pageNavigator();
?>
