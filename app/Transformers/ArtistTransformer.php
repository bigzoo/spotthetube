<?php

namespace App\Transformers;


use App\Music\Artist;
use League\Fractal\TransformerAbstract;

class ArtistTransformer extends TransformerAbstract
{
    public function transform(Artist $artist)
    {
        return [
            'name' => $artist->name
        ];
    }
}