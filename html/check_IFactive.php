<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
if(isset($_SESSION["timer"]))
{
    echo '<br><script type="text/javascript">';
	echo 'var time = new Date();
		  var time1 = time.getTime();

		  function timer2() {
		    setTimeout(logoutT, 1000);
		  }

		  function logoutT(){
		    var time = new Date();
		    var time2 = time.getTime();
		    if((time2 - time1) >= 360000)
		    {
		       var xhttp;
			   xhttp = new XMLHttpRequest();
			   xhttp.onreadystatechange = function () {
			   if (this.readyState == 4 && this.status == 200) {
				  result = xhttp.responseText;
				  location.reload();
			   }
			   };
			   xhttp.open("POST", "logout.php", true);
			   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			   console.log("Automatischer Logout erfolgreich.");
			   xhttp.send("saveLout=true");
		    }
		    else
		    {
		       timer2();
		    }
		  }

		  logoutT();';
	echo '</script><br>';
}
?>
