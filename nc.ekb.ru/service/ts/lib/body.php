<?
global $CFG;

uxmHeader('������������ ������');
?>
<H1>������������ ������</H1>
<Div id='divLoading'><Center>
���������, ��� �������� ActiveX-����������...
</Center></Div>
<Div id='noActiveX' Style='display: none; color: red; text-align: center;'>
ActiveX-��������� �� ��������. �������� ���������� �� ����� ���� �����������!
</Div>
<? if(!$CFG->Connect) LoadLib('form'); ?>

<Script Src='rdp.js'></Script>
<? if($CFG->Connect): ?>
<Script><!--
function doRDP(x)
{
<? if($CFG->Connect>1): ?>
 x.server='<?=$_SERVER['SERVER_ADDR']?>';//'ekb.ru';
 x.AdvancedSettings2.RDPPort=<?=$CFG->RDP['Port']?>;
<? else: ?>
 x.server=<?=jsEscape($CFG->entry->s)?>;
<? endif; ?>
 x.FullScreenTitle=<?=jsEscape('RDP Web: '.$CFG->entry->s)?>;
 x.DesktopWidth=<?= $CFG->entry->w? $CFG->entry->w : 'screen.width' ?>;
 x.style.height=x.DesktopHeight=<?= $CFG->entry->w? calcH($CFG->entry->w) : 'screen.height' ?>;
<? if(!$CFG->entry->w): ?>
 x.FullScreen=1;
<? endif;
 if($CFG->entry->u): ?>
 x.UserName=<?=jsEscape($CFG->u)?>;
// x.Domain='LAN';
 x.Domain='OMZGLOBAL';
<?
 endif;
 foreach(Array(/*'Clipboard'=>'clp', */'Drives'=>'drv',  'Printers'=>'prn',  'Ports'=>'prt',  'SmartCards'=>'crd') as $k=>$v): ?>
 x.AdvancedSettings2.Redirect<?=$k?>=<?= $CFG->entry->$v? 1 : 0 ?>;
<? 
 endforeach; 
?>
<?// x.AdvancedSettings2.ConnectToServerConsole=1; ?>
}
backTo=<?=jsEscape(hRef($CFG->entry))?>;
//--></Script>
<?endif;?>
<Center>
<Object ID="MsRdpClient"
 ClassID="CLSID:7584c670-2274-4efb-b00b-d6aaba6d3850" CodeBase="msrdp.cab#version=5,2,3790,3959"
 onError="loadError()" onReadyStateChange='onReady()'
 Style='<?= $CFG->Connect? 'width: 100%' : 'display: none' ?>;'
></Object>
</Center>
<? if($CFG->Connect): ?>
<Div id='connectionOn' Style='display: none;'>
����������� ���������� � <?
 echo htmlspecialchars($CFG->entry->s);
 if($CFG->Connect>1) echo ' ����� ekb.ru';
?>
</Div>
<? else: ?>
<HR />
<Small>
&raquo;
������ �������� ��������� ������������� ������������ ���������� (Remote Desktop Protocol) ������ �������������
���������� ��� "����������", ��� ������� ��������� ���� ������, ��� � ��������.
<Div id='ie7security'>
&raquo;
��� MSIE ������ 7 � �����, ���� ������ ActiveX ���������� ���������� ����������� ������������, ��������� ���� <A href='ekb.reg'>������</A>,
������������� MSIE � ���������� �����
</Div>
</Small>
<? endif; ?>
