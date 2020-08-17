<?php

namespace App\Music;

class Artist
{

    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}