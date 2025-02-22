<?php
set_time_limit(0);
// API-based code for registration that works well.

// Send a POST request to this URL
$url = 'http://api.tuberboy.com/fb/reg'; // This URL is temporary and will be removed soon.

// POST fields to send with the request to register an account.
// Adjust this post's fields as needed or modify them as you want.
$data = [
    'name' => 'Liam Smith', // Full name
    'email' => 'example' . rand(111, 999) . '@outlook.com', // Random email - A verification code will be sent to this email or phone number
    'password' => 'LSacc' . rand(1111, 9999) . '?#@', // Random account password
    'gender' => 2, // Gender: Female = 1, Male = 2
    'proxy' => 'http://username:password@host_OR_ip:port' // For proxy support
];

// Simple PHP cURL example (you can use any programming language to make this request)
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);
$response = curl_exec($ch);

// Print the response or handle errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    $result = json_decode($response, true);
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}

curl_close($ch);

// old register codes (not working)
/*
$app = [
    'api_key' => '882a8490361da98702bf97a021ddc14d',
    'secret' => '62f8ce9f74b12f84c123cc23437a4a32'
];

$email_prefix = [
    'gmail.com',
    'hotmail.com',
    'yahoo.com',
    'live.com',
    'rocket.com',
    'outlook.com',
];

$randomBirthDay = date('Y-m-d', rand(strtotime('1980-01-01'), strtotime('1995-12-30')));
$names = [
    'first' => [
        'JAMES', 'JOHN', 'ROBERT', 'MICHAEL', 'WILLIAM', 'DAVID',
    ],
    'last' => [
        'SMITH', 'JOHNSON', 'WILLIAMS', 'BROWN', 'JONES', 'MILLER'
    ],
    'mid' => [
        'Alexander', 'Anthony', 'Charles', 'Dash', 'David', 'Edward'
    ]
];
$randomFirstName = $names['first'][array_rand($names['first'])];
$randomName = $names['mid'][array_rand($names['mid'])].' '.$names['last'][array_rand($names['last'])];
$password = 'PAss'.rand(0000,9999999).'?#@';
$fullName = $randomFirstName.' '.$randomName;
$md5Time = md5(time());
$hash = substr($md5Time, 0, 8).'-'.substr($md5Time, 8, 4).'-'.substr($md5Time, 12, 4).'-'.substr($md5Time, 16, 4).'-'.substr($md5Time, 20, 12);
$emailRand = strtolower(str_replace(' ', '', $fullName)).substr(md5(time().date('Ymd',rand(0000,time()))), 0, 6).'@'.$email_prefix[array_rand($email_prefix)];
$gender = (rand(0, 10) > 5 ? 'M' : 'F');
$req = [
        'api_key' => $app['api_key'],
        'attempt_login' => true,
        'birthday' => $randomBirthDay,
        'client_country_code' => 'EN',
        'fb_api_caller_class' => 'com.facebook.registration.protocol.RegisterAccountMethod',
        'fb_api_req_friendly_name' => 'registerAccount',
        'firstname' => $randomFirstName,
        'format' => 'json',
        'gender' => $gender,
        'lastname' => $randomName,
        'email' => $emailRand,
        'locale' => 'en_US',
        'method' => 'user.register',
        'password' => $password,
        'reg_instance' => $hash,
        'return_multiple_errors' => true
];
ksort($req);
$sig = '';
foreach($req as $k => $v){
        $sig .= $k.'='.$v;
}
$ensig = md5($sig.$app['secret']);
$req['sig'] = $ensig;
$api = 'https://b-api.facebook.com/method/user.register';

$reg = _call($api, $req);

print_r($reg);

function _call($url = '', $params = [], $post = 1) {
    $c = curl_init();
    $opts = [
        CURLOPT_URL => $url.(!$post && $params ? '?'.http_build_query($params) : ''),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => '[FBAN/FB4A;FBAV/35.0.0.48.273;FBDM/{density=1.33125,width=800,height=1205};FBLC/en_US;FBCR/;FBPN/com.facebook.katana;FBDV/Nexus 7;FBSV/4.1.1;FBBK/0;]',
        CURLOPT_SSL_VERIFYPEER => false
    ];
    if($post) {
        $opts[CURLOPT_POST] = true;
        $opts[CURLOPT_POSTFIELDS] = $params;
    }
    curl_setopt_array($c, $opts);
    $d = curl_exec($c);
    curl_close($c);
    return $d;
}
*/
?>
