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
<h2>Проверка установки</h2>
Чтобы проверить, установлен ли секретный ключ в браузере - нажмите кнопку:
<Center>
<Input Type='Button' Value='Проверить секретный ключ' onClick='findId("s509").src="x509/?callback=res509"; '/>
<Div Class='x509'>
<Div id='authFail'>
Сертификат не установлен или установлен некорректно.
</Div>
<Div id='authOk'>
Найден корректно установленный сертификат для пользователя <Span id='x509u'>?</Span>.
</Div>
</Div>
</Center>
<Script id='s509'></Script>
<Small>
&raquo;
Проверка имеет смысл только в браузерах, использующих хранилище ключей Windows, то есть в Microsoft Internet Explorer
и Google Chrome
(<?=preg_match('/Windows/i', $_SERVER[HTTP_USER_AGENT])&&preg_match('/MSIE|AppleWebKit/i', $_SERVER[HTTP_USER_AGENT])?'и, кажется, ':'но, похоже, не'?>
 в Вашем). В браузерах Opera и Firefox ключ не виден.
<? if(preg_match('/Windows/i', $_SERVER[HTTP_USER_AGENT])): ?>
<BR />
&raquo;
Вы можете <A hRef='./<?=htmlspecialchars(hRef('msie', ' '))?>'>открыть эту страницу</A>
в Microsoft Internet Explorer, чтобы увидеть, установлен ли сертификат в хранилище Windows
<? endif; ?>
</Small>
