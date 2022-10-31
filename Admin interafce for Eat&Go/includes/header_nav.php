
<!DOCTYPE html>
<html lang="sv">
<?php include("includes/config.php");?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Project created for school, by Dennis Kjellin">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <title><?= $site_title . $divider . $page_title ?></title>

<body>
      <header>
        
        <a href="index.html">
            <img src="./images/eatandgo.svg" class="logo" alt="back to home">
        </a>
        <input type="checkbox" class="nav-toggle" id="nav-toggle">
        
        <nav class="navbar">
            <ul>
               <li><a href="index.php">Hem</a></li>
               <li><a href="menu.php">Meny hantering</a></li>
               <li><a href="reservations.php">Bokningar</a></li>

            </ul>
        </nav>
        
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label> 
    </header>  