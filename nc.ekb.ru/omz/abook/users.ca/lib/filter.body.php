<Form Action='./' Method='GET' onSubmit='return buildFilter(this)'>
<Div id='Filters'><?
foreach($CFG->q as $q) aFilterLine($q);
?>
</Div>
<Div id='whenEmpty'<?if(count($CFG->q)) echo " style='display: none;'";?>>
<A hRef='#' onClick='addFilter(); return false;'>��������� ����������</A>
</Div>
<?
$CFG->defaults->q='!'.$CFG->params->q;
hiddenInputs();
unset($CFG->defaults->q);
?>
<Div id='whenFiltering'<?if(count($CFG->q)) echo " style='display: block;'";?>>
<A hRef='#' onClick='addFilter(); return false;'>�������� ������� ������</A>
<Input Type='Submit' id='Submit' Value='��������� ������' />
</Div>
</Form>
<?
aFilterLine();

function aFilterLine($q=null)
{
 global $CFG;
?>
<Div<? if(!$q) echo " id='emptyFilter'";?>>
<Select>
<Option Value=''>����...
<?
foreach($CFG->sort as $k=>$v)
 if($k)
    echo '<Option Value="', htmlspecialchars($k), '"', $k==$q->s? ' Selected':'', '>', htmlspecialchars($v[name]), "\n";
?>
</Select>
<Label><Input Type='Checkbox' <?if($q->not)echo "Checked ";?>/>
��
</Label>
<Select>
<?
foreach($CFG->ops as $k=>$v)
 if($k)
    echo '<Option Value="', htmlspecialchars($k), '"', $k==$q->o? 'Selected':'', '>', htmlspecialchars($v), "\n";
?>
</Select>
<Input Value="<?=htmlspecialchars($q->v)?>">
<A hRef='#' onClick='removeFilter(this); return false;'>������� ������</A>

</Div><?
}
?>