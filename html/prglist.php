<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();
if(!(isset($_SESSION["timer"])))
{
    header("location: login1.php");
    exit();
}
if(isset($_SESSION["timer"])){
if($_SESSION["timer"]+1800 >= time())
{
	if($_SESSION["username"] != "")
	{	
		if($_SESSION["admin"] == true)
		{
			$_SESSION["timer"] = time();
			
		}
		else
		{
			$_SESSION["timer"] = time();
			
		}
	}
	else
	{
		include logout.php;
	}
}
else
{
	include logout.php;
}
}
else
{
    include logout.php;
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
<!--Icons-->
<link href='https://css.gg/css' rel='stylesheet'>
<!--Navbar js-->
<script src="./js/nav.js"></script>
</head>

<body>    
    <div id="side_nav" class="sidenav">
        <!--Inhalt der Navigationsleiste-->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="./index.php">Home</a><br>
        <a href="./account.php">Konto</a><br>
            <a class="haltdeinefressejulien" href="">Programm Liste</a><br>
            <a class="haltdeinefressejulien" href="">Profil Liste</a><br>
            <a class="haltdeinefressejulien" href="">Profil erstellen</a><br>
            <a class="haltdeinefressejulien" href="">Programm hinzufügen</a><br>
            <a class="haltdeinefressejulien" href="">Konto bearbeiten</a><br>
        <a href="./about.php">About</a><br>
        <a href="./help.php">Help</a>
        <?php
        if(isset($_SESSION["timer"]))
            {
                echo '<a class="logout" href="logout.php">Logout</a>';
            }
            else
            {
                echo '<a class="log_in" href="login1.php">Login</a>';
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
        <div id="usrprglist">
        <?php
        $proarray = shell_exec((escapeshellcmd('/var/www/scripts/getprglist.py')));
        echo $proarray;
	$i = 1;
        echo '<script language="javascript" type="text/javascript">';
        echo 'var deactivate = false;';
        echo '</script>';
        foreach($proarray as $item){
            echo '<script language="javascript" type="text/javascript">';
            echo 'function programm_bearbeitenD'.$i.'(){
                if(deactivate == false)
                {
                        var name = '.$item["name"].';
                
                }
                else
                {
                    deactivate = false;
                }
            }
            
            function programm_aktuell'.$i.'(){
                deactivate = true;
                var name = '.$item["name"].';
            
            }
            
            function programm_download'.$i.'(){
                deactivate = true;
                var name = '.$item["name"].';
            
            }
            
            function programm_bearbeiten'.$i.'(){
                deactivate = true;
                var name = '.$item["name"].';
            
            }
            
            function programm_loeschen'.$i.'(){
                deactivate = true;
                var name = '.$item["name"].';
            
            }';
            echo '</script>';
            echo '<div onclick="programm_bearbeitenD'.$i.'()" id="'.$item["name"].'" class="programm">
            <p id="inhalt">
            <b>'.$item["name"].'</b>&nbsp;&nbsp;&nbsp;Datum+Zeit&nbsp;&nbsp;&nbsp;
            <button onclick="programm_aktuell'.$i.'()" id="'.$item["name"].'">
            Aktuell
            </button>
            <button onclick="programm_download'.$i.'()" id="'.$item["name"].'">
            Herunterladen
            </button>
            <button onclick="programm_bearbeiten'.$i.'()" id="'.$item["name"].'">
            Bearbeiten
            </button>
            <button onclick="programm_loeschen'.$i.'()" id="'.$item["name"].'">
            Löschen
            </button>
            </p>
            </div>';
            $i = $i+1;
        }
        unset($item);
        ?>
         </div>
    </div>


</body>

</html>
