<?php 
namespace Application\Controllers;

use Application\Model\Category;
use Application\Model\Article;

class Home extends Controller
{
    public function index(): void
    {
        $categories = (new Category())->all();
        $articles = (new Article())->all();

        $this->view('app.index', compact('categories', 'articles'));
    }

    public function category($id): void
    {
        $categoryModel = new Category();

        $categories = $categoryModel->all();
        $category = $categoryModel->find($id);
        $articles = $categoryModel->articles($id);

        $this->view('app.index', compact('categories', 'articles', 'category'));
    }

    public function show($id): void
    {
        $categories = (new Category())->all();
        $article = (new Article())->find($id);

        $this->view('app.index', compact('categories', 'article'));
    }
}
