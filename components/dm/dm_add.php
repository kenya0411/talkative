<?php
/* 参考 [PHP] ライブラリに頼らないTwitterAPI入門
 * https://qiita.com/mpyw/items/b59d3ce03f08be126000
 */
$url = 'https://api.twitter.com/1.1/direct_messages/events/new.json';
// $test_message = $_POST['message'];
$userId = $recipient_id;
$consumerKey = $sConsumerKey ;
$consumerSecret = $sConsumerSecret;
$accessToken = $sAccessToken;
$accessTokenSecret  = $sAccessTokenSecret;

$json = [
    'event'=>[
        'type'=>'message_create',
        'message_create'=>[
            'target'=>[
                'recipient_id'=>$userId
            ],
            'message_data'=>[
                'text'=>$test_message,
            ]

        ]
    ]
];


$oauth_params = [
    'oauth_consumer_key'     => $consumerKey,
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp'        => time(),
    'oauth_version'          => '1.0a',
    'oauth_nonce'            => bin2hex(openssl_random_pseudo_bytes(16)),
    'oauth_token'            => $accessToken,
];

$base = $oauth_params;

// キー
$key = [$consumerSecret, $accessTokenSecret];
uksort($base, 'strnatcmp');

$oauth_params['oauth_signature'] = base64_encode(hash_hmac(
    'sha1',
    implode('&', array_map('rawurlencode', array(
        'POST',
        $url,
        str_replace(
            array('+', '%7E'),
            array('%20', '~'),
            http_build_query($base, '', '&')
        )
    ))),
    implode('&', array_map('rawurlencode', $key)),
    true
));
foreach ($oauth_params as $name => $value) {
    $items[] = sprintf('%s="%s"', urlencode($name), urlencode($value));
}
$signature = 'Authorization: OAuth ' . implode(', ', $items);


$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode($json),
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        $signature
    ],
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => 'gzip',
    CURLINFO_HEADER_OUT       => true,
]);
$response =  curl_exec($ch);
curl_close($ch);
