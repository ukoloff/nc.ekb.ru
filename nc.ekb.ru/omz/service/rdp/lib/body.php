<? //LoadLib('tsg'); ?>
<Div id='divLoading'><Center>
���������, ��� �������� ActiveX-����������...
</Center></Div>
<Div id='noActiveX' Style='display: none; color: red; text-align: center;'>
ActiveX-��������� �� ��������. �������� ���������� �� ����� ���� �����������!
</Div>
<? if(!$CFG->Connect) LoadLib('form'); ?>

<Script><!--
<? if($CFG->Connect): ?>
function doRDP(x)
{
<? if($CFG->Connect>1): ?>
 x.server=<?=jsEscape($_SERVER[HTTP_HOST])?>;
// x.server='<?=$_SERVER['SERVER_ADDR']?>';//'ekb.ru';
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
 x.Domain=<?=jsEscape($CFG->AD->Domain)?>;
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
<?else:?>
doFocus();
<?endif;?>
//--></Script>
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
���������� ��� "����������" � ��� ������� (������� ������ � ������� ������)
<BR />
&raquo;
�������� �������� ������� � ������������ �������� ����� ������� 
<A hRef='/omz/help/TSG/'>���� ����������</A>
<![if !IE]>
<Div>
&raquo;
��������, ��� ����������� �������� ������ � �������� Microsoft Internet Explorer � ���������� � ����� ���������, ��� Google Chrome,
Firefox ��� Opera
</Div>
<![endif]>
<Div id='ie7security'>
&raquo;
��� MSIE ������ 7 � �����, ���� ������ ActiveX ���������� ���������� ����������� ������������, ��������� ���� <A href='ekb.reg'>������</A>,
������������� MSIE � ���������� �����
</Div>
<?
$q=sqlite3_query($CFG->db, "Select Count(*) From Log Where u=".sqlite3_escape($CFG->u));
$r=sqlite3_fetch($q);
sqlite3_query_close($q);
if($r[0]):
?>
<Div>&raquo;
���� <A hRef='/omz/stat/?x=rdp'>����������</A> ������������� �������
</Div>
<?endif;?>
</Small>
<? endif; ?>
