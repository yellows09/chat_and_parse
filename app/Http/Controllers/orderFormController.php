<?php

namespace App\Http\Controllers;

use App\Services\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class orderFormController extends Controller
{
    public function sendOrder(Request $request, Telegram $telegram)
    {
        $telegram->send(1867965641, [$request->name, $request->email]);
    }

}
