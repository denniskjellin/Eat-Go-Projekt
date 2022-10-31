<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
//sessions starter
if (session_status() == PHP_SESSION_NONE) {
    //session_start();
};


//Load classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php';
});
// Title settings
$site_title;
$divider = " | ";

$devmode = false;

if ($devmode) {
    // Activate error report
    error_reporting(-1);
    ini_set("display_errors", 1);

    define("DBHOST", "localhost");
    define("DBUSER", "eag");
    define("DBPASS", "s#lena!23");
    define("DBDATABASE", "eag");
} else {
    define("DBHOST", "studentmysql.miun.se");
    define("DBUSER", "dekj2100");
    define("DBPASS", "PDP8vADdDK");
    define("DBDATABASE", "dekj2100");
}


