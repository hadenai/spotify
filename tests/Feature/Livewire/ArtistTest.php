<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Artist;
use Livewire\Livewire;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Artist::class)
            ->assertStatus(200);
    }

    /** @test */
    public function component_exists_on_the_page()
    {
        $this->get('/')
            ->assertSeeLivewire(Artist::class);
    }
    /** @test */
    public function can_set_artist_name()
    {
        Livewire::test(Artist::class)
            ->set('artist_name', 'toto')
            ->assertSet('artist_name', 'toto');
    }
    /** @test */
    public function display_artist()
    {
        Livewire::test(Artist::class)
        ->assertSet('showArtist', false);

        Livewire::test(Artist::class)
            ->set('artist_name', 'BearMcCreary')
            ->set('artist_id', '2ifvIECHAlEgPMBuBOJ0lG?si=PWUj15dIRIG8iCirvo_2Pw')
            ->call('submit')
            ->assertSet('showArtist', true);
    }



}

