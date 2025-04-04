<?php
  /******************* session.class ***************************************
     GESTION DES SESSIONS
      n�cessite track_vars activ� dans php.ini


      variables :
        - authOk : true si le visiteur est identifi�
        - sessionId : numero de session (=session_id())
        - login : login de l'utilisateur
        - pass : mot de passe de l'utilisateur
        - authType : permet de savoir comment l'utilisateur s'est identifi�
        - group : groupe de l'utilisateur
        - ip : ip du visiteur
        - dns : dns du visiteur
        - local : true si le visiteur est en local
        - droits : tableau contenant la liste des droits de l'utilisateur en cours

      m�thodes :
        - Session() : constructeur, appel� une seule fois pendant une visite
        - open (Array $form) : ouvre une identification
        - close() : ferme une identification
        - verifIntrusion() : v�rifie que l'on essaye pas de tirer une session
        - boolean verifAuth($login, $mdp) : v�rifie le couple (login/mdp)
                                            enregistre les valeurs correspondant � l'utilisateur
                                            retourne true en cas d'utilisateur valide
        - authPage ($niveauSecu) : Envoie chier un visiteur si son groupe ne correspond pas � celui de la page




        Id�e : Interdiction de login si n erreurs d'identification sur une IP ?
  **********************************************************************/
class Session {
   var $authOk = '';
   var $sessionId = '';
   var $login = '';
   var $pass = '';
   var $base = '';

   //Initialisation de la session
   function Session($sessionId) {
     global $config;
     $this->sessionId= $sessionId;
   }

   //Ouvre une session
   function open($login,$pass) {
      global $db, $config;
      if ($this->verifAuth($login, $pass)) {
         $this->authOk = true;
         $this->login = $login;
         $this->pass = $pass;
         
      } else {
         $this->authOk = false;
         header ('Location: index.php');
         exit;
      }
   }


   //Termine une sessions
   function close() {
      global $util,$imp,$horde;
      $this->authOk = false;
      $this->group = '';
      $this->pass = '';
      $this->login = '';
      $this->base = '';

      session_unset();
      session_destroy();
      session_regenerate_id();
      @session_start();

      header("location: index.php");
      exit;
   }

   //Retourne true si (login/mdp) sont correctes
	function verifAuth ($login, $pass) {
		global $config;
      	$authOk = false;
		
		$db = new Mssql();
		
		//V�rif en fonction de la connection � la base
		if (!$authOk) {
			if ($db->connect($config['userDb']['server'], $login, $pass)) {
				$authOk = true;
				mssql_close();
			}
		}
		return $authOk;
		
	}


   function HTMLForm() {
      global $page, $util, $config;
      //Affichage d'un formulaire d'identification

      $page->headerHTML();
      ?>
      
    <table width="100%" height="100%">
     <tr>
      <td align="center" valign="middle">  
      <form action="index.php" method="post" name="formAuth">
        <table width="326" height="289" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" background="images/charte/loginbox.gif">
           <tr>
               <td width="10" rowspan="9">&nbsp;</td>
               <td height="20" class="connect_header" colspan="2">Connecting to <?=$config['userDb']['server']?></td>
               <td width="10" rowspan="9">&nbsp;</td>
           </tr>
           <tr>
               <td height="80" colspan="2">&nbsp;</td>
           </tr>
           <tr>
               <td height="25" colspan="2" align="left">Host : <?=$config['userDb']['server']?></td>
           </tr>
           <tr>
               <td height="22" align="left" width="105">Login :</td>
               <td><input type="text" name="login" size="20" maxlength="50" tabindex="1" class="connect_loginBox"></td>
           </tr>
           <tr>
               <td height="22" align="left">Password :</td>
               <td><input type="password" name="password" size="20" maxlength="20" tabindex="2" class="connect_loginBox"></td>
           </tr>
           <tr>
               <td height="30" colspan="2">&nbsp;</td>
           </tr>
           <tr>
               <td height="33" colspan="2">&nbsp;</td>
           </tr>
           <tr>
               <td height="25" colspan="2" align="right">
               	<input type="submit" name="submit" value="OK" tabindex="3" class="connect_button">
               	<input type="reset"  name="reset" value="Cancel" tabindex="4" class="connect_button">
               </td>
           </tr>
           <tr>
               <td height="5" colspan="2">&nbsp;</td>
           </tr>
        </table>
      </form>
      </td></tr></table>
      <script language="JavaScript" type="text/javascript">
  		document.formAuth.login.focus();
	  </script>
      <?php
      $page->footerHTML();
      exit;
   }
}
?>