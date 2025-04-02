На этой странице Вы сможете сгенерировать RDP-файл для удобного доступа к терминальному серверу через
<A hRef='/omz/help/TSG/'>шлюз терминалов</A>.
<P>
<Center>
<Table><TR><TD>
<Form Action='./' Method='POST'>
<? LoadLib('/forms'); ?>
<? Input('s', 'Терминальный сервер'); ?>
<P />
<? CheckBox('d', 'Подключить диски'); ?>
<BR />
<? CheckBox('m', 'Подключить микрофон'); ?>
<P />
<Center>
<Input Type='Submit' Value=' Сгенерировать RDP! ' />
</Center>
<? hiddenInputs(); ?>
</Form>
</TD></TR></Table>
</Center>
Вы можете набрать любое имя сервера (или пустое, чтобы иметь выбор в момент соединения) или выбрать сервер
из ранее использовавшихся:
<? 
LoadLib('/sqlite');
$db=sqlite3_open(dirname(__FILE__)."/../data/data.db");
$q=sqlite3_query($db, "Select Distinct s from Log where u=".sqlite3_escape($CFG->u)." and not ip like '192.168.%' union select 't' Order By 1");
while($r=sqlite3_fetch($q)):
?>
<A hRef='#' onClick='s(this); return false;'><?=htmlspecialchars($r[0])?></A>
<?
endwhile;
?>
<HR />
<Small>
&raquo;
Полученный файл - текстовый, так что его всегда можно отредактировать по желанию
<BR />
&raquo;
Вы также можете щёлкнуть по сохранённому RDP-файлу правой кнопкой, выбрать "Edit/Правка" и отредактировать его в удобном интерфейсе от M$
</Small>