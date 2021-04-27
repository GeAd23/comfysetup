<?php
error_reporting(E_ALL);
$login = false;
if($login == true)
{
    header("location: div_Liste.php");
    exit();
}
else
{
    echo "404 Not Login!";
    exit();
}
?>