<H1>����� �� �������</H1>

</Center>
������ �� ��������� ��� ������� � �������� ������������
<code><?=htmlspecialchars($CFG->params->u)?></code>
�� ������� ����� ������ � ��������� � �������.
<P>
��� ����� ��������� �� ����� <?=htmlspecialchars($CFG->u)?>@ekb.ru � �������� ����.
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
