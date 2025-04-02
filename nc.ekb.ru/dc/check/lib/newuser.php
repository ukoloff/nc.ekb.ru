<? LoadLib('user'); ?>
<H1>Проверка пользователя</H1>
Проверяемое имя: <?= htmlspecialchars(trim($_REQUEST['u'])) ?>
<P><?=dcUser()?>
