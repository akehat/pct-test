<?php

class GetName extends Controller
{
    public function index($number)
    {
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $value = $f->format($number);
        $value = str_replace('-', ' ', $value);
        $value = ucwords($value);
        echo $value;
    }
}
