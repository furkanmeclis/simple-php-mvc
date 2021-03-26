<?php
/**
 * Config/Database.php
 */
require realpath(".")."/app/config/database.php";

define("HOSTNAME",$database["database_host"]);
define("DBNAME",$database["database_name"]);
define("USERNAME", $database["database_user"]);
define("PASSWORD", $database["user_password"]);
define("CHARSET", $database["charset"]);
/* ------------------END CONFİG DATABASE ---------------------------- */


/**
 * Config/Email.php
 */
require realpath(".")."/app/config/email.php";
define("EMAIL_HOST",$email["smtp_host"]);
define("EMAIL_PORT",$email["smtp_port"]);
define("EMAIL_SECURE",$email["smtp_secure"]);
define("EMAIL_USER",$email["smtp_user"]);
define("EMAIL_PASS",$email["smtp_pass"]);
 /* ------------------END CONFİG EMAIL ---------------------------- */

 
/**
 * Config/config.php
 */
require realpath(".")."/app/config/config.php";


if (in_array("database",$autoload["libraries"])) {
    define('DATABASE', TRUE);
}
if (in_array("session",$autoload["libraries"])) {
    define('SESSION', TRUE);
}
if (in_array("email",$autoload["libraries"])) {
    define('EMAIL', TRUE);
}
if (in_array("cookie",$autoload["libraries"])) {
    define('COOKIE', TRUE);
}
if (in_array("csrf",$autoload["libraries"])) {
    if (empty($_SESSION)) {
        session_start();
    }
    define('CSRF', TRUE);
}
if (in_array("file",$autoload["libraries"])) {
    define('FILE_UPLOADER', TRUE);
}
if (in_array("validation",$autoload["libraries"])) {
    define('VALIDATOR', TRUE);
}
if (in_array("validation",$autoload["libraries"])) {
    define('VALIDATOR', TRUE);
}
if (in_array("zip",$autoload["libraries"])) {
    define('ZIPPER', TRUE);
}
/* ------------------END CONFİG ------------------------------------- */
/**
 * Functions
 */
function base_url($url=null)
{
    require realpath(".")."/app/config/config.php";

    return $config["base_url"].$url;
}
foreach ($autoload["helpers"] as $name) {
    $f = realpath(".")."/system/helper/".strtolower($name)."_helper.php";
        $b = realpath(".")."/app/helper/".strtolower($name)."_helper.php";
        if (file_exists($f)) {
            require $f;
        }elseif(file_exists($b)){
            require $b;
        }else {
            $rt = new Hata();
            
            echo $rt->popup_error("<b>Helper Yüklenemedi</b><br>Dosya Bulunamadı<br>Dosya Yolu : <b>$b</b>");
            
            
        }
}
