<?php
/**
 * Like And Follow Facebook Page
 **/
$pageid = ""; // targeted page id to give like follow
$actorid = ""; // main profile id, used to like follow
$token = ""; // access token, used to like follow

$postFields = [
	'method' => 'post',
	'pretty' => 'false',
	'format' => 'json',
	'server_timestamps' => 'true',
	'locale' => 'en_US',
	'fb_api_req_friendly_name' => 'PageLike',
	'fb_api_caller_class' => 'graphservice',
	'client_doc_id' => '92246462512975232024543564417',
	'variables' => '{"input":{"source":"page_profile","client_mutation_id":"d390bd05-c6f5-45e2-87c4-824f2425bc94","page_id":"'.$pageid.'","actor_id":"'.$actorid.'"}}',
	'fb_api_analytics_tags' => '["nav_attribution_id={\"0\":{\"bookmark_id\":\"986244814899307\",\"session\":\"\",\"subsession\":0,\"timestamp\":\"1706298676.534\",\"tap_point\":\"logout\",\"most_recent_tap_point\":\"logout\",\"bookmark_type_name\":null,\"fallback\":false}}","visitation_id=250100865708545:aea40:1:1706298471.122","GraphServices"]',
	'client_trace_id' => '12c7948e-6d1b-407e-b092-1f0721705ad7'
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
		'x-fb-request-analytics-tags: {"network_tags":{"product":"350685531728","purpose":"none","request_category":"graphql","retry_attempt":"0"},"application_tags":"graphservice"}',
		'x-fb-ta-logging-ids: graphql:12c7948e-6d1b-407e-b092-1f0721705ad7',
		'x-fb-sim-hni: 31016',
		'x-fb-net-hni: 31016',
		'authorization: OAuth '.$token,
		'user-agent: [FBAN/FB4A;FBAV/417.0.0.33.65;FBBV/480086274;FBDM/{density=1.5,width=720,height=1244};FBLC/en_US;FBRV/0;FBCR/T-Mobile;FBMF/samsung;FBBD/samsung;FBPN/com.facebook.katana;FBDV/SM-N976N;FBSV/7.1.2;FBOP/1;FBCA/x86:armeabi-v7a;]',
		'x-fb-background-state: 1',
		'content-type: application/x-www-form-urlencoded',
		'x-fb-connection-type: WIFI',
		'x-fb-friendly-name: PageLike',
		'x-graphql-client-library: graphservice',
		'x-fb-privacy-context: 3130154110338948',
		'x-fb-navigation-chain: ProfileFragment,profile_vnext_tab_posts,,1706304818.203,112408162,,,;ProfileFragment,timeline,,1706304815.603,112408162,,,;SearchResultsFragment,graph_search_results_page_blended,tap_search_result,1706304808.114,194498471,,,;GraphSearchFragment,search_typeahead,tap_search_bar,1706304797.591,125240032,391724414624676,,',
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
if (json_decode($response)->data->page_like->page->does_viewer_like) {
    echo "Success: Page liked and followed successfully!";
} else {
    echo 'Error: failed to like and follow page!';
}
?>
