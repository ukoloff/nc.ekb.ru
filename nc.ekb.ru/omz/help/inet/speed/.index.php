<?# Скорость Интернета ?>
<? exec(dirname(__FILE__).'/data/entropy'); ?>
<Script Src='measure.js'></Script>
<Table Border CellSpacing='0'>
<TR><TH>
IP
</TH><TD Width='100%'>
<?=htmlspecialchars($_SERVER[REMOTE_ADDR])?>
<BR /></TD></TR>
<TR><TH>
Download
</TH><TD>
<Span id='time0'></Span>
<Span id='speed0'></Span>
<A id='Start' hRef='#' onClick='Start(); return false;'>Измерить<Span id='Again' Style='display: none;'> ещё раз</Span></A>
<BR /></TD></TR>
<TR><TH>
Upload
</TH><TD>
<Span id='time1'></Span>
<Span id='speed1'></Span>
<BR/></TD></TR>
</Table>
