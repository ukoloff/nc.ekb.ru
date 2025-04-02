<?
LoadLib('/sort');
$CFG->sort=Array(
    'b'=>Array(field=>'block', name=>'!', title=>'Заблокирован', noindex=>1),
    'u'=>Array(field=>'u', name=>'Имя'),
    'o'=>Array(field=>'org', name=>'Организация'),
    'c'=>Array(field=>'contact', name=>'Контактное лицо'),
    'n'=>Array(field=>'N', name=>'Заказов', rev=>1, noindex=>1),
    'x'=>Array(Xfield=>'comment', name=>'Комментарий'),
);
$CFG->defaults->sort='bu';
adjustSort();

$CFG->entry->q=trim($_REQUEST['q']);
?>
<Form Action='./'>
<Small>Текст</Small>
<Input Name='q' Value="<?=htmlspecialchars($CFG->entry->q)?>" />
<Input Type='Submit' Value=' Искать! ' />
<? hiddenInputs(); ?>
</Form>
<?
$CFG->params->q=$CFG->entry->q;
sortedHeader('buocnx');
unset($CFG->params->q);

$W=$CFG->entry->q;
if(strlen($W)):
  $L=dbEscape($W.'%');
  $W='';
  foreach($CFG->sort As $k=>$v)
   if($v['field'] and !$v['noindex'])
    $W.=(strlen($W)?' Or ':' Where ').$v['field'].' Like '.$L;
endif;

$q=mssql_query("Select *, (select count(*) From c2o Where customer=customer.id) As N From customer".$W.sqlOrderBy());
unset($CFG->params->sort);

LoadLib('/pages');
pageStart(mssql_num_rows($q));

if($CFG->params->p)mssql_data_seek($q, $CFG->params->pagesize*$CFG->params->p);

$l=1;
while($r=mssql_fetch_object($q)):
  echo "<TR><TD Align='Center'>", htmlspecialchars($r->block)? '#':'', 
    '<BR /></TD><TD><A hRef="', htmlspecialchars(hRef('x', 'customer', 'i', $r->id)), '">', htmlspecialchars($r->u), '</A>',
    '<BR /></TD><TD>', htmlspecialchars($r->org), 
    '<BR /></TD><TD>', htmlspecialchars($r->contact), 
    '<BR /></TD><TD Align="Right">', $r->N?$r->N:'', 
    '<BR /></TD><TD><i>', htmlspecialchars($r->comment), '</i>',
    "<BR /></TD></TR>";
 if(++$l>=$CFG->params->pagesize) break;
endwhile;
?>
<TR Class='tHeader'><TD ColSpan='6'>&raquo;
<A hRef='./<?=htmlspecialchars(hRef('x', 'customer', 'i', ' '))?>'><i>Создать заказчика</i></A></TD></TR>
<?
sortedFooter();
$CFG->params->q=$CFG->entry->q;
pageNavigator();
?>
