<?php

// Port of
// https://github.com/agnelvishal2/Facebook/blob/master/sharelike.py

$url = "http://www.thehindu.com/features/magazine/keeping-the-thriller-alive/article7332623.ece";
$api = "http://graph.facebook.com/?fields=id,share,og_object%7Blikes.summary(true).limit(0)%7D&id=";

$request = $api . $url;

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $request,
    CURLOPT_USERAGENT => 'Share Like Script'
]);

$response = curl_exec($curl);

curl_close($curl);

// get json as array
$json = json_decode($response, true);

$shares = -1;
$likes = -1;

if (!is_null($json)) {

    if (array_key_exists('share', $json)) {
        if (array_key_exists('share_count',$json['share'])) {
            $shares = $json['share']['share_count'];
        }
    }

    if (array_key_exists('og_object', $json)) {
        if (array_key_exists('likes', $json['og_object'])) {
            if (array_key_exists('summary', $json['og_object']['likes'])) {
                if (array_key_exists('total_count', $json['og_object']['likes']['summary'])) {
                    $likes = $json['og_object']['likes']['summary']['total_count'];
                }
            }
        }
    }
}

echo "sharecount $shares\n";
echo "likescount $likes\n"; 

?>
