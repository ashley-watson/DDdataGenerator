<!-- Event Generator -->
<section>
<!-- creating page body for input -->
<h2>Event Generator</h2>
<h4>Generate events below!</h4>
<form method="post">
<input type='text' name='apiKey'> - API Key<br>
<input type='text' name='eventTitle'> - Event Title<br>
<input type='text' name='eventMsg'> - Event Text<br>
<input type='text' name='eventTags'> - Event Tags (Note: Separate tags with a comma ',')<br>
<input type="submit" value="Submit Event" name="submit"><br>
</form>

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

// POSTing event to Datadog
curl_exec($event);
curl_close($event);
//echo '<script>alert("Event submitted successfully!")</script>';
?>
</section>
