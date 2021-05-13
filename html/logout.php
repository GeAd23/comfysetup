<?php
session_start();
session_unset();
session_destroy();
header("location: index.php");
if(isset($_POST["saveLout"]))
{
	echo "User automatic logged out!";
}
else
{
	echo "User logged out!";
}
exit();
?>
