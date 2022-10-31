<?php
/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

 //starts session 
session_start();
//check if user not set
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
// settings for page title and site title
$page_title = "Admin";
$site_title = "Edit reservation";
//header include here
include("includes/header_nav.php"); // <- inside here is the config aswell.
include("includes/main.php");
//include of curls, contains abilities and HTML writeout management
include("includes/curl_res_PUT.php");
include("includes/curl_res_DELETE.php");

//if there is no title set - leave it empty, if not the failed form post title will be seen
if(!isset($name)) {
    $name = "";
    $success = false;
}

if(!isset($phonenum)) {
    $phonenum = "";
    $success = false;
}

if(!isset($time)) {
    $time = "";
    $success = false;
}
if(!isset($date)) {
    $date = "";
    $success = false;

}

if(!isset($persons)) {
    $persons = "";
    $success = false;

}



?>

<div class="bg-img-2">
    <!--containers with grid settings, padding and margins etc-->
    <div class="container mt-4 pt-2">
        <div class="row justify-center">
        <div class="col-12-xs col-5-md ml-1 mr-1">
        <section class="card card-h pl-1 pr-1 pb-2 mt-4 mb-4">
                            <h1 class="font-xl text-secondary-dark-3">Beskrivning</h1>
                            <p class="text-black mt-1 mb-1">Fyll i de ändringar du vill utföra och klicka sedan på uppdatera.</p>
                            <p class="text-black mt-1 mb-1">För att ta bort eller ändra befintliga bokningar klicka på "Hantera bokningar".</p>
                            <a href="#target" class="btn-outlined-secondary text-secondary-dark-4 text-hover-white mt-1 mb-1">Hantera menyer</a>
                        </section>

                    </div>
            <div class="col-12-xs col-5-md ml-1 mr-1">
                <section class="card card-h pl-1 pr-1 pb-2 mt-4 mb-4">
                    <h2 class="font-xl text-secondary-dark-3">Ändra bokning</h2>
                    <p class="mb-1 mt-1">Fält med <span class="text-red">*</span> är obligatoriska.</p>
                    <form class="form" method="POST">
                        <label for="name">Namn<span class="text-red">*</span></label>
                        <br>
                        <input type="text" name="name" id="name"  placeholder="Andersson Andersson.." value="<?= $data['name']; ?>">
                        <br>
                        <label for="phonenum">Telefon<span class="text-red">*</span></label>
                        <input type="text" name="phonenum" id="phonenum" placeholder="+46" value="<?= $data['phonenum']; ?>"><br>
                        <label for="date">Datum<span class="text-red">*</span></label>
                        <input type="date" name="date" id="date" value="<?= $data['date']; ?>"><br>
                        <label for="time">Tid<span class="text-red">*</span></label>
                        <br>
                        <input type="time" name="time" id="time" value="<?= $data['time']; ?>"><br>
                        <label for="persons">Antal personer<span class="red-text">*</span></label> 
                        <input type="number" name="persons" id="persons" value="<?= $data['persons']; ?>"><br>
                        <br>
                        <input type="submit" id="subBtn" value="Lägg till" class="btn-secondary">
                        
                        <br>
                  
                    <?php
                    //error msg output
                    if (isset($errormsg)) {
                        echo $errormsg;
                    }
                    ?>
                    <?php
                    //success msg output
                    if (isset($success)) {
                        echo $success;
                    }
                    ?>
                      </form>
                </section>
            </div>
        </div>
    </div>
</div>


<!--highlighted section, green background that pops and highlights the content-->
<section class="bg-secondary-light-7 pt-2 pb-2">
    <div class="container ">
        <h2 class="font-xl">OBS!</h2>
        <p class="text-black mt-1 mb-1">Nedan finns nuvarande menyer sammlade. För att ändra en meny tryck 'Edit' och för att ta bort tryck 'Delete'.</p>
        <p class="text-error mt-1 mb-1"><strong>OBS! Vid tryck av DELETE raderas menyn permanent.</strong></p>
    </div>
</section>

<section class="pt-3 pb-3 bg-img-2">
<div class="container">
<div class="row gap-2" id="target">
  
    <?php
        include("includes/curl_res_GET.php");
        ?>
</div>
</div>
</section>
<?php
//include footer
include("includes/footer.php");

?>