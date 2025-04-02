<Form Action='./' Method='Post' onSubmit='return doCheck()'>
<Table><TR vAlign='top'><TD NoWrap>
<?
LoadLib('/forms');
Input('s', 'Сервер'); BR();
?>
<Div id='sError' Class='itemError' Style='display:none;'>Введите имя сервера</Div>
<?
$Res=Array(0=>'Полный экран');
foreach(Array(640, 800, 1024, 1280, 1600) as $w)
  $Res[$w]=$w.'x'.calcH($w);
Select('w', $Res, 'Экран');
?>
<P>
<Input Type='Submit' id='btnConnect' Value=' Соединиться! '  Disabled />
</TD><TD noWrap>
<FieldSet><Legend><Small>Ресурсы</Small></Legend>
<?
$N=0;
foreach($CFG->Fields as $k=>$v):
 if(!$N and strlen($k)<3) continue;
 if($N++) 
  if(strlen($k)<3) HR(); else BR();
 CheckBox($k, $v);
endforeach; 
?>
</FieldSet>
</TD></TR></Table>

</Form>
