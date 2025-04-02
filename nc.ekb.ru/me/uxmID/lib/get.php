<?
# Первичная проверка - авторизован или нет
global $CFG;

//if(!checkAuth()) exit;

function newRand0()
{
 $S='';
 while(strlen($S)<31):
  $c=rand(0, 9+2*(1+ord('Z')-ord('A')));
  if(($c-=10)<0)$c+=ord('9')+1;
  else $c+= $c<=ord('Z')-ord('A') ? ord('A') : ord('a')-ord('Z')+ord('A')-1;
  $S.=chr($c);
 endwhile;
 return $S;
}

function newRand()
{
 $S='';
 while(strlen($S)<3*8)
  $S.=chr(rand(0, 255));
 return strtr(base64_encode($S), '+/', '-.');
}

function getRand()
{
 global $CFG;
 while(1):
  $S=newRand();
  $q=sqlite3_query($CFG->db, "Select Count(*) From Auth Where i=".sqlite3_escape($S));
  $x=sqlite3_fetch($q);
  sqlite3_query_close($q);
  if(0==$x[0]) return $S;
 endwhile;
}

$S=getRand();
sqlite3_exec($CFG->db, "Insert Into Auth(i, u, n) Values(".
    sqlite3_escape($S).", ".sqlite3_escape($CFG->u).", ".sqlite3_escape($_GET['n']).")");

Header('Location: '.preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']).'?i='.urlencode($S));

?>
