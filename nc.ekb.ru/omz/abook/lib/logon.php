<?
if($CFG->u!=$CFG->params->u and !inGroupX('#Statistics')) return;
?>
<html><head>
<? if(preg_match('/^\w+$/', $_GET['callback'])):?>
<Script>
setTimeout(function()
{
 parent.<?=$_GET['callback']?>(document);
}, 0);
</Script>
<? endif; ?>
</head><body>
<Table Border CellSpacing='0'>
<?
$u=AddSlashes($CFG->params->u);
/*
$q=mysql_query(<<<SQL
Select Max(Time) As Time, Count(*) As N, Computer As Host,
(Select IP From uxmJournal.netLog As B Where A.u=B.u And A.Computer=B.Computer Order By Time Desc Limit 1) As IP
From uxmJournal.netLog As A
Where u='{$u}'
Group By Computer
Order By 1 Desc
Limit 7
SQL
);
*/
/*
$q=mysql_query(<<<SQL
Select
 Distinct IP, Computer As Host
From uxmJournal.netlog X
Where u='{$u}'
Order By Time Desc
Limit 7
SQL
);
*/
$q=mysql_query(<<<SQL
Select *
/* ,(Select Time From uxmJournal.netlog Where u=X.u And IP=X.IP And Computer=X.Host Order By N Desc Limit 1) As Time */
/* ,(Select Count(*) From uxmJournal.netlog Where u=X.u And IP=X.IP And Computer=X.Host) As N */
From (Select
 Distinct u, IP, Computer As Host
From uxmJournal.netlog X
Where u='{$u}'
Order By Time Desc
Limit 7) As X
SQL
);

while($r=mysql_fetch_object($q)):
?>
<TR>
<TD Align='Right'><?=htmlspecialchars($r->N)?><BR /></TD>
<TD><A hRef='../host/<?=htmlspecialchars(hRef('u', $r->Host.'$'))?>
' Target='_Host'><?=htmlspecialchars($r->Host)?>
</A><BR /></TD>
<TD><A Title='Open in VNC' hRef="vnc:<?=htmlspecialchars($r->IP)?>">&raquo;</A><?=htmlspecialchars($r->IP)?><BR /></TD>
<TD NoWrap><?=htmlspecialchars($r->Time)?><BR /></TD>
</TR>
<?
endwhile;
?>
</Table>
</body></html>
