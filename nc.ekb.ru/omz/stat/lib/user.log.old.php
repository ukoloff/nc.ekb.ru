<H1>Отчёт по трафику</H1>

</Center>
Запрос на подробный лог доступа в Интернет пользователя
<code><?=htmlspecialchars($CFG->params->u)?></code>
за текущий месяц принят и поставлен в очередь.
<P>
Лог будет направлен на адрес <?=htmlspecialchars($CFG->u)?>@ekb.ru в пределах часа.
<Center>

<?
if(!$_GET['ok']):
 mysql_query("Insert Into logOrder(u, Spy) Values(".$CFG->uSQL.", '".AddSlashes($CFG->u)."')");

?>
<Script><!--
location.search='<?=hRef('ok', '1')?>';
//--></Script>
<?
endif;
?>
