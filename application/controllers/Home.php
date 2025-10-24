<?php 
namespace Application\Controllers;

class Home extends Controller
{
    public function index(): void
    {
        $productname = "phone";
        $this->view('app.index', compact('productname'));
    }

    public function create(): void
    {
        $this->view('app.create');
    }

}