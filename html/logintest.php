<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
if(isset($_POST['user'])) { 
	$user = $_POST['user'];
}
$db = new SQLite3("/var/www/data/MS1.db");
$query = $db->prepare("Select * from users where username = :1;");
$query->bindParam(':1', $user);
$userlogin = $query->execute();
$userdata = $userlogin->fetchArray();
if(count($userdata) == 0)
{
	echo "No User".$user."exists!";
	echo '<a href="./index.php">Home</a>';
	exit();
}
$db->close();

if(isset($_POST['passwd'])) { 
	$passwort = $_POST['passwd'];
}
$phash = $userdata["password_crypt"];
f(password_hash($passwort, PASSWORD_DEFAULT) == $phash)
{
	if(password_verify($passwort,$phash))
	{
		if(password_needs_rehash($phash, PASSWORD_DEFAULT))
			{
			$phash = password_hash($passwort, PASSWORD_DEFAULT);
			$db = new SQLite3("/var/www/data/MS1.db");
			$query = $db->prepare("Update users SET password_crypt = :1 Where username = :2;");
			$query->bindParam(':1', $phash);
			$query->bindParam(':2', $user);
			$query->execute();
			$db->close();
		}
	}
	session_start();
	$_SESSION["timer"] = time();
	$_SESSION["username"] = $user;
	if($userdata["passwort"] == "true")
	{
		$_SESSION["admin"] = true;
	else
	{
		$_SESSION["admin"] = false;
	}
	header("location: account.php");
    exit();
}
else
{
	echo "Wrong Password!";
	echo '<a href="./index.php">Home</a>';
	exit();
}
?>
