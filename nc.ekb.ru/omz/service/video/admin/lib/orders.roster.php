<Script><!--
var Orders=[
<?
if($CFG->entry)
foreach($CFG->entry As $k=>$v)
 if(preg_match('/^o(\d+)$/', $k, $match)):
  $q=mssql_query('Select * From orders Where id='.$match[1]);
  $q=mssql_fetch_object($q);
  $q->checked=!!$v;
  $q->url='./'.hRef('x', 'order', 'i', $match[1]);
  $nn=0;
  foreach($q as $kk=>$vv) echo $nn++?",\n":"{", "\t", $kk, ":\t", is_int($vv)? $vv: jsEscape(htmlspecialchars($vv));
  if($nn)echo "},\n";
 endif;
?>
];
//--></Script>
<Table Border Width='100%' CellSpacing='0'>
<THead><TR Class='tHeader'>
<TH>!</TH>
<TH>Заказ</TH>
<TH>Заказчик</TH>
<TH>Комментарий</TH>
</TR></THead>
<TBody id='Orders'></TBody>
<TFoot>
<TR Class='tHeader'><TD ColSpan='4'>&raquo;
<A hRef='./<?=htmlspecialchars(hRef('x', 'orders', 'i'))?>' Target='addOrder'
onClick='window.open(this.href, this.target); return'><i>Добавить заказ из списка</i></A></TD></TR>
</TFoot>
</Table>
