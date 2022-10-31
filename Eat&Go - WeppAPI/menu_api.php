
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

//Instance of class menu
$menu = new Menu();

switch ($method) {
    case 'GET':
        //GET METHOD
        //If if isset-> bring me that specific one, else return all menus.
        if(isset($id)) {
            $response = $menu->getMenuById($id);
        } else {
            $response = $menu->getMenus();
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
    if ($menu->setTitle($data["title"]) && $menu->setContent($data["content"]) && $menu->setWeek($data["week"]) && $menu->setYear($data["year"])) {
        // create a menu post
        if ($menu->addMenu($data["week"], $data["title"], $data["content"], $data["year"])) {
            $response = array("message" => "Menu adderad!");
            http_response_code(201); // created
        } else {
            http_response_code(500); // Internal Server Error
            $response = array("message" => "Error, fel vid lagring!");
        }
    } else {
        //error input
        $response = array("message" => "Kontrollera så att alla fält är ifyllda! (title, content, week)");
        http_response_code(400); //Bad request
    }
    break;

    case 'PUT':
        //Läser in JSON-data skickad med anropet och omvandlar till ett objekt.
    $data = json_decode(file_get_contents("php://input"), true);

    if ($menu->updateMenu($data["id"], $data["title"], $data["content"], $data["week"], $data["year"])) {
        // update a post
        if ($menu->updateMenu($data["id"],$data["title"], $data["content"], $data["week"], $data["year"])) {
            $response = array("message" => "Meny uppdaterad!");
            http_response_code(200); // updated OK
        } else {
            http_response_code(500); // Internal Server Error
            $response = array("message" => "Error, gick ej att uppdatera menyn!");
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
                if($menu->deleteMenu($id)) {
                    http_response_code(200); //ok
                    $response = array("message" => "Post raderad!");
                }
            }
            break; 

} 
 //Skickar svar tillbaka till avsändaren
//echo json_encode($response);

