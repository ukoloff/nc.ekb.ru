host;dc;type;value
<?
csv($CFG->Tree);

function csv(&$T)
{
 if($T->RRs)
  foreach($T->RRs as $r)
    echo csvEsc($T->path),";",csvEsc($T->dc),";",csvEsc($r->RR),";",csvEsc($r->Value),"\n";
 if(!$T->sub) return;
 foreach($T->sub as $r)
  csv($r);
}

function csvEsc($s)
{
 return preg_match('/[";\n\r]/', $s)? '"'.str_replace('"', '""', $s).'"' : $s;
}
?>
