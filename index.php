<html>
<body>
<h1>Ashley's Datadog Data Generator</h1>

<p>Data generated at: <span id='date-time'></span>.</p>
<section>
<p>
<h2>Log Generator</h2>
<h5>Note: Requires a webserver (e.g. Apache2, Nginx, etc)</h5>
<button><a href="http://awsdeb.upheaval.systems:80" redirect>Generate 'HTTP/200 OK' Response</a></button>
<button><a href="http://awsdeb.upheaval.systems:80/crash.php" crash>Generate 'HTTP/404 Not Found' Response</a></button>
</p>
</section>

<section>
<!-- Creating page body for input -->
<h2>Event Generator</h2>
<h4>Generate events below!</h4>
<form method="post">
API Key: <input type='text' name='apiKey'><br><br>
Event Title: <input type='text' name='eventTitle'><br>
Event Text: <input type='text' name='eventMsg'><br>
Event Tags <input type='text' name='eventTags'> (Note: Separate tags with a comma ',')<br>
<input type="submit" value="Submit event" name="submit"><br>

<?php

// Init cURL request
$event = curl_init();

// Parsing input to json
$apiKey = $_POST['apiKey'];

$title = $_POST['eventTitle'];
$text = $_POST['eventMsg'];
$tags = $_POST['eventTags'];

$payload = array(
	"Title" => $title,
	"Text" => $text,
	"Tags" => $tags,
);

$jsonPayload = json_encode($payload);

// Setting cURL options
curl_setopt($event, CURLOPT_URL, "https://api.datadoghq.com/api/v1/events");
curl_setopt($event, CURLOPT_POST, count($payload));
curl_setopt($event, CURLOPT_POSTFIELDS, $jsonPayload);
curl_setopt($event, CURLOPT_HTTPHEADER, array(
	'Accept: application/json',
	'DD-API-KEY: ' . $apiKey . '',
	'Content-Type: application/json',
));

// Posting event to Datadog
curl_exec($event);
curl_close($event);
//header('Location: http://awsdeb.upheaval.systems');
?>
</section>

<section>
<h2>Metric Generator</h2>
<h4>Coming soon..</h4>
</section>

<script>
var dt = new Date();
document.getElementById('date-time').innerHTML=dt;
</script>

</body>
</html>
