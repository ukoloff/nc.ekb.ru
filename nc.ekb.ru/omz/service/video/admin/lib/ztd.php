<? if('stas'!=$CFG->u) return; ?>
</TD><TD vAlign='bottom'>
X=<BR />
Y=<BR />
<?foreach(Array(u=>'�����', d=>'����', l=>'�����', r=>'������', h=>'�����') as $k=>$v):?>
<Input Type='Button' Style='width: 100%;' Value='<?=$v?>' /><BR />
<?endforeach;?>
</TD>
