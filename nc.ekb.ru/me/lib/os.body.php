<Script><!--
var net = new ActiveXObject("WScript.Network");
var S="<Table Border CellSpacing='0' Width='100%'>";
S+="<TR><TH Align='Right'>���������</TH><TD Width='100%'>"+net.ComputerName+"<BR /></TD></TR>";
S+="<TR><TH Align='Right'>������������</TH><TD>"+net.UserName+"<BR /></TD></TR>";
S+="<TR><TH Align='Right'>�����������&nbsp;�</TH><TD>"+net.UserDomain+"<BR /></TD></TR>";
S+="</TD></TR></Table>";
//var R = new ActiveXObject("WScript.Shell");
//alert(R);
//--></Script>

<Script>
if(!net) S='������� ActiveX ������������� �������� ������������. �������� ���������� ����������.'
document.writeln(S);
</Script>


<HR />
<Small>
&raquo;
�������� �� ���� ��������, ��������, ������������ ������ � �������� Microsoft Internet Explorer, ����
��� �� ��������� ��������� ������������.
