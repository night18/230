<!DOCTYPE html>
<html>
	<head>
		<title>Morgantown University Election System</title>
		<link rel="stylesheet" type="text/css" href="layout.css">
		
	</head>
	<body>

		<?php 
			$usr_id = $_POST[usr_id];
			$usr_pwd = $_POST[usr_pwd];

			function redirectPage($location){
				$full_address = "http://" . $_SERVER["HTTP_HOST"]. $location;
				echo '<script type="text/javascript">',
					 'window.location.assign("'.$full_address.'");',
					 '</script>';
			}

			if($usr_id == "student" && $usr_pwd == "1234"){
				redirectPage("/VoteChoosePage.php");
			}else if($usr_id == "hso" && $usr_pwd == "1234"){
				redirectPage("/managePage.php");
			}elseif ($usr_id == "ec" && $usr_pwd == "1234") {
				redirectPage("/commisioner.php");
			}
		?>
	</body>
</html>

