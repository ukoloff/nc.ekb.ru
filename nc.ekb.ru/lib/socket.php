<?

function respLine($sock)
{
 $S=fgets($sock, 100);
 return $S[0]=='2';
}

function smtpCheckName($sock, $Name)
{
 if(!respLine($sock))return -1;
 fputs($sock, "HELO localhost\r\n");
 if(!respLine($sock))return -1;
 fputs($sock, "MAIL FROM: null@ekb.ru\r\n");
 if(!respLine($sock))return -1;
 fputs($sock, "RCPT TO: $Name\r\n");
 return 0+respLine($sock);
}

function checkUser($Name)
{
 if(!$sock=fsockopen("localhost", 25, &$ErrNo, &$ErrStr))
  return -1;
 $R=smtpCheckName($sock, $Name);
 fclose($sock);
 return $R;
}

?>
