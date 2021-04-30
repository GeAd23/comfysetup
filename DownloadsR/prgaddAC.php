<?php
	if(isset($_POST["pname"]))
	{
		$name = $_POST["pname"];
	}
	if(isset($_POST["purl"]))
	{
		$url = $_POST["purl"];
	}
	if(isset($_POST["lurl"]))
	{
		$lurl = $_POST["lurl"];
	}
	if(isset($_POST["autoi"]))
	{
		$auto = $_POST["autoi"];
		if($auto == "")
		{
			$auto = false;
		}
		else
		{
			$auto = true;
		}
	}
	if(isset($_POST["pstandard"]))
	{
		$stand = $_POST["pstandard"];
		if($stand == "")
		{
			$stand = false;
		}
		else
		{
			$stand = true;
		}
	}
	if(isset($_FILES["bilddatei"]))
    {
        $bildname = $_FILES["bilddatei"]["name"];
        $extens = strtolower(pathinfo($bildname, PATHINFO_EXTENSION));
        $bildname = $name.".".$extens;
        $bild = $_FILES["bilddatei"]["tmp_name"];
        move_uploaded_file($bild, "/var/www/html/icos/".$bildname);
    }
    
    if(isset($name))
    {
		$sqlarray = array(Null, $name, $url, "/usb/".$lurl, "icos/".$bildname, $stand, "Win", "normal", $auto);
		$proarray = shell_exec((escapeshellcmd('/var/www/scripts/getprolist.py')));
		echo $proarray;
	}
?>
