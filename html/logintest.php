<?php
//error_reporting(E_ALL);
//ini_set('display_errors', true);
if(isset($_POST['user'])) { 
	$user = $_POST['user'];
}
$db = new SQLite3("/var/www/data/MS1.db");
$query = $db->prepare("Select * from users where username = :1;");
$query->bindParam(':1', $user);
$userlogin = $query->execute();
$userdata = $userlogin->fetchArray();
$db->close();
try
{
	count($userdata);
}
catch(Exception $e)
{
	$userdata = 0;
}
if($userdata == 0)
{
                echo "<center>No User ".$user." exists!<br></center>";
                echo '<center><a href="./index.php">Home</a></center>';
                exit();
}
if(isset($_POST['passwd'])) { 
	$passwort = $_POST['passwd'];
}
if($userdata["active"] == true)
{
	$phash = $userdata["password_crypt"];
	$admindb = $userdata["admin"];
	if(password_verify($passwort,$phash))
	{
			if(password_needs_rehash($phash, PASSWORD_DEFAULT))
			{
				$phash = password_hash($passwort, PASSWORD_DEFAULT);
				$db = new SQLite3("/var/www/data/MS1.db");
				$query = $db->prepare("Update users SET password_crypt = ? Where username = ?;");
				$query->bindParam(1, '$phash');
				$query->bindParam(2, '$user');
				$query->execute();
				$db->close();
			}
		session_start();
		$_SESSION["timer"] = time();
		$_SESSION["username"] = $user;
		if($admindb == true)
		{
			$_SESSION["admin"] = true;
		}
		else
		{
			$_SESSION["admin"] = false;
		}
		header("location: account.php");
		exit();
	}
	else
	{
		echo "<center>Wrong Password!<br></center>";
		echo '<center><a href="./index.php">Home</a></center>';
		exit();
	}
}
else
{
	echo "<center>The User ".$user." is not activated at the moment!<br>Please contact your Administrator for help.<br></center>";
	echo '<center><a href="./index.php">Home</a></center>';
	exit();
}
?>
