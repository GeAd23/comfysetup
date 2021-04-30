<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
	
// eine beliebige PHP-Funktion 
function search($item)
{
	$path = './data/leases.db';
    $db = new SQLite3($path);
    $result = $db->prepare('SELECT * FROM leases WHERE StartTime LIKE :time1 OR IP LIKE :ip OR MAC LIKE :mac OR Hostname LIKE :host OR Domain LIKE :domain OR StartUnixTime LIKE :sut OR Expires LIKE :exp OR Tags LIKE :tags;');
	$result->bindValue(":time1", $item."%");
	$result->bindValue(":ip", $item."%");
	$result->bindValue(":mac", $item."%");
	$result->bindValue(":host", $item."%");
	$result->bindValue(":domain", $item."%");
	$result->bindValue(":sut", $item."%");
	$result->bindValue(":exp", $item."%");
	$result->bindValue(":tags", $item."%");
	$result = $result->execute();
	
	echo '<table id="table1" border=1>';
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>StartTime</th>";
        echo "<th>IP</th>";
        echo "<th>MAC</th>";
        echo "<th>Hostname</th>";
        echo "<th>Domain</th>";
        echo "<th>StartUnixTime</th>";
        echo "<th>Expires</th>";
        echo "<th>Tags</th>";
    echo "</tr>";
    while ($row = $result->fetchArray()) {
        echo "<tr><td>".$row['rowid']."</td>";
        echo "<td>".$row['StartTime']."</td>";
        echo "<td>".$row['IP']."</td>";
        echo "<td>".$row['MAC']."</td>";
        echo "<td>".$row['Hostname']."</td>";
        echo "<td>".$row['Domain']."</td>";
        echo "<td>".$row['StartUnixTime']."</td>";
        echo "<td>".$row['Expires']."</td>";
        echo "<td>".$row['Tags']."</td></tr>";
    }
	$result->finalize();
    $db->close();
    echo '</tr>';
    echo '</table>';
}
 
function searchOrder($item, $dbelement, $mode)
{
	$path = './data/leases.db';
    $db = new SQLite3($path);
	if($mode == "down")
	{
		$result = $db->prepare('SELECT * FROM leases WHERE StartTime LIKE :time1 OR IP LIKE :ip OR MAC LIKE :mac OR Hostname LIKE :host OR Domain LIKE :domain OR StartUnixTime LIKE :sut OR Expires LIKE :exp OR Tags LIKE :tags ORDER BY :mode ASC;');
	}
	else if($mode == "up")
	{
		$result = $db->prepare('SELECT * FROM leases WHERE StartTime LIKE :time1 OR IP LIKE :ip OR MAC LIKE :mac OR Hostname LIKE :host OR Domain LIKE :domain OR StartUnixTime LIKE :sut OR Expires LIKE :exp OR Tags LIKE :tags ORDER BY :mode DESC;');
	}
	$result->bindValue(":time1", $item."%");
	$result->bindValue(":ip", $item."%");
	$result->bindValue(":mac", $item."%");
	$result->bindValue(":host", $item."%");
	$result->bindValue(":domain", $item."%");
	$result->bindValue(":sut", $item."%");
	$result->bindValue(":exp", $item."%");
	$result->bindValue(":tags", $item."%");
	$result->bindValue(":mode", $dbelement);
	$result = $result->execute();
	
	echo '<table id="table1" border=1>';
    echo "<tr>";
	$headers = ["<th>ID</th>", "<th>StartTime</th>", "<th>IP</th>", "<th>MAC</th>", "<th>Hostname</th>", "<th>Domain</th>", "<th>StartUnixTime</th>", "<th>Expires</th>", "<th>Tags</th>"];
		foreach($headers as $header)
		{
			switch (true) //Das Ergebnis [true], dass bei case gesucht wird.
			{
				case strstr($header, $dbelement, false):
					if($mode == "down")
					{
						switch ($dbelement)
						{
							case "ID":
								echo "<th>ID <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "StartTime":
								echo "<th>StartTime <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "IP":
								echo "<th>IP <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "MAC":
								echo "<th>MAC <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "Hostname":
								echo "<th>Hostname <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "Domain":
								echo "<th>Domain <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "StartUnixTime":
								echo "<th>StartUnixTime <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "Expires":
								echo "<th>Expires <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							case "Tags":
								echo "<th>Tags <img id='tdown' src='img_girl.jpg' alt='G↓' width='500' height='600'></th>";
								break;
							default:
								break;
						}
					}
					else if($mode == "up")
					{
						switch ($dbelement)
						{
							case "ID":
								echo "<th>ID <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "StartTime":
								echo "<th>StartTime <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "IP":
								echo "<th>IP <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "MAC":
								echo "<th>MAC <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "Hostname":
								echo "<th>Hostname <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "Domain":
								echo "<th>Domain <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "StartUnixTime":
								echo "<th>StartUnixTime <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "Expires":
								echo "<th>Expires <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							case "Tags":
								echo "<th>Tags <img id='tup' src='img_girl.jpg' alt='G↑' width='500' height='600'></th>";
								break;
							default:
								break;
						}
					}
					break;
				default:
					echo $header;
					break;
			}
		}
    echo "</tr>";
    while ($row = $result->fetchArray()) {
        echo "<tr><td>".$row['rowid']."</td>";
        echo "<td>".$row['StartTime']."</td>";
        echo "<td>".$row['IP']."</td>";
        echo "<td>".$row['MAC']."</td>";
        echo "<td>".$row['Hostname']."</td>";
        echo "<td>".$row['Domain']."</td>";
        echo "<td>".$row['StartUnixTime']."</td>";
        echo "<td>".$row['Expires']."</td>";
        echo "<td>".$row['Tags']."</td></tr>";
    }
	$result->finalize();
    $db->close();
    echo '</tr>';
    echo '</table>';
}

// Mit dem Argument in 'a' entscheiden wir welche Funktion aufgerufen werden soll
switch ($_POST['a'])
{
    case 'searchItem':
		if($_POST['b'] != "")
		{
			search($_POST['b']);
		}
		else
		{
			search("%");
		}
        break;
 
    case 'searchItemOrder':
		if($_POST['b'] != "")
		{
			searchOrder($_POST['b'], $_POST['c'], $_POST['d']);
		}
		else
		{
			searchOrder("%", $_POST['c'], $_POST['d']);
		}
        break;
	
	default:
        break;
}
?>
