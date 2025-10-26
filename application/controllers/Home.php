<?php 
namespace Application\Controllers;

class Home extends Controller
{
    public function category($id): void
    {
        $this->view('app.category');
    }

    public function show($id): void
    {
        $this->view('app.detail');
    }

    public function index():void
    {
        $this->view('app.index');
    }
}