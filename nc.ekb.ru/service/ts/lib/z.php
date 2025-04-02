<?
echo preg_match('/(^192\.168\.\d+\.\d+$)|(^[-\w]+(\.lan(\.uxm)?)?$)/i', 'i_n-u.lan.uxm', $m)?'+':'-';
#echo preg_match('/^\w+/', '.')?'+':'-';
print_r($m);
?>