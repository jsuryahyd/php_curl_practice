<?php
$test_urls = array('https://www.cnn.com',"www.mozilla.com","www.facebook.com");
//user agents
$browsers = array(
    'standard'=>array(
        "user_agent" =>"Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6 (.NET CLR 3.5.30729)",
        "language"=>"en-us,en;q=0.5"
    ),
    "iphone"=> array(
        "user_agent"=>"Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1A537a Safari/419.3",
        "language"=>"en"
    ),
    "french"=>array(
        "user_agent"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; GTB6; .NET CLR 2.0.50727)",
        "language"=>"fr,fr-FR;q=0.5"
    ),
    );

foreach($test_urls as $url){
    echo "<h2>$url : </h2>";
    foreach($browsers as $test_name=>$browser){
        echo "<h4>{$test_name}</h4>";
        $ch = curl_init();
        //options
        curl_setopt($ch,CURLOPT_URL,$url);
        //SET USERAGENTS - takes array of strings - used braces to wrap variables to escape single quotes
        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
            "user-agent:{$browser['user_agent']}",
            "Accept-Language:{$browser['language']}"            
        ));
        //donot need body
        curl_setopt($ch,CURLOPT_NOBODY,1);        
        //NEED the header
        curl_setopt($ch,CURLOPT_HEADER,1);
        //return instead of output
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        $output = curl_exec($ch);
        if($output === FALSE){
            echo curl_error($ch);
            exit;
        }
        $meta = curl_getinfo($ch);
        //free handler
        curl_close($ch);
        // echo '<pre>',print_r($meta),'</pre>';
        // echo "<h3>HEADER INFORMATION</h3>";
        // echo $output; 
        if(preg_match("!Location:(.*)!",$output,$matches)){
            echo "Redirected to $matches[1]\n";
        }else{
            echo "no Redirection\n";            
        }

    }
}