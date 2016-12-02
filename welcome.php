<!DOCTYPE html>
<html>
	<head>
		<title>Morgantown University Election System </title>
		<link rel="stylesheet" type="text/css" href="layout.css">
	</head>
	<body>
		<table>
			<tr>
				<td colspan="3">
					<h1>Morgantown University Election System<h1>
				</td>
			</tr>
			<tr>
				<td style="width:80%" valign="top">
					This is Morgantown University Election system.<br>
					Students can vote in this system, and there are three type of ballots<br><br><br>
					1.Single response: The ballot would have some radiobuttons, and you can only vote one of them.<br>
					2.Multiple response: The ballot would have some check boxex, and you can vote some of them.<br>
					3.Text response: The ballot would have an input box, and you can write your word in that.	<br>
					

				</td>
				<td style="width:20%" valign="top">
					<form action="redirect.php" method="POST">
						<h1>Sign In</h1>
						<h2>Portal ID:</h2>
						<input type="text" name="usr_id">
						<h2>Password:</h2>
						<input type="text" name="usr_pwd"><br>
						<input type="submit" value="Login">

					</form>
				</td>

			</tr>
		</table>

	</body>
</html>

