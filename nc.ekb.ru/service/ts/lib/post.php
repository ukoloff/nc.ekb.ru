<?
global $CFG;

$CFG->entry->port='-';
foreach($CFG->Fields as $k=>$v):
 $CFG->entry->$k=trim($_POST[$k]);
 if($v) $CFG->entry->$k=$CFG->entry->$k? '1' : '';
endforeach;

if(!sqlite3_exec($CFG->db, "Insert Into Log(s, IP, u) Values(".
    sqlite3_escape($CFG->entry->s).", ".sqlite3_escape($_SERVER['REMOTE_ADDR']).
    ", ".sqlite3_escape($CFG->u).")"))
 die(sqlite3_error($CFG->db));

$No=sqlite3_last_insert_rowid($CFG->db);

#echo "A=",$CFG->intraNet, "<BR />B=", forIntra();

#if(1):
if(validHost($CFG->entry->s) and $CFG->intraNet!=intraHost($CFG->entry->s)):
 for($i=0; $i<10; $i++)
 {
  if(sqlite3_exec($CFG->db, "Insert Into Z(No, Expire, X) Values($No, datetime('now', '+10 seconds'), ".sqlite3_escape($X=rndX()).")")) break;
  unset($X);
 }

 if(!$X):
  die("Internal error!");
 elseif(count($_COOKIE)>0):
  setcookie('port', $X);
  unset($CFG->entry->port);
 else:
  $CFG->entry->port=$X;
 endif;

 exec(dirname(__FILE__).'/rdpRedirect '.$No);
endif;

Header('Location: ./'.hRef($CFG->entry));
exit;

function rndX()
{
 $S='';
 while(strlen($S)<5)
  $S.=chr(rand(ord('z'), ord('a')));
 return $S;
}

function validHost($host)
{
 return preg_match('/^[-\w.]+$/', $host);
}

function intraHost($host)
{
 global $CFG;
 return preg_match('/(^192\.168\.\d+\.\d+$)|(^[-\w]+(\.lan(\.uxm)?)?$)/i', $host);
}

?>
