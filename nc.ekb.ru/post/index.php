<?
require('../lib/uxm.php');

if('POST'!=$_SERVER['REQUEST_METHOD']):
 Header('HTTP/1.0 400 Bad request');
 exit;
endif;

$Break='* '.md5 (uniqid (rand())).' * '.$UNIQUE_ID.' *';

function Table($array)
{
  if(0==count($array)) return '';
  $S="<Table Border BgColor=#CCCCCC CellSpacing=0>\n";
  $N=0;
  reset($array);
  while(list($key, $val)=each($array)):
    $Color='';
    if(($N++)& 1) $Color=' BgColor=#DDDDDD';
    $S.="<TR$Color><TH Align=Right>".htmlspecialchars((string)$key)."</TH>\n<TD>"
      .nl2br(htmlspecialchars($val))."</TD></TR>\n";
  endwhile;
  return $S."</Table>\n";
}

function Page($array, $Title)
{
  global $Break;
  $S=Table($array);
  if($S)
   $S=
    "--$Break
Content-Type: text/html; charset=windows-1251; name=$Title

<HTML>
<Body><Center>
".$S."</Center></Body></HTML>
";
  return $S;
}

function Pages()
{
 global $Break,
  $_GET, $_POST, $_COOKIE,
  $_SERVER, $_ENV, $_SESSION;
 return
 Page($_GET, "Get").
 Page($_POST, "Post").
 Page(getallheaders(), "Headers").
 Page($_COOKIE, "Cookies").
 Page($_SERVER, "Server").
 Page($_ENV, "Environment").
 Page($_SESSION, "Session").
 "--$Break--
That's all folks!
";
}

$serverName=($_SERVER['HTTPS']?'https':'http')."://".$_SERVER['SERVER_NAME'];
if(!$subject)
  $subject="Сообщение администратору $serverName";

mail('System Administrator <stas@ekb.ru>',
  headerEncode($subject),
  "This is a multipart message in MIME format

--$Break
Content-Type: text/plain; charset=windows-1251

This message was sent via Web...

Это сообщение было послано через Web
--[Начало сообщения]--
".$_POST[body]."
".Pages(),
  "Content-Type: multipart/mixed; Boundary=\"$Break\"
From: WWW server ".headerEncode($serverName)." <apache@ekb.ru>");

if(substr($okpage=$_POST['okpage'], 0, 1)=='/'):
 $Ref=$okpage;
else:
 $Ref=getallheaders();
 $Ref=$Ref['Referer'];
 if($okpage) $Ref=preg_replace('/[^\/]*$/', $okpage, $Ref, 1);
endif;
header("Location: $Ref");

?>
