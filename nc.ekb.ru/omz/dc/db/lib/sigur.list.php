<?

$LIKE = 1;
switch($CFG->entry->as)
{
 case 'p': $COL='P.POS'; break;
 case 'n': $COL='P.TABID'; break;
 case 'd': $COL='D.NAME'; break;
 case '.': $COL='D.ID'; $LIKE = 0; break;
 default: $COL='P.NAME'; 
}

$OP = $LIKE ? 'LIKE' : '=';

$s = $CFG->sigur->prepare(<<<SQL
Select 
  P.ID, P.NAME, P.DESCRIPTION, P.POS, P.TABID, 
  D.NAME As Dept,
  (Select Max(LOGTIME) from `tc-db-log`.logs As L
   Where L.EMPHINT=P.ID And substr(L.LOGDATA, 1, 2)=0xFE06
  ) As Pass
From
  personal As P,
  personal As D
Where
  P.PARENT_ID=D.ID
  AND P.TYPE='EMP' 
  AND D.TYPE='DEP'
  And $COL $OP ?
Limit 1000
SQL
);

$SUFFIX = $LIKE ? '%' : '';
$s->execute(Array($CFG->entry->q.$SUFFIX));
unset($CFG->params->q);

?>
<table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>№</TH>
<TH>Таб.&nbsp;№</TH>
<TH>Ф.И.О.</TH>
<TH>Отдел</TH>
<TH>Должность</TH>
<TH>Примечание</TH>
<TH>Проход</TH>
</TR>
<?
$NN = 0;
while($row = $s->fetch()) :
  $NN++;
  echo "<tr><td align='right'><small>$NN</small>.</td><td>", htmlspecialchars($row['TABID']), 
    '</td><td onMouseMove="userThumb(this, ', jsEscape('./'.hRef('i', $row['ID']).'&jpg&w'), ')">',
    '<a href="', htmlspecialchars(hRef('i', $row['ID'])), '">', htmlspecialchars($row['NAME']), "</a></td><td>",
    htmlspecialchars($row['Dept']), "</td><td>",
    htmlspecialchars($row['POS']), "</td><td>",
    htmlspecialchars($row['DESCRIPTION']), "</td><td><small>",
    htmlspecialchars($row['Pass']), passLink($row), "</small></td></tr>";
endwhile;

function passLink($row) {
    if(!$row['Pass']) return;
    return '<a href="'.htmlspecialchars(hRef('i', $row['ID'])).'&pass" title="История проходов" target="_blank">&raquo;</a>';
}

?>
</table>
