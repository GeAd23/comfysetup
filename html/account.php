<?php
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
<title>Datenverarbeitungs-Überwachung</title>
<link rel="shortcut icon" href="./media/icons/comfySetup.ico">
<link rel="stylesheet" href="./stylesheets/light.css">
<link rel="stylesheet" href="./stylesheets/div_Liste.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@400;700&display=swap" rel="stylesheet">
<!--Navbar js-->
<script src="./js/nav.js"></script>
<script src="./js/jquery-3.6.0.js"></script>
</head>

<body>    
    <div id="side_nav" class="sidenav">
        <!--Inhalt der Navigationsleiste-->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="./index.php">Home</a><br>
        <a>Konto</a><br>
            <a class="haltdeinefressejulien" href="prglist.php">Programm Liste</a><br>
            <a class="haltdeinefressejulien" href="prolist.php">Profil Liste</a><br>
            <a class="haltdeinefressejulien" href="proadd.php">Profil erstellen</a><br>
            <a class="haltdeinefressejulien" href="prgadd.php">Programm hinzufügen</a><br>
            <a class="haltdeinefressejulien" href="kontoch.php">Konto bearbeiten</a><br>
			<?php
			if($_SESSION["admin"] == true)
			{
				echo '<a class="haltdeinefressejulien" href="user_verwaltungA.php">Benutzer verwalten</a><br>';
			}
			?>
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
	<div style="font-size: 30px;border-width: 2px;border-style: solid;color: blue;float: right;" id="hello-user"><p style="margin: 6px;"><b>Hallo&nbsp;<?php echo $_SESSION["uname"]; ?></b></p></div><br><br>
	<br><p><center>Hier werden Fehler angezeigt, wenn welche aufgetreten sind beim verarbeiten.</center></p><br><br>
	<div id="infos">
<?php
	$infof = fopen("/var/www/data/infos.txt", "r");
	while(!feof($infof))
	{
		echo "<center>".fgets($infof)."</center>";
	}
	fclose(infof);
?>
	</div>
	<div id="dataXXX">
<?php
	$i = 0;
	$data_disks = array();
	while($i <= 1)
	{
		$proarray = shell_exec((escapeshellcmd('/var/www/scripts/disk_space.py "/usb/data'.$i.'"')));
    	if($proarray != "None")
		{
			if(floatval($proarray) < 10.0)
			{
				$data_disks[] = "data".$i;
			}
		}
		else
		{
			foreach($data_disks as $data_disk)
			{
				echo "<center>Die Festplatte ".$data_disk." ist fast voll.</center>";
			}
			echo '<center>Bitte benachrichtigen sie ihren Administrator.</center>';
			break;
		}
		$i = $i + 1;	
	}
	unset($data_disks);
?>
	</div>
	<div id="downloadlink">
<?php
	if(isset($_GET["dlink"]))
	{
		if($_GET["dlink"] != "None")
		{
			$downloadlink = "/installpy/".$_GET["dlink"]."exe";
			$downloadname = $_GET["dlink"];
			echo '<a href='.$downloadlink.' alt='.$downloadname.' download><button id="downloadb">Download Windows Installer</button><a/>'; #CSS muss noch angepasst werden.
		}
		else
		{
			echo '<center>Es wurden keine Elemente gefunden.<br>Bitte aktualisieren sie die Seite und probieren sie es erneut.</center>';
		}
	}
?>
	</div>
    <div id="prg_create">
<?php
	if(isset($_POST["pname"]))
	{
		$name = $_POST["pname"];
		$db = new SQLite3("/var/www/data/MS1.db");
		$query = $db->prepare("SELECT * from programm where name = '".$name."';");
		$userdata = $query->execute();
		$anzahl_names = $userdata->rowCount();
		$db->close();
	}
	if($anzahl_names == 0)
	{
		if(isset($_POST["purl"]))
		{
			$url = $_POST["purl"];
		}
		if(isset($_POST["lurl"]))
		{
			$lurl = $_POST["lurl"];
		}
		if(isset($_POST["p_os"]))
		{
			$prgos = $_POST["p_os"];
		}
		if(isset($_POST["autoi"]))
		{
			$auto = $_POST["autoi"];
			if($auto == "")
			{
				$auto = false;
			}
			else
			{
				$auto = true;
			}
		}
		else
		{
			$auto = false;
		}
		if(isset($_POST["pstandard"]))
		{
			$stand = $_POST["pstandard"];
			if($stand == "")
			{
				$stand = false;
			}
			else
			{
				$stand = true;
			}
		}
		else
		{
			$stand = false;
		}
		if(isset($_FILES["bilddatei"]))
			{
				$bildname = $_FILES["bilddatei"]["name"];
				$extens = strtolower(pathinfo($bildname, PATHINFO_EXTENSION));
				$bildname = $name.".".$extens;
				$bild = $_FILES["bilddatei"]["tmp_name"];
			while(file_exists("/var/www/html/icos/".$bildname))
			{
				$bildname = $name.random_int(1, 99999).".".$extens;
			}
				move_uploaded_file($bild, "/var/www/html/icos/".$bildname);
			}
		
			if(isset($name))
			{	
			$time = time();
			$sqlarray = array(NULL, $name, $url, "/usb/".$lurl, "icos/".$bildname, $stand, $prgos, $time,"normal", $auto);
			$sqlarray = json_encode($sqlarray);
			$proarray = shell_exec((escapeshellcmd('/var/www/scripts/setprg.py '.$sqlarray)));
			echo "<center>".$proarray."</center>";
			}
	}
	elseif($anzahl_names == 1)
	{
		echo '<center>Der Programmname <b>'.$name.'</b> ist schon vergeben.<br>Bitte versuchen sie es mit einem neuen Programmnamen erneut.</center>';
	}
