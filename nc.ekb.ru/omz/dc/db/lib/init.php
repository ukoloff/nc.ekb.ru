<?
LoadLib('/tabs');

$CFG->title='������� ��';

$CFG->tabs=Array(
//  'v2010'=>'����',
    '1c'=>'1����',
    'v2011'=>'����',
    '1c2024'=>'1�',
    'sigur'=>'����',
    'papercut' => 'PaperCut',
    'tsg' => 'Terminal',
);
$CFG->defaults->x='sigur';

//if('stas'==$CFG->u or 'elsner'==$CFG->u) $CFG->tabs['v2011']='����+';
//if(preg_match('/^s[.]ukolov1?$/', $CFG->u)) $CFG->tabs['1c'] = '1����';

tabsInit();

function dbConnect()
{
 global $CFG;
 LoadLib($CFG->params->x.'.connect');
}
?>
