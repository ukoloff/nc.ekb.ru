</Center><FieldSet><Legend><Small>Запросы в очереди</Small></Legend>
<?
$NN=0;
$q=mysql_query("Select * From logOrder Where u=".$CFG->uSQL." And Spy='".AddSlashes($CFG->u)."' Order By At");
while($r=mysql_fetch_object($q)):
 if(!$NN++): ?>
<Table Border Width='100%' CellSpacing='0'><TR Class='tHeader'>
<TH>Заказан</TH>
<TH Title='Запрос будет исполнен в указанное время или позже'>Запуск (не ранее)</TH>
</TR>
<?
 endif;
 echo "<TR><TD>{$r->At}</TD><TD>{$r->Trigger}</TD></TR>";
endwhile;
echo $NN? "</Table>":"Не найдено";
?>
</FieldSet><Center>

