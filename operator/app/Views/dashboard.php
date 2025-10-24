<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title>Dashboard</title>

<h3 class="text-center">Welcome to Shop</h3>

<a href="<?= base_url('shop/management') ?>"  class="btn btn-primary"> Shops</a>

<?= $this->endSection() ?>
