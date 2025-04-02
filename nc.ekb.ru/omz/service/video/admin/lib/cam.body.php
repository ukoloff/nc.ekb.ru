<Script><!--
function addOrder(x)
{
 if(!x) return;
 var r;
 if(r=findId('o'+x.id)) return r.checked=x.checked, 0;
 r=findId('Orders').insertRow(-1);
 var c=r.insertCell(-1);
 c.align='center';
 c.innerHTML=(x.skip?'#':'')+'<BR />';
 r.insertCell(-1).innerHTML='<Input Type="CheckBox" id="o'+x.id+'" Name="o'+x.id+'"'+
    (x.checked?' checked':'')+' /> <Label For="o'+x.id+'">'+x.name+'</Label> <A hRef="'+x.url+'" Target="Order">&raquo;</A>';
 r.insertCell(-1).innerHTML=x.customer+'<BR />';
 r.insertCell(-1).innerHTML='<i>'+x.comment+'</i><BR />';
}

setTimeout(function()
{
 for(var i in Orders) addOrder(Orders[i]);
}, 1);
//--></Script>
<img id='preview' src="./?jpg&amp;w=320&amp;n=<?=$CFG->entry->id?>" Align='Right'/>
<Form Action='./' Method='POST'>
<Table>
<TR><TD Align='Right'>Камера:</TD><TD><b><?=htmlspecialchars($CFG->entry->name)?></b><BR /></TD></TR>
<TR><TD Align='Right'>Отключена:</TD><TD><?= $CFG->entry->skip? '<b>#</b>':'нет' ?></TD></TR>
</Table>
<P />
<?
LoadLib('/forms');
Input('comment', 'Комментарий'); 
echo "<P />";
hiddenInputs();
$CFG->noDelete=1;
LoadLib('buttons');
?>
<BR Clear='All' />
<?
LoadLib('orders.roster');
if($CFG->Dispatcher>1):
?>
&raquo;
Та же камера, интерфейс <A hRef="./<?=htmlspecialchars(hRef('x', 'camera'))?>">для администратора</A>
<?endif;?>
