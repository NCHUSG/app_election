<?php

class IltOAuthClient {

    private $client_key;
    private $client_secret;
    private $host_url;
    private $auth_srv_url;
    private $res_srv_url;
    private $res_owner_url;
    private $scope;

    public function __construct($key, $secret, $host_url, $scope = '')
    {
        $this->setter($key, $secret, $host_url, $scope);

        return;
    }

    public function run()
    {

        if ( true == (isset($_GET['token']) && !empty($_GET['token'])) ) {
            $token = $_GET['token'];
            return $this->get_data($token);
        }
        else {
            // redirect部分要再確認通道是http or https
            $uri =  $this->auth_srv_url .
                    '?client_key=' . $this->client_key .
                    '&redirect_uri=' . urlencode('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) .
                    '&scope=' . $this->scope;

            header( 'Location: ' . $uri ) or exit('Client redirect failed!');
        }

    }

    private function getPage($url) {
        if(strpos($url,"https") == 0){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_REFERER, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }else{
            return file_get_contents($url);
        }

    }

    private function get_data($token)
    {
        $res_url    = $this->res_srv_url .
                        '?token=' . $token .
                        '&client_key=' . $this->client_key .
                        '&client_secret=' . $this->client_secret;

        $data_json  = $this->getPage($res_url);
        $data_arr   = json_decode($data_json);

        if (empty($data_arr))
            throw new Exception("OAuth Resource Server Replied Nothing...");

        if ($data_arr->status > 1)
            throw new Exception("OAuth Resource Server Replied an ERROR: ".$data_arr->msg);

        return $data_arr;
    }

    public function setter($key = '', $secret = '', $host_url = '', $scope = '')
    {
        $this->client_key       = $key;
        $this->client_secret    = $secret;
        $this->host_url         = $host_url;
        $this->auth_srv_url     = $host_url . '/auth_server';
        $this->res_srv_url      = $host_url . '/resource_server';
        $this->res_owner_url    = $host_url . '/resource_owner';
        $this->scope            = $scope;
    }

    public function getter()
    {
        return array('key' => $this->key, 'secret' => $this->secret, 'host' => $this->host_url);
    }



}
