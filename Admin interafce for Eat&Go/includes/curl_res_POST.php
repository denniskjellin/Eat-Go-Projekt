<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

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

        //POST med CURL
        //$url = "http://localhost/P_webbservice/reservations_api.php";
        $url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/reservations_api.php";
        //save array in variable
        $res = array("date" => $date, "time" => $time, "phonenum" => $phonenum, "name" => $name, "persons" => $persons);

        //Json encode it
        $json_string = json_encode($res);

        //curl settings
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //Store result in a variable and makes it to JSON
        $data = json_decode(curl_exec($curl), true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //close
        curl_close($curl);

        //if success..
        if ($httpcode === 201) {
            $success = "<p class='text-secondary-dark-3'><strong>Bokning tillagd!</strong></p>";
            //variables
            $date = "";
            $time = "";
            $phonenum = "";
            $name = "";
            $persons = "";
        } else {
            //if fail..
            $errormsg = "fel vid lagring";
        }
    }
}

?>