<?php

namespace App\Music;

class Image
{

    public $src;

    public function __construct(string $src)
    {
        $this->src = $src;
    }
}