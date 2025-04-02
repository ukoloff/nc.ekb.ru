<Script><!--
function modeSelect()
{
 return window.opener && window.opener.addOrder;
}

function Action(A)
{
 if(!modeSelect()) return true;
 var tr=A.parentNode.parentNode;
 var x={url: A.href, name: A.innerHTML,
    checked: 1, id: A.id,
    skip: !!tr.cells[0].firstChild.nodeValue,
    comment: tr.cells[4].firstChild.innerHTML,
    customer: tr.cells[2].firstChild.innerHTML};
 window.opener.addOrder(x);
 alert('Заказ добавлен в список.');
 return false;
}

if(modeSelect())setTimeout(function()
{
 findId('onEdit').style.display='none';
 findId('onSelect').style.display='';
}, 1);
//--></Script>
<?
LoadLib('/sort');
$CFG->sort=Array(
    's'=>Array(field=>'skip', name=>'!', title=>'Не показывать', noindex=>1),
    't'=>Array(field=>'name', name=>'Номер'),
    'c'=>Array(field=>'customer', name=>'Заказчик'),
    'n'=>Array(field=>'N', name=>'Камер', noindex=>1),
    'x'=>Array(Xfield=>'comment', name=>'Комментарий'),
);
$CFG->defaults->sort='sn';
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
sortedHeader('stcnx');
unset($CFG->params->q);

$W=$CFG->entry->q;
if(strlen($W)):
  $L=dbEscape($W.'%');
  $W='';
  foreach($CFG->sort As $k=>$v)
   if($v['field'] and !$v['noindex'])
    $W.=(strlen($W)?' Or ':' Where ').$v['field'].' Like '.$L;
endif;

$q=mssql_query("Select *, (select count(*) From o2c Where [order]=orders.id) As N From orders".$W.sqlOrderBy());
unset($CFG->params->sort);

LoadLib('/pages');
pageStart(mssql_num_rows($q));

if($CFG->params->p)mssql_data_seek($q, $CFG->params->pagesize*$CFG->params->p);

$l=1;
while($r=mssql_fetch_object($q)):
  echo "<TR><TD Align='Center'>", htmlspecialchars($r->skip)? '#':'', 
    '<BR /></TD><TD><A hRef="', htmlspecialchars(hRef('x', 'order', 'i', $r->id)),
    '" id="', $r->id,'" onClick="return Action(this)">', htmlspecialchars($r->name), '</A>',
    '<BR /></TD><TD><span>', htmlspecialchars($r->customer), '</span>',
    '<BR /></TD><TD Align="Right">', $r->N?$r->N:'', 
    '<BR /></TD><TD><i>', htmlspecialchars($r->comment), '</i>',
    "<BR /></TD></TR>";
 if(++$l>=$CFG->params->pagesize) break;
endwhile;
?>
<TR Class='tHeader'><TD ColSpan='5'>
<Div id='onEdit'>&raquo;
<A hRef='./<?=htmlspecialchars(hRef('x', 'order', 'i', ' '))?>'><i>Создать заказ</i></A></Div>
<Div id='onSelect' Style='display: none'>Выберите заказ(ы) для добавления заказчику...</Div>
</TD></TR>
<?
sortedFooter();
$CFG->params->q=$CFG->entry->q;
pageNavigator();
?>
