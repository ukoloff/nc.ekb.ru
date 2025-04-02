<?
function dupPhoto()
{
 global $CFG;
 $eee=getEntry($CFG->udn, 'jpegPhoto thumbnailPhoto');
 if(!$eee) return;
 if(!$eee[jpegphoto][count] == !$eee[thumbnailphoto][count]) return;
 $eee=$eee[jpegphoto][count]? Array(thumbnailPhoto=>Array($eee[jpegphoto][0])) : Array(jpegPhoto=>Array($eee[thumbnailphoto][0]));
 ldap_modify($CFG->AD->h, $CFG->udn, $eee);
}
?>
