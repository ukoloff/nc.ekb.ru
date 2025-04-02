<P>
<Div Align='Center'>
Действительно хотите удалить это подразделение?
<P>
<Form Action='./' Method='POST'>
<Input Type='Submit' Value=' Да, хочу удалить ' <? if(!$CFG->may) echo "Disabled "; ?>/>
<?
hiddenInputs();
?>
</Form>
