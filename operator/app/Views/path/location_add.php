<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<?php include(APPPATH . 'Views/templates/config.php'); ?>

<?php if (session()->getFlashdata('success')) : ?>
<div class="flash-popup alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>



<style>
    input ,select{
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <form id="locationForm" action="<?= site_url('location/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php if (isset($location)): ?>
            <input type="hidden" name="location_id" value="<?= esc($location['id']) ?>">
            <?php endif; ?>

            <div class="row">
                <!-- State -->
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                        <select name="state_id" id="state_id" class="form-control" required>
                            <option value="">Select State</option>
                            <?php foreach ($states as $state): ?>
                            <option value="<?= $state['id']; ?>"
                                <?= (isset($location) && $state['id'] == $location['state_id']) || $state['id'] == 1 ? 'selected' : '' ?>>
                                <?= esc($state['state']); ?>
                            </option>

                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Please select a state.</div>
                    </div>
                </div>

                <!-- District with inline add -->
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label">District <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select name="district_id" id="district_id" class="form-control" required>
                                <option value="">Select District</option>
                                <?php foreach ($districts as $district): ?>
                                <option value="<?= $district['id']; ?>"
                                    <?= isset($location) && $district['id'] == $location['district_id'] ? 'selected' : '' ?>>
                                    <?= esc($district['district_name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" id="new_district" class="form-control" placeholder="New District">
                            <button type="button" id="addDistrictBtn" class="btn btn-primary">+</button>
                        </div>
                        <div class="invalid-feedback">Please select or add a district.</div>
                    </div>
                </div>

                <!-- City with inline add -->
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label">Area</label>
                        <div class="input-group">
                            <select name="city_id" id="city_id" class="form-control">
                                <option value="">Select area</option>
                                <?php foreach ($citylist as $city): ?>
                                <option value="<?= $city['id']; ?>"
                                    <?= isset($location) && $city['id'] == $location['city_id'] ? 'selected' : '' ?>>
                                    <?= esc($city['city_name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" id="new_city" class="form-control" placeholder="New City">
                            <button type="button" id="addCityBtn" class="btn btn-primary">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit main form -->
            <div class="col-md-6 d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <!-- <button type="submit" class="btn btn-primary">
                    <?= isset($location) ? 'Update Location' : 'Add Location' ?>
                </button> -->
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('addDistrictBtn').addEventListener('click', function() {
    let newDistrict = document.getElementById('new_district').value.trim();
    let stateId = document.getElementById('state_id').value;
    if (newDistrict && stateId) {
        fetch("<?= site_url('add_location/district') ?>", {
                method: "POST",
                body: JSON.stringify({
                    state_id: stateId,
                    district_name: newDistrict
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);

                if (data.status == 'success') {
                    // let opt = document.createElement("option");
                    // opt.value = data.id;
                    // opt.text = newDistrict;
                    // opt.selected = true;
                    // document.getElementById('district_id').appendChild(opt);
                    // document.getElementById('new_district').value = "";
                    // location.reload();
                } else {
                    alert(data.message || "Error adding district");
                }
            });
    } else {
        alert("Select State and enter District name");
    }
});

document.getElementById('addCityBtn').addEventListener('click', function() {
    let newCity = document.getElementById('new_city').value.trim();
    let districtId = document.getElementById('district_id').value;
    if (newCity && districtId) {
        fetch("<?= site_url('add_location/city') ?>", {
                method: "POST",
                body: JSON.stringify({
                    district_id: districtId,
                    city_name: newCity
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data.status == 'success') {


                    location.reload();
                } else {
                    alert(data.message || "Error adding city");
                }
            });
    } else {
        alert("Select District and enter City name");
    }
});
</script>


<?= $this->endSection() ?>