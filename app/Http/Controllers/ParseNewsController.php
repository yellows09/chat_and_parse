<?php

namespace App\Http\Controllers;

use App\Jobs\ParseNews;
use App\Models\User;
use App\Services\XMLParse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ParseNewsController extends Controller
{
    public function ParseNews(XMLParse $parseService){
        dd(User::find(1)->get());
        Gate::authorize('start-parse');
        $links = [
            'https://lenta.ru/rss/news',
            'https://news.yandex.ru/auto.rss',
        ];
        $start = microtime(true);

        foreach ($links as $link){
            ParseNews::dispatch($link);
        }
        $end = microtime(true);
        $count = \App\Models\parseNews::count();
        dump($count);
        dump($end-$start);
        return response()->json('Successfully parsed',200);
    }
}
