<? LoadLib('pass.data'); ?>
<FieldSet>
<Legend>������� ������
</Legend>
<Form Action='./' Method='POST' Target='Rehash' onSubmit='startRehash(this)'>
<Input Type='Hidden' Name='rehash' Value="<?=$CFG->params->i?>" />
<Div>
<Input Type='Button' Value=' ������� ������ ������! ' onClick='testSure(this)' />
</Div>
<Div Style='display: none;'>
<Input Type='Button' Value=' ���, � ��������� ������ ' onClick='notSure(this)' />
<Input Type='Submit' Value=' ��, � ������, �������! ' />
</Div>
<Div Style='display: none;'>
��������� ������ ������...
</Div>
<Div Style='display: none;'>
����� ������: <Input id='newPass' Disabled />
<BR />
<Small>
&raquo;
������ � �������� ���� ���� ������ � ���� ����. ���� �� �������� ��� ����, �� �� ������� ����� ��� ����������.
<BR />
&raquo;
����������� ������� ����� ������ (� ��������� ��������� ������) � <A hRef='print/' Target='printWiFi'>��������� ����</A>
</Small>
</Div>
</Form>
</FieldSet>
<iFrame Name='Rehash' Src='0/' Style='display: none;'></iFrame>
