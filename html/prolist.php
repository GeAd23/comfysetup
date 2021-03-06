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
		include "logout.php";
	}
}
else
{
	include "logout.php";
}
}
else
{
    include "logout.php";
}
?>

<!DOCTYPE html>
<html de>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Own stylesheet-->
<title>Profilliste anzeigen</title>
<link rel="shortcut icon" href="./media/icons/comfySetup.ico">
<link rel="stylesheet" href="./stylesheets/light.css">
<link rel="stylesheet" href="./stylesheets/div_Liste.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@400;700&display=swap" rel="stylesheet">
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
        <a><img src="./media/icons/konto.svg" style="height: 20px; width: auto;">&nbsp;Konto</a><br>
            <a class="submenu" href="prglist.php"><img src="./media/icons/list.svg" style="height: 20px; width: auto;">&nbsp;Programm Liste</a><br>
            <a class="submenu" href="prolist.php"><img src="./media/icons/list.svg" style="height: 20px; width: auto;">&nbsp;Profil Liste</a><br>
            <a class="submenu" href="proadd.php"><img src="./media/icons/add.svg" style="height: 20px; width: auto;">&nbsp;Profil erstellen</a><br>
            <a class="submenu" href="prgadd.php"><img src="./media/icons/add.svg" style="height: 20px; width: auto;">&nbsp;Programm hinzuf??gen</a><br>
            <a class="submenu" href="kontoch.php"><img src="./media/icons/edit.svg" style="height: 20px; width: auto;">&nbsp;Konto bearbeiten</a><br>
			<?php
			if($_SESSION["admin"] == true)
			{
				echo '<a class="submenu" href="user_verwaltungA.php"><img src="./media/icons/edit.svg" style="height: 20px; width: auto;">&nbsp;Benutzer verwalten</a><br>';
			}
			?>
        <a href="./about.php"><img src="./media/icons/??ber.svg" style="height: 20px; width: auto;">&nbsp;About</a><br>
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
        <a href=./index.php id="logo"><img src="./media/icons/logo.png" alt="Logo"></a>
    </div>
    
    <div id="info">
        <div id="usrprglist">
<?php
        $proarray = shell_exec((escapeshellcmd('/var/www/scripts/getprolist.py')));
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
	$i = 1;
        echo '<script language="javascript" type="text/javascript">';
        echo 'var deactivate = false;';
        echo '</script>';
        foreach($programme0 as $item){
	    $it = 0;
	    foreach($item as $newitem)
	    {
		$item[$it] = $newitem;
		$it = $it + 1;
	    }
	    echo '<script language="javascript" type="text/javascript">';
            echo 'function programm_bearbeitenD'.$i.'(){
                if(deactivate == false)
                {
                        var name = '.$item[1].';
						var xhttp;
						xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							result = xhttp.responseText;
							document.getElementById("info").innerHTML = result;
						}
						};
						xhttp.open("POST", "getproinhalt.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("proinhalt='.$item[1].'");
                }
                else
                {
                    deactivate = false;
                }
            }
            
            function programm_aktuell'.$i.'(){
                deactivate = true;
                var name = '.$item[1].';
            }
            
            function programm_download'.$i.'(){
                deactivate = true;
                var name = '.$item[1].';
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					result = xhttp.responseText;
					result = "account.php?dlink=" + result;
					window.location.replace(result);
				}
				};
				xhttp.open("POST", "createdlink.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("apro=true&bpro='.$item[1].'");
            }
            
            function programm_bearbeiten'.$i.'(){
                deactivate = true;
                var name = '.$item[1].';
				
            }
            
            function programm_loeschen'.$i.'(){
                deactivate = true;
                var name = '.$item[1].';
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					result = xhttp.responseText;
					location.reload();
				}
				};
				xhttp.open("POST", "account.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("aprg=delpro&bpro='.$item[1].'");
            }';
	    $time = date("d.m.Y G:i:s",intval($item[2]));
            echo '</script>';
            echo '<div onclick="programm_bearbeitenD'.$i.'()" id="'.$item[1].'" class="profile">
            <p id="inhalt">
            <b>'.$item[1].'</b>&nbsp;&nbsp;&nbsp;'.$time.'&nbsp;&nbsp;&nbsp;
            <button class="button1" onclick="programm_aktuell'.$i.'()" id="'.$item[1].'">
            <img src="./media/icons/update.svg" style="height: 20px; width: auto;">&nbsp;Aktuell
            </button>
            <button class="button1" onclick="programm_download'.$i.'()" id="'.$item[1].'">
            <img src="./media/icons/download.svg" style="height: 20px; width: auto;">&nbsp;Herunterladen
            </button>
            <button class="button1" onclick="programm_bearbeiten'.$i.'()" id="'.$item[1].'">
            <img src="./media/icons/edit.svg" style="height: 20px; width: auto;">&nbsp;Bearbeiten
            </button>
            <button class="button1" onclick="programm_loeschen'.$i.'()" id="'.$item[1].'">
            <img src="./media/icons/delete.svg" style="height: 20px; width: auto;">&nbsp;L??schen
            </button>
            </p>
            </div>';
            $i = $i+1;
        }
        unset($item);
        echo '<script language="javascript" type="text/javascript">';
        echo 'setTimeout(function(){ location.reload(); }, 180000);';
        echo '</script>';
?>
         </div>
    </div>

</body>

</html>
