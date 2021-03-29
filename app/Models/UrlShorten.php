<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShorten extends Model
{
    protected $fillable = ['user_id', 'full_url', 'shorten_url', 'custom_name'];
}
