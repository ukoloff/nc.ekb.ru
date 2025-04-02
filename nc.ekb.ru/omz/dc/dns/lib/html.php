<html><head>
<style><!--
body {
    background: #A0C0E0;
    color:black;
    font-family: Verdana, Arial, sans-serif;
}
<? readfile(dirname(__FILE__).'/../dns.css'); ?>
--></style>
<script><!--
function findId(id)
{
 return document.getElementById(id);
}
<? readfile(dirname(__FILE__).'/../dns.js'); ?>
//--></script>
</head><body>
<?
LoadLib('ashtml');
tree2html($CFG->Tree);
?>
</body></html>
