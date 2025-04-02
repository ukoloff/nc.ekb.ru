<? if($CFG->emptyDB): ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'init')) ?>">Создать таблицы</A> в этом <B>пустом</B> файле<BR />
<? elseif(preg_match('/\\.schema$/', $CFG->params->f)): ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'zip')) ?>">Подготовить схему к отправке</A><BR />
<? else: ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'schema')) ?>">Скопировать схему</A><BR />
<? endif; ?>
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'unlink')) ?>">Удалить</A> этот файл<BR />
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'copy')) ?>">Скопировать</A> файл<BR />
&raquo; <A hRef="./<?= htmlspecialchars(hRef('x', 'rename')) ?>">Переименовать</A> файл<BR />
