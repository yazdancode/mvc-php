<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVC</title>
    <link rel="stylesheet" href="<?php echo $this->asset('css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->asset('css/style.css'); ?>" media="all" type="text/css">
</head>
<body>
<section id="app">

    <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
        <a class="navbar-brand" href="<?php echo $this->url('panel'); ?>">MVC Tutorial</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->url('home'); ?>">Home</a>
                </li>
                <?php foreach ($categories as $category): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $this->url('home/category/' . $category['id']); ?>">
                            <?php echo !empty($category['name']) ? $category['name'] : 'بدون عنوان'; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
