<!DOCTYPE html>
<html>
	<head>
		<title>Morgantown University Election System</title>
		<link rel="stylesheet" type="text/css" href="layout.css">
		<script type="text/javascript" src="electionUnit.js"></script>
	</head>
	<body>
		<h1 align="center">Head of Student Organizations</h1>
		<div id="tabsF">
			<ul>
			<li id="current"><a href="javascript://" onclick="loadTab(this,1);"><span>Election</span></a></li>
			<li><a href="javascript://" onclick="loadTab(this,2);"><span>Management</span></a></li>
			</ul>
		</div>
		<div id="tabsC">
			<div id="S1" style="display: inline">
				<table id="election_chooser">
					<tr id="e_uuid">
						<td>uuid</td>
					</tr>
					<tr id="e_title">
						<td>title</td>
					</tr>
					<tr id="e_state">
						<td>state</td>
					</tr>
					<tr id="e_modified">
						<td>edit</td>
					</tr>
					<tr id="e_publish">
						<td>authurize</td>
					</tr>
				</table>
			</div>
			<div id="S2" style="display: none"> 
			TODO<br>
			<ol>
				<li>disqualified students</li>
			</ol>
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

			function authElection(){
				 <?php
					$ELFile = fopen("database/List.json","r") or die("Unable to open file");
					$ELJSON = fread($ELFile,filesize("database/List.json"));
					fclose($ELFile);
					$ELObject = json_decode($ELJSON,true);
					
					for ($i =0 ; $i < count($ELObject); $i++){
						if($ELObject[$i]["uuid"] == $_POST[uuid]){
							$ELObject[$i]["state"] = 2;
						}
					}

					$ELFile = fopen("database/List.json","w") or die("Unable to open file");
					$new_ELJSON = json_encode($ELObject);
					fwrite($ELFile, $new_ELJSON);
					fclose($ELFile);
				?>
			}

			var electionListJSON = loadfile();

			var uuid_row = document.getElementById("e_uuid");
			var title_row = document.getElementById("e_title");
			var state_row = document.getElementById("e_state");
			var modified_row = document.getElementById("e_modified");
			var publish_row = document.getElementById("e_publish");
			var td_width = ((1 / (electionListJSON.length + 2))*100) + "%";
			
			for(var i = 0; i < electionListJSON.length; i++){ //manage the Elections
				var uuid_td = document.createElement("td");
				uuid_td.style.width = td_width;
				var title_td = document.createElement("td");
				title_td.style.width = td_width;
				var state_td = document.createElement("td");
				state_td.style.width = td_width;
				var modified_td = document.createElement("td");
				modified_td.style.width = td_width;
				var publish_td = document.createElement("td");
				publish_td.style.width = td_width;

				var uuid_text = document.createTextNode(electionListJSON[i].uuid);
				var title_text = document.createTextNode(electionListJSON[i].title);
				if(electionListJSON[i].state == -2){
					var state_text = document.createTextNode("Draft");
				}else if(electionListJSON[i].state == -1){
					var state_text = document.createTextNode("waiting ballot complete");
				}else if(electionListJSON[i].state == 1){
					var state_text = document.createTextNode("Ongoing");
				}else if(electionListJSON[i].state == 2){
					var state_text = document.createTextNode("Finish");
				}
				var modified_button = document.createElement("button");
				var modified_text = document.createTextNode("edit");
				var publish_button = document.createElement("button");
				var publish_text = document.createTextNode("authorize");

				uuid_td.appendChild(uuid_text);
				uuid_row.appendChild(uuid_td);

				title_td.appendChild(title_text);
				title_row.appendChild(title_td);

				state_td.appendChild(state_text);
				state_row.appendChild(state_td);

				modified_button.appendChild(modified_text);
				if(electionListJSON[i].state > 0){
					modified_button.disabled = true;
				}
				modified_td.appendChild(modified_button);
				modified_row.appendChild(modified_td);

				publish_button.appendChild(publish_text);
				if(electionListJSON[i].state != 1){
					publish_button.disabled = true;
				}

				var publish_form = document.createElement("form");
				publish_form.action="authorize.php";
				publish_form.method="post";
				var authorize_number = document.createElement("input");
				authorize_number.type="hidden";
				authorize_number.name="uuid";
				authorize_number.value = electionListJSON[i].uuid;
				publish_form.appendChild(publish_button);
				publish_form.appendChild(authorize_number);
				
				publish_td.appendChild(publish_form);
				publish_row.appendChild(publish_td);
			}

			{ //create add button
				var uuid_td = document.createElement("td");
				uuid_td.style.width = td_width;
				var title_td = document.createElement("td");
				title_td.style.width = td_width;
				var state_td = document.createElement("td");
				state_td.style.width = td_width;
				var modified_td = document.createElement("td");
				modified_td.style.width = td_width;
				var publish_td = document.createElement("td");
				publish_td.style.width = td_width;

				var add_button = document.createElement("button");
				var add_text = document.createTextNode("add");

				add_button.appendChild(add_text);
				uuid_td.appendChild(add_button);
				uuid_row.appendChild(uuid_td);
				title_row.appendChild(title_td);
				state_row.appendChild(state_td);
				modified_row.appendChild(modified_td);
				publish_row.appendChild(publish_td);
			}


		</script>
	</body>
</html>

