<!DOCTYPE html>
<html>
	<head>
		<title>Morgantown University Election System</title>
		<link rel="stylesheet" type="text/css" href="layout.css">
		<script type="text/javascript" src="electionUnit.js"></script>
	</head>
	<body>
		<h1 align="center">Election Commisioner Vote and Management</h1>
		<div id="tabsF">
			<ul>
			<li><a href="javascript://" onclick="loadTab(this,1);"><span>Ongoing Vote</span></a></li>
			<li><a href="javascript://" onclick="loadTab(this,2);"><span>Finished Vote</span></a></li>
			<li id="current"><a href="javascript://" onclick="loadTab(this,3);"><span>Create Ballots</span></a></li>
			</ul>
		</div>
		<div id="tabsC">
			<div id="S1" style="display: none"> 
				<table>
					<tr id="e_uuid">
						<td>uuid</td>
					</tr>
					<tr id="e_title">
						<td>title</td>
					</tr>
					<tr id="e_vote">
						<td>vote</td>
					</tr>
				</table>
			</div>
			<div id="S2" style="display: none"> 
					<table>
					<tr id="f_uuid">
						<td>uuid</td>
					</tr>
					<tr id="f_title">
						<td>title</td>
					</tr>
					<tr id="f_result">
						<td>Result</td>
					</tr>
				</table> 
			</div>
			<div id="S3" style="display: inline">
				<table id="election_chooser">
					<tr id="c_uuid">
						<td>uuid</td>
					</tr>
					<tr id="c_title">
						<td>title</td>
					</tr>
					<tr id="c_state">
						<td>state</td>
					</tr>
					<tr id="c_ballot">
						<td>create ballot</td>
					</tr>
				</table>
			</div>
			
		</div>


		<script type="text/javascript">
			function loadfile(){
				var data = <?php
					$ELFile = fopen("database/List.json","r") or die("Unable to open file");
					$ELJSON = fread($ELFile,filesize("database/List.json"));
					echo $ELJSON;
					?>;
				return data;
			}

			var electionListJSON = loadfile();

			console.log(electionListJSON);
			var td_width = ((1 / (electionListJSON.length + 2))*100) + "%";
			
			for(var i = 0; i < electionListJSON.length; i++){
				if(electionListJSON[i].state == 1){
					var uuid_row = document.getElementById("e_uuid");
					var title_row = document.getElementById("e_title");
					var vote_row = document.getElementById("e_vote");
					
					var uuid_td = document.createElement("td");
					uuid_td.style.width = td_width;
					var title_td = document.createElement("td");
					title_td.style.width = td_width;
					var vote_td = document.createElement("td");
					vote_td.style.width = td_width;

					var uuid_text = document.createTextNode(electionListJSON[i].uuid);
					var title_text = document.createTextNode(electionListJSON[i].title);
					var vote_form = document.createElement("form");
					vote_form.method = "POST";
					vote_form.action = "votePage.php";
					var vote_button = document.createElement("button");
					var vote_text = document.createTextNode("Vote!!");
					var vote_uuid = document.createElement("input");
					vote_uuid.type = "hidden";
					vote_uuid.name = "uuid";
					vote_uuid.value = electionListJSON[i].uuid;

					uuid_td.appendChild(uuid_text);
					uuid_row.appendChild(uuid_td);

					title_td.appendChild(title_text);
					title_row.appendChild(title_td);

					vote_button.appendChild(vote_text);
					vote_form.appendChild(vote_button)
					vote_form.appendChild(vote_uuid);
					vote_td.appendChild(vote_form);
					vote_row.appendChild(vote_td);


				}else if(electionListJSON[i].state == 2 && electionListJSON[i].visibility == true){
					var uuid_row = document.getElementById("f_uuid");
					var title_row = document.getElementById("f_title");
					var result_row = document.getElementById("f_result");

					var uuid_td = document.createElement("td");
					uuid_td.style.width = td_width;
					var title_td = document.createElement("td");
					title_td.style.width = td_width;
					var result_td = document.createElement("td");
					result_td.style.width = td_width;

					var uuid_text = document.createTextNode(electionListJSON[i].uuid);
					var title_text = document.createTextNode(electionListJSON[i].title);
					var result_form = document.createElement("form");
					result_form.method = "POST";
					result_form.action = "resultpage.php";
					var result_button = document.createElement("button");
					var result_text = document.createTextNode("Result");
					var result_uuid = document.createElement("input");
					result_uuid.type = "hidden";
					result_uuid.name = "uuid";
					result_uuid.value = electionListJSON[i].uuid;

					uuid_td.appendChild(uuid_text);
					uuid_row.appendChild(uuid_td);

					title_td.appendChild(title_text);
					title_row.appendChild(title_td);

					result_button.appendChild(result_text);
					result_form.appendChild(result_button);
					result_form.appendChild(result_uuid);
					result_td.appendChild(result_form);
					result_row.appendChild(result_td);
				}else if(electionListJSON[i].state == -1){
					var uuid_row = document.getElementById("c_uuid");
					var title_row = document.getElementById("c_title");
					var state_row = document.getElementById("c_state");
					var ballot_row = document.getElementById("c_ballot");

					var uuid_td = document.createElement("td");
					uuid_td.style.width = td_width;
					var title_td = document.createElement("td");
					title_td.style.width = td_width;
					var state_td = document.createElement("td");
					state_td.style.width = td_width;
					var ballot_td = document.createElement("td");
					ballot_td.style.width = td_width;
					

					var uuid_text = document.createTextNode(electionListJSON[i].uuid);
					var title_text = document.createTextNode(electionListJSON[i].title);
					var state_text = document.createElement("span");
					state_text.setAttribute("style", "color:red");
					var textNode = document.createTextNode("Needs to create ballot");
					state_text.appendChild(textNode);
					
					var ballot_form = document.createElement("form");
						
					ballot_form.setAttribute("id","ballot_form");
					ballot_form.action = "createballot.php";
					ballot_form.method = "post";

					var ballot_input = document.createElement("input");
						
					ballot_input.type = "hidden";
					ballot_input.name = "topic";
					ballot_input.value = electionListJSON[i].title;

					var ballot_input_uuid = document.createElement("input");
						
					ballot_input_uuid.type = "hidden";
					ballot_input_uuid.name = "uuid";
					ballot_input_uuid.value = electionListJSON[i].uuid;

					var ballot_button = document.createElement("button");
					var ballot_text = document.createTextNode("create ballot");
					
					ballot_button.onclick = function(){
						document.getElementById("ballot_form").submit();
					}

					uuid_td.appendChild(uuid_text);
					uuid_row.appendChild(uuid_td);

					title_td.appendChild(title_text);
					title_row.appendChild(title_td);

					state_td.appendChild(state_text);
					state_row.appendChild(state_td);

					ballot_button.appendChild(ballot_text);
					ballot_form.appendChild(ballot_input);
					ballot_form.appendChild(ballot_input_uuid);
					ballot_form.appendChild(ballot_button);
					ballot_td.appendChild(ballot_form);
					ballot_row.appendChild(ballot_td);

					}
				
			}

		</script>
	</body>
</html>

