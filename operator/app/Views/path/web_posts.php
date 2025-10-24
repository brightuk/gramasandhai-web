<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
<div class="flash-popup success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="flash-popup error">
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="d-flex justify-content-between card-header bg-primary text-white">
                    <h3 class="mb-0">Create New Post</h3>
                    <a href="<?= base_url('post-resend') ?>" class="btn btn-outline-secondary bg-white text-primary">
                        <i class="bi bi-send-fill"></i> Last Posts Resend
                    </a>
                </div>
                <div class="card-body">

                    <form action="<?= base_url('posts/add') ?>" method="post" id="postForm"
                        enctype="multipart/form-data">

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control <?= isset(session('errors')['title']) ? 'is-invalid' : '' ?>"
                                id="title" name="title" placeholder="Enter post title" value="<?= old('title') ?>"
                                required maxlength="255">
                            <?php if (isset(session('errors')['title'])): ?>
                            <div class="invalid-feedback"><?= session('errors')['title'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea
                                class="form-control <?= isset(session('errors')['content']) ? 'is-invalid' : '' ?>"
                                id="content" name="content" rows="3" placeholder="Enter post content"
                                required><?= old('content') ?></textarea>
                            <?php if (isset(session('errors')['content'])): ?>
                            <div class="invalid-feedback"><?= session('errors')['content'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- URL -->
                        <div class="mb-3">
                            <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="url" name="url"
                                placeholder="Enter post URL (e.g. https://example.com)" value="https://gramasandhai.in" required>
                        </div>


                        <!-- Images -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Images <span class="text-danger">*</span></label>
                            <input type="file"
                                class="form-control <?= isset(session('errors')['image']) ? 'is-invalid' : '' ?>"
                                id="image" name="image" >
                       
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Submit Post
                            </button>
                            <a href="<?= base_url('posts') ?>" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>