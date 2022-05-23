<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpotifyDashboardController extends Controller
{
    public function dashboard(Request $request): \Inertia\Response
    {
        return Inertia::render('Spotify/Dashboard');

    }
}
