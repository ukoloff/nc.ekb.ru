<?
LoadLib('/yaml');

if($CFG->entry->plain):
 echo Spyc::YAMLDump(null);
 yamls($CFG->Tree);
 exit;
endif;

echo Spyc::YAMLDump($CFG->entry->plain? tree2array($CFG->Tree) : obj2array($CFG->Tree));

function tree2array(&$T)
{
 $R=Array();
 if($T->RRs)
  foreach($T->RRs as $x)
   $R[]=Array(dc=>$T->dc, path=>$T->path, RR=>$x->RR, value=>$x->Value);
 if($T->sub)
  foreach($T->sub as $x)
   $R=array_merge($R, tree2array($x));
 return $R;
}

function yamls(&$T)
{
 if($T->RRs)
  foreach($T->RRs as $x):
   $S=Spyc::YAMLDump(Array(Array(dc=>$T->dc, path=>$T->path, RR=>$x->RR, value=>$x->Value)));
   $S=preg_replace('/^.*?(\r\n?|\n)/', '', $S);
   echo $S;
  endforeach;
 if($T->sub)
  foreach($T->sub as $x)
   yamls($x);
}

?>
