<?
function tree2text(&$T)
{
 if($T->RRs)
  foreach($T->RRs as $r)
    echo "$T->path\t$r->RR\t$r->Value\n";
 if(!$T->sub) return;
 foreach($T->sub as $r)
  tree2text($r);
}
?>
