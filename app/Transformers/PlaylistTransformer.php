<?php

namespace App\Transformers;

use App\Music\Playlist;
use League\Fractal\TransformerAbstract;

class PlaylistTransformer extends TransformerAbstract
{
//    protected $defaultIncludes = ['tracks'];
    public function transform(Playlist $playlist)
    {
        return [
            'link' => $playlist->link,
            'name' => $playlist->name,
            'description' => $playlist->description,
            'author' => $playlist->author,
            'length' => (int) $playlist->length,
            'image' => $playlist->image->src,
            'tracks' => $this->includeTracks($playlist)
        ];
    }

    public function includeTracks(Playlist $playlist)
    {
        return $playlist->tracks->toArray();
//        return $this->collection($playlist->tracks, TrackTransformer::class);
    }
}