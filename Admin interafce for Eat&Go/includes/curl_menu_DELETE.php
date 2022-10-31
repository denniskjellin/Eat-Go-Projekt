<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
//DELETE
if (isset($_GET['deleteid'])) {
     //variables
     $deleteid = $_GET['deleteid'];
    //$url = "http://localhost/P_webbservice/menu_api.php?id=$deleteid";
     $url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/menu_api.php?id=$deleteid";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = json_decode(curl_exec($curl), true);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

}

    ?>

