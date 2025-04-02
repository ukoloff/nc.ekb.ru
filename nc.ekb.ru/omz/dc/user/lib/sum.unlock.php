<?
$e=getEntry($CFG->udn, 'lockoutTime');
$unlocked=(0==$e['count'] or 0==$e[$e['0']][0]);
$href='./'.htmlspecialchars(hRef('x', 'unlock'));
?>
&raquo;
<? if($unlocked): ?>
<A hRef="<?=$href?>">Снять</A> временную блокировку
<? else: ?>
Учётка временно заблокирована, <A hRef="<?=$href?>">разблокировать</A>
<? endif; ?>
<BR />
