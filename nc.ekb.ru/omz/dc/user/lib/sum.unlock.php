<?
$e=getEntry($CFG->udn, 'lockoutTime');
$unlocked=(0==$e['count'] or 0==$e[$e['0']][0]);
$href='./'.htmlspecialchars(hRef('x', 'unlock'));
?>
&raquo;
<? if($unlocked): ?>
<A hRef="<?=$href?>">�����</A> ��������� ����������
<? else: ?>
������ �������� �������������, <A hRef="<?=$href?>">��������������</A>
<? endif; ?>
<BR />
