<b>На этой странице можно посмотреть какой пользователь и когда заходил на определенный компьютер.</b>
<!-- для input type=date костыль из jQuery -->
<link rel="stylesheet" href="jQuery/css/jquery.ui.all.css">
<script src="jQuery/jquery-1.6.2.js"></script>
<script src="jQuery/jquery.ui.core.js"></script>
<script src="jQuery/jquery.ui.widget.js"></script>
<script src="jQuery/jquery.ui.datepicker.js"></script>
<script src="jQuery/jquery.ui.datepicker-ru.js"></script>
<script>
$(function() {
$( "#datepicker-from" ).datepicker({changeYear: 1, changeMonth: 1, showAnim: ''});
});
$(function() {
$( "#datepicker-to" ).datepicker({changeYear: 1, changeMonth: 1, showAnim: ''});
});
</script>
<script>
function specDate(){
document.getElementById('hidden').style.display='inline';
document.getElementById('after_hide').style.display='none';
}
</script>
<?
setlocale(LC_ALL, "ru_RU.cp1251");

//функция для фильтрации входных данных, полученных GET
function filter($data) {
$data = trim(htmlentities(strip_tags($data)));
if (get_magic_quotes_gpc())
$data = stripslashes($data);
$data = mysql_real_escape_string($data);
return $data;
}

//функция для перевода строковой даты(возвращаемой календариком на jquery) в формат MySQL Timestamp
function date_to_stamp( $date, $expression = "#^\d{2}([^\d]*)\d{2}([^\d]*)\d{4}$#is" ) {
    $return = false;
    if( preg_match( $expression, $date, $matches ) )
        $return = date( "Y-m-d " . '00:00:00' , strtotime( str_replace( array($matches[1], $matches[2]), '-', $date ) . ' ' . date("h:i:s") ) );
    return $return;
}

//функция для возврата "+" или "-" в зависимости от true/false
function trueORfalse($a)
{
if ($a) {return "+";}
else return "-";
}

//функция для фильтрации пустых значений при выводе
function filterEmpty($a)
{
if ($a) {return $a;}
else return "-";
}

$CFG->params->searchstr =  filter(($_GET["searchstr"])); 
$CFG->params->type =  filter(($_GET["type"]));
$CFG->params->fromdate =  filter(($_GET["fromdate"]));
$CFG->params->todate =  filter(($_GET["todate"]));
$CFG->params->bsubmit =  filter(($_GET["bsubmit"]));


//если конечная больше сегодняшней - ставим сегодняшнюю
if ($todate > date_to_stamp(date("d.m.Y"))) {
$todate = date_to_stamp(date("d.m.Y"));
}
//если начальная дата больше конечной - ставим значения по умолчанию - 1 мес
$fromdate = date_to_stamp($CFG->params->fromdate);
$todate = date_to_stamp($CFG->params->todate);
if ($fromdate > $todate){
$CFG->params->fromdate=date("d.m.Y", strtotime("-1 month"));
$fromdate = date_to_stamp($CFG->params->fromdate);
$CFG->params->todate=date("d.m.Y");
$todate = date_to_stamp($CFG->params->todate);
}

//фильтрация type
if (($CFG->params->type != ip)and($CFG->params->type != computer)) {$CFG->params->type = computer;}  //scope

?>

<SMALL>
<form action="" method="get" >
Текст: <input type="text" name="searchstr" required value="<?echo "{$CFG->params->searchstr}";?>" /> 
Тип: <select name="type" value="">
<option value="computer" <?if ($CFG->params->type==computer or $CFG->params->bsubmit!="Search") {echo "selected";}?> >Имя компьютера</option>
<option value="ip" <?if ($CFG->params->type==ip) {echo "selected";}?> >IP</option>
</select>
<button type="submit" name="bsubmit" value="Search" style="display : inline">Искать!</button>

<span id="after_hide" style="display : <?if ($CFG->params->bsubmit=="Search") {echo "none";} else echo "inline";?>"> За последний месяц (<a href="javascript:specDate()">изменить период</a>)</span>
<span id="hidden"  style="display : <?if ($CFG->params->bsubmit=="Search") {echo "inline";} else echo "none";?>">
С: <input type="text" name="fromdate" id="datepicker-from" value="<?if ($CFG->params->fromdate=='') {echo date("d.m.Y", strtotime("-1 month"));} else echo "{$CFG->params->fromdate}";?>"/>
По: <input type="text" name="todate" id="datepicker-to" value="<?if ($CFG->params->todate=='') {echo date("d.m.Y");} else echo "{$CFG->params->todate}";?>"/></span>
</form>
</SMALL>

<?
if ($CFG->params->bsubmit=="Search" && $CFG->params->searchstr!="" ) {

$q=mysql_query("SELECT * FROM uxmjournal.netlog WHERE {$CFG->params->type} = '{$CFG->params->searchstr}' AND Time BETWEEN  '{$fromdate}' AND '{$todate}' order by Time DESC");
//$num_rows = mysql_num_rows($q);

echo "Найдено записей: <B>",mysql_num_rows($q),"</B>";

echo "<Table Border CellSpacing='0' CellPadding='0' Width='100%'>";
echo "<TR Class='tHeader'><TH>Время</TH><TH>Имя ПК</TH><TH>IP</TH><TH>Кто</TH><TH>Тип сессии</TH><TH>RDP-клиент</TH><TH>Версия ОС</TH><TH>Админ</TH><TH>Ping</TH></TR>";

while($r=mysql_fetch_object($q)):
 echo "<TR Align='Right'><TD Align='Left'>", date("d.m.Y h:i:s",strtotime($r->Time)),
 "</TD><TD Align='Right'>", $r->Computer, 
 "</TD><TD Align='Right'>", $r->IP,
 "</TD><TD Align='Right'><a href='https://ekb.ru/omz/dc/user/?u=", $r->u,"'>",$r->u,"</a>", 
 "</TD><TD Align='Right'>", filterEmpty($r->Session),
 "</TD><TD Align='Right'>", filterEmpty($r->RDP),
 "</TD><TD Align='Right'>", $r->winVer,
 "</TD><TD Align='Center'>", trueORfalse($r->Admin),
 "</TD><TD Align='Center'>", trueORfalse($r->Ping),
 "<BR /></TD></TR>\n";
endwhile;
echo "</Table>";}
//echo "<b>{$CFG->params->searchstr},{$CFG->params->type},{$CFG->params->fromdate},{$CFG->params->todate},{$fromdate},{$todate}</b>";
?>


