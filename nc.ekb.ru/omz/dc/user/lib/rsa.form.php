<?
$e=getEntry(user2dn($CFG->rsa->u), 'mail userAccountControl');
if($e[useraccountcontrol][0]&uac_ACCOUNTDISABLE) return;
if(!$e[mail][count]) return;
?>
<P>
<Form Action='./' Method='Post'>
<Center>
<Input Type='Submit' Value=' Сгенерировать сертификат ' />
</Center>
<? hiddenInputs(); ?>
</Form>
