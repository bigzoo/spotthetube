<?php

namespace App\Music;

use Illuminate\Support\Collection;

class Track
{

    public $name;
    public $preview;
    public $artists;

    public function __construct(string $name, ?string $preview, ?Collection $artists)
    {
        $this->name = $name;
        $this->preview = $preview;
        $this->artists = $artists;
    }
}