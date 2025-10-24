<?= $this->extend('index') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>



<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <!-- <th>User ID</th> -->
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Transaction ID</th>
                            <th>Address</th>

                            <th>Invoice No</th>
                            <th>Ordered Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders)):
                            $sno = 1;
                            foreach ($orders as $row):
                                $strNumber = (string)$row['order_id'];

                                $firstFour = substr($strNumber, 0, 4);
                                $lastFour = substr($strNumber, -4);

                                $orderCode = $firstFour . '-' . $lastFour; ?>
                                <tr>
                                    <td><?= $sno++; ?></td>
                                    <td><?= esc($firstFour) ?></td>
                                    <!-- <td><?= esc($row['user_id']) ?></td> -->
                                    <td><?= esc($row['amount']) ?></td>


                                    <td><?= esc($row['payment_method']) ?></td>
                                    <td><?= esc($row['transaction_id']) ?></td>
                                    <td style="width: 300px;">
                                        <?= esc($row['shipping_address']) ?><br>
                                        <strong>City : </strong><?= esc($row['city']) ?><br>
                                        <strong>Phone :</strong><?= esc($row['receiver_phone_no']) ?><br>
                                    </td>
                                    <td><?= esc($row['invoice_no']) ?></td>
                                    <td><?= esc($row['ordered_date']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="18" class="text-center">No Orders Found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

