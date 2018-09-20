<?php

namespace App\Transformers;


use App\Music\Track;
use League\Fractal\TransformerAbstract;

class TrackTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['artists'];
    public function transform(Track $track)
    {
        return [
            'name' => $track->name,
            'preview' => $track->preview
        ];
    }

    public function includeArtists(Track $track)
    {
        $this->collection($track->artists, ArtistTransformer::class);
    }
}