<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();
?>
<!DOCTYPE html>
<html de>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Own stylesheet-->
<title>Hilfe für comfySetup</title>
<link rel="shortcut icon" href="./media/icons/comfySetup.ico">
<link rel="stylesheet" href="./stylesheets/light.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet"> 
<!--Icons-->
<link href='https://css.gg/css' rel='stylesheet'>
<!--Navbar js-->
<script src="./js/nav.js"></script>
<!--jquery-->
<script type="text/javascript" src="./jquery/jquery-3.5.1.min.js"></script>

</head>

<body>

    <div id="side_nav" class="sidenav">
        <!--Inhalt der Navigationsleiste-->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="./index.php"><img src="./media/icons/home.svg" style="height: 20px; width: auto;">&nbsp;Home</a><br>
        <a href="./account.php"><img src="./media/icons/konto.svg" style="height: 20px; width: auto;">&nbsp;Konto</a><br>
        <a href="./about.php"><img src="./media/icons/über.svg" style="height: 20px; width: auto;">&nbsp;About</a><br>
        <a href="./help.php"><img src="./media/icons/help.svg" style="height: 20px; width: auto;">&nbsp;Help</a><br>       
        <?php
	    if(isset($_SESSION["timer"]))
        {
            echo '<a class="logout" href="logout.php"><img src="./media/icons/logout.svg" style="height: 20px; width: auto;">&nbsp;Logout</a>';
        }
        else
        {
            echo '<a class="log_in" href="login1.php"><img src="./media/icons/login.svg" style="height: 20px; width: auto;">&nbsp;Login</a>';
        }
        ?>    
    </div>
    <div id="side_bar" class="sidebar">
        <span onclick='openNav();'><img src="https://img.icons8.com/ios-filled/50/ffffff/menu--v1.png" alt="Menu"></span>
    </div>
    
    <div id="top_bar" class="topbar">
        <a href="./index.php" id="logo"><img src="./media/icons/logo.png" alt="Logo"></a>
    </div>

	<div id="info">
		<div id="helpsite">
				<div id="helping_manuell"><br><br><br>
				<center>Auf dieser Seite wird es später eine kleine Anleitung geben, über die Funktionen unseres Service und dieser Webseite.</center>
			    <br><br></div>
		</div>
	</div>


</body>

</html>
