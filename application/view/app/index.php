<?php $this->include("app.layouts.header", ['categories'=> $categories]); ?>
    <section class="container my-5">
        <div class="row">
            <?php foreach ($articles as $article): ?>
                <div class="col-md-4 mb-4">
                    <h2><?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= htmlspecialchars(substr($article['body'], 0, 120), ENT_QUOTES, 'UTF-8') ?>...</p>
                    <p>
                        <a class="btn btn-primary"
                           href="<?= $this->url('home/show/' . (int)$article['id']) ?>"
                           role="button">
                            View details »
                        </a>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php $this->include("app.layouts.footer"); ?>