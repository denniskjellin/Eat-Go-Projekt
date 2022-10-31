<?php
/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
//CURL GET
//$url = "http://localhost/P_webbservice/menu_api.php";
$url = "https://studenter.miun.se/~dekj2100/writeable/P_webbservice/menu_api.php";
//new curl session
$curl = curl_init();
//settings for curl
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//Store result in a variable and make it to JSON
$data = json_decode(curl_exec($curl), true);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//if success->
if($httpcode === 200) {
    //data is the response
    foreach($data as $d) {
        //shortened string, so full menu is not displayed
        $shortString = mb_substr($d['content'], 0, 400) . "...";
        ?>
        <!-- formating the html code-->
        <div class="col-12-xs col-6-md col-4-lg">
            <section class="card card-h">
            <h3 class="font-lg text-secondary-dark-3"><?= $d['title']; ?></h3>
            <section class="text-black mt-1 mb-1"><?= $shortString;?><br>
            <a class="btn-outlined-secondary text-secondary-dark-4 text-hover-white mt-1" href="edit_menu.php?id=<?= $d['id']; ?>">Edit</a>
            <a class="btn-outlined-error text-error text-hover-white float-right mt-1" href="menu.php?deleteid=<?= $d['id']; ?>">Delete</a>
        </section>
            </section>
        </div>
        <?php
        $errormsg;
    }

//if not success->
} else {
    //felmeddelande
    $errormsg = "Kunde ej läsa in önskad data.";
}


?>