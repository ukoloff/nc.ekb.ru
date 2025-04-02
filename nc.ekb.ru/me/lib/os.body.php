<Script><!--
var net = new ActiveXObject("WScript.Network");
var S="<Table Border CellSpacing='0' Width='100%'>";
S+="<TR><TH Align='Right'>Компьютер</TH><TD Width='100%'>"+net.ComputerName+"<BR /></TD></TR>";
S+="<TR><TH Align='Right'>Пользователь</TH><TD>"+net.UserName+"<BR /></TD></TR>";
S+="<TR><TH Align='Right'>Авторизован&nbsp;в</TH><TD>"+net.UserDomain+"<BR /></TD></TR>";
S+="</TD></TR></Table>";
//var R = new ActiveXObject("WScript.Shell");
//alert(R);
//--></Script>

<Script>
if(!net) S='Объекты ActiveX заблокированы системой безопасности. Просмотр информации невозможен.'
document.writeln(S);
</Script>


<HR />
<Small>
&raquo;
Сведения на этой странице, вероятно, отображаются только в браузере Microsoft Internet Explorer, если
это не запрещено политикой безопасности.
