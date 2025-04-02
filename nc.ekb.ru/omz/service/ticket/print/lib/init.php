<html><head>
<link REL='STYLESHEET' href='ticket.css' />
<title>Билет на Wi-Fi</title>
</head><body>
<Table id='Cut'><TR><TD>
<H1><img src='https://wifi.ekb.ru/wifi.gif' Alt='Wi-Fi@uxm' />
<BR />
Билет на Wi-Fi</H1>
<Script><!--
if(window.opener && window.opener.ticketData)
{
 Z=window.opener.ticketData;
 document.writeln('<Big>Ваш билет: <B>'+Z.pass+'</B></Big>'
  +'<BR /><Small>Не сообщайте его никому!</Small>'
  +'<H3>Служебная информация</H3>'
  +'<Table Border CellSpacing="0">'
  +'<TR><TH>Виртуальный пользователь</TH><TD>'+Z.u+'<BR /></TD></TR>'
  +'<TR><TH>Дата окончания</TH><TD>'+Z.date+'<BR /></TD></TR>'
  +'<TR><TH>Время окончания</TH><TD>'+Z.time+'<BR /></TD></TR>'
  +'<TR><TH>Одновременных сессий</TH><TD>'+(Z.maxConn||'*')+'<BR /></TD></TR>'
  +'<TR><TH>Локальная сеть</TH><TD>'+bool2txt(Z.int)+'<BR /></TD></TR>'
  +'<TR><TH>Интернет</TH><TD>'+bool2txt(Z.ext)+'<BR /></TD></TR>'
  +'</Table>'
);
}

function bool2txt(f)
{
 return f!='0'?'Да':'Нет';
}
//--></Script>
<HR />
<Small>Сайт Wi-Fi-доступа <A hRef='http://wifi.ekb.ru'>http://wifi.ekb.ru</A>
</Small>
</TD></TR></Table>
<Div Class='noPrint'>
&raquo;
<A hRef='#' onClick='window.print(); return false;'>Распечатать</A>
</Div>
</body></html>
<?exit;?>
