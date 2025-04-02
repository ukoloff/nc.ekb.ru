<?
function printQ(&$T, $Expandable)
{
 echo "<details><summary title='", htmlspecialchars($T->path), "'>", htmlspecialchars($T->dc), "</summary>";
/*

 echo "<A Class='Q' hRef='#' onClick='flip($T->no, this); return false;' Title='", htmlspecialchars($T->path), "'>",
    $Expandable? '+' : '&nbsp;', '</A> ',
    htmlspecialchars($T->dc);
*/
}

function tree2html(&$T) {
  if (!$T->sub) return;
  foreach($T->sub as $z):
    $rr = $z->RRs;
    if (!$rr) $rr = array(NULL);
    $n = 0;
    foreach ($rr as $r) :
	if ($n++) echo "</details>";
	echo "<details><summary title='", htmlspecialchars($z->path), "'>", htmlspecialchars($z->dc);
	if ($r)
	    echo '<span class="RR">', htmlspecialchars($r->RR), '</span>', htmlspecialchars($r->Value);
	echo "</summary>";
    endforeach;
    if ($z->sub):
	echo "<div class=subTree>";
	tree2html($z);
	echo "</div>";
    endif;
    echo "</details>";
  endforeach;
}
 
function _tree2html(&$T)
{
 if(!$T->dc):
  foreach($T->sub as $z)
   tree2html($z);
  return;
 endif;

 $n = 0;
 if($T->RRs)
  foreach($T->RRs as $n=>$r):
//   printQ($T, $n==count($T->RRs)-1 and $T->sub);
   if ($n) echo "</details>";
   $n++;
   printQ($T);
   echo '<span Class="RR">', htmlspecialchars($r->RR), '</span>', htmlspecialchars($r->Value);//, '<BR />';
  endforeach;
 if(!$T->sub):
   if ($n) echo "</details>";
   return;
 endif;
 if(!$T->RRs):
  printQ($T, 1);
//  echo "<BR />";
 endif;
 echo "<Div Class='subTree' id='*$T->no'>";
 foreach($T->sub as $z)
  tree2html($z);
 echo "</Div>";
  echo "</details>";
}

?>
