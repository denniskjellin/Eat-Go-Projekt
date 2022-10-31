<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
// Check if id is sent
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // checks if form inputs are filled in or if they are empty
    if (isset($_POST['date']) && isset($_POST['time']) && isset($_POST['phonenum']) && isset($_POST['name']) && isset($_POST['persons'])) {

//variables
$date = $_POST['date'];
$time = $_POST['time'];
$phonenum = $_POST['phonenum'];
$name = $_POST['name'];
$persons = $_POST['persons'];

 //if empty -> error msg -> feedback
 if (empty($date) || empty($time) || empty($phonenum) || empty($name) || empty($persons)) {
    $errormsg = "<p class='text-red'><strong>Kontrollera så att alla fällt är i fyllda!</strong></p>";
} else {
        //we do the code below..
        //PUT

    //The URL that we want to send a PUT request to.
    //$url = 'http://localhost/P_webbservice/reservations_api.php'; 
    $url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/reservations_api.php";

     //save array in variable
     $res = array("date" => $date, "time" => $time, "phonenum" => $phonenum, "name" => $name, "persons" => $persons, "id" => $id);

    $data_json = json_encode($res);
    
    $curl = curl_init(); //instansiera ny cURL session
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $data = json_decode(curl_exec($curl), true);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $success = "<p class='text-secondary-dark-3'><strong>Meny uppdaterad!</strong></p>";
    }

}
// Läs ut specifik post
    //GET
    //$url = "http://localhost/P_webbservice/reservations_api.php?id=" . $id;
    $url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/reservations_api.php?id=" . $id;
    //instansiera ny cURL session
    $curl = curl_init();
    //inställningar för cURL
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //Store result in a variable and makes it to JSON
    $data = json_decode(curl_exec($curl), true);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    
 //if success..
 if ($httpcode === 200) {
    
       //variables
            $date = "";
            $time = "";
            $phonenum = "";
            $name = "";
            $persons = "";
    
} else {
    //if fail..
    $errormsg = "fel vid inläsning av data.";
}


}

?>