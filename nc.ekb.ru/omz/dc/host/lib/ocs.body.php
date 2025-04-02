<table border width=100% cellspacing=0>
<tr class=tHeader>
<th>№</th>
<th>Пользователь</th>
<th>IP</th>
<th>ОС</th>
<th>Архитектура</th>
<th>Процессор</th>
<th>Память, Мб</th>
<th>Активен</th>
</tr>
<?
$q = $CFG->ocs->prepare('Select * From hardware Where NAME=? Order By LASTDATE Desc');
$q->execute(Array(preg_replace('/\$$/', '', $CFG->params->u)));
$N = 0;
while ($r = $q->fetchObject()):
?>
<tr>
<td align=right><small><?= ++$N ?></small></td>
<td><a href="../user/<?= htmlspecialchars(hRef('u', $r->USERID, 'x'))?>"><?= htmlspecialchars($r->USERID) ?></a><span class="^c"/></td>
<td><?= htmlspecialchars($r->IPADDR) ?><span class="^c"/></td>
<td><?= htmlspecialchars($r->OSNAME) ?></td>
<td><?= htmlspecialchars($r->ARCH) ?></td>
<td><?= htmlspecialchars($r->PROCESSORT) ?></td>
<td><?= htmlspecialchars($r->MEMORY) ?></td>
<td><?= htmlspecialchars($r->LASTDATE) ?></td>
</tr>
<?
endwhile;
?>
</table>
<script>
!function(){
setTimeout(install)

function doCopy() {
  navigator.clipboard.writeText(this.closest('td').innerText)
  return false
}

function install() {
  for (var s of document.querySelectorAll('span.\\^C')) {
    s.innerHTML='<a href="#" title="Скопировать в буфер обмена"><i class="fa fa-copy"></i></a>'
    s.firstChild.onclick = doCopy
  }
}}()
</script>
