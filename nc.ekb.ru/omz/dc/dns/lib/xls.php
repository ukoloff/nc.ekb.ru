<html xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns="http://www.w3.org/TR/REC-html40">
<head>
<!--[if gte mso 9]><xml>
<x:ExcelWorkbook>
<x:ExcelWorksheets>
<x:ExcelWorksheet>
<x:Name>DNS</x:Name>
<x:WorksheetOptions>
<x:NoSummaryRowsBelowDetail/>
<x:NoSummaryColumnsRightDetail/>
</x:WorksheetOptions>
</x:ExcelWorksheet>
</x:ExcelWorksheets>
</x:ExcelWorkbook>
</xml><![endif]-->
<meta http-equiv="Content-Type" content='text/html; charset=windows-1251' />
</head><body>
<table>
<TR><TH>host</TH><TH>dc</TH><TH>type</TH><TH>value</TH></TR>
<?
if($CFG->entry->plain):
 pxls($CFG->Tree);
else:
 foreach($CFG->Tree->sub as $r)
  txls($r);
endif;

function xls1(&$T, $Style='')
{
 echo "<TR$Style><TD>", htmlspecialchars($T->path), "<BR /></TD>";
 if(preg_match('/^[-+]?\d/', $T->dc))
  echo "<TD x:fmla='=\"", htmlspecialchars($T->dc), "\"'>";
 else
  echo "<TD>", htmlspecialchars($T->dc);
 echo "<BR /></TD>";
}

function xlsRR(&$R)
{
 echo "<TD>", htmlspecialchars($R->RR), "<BR /></TD><TD>", htmlspecialchars($R->Value), "<BR /></TD></TR>\n";
}

function pxls(&$T)
{
 if($T->RRs)
  foreach($T->RRs as $r):
   xls1($T);
   xlsRR($r);
  endforeach;
 if($T->sub)
  foreach($T->sub as $r)
   pxls($r);
}

function txls(&$T, $Level=0)
{
 $Style=$Level? "display:none;mso-outline-level:$Level;" : '';
 $Style.='mso-outline-parent:collapsed';
 $Style=" Style='$Style'";
 if(!$T->RRs):
  xls1($T, $Style);
  echo "</TR>\n";
 endif;
 if($T->RRs)
  foreach($T->RRs as $r):
   xls1($T, $Style);
   xlsRR($r);
  endforeach;
 if($T->sub)
  foreach($T->sub as $r)
   txls($r, $Level+1);
}

?>
</table></body></html>
