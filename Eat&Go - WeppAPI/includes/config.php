<?php

//config projekt 2022
//autoinclude of classes
spl_autoload_register(function ($class_name) {
    include 'includes/classes/' . $class_name . '.class.php';
});

//sessions starter
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};

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


//$this->db = new mysqli('studentmysql.miun.se', 'dekj2100', 'PDP8vADdDK', 'dekj2100');

//Gör att webbtjänsten går att komma åt från alla domäner (asterisk * betyder alla)
header('Access-Control-Allow-Origin: *');

//Talar om att webbtjänsten skickar data i JSON-format
header('Content-Type: application/json; charset=UTF-8');

//Vilka metoder som webbtjänsten accepterar, som standard tillåts bara GET.
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');

//Vilka headers som är tillåtna vid anrop från klient-sidan, kan bli problem med CORS (Cross-Origin Resource Sharing) utan denna.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


?>