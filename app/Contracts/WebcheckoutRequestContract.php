<?php

namespace App\Contracts;

interface WebcheckoutRequestContract
{
    public static function url(?int $session_id): string;

}
