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
<TR><TH Align='Right'>IP-�����</TH><TD><?=$_SERVER['REMOTE_ADDR']?></TD></TR>
<?
if($ip=$_SERVER["HTTP_X_FORWARDED_FOR"])
  echo "<TR><TH Align='Right'>��� IP-�����</TH><TD>", htmlspecialchars($ip), "</TD></TR>";
?>
<TR><TH Align='Right'>������ JavaScript</TH><TD>
<Script><!--
S=''+Statistics.js;
S+="</TD></TR><TR><TH Align='Right'>��&nbsp;��������</TH><TD>"+navigator.appName;
S+="</TD></TR><TR><TH Align='Right'>�����\�&nbsp;��������</TH><TD>"+navigator.userAgent;
S+="</TD></TR><TR><TH Align='Right'>���������&nbsp;DHTML</TH><TD>";
D='';
if(Statistics.NS)D='Netscape Layers';
if(Statistics.MS){if(D)D+=', '; D+='MSIE';}
if(Statistics.DOM){if(D)D+=', '; D+='W3C DOM';}
if(!D)D='���';
S+=D;
S+="</TD></TR><TR><TH Align='Right'>���������&nbsp;Java</TH><TD>";
if(Statistics.java) j=Statistics.java? '����':'���';
else j='�� �������\�����';
S+=j;
S+="</TD></TR><TR><TH Align='Right'>������&nbsp;�����</TH><TD>"+
    (Statistics.Scripts? Statistics.Scripts : '��&nbsp;�������');
S+="</TD></TR><TR><TH Align='Right'>���������&nbsp;Unicode</TH><TD>"+(Statistics.UTF ? '����' : '���');
S+="</TD></TR><TR><TH Align='Right'>���������&nbsp;Cookies</TH><TD>"+(Statistics.cookies? '����':'���');
S+="</TD></TR><TR><TH Align='Right'>����������&nbsp;������</TH><TD>";
if(Statistics.w)
{
 S+=''+Statistics.w+'x'+Statistics.h;
 if(Statistics.depth)S+='x'+Statistics.depth;
}
else
  S+="�� �������\����\�";
S+="</TD></TR><TR><TH Align='Right'>�������&nbsp;��\��</TH><TD>"+(-Statistics.TZ/60);
document.writeln(S);

//--></Script>
<NoScript>
�� ����������
</NoScript>
</TD></TR></Table>
