<div class="container">
    <div class="row">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <p> <?php $blog ?></p>
                <div class="col-12 col-md-6 col-lg-4 pr-0" style="padding-right: 0 !important;">
                    <div class="blog-card mt-4_5">
                        <figure class="overflow-hidden aspect-ratio-4_3 w-100">
                            <a href="<?= base_url('blogs/' . $blog->blog_id); ?>" class="d-inline">
                                <img src="<?= base_url('upload/blogs/' . $blog->image); ?>" class="w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?>">
                            </a>
                        </figure>
                        <h4 class="component-header">
                            <a href="<?= base_url('blogs/' . $blog->blog_id); ?>" class="link-header">
                                <?= htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h4>
                        <p>
                            <?php
                            $content = htmlspecialchars($blog->content, ENT_QUOTES, 'UTF-8');
                            echo (strlen($content) > 255) ? substr($content, 0, 255) . '...' : $content;
                            ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">No blogs available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>