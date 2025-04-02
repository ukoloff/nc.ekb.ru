Hello, world!

<?
doDebug();
LoadLib('/userlog');

LogAuthAttempt('n3', 'p3');

function LogAuthAttempt($u, $p) {
  global $CFG;

  $s = $CFG->ulog->prepare("Select id From users Where name=?");
  $s->execute(Array($u));
  $row = $s->fetch();
  $user_id = $row[0];
  if(!$user_id):
    $s = $CFG->ulog->prepare("Insert Into users(name) Value(?)");
    $s->execute(Array($u));
    $user_id = $CFG->ulog->lastInsertId();
  else:
    $s = $CFG->ulog->prepare("Update users Set mtime=Now() Where id=?");
    $s->execute(Array($user_id));
  endif;

  $p = base64_encode($p);

  $s = $CFG->ulog->prepare("Select id From times Where user_id=? And pass=?");
  $s->execute(Array($user_id, $p));
  $row = $s->fetch();
  $pass_id = $row[0];
  if(!$pass_id):
    $s = $CFG->ulog->prepare("Insert Into times(user_id, pass) Value(?, ?)");
    $s->execute(Array($user_id, $p));
  else:
    $s = $CFG->ulog->prepare("Update times Set mtime=Now() Where id=?");
    $s->execute(Array($pass_id));
  endif;
}

?>