<Script><!--
function setPass()
{
 var S='';
 while(S.length<4) S+=String.fromCharCode(Math.random()*10+'0'.charCodeAt(0));
 document.forms[0].pass.value=S;
}

function Sure(B)
{
 if(!confirm('�� ����������� ������� ����� ��������� '+
    '\n��� �������� ���������� ����� ��������.\n\n�� �������?')) return;
 B.form.i.value='#'+B.form.i.value;
 B.form.submit();
}

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
 if(!document.forms[0].pass.value.length && (' '==document.forms[0].i.value)) setPass();

 for(var i in Orders) addOrder(Orders[i]);
}, 1);
//--></Script>
<? if($CFG->Errors->General) echo '<H2 Class="Error">', htmlspecialchars($CFG->Errors->General), '</H2>'; ?>
<Form Method='POST' Action='./'>
<Table><TR vAlign='top'><TD>
<?
LoadLib('/forms');
HiddenInputs();
Input('u', '���'); BR();
$CFG->defaults->Input->extraAttr='readonly';
$CFG->defaults->Input->BR=" <Small>[<A hRef='#' onClick='setPass(); return false'>�������</A>]</Small><BR />";
Input('pass', '������'); BR();
unset($CFG->defaults->Input->extraAttr);
$CFG->defaults->Input->BR='<BR />';
echo "<P />";
CheckBox('block', '������������');
?>
</TD><TD RowSpan='2' NoWrap>
<?
Input('org', '�����������'); BR();
Input('contact', '���������� ����'); BR();
Input('mail', '����������� �����'); BR();
Input('phone', '�������'); BR();
Input('comment', '�����������'); BR();
?>
</TD></TR>
<TR><TD vAlign='bottom' Align='Center'>
<? LoadLib('buttons'); ?>
</TD></TR>
</Table>
<? LoadLib('orders.roster'); ?>
</Form>
