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

	if(isset($_POST["proinhalt"]))
	{
		$proinhalt = $_POST["proinhalt"];
	}

	echo '<div id="proinhalt">
	<button class="button1" onclick="location.replace(\'prolist.php\')" id="'.$proinhalt.'">
    <img src="./media/icons/back.svg" style="height: 20px; width: auto;">&nbsp;Zurück
    </button>&nbsp;&nbsp;&nbsp;
	<button class="button1" onclick="programm_aktuell1()" id="'.$proinhalt.'">
    <img src="./media/icons/update.svg" style="height: 20px; width: auto;">&nbsp;Aktuell
    </button>
	<button class="button1" onclick="programm_download1()" id="'.$proinhalt.'">
    <img src="./media/icons/download.svg" style="height: 20px; width: auto;">&nbsp;Herunterladen
    </button><br><br><br>';
	echo '<script language="javascript" type="text/javascript">';
	echo '	function programm_aktuell'.'1'.'(){
                deactivate = true;
                var name = '.$proinhalt.';
            
            }
            
            function programm_download'.'1'.'(){
                deactivate = true;
                var name = '.$proinhalt.';
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
				xhttp.send("apro=true&bpro='.$proinhalt.'");
            }';
	echo '</script>';
	
    $db = new SQLite3("/var/www/data/MS1.db");
    $query = $db->prepare("Select * from profile where name = '".$proinhalt."';");
    $userlogin = $query->execute();
    $userdata = $userlogin->fetchArray(SQLITE3_ASSOC);
    $db->close();
	$proid = $userdata["PID"];
	echo '&nbsp;&nbsp;'.$userdata["name"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d.m.Y G:i:s",intval($userdata["changedate"])).'<br><br><br><br>';
    $db = new SQLite3("/var/www/data/MS1.db");
    $query = $db->prepare("Select programm from profile_programm where profile = '".$proid."';");
    $userlogin = $query->execute();
    $userdata = $userlogin->fetchArray(SQLITE3_ASSOC);
    $db->close();
	$prgliste = array();
	foreach($userdata as $programm)
	{
		$prgliste[] = $programm;
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
    $userdata = array($userlogin->fetchArray(SQLITE3_ASSOC));
    $db->close();
	foreach($userdata as &$item)
	{
		echo '<div id="'.$item["name"].'" class="proinhalt">
				<p id="inhalt">
				<img src="'.$item["program_bild"].'" class="pbild">&nbsp;&nbsp;&nbsp;<b>'.$item["name"].'</b>&nbsp;&nbsp;&nbsp;'.date("d.m.Y G:i:s",intval($item["last_update"])).'&nbsp;&nbsp;&nbsp;
				</p>
				</div>';
	}
	echo '<br><br><button class="button1" onclick="location.replace(\'prolist.php\')" id="'.$proinhalt.'">
		  <img src="./media/icons/back.svg" style="height: 20px; width: auto;">&nbsp;Zurück
		  </button>&nbsp;';
echo '</div>';
?>
