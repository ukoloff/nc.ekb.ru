<Center>
<Form Action='./' Method='POST'>
<Table><TR><TD>
<?
/*
exec('/sbin/ip rule list', $Res);
foreach($Res as $k)
  if(preg_match('/^50000:\s+/', $k) and preg_match('/\d+$/', $k, $M))
    $CFG->entry->z=$M[0];
*/
$c=curl_init($CFG->URL);
curl_setopt_array($c, Array(CURLOPT_SSL_VERIFYPEER=>false, CURLOPT_RETURNTRANSFER=>1));
$CFG->entry->z=curl_exec($c);
curl_close($c);

LoadLib('/forms');
foreach($CFG->Z as $k=>$v):
 RadioButton('z', $k, $v);
?>
<P>
<?
endforeach;
?>
</TD></TR></Table>
<Input Type='Submit' Value=' ����������! ' />
</Form>
</Center>
<Small>
&raquo;
����� ��������������� ����� �� ��������� ��� ������� � �������� �������
<BR />&raquo;
�������� �� ����������������� ������ �� ������������
<BR />&raquo;
������ ����� �������� �� ������ [����������������] ������
<BR />&raquo;
������� ������������ ������������ � ������
