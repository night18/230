<!DOCTYPE html>
<html>
	<head>
		<title>Create ballot</title>
		<link rel="stylesheet" type="text/css" href="layout.css">
		<script type="text/javascript" src="electionUnit.js"></script>
		<script type="text/javascript">
			
			var index = 1;

			function addQuestion(){
				var panel = document.getElementById("ballotPanel");
				var container = document.createElement("div");
				container.setAttribute("id","question"+index);
				container.setAttribute("class","questionblock");
				
				var typeButton = document.createElement("button");
				container.appendChild(typeButton);
				panel.appendChild(container);
				typeButton.onclick = chooseQuestionType(index);
				index++;
			}

			function chooseQuestionType(questionNo){
				var container = document.getElementById("question"+questionNo);

				//remove container
				while(container.hasChildNodes()){
					container.removeChild(container.firstChild);
				}

				var infoText = document.createTextNode("Please choose quesiton type");
				var breakElement = document.createElement("br");
				var single_resp_button = document.createElement("button");
				var single_resp_text = document.createTextNode("single response question");
				var multiple_resp_button = document.createElement("button");
				var multiple_resp_text = document.createTextNode("multiple response question");
				var fillin_button = document.createElement("button");
				var fillin_text = document.createTextNode("fill in question");
				
				container.appendChild(infoText);
				container.appendChild(breakElement);
				single_resp_button.appendChild(single_resp_text);
				container.appendChild(single_resp_button);
				multiple_resp_button.appendChild(multiple_resp_text);
				container.appendChild(multiple_resp_button);
				fillin_button.appendChild(fillin_text);
				container.appendChild(fillin_button);

				single_resp_button.onclick = function(){
					addQuestionBox(questionNo,1);
					multipleChoice(questionNo);
				}
				multiple_resp_button.onclick = function(){
					addQuestionBox(questionNo,2);
					multipleChoice(questionNo);
				}
				fillin_button.onclick = function(){
					addQuestionBox(questionNo,3);
				}

			}

			function addQuestionBox(questionNo,questiontype){
				var container = document.getElementById("question"+questionNo);
				//remove container
				while(container.hasChildNodes()){
					container.removeChild(container.firstChild);
				}
				var paragraph = document.createElement("p");
				var questionText = document.createTextNode("Question "+ questionNo + " :");
				var quesitonBox = document.createElement("input");
				quesitonBox.setAttribute("type","text");
				quesitonBox.setAttribute("id", "qbox"+questionNo);
				var questionTypeBox = document.createElement("input");
				questionTypeBox.type = "hidden";
				questionTypeBox.setAttribute("value",questiontype);
				questionTypeBox.setAttribute("id", "qtype"+questionNo);


				paragraph.appendChild(questionText);
				paragraph.appendChild(quesitonBox);
				paragraph.appendChild(questionTypeBox);
				container.appendChild(paragraph);
			}

			function multipleChoice(questionNo){
				var container = document.getElementById("question"+questionNo);
				var optionButton = document.createElement("button");
				var optionLabel = document.createTextNode("new option");
				var option_index = 1;

				optionButton.appendChild(optionLabel);
				container.appendChild(optionButton);

				optionButton.onclick = function(){
					var paragraph = document.createElement("p");
					var optionNo = document.createTextNode("Option " + option_index +" :");
					var option = document.createElement("input");
					option.setAttribute("type","text");
					option.setAttribute("class","option"+questionNo);
					paragraph.appendChild(optionNo);
					paragraph.appendChild(option);
					container.insertBefore(paragraph,optionButton);
					option_index++;
				}
			}

			function saveBallot(){
				var ballotJson = createJsonFromQuestion();

				var inputbox =  document.getElementById("ballotData");
				inputbox.value = ballotJson;
				document.getElementById("sendtoserver").disabled = false;
				
			}

			function createJsonFromQuestion(){
				var Savedata = new Array();

				for(var i = 1; i < index; i++){
					var container = document.getElementById("question"+i);

					var qtype = new Object();
					qtype.questiontype =  document.getElementById("qtype"+i).value;

					qtype.questiontitle = document.getElementById("qbox"+i).value;

					var optionbox = new Object();
					optionbox.name = "optionArray";
					optionboxArray = new Array();

					if(qtype.value != 3){
						var optionArray = document.getElementsByClassName("option"+i);
						
						
						for(var j = 0; j<optionArray.length; j++){

							optionboxArray.push(optionArray[j].value);
						}

						qtype.optionArray = optionboxArray;
					}
					
					// var argsArray = new Array();
					// argsArray.push(qtype);
					// argsArray.push(qbox);
					// argsArray.push(optionbox);

					Savedata.push(qtype);
				}

				var JsonArray = JSON.stringify(Savedata);
				console.log(JsonArray);
				return JsonArray;
				
			}


		</script>
	</head>
	<body>
		<h1 align="center"><?php echo $_POST[topic]; ?></h1>
		<div id="ballotPanel">
			

		</div>
		<p>
			<button onclick="addQuestion()">Add new Question</button>
		</p>
		<p>
			<button onclick="saveBallot()">Confirm</button>
			<p id="return_msg"></p>
		</p>
		<form id="saveBallotToServer" action="ballotSaver.php" method="post">
			<input type="hidden" name="ballotData" id="ballotData">
			<input type="hidden" name="uuid" value=<?php echo $_POST[uuid]?>>
			<button id="sendtoserver" disabled="true">Save ballot data to server</button>
		</form>
	</body>
</html>
