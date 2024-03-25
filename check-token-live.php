<?php
/**
 * Check token live or die
 **/

set_time_limit(0);
error_reporting(0);

$lines = file(__DIR__.'/access_token.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
	$exp = explode("|", $line);
	$access_token = check($exp[0]);
	$res = json_decode($access_token)->error;
	if ($res->message == "The user is enrolled in a blocking, logged-in checkpoint" && $res->type == "OAuthException") {
		remove($exp[0]."|".$exp[1]."|".$exp[2]);
	}
}

function check($token) {
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
	curl_setopt ($ch, CURLOPT_URL, "https://graph.facebook.com/me?access_token=".$token);
	$response = curl_exec($ch);
	if(false === $response)
	{
		if(curl_errno($ch))
	{
		echo 'Curl error: ' . curl_error($ch);
	}
		die("error, curl_exec failed");
	}
	return $response;
}

function remove($pattern_to_match) {
    $file_path = __DIR__."/access_token.txt";
	chmod($file_path, 0777);
    $file_lines = file($file_path);
    $non_matching_lines = [];
    foreach ($file_lines as $line) {
        if (strpos($line, $pattern_to_match) === false) {
            $non_matching_lines[] = $line;
        }
    }
    file_put_contents($file_path, implode('', $non_matching_lines));
	chmod($file_path, 0777);
}
?>
