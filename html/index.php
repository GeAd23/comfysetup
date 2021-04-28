<?php
session_start();
if($_SESSION["timer"]+1800 <= time())
{
    ?>
        <script type="text/javascript">document.getElementsByClassName('haltdeinefressejulien').style.display = 'block';</script>
        <script type="text/javascript">document.getElementsByClassName('logout').style.display = 'block';</script>
        <script type="text/javascript">document.getElementsByClassName('login').style.display = 'none';</script>
    <?php
}
else
{
    ?>
        <script type="text/javascript">document.getElementByClassName('haltdeinefressejulien').style.display = 'none';</script>
        <script type="text/javascript">document.getElementByClassName('login').style.display = 'block';</script>
        <script type="text/javascript">document.getElementsByClassName('logout').style.display = 'none';</script>
    <?php
    
}
?>

<!DOCTYPE html>
<html de>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Own stylesheet-->
<link rel="stylesheet" href="./stylesheets/light.css">
<!--Fonts-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet"> 
<!--Icons-->
<link href='https://css.gg/css' rel='stylesheet'>
<!--Navbar js-->
<script src="./js/nav.js"></script>
<!--jquery-->
<script type="text/javascript" src="./jquery/jquery-3.5.1.min.js"></script>

</head>

<body>

    <div id="side_nav" class="sidenav">
        <!--Inhalt der Navigationsleiste-->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="./index.php">Home</a><br>
        <a href="./account.php">Konto</a><br>
            <a class="haltdeinefressejulien" href="">Programm Liste</a><br>
            <a class="haltdeinefressejulien" href="">Profil Liste</a><br>
            <a class="haltdeinefressejulien" href="">Profil erstellen</a><br>
            <a class="haltdeinefressejulien" href="">Programm hinzufügen</a><br>
            <a class="haltdeinefressejulien" href="">Konto bearbeiten</a><br>
        <a href="./about.php">About</a><br>
        <a href="./help.php">Help</a>
        <a class="login" href="login1.php">Login</a>
        <a class="logout" href="logout.php">Logout</a>
    </div>
    <div id="side_bar" class="sidebar">
        <span onclick='openNav(); removeSide();'><img src="https://img.icons8.com/ios-filled/50/ffffff/menu--v1.png" alt="Menu"></span>
    </div>
    
    <div id="top_bar" class="topbar">
        <a href="./index.php" id="logo"><img src="./media/icons/logo.png" alt="Logo"></a>
    </div>
    
    <div id="info" class="info">
        <div>

            <div id=prglist>
                <?php
                    $path = './data/MS1.db';
                    $db = new SQLite3($path);
                    $result = $db->query('SELECT * FROM programs');
                    while ($row = $result->fetchArray()) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='".$row['name']."'/></td>";
                        echo "<td><img src=".$row['icon']."></td>";
                        echo "<td>".$row['name']."</td>";
                        echo "</tr>";
                    }
                ?>
            </div>
        </div>
    </div>


</body>

</html>