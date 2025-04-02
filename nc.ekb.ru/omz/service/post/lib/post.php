<?
$CFG->Break='* '.md5 (uniqid(rand(), true)).' *';

function Table($array)
{
  if(0==count($array)) return '';
  $S="<Table Border BgColor='CCCCCC' CellSpacing='0'>\n";
  $N=0;
  foreach($array as $key=>$val):
    $Color='';
    if(($N++)& 1) $Color=' BgColor="#DDDDDD"';
    $S.="<TR$Color><TH Align='Right'>".htmlspecialchars((string)$key)."</TH>\n<TD>"
      .nl2br(htmlspecialchars($val))."</TD></TR>\n";
  endforeach;
  return $S."</Table>\n";
}

function Page($array, $Title)
{
  global $CFG;
  $S=Table($array);
  if($S)
   $S=
    "--{$CFG->Break}
Content-Type: text/html; charset=windows-1251; name=$Title

<HTML>
<Body>
".$S."</Body></HTML>
";
  return $S;
}

function Pages()
{
 global $CFG;
 return
  Page($_GET, "Get").
  Page($_POST, "Post").
  Page(getallheaders(), "Headers").
  Page($_COOKIE, "Cookies").
  Page($_SERVER, "Server").
  Page($_ENV, "Environment").
  Page($_SESSION, "Session").
 "--{$CFG->Break}--
That's all folks!
";
}

$serverName=($_SERVER['HTTPS']?'https':'http')."://".$_SERVER['SERVER_NAME'];
if(!$subject)
  $subject="Сообщение администратору $serverName";

mail('System Administrator <'.$_SERVER['SERVER_ADMIN'].'>',
  headerEncode($subject),
  "This is a multipart message in MIME format

--{$CFG->Break}
Content-Type: text/plain; charset=windows-1251

This message was sent via Web...

Это сообщение было послано через Web
--[Начало сообщения]--
".$_POST[body]."
--[Конец сообщения]--
".Pages(),
  "Content-Type: multipart/mixed; Boundary=\"{$CFG->Break}\"
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
