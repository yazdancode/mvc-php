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

<form action="<?php $this->url('article/store'); ?>" method="post">
    <section class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title"
                value="<?php echo htmlspecialchars($old['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                placeholder="title ...">
    </section>

    <section class="form-group">
        <label for="cat_id">Category</label>
        <select class="form-control" id="cat_id" name="cat_id">
            <option value="">-- انتخاب دسته‌بندی --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo (int)$category['id']; ?>" 
                    <?php echo (isset($old['cat_id']) && $old['cat_id'] == $category['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </section>

    <section class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" id="body" name="body" rows="5" placeholder="body ..."><?php
            echo htmlspecialchars($old['body'] ?? '', ENT_QUOTES, 'UTF-8');
        ?></textarea>
    </section>

    <button type="submit" class="btn btn-primary">Create</button>
</form>

<?php $this->include("panel.layouts.footer"); ?>