<?php

namespace App\Helper;


class StringHelper
{
    public function explodeByNewLine(string $string): array
    {
        return preg_split('/\r\n|\r|\n/', $string);
    }
}