<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpotifyAuthController extends Controller
{
    public function redirect(Request $request)
    {
        dd('hi');

    }

    public function callback(Request $request)
    {

    }
}
