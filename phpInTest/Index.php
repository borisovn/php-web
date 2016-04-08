<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
<script>
	function ShowPlayer(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		} else {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "ShowTable.php?q=" + str, true);
			xmlhttp.send();
		}
	}
</script>
<h1>
	<form>
		<?php

			if(!empty($_REQUEST['name'])) {

			$var = $_GET["name"];
				echo "Search For Player Name :
				<input type='text' size='30' text=$var value=''>
		       <div id='livesearch'></div>";
			} else {
    				echo "Search For Player Name :
				echo <input type='text' size='30' onkeyup='ShowPlayer(this.value)' value='s'>
		       <div id='livesearch'></div>";
			}
		?>

	</form>

	<br>
</h1>
<div id="txtHint"><b>Player info will be listed here...</b></div>

</body>
</html>