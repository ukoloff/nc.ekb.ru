<Form Action='./' Method='POST'>
<?
LoadLib('/forms');

$CFG->entry->pass=trim($_REQUEST['pass']);

function uxmHash($pass)
{
 $salt1=chr(rand(0, 255)).chr(rand(0, 255));
 $salt2=chr(rand(0, 255)).chr(rand(0, 255));
 return base64_encode($salt1.pack('H*', sha1($salt1.$pass.$salt2)).$salt2);
}

function uxmHashFiltered($pass)
{
 while(!preg_match('/^\w+$/', $h=uxmHash($pass)));
 return $h;
}

Input('pass', '������');
?>
<Input Type='Submit' Value=' ����������! ' />
</Form>
<?
if(!strlen($CFG->entry->pass)) return;
?>
&raquo;
hash(<?=htmlspecialchars($CFG->entry->pass)?>)=<?=htmlspecialchars(uxmHashFiltered($CFG->entry->pass))?>
<BR />
&raquo;
������ hash ������� �������� � ���� 
<code>[\\dbServ\Programs\Video\config.adp].[user].[hash]</code>
<?
if($CFG->intraNet) echo '<A hRef="file://dbServ/Programs/Video/" Target="_blank">���-���?</A>';
?>
<BR />
&raquo;
��������� ������������� ������� ���� � ����� ������������ ��� ������
