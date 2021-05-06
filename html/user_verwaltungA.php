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
		<div id="uchangeA">
			<form action="account.php" method="post" enctype="multipart/form-data">
			    <input id="addbutton" type="submit" value="Speichern">
				<div id="uverwaltung"><br><br><br><br>
<?php
				
				echo '<br><input style="visibility:hidden" type="number" name="anz_items" size="5" value='.$i.' required>';
?>
				</div>
			    <input id="addbutton" type="submit" value="Speichern">
			</form>
		</div>
	</div>


</body>

</html>
