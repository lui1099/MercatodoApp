<?php

namespace App\Services;

use App\Request\CreateSessionRequest;
use App\Request\GetInformationRequest;
use GuzzleHttp\Client;
use function PHPUnit\Framework\isFalse;

class WebcheckoutService implements \App\Contracts\WebcheckoutContract
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getInformation(?int $session_id)
    {
        $getInformation = new GetInformationRequest();
        $data = $getInformation->auth();
        $url = GetInformationRequest::url($session_id);
        return $this->request($data, $url);
    }

    public function createSession(array $data)
    {

        $createSessionRequest = new CreateSessionRequest($data);

        $data = $createSessionRequest->toArray();

        $url = $createSessionRequest::url(null);


        return $this->request($data, $url);
    }

    private function request(array $data, string $url)
    {

        $response = $this->client->request('post',$url,[
            'json' => $data,
            'verify' => false
        ]);

        $content = $response->getBody()->getContents();
        return json_decode($content, true);

    }


}
