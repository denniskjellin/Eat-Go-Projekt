
<?php
/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
include("includes/config.php");
/*Headers, setting for API*/

//Read in method that was sent, store in variable
$method = $_SERVER['REQUEST_METHOD'];

//Instance of class menu
$email = new Email();

 switch ($method) {

case 'POST':
    
    //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
    $data = json_decode(file_get_contents("php://input"), true);
    // if isset run code
    if ($email->setName($data["name"]) && $email->setEmail($data["email"]) && $email->setSubject($data["subject"]) && $email->setMsg($data["msg"])) {
        // send to function
        if ($email->postEmail($data["name"], $data["email"], $data["subject"], $data["msg"])) {
            $response = array("message" => "E-post skickad!");
            http_response_code(201); // created
        } else {
            http_response_code(500); // Internal Server Error
            $response = array("message" => "Error, kunde ej skicka e-post!");
        }
    } else {
        //error input
        $response = array("message" => "Kontrollera så att alla fält är ifyllda!");
        http_response_code(400); //Bad request
    }
    break;

} 
 //Skickar svar tillbaka till avsändaren
//echo json_encode($response);

