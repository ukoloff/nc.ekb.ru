<Script><!--
function DoNot()
{
 location.href=<?=jsEscape('./'.hRef('x'))?>;
}

function Sure()
{
  return confirm('�� �����-����� �������?');
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
�� �������, ��� ������ ������� ������� ������ ���������� �� ������?
<P />
<Form Action='./' Method='POST'>
<Input Type='Submit' Value=' �� ' onClick='return Sure()' />
<Input Type='Button' Value=' ��� ' onClick='DoNot()' />
<? HiddenInputs(); ?>
</Form>
</Center>
<? endif; ?>
<HR />
<Small>
&raquo;
����� �������� ������� ������ ���������� �� ������, � ���� ������ ���������� ����� ����� � �����.
��� �������������� ���������� ����������������� ����������� ��������� ��������� ���������� � �����
<BR />
&raquo;
��� ������� �������� ����������� �������������� � ����� ������������ � ������������ ��������� ;-)
