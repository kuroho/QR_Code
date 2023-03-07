<?php

$url = 'http://192.168.4.13:109/qr_code/request.php';
$data = array('action' => 'test');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

echo $result;

?>