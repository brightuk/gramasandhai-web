<?php include(APPPATH . 'Views/templates/config.php'); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-popup alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php
$fees = [
    0 => ['id' => 1, 'name' => 'Delivery Fee', 'code' => 'DLFE', 'amount' => '0', 'percentage' => '0', 'status' => '0', 'op_select' => 8],
    1 => ['id' => 2, 'name' => 'Platform Fee', 'code' => 'PLFE', 'amount' => '0', 'percentage' => '0', 'status' => '0', 'op_select' => 8],
    2 => ['id' => 3, 'name' => 'Discount', 'code' => 'OTCH', 'amount' => '0', 'percentage' => '0', 'status' => '0', 'op_select' => 8],
    3 => ['id' => 4, 'name' => 'Gst Charge', 'code' => 'GSTCH', 'amount' => '0', 'percentage' => '0', 'status' => '0', 'op_select' => 8],

];

if (isset($fees_c) && !empty($fees_c)) {
    foreach ($fees_c as $key => $feec) {
        foreach ($fees as $key => $fee) {
            if ($fee['code'] == $feec['code']) {
                $fees[$key]['id'] = $feec['id'];
                $fees[$key]['amount'] = $feec['amount'];
                $fees[$key]['op_select'] = $feec['op_select'];
                $fees[$key]['percentage'] = $feec['percentage'];
                $fees[$key]['percentage'] = $feec['percentage'];
                $fees[$key]['status'] = $feec['status'];
            }
        }
    }
}

?>

<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:10px;">ID</th>
                            <th style="width:200px;">Field Name</th>
                            <th>Percentage</th>
                            <th>Amount</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($fees)):
                            $sno = 1;
                            foreach ($fees as $row): ?>
                                <tr>
                                    <td><?= $sno++; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['percentage']; ?></td>
                                    <td><?= $row['amount']; ?></td>


                                    <td class="g-5">

                                        <?php if ($row['amount'] != 0 && $row['percentage'] != 0): ?>
                                            <?php if ($row['status'] == 0): ?>
                                                <!-- Toggle OFF -->
                                                <a href="<?= base_url('shop/' . $shop_id . '/fee-manage/action/' . $row['id']) ?>"
                                                    class="text-danger fs-4 edit-category-btn">
                                                    <i class="fa fa-toggle-off"></i>
                                                </a>
                                            <?php else: ?>
                                                <!-- Toggle ON -->
                                                <a href="<?= base_url('shop/' . $shop_id . '/fee-manage/action/' . $row['id']) ?>"
                                                    class="text-success fs-4 rounded edit-category-btn">
                                                    <i class="fa fa-toggle-on"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <!-- Edit Button -->
                                        <a href="#" class="btn text-info fs-4" data-bs-toggle="modal"
                                            data-bs-target="#feeUpdateModal" data-percentage="<?= $row['percentage'] ?>"
                                            data-amount="<?= $row['amount'] ?>" data-id="<?= $row['id'] ?>"
                                            data-code="<?= $row['code'] ?>" data-name="<?= $row['name'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <!-- Fee Type Switch -->
                                        <?php if ($row['op_select'] == 0): ?>
                                            <a href="<?= base_url('shop/' . $shop_id . '/fee-manage/second_ch/' . $row['id']) ?>"
                                                class="text-white bg-info p-1 fs-6 edit-category-btn">
                                                Percentage
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('shop/' . $shop_id . '/fee-manage/second_ch/' . $row['id']) ?>"
                                                class="text-white bg-warning p-1 fs-6 rounded">
                                                Flat
                                            </a>
                                        <?php endif; ?>

                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- <tr>
                                <td colspan="6" class="text-center">No Data Found</td>
                            </tr> -->
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Trigger Button -->


<!-- Modal -->
<div class="modal fade" id="feeUpdateModal" tabindex="-1" aria-labelledby="feeUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="feeUpdateModalLabel">Fee Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="<?= base_url() . 'shop/' . $shop_id ?>/fee-manage" method="POST">
                    <input type="hidden" id="field_id" name="field_id">
                    <input type="hidden" id="code" name="code">

                    <div class="mb-3">
                        <label class="form-label">Field Name</label>
                        <input type="text" id="field_name" name="field_name" class="form-control" readonly>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Percentage</label>
                                <input type="number" id="percentage" name="percentage" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                        <button type="submit" class="btn btn-primary">Save Changes</button>

                    </div>

                </form>
            </div>

            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var feeUpdateModal = document.getElementById('feeUpdateModal');
        feeUpdateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            // Get data from the button
            var percentage = button.getAttribute('data-percentage');
            var amount = button.getAttribute('data-amount');
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var code = button.getAttribute('data-code');

            // Fill modal fields
            document.getElementById('percentage').value = percentage;
            document.getElementById('amount').value = amount;
            document.getElementById('field_id').value = id;
            document.getElementById('field_name').value = name;
            document.getElementById('code').value = code;
        });
    });

</script>

<?= $this->endSection() ?>