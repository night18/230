<!DOCTYPE html>
<html>
	<head>
		<title>Record server</title>
		<link rel="stylesheet" type="text/css" href="layout.css">
		<script type="text/javascript" src="electionUnit.js"></script>

	</head>
	<body>

		<?php

			$ballotaddress = "./database/".$_POST[uuid].".json";
			$ballotfile = fopen( $ballotaddress, "r") or die("Unable to open file");
			fclose($poolfile);
			$ballotJSON = fread($ballotfile, filesize($ballotaddress));
			$ballotObject = json_decode($ballotJSON,true);

			$saveaddress = "./database/".$_POST[uuid]."_record.json";
			$savedfile = fopen( $saveaddress, "r") or die("Unable to open file");
			$savedJSON = fread($savedfile,filesize($saveaddress));
			$savedRecord = json_decode($savedJSON,true);
			fclose($savedfile);

			for($x=0; $x < count($ballotObject); $x++){
				echo '<div class="questionblock">';
				echo '<h1>Question'.($x+1).': '.$ballotObject[$x]["questiontitle"].'</h1>';
				if($ballotObject[$x]["questiontype"] == 1){
					$result = array_count_values($savedRecord[$x]["response"]);
					echo 'The result is '. key($result).'.<br>';
					for($y = 0; $y < count($result); $y++){
						echo array_keys($result)[$y]. ' got '.$result[array_keys($result)[$y]].' votes, which is '. ($result[array_keys($result)[$y]]/count($savedRecord[$x]["response"])*100).'% of total votes<br>';
					}
				}else if($ballotObject[$x]["questiontype"] == 2){
					$result = array_count_values($savedRecord[$x]["response"]);
					echo 'The result is '. key($result).'.<br>';
					for($y = 0; $y < count($result); $y++){
						echo array_keys($result)[$y]. ' got '.$result[array_keys($result)[$y]].' votes, which is '. ($result[array_keys($result)[$y]]/count($savedRecord[$x]["response"])*100).'% of total votes<br>';
					}
				}if($ballotObject[$x]["questiontype"] == 3){
					$result = array_count_values($savedRecord[$x]["response"]);
					for($y = 0; $y < count($savedRecord[$x]["response"]); $y++){
						echo $savedRecord[$x]["response"][$y]. '<br>';
					}
				}
				echo '</div>';
			}

			// $VotetArray = array();
			// for($x = 0; $x < count($ballotObject);$x++){
			// 	if(filesize($saveaddress) > 0){
			// 		$savedRecord = json_decode($savedJSON,true);
			// 		$optionArray = $savedRecord[$x]["response"];
			// 	}else{
			// 		$optionArray = array();
			// 	}

			// 	$questionArray = array();
			// 	$questionArray["type"] = $ballotObject[$x]["questiontype"];
				
			// 	array_push($optionArray, $_POST[$x]);

			// 	$questionArray["response"] = $optionArray;
			// 	array_push($VotetArray, $questionArray);

			// }



		?>
	</body>
		
</html>
