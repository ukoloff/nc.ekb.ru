<?
$CFG->entry->Command='Отключить от Lync';
$CFG->entry->PoSH="Disable-CSUser '{$CFG->AD->Domain}\\{$CFG->params->u}'";
?>