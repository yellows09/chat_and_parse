<?php
namespace App\Services;

use App\Models\parseNews;
use Orchestra\Parser\Xml\Facade as XmlParser;
class XMLParse {
    public function getNews($link)
    {
        $xml = XmlParser::load($link);
        $news = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'news' => ['uses' => 'channel.item[title,link,description,pubDate,enclosure::url,category]'],
        ]);
        foreach ($news['news'] as $data) {
            if(!$data['category']) {
                $categoryName = $news['title'];
            }else {
                $categoryName = $data['category'];
            }
            parseNews::query()->firstOrCreate([
                'title' => $data['title'],
                'link' => $data['link'],
                'description' => $data['description'],
                'image' => $data['enclosure::url'],
                'pubDate' => $data['pubDate'],
                'category' => $categoryName,
            ]);
        }
    }
}
