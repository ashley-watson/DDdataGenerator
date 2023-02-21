<html>
<body>
<h1>Ashley's Datadog Data Generator</h1>
</body>
<p>Data generated at: <span id='date-time'></span>.</p>
<section>
<p>
<h2>Log Generator</h2>
<button><a href="http://awsdeb.upheaval.systems:80" redirect>Generate 200 OK</a></button>
<button><a href="http://awsdeb.upheaval.systems:80/crash.php" crash>Generate 404 Not Found</a></button>
</p>
</section>

<section>
<h2>Event Generator</h2>
Type event message here: <input type="text" id="event"><br><button onclick="submitEvent()">Submit</button>
</section>
<?php
echo "<script>";
echo "setTimeout(redirect(){";
echo "window.location.replace('http://awsdeb.upheaval.systems:80');";
echo "}, 50);";
echo "setTimeout(crash(){";
echo "window.location.replace('http://awsdeb.upheaval.systems:80/crash.php');";
echo"},50);";
echo "</script>";
?>
</html>

<script>
var dt = new Date();
document.getElementById('date-time').innerHTML=dt;
</script>

<script>
function submitEvent(event)
{
	let eventMsg = document.getElementById("event").value;
	var url = "https://api.datadoghq.com/api/v1/events/";;
	var data = {};
	data.title = "Event Generator";
	data.tag = "KRT";
	data.text = eventMsg;
	var json = JSON.stringify(data);
	//jsonData = '[ { "title": title, "text": eventMsg, "tags": [tagTitle:tagText] } ]';

	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = callbackFunction(xmlhttp);
	xmlhttp.open("POST", url);
	xmlhttp.setRequestHeader("Content-Type", "application/json");
	xmlhttp.setRequestHeader("Accept", "application/json");
	xmlhttp.setRequestHeader("DD-API-KEY", process.env.DD_API_KEY);
	xmlhttp.send(json);
	xmlhttp.onload = alertCheck() {
	if(xmlhttp.status == "200") {
		alert("Successfully submitted Event");
	} else {
		alert("Failed to submit Event");
	}
	}
}
</script>
