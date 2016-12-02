<!DOCTYPE html>
<html>
	<head>
		<title>Record server</title>
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

			$ballotaddress = "./database/".$_POST[uuid].".json";
			$ballotfile = fopen( $ballotaddress, "r") or die("Unable to open ". $_POST[uuid]." file");
			fclose($poolfile);
			$ballotJSON = fread($ballotfile, filesize($ballotaddress));
			$ballotObject = json_decode($ballotJSON,true);

			$saveaddress = "./database/".$_POST[uuid]."_record.json";
			$savedfile = fopen( $saveaddress, "a") or die("Unable to open record file");
			$savedJSON = fread($savedfile,filesize($saveaddress));
			fclose($savedfile);

			$VotetArray = array();
			for($x = 0; $x < count($ballotObject);$x++){
				if(filesize($saveaddress) > 0){
					$savedRecord = json_decode($savedJSON,true);
					$optionArray = $savedRecord[$x]["response"];
				}else{
					$optionArray = array();
				}

				$questionArray = array();
				$questionArray["type"] = $ballotObject[$x]["questiontype"];
				
				array_push($optionArray, $_POST[$x]);

				$questionArray["response"] = $optionArray;
				array_push($VotetArray, $questionArray);

			}


			$new_ballot_JSON = json_encode($VotetArray);
			$saveaddress = "./database/".$_POST[uuid]."_record.json";
			$savedfile = fopen( $saveaddress, "w") or die("Unable to open file");
			fwrite($savedfile,$new_ballot_JSON);
			fclose($savedfile);

			echo 'save ballot to server';
			redirectPage("/welcome.php");


		?>
	</body>
		
</html>
