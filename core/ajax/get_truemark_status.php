<?php
$uptimeKumaUrl = UPTIMEKUMA_URL;
$pageSlug = UPTIMEKUMA_GROUP;
$apiToken =  UPTIMEKUMA_API_KEY;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$uptimeKumaUrl/monitors");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: ' . $apiToken,
    'Accept: application/json'
]);
$response = curl_exec($ch);
curl_close($ch);

print_r($response);


