<?php

namespace Application\Controllers;

use Application\Model\Category as CategoryModel;

class Category extends Controller
{
    public function index(): void
    {
        $categories = (new CategoryModel())->all();
        $this->view('panel.category.index', compact('categories'));
    }

    public function create(): void
    {
        $this->view('panel.category.create');
    }

    public function store(): void
    {
        $input = $this->validateInput($_POST);

        if (!empty($input['errors'])) {
            $this->view('panel.category.create', [
                'errors' => $input['errors'],
                'old' => $_POST
            ]);
            return;
        }

        (new CategoryModel())->insert([
            'name' => $input['name'],
            'description' => $input['description']
        ]);

        $this->redirect('category');
    }

    public function show(): void
    {
        $this->view('panel.category.show');
    }

    public function edit($id): void
    {
        $category = (new CategoryModel())->find($id);

        if (!$category) {
            $this->redirect('category');
        }

        $this->view('panel.category.edit', compact('category'));
    }

    public function update($id): void
    {
        $category = (new CategoryModel())->find($id);
        if (!$category) {
            $this->redirect('category');
        }

        $input = $this->validateInput($_POST);

        if (!empty($input['errors'])) {
            $this->view('panel.category.edit', [
                'category' => $category,
                'errors' => $input['errors'],
                'old' => $_POST
            ]);
            return;
        }

        (new CategoryModel())->update($id, [
            'name' => $input['name'],
            'description' => $input['description']
        ]);

        $this->redirect('category');
    }

    public function destroy($id): void
    {
        (new CategoryModel())->delete($id);
        $this->back();
    }

    /**
     * اعتبارسنجی و پاک‌سازی ورودی‌های فرم دسته‌بندی
     */
    private function validateInput(array $data): array
    {
        $name = trim($data['name'] ?? '');
        $description = trim($data['description'] ?? '');
        $errors = [];

        if (empty($name)) {
            $errors[] = 'نام دسته‌بندی الزامی است.';
        }

        if (empty($description)) {
            $errors[] = 'توضیحات دسته‌بندی نمی‌تواند خالی باشد.';
        }

        return [
            'name' => $name,
            'description' => $description,
            'errors' => $errors
        ];
    }
}