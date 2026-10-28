<?php

namespace App\Repositories;



use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;



class GuzzleHttpRequest{

    public function __construct()
    {

        $this->handlerStack = HandlerStack::create(new CurlHandler());
        $this->handlerStack->push( Middleware::retry( $this->retryDecider(), $this->retryDelay() ));

        $this->token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1NzU5MjgxMzgsImlzcyI6InBoYWxjb24tand0LWF1dGgiLCJkaXNwbGF5bmFtZSI6ImRjaGF2ZXoiLCJ1c2VyX2lkIjoiNjciLCJpYXQiOjE1NzUzMjMzMzh9.otErL3G8DCx0bqSvblhTfJSvbbyxocE_sPc6m6pcSik';

        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Token' => 'd43f55c4-b90a-4a98-bf2d-0b765d2fe138',
            'Accept'        => 'application/json',
        ];

        $this->client = new Client([


            //'base_uri' => 'http://apidev.sipgoerp.com', // development
            'base_uri' => 'https://api.sipgoerp.com/v1', // production
    
            'connect_timeout' => 5,
            'read_timeout' => 10,
            'timeout' => 10,
            'handler' => $this->handlerStack,
            'exceptions' => false,
        ]);


    }

 
    public function get($url, $params){

        $response = $this->client->request('GET', $url . '?' . http_build_query($params), [  'headers' => $this->headers ]);

        return  json_decode($response->getBody()->getContents());
    }


    public function retryDecider()
    {
        return function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            // Limit the number of retries to 5
            if ($retries >= 5) {
                return false;
            }

            // Retry connection exceptions
            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                // Retry on server errors
                if ($response->getStatusCode() >= 500 ) {
                    return true;
                }
            }

            return false;
        };
    }


    public function retryDelay()
    {
        return function ($numberOfRetries) {
            return 1000 * $numberOfRetries;
        };
    }




}
