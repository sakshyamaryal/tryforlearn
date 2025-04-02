<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center"><?= htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?></h2>
            <figure>
              <img src="<?= base_url('uploads/blogs/' . $blog->image); ?>" class="img-fluid" alt="<?= htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?>">
            </figure>
            <p class="mt-3"><?= nl2br(htmlspecialchars($blog->content, ENT_QUOTES, 'UTF-8')); ?></p>
            <a href="<?= base_url('blogs'); ?>" class="btn btn-primary">Back to Blogs</a>
        </div>
    </div>
</div>
