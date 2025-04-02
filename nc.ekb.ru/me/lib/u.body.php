<?
if($CFG->Auth):
 LoadLib('/user');
 userInfo($CFG->u);
else:
 echo "<Center>Для просмотра сведений о себе, необходимо <A hRef='/?login'>зарегистрироваться</A> в системе...</Center>";
endif;
?>
