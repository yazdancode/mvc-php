<?php 
namespace Application\Controllers;

class Home extends Controller
{
    public function index(): void
    {
        $this->view('app.index');
    }

    public function create(): void
    {
        $this->view('app.create');
    }

}