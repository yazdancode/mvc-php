<?php

namespace Application\Controllers;
use Application\Model\Category as CategoryModel;
use JetBrains\PhpStorm\NoReturn;

class Category extends Controller
{
    public function index():void
    {
        $category = new CategoryModel();
        $categories = $category->all();
        $this->view('panel.category.index', compact('categories'));
    }
 
    public function create(): void
    {
        $this->view('panel.category.create');
    }

    #[NoReturn]
    public function store(): void
    {
        $category = new CategoryModel();
        $category->insert($_POST);
        $this->redirect('category');
    }

    public function show(): void
    {
        $this->view('panel.category.show');

    }

    public function edit($id):void
    {
        $ob_category = new CategoryModel();
        $category = $ob_category->find($id);
        $this->view('panel.category.edit', compact('category'));
    }

    #[NoReturn]
    public function update($id):void
    {
        $category = new CategoryModel();
        $category->update($id, $_POST);
        $this->redirect('category');

    }

    public function destroy($id):void
    {
        $category = new CategoryModel();
        $category->delete($id);
        $this->back();

    }
    
}