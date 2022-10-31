<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
// Check if id is sent
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['week']) && isset($_POST['year'])) {

    //variables
    $title = $_POST['title'];
    $week = $_POST['week'];
    $content = $_POST['content'];
    $year = $_POST['year'];

       //if empty -> error msg -> feedback
       if (empty($title) || empty($week) || empty($content) || empty($year)) {
        $errormsg = "<p class='text-red'><strong>Kontrollera så att alla fällt är i fyllda!</strong></p>";
    } else {
        //we do the code below..
        //PUT

    //The URL that we want to send a PUT request to.
    //$url = 'http://localhost/P_webbservice/menu_api.php'; 
    $url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/menu_api.php";

    $menu = array("title" => "$title", "content" => "$content", "week" => $week, "year" => $year, "id" => $id);
    $data_json = json_encode($menu);
    
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
    //$url = "http://localhost/P_webbservice/menu_api.php?id=" . $id;
    $url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/menu_api.php?id=" . $id;
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
    $title = "";
    $week = "";
    $content = "";
    $year = "";
    
} else {
    //if fail..
    $errormsg = "fel vid inläsning av data.";
}


}

?>