<?
$CFG->jsN=0;
if($CFG->entry->plain):
 echo "[";
 pjs($CFG->Tree);
 echo "]\n";
else:
  t($CFG->Tree);
endif;

function pjs(&$T)
{
 global $CFG;
 if($T->RRs)
  foreach($T->RRs as $r):
   if($CFG->jsN++) echo ",\n";
   echo '{"host": ', jsEsc($T->path), ', "type": ', jsEsc($r->RR), ', "value": ', jsEsc($r->Value), "}";
  endforeach;
 if($T->sub)
  foreach($T->sub as $r)
   pjs($r);
}

function t(&$T, $indent='')
{
 echo $indent;
 if($T->dc)
  echo jsEsc($T->dc), ": ";
 echo "{";
 $N=0;
 if($T->dc):
  if($N++) echo ", ";
  echo '"dc": ', jsEsc($T->dc);
 endif;
 if($T->path):
  if($N++) echo ", ";
  echo '"host": ', jsEsc($T->path);
 endif;
 if($T->RRs):
  if($N++) echo ", ";
  echo '"RR": [';  $NN=0;
  foreach($T->RRs As $r):
   if($NN++) echo ",\n$indent\t";
   echo '{"type": ', jsEsc($r->RR), ', "value": ', jsEsc($r->Value), "}";
  endforeach;
  echo "]";
 endif;
 if($T->sub):
  if($N++) echo ", ";
  echo "\"sub\": {\n";
  $NN=0;
  foreach($T->sub as $dc=>$r):
   if($NN++) echo ",\n";
   t($r, $indent.' ');
  endforeach;
  echo "}";
 endif;
 echo "}";
}

function jsEsc($S)
{
 if(null===$S)return 'null';
 return '"'.strtr($S, Array("\n"=>"\\n", "\r"=>"\\r", "\\"=>"\\\\", '"'=>"\\\"")).'"';
}

?>
