<?php

namespace App\Http\Controllers;

use App\Models\UrlShorten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UrlShortenController extends Controller
{
    public function store(Request $request)
    {
//        $request->validate([
//            'full_url' => 'required|url|max:500|min:8',
//            'custom_name' => 'required|max:50|min:3',
//        ]);

        $Shortens = UrlShorten::where('full_url', $request->full_url)->first();
        if (!$Shortens) {
            $CustomName = $request->custom_name;
            // if user didn't add custom path
            $CustomName ? $ShortenURl = null : $ShortenURl = substr(sha1(time()), -7);

            $Shortens = UrlShorten::create([
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'full_url' => $request->full_url,
                'shorten_url' => $ShortenURl,
                'custom_name' => $request->custom_name
            ]);
        }
        $path = $Shortens->shorten_url ? $Shortens->shorten_url : $Shortens->custom_name;
        return Response::json(url('/') . '/' . $path);


    }
}
