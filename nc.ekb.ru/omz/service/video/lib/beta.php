<? if(isBoss()): ?>
<Script><!--
document.body.className='iBoss';
//--></Script>
<? endif; ?>
<center>
<FieldSet><Legend><A hRef='#' onClick='fsX("divC"); return false;' title='Свернуть/Развернуть'>
Камеры
</A></Legend><Div id='divC'>
<Div Class='setup2'>
<?
$cFilter=cFilter();
$q=mssql_query(<<<SQL
Select 0 As id, 'Все камеры' As name, '' As cameras
Union Select id, name, cameras From list Where show>0
SQL
);
unset($Options);
unset($Lists);
while($r=mssql_fetch_object($q)):
 $r2=preg_split('/\D+/', $r->cameras, null, PREG_SPLIT_NO_EMPTY);
 $r2=mssql_fetch_row(mssql_query("Select ', '+Cast(id As VarChar) As '*' From cam Where skip=0".$cFilter.
    (count($r2)?' And id in ('.join(', ', $r2).')':'').
    " Order By id For XML Path('')"));
 $r->list=$r2=substr($r2[0], 2);
 if((int)$_REQUEST['v']==$r->id) $r->selected=1;

// if(!$r->id) $r->out=1;	// Все камеры
 if(!$r->list) continue;
 if(!$r->selected and $Lists[$r->list]) continue;

 $Lists[$r->list]=1;
 if(!count($Options) or $r->selected) $vFilter=$r->list;
 $Options[]=$r;
endwhile;
if(!strlen($vFilter))$vFilter='0';
if(count($Options)>1):
?>
<Select onchange='gotoList(this)'>
<?
foreach($Options As $z)
  echo "<Option Value='{$z->id}'", $z->selected?' Selected':'',">", htmlspecialchars($z->name),
    "\t[", 1+strlen(preg_replace('/[^,]/', '', $z->list)), "]</Option>\n";
?>
</Select>
<?endif;?>
<Input Type='CheckBox' id='autoHide' Checked />
<Label For='autoHide'>Сворачивать автоматически</Label>
</Div>
<?
$q=mssql_query('Select * From cam Where skip=0'.$cFilter." And id in ($vFilter)");
$N=0;
$js='';
while($r=mssql_fetch_object($q)):
 $id=(int)$r->id;
 echo "<span class='thumb'><div><A href='./#' onClick='s($N); return false;' Title=\"",
    htmlspecialchars($r->name), " \n", htmlspecialchars($r->comment),
    "\"><img\nid='thumb$N' src='loading.gif' /><BR /><b>",
    htmlspecialchars($r->name), "</b><BR /><i>", htmlspecialchars($r->comment), "</i></A></div></span\n>";
 if($js)$js.=",\n";
 $js.="\t{id: ".$r->id.', name: '.j($r->name).', comment: '.j($r->comment).'}';
 $N++;
endwhile;

function j($S)
{
 return jsEscape(htmlspecialchars($S));
}

function isBoss()
{
 global $CFG;
// if('stas'==$CFG->u) return 1;
 $dn=user2dn($CFG->u);
 if(!$dn) return;
 $dn=new DN($dn);
 $dn=$dn->ufn();
 return 'Дирекция'==$dn->str();
}
?>
</Div></FieldSet>
<FieldSet><Legend><A hRef='#' onClick='fsX("divTV"); return false;' title='Свернуть/Развернуть'>
Просмотр
</A></Legend><Div id='divTV' style='display: none;'>
<Div id='-divC'>&raquo;<A hRef='#' onClick="fsBack(); return false;">Вернуться к списку камер</A>&laquo;</Div>
<img src='logo.gif' id='tv' /><BR />
<b id='cName'></b><BR />
<i id='cComment'></i>
</Div></FieldSet>
<Script><!--
var Cameras=[
<?=$js?>

];
//--></Script>
<Script Src='tv.js'></Script>
