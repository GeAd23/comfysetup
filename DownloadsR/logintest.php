<?php
$user = $_POST["user"];
$db = new SQLite3("/var/www/data/MS1.db");
$query = $db->prepare("Select * from users where username = ?;");
$query->bindParam(1, '$user');
$userlogin = $query->execute();
$userdata = $userlogin->fetchArray();
if(count($userdata) == 0)
{
	echo "No User".$user."exists!";
	echo '<a href="./index.php">Home</a>';
	exit();
}
$db->close();

$passwort = $_POST["passwd"];
$phash = $userdata["password_crypt"];
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
