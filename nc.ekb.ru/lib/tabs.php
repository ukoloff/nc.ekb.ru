<?
global $CFG;
$CFG->tabs=Array();
$CFG->params->x=$_REQUEST['x'];

function tabsGet()
{
}

function tabsAdjust()
{
 global $CFG;
 if(!isset($CFG->tabs[$CFG->defaults->x])):
  reset($CFG->tabs);
  $CFG->defaults->x=key($CFG->tabs);
 endif;
 if(!isset($CFG->tabs[$CFG->params->x])):
  $CFG->params->x=$CFG->defaults->x;
 endif;
}

function tabsHeader()
{
 global $CFG;
 tabsAdjust();
 echo "<Table Class='Tabs' CellSpacing='0' CellPadding='0'><TR Class='Tabs'><TD><Table CellSpacing='0'><TR>\n";
 foreach($CFG->tabs as $k=>$v):
  if(!$k) continue;
  echo "<TD Class='Empty'>&nbsp;</TD>\n<TD NoWrap Class='", 
   ($k==$CFG->params->x ? 'Active' : 'Passive'), "'><A hRef='./",
   htmlspecialchars(hRef('x', $k)), "'>",
   htmlspecialchars($v), "</A></TD>\n";
 endforeach;
 echo "<TD Class='EOL'><BR /></TD></TR></Table></TD></TR><TR><TD Class='Page' vAlign='top'>";
}

function tabsContent()
{
 global $CFG;
 $f="./lib/".$CFG->params->x.".body.php";
 if(file_exists($f)) require($f);
}

function tabsFooter()
{
 echo "<BR /></TD></TR></Table>\n";
}

# Действия перед выводом текста страницы
function tabsBeforeBody()
{
 global $CFG;
 tabsAdjust();

 $f="./lib/".$CFG->params->x.".";

 if(file_exists($ff=$f."php")) require($ff);

 switch($_SERVER['REQUEST_METHOD'])
 {
  case 'POST':
   $f.="post.php";
   if(!file_exists($f)):
    Header("Location: ./".hRef());
    return;
   endif;
   break;
  case 'GET':
   $f.="get.php";
   if(!file_exists($f)) return;
   break;
  default:
   Header('HTTP/1.0 400 Bad request');
   return;
 }
 require($f);
}

# Вывод текста страницы
function tabsBody()
{
 tabsHeader();
 tabsContent();
 tabsFooter();
}

function tabName()
{
 global $CFG;
 tabsAdjust();
 return $CFG->tabs[$CFG->params->x];
}

?>
