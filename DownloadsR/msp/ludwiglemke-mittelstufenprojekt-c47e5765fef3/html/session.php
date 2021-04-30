<?php
session_start();
if($_SESSION["timer"] <= time()+1800)
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
?>
<?php
$db = new SQLite3("msp.db");
$query = $db->prepare("Select * from users where name = ?;");
$query->bindParam(1, '$user');
$userlogin = $query->execute();
$userdata = $userlogin->fetchArray();
if(count($userdata) == 0)
{
	echo "No User".$user."exists!";
}

foreach($userr in $userdata)
{
	include passwort_pruefung.php;
}
$db->close();
?>

<?php
	$passwort =$_POST["passwd"];
	$phash = $userdata["passwort"];
	if(password_hash($passwort, PASSWORD_DEFAULT) == $phash)
	{
		if(password_verify($passwort,$phash))
		{
			if(password_needs_rehash($phash, PASSWORD_DEFAULT))
			{
				$phash = password_hash($passwort, PASSWORD_DEFAULT);
				$db = new SQLite3("msp.db");
				$query = $db->prepare("Update users SET passwort = ? Where name = ?;");
				$query->bindParam(1, '$phash');
				$query->bindParam(2, '$user');
				$query->execute();
				$db->close();
			}
		}
	}
	else
	{
		echo "Wrong Password!";
	}
?>
