<?
header('Expires: 0');
unset($CFG);

Traverse();

function Traverse()
{
 global $CFG;
 $CFG->styleSheets=Array();
 $scriptName=$_SERVER['SCRIPT_NAME'];
 if(!$scriptName) $scriptName='/index.php';
 $path=explode('/', $scriptName);
 $absPath=preg_replace('|(/lib)?/[^/]*$|', '', __FILE__);
 $CFG->relPath=Array();
 while(count($path)>0):
  if(!($folder=array_shift($path))) continue;
  $lib="$absPath/lib/autoload.php";
  if(file_exists($lib)) require_once($lib);
  foreach(glob("$absPath/*.css") as $x) array_push($CFG->styleSheets, "$relPath/".basename($x));
  $CFG->Menu->parseIni("$absPath/.menu", $relPath ? "$relPath/":"");
  $relPath.="/$folder";
  $absPath.="/$folder";
  $CFG->relPath[]=$folder;
 endwhile;
}

?>
