<HR />
<Style><!--
Div.X509 Div {
 display: none;
 background: lime;
 border: 1px solid navy;
}
--></Style>
<Script><!--
function res509(r)
{
 if(!r)
 {
  findId('authFail').style.display='block';
  findId('authOk').style.display='';
  return;
 }
 findId('authFail').style.display='';
 findId('authOk').style.display='block';
 findId('x509u').innerHTML=htmlEsc(r.u);
}
function Fire()
{
 findId("s509").src="x509/?callback=res509";
}

if('#x509'==location.hash) setTimeout(Fire, 100);

//--></Script>
<h2>�������� ���������</h2>
����� ���������, ���������� �� ��������� ���� � �������� - ������� ������:
<Center>
<Input Type='Button' Value='��������� ��������� ����' onClick='findId("s509").src="x509/?callback=res509"; '/>
<Div Class='x509'>
<Div id='authFail'>
���������� �� ���������� ��� ���������� �����������.
</Div>
<Div id='authOk'>
������ ��������� ������������� ���������� ��� ������������ <Span id='x509u'>?</Span>.
</Div>
</Div>
</Center>
<Script id='s509'></Script>
<Small>
&raquo;
�������� ����� ����� ������ � ���������, ������������ ��������� ������ Windows, �� ���� � Microsoft Internet Explorer
� Google Chrome
(<?=preg_match('/Windows/i', $_SERVER[HTTP_USER_AGENT])&&preg_match('/MSIE|AppleWebKit/i', $_SERVER[HTTP_USER_AGENT])?'�, �������, ':'��, ������, ��'?>
 � �����). � ��������� Opera � Firefox ���� �� �����.
<? if(preg_match('/Windows/i', $_SERVER[HTTP_USER_AGENT])): ?>
<BR />
&raquo;
�� ������ <A hRef='./<?=htmlspecialchars(hRef('msie', ' '))?>'>������� ��� ��������</A>
� Microsoft Internet Explorer, ����� �������, ���������� �� ���������� � ��������� Windows
<? endif; ?>
</Small>
