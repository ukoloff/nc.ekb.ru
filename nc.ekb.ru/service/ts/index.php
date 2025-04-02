<?
global $CFG;
require("../../lib/uxm.php");

uxmHeader('Терминальный доступ');
?>
<H1>Терминальный доступ</H1>
В связи с:
<OL>
<LI>Модернизацией
<LI>Инновацией
<LI>Миграцией из домена LAN в домен OMZGLOBAL
<LI>А также всем, что понадобится впредь ;-)
</OL>
доступ к терминальным серверам перенесён на <A hRef='/omz/service/rdp/<? 
if(strlen($_SERVER['QUERY_STRING']))
  echo '?', htmlspecialchars($_SERVER['QUERY_STRING']);
?>'>новый адрес</A>.
<P>
Обновите свои закладки <span style='background: yellow;'>таки наконец</span>.
</body></html>
