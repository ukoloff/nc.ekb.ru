<?
#header( "HTTP/1.0 200 Ok");

if(403==$_SERVER['REDIRECT_STATUS']):
 header("HTTP/1.0 404 Not found");
endif;

require('lib/uxm.php');

uxmHeader('Ошибка');
?>
<H1>Ошибка</H1>
<LI><B>Страница</B>:
<A hRef=/ Target=_top>Сетевой центр</A><?
list($p, $q)=explode('?', $_SERVER['REQUEST_URI'], 2);
$Path='/';
while(1):
 $p=preg_replace('|^/+|', '', $p);
 if(!$p) break;
 if(1=="1".($i=strpos($p, '/'))) $i=strlen($p);
 $v=substr($p, 0, $i);
 $p=substr($p, $i);
 $Path.=rawurlencode($v);
 if($p) $Path.='/';
 echo "/<A\nhRef='$Path'>", htmlspecialchars($v), "</A>";
endwhile;
if($q)
 echo "?<A\nhRef='$Path?", rawurlencode($q),"'>", htmlspecialchars($q), "</A>";
?>
<LI><B>Ошибка</B>:
<?
$Errors=array(
 400=>"Ошибка браузера",
 401=>"Документ недоступен (неверные имя пользователя и/или пароль)",
 402=>"Документ предоставляется на платной основе",
 403=>"Документ закрыт для доступа",
 404=>'Документ не найден на сервере',
 500=>"Внутренняя ошибка сервера"
 );
$Errors[403]=$Errors[404];
$Msg=$Errors[$_SERVER['REDIRECT_STATUS']];
if(!$Msg) $Msg=$_SERVER['REDIRECT_STATUS'];
echo $Msg;
//phpinfo();
?>
<Center>
<Form Action=/post/ Method=Post>
<Input Type='Hidden' Name='body' Value="<? echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
<Input Type='Hidden' Name='Error' Value="<? echo htmlspecialchars($_SERVER['REDIRECT_STATUS']); ?>">
<Input Type='Hidden' Name='Referer' Value="<? echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>">
<Input Type='Hidden' Name='subject' Value="Ошибка на сервере">
<Input Type='Hidden' Name='okpage' Value='/'>
<Input Type='Submit' Value='Сообщить веб-мастеру'>
</Form>

<Small><HR>
[<A hRef=http://ekb.ru>ОАО "Уралхиммаш"</A>]
<!--
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
PADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPADPAD
-->
</BODY></HTML>