?>
	</div>
	<div id="pro_create">
<?php
		if(isset($_POST["poname"]))
        {
            $name = $_POST["poname"];
			$db = new SQLite3("/var/www/data/MS1.db");
			$query = $db->prepare("SELECT * from profile where name = '".$name."';");
			$userdata = $query->execute();
			$anzahl_names = $userdata->rowCount();
			$db->close();
        }
		if($anzahl_names == 0)
		{
			$time = time();
			$db = new SQLite3("/var/www/data/MS1.db");
			$query = $db->prepare("INSERT INTO profile (PID,name,createdate,changedate) VALUES (NULL,'".$name."','".$time."','".$time."');");
			$userlogin = $query->execute();
			$query = $db->prepare("SELECT last_insert_rowid();");
			$userlogin = $query->execute();
			$userdata = $userlogin->fetchArray();
			$iddata = intval($userdata["last_insert_rowid()"]);
			$query = $db->prepare("SELECT * from users where username = '".$_SESSION["username"]."';");
			$userlogin = $query->execute();
			$userdata = $userlogin->fetchArray();
			$query = $db->prepare("INSERT INTO user_profile (ID,user,profil) VALUES (NULL,'".$userdata["UID"]."','".$iddata."');");
			$userlogin = $query->execute();
			$db->close();
			
			if(isset($_POST["anz_items"]))
			{
					$i_anzahl = intval($_POST["anz_items"]);
			}
			$i = 1;
			$programme = array();
			$programme[] = $iddata;
			while($i <= $i_anzahl)
			{
				if(isset($_POST["prg".strval($i)]))
				{
					if($_POST["prg".strval($i)] != "")
					{
						$programme[] = $_POST["prg".strval($i)];
					}
				}
				$i = $i + 1;
			}
			$programme = json_encode($programme);
			$programme = shell_exec((escapeshellcmd('/var/www/scripts/setproitems.py '.$programme)));
			echo "<center>".$programme."</center>";
		}
		elseif($anzahl_names == 1)
		{
			echo '<center>Der Profilname <b>'.$name.'</b> ist schon vergeben.<br>Bitte versuchen sie es mit einem neuen Profilnamen erneut.</center>';
		}
?>
	</div>
    	<div id="kontoinfo">
<?php
        if(isset($_POST["kname"]))
        {
                $name = $_POST["kname"];
        }
        if(isset($_POST["uname"]))
        {
                $uname = $_POST["uname"];
        }
        if(isset($_POST["oldpw"]))
        {
                $pass = $_POST["oldpw"];
        }
        if(isset($_POST["newpw"]))
        {
                $npass = $_POST["newpw"];
        }
        if(isset($_POST["newpww"]))
        {
                $nnpass = $_POST["newpww"];
	}
        if(isset($kname))
        {
		$pass = password_hash($pass);
                $db = new SQLite3("/var/www/data/MS1.db");
                $query = $db->prepare("Select * from users where username = '".$_SESSION["username"]."';");
                $userlogin = $query->execute();
                $userdata = $userlogin->fetchArray();
                $db->close();
                if($userdata["password_crypt"] == $pass)
                {
					if($npass == $nnpass && $npass != "" && $nnpass != "")
					{	
						$pass = password_hash($npass);
						$sqlarray = array($kname, $uname, $pass);
					}
					else
					{
						$sqlarray = array($kname, $uname, $pass);
					}
				}
				$sqlarray = json_encode($sqlarray);
                $proarray = shell_exec((escapeshellcmd('/var/www/scripts/chkonto.py '.$sqlarray)));
                echo "<center>".$proarray."</center>";
        }
