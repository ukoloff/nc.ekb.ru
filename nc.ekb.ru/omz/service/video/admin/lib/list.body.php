<Script><!--
function Sure(B)
{
 if(!confirm('�� ����������� ������� ������ ����� #'+B.form.i.value+
    '\n��� �������� ���������� ����� ��������.\n\n�� �������?')) return;
 B.form.i.value='#'+B.form.i.value;
 B.form.submit();
}

function Validate(F)
{
 if(!F.name.value.length)
 {
  F.name.focus();
  return false;
 }
 return true;
}
//--></Script>
<? if($CFG->Errors->General) echo '<H2 Class="Error">', htmlspecialchars($CFG->Errors->General), '</H2>'; ?>
<Form Action='./' Method='post' onSubmit='return Validate(this)'>
<?
LoadLib('/forms');
HiddenInputs();
Input('name', '���'); BR();
Input('cameras', '������ �����'); BR();
Input('comment', '�����������'); BR();
Checkbox('show', '�������� � �����'); 
?>
<P />
<? LoadLib('buttons'); ?>
<? LoadLib('cams.roster'); ?>
</Form>
