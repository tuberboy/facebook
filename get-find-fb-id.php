<?php
set_time_limit(0);
/**
 * Get facebook profile or page id
 **/
function getFBID($url) {
    $name = substr($url, strrpos($url, '/') + 1);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'sec-ch-ua-mobile: ?0',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36',
        'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="90", "Google Chrome";v="90"',
        'viewport-width: 1030',
        'accept: */*',
        'sec-fetch-site: same-origin',
        'sec-fetch-mode: cors',
        'sec-fetch-dest: empty',
        'accept-language: en-US,en;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5'
    ]);
    curl_setopt($ch, CURLOPT_URL, "https://m.facebook.com/".$name);
    $response = curl_exec($ch);
    $match = '';
    if (preg_match('/entity_id:(.+?)}]]/', $response, $matched)) {
        $match .=$matched[1];
    }
    if (preg_match('/<meta property="al:android:url" content="fb:\/\/profile\/(.+?)"/', $response, $matched)) {
        $match .= $matched[1];
    }
    return $match;
}

echo getFBID('https://www.facebook.com/tuberboy');
?>
