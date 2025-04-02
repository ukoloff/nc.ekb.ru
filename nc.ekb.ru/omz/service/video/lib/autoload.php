<?
$CFG->Dispatcher=getDispatcher();

function getDispatcher($u=null)
{
 return inGroupX('#modifyDIT', $u)? 2 :
    (inGroupX('VideoDispatcher@uxm', $u)? 1 : 0);
}
?>
