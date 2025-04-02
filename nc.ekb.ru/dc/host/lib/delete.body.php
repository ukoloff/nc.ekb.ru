<Script><!--
function DoNot()
{
 location.href=<?=jsEscape('./'.hRef('x'))?>;
}

function Sure()
{
  return confirm('Вы точно-точно уверены?');
}
//--></Script>
<P />
<Center>
<? 
global $CFG;
if($CFG->ldapError):
  echo "<H3 Class='Error'>", htmlspecialchars($CFG->ldapError),"</H3>";
else:
?>
Вы уверены, что хотите удалить учётную запись компьютера из домена?
<P />
<Form Action='./' Method='POST'>
<Input Type='Submit' Value=' Да ' onClick='return Sure()' />
<Input Type='Button' Value=' Нет ' onClick='DoNot()' />
<? HiddenInputs(); ?>
</Form>
</Center>
<? endif; ?>
<HR />
<Small>
&raquo;
После удаления учётной записи компьютера из домена, с этой машины невозможно будет зайти в домен.
Для восстановления нормальной работоспособности потребуется повторное включение компьютера в домен
<BR />
&raquo;
Все попытки удаления компьютеров регистрируются в целях безопасности и последующего наказания ;-)
