<Input Type='Submit' Value='<?=' '==$CFG->params->i? 'Создать':'Сохранить'?>' />
<? if($CFG->noDelete or ' '==$CFG->params->i) return; ?>
<Input Type='Button' Value='Удалить' onClick='Sure(this)' />
