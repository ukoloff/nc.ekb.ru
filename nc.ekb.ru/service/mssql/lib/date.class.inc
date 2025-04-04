<?php
  /******************* util.class ***************************************
     Plein de fonctions qui peuvent �tre utiles � tout le monde






  **********************************************************************/

class Date {
   var $jour = array ();
   var $mois = array ();

   function Date() {
      $this->jour = array ( 0 => 'Dimanche', 1 => 'Lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi', 6 => 'Samedi');
      $this->mois = array ( 1 => 'Janvier', 2 => 'F�vrier', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai' , 6 => 'Juin', 7 => 'Juillet', 8 => 'Ao�t', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'D�cembre');

   }

   //Formatte une date : on lui donne YYYY-MM-DD et on ressort un truc comme on veut
   function formatDate ($date, $format = 'd/m/Y') {
      if (ereg( "^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$", $date, $regs )) {
         return (date($format,mktime (0,0,0,$regs[2],$regs[3],$regs[1])));
     } else if (preg_match("/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})$/",$date, $regs) ) {
         return (date($format,
                           mktime ($regs[4],$regs[5],$regs[6],
                                   $regs[2],$regs[3],$regs[1])));
      } elseif (preg_match("/^([0-9]{4})\-([0-9]{2})\-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/",$date,$regs)){
              return (date($format,
                        mktime ($regs[4],$regs[5],$regs[6],
                                $regs[2],$regs[3],$regs[1])));

      } else {
         return $date;
      }
   }          

}

?>
