<?php

namespace Application\Controllers;

class Panel extends Controller
{
    public function index(): void
    {
        $this->view('panel.index');
    }

}