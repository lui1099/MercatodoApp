<?php

namespace App\Request;

use App\Contracts\WebcheckoutRequestContract;
use Illuminate\Support\Str;

class GetInformationRequest implements WebcheckoutRequestContract
{
    public function auth()
    {
        $seed = date('c');
        $nonce = Str::random(8);
//        $tranqui = '024h1IlD';
//        $login = '6dd490faf9cb87a9862245da41170ff2';
        $tranKey = base64_encode(hash('sha1', $nonce.$seed.config('webcheckout.tranKey'), true));



        return [
            'auth' => [
                'login' => /*$login*/config('webcheckout.login'),
                'tranKey' => $tranKey,
                'nonce' => base64_encode($nonce),
                'seed' => $seed,
            ]

        ];
    }

    public static function url(?int $session_id): string
    {
        return config('webcheckout.url')/*'api/session/''https://dev.placetopay.com/redirection/api/session/'*/.$session_id;
    }
}
