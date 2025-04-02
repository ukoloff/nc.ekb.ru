<?
LoadLib('/sort');
$CFG->sort=Array(
    'k'=>Array('field'=>'cn', 'name'=>'Папка'),
    'v'=>Array('field'=>'val', 'name'=>'Значение'),
    'd'=>Array('field'=>'desc', 'name'=>'Описание'),
);
$CFG->defaults->sort='k';


$q=ldap_list($CFG->h, $CFG->cdn->str(), "objectClass=Container", Array('cn', 'description'));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);

for($i=$e['count']-1; $i>=0; $i--):
 $q=$e[$i];
 $z->cn=utf2str($q['cn'][0]);
 $z->desc=utf2str($q['description'][0]);
 $X[]=$z;
endfor;

if($X):
 sortArray($X);
 sortedHeader('kd');
 $in=$CFG->params->in;
 if($in and '/'!=$in)$in.="/";
 foreach($X as $z):
  echo "<TR><TD><A hRef='./", hRef('in', $in.$z->cn),"'>", htmlspecialchars($z->cn), 
    "<BR /></A></TD><TD><Small>", htmlspecialchars($z->desc), "<BR /></Small></TD></TR>\n";
 endforeach;
 sortedFooter();
endif;

$CFG->sort['k']['name']='Строка';

$q=ldap_list($CFG->h, $CFG->cdn->str(), "(&(objectClass=sendmailMTA".$CFG->Sendmail->Class.
		"Object)(|(sendmailMTA".$CFG->Sendmail->Grouping."=".$CFG->Sendmail->Map.
		")(sendmailMTA".$CFG->Sendmail->Grouping."=#".$CFG->Sendmail->Map.")))", 
    Array('sendmailMTAKey', 'sendmailMTA'.$CFG->Sendmail->Class.'Value', 'description'));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);

unset($X);

for($i=$e['count']-1; $i>=0; $i--):
 $q=&$e[$i];
 $z->cn=utf2str($q['sendmailmtakey'][0]);
 $val='';
 $ZZ=&$q['sendmailmta'.strtolower($CFG->Sendmail->Class).'value'];
 for($j=0; $j<$ZZ['count']; $j++):
   if($val) $val.="\r\n";
   $val.=utf2str($ZZ[$j]);
 endfor;
 $z->val=$val;
 $z->desc=utf2str($q['description'][0]);
 $X[]=$z;
endfor;

sortArray($X);
sortedHeader('kvd');
if($X)foreach($X as $z):
 echo "<TR><TD><A hRef='item/", hRef('in', null, 'k', $z->cn), "'>", htmlspecialchars($z->cn), "<BR /></TD><TD>",
    nl2br(htmlspecialchars($z->val)), "</A><BR /></TD><TD><Small>",
    htmlspecialchars($z->desc), "<BR /></Small></TD></TR>\n";
endforeach;
sortedFooter();

?>
<HR />
&raquo;
Добавить <A hRef='item/<?=hRef('x', 'new', 'sort', null)?>'>строчку</A>,
<A hRef='<?=hRef('x', 'new')?>'>подсписок</A>...
