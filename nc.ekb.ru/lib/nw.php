<?	// Доступ к серверам Novell Netware
global $CFG;
$CFG->NWs=Array('pluto', 'kon');	//	Хосты серверов Novell Netware

function nwOpen($host)
{
 if(!$sock=fsockopen($host, 1080)) return;
 $x=fgets($sock);
 if('+'==$x{0}) return $sock;
 fclose($sock);
 return;
}

function nwCommand($sock, $cmd)
{
 $X=Array();
 if(!$sock) return $X;
 fputs($sock, "$cmd\n");
 while(true):
  $s=fgets($sock);
  if(substr($s, 0, 2)!='=>')return $X;
  $X[]=explode(';', trim(substr($s, 2)));
 endwhile;
}

function nwGetServerUser($sock, $user)
{
 $User->u=$user;
 $Server=nwCommand($sock, "server");
 $User->Server=strtoupper($Server[0][0]);
 foreach(nwCommand($sock, "user $user") as $x):
  switch(strtoupper($x[0]))
  {
   case 'ID': $User->ID=$x[1]; break;
   case "GROUPS_I'M_IN": $User->Groups=trim(base64_decode($x[1])); break;
   case "IDENTIFICATION": $User->Name=iconv("cp866", "cp1251", trim(base64_decode($x[1]))); break;
   case "LOGIN SCRIPT": $User->Login=trim(base64_decode($x[1])); break;
  }
 endforeach;
 if($User->ID) return $User;
 return;
}

function nwGetUser($u)
{
 global $CFG;
 foreach($CFG->NWs as $S)
  if($sock=nwOpen($S)):
   if($ux=nwGetServerUser($sock, $u)) $X[]=$ux;
   fclose($sock);
  endif;
 return $X;
}

function userDataSheet($u)
{
 if(!$X=nwGetUser($u)) return;
 echo "<Table Width='100%' Border CellSpacing='0'>\n";
 $Class=" Class='tHeader'";
 $TD='TH';
 foreach(Array('Server'=>'Сервер', 'ID'=>'Номер', 'Name'=>'Имя', 'Groups'=>'Группы', 'Login'=>'Подключение') as $k=>$v):
  echo "<TR vAlign='top'$Class><TH Align='Right'>$v</TH>\n";
  foreach($X as $u)
   echo "<$TD>", nl2br(htmlspecialchars($u->$k)), "<BR /></$TD>\n";
  echo "</TR>\n";
  $Class=''; $TD='TD';
 endforeach;
 echo "</Table>\n";
 return true;
}

function nwChangePass($u, $pass)
{
 global $CFG;
 foreach($CFG->NWs as $S)
  if($sock=nwOpen($S)):
   nwCommand($sock, "pass $u $pass");
   fclose($sock);
  endif;
}

?>
