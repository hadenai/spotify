<div>
    <div class="d-flex justify-content-center">
        <nav class="navbar bg-dark border-bottom border-body justify-content-center" data-bs-theme="dark">
            <div class="container-fluid">
                <form class="d-flex">
                    <input class="form-control me-2" wire:model="artist_name" type="text" placeholder="Artist Name">
                    <button class="btn btn-outline-success" wire:click="submit" type="button">Search</button>
                </form>
            </div>
        </nav>
    </div>

    @if($showArtist)
        <div class="container-fluid bg-dark">
         <div class="container">
             <div class="row">
                 @foreach($artists as $artist)
                     <div class="col-md-4 p-4">
                         <div class="card bg-dark text-white shadow border border-success-subtle h-100">
                                 <img src="{{ $artist['images'][0]['url'] }}" class="card-img-top img-fluid" alt="{{ $artist['name'] }} ">
                             <div class="card-body d-flex flex-column">
                                 <h5 class="card-title">{{ $artist['name'] }}</h5>
                                 <p class="card-text flex-grow-1">Genres: {{$artist['genres'][0] }}</p>
                                 <a href="{{ $artist['external_urls']['spotify'] }}" class="btn btn-success">Visit Spotif)y</a>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </div>
    @endif
</div>
