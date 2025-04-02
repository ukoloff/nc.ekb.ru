<?
require('../lib/uxm.php');

uxmHeader('Статистика');
?>
<H1>Статистика</H1>
В связи с миграцией из домена LAN в домен OMZGLOBAL статистика теперь относится к учётной записи OMZGLOBAL
и перенесена на <A hRef='/omz/stat/<?
if(strlen($_SERVER['QUERY_STRING']))
  echo '?', htmlspecialchars($_SERVER['QUERY_STRING']);
?>'>новый адрес</A>.
<P>
Если при миграции Ваша учётная запись изменилась (<A hRef='/me/?x=mig' Target='_blank'>проверить</A>), вероятно придётся ввести новую учётную запись и пароль.
<P>
Пожалуйста, обновите свои закладки.
