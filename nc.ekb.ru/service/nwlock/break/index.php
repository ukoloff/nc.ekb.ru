<?
require("../../../lib/uxm.php");

global $CFG;
$CFG->params->id=0+trim($_REQUEST['id']);

uxmHeader('Разрыв соединения')
?>
<H1>Разрыв соединения</H1>
<? if('POST'==$_SERVER['REQUEST_METHOD']): 
system("/usr/bin/net rpc file close {$CFG->params->id} -S dbServ -U ".$_SERVER['PHP_AUTH_USER']."%".$_SERVER['PHP_AUTH_PW'], $A);
?>
<Script><!--
window.close();
//--></Script>
<H2>Соединение разорвано</H2>
<? else: ?>
<Center>
<Form Action='./' Method='POST'>
Вы уверены, что хотите разорвать это соедиение?
<P />
<Input Type='Submit' Value=' Да ' />
<Input Type='Button' Value=' Нет ' onClick='window.close()' />
<?
HiddenInputs();
?>
</Form>
</Center>
<Small>
Обрыв соединения с одним конкретным файлом может приводить к непредсказуемым
и неприятным последствиям. Применять эту меру следует только при необходимости,
и только если Вы точно знаете, что делаете.
</Small>
<? endif; ?>
</body>
</html>
