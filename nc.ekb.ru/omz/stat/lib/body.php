<?
tabsHeader();
echo "<Center>";
LoadLib((isset($CFG->params->list)?'list.':'user.').$CFG->params->x, 1);

unset($CFG->params->u);
if(!isset($CFG->params->list)) echo "<Center><HR /><A hRef='./", htmlspecialchars(hRef('list', '')), "'>Все пользователи</A></Center>";
?>
</Center><BR /></TD></TR></Table>

