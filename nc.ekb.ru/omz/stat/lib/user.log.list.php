</Center><FieldSet><Legend><Small>������� � �������</Small></Legend>
<?
$NN=0;
$q=mysql_query("Select * From logOrder Where u=".$CFG->uSQL." And Spy='".AddSlashes($CFG->u)."' Order By At");
while($r=mysql_fetch_object($q)):
 if(!$NN++): ?>
<Table Border Width='100%' CellSpacing='0'><TR Class='tHeader'>
<TH>�������</TH>
<TH Title='������ ����� �������� � ��������� ����� ��� �����'>������ (�� �����)</TH>
</TR>
<?
 endif;
 echo "<TR><TD>{$r->At}</TD><TD>{$r->Trigger}</TD></TR>";
endwhile;
echo $NN? "</Table>":"�� �������";
?>
</FieldSet><Center>

