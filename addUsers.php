<?php

include 'RestApi.php';
require "db.php";
set_time_limit (0);
/*
* Config
*/
$consumerKey = 'TC2SnNuC8IIBRHDdJsMlRP0o8';
$consumerSecret = 'z3xTPGtYASxaTlFnnkXUADTE5pTIRoUf1hqdGdSxr3wPkSijwB';
$accessToken = '1421124540-nBIUB9lkRMfStAY3JLdFS2vnKChADW5geVk0WF3';
$accessTokenSecret = 'p95TCutaB231uFONMkhuEtUDWacr0lZPMmPhkprNTqPuh';


/*
* Create new RestApi instance
* Consumer key and Consumer secret are required
* Access Token and Access Token secret are required to use api as a user
*/
try
{


    $twitter = new \TwitterPhp\RestApi($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

    $connection = $twitter->connectAsApplication();


    //getting top trends of Islamabad 23424922
    $trends = $connection->get('trends/place',array('id' => 23424922));
    $trends = $trends[0]['trends'];

foreach($trends as $t):
    $topTrend = $t['query'];


    $tweets = $connection->get('search/tweets',array('q' => $topTrend, "result_type" => 'recent', 'count' => 1000));

    $i=0;
    foreach($tweets['statuses'] as $tweet)
    {
        if($tweet['user']['friends_count']/$tweet['user']['followers_count']>=0.9)
        {
            echo "$i) <br />";
            echo "Screen Name: ".$tweet['user']['screen_name'];
            echo "<br />";
            echo "Id: ".$tweet['user']['id'];
            echo "<br />";
            echo "Followers: ".$tweet['user']['followers_count'];
            echo "<br />";
            echo "Following: ".$tweet['user']['friends_count'];
            echo "<br />";
            echo "Ratio: ".$tweet['user']['friends_count']/$tweet['user']['followers_count'];
            echo "<br />";
            echo "<hr />";
            echo "<br />";
            $i++;

            $screen_name = $tweet['user']['screen_name'];
            $followers = $tweet['user']['followers_count'];
            $follow = $tweet['user']['friends_count'];


            $query = mysql_query("SELECT * FROM users WHERE screen_name = '$screen_name'");
            if(mysql_num_rows($query)==0)
            {
                mysql_query("INSERT INTO users VALUES('','$screen_name',0,0,'$followers','$follow',0)");
            }

        }
        $i++;
    }
    
    echo "<br />";
    echo "<br />";
    echo "<br />";
    echo $i++;

endforeach;


   echo "<pre>";
   print_r($trends);
}
catch (Exception $e)
{
    echo $e->getMessage();
}