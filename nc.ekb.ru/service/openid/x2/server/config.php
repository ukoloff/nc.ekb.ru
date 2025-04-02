<?
/**
 * The URL for the server.
 *
 * This is the location of server.php. For example:
 *
 * $server_url = 'http://example.com/~user/server.php';
 *
 * This must be a full URL.
 */
$server_url = "http://ekb.ru:443/openid/x2/server/";

/**
 * Initialize an OpenID store
 *
 * @return object $store an instance of OpenID store (see the
 * documentation for how to create one)
 */
function getOpenIDStore()
{
    require_once "Auth/OpenID/FileStore.php";
    return new Auth_OpenID_FileStore("/var/tmp/x");
}

/**
 * Users who are allowed to log in to this OpenID server.
 *
 * This is an array from URL to password hash. The URL must include
 * the proper OpenID server information in order to work with this
 * server.
 *
 * This must be set for the server to be usable. If it is not set, no
 * users will be able to log in.
 *
 * Example:
 * $openid_users = array(
 *                    'http://joe.example.com/' => sha1('foo')
 *                      )
 */
$openid_users = array(
 'http://stas.id.ekb.ru/'=>sha1('vobla'),
# 'http://zmey.ekb.ru/ru'=>sha1('vobla'),
);

/**
 * Trusted sites is an array of trust roots.
 *
 * Sites in this list will not have to be approved by the user in
 * order to be used. It is OK to leave this value as-is.
 *
 * In a more robust server, this site should be a per-user setting.
 */
$trusted_sites = array(
);

?>