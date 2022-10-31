
<?php
/* @Author Dennis Kjellin - dekj2100@student.miun.se
this code is based from an example from Malin Larsson, teacher at Mittuniversitetet Sweden, malin.larsson@miun.se"
*/

include("includes/config.php");
/*Headers, setting for API*/

//Read in method that was sent, store in variable
$method = $_SERVER['REQUEST_METHOD'];

//Instance of class user
$users = new Users();

$data = json_decode(file_get_contents("php://input"), true);
//check if username and password isset and posted
if (isset($data["username"]) && isset($data["password"])) {
    $username = $data["username"];
    $password = $data["password"];
} else {
    http_response_code(400); //bad request
    $message = array("message" => "Ange användarnamn och lösenord!");
    exit;
}

// check if username and password exists in database
if($users -> loginUser($username, $password)) {
    http_response_code(200); // user exists
    $message = array("message" => "Användare är inloggad.", "user" => true);
} else {
    http_response_code(401); // wrong information posted
    $message = array("message" => "Kontrollera uppgifter och försök igen!");
}
 //Skickar svar tillbaka till avsändaren
 //echo json_encode($message);









