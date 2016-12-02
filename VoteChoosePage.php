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
			</ul>
		</div>
		<div id="tabsC">
			<div id="S1" style="display: inline"> 
				<table>
					<tr id="e_uuid">
						<td id="uuid_label_1">uuid</td>
					</tr>
					<tr id="e_title">
						<td id="title_label_1">title</td>
					</tr>
					<tr id="e_vote">
						<td id="vote_label_1">vote</td>
					</tr>
				</table>
			</div>
			<div id="S2" style="display: none"> 
					<table>
					<tr id="f_uuid">
						<td id="uuid_label_2">uuid</td>
					</tr>
					<tr id="f_title">
						<td id="title_label_2">title</td>
					</tr>
					<tr id="f_result">
						<td id="vote_label_2">Result</td>
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
			var td_width = ((1 / (electionListJSON.length))*100) + "%";
			var uuid_label = document.getElementById("e_uuid");
			
			for(var i = 0; i < electionListJSON.length; i++){
				if(electionListJSON[i].state == 1){
					var uuid_row = document.getElementById("e_uuid");
					var title_row = document.getElementById("e_title");
					var vote_row = document.getElementById("e_vote");

					// var uuid_label = document.getElementById("uuid_label_1");
					// uuid_label.style.width = td_width;
					// var title_label = document.getElementById("title_label_1");
					// title_label.style.width = td_width;
					// var vote_label = document.getElementById("vote_label_1");
					// vote_label.style.width = td_width;
					
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
				}
				
			}

		</script>
	</body>
</html>

