<?php
/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

include("includes/config.php");
$users = new Users();

//Connect
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if ($db->connect_errno > 0) {
    die("Connection error: " . $db->connect_error);
}

//SQL - query for users
$sql = "DROP TABLE IF EXISTS user;";
// Creating table

$sql .= 

    "CREATE TABLE user(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(64) UNIQUE NOT NULL,
    password VARCHAR(256) NOT NULL,
    created timestamp NOT NULL DEFAULT current_timestamp()
);
";

//SQL-query
$sql .= "DROP TABLE IF EXISTS weekmenu;";

// Creating table
$sql .=
    "CREATE TABLE weekmenu(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    week INT(2) NOT NULL,
    title VARCHAR(128) NOT NULL,
    content TEXT NOT NULL,
    year INT(4) NOT NULL,
    created timestamp NOT NULL DEFAULT current_timestamp()

);
";

//SQL-query
$sql .= "DROP TABLE IF EXISTS reservations;";

// Creating table
$sql .=

    "CREATE TABLE reservations(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    date DATE,
    time VARCHAR(64),
    phonenum VARCHAR(22),
    name VARCHAR(128),
    persons INT(11),
    created timestamp NOT NULL DEFAULT current_timestamp()

);
";


echo "<pre>$sql</pre>";

//Send to server
if ($db->multi_query($sql)) {
    echo "Table installed & admin user created!";
} else {
    echo "error";
}

//Create admin user when install file is run.
$users->registerUser('admin','password');
$users->registerUser('dennis','password');



