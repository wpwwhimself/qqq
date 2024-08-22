<?php

use Illuminate\Support\Str;

function asPln(?float $value): string
{
    return ($value)
        ? number_format($value, 2, ",", " ") . " zł"
        : $value;
}