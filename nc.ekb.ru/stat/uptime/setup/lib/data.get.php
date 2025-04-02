<?
global $CFG;

$n=$CFG->params->n;

$q=sqlite3_query($CFG->db, <<<SQL
Select
    AttrVals.*, Attrs.id, Attrs.Name
From
    AttrVals Left Join Attrs On AttrNo=Attrs.No
Where
    TestNo=$n
Order By
    AttrNo
SQL
);

while($r=sqlite3_fetch_array($q)):
 $CFG->oldAttrs[]=$r;
 unset($r);
endwhile;

sqlite3_query_close($q);

$CFG->newAttrs[]=Array();

?>