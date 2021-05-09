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

	if(isset($_POST["aprg"]))
	{
		if($_POST["aprg"] == "true")
		{
				if(isset($_POST["bprg"]))
				{
					$programm = $_POST["bprg"];
				}
				$db = new SQLite3("/var/www/data/MS1.db");
				$query = $db->prepare("Select * FROM programm WHERE name = '".$programm."';");
				$userlogin = $query->execute();
				$userdata = $userlogin->fetchArray();
				$db->close();
				if(count($userdata) > 0)
				{
					$lurl = substr($userdata["localurl"], 5);
				}
				if($lurl != "")
				{
					$proarray = shell_exec((escapeshellcmd('/var/www/scripts/prepareTemplate.py '.$lurl)));
					$name = substr($proarray, 0, -3);
					echo $name;
				}
				else
				{
					echo "None";
				}
		}
	}
	
	if(isset($_POST["apro"]))
	{
		if($_POST["apro"] == "true")
		{
				if(isset($_POST["bpro"]))
				{
					$programm = $_POST["bpro"];
				}
				$db = new SQLite3("/var/www/data/MS1.db");
				$query = $db->prepare("Select * from profile where name = '".$proinhalt."';");
				$userlogin = $query->execute();
				$userdata = $userlogin->fetchArray();
				$db->close();
				if(count($userdata) > 0)
				{
					$proid = $userdata["PID"];
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
					$lurl = "";
					foreach($userdata as &$item)
					{
						$lurl = $lurl.substr($item["localurl"], 5).",";
					}
				}
				if($lurl != "")
				{
					$lurl = substr($lurl, 0, -1);
					
					$proarray = shell_exec((escapeshellcmd('/var/www/scripts/prepareTemplate.py '.$lurl)));
					$name = substr($proarray, 0, -3);
					echo $name;
				}
				else
				{
					echo "None";
				}
		}
	}
?>
