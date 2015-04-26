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

    $connectionUser = $twitter->connectAsUser();


    $query = mysql_query("SELECT * FROM users WHERE requested=0 AND black_list=0 LIMIT 10");

    if(mysql_num_rows($query)>0)
    {
        while ($data=mysql_fetch_object($query)) {
            
            $time = strtotime("now");
            $frnd = $connectionUser->post('friendships/create',array('screen_name' => $data->screen_name)); //2482645422
            mysql_query("UPDATE users SET requested=1, time='$time' WHERE id=$data->id ");
        }
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
}