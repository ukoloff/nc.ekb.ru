<?
if(isset($_REQUEST['u'])):
 LoadLib('newuser');
elseif(isset($_REQUEST['g'])):
 LoadLib('groups');
elseif(isset($_REQUEST['ug'])):
 LoadLib('list');
elseif(isset($_REQUEST['oops'])):
 LoadLib('oops');
else:
 LoadLib('start');
endif;
?>
<HR />
<Center>
<Form><Input Type='Button' onClick='window.close()' Value=' Закрыть окно ' />
</Form>
</Center>
</body></html>
