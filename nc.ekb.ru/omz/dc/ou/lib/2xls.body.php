<Form Action='./' Method='POST'>
<P>
<Table><TR><TD NoWrap>
<?
LoadLib('/forms');
hiddenInputs();
CheckBox('l', 'Без поддеревьев');
BR();
CheckBox('b', 'Включая заблокированных');
BR();
CheckBox('p', 'В плоский список');
?>
</TD><TD vAlign='Bottom'>
<Input Type='Submit' Value=' Экспортировать! ' />
</TD></TR></Table>
</Form>
<HR />
&raquo;
Здесь Вы можете экспортировать всех пользователей подразделения в формате Excel
<BR />
&raquo;
Флажок "Без поддеревьев" отключает вывод вложенных подразделений
<BR />
&raquo;
Флажок "В плоский список" создаст простой файл Excel, без группировок по подразделениям

