<?php

namespace App\Music;

use Illuminate\Support\Collection;

class Playlist
{
    public $link;
    public $name;
    public $description;
    public $author;
    public $length;
    public $image;
    public $tracks;

    public function __construct(string $link, string $name, ?string $description, ?string $author,
                                int $length, ?Image $image, ?Collection $tracks)
    {
        $this->link = $link;
        $this->name = $name;
        $this->description = $description;
        $this->author = $author;
        $this->length = $length;
        $this->image = $image;
        $this->tracks = $tracks;
    }
}