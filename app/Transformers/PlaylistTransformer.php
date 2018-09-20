<?php

namespace App\Transformers;

use App\Music\Playlist;
use League\Fractal\TransformerAbstract;

class PlaylistTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['tracks'];
    public function transform(Playlist $playlist)
    {
        dd($this->includeTracks($playlist));
        return [
            'link' => $playlist->link,
            'name' => $playlist->name,
            'description' => $playlist->description,
            'author' => $playlist->author,
            'length' => $playlist->length,
            'image' => $playlist->image->src,
        ];
    }

    public function includeTracks(Playlist $playlist)
    {
        return $this->collection($playlist->tracks, TrackTransformer::class);
    }
}