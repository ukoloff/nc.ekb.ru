<Form Action='./' Method='POST' autocomplete="off"
onSubmit='return confirm("�� ����� �������, ��� ������ ���������\n������� ���������� �������� ������?")'>
<?
LoadLib('/forms');
$CFG->defaults->Input->maxWidth=1;

$CFG->DC="-DomainController '".preg_replace('/\s+.*/', '', $CFG->AD->Srv)."'";

$e=getEntry($CFG->udn, 'homeMDB');
LoadLib($CFG->params->x.'.'.($e[$e[0]][0]?'disable':'enable'));
hiddenInputs();
?>
<P />
<Input Type='Submit' Value='��������� �������!' <?=inGroupX('#modifyDIT')?'':'x-Disabled'?>  />
&raquo;
<small>������� ����� ����������� �� ���������, � � ��������� � ��������� ������...</small>
</Form>
