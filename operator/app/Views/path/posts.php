<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title>Posts List</title>

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

<link rel="stylesheet" href="<?= base_url() ?>public/assets/css/demo.css" />

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Posts</h4>
                <a href="<?= base_url() ?>posts/add" class="btn btn-primary btn-round ms-auto">
                    Add Post
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 4%">#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($posts) && !empty($posts)): ?>
                            <?php foreach ($posts as $key => $post): ?>
                                <tr>
                                    <td><?= esc($key + 1) ?></td>
                                    <td><?= esc($post['title']) ?></td>
                                    <td><?= esc($post['content']) ?></td>
                                    <td>
                                        <?php if (!empty($post['url'])): ?>
                                            <a href="<?= esc($post['url']) ?>" target="_blank" class="text-primary">
                                                <?= esc($post['url']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">No URL</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge <?= $post['status'] == '1' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $post['status'] == '1' ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="<?= base_url('send/post/') . $post['id'] ?>" 
                                               class="btn btn-link btn-primary btn-lg"
                                               title="Send">
                                                 <i class="bi bi-send-fill fs-4"></i>
                                            </a>
                                            <!-- <a href="<?= base_url() ?>pt/toggle/<?= $post['id'] ?>" 
                                               class="btn btn-link btn-lg"
                                               title="<?= $post['status'] == '1' ? 'Deactivate' : 'Activate' ?>">
                                                <i class="bi <?= $post['status'] == '1' ? 'bi-toggle-on text-success' : 'bi-toggle2-off text-danger' ?> fs-4"></i>
                                            </a> -->
                                            <!-- <a href="<?= base_url() ?>pt/delete/<?= $post['id'] ?>" 
                                               class="btn btn-link btn-danger btn-lg"
                                               title="Delete"
                                               onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fa fa-trash"></i>
                                            </a> -->
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No posts found. <a href="<?= base_url() ?>pt/add" class="text-primary">Add your first post</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="<?= base_url() ?>public/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Initialize DataTable -->
<script>
$(document).ready(function() {
    $('#add-row').DataTable({
        "pageLength": 10,
        "ordering": true,
        "searching": true,
        "responsive": true
    });
});
</script>

<?= $this->endSection() ?>