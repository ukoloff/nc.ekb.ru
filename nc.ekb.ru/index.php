<?
require('lib/uxm.php');

Authorized();

ini_set("session.use_cookies", false);
session_name('out');

$X=0;

if(isset($_GET['login'])):
 if($CFG->Auth>0): // ������� ��������������
  $X='/';
  if($_SERVER['HTTP_REFERER']): 
//   $X=$_SERVER['HTTP_REFERER']; 
   $X='/'; 
  endif;
 else: // �� ��������������, ��������� �����������
  $X=-1; 
 endif;
elseif(isset($_GET['logout'])):
 session_start();
 $_SESSION['From']=$_SERVER['HTTP_REFERER'];
 $X='/?'.session_name().'='.session_id();
elseif($_GET[session_name()]):
 session_start();
 $X=-1;
 if($_SESSION['n'])
  if( ''==$_SERVER['PHP_AUTH_USER'] or $CFG->Auth>0):
   $X='/';
//   if($_SESSION['From']) $X='/';	// $X=$_SESSION['From'];
   session_destroy();
  endif;
 $_SESSION['n']=1;
endif;

if(-1==$X): 
 ForceAuth();
elseif($X):
 header("Location: $X");
 header("HTTP/1.0 301 Go to");
endif;

uxmHeader();
?>
<Script><!--
if(location.search)location.href='/';
//--></Script>
<Style><!--
Img.Icon {
    width: 16px;
    height: 16px;
    border: none;
}
--></Style>
<Table Width='100%' CellSpacing='0' CellPadding='0'>
<TR><TD>
<!--[if IE ]>
<A hRef='/' Style='behavior:url(#default#homepage);' onClick='this.setHomePage(this.href);return false;'>
<Img Src='/img/home.gif' Class='Icon' Alt='������� �������� ���������'></A>
<![endif]-->
<Script><!-- 
if(typeof(window.external)==typeof(window))
  document.writeln("<A hRef='/' onClick='window.external.AddFavorite(this.href, \"������� �����\");return false;'>"+
    "<Img Src='/img/favor.gif' Class='Icon' Alt='�������� � ��������'></A>");
//--></Script>
<BR /></TD><TD>
<H1>���� ��� &laquo;����������&raquo;</H1>
</TD></TR></Table>
<?
if($CFG->Auth):
 $e=getEntry(user2dn($CFG->u), 'displayName');
 $e=$e['displayname'][0];
 if(!$e)$e=$CFG->u;
 echo "����������� ���, ", utf2html($e), "!<P>";
endif;
?>
�� ���� �������� �� ������ ��������� ��������� ����������� ����� ������� ������ � ��������� ���� ��� "����������". 
<P>
����� �� �� ������ ��������� �������� � ��������������� �����
��� "����������" <A hRef='/help/'>�������</A><!-- , ������� �����
���������� � <A hRef='/help/dial/'>����������� � ���� �� ������</A> (� �������������� ����������
�����) -->.
<?
if(!$CFG->Auth):
?>
<P>
��� ������ ���������� ����� ������� ������� (����� ������ �/��� ��������� ����������)
�������� ����� ���� <A hRef='/?login'>�����</A>
<?
endif;
?>
<P>
���� ��� ����� �� ��� �������� �� ������ �������������� � ������������� ��������� ����������
�������, ��������� � ���������� <A hRef='/help/cert/'>�������� ����������</A> ���� ��� "����������".

</body></html>
