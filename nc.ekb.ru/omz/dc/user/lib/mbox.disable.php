&raquo;
��������� � <!--<A hRef="./<?=hRef('x', 'mail', 'subject', 'xch')?>">���������� ��������</A>
��� � --><A hRef="./<?=hRef('x', 'mail', 'subject', 'mail')?>">�������� ��������� �����</A>
<BR />
&raquo;
������� ������������
<A hRef="./<?=hRef('x', 'mail')?>">������</A>

<H2>�������� �����</H2>

<?
if(!$CFG->entry->PoSH):
  $CFG->entry->PoSH="Disable-Mailbox '{$CFG->AD->Domain}\\{$CFG->params->u}' -Confirm:\$false {$CFG->DC}";
endif;
Input('PoSH', '��������� Exchange');
$CFG->params->mail0=1;
?>
