<?php
			$phash = password_hash("msp2021", PASSWORD_DEFAULT);
			$db = new SQLite3("/var/www/data/MS1.db");
			$query = $db->prepare("Update users SET password_crypt = :1 Where username = 'admin';");
			$query->bindParam(':1', $phash);
			$query->execute();
			$db->close();
			echo $phash;
?>
