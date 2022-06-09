<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TinkoffController extends Controller
{
    public function getAccounts()
    {
        $token = 't.uwhyBs4jk9qs6JqOdUaxTiH7Sv6CmBi24HsOSZrjxyb0FrzXZOk4sX3YJGi6aCwjZ74gce_gzb6AEM2wL097iw';
        $test = Http::withToken($token)->get('https://api-invest.tinkoff.ru/openapi/');
        var_dump($test);
    }
}
