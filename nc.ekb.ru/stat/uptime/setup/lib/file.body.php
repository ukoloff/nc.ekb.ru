<? if($CFG->emptyDB): ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'init')) ?>">������� �������</A> � ���� <B>������</B> �����<BR />
<? elseif(preg_match('/\\.schema$/', $CFG->params->f)): ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'zip')) ?>">����������� ����� � ��������</A><BR />
<? else: ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'schema')) ?>">����������� �����</A><BR />
<? endif; ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'unlink')) ?>">�������</A> ���� ����<BR />
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'copy')) ?>">�����������</A> ����<BR />
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'rename')) ?>">�������������</A> ����<BR />
