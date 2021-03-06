<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start()
?>

<!DOCTYPE html>
<html lang="de">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8"/>
<!--Own stylesheet-->
<title>Welcome auf comfySetup</title>
<link rel="shortcut icon" href="./media/icons/comfySetup.ico">
<link rel="stylesheet" href="./stylesheets/light.css">
<link rel="stylesheet" href="./stylesheets/div_Liste.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet"> 
<!--Icons-->
<link href='https://css.gg/css' rel='stylesheet'>
<!--Navbar js-->
<script src="./js/nav.js"></script>
<script src="./js/jquery-3.6.0.js"></script>

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
                include "check_IFactive.php";
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
	<div id="welcomepic">
		<br>
		<center><img style="height: auto;width: 50%;" src="./media/icons/paketverwaltung.jpeg" alt="Paketverwaltung"></center>
		<br><br><br>
	</div>
        <div id="downloadlink">
        <?php
            if(isset($_GET["dlink"]))
            {
                if($_GET["dlink"] != "None")
                {
                    $downloadlink = "/installpy/".$_GET["dlink"].".zip";
                    $downloadname = $_GET["dlink"];
                    echo '<a href='.$downloadlink.' alt='.$downloadname.' download><button class="button2" id="downloadb"><img src="./media/icons/download.svg" style="height: 20px; width: auto;">&nbsp;Download Windows Installer</button><a/>'; #CSS muss noch angepasst werden.
                    echo '<br><br><br>';
		}
                else
                {
                    echo '<center>Es wurden keine Elemente gefunden.<br>Bitte aktualisieren sie die Seite und probieren sie es erneut.</center>';
                    echo '<br><br><br>';
		}
            }
        ?>
        </div>
            
            
            
        <?php
            $proarray = shell_exec((escapeshellcmd('/var/www/scripts/getprglistS.py')));
	    $programme = explode(",", $proarray);
	    $i = 0;
	    $j = 0;
	    foreach($programme as &$prog)
	    {
		if(strpos($prog,"|") !== false)
                {
			$pro1 = explode("|", $prog)[1];
			$j = $j + 1;
			$programme0[$j][$i] = $pro1;
		}
		else
		{
			$programme0[$j][$i] = $prog;
		}
		$i = $i + 1;
	    }
	    $i=0;
	    $j=0;
	    unset($pro1);
	    unset($programme);
	    echo '<center>';
            echo '<div id="check">';
            echo '<script type="text/javascript">';
            echo 'var prgnames = [];';
            echo '</script>';
	    $i = 1;
            foreach($programme0 as $prg){
	    	$it = 0;
	    	foreach($prg as $newprg)
	        {
			$prg[$it] = $newprg;
			$it = $it + 1;
	        }
                echo '<label><input type="checkbox" id="prg'.$i.'" value="'.$prg[1].'"><img src="'.$prg[4].'" class="pbild">&nbsp;&nbsp;&nbsp;'.$prg[1].'</label>';
                if(($i % 8) == 0)
                {
                    echo '<br>';
                }
                echo '<script type="text/javascript">';
                echo 'document.getElementById("prg'.$i.'").onchange = function(){
                    if(document.getElementById("prg'.$i.'").checked == true)
                    {
                        prgnames.push(document.getElementById("prg'.$i.'").value);
                    }
                    else
                    {
                        prgnames.splice(prgnames.indexOf(document.getElementById("prg'.$i.'").value), 1);
                    }
                    };';
                echo '</script>';
                $i = $i + 1;
            }
            if((($i - 1) % 8) != 0)
            {
                echo '<br>';
            }
            echo '<br><br><button type="button" id="downloadP">Programm Installer herunterladen</button><br>';
            echo '<script type="text/javascript">';
            echo 'document.getElementById("downloadP").onclick = function(){
                if(prgnames.length > 0)
                {
                    document.getElementById("errors").innerHTML = "<br><center style=\'color:darkgreen;\'>Programme werden vorbereitet und danach installiert.</center><br>";
                    prgnames = prgnames.join(",");
                    var xhttp;
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        result = xhttp.responseText;
			result = "index.php?dlink=" + result;
                        window.location.replace(result);
                    }
                    };
                    xhttp.open("POST", "createdlink.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("acprg=true&bcprg="+prgnames+"");
                }
                else
                {
                    document.getElementById("errors").innerHTML = "<br><center style=\'color:red;\'>Es muss oben mindestens ein Programm ausgew"+"&auml;"+"hlt werden !</center>";
                }
                };';
            echo '</script>';
            echo '<script type="text/javascript">';
            echo 'function timer1()
                {
                    setTimeout(start_download, 20000);
                }

                function start_download()
                {
                    try
                    {
                    if(document.getElementById("downloadb") != "undefined")
                    {
                        document.getElementById("downloadb").click();
                    }
                    else
                    {
                        timer1();
                    }
                    }
                    catch (e)
                    {
                    timer1();
                    }
                }

                start_download();';
            echo '</script>';
            echo '</div>';
            echo '</center>';
            echo '<div id="errors">';
            echo '</div>';
        ?>
            </div>


</body>

</html>
