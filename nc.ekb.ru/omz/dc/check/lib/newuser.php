<? LoadLib('../user/checkNew'); ?>
Проверяемое имя: <?= htmlspecialchars(trim($_REQUEST['u'])) ?>
<P><?=checkNewUser()?>
