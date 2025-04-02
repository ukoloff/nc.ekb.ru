<Script>
Statistics.Scripts='';
function scriptEngineAvail(E)
{
 if(Statistics.Scripts)Statistics.Scripts+=', ';
 Statistics.Scripts+=E;
}
</Script>
<Script Language='VBScript'>
scriptEngineAvail "Visual Basic"
</Script>
<Script Language='PerlScript'>
scriptEngineAvail("Perl");
</Script>
<Table Border CellSpacing='0' Width='100%'>
<TR><TH Align='Right'>IP-адрес</TH><TD><?=$_SERVER['REMOTE_ADDR']?></TD></TR>
<?
if($ip=$_SERVER["HTTP_X_FORWARDED_FOR"])
  echo "<TR><TH Align='Right'>Ещё IP-адрес</TH><TD>", htmlspecialchars($ip), "</TD></TR>";
?>
<TR><TH Align='Right'>Версия JavaScript</TH><TD>
<Script><!--
S=''+Statistics.js;
S+="</TD></TR><TR><TH Align='Right'>ПО&nbsp;Браузера</TH><TD>"+navigator.appName;
S+="</TD></TR><TR><TH Align='Right'>Верси\я&nbsp;браузера</TH><TD>"+navigator.userAgent;
S+="</TD></TR><TR><TH Align='Right'>Поддержка&nbsp;DHTML</TH><TD>";
D='';
if(Statistics.NS)D='Netscape Layers';
if(Statistics.MS){if(D)D+=', '; D+='MSIE';}
if(Statistics.DOM){if(D)D+=', '; D+='W3C DOM';}
if(!D)D='Нет';
S+=D;
S+="</TD></TR><TR><TH Align='Right'>Поддержка&nbsp;Java</TH><TD>";
if(Statistics.java) j=Statistics.java? 'Есть':'Нет';
else j='Не определ\ялась';
S+=j;
S+="</TD></TR><TR><TH Align='Right'>Другие&nbsp;языки</TH><TD>"+
    (Statistics.Scripts? Statistics.Scripts : 'Не&nbsp;найдено');
S+="</TD></TR><TR><TH Align='Right'>Поддержка&nbsp;Unicode</TH><TD>"+(Statistics.UTF ? 'Есть' : 'Нет');
S+="</TD></TR><TR><TH Align='Right'>Поддержка&nbsp;Cookies</TH><TD>"+(Statistics.cookies? 'Есть':'Нет');
S+="</TD></TR><TR><TH Align='Right'>Разрешение&nbsp;экрана</TH><TD>";
if(Statistics.w)
{
 S+=''+Statistics.w+'x'+Statistics.h;
 if(Statistics.depth)S+='x'+Statistics.depth;
}
else
  S+="не определ\яетс\я";
S+="</TD></TR><TR><TH Align='Right'>Часовой&nbsp;по\яс</TH><TD>"+(-Statistics.TZ/60);
document.writeln(S);

//--></Script>
<NoScript>
не установлен
</NoScript>
</TD></TR></Table>
