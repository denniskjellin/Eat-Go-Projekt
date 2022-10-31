<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
//CURL GET for Reservations

//GET
//$url = "http://localhost/P_webbservice/reservations_api.php";
$url ="https://studenter.miun.se/~dekj2100/writeable/P_webbservice/reservations_api.php";
//new curl session
$curl = curl_init();
//settings for curl
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//Store result in a variable and make it to JSON
$data = json_decode(curl_exec($curl), true);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//if success do this.. ->$_COOKIE
if($httpcode === 200) {
    //data is the response
    foreach($data as $d) {
        ?>
        <!-- formating the html code-->
        <div class="col-12-xs col-4-md col-3-lg">
            <section class="card card-h">
            <h3 class="font-lg text-secondary-dark-3">Boknings ID #<?= $d['id']; ?></h3>
            <section class="text-black mt-1 mb-1">
            <p class="text mb-1"><strong>Bokad av:</strong> <?= $d['name']; ?></p>
            <p class="text mb-1"><strong>Tel:</strong> <?= $d['phonenum']; ?></p>
            <p class="text mb-1"><strong>Datum:</strong> <?= $d['date']; ?></p>
            <p class="text mb-1"><strong>Tid:</strong> <?= $d['time']; ?></p>
            <p class="text mb-1"><strong>Antal:</strong> <?= $d['persons']; ?></p>
            <a class="btn-outlined-secondary text-secondary-dark-4 text-hover-white mt-1" href="edit_res.php?id=<?= $d['id']; ?>">Edit</a>
            <a class="btn-outlined-error text-error text-hover-white float-right mt-1" href="reservations.php?deleteid=<?= $d['id']; ?>">Delete</a>
        </section>
            </section>
        </div>
        <?php
        $errormsg;
    }
} else {
     //felmeddelande
     $errormsg = "Kunde ej läsa in önskad data.";
    }

?>