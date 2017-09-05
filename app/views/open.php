<?php
	//exec('python /var/www/script/opendoor.py');
	// print_r($status);
	$output = shell_exec('python /var/www/html/script/opendoor.py');
	echo "<pre>$output</pre>";
?>