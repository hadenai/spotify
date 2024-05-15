<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Services\SpotifyApi;
use Illuminate\Http\Client\ConnectionException;
use Livewire\Component;

#[AllowDynamicProperties] class Artist extends Component
{
    public $showArtist = false;

    public $artist_name = '';

    public $artist_id = '';

    public $artists = [];

    /**
     * @throws ConnectionException
     */
    public function submit(): void
    {
        $spotifyApi = new SpotifyApi();
        $artist_id_json = $spotifyApi->searchArtistId($this->artist_name);
        $data_artist_id = json_decode($artist_id_json, true);
        $artist_id = $data_artist_id['artists']['items'][0]['id'];
        $this->artist_id = $artist_id;
        $this->showSimilarArtist();
    }

    public function showSimilarArtist(): void
    {
        $this->showArtist = true;
        $spotifyApi = new SpotifyApi();
        $similar_artist = $spotifyApi->getSimilarArtist($this->artist_id);
        $data = json_decode($similar_artist, true);
        $this->artists = $data['artists'];
    }
    //BearMcCreary

    public function render()
    {
        return view('livewire.artist', [
            'artists' => $this->artists,
        ]);
    }
}
