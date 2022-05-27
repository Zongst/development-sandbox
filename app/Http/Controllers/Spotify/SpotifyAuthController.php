<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyAuthController extends Controller
{

    public function redirect(Request $request)
    {
        $options = [
            'auto_refresh' => true,
            'scope' => [
                'user-read-email',
                'playlist-read-collaborative'
            ],
        ];
        $authUrl = $this->session->getAuthorizeUrl($options);
        return Inertia::location($authUrl);
    }

    public function callback(Request $request)
    {
        if($request->has('code')){
            $this->session->requestAccessToken($request->input('code'));
            $this->api->setSession($this->session);

            $newAccessToken = $this->session->getAccessToken();
            $newRefreshToken = $this->session->getRefreshToken();
            $request->session()->put('access_token', $newAccessToken);
            $request->session()->put('refresh_token', $newRefreshToken);
            return Redirect::route('spotify.dashboard');
        }

    }

    public function revoke(Request $request)
    {
        if($request->session()->has('access_token') && $request->session()->get('refresh_token')){
            $request->session()->remove('access_token');
            $request->session()->remove('refresh_token');
            return Redirect::route('spotify.dashboard');
        }
    }
}
