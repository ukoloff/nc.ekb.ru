<Form Action='./'>
����� �� ������ �������� ����� � ������� � �������� (� ������� ������)?
<Table x-Border><TR Align='Left'><TD>
<?
LoadLib('/forms');
$X=array('now'=>'����� ������', 'evening'=>'������� �������', 'weekend'=>'� ����� ������', 'month'=>'� ����� ������');
RadioGroup('start', $X);
HiddenInputs();
?>
</TD><TD vAlign='bottom'>
<Input Type='Submit' Value='�������� �����' Disabled id='btnSubmit' />
</TD></TR></Table>
</Form>
<Script><!--
function setOnClick()
{
 var f=document.forms[0];
 for(var i=f.length-1; i>=0; i--)
   if('radio'==f[i].type) f[i].onclick=doEnable;
}
function doEnable()
{
 findId('btnSubmit').disabled=false;
}

setOnClick();
//--></Script>
