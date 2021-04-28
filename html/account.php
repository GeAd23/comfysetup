<?php
session_start();
if(!(isset($_SESSION["timer"])))
{
    header("location: login1.php");
    exit();
}
?>


<!DOCTYPE html>
<html de>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Own stylesheet-->
<link rel="stylesheet" href="./stylesheets/light.css">
<link rel="stylesheet" href="./stylesheets/div_Liste.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@400;700&display=swap" rel="stylesheet">
<!--Navbar js-->
<script src="./js/nav.js"></script>
</head>

<body>    
    <div id="side_nav" class="sidenav">
        <!--Inhalt der Navigationsleiste-->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="./index.php">Home</a><br>
        <a>Konto</a><br>
            <a class="haltdeinefressejulien" href="">Programm Liste</a><br>
            <a class="haltdeinefressejulien" href="">Profil Liste</a><br>
            <a class="haltdeinefressejulien" href="">Profil erstellen</a><br>
            <a class="haltdeinefressejulien" href="">Programm hinzufügen</a><br>
            <a class="haltdeinefressejulien" href="">Konto bearbeiten</a><br>
        <a href="./about.php">About</a><br>
        <a href="./help.php">Help</a>
        <?php
            if (isset($_SESSION["timer"]))
            {
                echo '<a class="logout" href="logout.php">Logout</a>';
            }
        ?>
    </div>

    <div id="side_bar" class="sidebar">
        <span onclick='openNav(); removeSide();'><img src="https://img.icons8.com/ios-filled/50/ffffff/menu--v1.png" alt="Menu"></span>
    </div>
    
    <div id="top_bar" class="topbar">
        <a href=./index.php id="logo"><img src="./media/icons/logo.png" alt="Logo"></a>
    </div>
    
    <div id="info">

    </div>


</body>

</html>
