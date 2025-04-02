Hi!
<?
$p=dirname(__FILE__).'/sql';
echo $p;
echo '<BR />',(file_exists($p)?'+':'-');
echo '<BR />',(file_exists(__FILE__)?'+':'-');

?>