<?php

namespace App\Transformers;


use App\Music\Track;
use League\Fractal\TransformerAbstract;

class TrackTransformer extends TransformerAbstract
{
    public function transform(Track $track)
    {
        dd('cow');
        return [
            'name' => $track->name,
            'preview' => $track->preview
        ];
    }
}