<?
global $CFG;
//session_name('wizid');
ini_set("session.use_cookies", $CFG->Wizard->Cookies=(count($_COOKIE)>0));

if($CFG->Wizard->Session=$_REQUEST[$sName=session_name()]):
 session_start();
 $CFG->Wizard->x=$_SESSION['x'];
 if(!$CFG->Wizard->Cookies): $CFG->params->$sName=$CFG->Wizard->Session; endif;
else:
 unset($CFG->Wizard->x);
endif;

if(!file_exists("lib/{$CFG->Wizard->x}.body.php")) $CFG->Wizard->x="start";

if(file_exists($f="lib/{$CFG->Wizard->x}.php")):
  require_once($f);
endif;

if('POST'==$_SERVER['REQUEST_METHOD']):
 $CFG->Wizard->POST=1;
 if(!$CFG->Wizard->Session):
  session_start();
  $CFG->Wizard->x=$_SESSION['x']='start';
  if(!$CFG->Wizard->Cookies) $CFG->params->$sName=$CFG->Wizard->Session=session_id();
 endif;
 if(count($_SESSION['pass'])>0 and 'back'==$_REQUEST['x']):
  $_SESSION['x']=$CFG->Wizard->x=array_pop($_SESSION['pass']);
 elseif('cancel'==$_REQUEST['x']):
  nextPage('cancel');
//  if(file_exists($f="lib/cancel.pre.php")):
//   require_once($f);
//  endif;
 else:
  if(is_array($CFG->Wizard->Vars))
   foreach($CFG->Wizard->Vars as $v)
    $_SESSION[$v]=trim($_REQUEST[$v]);
  if(file_exists($f="lib/{$CFG->Wizard->x}.post.php")):
   require_once($f);
  endif;
  if($CFG->Wizard->nextPage) nextPage($CFG->Wizard->nextPage);
 endif;
 Header("Location: ./".hRef());
endif;

if(is_array($CFG->Wizard->Vars))
 foreach($CFG->Wizard->Vars as $v)
  $CFG->entry->$v=$_SESSION[$v];

if(file_exists($f="lib/{$CFG->Wizard->x}.php")):
  require_once($f);
endif;

function nextPage($x)
{
 global $CFG;
 $_SESSION['pass'][]=$CFG->Wizard->x;
 $_SESSION['x']=$CFG->Wizard->x=$x;
}

uxmHeader($CFG->Wizard->Title);
?>
<H1><?=$CFG->Wizard->Title ?></H1>
<Form Action='./' Method='POST' <? if($CFG->Wizard->useOnSubmit) echo " onSubmit='return onSubmit(this);'" ?>>
<?
require_once("lib/{$CFG->Wizard->x}.body.php");
$CFG->params->x='';
$CFG->defaults->x=1;
hiddenInputs();
?>
<HR />
<Div Align='Right'>
<?
if($CFG->Wizard->Done):
?>
<Input Type='Submit' Value='������' />
<?
else:
?>
<Input Type='Button' Value=' &lt;&lt; ����� ' onClick='doX("back")' <? if(count($_SESSION['pass'])<1) echo "Disabled "?>
/><Input Type='Submit' Value=' ����� &gt;&gt; ' />
&nbsp;
<Input Type='Button' Value=' ������ ' onClick='doX("cancel")' <? if(count($_SESSION['pass'])<1) echo "Disabled "?>/>
<?
endif;
?>
</Div>
</Form>
<Script><!--
function doX(Cmd)
{
 var f=document.forms[0];
 f.x.value=Cmd;
 f.submit();
}

function AutoFocus()
{
 var f=document.forms[0];
 var i;
 for(i=0; i<f.length; i++)
  if(f[i].tagName=='INPUT' && !f[i].disabled)
  {
   if('hidden'!=f[i].type) f[i].focus();
   return;
  }
}
AutoFocus();
<? if($CFG->Wizard->useOnLoad) echo "onLoad();\n" ?>
//--></Script>
</body></html>
