<?
Header('Content-Type: application/octet-stream');
Header('Content-Disposition: attachment; filename="'.$CFG->params->u.'.cer"');

if(!isset($_GET[db]) or !@mssql_select_db($_GET[db])) return None();

$n=(int)$_GET[cer];
$q=mssql_query(<<<SQL
Select
 X.TekstT2
From
 mbUser U, mbAnalit P, mbVidAn V, MBAnValR2 T, mbText X
Where
 U.NeedEncode='W' And U.UserKod=P.Dop And
 P.Vid=V.Vid And V.Kod='онк' And T.Analit=P.Analit
 And T.XRecID=X.SrcRecID And T.NumStr=$n
 And U.UserLogin=
SQL
    .mssql_escape($CFG->params->u));

$r=mssql_fetch_row($q);
if(!$r) return None();
echo $r[0];

function None()
{
 Header('HTTP/1.0 404');
}
?>
