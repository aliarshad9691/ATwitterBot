<?php

include 'RestApi.php';

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
//    $tweets = $connectionUser->get('search/tweets',array('q' => "%40twitterapi"));

    $connectionUser = $twitter->connectAsUser();
//    $tweets = $connectionUser->post('friendships/create',array('screen_name' => "DrAwais4")); //2482645422

//    $tweets = $connectionUser->get('followers/list'); //2482645422

    $tweets = $connectionUser->get('friendships/show'); //2482645422

    echo "<pre>";
    print_r($tweets);
}
catch (Exception $e)
{
    echo $e->getMessage();
}