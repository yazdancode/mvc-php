<?php

namespace Application\Controllers;

use Application\Model\Article as ArticleModel;
use Application\Model\Category;

class Article extends Controller
{
    public function index(): void
    {
        $articles = (new ArticleModel())->all();
        $this->view('panel.article.index', compact('articles'));
    }

    public function create(): void
    {
        $categories = (new Category())->all();
        $this->view('panel.article.create', compact('categories'));
    }

    public function store(): void
    {
        $title = trim($_POST['title'] ?? '');
        $cat_id = trim($_POST['cat_id'] ?? '');
        $body = trim($_POST['body'] ?? '');

        $errors = $this->validate($title, $cat_id, $body);

        if (!empty($errors)) {
            $categories = (new Category())->all();
            $this->view('panel.article.create', [
                'categories' => $categories,
                'errors' => $errors,
                'old' => $_POST
            ]);
            return;
        }

        (new ArticleModel())->insert([
            'title' => $title,
            'cat_id' => (int)$cat_id,
            'body' => $body
        ]);

        $this->redirect('article');
    }

    public function edit($id): void
    {
        $categories = (new Category())->all();
        $article = (new ArticleModel())->find($id);

        if (!$article) {
            $this->redirect('article');
        }

        $this->view('panel.article.edit', compact('categories', 'article'));
    }

    public function update($id): void
    {
        $title = trim($_POST['title'] ?? '');
        $cat_id = trim($_POST['cat_id'] ?? '');
        $body = trim($_POST['body'] ?? '');

        $errors = $this->validate($title, $cat_id, $body);

        if (!empty($errors)) {
            $categories = (new Category())->all();
            $article = (new ArticleModel())->find($id);
            $this->view('panel.article.edit', [
                'categories' => $categories,
                'article' => $article,
                'errors' => $errors,
                'old' => $_POST
            ]);
            return;
        }

        (new ArticleModel())->update($id, [
            'title' => $title,
            'cat_id' => (int)$cat_id,
            'body' => $body
        ]);

        $this->redirect('article');
    }

    public function destroy($id): void
    {
        (new ArticleModel())->delete($id);
        $this->back();
    }

    private function validate(string $title, string $cat_id, string $body): array
    {
        $errors = [];

        if (empty($title)) {
            $errors[] = 'عنوان مقاله الزامی است.';
        }

        if (empty($cat_id) || !is_numeric($cat_id)) {
            $errors[] = 'لطفاً یک دسته‌بندی معتبر انتخاب کنید.';
        }

        if (empty($body)) {
            $errors[] = 'متن مقاله نمی‌تواند خالی باشد.';
        }

        return $errors;
    }
}
