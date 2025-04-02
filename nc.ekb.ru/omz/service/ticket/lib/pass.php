<? LoadLib('pass.data'); ?>
<FieldSet>
<Legend>Сменить пароль
</Legend>
<Form Action='./' Method='POST' Target='Rehash' onSubmit='startRehash(this)'>
<Input Type='Hidden' Name='rehash' Value="<?=$CFG->params->i?>" />
<Div>
<Input Type='Button' Value=' Сменить пароль билета! ' onClick='testSure(this)' />
</Div>
<Div Style='display: none;'>
<Input Type='Button' Value=' Нет, я передумал менять ' onClick='notSure(this)' />
<Input Type='Submit' Value=' Да, я уверен, меняйте! ' />
</Div>
<Div Style='display: none;'>
Генерация нового пароля...
</Div>
<Div Style='display: none;'>
Новый пароль: <Input id='newPass' Disabled />
<BR />
<Small>
&raquo;
Пароль в открытом виде есть только в этом окне. Если Вы закроете это окно, Вы не сможете снова его посмотреть.
<BR />
&raquo;
Рекомендуем открыть текст пароля (и остальные реквизиты билета) в <A hRef='print/' Target='printWiFi'>отдельном окне</A>
</Small>
</Div>
</Form>
</FieldSet>
<iFrame Name='Rehash' Src='0/' Style='display: none;'></iFrame>
