<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SpotifyApi
{
    private $apiToken;

    private $apiSecret;

    private $apiUrl;

    private $bearer;

    public function __construct()
    {
        $this->apiToken = env('CLIENT_ID');
        $this->apiSecret = env('CLIENT_SECRET');
        $this->apiUrl = env('API_URL');
    }

    /**
     * @throws ConnectionException
     */

    public function searchArtistId($first_name)
    {
        $this->setupBearerAuthorization();
        $request = $this->getRequest();

        return $request->get("{$this->apiUrl}/search?q=remaster%25artist%25{$first_name}%26type%3Dartist%E2%80%99+%5C&type=artist&limit=1");
    }

    public function getArtistInfo($artist_id)
    {
        $this->setupBearerAuthorization();
        $request = $this->getRequest();

        return $request->get("{$this->apiUrl}/artists?ids={$artist_id}");
    }

    public function getSimilarArtist($artist_id)
    {
        $this->setupBearerAuthorization();
        $request = $this->getRequest();

        return $request->get("{$this->apiUrl}/artists/{$artist_id}/related-artists");
    }

    /**
     * @throws ConnectionException
     */
    private function setupBearerAuthorization(): void
    {
        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->apiToken,
            'client_secret' => $this->apiSecret,
        ]);
        $bearer = $response->json();
        $this->bearer = $bearer['access_token'];
    }

    private function getRequest()
    {
        return Http::withToken($this->bearer)->baseUrl($this->apiUrl);
    }
}
