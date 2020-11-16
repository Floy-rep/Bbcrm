<?php

function generateSalt($len)
{
    $salt = '';
    for($i=0; $i<$len; $i++) {
        $salt .= chr(mt_rand(48,90)); //символ из ASCII-table
    }
    return $salt;
}

function get_ip(){
    $client  = $_SERVER['HTTP_CLIENT_IP'];
    $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;

    return $ip;
}

?>