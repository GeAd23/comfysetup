<?php
session_start();
session_unset();
session_destroy();
header("location: index.php");
echo "User logged out!";
exit();
?>
