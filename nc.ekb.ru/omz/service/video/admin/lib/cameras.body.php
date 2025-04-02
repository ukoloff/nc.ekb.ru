<Script><!--
function cameraThumb(TD, n)
{
 if(!TD.getElementsByTagName('img').length)
 {
  var z=document.createElement('img');
  z.className='userThumb';
  z.src='./?jpg&w=160&n='+n;
  TD.appendChild(z);
  TD.onmouseout=function(){z.style.display='none';};
 }
 TD.getElementsByTagName('img')[0].style.display='inline';
}

function cFilter(s)
{
 var X=findId('@*'), Y;
 if(!X) return;
 X=X.rows;
 s=s.value;
 if(s.length)
 {
  Y={};
  s=s.split(',');
  for(var i in s) Y['@'+s[i]]=1;
 }
 for(var i in X)
 {
  var r=X[i];
  r.style.display=(!Y || Y[r.id])?'':'none';
 }
}
//--></Script>
<Div Align='Right'>
<? LoadLib('cam.filter'); ?>
</Div>
<?
LoadLib('/sort');
$CFG->sort=Array(
    'i'=>Array(field=>'id', name=>'Id'),
    's'=>Array(field=>'skip', name=>'!', title=>'Не показывать камеру'),
    'h'=>Array(field=>'Host', name=>'IP/DNS'),
    'v'=>Array(field=>'model', name=>'Модель'),
    'n'=>Array(field=>'name', name=>'Имя'),
    'x'=>Array(Xfield=>'comment', name=>'Комментарий'),
);
$CFG->defaults->sort='i';
adjustSort();
sortedHeader('sihvnx');
echo "<TBody id='@*'>";

$q=mssql_query('Select *, (Select Name From vendors Where id=vendor) As model From cam '.sqlOrderBy());
unset($CFG->params->sort);
while($r=mssql_fetch_object($q)):
 echo '<TR id="@', $r->id, '"><TD Align="Center">', htmlspecialchars($r->skip)? '#':'',
    '<BR /></TD><TD Align="Right" onMouseMove="cameraThumb(this, ', $r->id,
	')"><A hRef="./', htmlspecialchars(hRef('x', $CFG->Dispatcher>1?'camera':'cam', 'i', $r->id)), '">', $r->id, '</A>',
    '<BR /></TD><TD>', htmlspecialchars($r->Host),
	$CFG->intraNet? ' <A hRef="http://'.htmlspecialchars($r->Host).'" Target="webCam" Title="Вебморда">&raquo;</A>':'',
    '<BR /></TD><TD>', htmlspecialchars($r->model),
    '<BR /></TD><TD>', htmlspecialchars($r->name),
    '<BR /></TD><TD><i>', htmlspecialchars($r->comment), '</i>',
    "</BR></TD></TR>\n";
endwhile;
if(!$cam):
?>
</TBody>
<TFoot><TR Class='tHeader'><TD ColSpan='6'>&raquo;
<A hRef='./<?=htmlspecialchars(hRef('x', 'camera', 'i', ' '))?>'><i>Добавить камеру</i></A></TD></TR></TFoot>
<?
endif;
sortedFooter();
?>
