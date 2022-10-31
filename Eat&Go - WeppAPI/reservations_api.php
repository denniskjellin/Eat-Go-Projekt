
<?php
/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
include("includes/config.php");
/*Headers, setting for API*/

//Read in method that was sent, store in variable
$method = $_SERVER['REQUEST_METHOD'];

// If id exists, store in variable
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//Instance of class Reservation
$res = new Reservation();

switch ($method) {

    case 'GET':
        //GET METHOD
        //If if isset-> bring me that specific one, else return all menus.
        if(isset($id)) {
            $response = $res->getResById($id);
        } else {
            $response = $res->getRes();
        }

        if (count($response) === 0) {
            //Lagrar ett meddelande som sedan skickas tillbaka till anroparen
            $response = array("message" => "There is nothing to get yet");
            http_response_code(404); //Not found
        } else {
            http_response_code(200); //Ok - The request has succeeded
        }

        break;

case 'POST':
    //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
    $data = json_decode(file_get_contents("php://input"), true);
    // if isset run code
    if ($res->setDate($data["date"]) && $res->setTime($data["time"]) && $res->setPhonenum($data["phonenum"]) && $res->setName($data["name"]) && $res->setPersons($data["persons"])) {
        // create a reservation post
        if ($res->addRes($data["date"], $data["time"], $data["phonenum"], $data["name"], $data["persons"])) {
            $response = array("message" => "reservation added!");
            http_response_code(201); // created
        } else {
            http_response_code(500); // Internal Server Error
            $response = array("message" => "Error when trying to store reservation");
        }
    } else {
        //error input
        $response = array("message" => "Check so all fields are filled in (date, time, phonenumber, name and persons)");
        http_response_code(400); //Bad request
    }
    break;

    case 'PUT':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
    $data = json_decode(file_get_contents("php://input"), true);

    if ($res->updateRes($data["id"], $data["date"], $data["time"], $data["phonenum"], $data["name"], $data["persons"])) {
        // update a post
        if ($res->updateRes($data["id"],$data["date"], $data["time"], $data["phonenum"], $data["name"], $data["persons"])) {
            $response = array("message" => "Reservering uppdaterad!");
            http_response_code(200); // updated OK
        } else {
            http_response_code(500); // Internal Server Error
            $response = array("message" => "Error, gick ej att uppdatera reservationen!");
        }
    } else {
        //error input
        $response = array("message" => "Kontrollera så att alla fält är ifyllda!");
        http_response_code(400); //Bad request
    }
        break;

        case 'DELETE' :
            if (!isset($id)) {
                $response = array("message" => "Ange ID för post som ska tas bort.");
            } else {
                if($res->deleteRes($id)) {
                    http_response_code(200); //ok
                    $response = array("message" => "Post raderad!");
                }
            }
            break; 


} 
 //Skickar svar tillbaka till avsändaren
//echo json_encode($response);

