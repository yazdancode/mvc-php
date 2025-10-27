<?php $this->include("panel.layouts.header"); ?>
<form action="<?php echo $this->url('category/update/' . $category['id']); ?>" method="post">
    <section class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="name ..." value="<?php echo htmlspecialchars($category['name']); ?>">
    </section>
    <section class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="description ..." value="<?php echo htmlspecialchars($category['description']); ?>">
    </section>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php $this->include("panel.layouts.footer"); ?>
