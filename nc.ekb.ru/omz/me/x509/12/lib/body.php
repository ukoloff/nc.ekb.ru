<?
foreach($_SERVER as $k=>$v):
 if(!preg_match('/^SSL_/', $k))continue;
 echo "<LI><b>", htmlspecialchars($k), "</b>=", htmlspecialchars($v), "\n";
endforeach;
?>