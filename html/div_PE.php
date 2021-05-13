<?php
session_start();
if($_SESSION["timer"]+1800 <= time())
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
		include "logout.php";
	}
}
else
{
	include "logout.php";
}

$proarray = shell_exec((escapeshellcmd('/var/www/scripts/getprglist.py')));
$i = 1;
echo '<script language="javascript" type="text/javascript">';
echo 'var deactivate = false;';
echo '</script>';
foreach($proarray as $item){
    echo '<script language="javascript" type="text/javascript">';
    echo 'function programm_bearbeitenD'.$i.'(){
        if(deactivate == false)
        {
                var name = '.$item["name"].';
        
        }
        else
        {
            deactivate = false;
        }
    }
    
    function programm_aktuell'.$i.'(){
        deactivate = true;
        var name = '.$item["name"].';
    
    }
    
    function programm_download'.$i.'(){
        deactivate = true;
        var name = '.$item["name"].';
    
    }
    
    function programm_bearbeiten'.$i.'(){
        deactivate = true;
        var name = '.$item["name"].';
    
    }
    
    function programm_loeschen'.$i.'(){
        deactivate = true;
        var name = '.$item["name"].';
    
    }';
    echo '</script>';
    echo '<div onclick="programm_bearbeitenD'.$i.'()" id="'.$item["name"].'" class="programm">
    <p id="inhalt">
    <b>'.$item["name"].'</b>&nbsp;&nbsp;&nbsp;Datum+Zeit&nbsp;&nbsp;&nbsp;
    <button onclick="programm_aktuell'.$i.'()" id="'.$item["name"].'">
    Aktuell
    </button>
    <button onclick="programm_download'.$i.'()" id="'.$item["name"].'">
    Herunterladen
    </button>
    <button onclick="programm_bearbeiten'.$i.'()" id="'.$item["name"].'">
    Bearbeiten
    </button>
    <button onclick="programm_loeschen'.$i.'()" id="'.$item["name"].'">
    Löschen
    </button>
    </p>
    </div>';
    $i = $i+1;
}
unset($item);
?>
