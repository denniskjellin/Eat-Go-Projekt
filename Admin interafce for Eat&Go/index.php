<?php
/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
// Require login
session_start();
//check if user not set
if(!isset($_SESSION['username']))
{
    header('Location: login.php');
    exit();
}

// settings for page title and site title
$page_title = "Admin";
$site_title = "Dashboard";
//header include here
include("includes/header_nav.php"); // <- inside here is the config aswell.
include("includes/main.php");

?>
<!--div with background img below-->
<div class="pb-1 bg-img-2">
            <!--containers with grid settings, padding and margins etc-->
            <div class="container mt-5 pt-2">   
                <div class="row justify-center">
                    <div class="col-12-xs col-5-md ml-1 mr-1">
                    <a href="menu.php">
                        <section class="card card-h pl-1 pr-1 pb-2 mt-2 mb-2 bg-custom">
                            <h2 class="font-xl text-secondary-dark-3">Vecko meny</h2>
                            <h2 class="font-md text-black">- Hantering av menyer</h2>
                            <p class="text-black mt-1 mb-1">Lägg till, ändra eller ta bort vecko menyer.</p>
                            <img class="img-center card-block-img" src="./images/meny_card.svg" alt="">
                         
                        </section>
                        </a>
                    </div>
                    <div class="col-12-xs col-5-md ml-1 mr-1">
                    <a href="reservations.php">
                        <section class="card card-h pl-1 pr-1 pb-2 mt-2 mb-2 bg-custom">
                            <h2 class="font-xl text-secondary-dark-3">Reservation</h2>
                            <h2 class="font-md text-black">- Hantering av reserveringar</h2>
                            <p class="text-black mt-1 mb-1">Lägg till, ändra eller ta bort aktuella reserverade bord.</p>
                            <img class="img-center card-block-img" src="./images/reservation_card.svg" alt="">
                        </section>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--highlighted section, green background that pops and highlights the content-->
        <section class="bg-secondary-light-7 pt-4 pb-4">
            <div class="container ">
                <h2 class="font-xl">Administrations panel</h2>
                <p class="text-black mt-1 mb-1">Här kan du enkelt administrera menyer och se över och hantera bokningar.</p>
            </div>
        </section>
        <div class="bg-img-2 pt-5 pb-5">
        <!--img holder-->
        </div>
<?php
//include footer
include("includes/footer.php");

?>