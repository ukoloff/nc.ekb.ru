<Table Width='100%' Border CellSpacing='0'>
<THead><TR Class='tHeader'>
<TH>!</TH>
<TH>Камера</TH>
<TH>Комментарий</TH>
</TR></THead>
<TBody id='@*'>
<?
$q=mssql_query('Select * From cam');
while($r=mssql_fetch_object($q)):
 echo '<TR id="@', $r->id, '"><TD Align="Center" onMouseMove="cameraThumb(this, ', $r->id, ')">',
    $r->skip?'#':'', '<BR /></TD><TD>';
 CheckBox('c'.$r->id, $r->name);
 echo "\n<A hRef='./", htmlspecialchars(hRef('i', $r->id, 'x', 'cam')),
    "' Target='camera'>&raquo;</A></TD><TD><i>", htmlspecialchars($r->comment), "</i>",
    "<BR /></TD></TR>";
endwhile;
?>
</TBody></Table>
