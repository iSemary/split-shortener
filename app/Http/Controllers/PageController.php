<?php

namespace App\Http\Controllers;

use App\Models\UrlShorten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $visits = UrlShorten::orderBy('visits', 'desc')->take(10)->get();
        return view('welcome', compact('visits'));
    }

    public function view($path)
    {
        $Shorten = UrlShorten::where('shorten_url', $path)->orWhere('custom_name', $path)->first();

        $Shorten ? $url = $Shorten->full_url : $url = null;
        $Shorten ? $Shorten->increment('visits', 1) : null;
        // method #1
        return view('redirection', compact('url'));
        // method #2
    }
    public function not_found(){
        return view('404');
    }
}
