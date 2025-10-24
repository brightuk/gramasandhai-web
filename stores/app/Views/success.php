<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/page') ?>

<?= $this->section('index') ?>
<div class="container my-5 pt-5">
    <div class="alert alert-success">
        <h2 class="mb-4"><i class="bi bi-check-circle"></i> Order Placed Successfully!</h2>
        <h4>Order Summary</h4>
      
        <?php if (!empty($orderData)): ?>
            <ul class="list-group mb-3">
                <?php foreach ($orderData as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= esc($item['prod_name']) ?></strong>
                            <br>
                            Qty: <?= esc($item['prod_qty']) ?>, Price: ₹<?= esc($item['prod_price']) ?>, Weight: <?= esc($item['weight']) ?>
                        </div>
                        
                       
                        <span class="fw-bold">₹<?= esc(number_format($item['prod_price'] * $item['prod_qty'], 2)) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        

        <h4>Shipping Address</h4>
        <?php $totalAmount=0; if (!empty($addressData)): ?>
            <div class="border rounded p-3 mb-3">
                <?= esc($addressData['receiver_name']) ?><br>
                <?= esc($addressData['shipping_address']) ?><br>
                <?= esc($addressData['city']) ?>, <?= esc($addressData['state']) ?> - <?= esc($addressData['zip']) ?><br>
                <?= esc($addressData['country']) ?>
            </div>
        <?php endif; ?>

        <h4>Total Amount</h4>
        <?php foreach ($orderData as $item): ?>
            <?php $totalAmount+= $item['prod_price'] * $item['prod_qty']; ?>
        <?php endforeach; ?>
        <p class="fw-bold text-success fs-4">₹<?= esc($addressData['amount']) ?></p>
         
          
        <a href="<?= $shop_url ?>" class="btn btn-primary mt-3">Back to Home</a>
 
         
    </div>
</div>
<?= $this->endSection() ?>
