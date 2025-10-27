<?php $this->include("panel.layouts.header"); ?>

<section class="mb-2 d-flex justify-content-between align-items-center">
    <h2 class="h4">Articles</h2>
    <a href="<?php echo $this->url('article/create'); ?>" class="btn btn-sm btn-success">Create</a>
</section>

<section class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Cat ID</th>
            <th>Body</th>
            <th>Setting</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($articles)) { ?>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><?php echo $article['id']; ?></td>
                    <td><?php echo $article['title']; ?></td>
                    <td><?php echo $article['cat_id']; ?></td>
                    <td><?php echo substr($article['body'], 0, 40) . "...."; ?></td>
                    <td>
                        <a href="<?php echo $this->url('article/edit/' . htmlspecialchars($article['id'])); ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="<?php echo $this->url('article/destroy/' . htmlspecialchars($article['id'])); ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="5">No articles found.</td></tr>
        <?php } ?>
        </tbody>
    </table>
</section>

<?php $this->include("panel.layouts.footer"); ?>
