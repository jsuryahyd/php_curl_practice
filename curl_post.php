<?php 

// set handler
$ch = curl_init();
// set options
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// specify url
curl_setopt($ch,CURLOPT_URL,"http://localhost/post_handler.php");
// set request as post
curl_setopt($ch,CURLOPT_POST,1);
//add post variables
curl_setopt($ch,CURLOPT_POSTFIELDS,array(
    'name'=>'surya',
    'certifications'=>'none',
    'knowledge'=>'very good'
));

$output = curl_exec($ch);
curl_close($ch);
echo $output;

