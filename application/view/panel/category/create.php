<?php $this->include("panel.layouts.header"); ?>

<?php if (!empty($errors ?? [])): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo $this->url('category/store'); ?>" method="post">
    <section class="form-group">
        <label for="name">Name</label>
        <input type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                placeholder="name ..." 
                value="<?php echo htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </section>

    <section class="form-group">
        <label for="description">Description</label>
        <input type="text" 
                class="form-control" 
                id="description" 
                name="description" 
                placeholder="description ..." 
                value="<?php echo htmlspecialchars($old['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    </section>

    <button type="submit" class="btn btn-primary">Create</button>
</form>

<?php $this->include("panel.layouts.footer"); ?>