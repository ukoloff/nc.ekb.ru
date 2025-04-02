<? // ������ ������� ��� ������ � HTML/HTTP

# ������� URL ��� <A hRef=> �� ����������� $CFG->params � ���������� ������
function hRef()
{
 global $CFG;
 $params=get_object_vars($CFG->params);
 $argv=&func_get_args();
 while(count($argv)>0):
  $x=&array_shift($argv);
  if(is_object($x)) $x=get_object_vars($x);
  if(is_array($x)):
   foreach($x as $k=>$v)
    $params[(string)$k]=(string)$v;
  else:
   $v=array_shift($argv);
   $params[(string)$x]=isset($v)? (string)$v : $CFG->defaults->$x ;
  endif;
 endwhile;
 $R='';
 if($params)
  foreach($params as $k=>$v)
   if($v!=$CFG->defaults->$k) $R.=(''==$R?'?':'&').urlencode($k).'='.urlencode($v);
 return $R;
}

# �������� ����� <Input Type=Hidden> ��� ����������� $CFG->params
function hiddenInputs()
{
 global $CFG;
 if(!is_object($CFG->params)) return;
 foreach(get_object_vars($CFG->params) as $k=>$v)
  if($v!=$CFG->defaults->$k)
   echo "<Input Type=Hidden Name=\"", htmlspecialchars($k), "\" Value=\"", htmlspecialchars($v), "\" />\n";
}

# �������������� ������� ����� � ���������
function transLit($S)
{
 $r="�������������������������";
 $l="abvgdeziyklmnoprstufh'y'e";
 $t=Array('�'=>'yo', '�'=>'zh', '�'=>'ts', '�'=>'ch', '�'=>'sh', '�'=>'sch', '�'=>'yu', '�'=>'ya',);
 $r=$r.strtoupper($r);
 $l=$l.strtoupper($l);
 foreach($t as $ru=>$la)
  $t[ucfirst($ru)]=ucfirst($la);
 return strtr(strtr($S, $r, $l), $t);
}


# ������������ ������ ��� ��������� ���������
function headerEncode($S)
{
 global $CFG; 
 return "=?{$CFG->charSet}?B?".base64_encode($S)."?=";
}

# ������� ����� ������������
function SendMail($to, $Subj, $Body)
{
 mail($to, headerEncode($Subj), $Body,
"From: ".headerEncode("��������� �������������")." <root@ekb.ru>
Organization: UralKhimMash http://ekb.ru
MIME-Version: 1.0
Content-Type: text/plain; charset=windows-1251
Content-Transfer-Encoding: 8bit
X-Mailer: PHP ".phpversion());
}

# ������ �������� ������� ���/������
function forceAuth()
{
  Header("WWW-Authenticate: Basic realm=\"Control center\"");
  Header("HTTP/1.0 401 Unauthorized");
}

# ���������, ������������ �� �� � ����������� �����������, ���� ���
function CheckAuth($relaxed=0)
{
 global $CFG;
 if($CFG->Auth>0 or $relaxed and $CFG->Auth<0) return 1;
 ForceAuth();
 return 0;
}

function AuthorizedOnly($relaxed=0)
{
 if(CheckAuth($relaxed)) return;
 uxmHeader();
 echo "<H3 Class='Error'>��� ��������� ���� �������� ��� ����� ������ �����������</H3>
</body></html>
";
 exit;
}

# ����������� ������ ��� ������ � JavaScript
function jsEscape($S)
{
 return "'".AddSlashes($S)."'";
}

# ������� �������� ����������� ��������� ��������
function uxmHeader($title='')
{
 global $CFG;
 if(!$title)$title='��� &laquo;����������&raquo;';
 $CFG->title=$title;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<?
 foreach($CFG->styleSheets as $x)
  echo "<link REL=STYLESHEET TYPE='text/css' HREF='$x'>\n";
 unset($CFG->styleSheets);
?>
<Script Src='/menu.js'></Script>
<title><?=$title?></title>
</head><body>
<NoScript><Div Class='Error'>��� ��������� ����� ����� ��� ���������� ����� JavaScript</Div></NoScript>
<!--<Div Style='background: yellow; border: 1px dotted red; text-align: center; font-size: 87%;'>
��� ���������� ������ �����. ��������, ��� ����� <A hRef='/omz/'>���������� ������</A>.</Div>-->
<Script><!--
<?
 for($i=&new menuIterator($CFG->Menu); $x=&$i->item(); $i->advance()):
  echo "AddMenu(", $i->Level(), ", ", jsEscape($x->text), ", ", jsEscape($x->href), ");\n";
  foreach(Array("title", "status", "target") as $prop)
    if($x->$prop) echo "\tmItem.$prop=", jsEscape($x->$prop), ";\n";
 endfor;
?>
StartUp();
//--></Script>
<?
 unset($CFG->Menu);
 flush();
// ob_flush();
 LoadLib('stop');
}
?>
