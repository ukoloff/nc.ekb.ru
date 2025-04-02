<Script><!--
function Sure(B)
{
 if(!confirm('Вы собираетесь удалить список камер #'+B.form.i.value+
    '\nЭту операцию невозможно будет отменить.\n\nВы уверены?')) return;
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
Input('name', 'Имя'); BR();
Input('cameras', 'Список камер'); BR();
Input('comment', 'Комментарий'); BR();
Checkbox('show', 'Добавить в обзор'); 
?>
<P />
<? LoadLib('buttons'); ?>
<? LoadLib('cams.roster'); ?>
</Form>
