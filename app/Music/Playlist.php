<?php

namespace App\Music;

class Playlist
{
    public $link;
    public $name;
    public $description;

    public function __construct(string $link, string $name, string $description)
    {
        $this->link = $link;
        $this->name = $name;
        $this->description = $description;
    }
}