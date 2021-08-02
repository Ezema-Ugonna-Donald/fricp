<?php

function secure_encrypt ($password)
{
    $first_key = base64_decode (FIRST_KEY);

    $method = "aes-128-cbc";
    $iv = "1234567812345678";
            
    $output = openssl_encrypt($password, $method, $first_key, OPENSSL_RAW_DATA , $iv);
    return $output = base64_encode ($output);
}