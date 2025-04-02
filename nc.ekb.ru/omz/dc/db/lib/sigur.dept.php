<?
//doDebug();
dbConnect();
global $CFG;
$s = $CFG->sigur->prepare(<<<SQL
With RECURSIVE Dept As(
    SELECT *,
        (
            Select Count(*)
            From personal Ps
            Where Ps.PARENT_ID = Ds.ID And Ps.Type='EMP'
        ) As N
    From personal Ds
    WHERE TYPE = 'DEP'
        And status != 'FIRED'
),
Tree (id, parent_id, level, name, N) as(
    Select ID,
        0,
        0,
        Dept.NAME,
        Dept.N
    From Dept
    Where PARENT_ID = 0
    UNION ALL
    Select Dept.ID,
        Dept.PARENT_ID,
        Level + 1,
        Dept.NAME,
        Dept.N
    From Tree
        Join Dept On Tree.id = Dept.PARENT_ID
)
SELECT *
From tree
Order By level, name
SQL
);
$s->execute();
unset($Root);
$Root->ch = Array();
unset($Ds);

while ($row = $s->fetch()):
    $p = $Ds[$row['parent_id']];
    if (!$p) $p = $Root;
    unset($x);
    $x->id = $row['id'];
    $x->name = $row['name'];
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
      htmlspecialchars($z->name), 
      ' <tt title="Количество сотрудников">[', 
      '<a href="./', hRef('as', '.', 'q', $z->id), '" target="workers" title="Список сотрудников">',
      $z->N, "</a>/", $z->Total, "]</tt></summary>";
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