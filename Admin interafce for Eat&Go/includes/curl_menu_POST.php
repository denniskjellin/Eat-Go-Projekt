<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
// checks if form inputs are filled in or if they are empty
if (isset($_POST['title']) && isset($_POST['week']) && isset($_POST['content']) && isset($_POST['year'])) {

    //variables
    $title = $_POST['title'];
    $week = $_POST['week'];
    $year = $_POST['year'];
    $content = $_POST['content'];
    
    //if empty -> error msg -> feedback
    if (empty($title) || empty($week) || empty($content) || empty($year)) {
        //error msg admin site
        $errormsg = "<p class='text-red'><strong>Kontrollera så att alla fällt är i fyllda!</strong></p>";
    } else {
        
        //we do the code below..
        //POST with CURL
        //$url = "http://localhost/P_webbservice/menu_api.php";
        $url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/menu_api.php";
        
        //save array in variable
        $menu = array("title" => $title, "week" => $week, "content" => $content, "year" => $year);

        //Json encode it
        $json_string = json_encode($menu);

        //curl settings
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($curl), true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //close
        curl_close($curl);

        //if success..
        if ($httpcode === 201) {
            //success msg admin site
            $success = "<p class='text-secondary-dark-3'><strong>Meny tillagd!</strong></p>";
               //variables
            $title = "";
            $week = "";
            $content = "";
            $year = "";
        } else {
            //if fail..
            $errormsg = "fel vid lagring";
        }
    }
}
?>