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

	if(isset($_POST["proinhalt"]))
	{
		$proinhalt = $_POST["proinhalt"];
	}

	echo '<div id="proinhalt">
	<button onclick="window.location.replace("prolist.php")" id="'.$proinhalt.'">
    Zurück
    </button>&nbsp;&nbsp;&nbsp;
	<button onclick="programm_aktuell1()" id="'.$proinhalt.'">
    Aktuell
    </button>
	<button onclick="programm_download1()" id="'.$proinhalt.'">
    Herunterladen
    </button><br><br><br>';
	
	$db = new SQLite3("/var/www/data/MS1.db");
    $query = $db->prepare("Select * from profile where name = '".$proinhalt."';");
    $userlogin = $query->execute();
    $userdata = $userlogin->fetchArray();
    $db->close();
	$proid = $userdata["PID"];
	echo '&nbsp;&nbsp;'.$userdata["name"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d.m.Y G:i:s",intval($userdata["changedate"])).'<br><br><br><br>';
	$db = new SQLite3("/var/www/data/MS1.db");
    $query = $db->prepare("Select * from profile_programm where profile = '".$proid."';");
    $userlogin = $query->execute();
    $userdata = $userlogin->fetchArray();
    $db->close();
	$prgliste = array();
	foreach($userdata as $programm)
	{
		$prgliste[] = $programm["programm"];
	}
	$querystring = "Select * from programm where ID in (";
	foreach($prgliste as $prgids)
	{
		$querystring = $querystring."'".$prgids."',";
	}
	$querystring = substr($querystring, 0, -1);
	$querystring = $querystring.") ORDER by name;";
	$db = new SQLite3("/var/www/data/MS1.db");
    $query = $db->prepare($querystring);
    $userlogin = $query->execute();
    $userdata = $userlogin->fetchArray();
    $db->close();
	foreach($userdata as &$item)
	{
		echo '<div id="'.$item[1].'" class="proinhalt">
				<p id="inhalt">
				<img src="'.$item[4].'" class="pbild">&nbsp;&nbsp;&nbsp;<b>'.$item[1].'</b>&nbsp;&nbsp;&nbsp;'.date("d.m.Y G:i:s",intval($item[7])).'&nbsp;&nbsp;&nbsp;
				</p>
				</div>';
	}
	echo '<br><br><button onclick="window.location.replace("prolist.php")" id="'.$proinhalt.'">
		  Zurück
		  </button>&nbsp;';
echo '</div>';
?>
