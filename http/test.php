<?php

include_once __DIR__ . '/Client.php';
include_once __DIR__ . '/Response.php';

$client = new \PFinal\Http\Client();

/*
$data = ['nickname' => '张三',
    'mobile' => '18699999999',
    'code' => '1234',
    'password' => '111111',
    'openid' => '1234567890'
];

$response = $client->post('http://localhost/mzcx/web/api/user/register',$data);

//var_dump($response->getStatusCode());

echo $response->getBody();
*/

$data = [
    'mobile' => '18610089516',
    'code' => '1234',
];
$response = $client->post('http://localhost/mzcx/web/api/mobile/verify',$data);

echo $response->getBody();


/*
$response = $client->get('http://localhost/mzcx/web/api/user/profile?token=wwwe2e22ewds');

var_dump($response->getStatusCode());

var_dump($response->getBody());*/
