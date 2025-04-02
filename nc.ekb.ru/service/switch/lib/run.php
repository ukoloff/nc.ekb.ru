<?
global $CFG;

$CFG->params->h='';
$CFG->defaults->h='-';

if('start'==$_GET['h']):
  system(dirname(__FILE__).'/dump &');
  sleep(1);
  Header('Location: ./'.hRef());
endif;

LoadLib('/pages');
$CFG->defaults->pagesize=10;

uxmHeader('История');
?>
<H1>История</H1>
<?
$s=sqlite3_query($CFG->db, "Select Count(*) From Run");
$Start=sqlite3_fetch($s);
sqlite3_query_close($s);
$Start=pageStart($Start[0]);

pageNavigator();
?>
<Table Border CellSpacing='0' Width='100%'><TR Class='tHeader'>
<TH>Дата</TH><TH>Время</TH><TH>Длительность</TH><TH>Результат</TH></TR>
<?
$s=sqlite3_query($CFG->db, <<<SQL
Select *,
    strftime('%s', Start) as unixTime,
    Case When Time Is Null And Status=0 Then (julianDay('now')-julianDay(Start))*86400 Else Time End As TimeX
From Run 
Order By Start Desc
Limit {$CFG->params->pagesize} Offset $Start
SQL
);

$Running=0;
while($r=sqlite3_fetch_array($s)):
 if($r['Status']==0)
  if(file_exists('/proc/'.$r['PID'])):
   $Running=1;
  else:
   $r['Status']=-1;
   $r['TimeX']=NULL;
  endif;
 echo "<TR><TD>", strftime('%x', $r['unixTime']), "</TD><TD>", strftime('%X', $r['unixTime']), "</TD><TD Align='Right'>";
 $ss='';
 $t=$r['TimeX'];
 if($t):
  $min=floor($t/60); 
  $ss=strtr(preg_replace('/^[0:]+/', '', sprintf('%d:%02d:%02.2f', floor($min/60), $min%60, $t-$min*60)), ',', '.');
 endif;
 if('.'==$ss{0})$ss='0'.$ss;
 echo "$ss<BR /></TD><TD Align='Center'>", 
    ($r['Status']>0? 'Ok' : ($r['Status']? 'Прервано' : 'Идёт')), "</TD></TR>\n";
endwhile;
?>
</Table>
<?
pageNavigator();
?>
<Center>
<Form Action='./' Method='GET'>
<Input Type='Hidden' Name='h' Value='start' />
<? if($Running): ?>
<Input Type='Button' Value=' Обновить страницу ' onClick='Reload();' />
<Script><!--
function Reload()
{
 location.reload();
}
setTimeout(Reload, 10000);
//--></Script>
<? else: ?>
<Input Type='Submit' Value=' Запустить сбор данных! ' />
<? endif; ?>
</Form>
