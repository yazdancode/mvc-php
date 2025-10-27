<?php
namespace Application\Controllers;

use Application\Model\Article as ArticleModel;
use Application\Model\Category;
use JetBrains\PhpStorm\NoReturn;

class Article extends Controller
{
    public function index(): void
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->all();
        $this->view('panel.article.index', compact('articles'));
    }

    public function create(): void
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();
        $this->view('panel.article.create', compact('categories'));
    }

    #[NoReturn]
    public function store(): void
    {
        $articleModel = new ArticleModel();
        $articleModel->insert($_POST);
        $this->redirect('article');
    }

    public function edit($id): void
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        $this->view('panel.article.edit', compact('categories', 'article'));
    }

    #[NoReturn]
    public function update($id): void
    {
        $articleModel = new ArticleModel();
        $articleModel->update($id, $_POST);
        $this->redirect('article');
    }

    public function destroy($id): void
    {
        $articleModel = new ArticleModel();
        $articleModel->delete($id);
        $this->back();
    }
}
