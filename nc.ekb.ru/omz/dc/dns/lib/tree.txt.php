<?
foreach($CFG->Tree->sub as $r)
 p($r);

function p(&$T, $indent='')
{
 if($T->RRs)
  foreach($T->RRs as $r)
    echo $indent, $T->dc, "\t", $r->RR, "\t", $r->Value, "\n";
 else
  echo $indent, $T->dc, "\n";
 if($T->sub)
  foreach($T->sub as $r)
    p($r, $indent.'  ');
}
?>
