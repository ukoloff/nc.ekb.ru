<?
mssql_query('set ansi_warnings, ANSI_NULLS, QUOTED_IDENTIFIER, CONCAT_NULL_YIELDS_NULL, ANSI_PADDING, ARITHABORT on');

$q=mssql_query(<<<SQL
Select P.Analit, U.Dop, W.UserLogin, Tekst
From MBAnalit R, MBText, MBAnalit U, MBUser W, MBAnalit P
Where R.Vid=(Select Vid From MBVidAn Where Kod='ÐÀÁ')
 And R.Polzovatel=U.Analit
 And R.Persona=P.Analit
 And U.Dop=W.UserKod 
 And W.NeedEncode='W'
 And P.Analit=SrcRecID
SQL
);

$NF=0;
$NU=0;
while($r=mssql_fetch_assoc($q)):
 $dn=user2dn($r[UserLogin]);
 if(!$dn) continue;
 $NF++;
 $a=getEntry($dn, 'thumbnailPhoto jpegPhoto');
 $a=$a[thumbnailphoto][0];
 if(!$a) $a=$a[jpegphoto][0];
 if(!$a) continue;

 if($r[Tekst]==$a) continue;


 mssql_query("Update MBText Set Tekst=CAST('<data>\n".
    chunk_split(base64_encode($a)).
    "\n</data>' as xml).value('(data)[1]', 'varbinary(max)') Where SrcRecId=".$r[Analit]);

 echo "<LI>", $r[UserLogin], '{', $r[Analit], '}',
    " [", strlen($a), "]\n";
 $NU++;
// break;
endwhile;
?>
<HR />
Found: <?=$NF?>
<BR />
Updated: <?=$NU?>

<?/* <http://blog.falafel.com/Blogs/adam-anderson/2012/10/18/t-sql-easy-base64-encoding-and-decoding>

declare @source varbinary(max), @encoded varchar(max), @decoded varbinary(max)
set @source = convert(varbinary(max), 'Hello Base64')
set @encoded = cast('' as xml).value('xs:base64Binary(sql:variable("@source"))', 'varchar(max)')
set @decoded = cast('' as xml).value('xs:base64Binary(sql:variable("@encoded"))', 'varbinary(max)')

select
 convert(varchar(max), @source) as source_varchar,
    @source as source_binary,
    @encoded as encoded,
    @decoded as decoded_binary,
 convert(varchar(max), @decoded) as decoded_varchar

*/?>