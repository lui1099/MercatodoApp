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
//        $a = env('WEBCHECKOUT_URL');
//        dd($a);
//        dd(config('webcheckout.url'));
        $createSessionRequest = new CreateSessionRequest($data);
//        dd($createSessionRequest);
        $data = $createSessionRequest->toArray();
        if (!array_key_exists('locale', $data))
            $data['locale'] = 'es_CO';
        if (!array_key_exists('ipAdress', $data))
            $data['ipAddress'] = '127.0.0.1';
        if (!array_key_exists('userAgent', $data))
            $data['userAgent'] = 'Symphony';


//        dd($data);

        $url = $createSessionRequest::url(null);
//        dd($url);
        return $this->request($data, $url);
    }

    private function request(array $data, string $url)
    {
//        dd($data);
        $response = $this->client->request('post',$url,[
            'json' => $data,
            'verify' => false
        ]);
//        dd($response);
        $content = $response->getBody()->getContents();
        return json_decode($content, true);

    }

    public function getCreateSessionData(): array
    {
        return  [
            'payment' => [
                'reference' => 'TEST_OVER_9000',
                'description' => 'Compra en Mercatodo App',
                'amount' => [
                    'currency' => 'COP',
                    'total' => '15000'
                ],
            ],
            'returnUrl' => route('home'),
            'expiration' => date('c', strtotime('+1 hour')),

        ];
    }
}
