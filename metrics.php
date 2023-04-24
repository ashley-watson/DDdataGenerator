<section>
<h2>Metric Generator</h2>
<form method="post">
<input type='text' name='apiKey'> - API Key<br>
<!--<input type='text' name='metricRunLength'> - How long should we capture this metric for? (Value: Seconds - 86400 = 1 day)<br>-->
<input type='text' name='metricInterval'> - Capturing system load average, what value would you like to capture: 1 min, 5 min, 15 min? (only need the minute value)<br>
<input type='text' name'metricTags'> - Would you like to associate any tags with this metric? (Separate tags with a comma ',')<br>
<input type='submit' value='Start tracking metrics' name='metricSubmit'><br>
</form>

<?php
// Creating the cookie
//$metricTimeout = $metricRunLength;
//setcookie("metricExpire", $metricTimeout, time() + ($metricRunLength), "/");

// Setting variables for metrics
$time=time();
$loadAvg = sys_getloadavg();
$host = gethostname();

// Setting the metric
if ($_POST['metricInterval'] = 1) {
		$metricVariable = "datagen.system.load.1";
		$loadAvg = $loadAvg[0];
}
elseif ($_POST['metricInterval'] = 5) {
		$metricVariable = "datagen.system.load.5";
		$loadAvg = $loadAvg[1];
}
elseif ($_POST['metricInterval'] = 15){
		$metricVariable= "datagen.system.load.15";
		$loadAvg = $loadAvg[2];
}

// Init the cURL request
$metric = curl_init();

// Parse input to json
$apiKey = $_POST['apiKey'];
$tags = $_POST['metricTags'];

$payload = '{"series": [ {"metric": "' . $metricVariable . '","type": 0, "points": [ {"timestamp": ' . $time . ',"value": ' . $loadAvg . '} ] ,"resources": [ {"name": "' . $host . '", "type": "host"} ] } ] }';
// above line is producing $metricVariable & $host as bare strings
// "metric":datagen.system.load.1,  | instead of | "metric":"datagen.system.load.1", need to find a way to get it to recognize the variable as a string

echo 'Variable name: ' . $metricVariable . '';
echo 'Load average: ' . $loadAvg . '';
echo 'Payload raw: ' . $payload . '';
$jsonPayload = json_encode($payload);


// Setting cURL options
curl_setopt($metric, CURLOPT_URL, "https://api.datadoghq.com/api/v2/series");
curl_setopt($metric, CURLOPT_POST, count($payload));
curl_setopt($metric, CURLOPT_POSTFIELDS, $jsonPayload);
curl_setopt($metric, CURLOPT_HTTPHEADER, array(
	'Accept: application/json',
	'DD-API-KEY: ' . $apiKey . '',
	'Content-type: application/json',
));

// Posting metric to Datdog
// Only posts while cookie is active

//while(isset($_COOKIE[$metricExpire]) {
curl_exec($metric);
curl_close($metric);
//echo "Metric submitted! Waiting 5 minutes to check if cookie is still valid and sending again..";
//sleep 300;
//}
?>
</section>
