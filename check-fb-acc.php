<?php
/*
 * Check facebook account live or died
 */
$uid = "here is fb profile user id";
$url = "https://graph2.facebook.com/v3.3/{$uid}/picture?redirect=0";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($http_code == 200) {
    $d = json_decode($response);
    if ($d->data && $d->data->url && $d->data->url != 'https://static.xx.fbcdn.net/rsrc.php/v3/yo/r/UlIqmHJn-SK.gif') {
        echo "ID is: {$uid} live.";
    } else {
        echo "ID is: {$uid} died.";
    }
} else {
    echo "Error {$uid}.";
}
?>
