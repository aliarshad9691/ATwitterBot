<?php
/**
 * Created by PhpStorm.
 * Author: Ali Arshad
 * Description: This class is responsible for making all GET / POST requests, and returning data to the callie
 * Date: 4/18/2015
 * Time: 7:46 PM*
 */

class serverComm
{
    public $url;
    public $data;
    public $response;

    public function get()
    {
        $this->response['status']=false;

        if($this->url==""){
            $this->response['status']=false;
            $this->response['msg']="No URL Specified";
            return $this->response;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        $this->response['status']=true;
        $this->response['data']=$server_output;

        return $this->response;
    }

    public function post()
    {
        $this->response['status']=false;

        if($this->url==""){
            $this->response['status']=false;
            $this->response['msg']="No URL Specified";
            return $this->response;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        $this->response['status']=true;
        $this->response['data']=$server_output;

        return $this->response;
    }
}