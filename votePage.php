<!DOCTYPE html>
<html>
	<head>
		<title>Vote</title>
		<link rel="stylesheet" type="text/css" href="layout.css">
		<script type="text/javascript" src="electionUnit.js"></script>

	</head>
	<body>
		<form id = "panel" method="post" action="recordServer.php">
		</form>

		<script type="text/javascript">
			var panel = document.getElementById("panel");
			var breakline = document.createElement("br");
			var json_data = <?php
					$myaddress = "./database/".$_POST[uuid].".json";
					$myfile = fopen( $myaddress, "r") or die("Unable to open file");
					$ELJSON = fread($myfile,filesize($myaddress));
					fclose($myfile); 

					echo $ELJSON;
				?>;

			function createballot(container,type, options, questionNo){
				var option_layout = document.createElement("h2");
				if(type == 1){
					var alert_msg = document.createTextNode("(You can vote only one candidate in this question.)");
					container.appendChild(alert_msg);
					
					for(var j = 0; j < options.length; j++){
						var radio = document.createElement("input");
						radio.type = "radio";
						radio.name = questionNo;
						radio.value = options[j];
						var radio_text = document.createTextNode(options[j]);
						
						
						option_layout.appendChild(radio);
						option_layout.appendChild(radio_text);
					}

				}else if(type == 2){
					var alert_msg = document.createTextNode("(You can vote more than one candidate in this question.)");
					container.appendChild(alert_msg);

					for(var j = 0; j < options.length; j++){
						var check = document.createElement("input");
							check.type = "checkbox";
							check.name = questionNo;
							check.value = options[j];
						var check_text = document.createTextNode(options[j]);

						option_layout.appendChild(check);
						option_layout.appendChild(check_text);
					}
					
				}else if(type == 3){
					var EditText = document.createElement("input");
					EditText.type = "text";
					EditText.name = questionNo;
					var alert_msg = document.createTextNode("(You have to fill in the blank below.)");
					container.appendChild(alert_msg);
					option_layout.appendChild(EditText);

				}
				container.appendChild(option_layout);
			}

			for (var i = 0; i < json_data.length; i++){
				var questionblock = document.createElement("div");
				questionblock.setAttribute("class","questionblock");
				var paragraph = document.createElement("p");
				var question_layout = document.createElement("h2");
				var question_content = document.createTextNode("Q"+(i+1)+": "+json_data[i].questiontitle);
				question_layout.appendChild(question_content);
				paragraph.appendChild(question_layout);
				questionblock.appendChild(paragraph);
				createballot(questionblock,json_data[i].questiontype, json_data[i].optionArray, i);
				panel.appendChild(questionblock);
			}
			var qnumber = document.createElement("input");
			qnumber.type = "hidden";
			qnumber.name = "qnumber";
			qnumber.value = json_data.length;

			var quuid = document.createElement("input");
			quuid.type = "hidden";
			quuid.name = "uuid";
			quuid.value = <?php echo $_POST[uuid] ?>;

			var voteButton = document.createElement("button");
			var voteText = document.createTextNode("Vote!!!");
			voteButton.appendChild(voteText);
			panel.appendChild(qnumber);
			panel.appendChild(quuid);
			panel.appendChild(voteButton);



		</script>
		
	</body>
		
</html>
