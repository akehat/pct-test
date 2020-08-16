<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index($number = 0)
    {
        $data = [
            'title' => 'welcome',
            'number' => $number,
        ];
        $this->view('pages/index', $data);
    }
}
