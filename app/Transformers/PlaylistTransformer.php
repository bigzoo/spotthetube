<?php

namespace App\Transformers;

use App\Music\Playlist;
use League\Fractal\TransformerAbstract;

class PlaylistTransformer extends TransformerAbstract
{
    public function transform(Playlist $playlist)
    {
        return [
            'link' => $playlist->link,
            'name' => $playlist->name,
            'description' => $playlist->description
        ];
    }
}