<html><head>
<link REL='STYLESHEET' href='ticket.css' />
<title>����� �� Wi-Fi</title>
</head><body>
<Table id='Cut'><TR><TD>
<H1><img src='https://wifi.ekb.ru/wifi.gif' Alt='Wi-Fi@uxm' />
<BR />
����� �� Wi-Fi</H1>
<Script><!--
if(window.opener && window.opener.ticketData)
{
 Z=window.opener.ticketData;
 document.writeln('<Big>��� �����: <B>'+Z.pass+'</B></Big>'
  +'<BR /><Small>�� ��������� ��� ������!</Small>'
  +'<H3>��������� ����������</H3>'
  +'<Table Border CellSpacing="0">'
  +'<TR><TH>����������� ������������</TH><TD>'+Z.u+'<BR /></TD></TR>'
  +'<TR><TH>���� ���������</TH><TD>'+Z.date+'<BR /></TD></TR>'
  +'<TR><TH>����� ���������</TH><TD>'+Z.time+'<BR /></TD></TR>'
  +'<TR><TH>������������� ������</TH><TD>'+(Z.maxConn||'*')+'<BR /></TD></TR>'
  +'<TR><TH>��������� ����</TH><TD>'+bool2txt(Z.int)+'<BR /></TD></TR>'
  +'<TR><TH>��������</TH><TD>'+bool2txt(Z.ext)+'<BR /></TD></TR>'
  +'</Table>'
);
}

function bool2txt(f)
{
 return f!='0'?'��':'���';
}
//--></Script>
<HR />
<Small>���� Wi-Fi-������� <A hRef='http://wifi.ekb.ru'>http://wifi.ekb.ru</A>
</Small>
</TD></TR></Table>
<Div Class='noPrint'>
&raquo;
<A hRef='#' onClick='window.print(); return false;'>�����������</A>
</Div>
</body></html>
<?exit;?>
