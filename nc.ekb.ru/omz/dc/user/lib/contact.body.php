<Script><!--

function translite(str){
 var arr={'�':'a', '�':'b', '�':'v', '�':'g', '�':'d', '�':'e', 
 '�':'zh', '�':'z', '�':'i', '�':'y', '�':'k', '�':'l', '�':'m',
 '�':'n', '�':'o', '�':'p', '�':'r', '�':'s', '�':'t', '�':'u',
 '�':'f', '�':'y', '�':'e', '�':'A', '�':'B', '�':'V', '�':'G',
 '�':'D', '�':'E', '�':'Zh', '�':'Z', '�':'I', '�':'Y', '�':'K',
 '�':'L', '�':'M', '�':'N', '�':'O', '�':'P', '�':'R', '�':'S',
 '�':'T', '�':'U', '�':'F', '�':'Y', '�':'E', '�':'yo', '�':'kh',
 '�':'ts', '�':'ch', '�':'sh', '�':'shch', '�':'yu',
 '�':'ya', '�':'Yo', '�':'Kh', '�':'Ts', '�':'Ch', '�':'Sh', '�':'Shch',
 '�':'', '�':'','�':'Yu', '�':'Ya'};
 var replacer=function(a){
if ((a=='�')||(a=='�')){return '';}else
return arr[a]||a;
};
 return str.replace(/[�-���]/g,replacer)
}

function defNames()
{
 f=document.forms[0];
 cn=f.cn;
 cn.focus();
 s=f.sn.value;
 s2='';
 x=f.givenName.value.substring(0, 1);
 if(x)
 { 
  s2=x+'.';
  if(s) s+=' '; s+=s2; 
 }
 x=f.middleName.value.substring(0, 1);
 if(x)
 {
  s+=x+'.';
  s2+=x+'.';
 }
 if(!cn.value || (cn.value!=s && confirm('�������� �������� ���� "<?= $CFG->Fields['cn']?>"?'))) 
  cn.value=s;
 s=(f.sn.value+' '+f.givenName.value+' '+f.middleName.value).replace(/\s+$/, '');
 cn=f.displayName;
 if(!cn.value || (cn.value!=s && confirm('�������� �������� ���� "<?= $CFG->Fields['displayName']?>"?'))) 
  cn.value=s;
 u=f.u;
 if(!u.value){
 u.focus();
 u.value=translite(f.givenName.value.substring(0, 1) + '.' + f.sn.value);
 }
}

function Valid()
{
 f=document.forms[0];
 x=f.u;
 if(!x.value) { alert('������� ������� ������!'); x.focus(); return false;}
 x=f.cn;
 if(!x.value) { alert('������� ��� ������������!'); x.focus(); return false; }
 return true;
}
//--></Script>
<Form Action='./' Method='POST' onSubmit='return Valid()'>
<Input Type='Hidden' Name='imgURL' Value="<?=htmlspecialchars($CFG->entry->imgURL)?>" />
<?
LoadLib('/forms');

if(!$CFG->udn):		// ��� �� contact, ��� new
 Input('u', '������� ������ [<A hRef="../check/" Target="checkWindow">���������</A>]');
 BR();
 unset($CFG->params->u);
 echo "<Script Src='ajax.js'></Script>";
endif;
//$CFG->defaults->Input->W=45;
//$CFG->defaults->Input->maxWidth=1;
//Input('ou', '�������������');
unset($CFG->params->ou);
//unset($CFG->defaults->Input->maxWidth);
$CFG->defaults->Input->W=31;
$CFG->defaults->Input->H=4;
?>
<Table Width='100%'><TR vAlign='top'>
<?
$N=0;
foreach($CFG->Fields as $k=>$v):
 switch($N++)
 {
  case 5:	echo "<Small>&raquo; <A hRef=# onClick='defNames(); return false;'>����������</A> ������ ����<BR />�� �.�.�.</Small>";
  case 10:	echo "</TD>\n";
  case 0:	echo "<TD NoWrap>";
 }
 if('='==$v{0}):
  TextArea($k, substr($v, 1));
 else:
  Input($k, $v);
  echo "<BR />\n";
 endif;
endforeach;
hiddenInputs();
?>
</TD></TR></Table>
<? Submit(); ?>
</Form>
<HR /><Small>
<BR/>&raquo;
����� �� 
<A hRef='../db/' Target='extDB'>������� �����</A>
</Small>
