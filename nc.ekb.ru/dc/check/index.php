<?
require('../../lib/uxm.php');

uxmHeader('��������');
if(isset($_REQUEST['u'])):
 LoadLib('newuser');
elseif(isset($_REQUEST['g'])):
 LoadLib('groups');
elseif(isset($_REQUEST['ug'])):
 LoadLib('list');
else:
 LoadLib('start');
endif;
?>
<HR />
<Center>
<Form><Input Type='Button' onClick='window.close()' Value=' ������� ���� ' />
</Form>
</Center>
</body></html>
