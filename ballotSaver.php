<!DOCTYPE html>
<html>
	<head>
		<title>ballot server</title>
		<link rel="stylesheet" type="text/css" href="layout.css">
		<script type="text/javascript" src="electionUnit.js"></script>

	</head>
	<body>
		<?php
			function redirectPage($location){
				$full_address = "http://" . $_SERVER["HTTP_HOST"]. $location;
				echo '<script type="text/javascript">',
					 'window.location.assign("'.$full_address.'");',
					 '</script>';
			}

			$myaddress = "./database/".$_POST[uuid].".json";
			$myfile = fopen( $myaddress, "w") or die("Unable to open file");
			fwrite($myfile, $_POST[ballotData]);
			fclose($myfile); 

			$ELFile = fopen("database/List.json","r") or die("Unable to open file");
			$ELJSON = fread($ELFile,filesize("database/List.json"));
			fclose($ELFile);
			$ELObject = json_decode($ELJSON,true);

			for ($i =0 ; $i < count($ELObject); $i++){
				if($ELObject[$i]["uuid"] == $_POST[uuid]){
					$ELObject[$i]["state"] = 1;
				}
			}

			$ELFile = fopen("database/List.json","w") or die("Unable to open file");
			$new_ELJSON = json_encode($ELObject);
			fwrite($ELFile, $new_ELJSON);
			fclose($ELFile);

			echo 'save ballot to server';
			redirectPage("/commisioner.php");


		?>
	</body>
		
</html>
