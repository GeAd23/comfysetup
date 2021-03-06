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
<title>Profil hinzufügen
</title>
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
            <a class="submenu" href="prgadd.php"><img src="./media/icons/add.svg" style="height: 20px; width: auto;">&nbsp;Programm hinzufügen</a><br>
            <a class="submenu" href="kontoch.php"><img src="./media/icons/edit.svg" style="height: 20px; width: auto;">&nbsp;Konto bearbeiten</a><br>
			<?php
			if($_SESSION["admin"] == true)
			{
				echo '<a class="submenu" href="user_verwaltungA.php"><img src="./media/icons/edit.svg" style="height: 20px; width: auto;">&nbsp;Benutzer verwalten</a><br>';
			}
			?>
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
        <a href=./index.php id="logo"><img src="./media/icons/logo.png" alt="Logo"></a>
    </div>

	<div id="info">
		<div id="proadd">
			<form action="account.php" method="post" enctype="multipart/form-data">
			    <button class="button1" type="Submit"><img src="./media/icons/save.svg" style="height: 20px; width: auto;">&nbsp;Speichern</button>
			    <div id="padd"><br>
			    <input type="text" class="poname" id="poname" name="poname" size="30" placeholder="Profilname" required><br><br><br>
			    <br><br><br>
				<p id="erklärung_auswahl">Wählen sie alle Programme aus, die zu diesem Profil hinzugefügt werden sollen.</p><br><br>
				<div id="programme">
<?php
				$proarray = shell_exec((escapeshellcmd('/var/www/scripts/getprglist.py')));
				$programme = explode(",", $proarray);
				$programme0 = array();
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
        			foreach($programme0 as $item)
				{
	    				$it = 0;
	    				foreach($item as $newitem)
	    				{
						$item[$it] = $newitem;
						$it = $it + 1;
	    				}
					$time = date("d.m.Y G:i:s",intval($item[7]));
					echo '<div id="'.$item[1].'" class="prginhalt">';
					echo '&nbsp;&nbsp;&nbsp;<input type="checkbox" name="prg'.$i.'" value="'.$item[0].'">&nbsp;';
					echo '<img src="'.$item[4].'" class="pbild">&nbsp;&nbsp;&nbsp;<b>'.$item[1].'</b>&nbsp;&nbsp;&nbsp;'.$time.'&nbsp;&nbsp;&nbsp;';
					echo '</div>';
					$i = $i + 1;
				}
				echo '<br><input style="visibility:hidden" type="number" name="anz_items" size="5" value='.$i.' required>';
				echo '<script language="javascript" type="text/javascript">';
                echo 'var aktualisieren = false;

					  function timer1() {
					    setTimeout(informieren, 360000);
					  }

					  function informieren() {
					    aktualisieren = confirm("Die Programmliste könnte nicht mehr aktuell sein. Sie sollten die Seite neu laden.\n\nAlle Eingaben gehen dabei verloren!!!");
					    prüf_siteTime();
					  }

					  function prüf_siteTime() {
					    if (aktualisieren == true) {
						  alert("Webseite wird neu geladen");
						  location.reload();
					    } else {
						  timer1();
					    }
					  }

					  prüf_siteTime();';
                echo '</script>';
?>
				</div>
			    <br><br></div>
			    <button class="button1" type="Submit"><img src="./media/icons/save.svg" style="height: 20px; width: auto;">&nbsp;Speichern</button>
			</form>
		</div>
	</div>


</body>

</html>