?>
	</div>
   	<div id="prgdel">
<?php
		if(isset($_POST["aprg"]))
		{
			$prgdel1 = $_POST["aprg"];
		}
		if(isset($_POST["bprg"]))
		{
			$prgdel2 = $_POST["bprg"];
		}
		if(isset($prgdel1))
		{
			$proarray = shell_exec((escapeshellcmd('/var/www/scripts/delprg.py '.$prgdel2)));
            echo "<center>".$proarray."</center>";
		}
?>
	</div> 
	<div id="prodel">
<?php
		if(isset($_POST["apro"]))
		{
			$prodel1 = $_POST["apro"];
		}
		if(isset($_POST["bpro"]))
		{
			$prodel2 = $_POST["bpro"];
		}
		if(isset($prodel1))
		{
			$proarray = shell_exec((escapeshellcmd('/var/www/scripts/delpro.py '.$prodel2)));
            echo "<center>".$proarray."</center>";
		}
?>
	</div> 
	<div id="adminchangeA">
<?php
		if(isset($_POST["anz_uitems"]))
		{
			$i_anzahl = intval($_POST["anz_uitems"]);
			$i = 1;
			$lochen = array();
			$userB = array();
			$adminB = array();
			$activeB = array();
			while($i <= $i_anzahl)
			{
				if(isset($_POST["loeschA".$i.""]))
				{
					$löschU = $_POST["loeschA".$i.""];
				}
				else
				{
					$löschU = "";
				}
				if($löschU != "")
				{
					$lochen[] = $löschU;
				}
				else
				{
					if(isset($_POST["adminA".$i.""]))
					{
							$split_data = explode(",", $_POST["adminA".$i.""]);
							$userB[] = $split_data[0];
							$adminB[] = true;
					}
					else
					{
						$split_data = $_POST["uuname".$i.""];
						$userB[] = $split_data;
						$adminB[] = false;
					}
					if(isset($_POST["activeA".$i.""]))
					{
							$split_data = explode(",", $_POST["activeA".$i.""]);
							if($userB[$i - 1] == $split_data[0])
							{
								$activeB[] = true;
							}
					}
					else
					{
						$split_data = $_POST["uuname".$i.""];
						if($userB[$i - 1] == $split_data)
						{
							$activeB[] = true;
						}
						$activeB[] = false;
					}
				}
				$i = $i + 1;
			}
			$i = 0;
			while($i < count($lochen))
			{
				if($lochen[$i] != "admin")
				{
					$db = new SQLite3("/var/www/data/MS1.db");
					$query = $db->prepare("Select * from users WHERE username = '".$lochen[$i]."';");
					$userchange = $query->execute();
					$userdata = $userchange->fetchArray();
					$query = $db->prepare("DELETE from user_profile WHERE user = '".$userdata["UID"]."';");
					$userchange = $query->execute();
					$query = $db->prepare("DELETE from users WHERE username = '".$lochen[$i]."';");
					$userchange = $query->execute();
					$db->close();
				}
				else
				{
					echo 'Der Benutzer \"Administrator\" kann nicht gelöscht werden.';
				}
				$i = $i + 1;
			}
			$i = 0;
			while($i < count($userB))
			{
				if($userB[$i] != "admin")
				{
					$db = new SQLite3("/var/www/data/MS1.db");
					$query = $db->prepare("UPDATE users SET admin = '".$adminB[$i]."', active = '".$activeB[$i]."' WHERE username = '".$userb[$i]."';");
					$userchange = $query->execute();
					$db->close();
				}
				else
				{
					echo 'Die Eigenschaften des Benutzers \"Administrator\" können nicht geändert werden.';
				}
				$i = $i + 1;
			}
			echo 'Sie müssen sich in 30 Sekunden einmal erneut einloggen.';
			echo '<br><script type="text/javascript">';
			echo 'setTimeout(reload_login, 30000);
				  
				  function reload_login()
				  {
					  var xhttp;
					  xhttp = new XMLHttpRequest();
					  xhttp.onreadystatechange = function () {
					  if (this.readyState == 4 && this.status == 200) {
						 result = xhttp.responseText;
					  }
					  };
					  xhttp.open("POST", "logout.php", true);
					  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					  console.log("Automatischer Logout erfolgreich.");
					  xhttp.send("saveLout=true");
				  }';
			echo '</script><br>';
		}
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
		include "check_IFactive.php";
?>	
	</div>
   </div>

</body>

</html>
