<Script><!--
function Sure(B)
{
 if(!confirm('�� ����������� ������� ���� �����'+
    '\n��� �������� ���������� ����� ��������.\n\n�� �������?')) return;
 B.form.i.value='#'+B.form.i.value;
 B.form.submit();
}

function cameraThumb(TD, n)
{
 if(!TD.getElementsByTagName('img').length)
 {
  var z=document.createElement('img');
  z.className='userThumb';
  z.src='./?jpg&w=160&n='+n;
  TD.appendChild(z);
  TD.onmouseout=function(){z.style.display='none';};
 }
 TD.getElementsByTagName('img')[0].style.display='inline';
}

function cFilter(s)
{
 var X=findId('@*'), Y;
 if(!X) return;
 X=X.rows;
 s=s.value;
 if(s.length)
 {
  Y={};
  s=s.split(',');
  for(var i in s) Y['@'+s[i]]=1;
 }
 for(var i in X)
 {
  var r=X[i];
  r.style.display=(!Y || Y[r.id])?'':'none';
 }
}
//--></Script>
<? if($CFG->Errors->General) echo '<H2 Class="Error">', htmlspecialchars($CFG->Errors->General), '</H2>'; ?>
<Form Method='POST' Action='./'>
<Table><TR vAlign='top'><TD>
<?
LoadLib('/forms');
HiddenInputs();
Input('name', '�����');
echo "<P />";
CheckBox('skip', '�� ����������');
?>
</TD><TD RowSpan='2'>
<?
Input('customer', '��������'); BR();
Input('comment', '�����������'); BR();
?>
</TD></TR></Table>
<Table Width='100%'><TR><TD>
<? LoadLib('buttons'); ?>
</TD><TD Align='Right'>
<? LoadLib('cam.filter'); ?>
</TD></TR></Table>
<? LoadLib('cam.roster'); ?>
</Form>
