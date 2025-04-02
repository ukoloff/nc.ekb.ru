<Script><!--
function onSubmit(f)
{
 window.close();
 location.reload();
 return false;
}
onSubmit();
//--></Script>
<?
if(!$CFG->Wizard->POST)session_destroy();
$CFG->Wizard->Done=1;
?>
Генерация пароля прервана...
