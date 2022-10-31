<?php
/**
 *
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */
session_start();
//check if user is not set
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
// settings for page title and site title
$page_title = "Admin";
$site_title = "Menu";
//header include here
include("includes/header_nav.php"); // <- inside here is the config aswell.
//include of curls, contains abilities and HTML writeout management
include("includes/main.php");
include("includes/curl_menu_POST.php");
include("includes/curl_menu_DELETE.php");


//form check
if (!isset($title)) {
    $title = "";
}

if (!isset($week)) {
    $week = "";
}

if (!isset($year)) {
    $year = "";
}

if (!isset($content)) {
    $content = "
    <h2>Måndag (Teckenformat - rubrik 2)</h2>
    Hemgjorda köttfärsbiffar med cheddarostsås samt rostad potatis och stekta grönsaker. (Teckenformat: normal).


     ";
}
?>

<div class="bg-img-2">
    <!--containers with grid settings, padding and margins etc-->
    <div class="container mt-4 pt-2">
        <div class="row justify-center">
            <div class="col-12-xs col-5-md ml-1 mr-1">
                <section class="card card-h pl-1 pr-1 pb-2 mt-4 mb-4">
                    <h1 class="font-xl text-secondary-dark-3">Beskrivning</h1>
                    <p class="text-black mt-1 mb-1">För att addera en veckomeny så följ instruktionerna i formuläret. Formatering av texten bör skrivas som exemplet visar för korrekt utskrift!</p>
                    <p class="text-black mt-1 mb-1">Redigera och radera befintliga menyer under hantera menyer. <br><br>Under aktuell meny tas du till Eat & Go för att se vilken meny som visas där.</p>
                    <a href="#target" class="btn-outlined-secondary text-secondary-dark-4 text-hover-white mt-1 mb-1">Hantera menyer</a>
                    <a href="https://eatandgo.netlify.app/lunchmeny.html" class="btn-outlined-primary text-primary-dark-4 text-hover-white mt-1 mb-1 float-right">Aktuell meny</a>
                </section>

            </div>
            <div class="col-12-xs col-5-md ml-1 mr-1">
                <section class="card card-h pl-1 pr-1 pb-2 mt-4 mb-4">
                    <h2 class="font-xl text-secondary-dark-3">Skapa veckomeny</h2>
                    <p class="mb-1 mt-1">Fält med <span class="text-red">*</span> är obligatoriska.</p>
                    <form class="form" method="POST">
                        <label for="title">Titel<span class="text-red">*</span></label>
                        <br>
                        <input type="text" name="title" id="title" placeholder="Vecka xx.." value="<?= $title; ?>">
                        <br>
                        <label for="week">Ange vecka<span class="text-red">*</span></label>
                        <input type="number" name="week" id="week" placeholder="0" min="1" max="52" value="<?= $week; ?>"><br>
                        <label for="year">Ange år<span class="text-red">*</span></label>
                        <input type="number" name="year" id="year" placeholder="20xx" value="<?= $year; ?>"><br>
                        <label for="content">Meny<span class="text-red">*</span></label>
                        <br>
                        <textarea name="content" id="content" placeholder="Fyll i matsedel.."><?= $content; ?></textarea>
                        <br>
                        <input type="submit" id="subBtn" value="Lägg till" class="btn-secondary">
                        <br>
                    </form>
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
    <h3 class="display-none">x</h3>
    <div class="container">
        <div class="row gap-2" id="target">

            <?php
            include("includes/curl_menu_GET.php");
            ?>
        </div>
    </div>
</section>
<script>
    CKEDITOR.replace('content');
</script>
<?php
//include footer
include("includes/footer.php");

?>