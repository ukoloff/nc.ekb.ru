<?
LoadLib('/sort');

$CFG->sort=Array(
    'u'=>Array(field=>'u',	name=>'������������'),
    's'=>Array(field=>'serial', name=>'�'),
    'd'=>Array(field=>'subj',	name=>'���'),
    'm'=>Array(field=>'email',	name=>'�������� �����'),
    'n'=>Array(field=>'id',	name=>'id'),
    'c'=>Array(field=>'ctime', name=>'������', rev=>1),
    'b'=>Array(field=>'notBefore', name=>'������', rev=>1, title=>'���� ������� �����������'),
    'a'=>Array(field=>'notAfter', name=>'���������', rev=>1, title=>'���� ��������� ���������'),
    'r'=>Array(field=>'Revoke',	name=>'�������', rev=>1, title=>'���� ������ ����������� (UTC)'),
);
$CFG->defaults->sort='c';

AdjustSort();

LoadLib('filter.get');

$x=trim($_GET['as']);
switch(strtolower($x{0}))
{
 case 'j': LoadLib('json'); exit;
 case 'c': LoadLib('csv'); exit;
 case 'x': LoadLib('xls'); exit;
 case 'y': LoadLib('yaml'); exit;
}
?>
