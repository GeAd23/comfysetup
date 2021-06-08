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
<title>Benutzer bearbeiten</title>
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
        <a href="./account.php"><img src="./media/icons/konto.svg" style="height: 20px; width: auto;">&nbsp;Konto</a><br>
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
		<div id="prgadd">
			<form action="account.php" method="post">
			    <button class="button1" type="Submit"><img src="./media/icons/save.svg" style="height: 20px; width: auto;">&nbsp;Speichern</button>
			    <div id="padd"><br>
			    <?php
				$db = new SQLite3("/var/www/data/MS1.db");
				$query = $db->prepare("Select * from users where username = '".$_SESSION["username"]."';");
				$userlogin = $query->execute();
				$userdata = $userlogin->fetchArray();
			    echo '<input type="text" id="kname" name="kname" size="30" placeholder="Name" value="'.$userdata["name"].'"><br><br><br>';
			    echo '<input type="text" id="uname" name="uname" size="30" placeholder="Username" value="'.$userdata["username"].'" required><br><br><br>';
			    echo '<input type="text" id="oldpw" name="oldpw" size="30" placeholder="Old Passwort" required><br>';
			    echo '<input type="text" id="newpw" name="newpw" size="30" placeholder="New Passwort"><br>';
			    echo '<input type="text" id="newpww" name="newpww" size="30" placeholder="New Passwort wiederholen">';
				$db->close();
			    ?>
			    <br><br></div>
			    <button class="button1" type="Submit"><img src="./media/icons/save.svg" style="height: 20px; width: auto;">&nbsp;Speichern</button>
			</form>
		</div>
	</div>


</body>

</html>
