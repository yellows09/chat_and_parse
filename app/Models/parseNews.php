<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parseNews extends Model
{
    use HasFactory;

    protected $table = 'parse_data';

    protected $fillable = ['title','link','description','image','pubDate','category'];
}
