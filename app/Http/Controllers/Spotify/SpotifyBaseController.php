<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyBaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public Session $session;
    public SpotifyWebAPI $api;
    public function __construct()
    {
        $this->session = new Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect_url'),
        );
        $this->api = $api = new SpotifyWebAPI();

    }
}
