<html>
<body>
<script>
// Requires: PHP, php-curl
// As of Feb 10 2023, this was tested on PHP 7.4.33 & php7.4-cur
// Permissions required: 755 on apache2 directory in /var/log and 644 on access.log
//
// Future plans - impliment text input to manually create and send logs in (possibly via API calls?)
<?php

// Init cURL
$fail = curl_init();

// Setting curl options	
curl_setopt($fail, CURLOPT_URL, "http://127.0.0.1/404.php");

// Execution
curl_exec($fail);
$http_status = curl_getinfo($fail, CURLINFO_HTTP_CODE);
//echo "<h2>Log generated with the following code: " . $http_status . ". Redirecting to main page now ..</h2>";
header('Location: index.php');
curl_close($fail);
?>
</script>
</body>
</html>
