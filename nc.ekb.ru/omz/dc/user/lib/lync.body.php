<P>
<Form Action='./' Method='POST' autocomplete="off"
onSubmit='return confirm("�� ����� �������, ��� ������ ���������\n������� ���������� ������� ������� Lync?")'>
<?
LoadLib('/forms');
$e=getEntry($CFG->udn, 'msrtcsip-primaryuseraddress');
LoadLib($CFG->params->x.'.'.($e[$e[0]][0]?'disable':'enable'));
//$CFG->entry->PoSH.=" -DomainController '".preg_replace('/\s+.*/', '', $CFG->AD->Srv)."'";
hiddenInputs();
$CFG->defaults->Input->maxWidth=1;
Input('PoSH', 'PowerShell-������� ��������� Lync');
?>
<P />
<Input Title='Lync ������ ��������� ���� ���������' Type='Submit' Value='<?=$CFG->entry->Command?>!' <?=inGroupX('#modifyDIT')?'':'x-Disabled'?>  />
&raquo;
������� ����� ����������� �� ���������, � � ��������� � ��������� ������...
<P />
���� ������� �� ���������, � ����� ���� - ����� ��������������� <a href='http://srvsfb-ekbh1.omzglobal.com/Cscp' target='_blank'>������� ���-������</a> (��������� � ����� ����)
</Form>
<? LoadLib('lync.patch'); ?>
