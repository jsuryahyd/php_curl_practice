<?php
//without curl
// try{
//     // $content = file_get_contents("https://code.tutsplus.com/tutorials/techniques-for-mastering-curl--net-8470");
//     // faking useragent
//     $context = stream_context_create(
//         array(
//             "https" => array(
//                 "header" => "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
//             )
//         )
//     );
    
//     echo file_get_contents("https://code.tutsplus.com/tutorials/techniques-for-mastering-curl--net-8470", false, $context);
//     // $content = file("https://code.tutsplus.com/tutorials/techniques-for-mastering-curl--net-8470");
    
//     // echo $content;
// }catch(Exception $e){
//     echo $e;
// }

//cURL work flow
/*
- curl init
- curl set options
- curl execute and fetch result
- free up curl handler
*/
//curl init
$ch = curl_init();
//curl options
//1.URL
curl_setopt($ch,CURLOPT_URL,"https://code.tutsplus.com/tutorials/techniques-for-mastering-curl--net-8470");
//2.
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//3.FETCH HEADER?
curl_setopt($ch,CURLOPT_HEADER,0);

//CURL EXECUTE
$output = curl_exec($ch);
//handle execution errors - RETURNS FALSE ON ERROR
if($output === FALSE){
    echo curl_error($ch);
    exit;
}
//get meta info - gives an array
$meta = curl_getinfo($ch);
//4.FREE UP CURL HANDLER
curl_close($ch);
echo '<pre>',print_r($meta),'</pre>';
file_put_contents('curl_tut_page.html',$output);
