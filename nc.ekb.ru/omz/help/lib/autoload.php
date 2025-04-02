<?
$CFG->onLoadLib['body']='helpBody';
$CFG->onLoadLib['init']='helpTitle';

function helpTitle()
{
 global $CFG;
 $f=@fopen($CFG->pwd.'/.index.php', 'r');
 if(!$f) return;
 $s=fgets($f);
 fclose($f);
 if(!preg_match('/^<\?#/', $s)) return;
 $CFG->title=preg_replace('/(\s*\?>)?\s*$/', '', preg_replace('/^<\?#\s*/', '', $s));
}

function helpBody()
{
 global $CFG;
 $f=$CFG->pwd.'/.index.php';
 if(file_exists($f)) require_once($f);
}
?>
