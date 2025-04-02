<?
LoadLib('/tabs');

$CFG->title='Âíåøíèå ÁÄ';

$CFG->tabs=Array(
//  'v2010'=>'ÂÎÕÐ',
    '1c'=>'1Ñòàð',
    'v2011'=>'ÂÎÕÐ',
    '1c2024'=>'1Ñ',
    'sigur'=>'ÑÊÓÄ',
    'papercut' => 'PaperCut',
    'tsg' => 'Terminal',
);
$CFG->defaults->x='sigur';

//if('stas'==$CFG->u or 'elsner'==$CFG->u) $CFG->tabs['v2011']='ÂÎÕÐ+';
//if(preg_match('/^s[.]ukolov1?$/', $CFG->u)) $CFG->tabs['1c'] = '1Ñòàð';

tabsInit();

function dbConnect()
{
 global $CFG;
 LoadLib($CFG->params->x.'.connect');
}
?>
