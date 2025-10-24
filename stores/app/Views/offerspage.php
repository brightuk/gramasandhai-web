<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>

<?= $this->section('index') ?>

<div class="offers-container my-5">
    <h2 class="mb-4 fw-bold text-primary">Current Offers & Deals</h2>

    <div class="row g-4">
        <?php if (!empty($offers)): ?>
        <?php foreach ($offers as $key => $offer): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card offer-card h-100 border-0 shadow-sm">
                <div class="badge bg-danger position-absolute m-2"><?= esc($offer['label']) ?></div>
                <a href="<?= $shop_url . '/offers/'.$offer['code']  ?>" class="text-decoration-none">

                    <img src="<?= $img_url.$offer['image'] ?>" class="card-img-top" alt="Offer Image">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold"><?= esc($offer['name']) ?></h5>
                        <p class="card-text text-muted"><?= esc($offer['offer_notes']) ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if($offer['type'] == '1' || $offer['type'] == '5') :?>
                            <span class="text-success fw-bold">₹<?= esc($offer['disc_price']) ?> <small
                                    class="text-decoration-line-through text-muted">₹<?= esc($offer['org_price']) ?></small>
                            </span>
                            <?php endif; ?>
                            <a href="<?= $shop_url . '/offers/'.$offer['code'] ?>" class="btn btn-sm btn-outline-primary">View
                                Details</a>
                        </div>
                    </div>
                </a>

                <div class="card-footer bg-transparent border-top-0">
                    <small class="text-muted">Valid until <?=  esc($offer['endoffer']) ?></small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p>No offers found.</p>
        <?php endif; ?>


        <!-- Offer Card 3 -->
        <!-- <div class="col-md-6 col-lg-4">
            <div class="card offer-card h-100 border-0 shadow-sm">
                <div class="badge bg-info position-absolute m-2">Popular</div>
                <a href="<?= $url . 'offers/SM4532' ?>" class="text-decoration-none">

                    <img src="<?= base_url('public/') ?>images/special-offer.jpg" class="card-img-top"
                        alt="Offer Image">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Flash Sale - 50% Off</h5>
                        <p class="card-text text-muted">Limited time flash sale with massive discounts on selected
                            items.
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold">$29.99 <small
                                    class="text-decoration-line-through text-muted">$59.99</small></span>
                            <a href="<?= $url . 'offers/AEDSW' ?>" class="btn btn-sm btn-outline-primary">View
                                Details</a>

                        </div>
                    </div>
                </a>
                <div class="card-footer bg-transparent border-top-0">
                    <small class="text-muted">Ends in 12:34:56</small>
                </div>
            </div>


        </div> -->
    </div>

    <!-- View All Button -->
    <!-- <div class="text-center mt-4 viewall ">
        <button class="btn btn-primary px-4">
            <i class="bi bi-tags-fill me-2"></i>View All Offers
        </button>
    </div> -->
</div>



<style>

.nutras-footer{
    display: none !important;
}
.offer-card {
    transition: all 0.3s ease;
    border-radius: 0.75rem;
    overflow: hidden;
}

.offer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
}

.offer-card .badge {
    z-index: 1;
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

.offer-card img {
    transition: transform 0.5s ease;
}

.offer-card:hover img {
    transform: scale(1.05);
}
</style>

<?= $this->endSection() ?>