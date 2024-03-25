<?php
/**
 * Get All Pages
 **/

$token = ""; // main profile access token

$postFields = [
	'method' => 'post',
	'pretty' => 'false',
	'format' => 'json',
	'server_timestamps' => 'true',
	'locale' => 'en_US',
	'purpose' => 'fetch',
	'fb_api_req_friendly_name' => 'NativeTemplateScreenQuery',
	'fb_api_caller_class' => 'graphservice',
	'client_doc_id' => '221080835213847099052419048024',
	'variables' => '{"params":{"path":"/pages/nt_launchpoint_redesign/homescreen/","nt_context":{"styles_id":"e6c6f61b7a86cdf3fa2eaaffa982fbd1","using_white_navbar":true,"pixel_ratio":1.5,"is_push_on":true,"bloks_version":"c3cc18230235472b54176a5922f9b91d291342c3a276e2644dbdb9760b96deec"},"params":"{\"ref\":\"bookmark\"}","extra_client_data":{}},"scale":"1.5","nt_context":{"styles_id":"e6c6f61b7a86cdf3fa2eaaffa982fbd1","using_white_navbar":true,"pixel_ratio":1.5,"is_push_on":true,"bloks_version":"c3cc18230235472b54176a5922f9b91d291342c3a276e2644dbdb9760b96deec"}}',
	'fb_api_analytics_tags' => '["GraphServices"]',
	'client_trace_id' => 'c0616f50-e1da-4dd2-a366-10d5d3c5161a'
];

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
		'x-fb-request-analytics-tags: {"network_tags":{"product":"350685531728","purpose":"fetch","request_category":"graphql","retry_attempt":"0"},"application_tags":"graphservice"}',
		'x-fb-ta-logging-ids: graphql:c0616f50-e1da-4dd2-a366-10d5d3c5161a',
		'x-fb-rmd: state=URL_ELIGIBLE',
		'x-fb-sim-hni: 31016',
		'x-fb-net-hni: 31016',
		'authorization: OAuth '.$token,
		'x-graphql-request-purpose: fetch',
		'user-agent: [FBAN/FB4A;FBAV/417.0.0.33.65;FBBV/480086274;FBDM/{density=1.5,width=720,height=1244};FBLC/en_US;FBRV/0;FBCR/T-Mobile;FBMF/samsung;FBBD/samsung;FBPN/com.facebook.katana;FBDV/SM-N976N;FBSV/7.1.2;FBOP/1;FBCA/x86:armeabi-v7a;]',
		'content-type: application/x-www-form-urlencoded',
		'x-fb-connection-type: WIFI',
		'x-fb-background-state: 1',
		'x-fb-qpl-ec: uid=f70b2f3a-5175-4bf9-ae06-e9907f1ae547',
		'x-fb-friendly-name: NativeTemplateScreenQuery',
		'x-graphql-client-library: graphservice',
		'content-encoding: ',
		'x-fb-device-group: 3543',
		'x-tigon-is-retry: False',
		'priority: u=3,i',
		'accept-encoding: ',
		'x-fb-http-engine: Liger',
		'x-fb-client-ip: True',
		'x-fb-server-cluster: True'
	]);
	curl_setopt ($ch, CURLOPT_POST, TRUE);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));

	curl_setopt ($ch, CURLOPT_URL, "https://graph.facebook.com/graphql");
	$response = curl_exec($ch);
	if(false === $response)
	{ 
		if(curl_errno($ch))
	{
		echo 'Curl error: ' . curl_error($ch);
	}
		die("error, curl_exec failed");
	}

$getData = json_decode($response)->data->native_template_screen->nt_bundle->nt_bundle_attributes;
foreach($getData as $d) {
	if(!empty($d->profile_switcher_eligible_profile)) {
		$pData = $d->profile_switcher_eligible_profile;
		$token = $pData->session_info->access_token;
		$profileId = $pData->profile->id;
		$profileName = $pData->profile->name;
		$profileUri = $pData->profile->profile_picture->uri;
		echo "Token: ".$token."<br>ID: ".$profileId."<br>Name: ".$profileName."<br>Pic: ".$profileUri."<br><br>";
	}
}
?>
