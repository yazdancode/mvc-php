<?php
namespace Application\Controllers;
use Application\Model\Article as ArticleModel;
use Application\Model\Category;

class Article extends Controller
{
    public function index(): void
    {
        $article = new ArticleModel();
        $article = $article->all();
        $this->view('panel.article.index', compact('article'));
    }

    public function create(): void
    {
        $category = new Category();
        $categories = $category->all();
        $this->view('panel.article.create', compact('categories'));
    }

    public function store(): void
    {
        $this->view('', compact(''));
    }

    public function show($id): void
    {
        $this->view('', compact(''));

    }

    public function edit($id):void
    {
        $this->view('', compact(''));
    }

    public function update($id):void
    {
        $this->view('', compact(''));

    }

    public function destroy($id):void
    {
        $this->view('', compact(''));

    }
}