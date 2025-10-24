<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<title>Orders List</title>
<?php include(APPPATH . 'Views/templates/config.php'); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    .modal-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-bottom: none;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }

    .modal-title {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .icon-wrapper {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .filter-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.75rem;
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .form-select,
    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .indian-date-wrapper {
        position: relative;
    }

    .indian-date {
        position: relative;
    }

    .date-format-hint {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 2rem;
    }

    .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 0.25rem;
    }

    .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-group-custom {
        display: flex;
        gap: 0.75rem;
        justify-content: end;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        font-weight: 500;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .btn-outline-secondary {
        border: 2px solid #6c757d;
        color: #6c757d;
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        font-weight: 500;
        border-radius: 0.5rem;
    }

    .date-range-section {
        border-top: 1px solid #dee2e6;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .section-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    @media (max-width: 768px) {
        .btn-group-custom {
            flex-direction: column;
        }

        .checkbox-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    .filter {
        position: absolute;
        top: 18%;
        left: 88%;
        margin: 1rem;
        z-index: 99;
    }
</style>



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
<div class="container mt-5 ">
    <button type="button" class="btn btn-primary filter " data-bs-toggle="modal" data-bs-target="#filterModal">
        <i class="fas fa-filter me-2"></i> Filter
    </button>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Orders List</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="orders-table" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Shop</th>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Receiver</th>
                            <th>City</th>
                            <th>Discount</th>
                            <th>GST</th>
                            <th>Delivery Fee</th>
                            <th>Platform Fee</th>
                            <th>Amount</th>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Ordered Date</th>
                        </tr>
                    </thead>

                    
                    <tbody>
                        <?php if (isset($orders) && !empty($orders)): ?>
                            <?php foreach ($orders as $k => $order): ?>
                                <tr>
                                    <td><?= esc($k + 1) ?></td>
                                    <td><?= esc($order['shop_id']) ?></td>
                                    <td><?= esc($order['order_id']) ?></td>
                                    <td><?= esc($order['user_id']) ?></td>
                                    <td><?= esc($order['receiver_name']) ?></td>
                                    <td><?= esc($order['city']) ?></td>
                                    <td><?= esc($order['discount']) ?></td>
                                    <td><?= esc($order['gstfee']) ?></td>
                                    <td><?= esc($order['deliveryFee']) ?></td>
                                    <td><?= esc($order['platformfee']) ?></td>
                                    <td><b><?= esc($order['amount']) ?></b></td>
                                    <td><?= esc($order['invoice_no']) ?></td>
                                    <td><?= esc($order['invoice_date']) ?></td>
                                    <td><?= esc($order['ordered_date']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->






<div class="modal fade" id="filterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="filterModalLabel">
                    <div class="icon-wrapper">
                        <i class="fas fa-filter"></i>
                    </div>
                    Filter Options
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="filter-section">
                    <form id="filterForm" method="GET" action="<?= base_url() ?>orders-filter">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="dateFilter" class="form-label">
                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>Date Filter
                                </label>
                                <select name="dateFilter" id="dateFilter" class="form-select">
                                    <option value="">Select time period</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="shopId" class="form-label">
                                    <i class="fas fa-store me-2 text-primary"></i>Shop Location
                                </label>
                                <select name="shopId" id="shopId" class="form-select">
                                    <option value="">All Shops</option>
                                    <?php foreach ($shops as $shop): ?>
                                        <option value="<?= $shop['shop_id'] ?>"><?= $shop['shop_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="date-range-section mt-4">
                            <div class="section-title">
                                <i class="fas fa-calendar-week text-primary"></i>
                                Custom Date Range
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="startdate" class="form-label">
                                        <i class="fas fa-calendar-day me-2 text-primary"></i>Start Date
                                    </label>
                                    <input type="date" name="startdate" id="startdate" class="form-control indian-date">
                                </div>

                                <div class="col-md-6">
                                    <label for="enddate" class="form-label">
                                        <i class="fas fa-calendar-check me-2 text-primary"></i>End Date
                                    </label>
                                    <input type="date" name="enddate" id="enddate" class="form-control indian-date">
                                </div>
                            </div>

                            <div class="form-check mt-3">
                                <input type="checkbox" name="report" id="report" class="form-check-input">
                                <label for="report" class="form-check-label">
                                    <i class="fas fa-file-alt me-2 text-primary"></i>Generate Detailed Report
                                    <small class="d-block text-muted">Include comprehensive analytics</small>
                                </label>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="btn-group-custom">
                                    <button type="button" id="resetBtn" class="btn btn-outline-secondary">
                                        <i class="fas fa-undo me-2"></i>Reset Filters
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-2"></i>Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filterForm');
        const reportCheckbox = document.getElementById('report');

        // Create hidden input for reports, with PHP value
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'reports';
        hiddenInput.value = '<?= json_encode($orders) ?>';


        filterForm.addEventListener('submit', function (e) {
            if (reportCheckbox.checked) {
                filterForm.method = 'POST';
                filterForm.action = '<?= base_url() ?>orders-reports';
                if (!filterForm.contains(hiddenInput)) {
                    filterForm.appendChild(hiddenInput);
                }
            } else {
                filterForm.method = 'GET';
                filterForm.action = '<?= base_url() ?>orders-filter';
                if (filterForm.contains(hiddenInput)) {
                    filterForm.removeChild(hiddenInput);
                }
            }
        });

        // Optional: Reset button functionality to clear form and set to default
        document.getElementById('resetBtn').addEventListener('click', function () {
            filterForm.reset();
            filterForm.method = 'GET';
            filterForm.action = '<?= base_url() ?>orders-filter';
            if (filterForm.contains(hiddenInput)) {
                filterForm.removeChild(hiddenInput);
            }
        });
    });
</script>



<script src="<?= base_url() ?>public/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#orders-table').DataTable();
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const resetBtn = document.getElementById('resetBtn');
        const filterForm = document.getElementById('filterForm');
        const startDate = document.getElementById('startdate');
        const endDate = document.getElementById('enddate');

        // Set Indian locale for date inputs
        function setIndianDateFormat() {
            const today = new Date();
            const indianFormat = today.toLocaleDateString('en-IN');

            // Set max date to today for both inputs
            const todayISO = today.toISOString().split('T')[0];
            startDate.max = todayISO;
            endDate.max = todayISO;

            // Add placeholder text
            startDate.addEventListener('focus', function () {
                this.style.color = '#495057';
            });

            endDate.addEventListener('focus', function () {
                this.style.color = '#495057';
            });
        }

        // Validate date range
        function validateDateRange() {
            if (startDate.value && endDate.value) {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);

                if (start > end) {
                    endDate.setCustomValidity('End date must be after start date');
                    return false;
                } else {
                    endDate.setCustomValidity('');
                    return true;
                }
            }
            return true;
        }

        // Event listeners for date validation
        startDate.addEventListener('change', validateDateRange);
        endDate.addEventListener('change', validateDateRange);

        // Reset functionality
        resetBtn.addEventListener('click', function () {
            filterForm.reset();
            endDate.setCustomValidity('');

            // Show Indian date format hint
            const hints = document.querySelectorAll('.date-format-hint');
            hints.forEach(hint => {
                hint.style.color = '#28a745';
                hint.innerHTML = '<i class="fas fa-check-circle me-1"></i>Filters reset successfully!';
                setTimeout(() => {
                    hint.style.color = '#6c757d';
                    hint.innerHTML = '<i class="fas fa-info-circle me-1"></i>Format: DD/MM/YYYY (Indian Standard)';
                }, 2000);
            });
        });



    });




</script>



<?= $this->endSection() ?>