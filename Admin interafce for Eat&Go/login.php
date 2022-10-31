<?php
/* @Author Dennis Kjellin - dekj2100@student.miun.se
this code is based from an example from Malin Larsson, teacher at Mittuniversitetet Sweden, malin.larsson@miun.se"
*/

// settings for page title and site title
$page_title = "Logga in";
$site_title = "Admin";
//header include here
session_start();
include("includes/header_nav.php"); // <- inside here is the config aswell.
if (isset($_SESSION["username"])) {
    header("Location: admin.php");
}

// check if username/password isset.
if (isset($_POST['username'])) {
    $username = $_POST['username']; // save in property
    $password = $_POST['password']; // save in property
    //if empty
    if (empty($username) || empty($password)) {
        $errormsg = "Ange användarnamn och lösenord!";
    } else {

        //POST with curl
        //$url = "http://localhost/P_webbservice/login_api.php";
        $url ="http://studenter.miun.se/~dekj2100/writeable/P_webbservice/login_api.php";
        $curl = curl_init();
        //array
        $users = array("username" => $username, "password" => $password);
        //transform to json
        $json_string = json_encode($users);
        ////curl settings
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //response and statuscode
        $data = json_decode(curl_exec($curl), true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //close
        curl_close($curl);

        //If user exists
        if($httpcode === 200) {
            $_SESSION["username"] = $username;
            header("Location: index.php");
        } else {
            $errormsg ="<p class='text-error'>Fel användarnamn eller lösenord!</p>";
        }
    }
}


include("includes/main.php");

?>
<!--div with background img below-->
<div class="pb-1 bg-img-2">
            <!--containers with grid settings, padding and margins etc-->
            <div class="container mt-5 pt-2">
                <div class="row justify-center">
                    <div class="col-12-xs col-5-md ml-1 mr-1">
                        <section class="card pl-1 pr-1 pb-4 mt-2 mb-2 bg-custom">
                            <h1 class="font-xl text-black">Administration</h1>

                            <?php if(isset($errormsg)): ?>
                                <p class="text-red mt-1 mb-1"><?php echo $errormsg; ?></p>
                            <?php endif; ?>
                            <form class="form" method="post" action="login.php">
                                <label for="username">Användarnamn</label>
                                <br>
                                <input type="text" name="username" id="username" placeholder="enter username..">
                                <br>
                                <label for="password">Lösenord</label>
                                <br>
                                <input type="password" name="password" id="password" placeholder="enter password..">
                                <br>
                                <input type="submit" value="Logga in" class="btn-secondary">
                                <br>
                            </form>
                            <section class="error-msg">
                      
                            </section>
                        </section>
                    </div>

                </div>
            </div>
        </div>
        <!--highlighted section, green background that pops and highlights the content-->
        <section class="bg-error-light-5 pb-4 pt-4 pb-4">
            <div class="container ">
                <h2 class="font-xl">Viktigt!</h2>
                <p class="text-black mt-1 mb-1">Lämna aldrig ut uppgifter om användarnamn eller lösenord till någon annan part. Kom ihåg att förvara användarnamn och lösenord på ett säkert ställe. Dessa uppgifter bör ej förvaras på en dator eller på någon annan enhet. Vi rekomenderar att lösenord byts regelbundet för att förhindra att det sprids.</p>
            </div>
        </section>
        <div class="bg-img-2 pt-5 pb-5">
        <img class="img-center card-block-img" src="./images/eatandgo.svg" alt="">
        </div>

        <?php
//include footer
include("includes/footer.php");

?>
