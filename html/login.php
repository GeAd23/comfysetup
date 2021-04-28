<?php
error_reporting(E_ALL);
$login = true;
if($login == true)
{
    header("location: account.php");
    exit();
}
else
{
    echo "404 Not Login!";
    exit();
}
?>
