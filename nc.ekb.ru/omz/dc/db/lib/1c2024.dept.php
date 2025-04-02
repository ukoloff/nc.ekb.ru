<?
//doDebug();
dbConnect();
$q = mssql_query($query=
<<<SQL
With 
  {$CFG->cte->Hist},
  {$CFG->cte->Dept},
  {$CFG->cte->Org},
  {$CFG->cte->Evnt},
Tree(id, parent_id, level, Kod, name) As(
    Select id,
        org_id,
        1,
        Kod,
        name
    From Dept
    Where not exists(
            Select *
            From Dept Z
            Where Z.id = Dept.up_id
        )
    UNION ALL
    Select Dept.id,
        up_id,
        level + 1,
        Dept.Kod,
        Dept.name
    From Tree
        Join Dept On Tree.id = Dept.up_id
)
Select *,
    (
        select count(rab_id) 
        from Hist
        Where 
          dept_id = Tree.id
          And
          event_id Not in(Select id from Evnt Where value=2)
    ) As N
From Tree
UNION ALL
Select id,
    Null,
    0,
    NULL,
    longname,
    null
From Org
Order By level,
    name
SQL
, $CFG->sql);

//echo "<!-- $query -->";

unset($Root);
$Root->ch = Array();
unset($Ds);

while($row = mssql_fetch_assoc($q)):
    $p = $Ds[bin2hex($row['parent_id'])];
    if (!$p) $p = $Root;
    unset($x);
    $x->id = bin2hex($row['id']);
    $x->Kod = trim($row['Kod']);
    $nom = $row['name'];
    $nom = preg_replace('/\s*\/.*/', '', $nom);
    $nom = preg_replace('/\s*[(][^(]*[)]\s*$/', '', $nom);
    $x->name = $nom;
    $x->N = $row['N'];
    $p->ch[] = $x;
    $Ds[$x->id] = $x;
endwhile;
unset($Ds);

function outDepts($d) {
  if(!count($d->ch)) return;
  if ($d->id) echo "<div>";
  foreach($d->ch as $z):
    echo "<details><summary>",
      htmlspecialchars($z->name);
    if ($z->Kod) 
	echo " &laquo;<tt title='Код подразделения'>", htmlspecialchars($z->Kod), "</tt>&raquo;";
    echo
      ' <tt title="Количество сотрудников">[',
      '<a href="./', hRef('as', '.', 'q', $z->id), '" target="workers" title="Список сотрудников">',
      $z->N, "</a>/", $z->Total, "]</tt></summary>\n";
    outDepts($z);
    echo "</details>";
  endforeach;
  if ($d->id) echo "</div>";
}

function calcTotals($d) {
  $n = $d->N;
  if (count($d->ch)):
    foreach($d->ch as $z):
      calcTotals($z);
      $n += $z->Total;
    endforeach;
  endif;
  $d->Total = $n;
}

calcTotals($Root);
?>

<div><style>
@scope {
  div {
    padding-left: 1.61em;
  }
}
</style>
<?
outDepts($Root);
?>
</div>
<?

function qJSON($S)
{
  return strtr('"' . AddSlashes($S) . '"', array("\n" => "\\n", "\r" => "\\r"));
}

function nJSON($n) {
  return isset($n) ? $n : 'null';
}

function asJSON($d) {
  if(!count($d->ch)) return;
  echo "[";
  $N=0;
  foreach($d->ch as $z):
    if($N++) echo ",";
    echo '{"name":', qJSON($z->name);
    if (isset($z->Kod) && $z->Kod != '')
	echo ',"kod":', qJSON($z->Kod);
    if (isset($z->N))
	echo ',"n":', nJSON($z->N);
    if (isset($z->Total))
	echo ',"total":', nJSON($z->Total);
    if ($z->ch):
	echo ',"ch":';
	asJSON($z);
    endif;
    echo "}";
  endforeach;
  echo "]";
}

if($_GET['dept'] == 'x'):
?>
<textarea readonly rows=7 style='width: 100%;'><?= asJSON($Root) ?></textarea>
<ul class='fa-ul'>
<li><a href="#"><i class="fa fa-li fa-copy"></i>Копировать в буфер обмена</a>
<li><a href="#"><i class="fa fa-li fa-file-excel-o"></i>Сохранить в XLS</a>
</ul>
<?
//  echo "<pre>"; print_r($Root); echo "</pre>";
LoadLib($CFG->params->x.'.xls');
else:
?>
<hr>
<ul class='fa-ul'>
<li><a href="./<?= htmlspecialchars(hRef('dept', 'x')) ?>"><i class="fa fa-li fa-database"></i>Экспорт</a>
</ul>
<?
endif;
?>
