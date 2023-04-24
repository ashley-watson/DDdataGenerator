<html>
<body>
<h1>Ashley's Datadog Data Generator</h1>

<!-- Log generator
<p>Data generated at: <span id='date-time'></span>.</p> -->
<section>
<h2>Log Generator</h2>
<h4>Note: Requires a webserver (e.g. Apache2, Nginx, etc)</h4>
<p>Please also make sure to add the 'dd-agent' user to the group used by the access log</p>
<p>E.g. 'useradd -a -G adm dd-agent' & 'sudo chmod 644 /var/log/apache2/access.log'</p>
<button><a href="http://awsdeb.upheaval.systems:80" redirect>Generate 'HTTP/200 OK' Response</a></button>
<button><a href="http://awsdeb.upheaval.systems:80/crash.php" crash>Generate 'HTTP/404 Not Found' Response</a></button>
</p>
</section>

<!-- PHP block -->

<?php
require('events.php');
require('metrics.php');
?>
</section>

<!-- sets current time on page load -->
<script>
var dt = new Date();
document.getElementById('date-time').innerHTML=dt;
</script>
<p>Data generated at: <span id='date-time'></span>.</p>

</body>
</html>
