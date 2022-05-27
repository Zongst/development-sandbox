<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIException;

class SpotifyDashboardController extends Controller
{

    public function dashboard(Request $request): \Inertia\Response
    {
        $offset = $request->input('offset') ?? 0;
        $connected = false;
        $errorCaught = false;
        $userInfo = null;
        $playlists = null;
        if($request->session()->has('access_token') && $request->session()->get('refresh_token')){
            $this->session->setAccessToken($request->session()->get('access_token'));
            $this->api->setSession($this->session);
            try {
                $userInfo = $this->api->me();
            } catch (SpotifyWebAPIException $e) {
                if ($e->hasExpiredToken()) {
                    $this->session->refreshAccessToken($request->session()->get('refresh_token'));
                    $this->api->setSession($this->session);
                    try {
                        $userInfo = $this->api->me();
                    } catch (SpotifyWebAPIException $e) {
                        $errorCaught = true;

                    }

                }else{
                    $errorCaught = true;
                }
            }
            if(!$errorCaught){

                $playlists = $this->api->getUserPlaylists($userInfo->id, [
                    'limit' => 5,
                    'offset' => $offset
                ]);
                $connected = true;


            }
        }
        return Inertia::render('Spotify/Dashboard',[
            'connected' => $connected,
            'userInfo' => $userInfo,
            'playlists' => $playlists,
            'offset' => (int)$offset,
        ]);

    }
}
