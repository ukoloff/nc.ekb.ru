<?
LoadLib('/sort');

$CFG->sort=Array(
    'u'=>Array(field=>'u',	name=>'Пользователь'),
    's'=>Array(field=>'serial', name=>'№'),
    'd'=>Array(field=>'subj',	name=>'Имя'),
    'm'=>Array(field=>'email',	name=>'Почтовый адрес'),
    'n'=>Array(field=>'id',	name=>'id'),
    'c'=>Array(field=>'ctime', name=>'Создан', rev=>1),
    'b'=>Array(field=>'notBefore', name=>'Начало', rev=>1, title=>'Дата выпуска сертификата'),
    'a'=>Array(field=>'notAfter', name=>'Окончание', rev=>1, title=>'Срок истечения сертифика'),
    'r'=>Array(field=>'Revoke',	name=>'Отозван', rev=>1, title=>'Дата отзыва сертификата (UTC)'),
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
