<?
require('lib/uxm.php');

Authorized();

ini_set("session.use_cookies", false);
session_name('out');

$X=0;

if(isset($_GET['login'])):
 if($CFG->Auth>0): // Успешно авторизовались
  $X='/';
  if($_SERVER['HTTP_REFERER']): 
//   $X=$_SERVER['HTTP_REFERER']; 
   $X='/'; 
  endif;
 else: // Не авторизовались, требовать авторизации
  $X=-1; 
 endif;
elseif(isset($_GET['logout'])):
 session_start();
 $_SESSION['From']=$_SERVER['HTTP_REFERER'];
 $X='/?'.session_name().'='.session_id();
elseif($_GET[session_name()]):
 session_start();
 $X=-1;
 if($_SESSION['n'])
  if( ''==$_SERVER['PHP_AUTH_USER'] or $CFG->Auth>0):
   $X='/';
//   if($_SESSION['From']) $X='/';	// $X=$_SESSION['From'];
   session_destroy();
  endif;
 $_SESSION['n']=1;
endif;

if(-1==$X): 
 ForceAuth();
elseif($X):
 header("Location: $X");
 header("HTTP/1.0 301 Go to");
endif;

uxmHeader();
?>
<Script><!--
if(location.search)location.href='/';
//--></Script>
<Style><!--
Img.Icon {
    width: 16px;
    height: 16px;
    border: none;
}
--></Style>
<Table Width='100%' CellSpacing='0' CellPadding='0'>
<TR><TD>
<!--[if IE ]>
<A hRef='/' Style='behavior:url(#default#homepage);' onClick='this.setHomePage(this.href);return false;'>
<Img Src='/img/home.gif' Class='Icon' Alt='Сделать домашней страницей'></A>
<![endif]-->
<Script><!-- 
if(typeof(window.external)==typeof(window))
  document.writeln("<A hRef='/' onClick='window.external.AddFavorite(this.href, \"Сетевой центр\");return false;'>"+
    "<Img Src='/img/favor.gif' Class='Icon' Alt='Добавить в закладки'></A>");
//--></Script>
<BR /></TD><TD>
<H1>Сеть ОАО &laquo;Уралхиммаш&raquo;</H1>
</TD></TR></Table>
<?
if($CFG->Auth):
 $e=getEntry(user2dn($CFG->u), 'displayName');
 $e=$e['displayname'][0];
 if(!$e)$e=$CFG->u;
 echo "Приветствую Вас, ", utf2html($e), "!<P>";
endif;
?>
На этой странице Вы можете управлять основными настройками своей учётной записи в локальной сети ОАО "Уралхиммаш". 
<P>
Здесь же Вы можете прочитать сведения о предоставляемых сетью
ОАО "Уралхиммаш" <A hRef='/help/'>услугах</A><!-- , включая также
информацию о <A hRef='/help/dial/'>подключении к сети по модему</A> (с использованием телефонной
линии) -->.
<?
if(!$CFG->Auth):
?>
<P>
Для начала управления своей учётной записью (смены пароля и/или просмотра статистики)
выберите пункт меню <A hRef='/?login'>Войти</A>
<?
endif;
?>
<P>
Если при входе на эту страницу Вы видите предупреждение о невозможности проверить сертификат
сервера, загрузите и установите <A hRef='/help/cert/'>корневой сертификат</A> сети ОАО "Уралхиммаш".

</body></html>
