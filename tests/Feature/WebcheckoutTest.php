<?php

namespace Tests\Feature;

use App\Request\CreateSessionRequest;
use App\Request\GetInformationRequest;
use App\Services\WebcheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class WebcheckoutTest extends TestCase
{

    public function testItCanGetInformationRequest()
    {
        $request = (new GetInformationRequest()) -> auth();
//        dd($request);
        $this->assertArrayHasKey('auth', $request);
        $this->assertArrayHasKey('login', $request['auth']);
        $this->assertArrayHasKey('tranKey', $request['auth']);
        $this->assertArrayHasKey('nonce', $request['auth']);
        $this->assertArrayHasKey('seed', $request['auth']);
    }

    public function testItCanGetCreateSessionRequest()
    {
        $data = $this->getCreateSessionData();
        $request = ((new CreateSessionRequest($data)))->toArray();
        dd($request);
    }

    public function testItCanCreateSessionFromService()
    {
        $this->withoutExceptionHandling();

       $data = $this->getCreateSessionData();
       $data = ((new CreateSessionRequest($data)))->toArray();
//       dd($data);
       $response = (new WebcheckoutService())->createSession($data);
       dd($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('OK', $response['status']['status']);
        $this->assertArrayHasKey('requestId', $response);
        $this->assertArrayHasKey('processUrl', $response);



    }

    /**
     * @return void
     */
    public function getCreateSessionData(): array
    {
        return  [
            'payment' => [
                'reference' => 'TEST_OVER_9000',
                'description' => 'prueba de conexion webCO',
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
