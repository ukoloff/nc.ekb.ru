<Form Action='./'>
<Table>
<TR vAlign='top'><TD>
<FieldSet><Legend>
Область поиска
</Legend>
<?
HiddenInputs();
$CFG->entry->a=trim($_REQUEST['a']);
$CFG->entry->recurse=isset($_REQUEST['recurse'])? trim($_REQUEST['recurse']) : 1;
LoadLib('/forms');
CheckBox('recurse', 'И в подразделениях');
BR();

Select('a', Array(''=>'Активные', '#'=>'Заблокированные', '*'=>'Те и другие'), 'Пользователи');
?>
</FieldSet>
<Center>
<Input Type='Submit' Value=' Сгенерировать список ' />
</Center>
</TD><TD>
<FieldSet><Legend>
Поля отчёта
</Legend>
<?
foreach(preg_split('/[\r\n]+/', <<<TEXT
f sn Фамилия 
i givenName Имя
o middleName Отчество
fio+ ! Фамилия+Имя+Отчество
cn+ cn Пользователь (Фамилия И.О.)
dp+ ! Подразделение
dn ! Полный AD-путь
ufn ! Краткий AD-путь
i employeeID+ Табельный номер
d displayName Виден как (обычно=ФИО)  
t title Должность
c description Описание
p telephoneNumber Телефон
r physicalDeliveryOfficeName Комната
info info Заметки
s scriptpath Скрипт автозапуска
j ! Фотки
TEXT
)as $f):
 $f=preg_split('/\s+/', $f, 3);
 $Def='+'==substr($f[0], -1);
 if($Def) $f[0]=substr($f[0], 0, -1);
 $CFG->Fields[]=Array(c=>$f[0], Def=>$Def, AD=>$f[1], Title=>$f[2]);
endforeach;
foreach($CFG->Fields as $f):
 $c=$f['c'];
 $CFG->entry->$c=isset($_REQUEST[$c])? trim($_REQUEST[$c]) : $f['Def'];
 CheckBox($c, $f['Title']);
 BR();
endforeach;
?>
</FieldSet>

</Form>
