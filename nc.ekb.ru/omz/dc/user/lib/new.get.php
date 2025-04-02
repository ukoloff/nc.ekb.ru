<?
$CFG->params->ou=$CFG->entry->ou=trim($_GET['ou']);
$CFG->entry->company=ou2company($CFG->entry->ou);
$CFG->entry->l='Екатеринбург';
$CFG->entry->c='RU';

function ou2company($ou)
{
 if(preg_match('#^/#', $ou)) return '';
 if(preg_match('#^Внешние/УМЗ($|/)#', $ou)) return 'УМЗ';
 if(preg_match('#^Внешние($|/)#', $ou)) return '';
 return 'Уралхиммаш';
}
?>