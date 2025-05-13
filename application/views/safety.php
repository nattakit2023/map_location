<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Safety
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Safety</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded-0">
                    <div class="card-header bg-light rounded-0">
                        <h3>
                            Add Safety Report
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="col-md-10">
                                    <strong style="font-size: 18px;">Select Image file </strong>
                                </div>
                                <div class="col-md-10">
                                    <input type="file" name="files" id="files" multiple accept="image/jpeg, image/png, image/gif, image/tiff, image/svg+xml">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-10">
                                    <strong style="font-size: 18px;">Select Vehicle</strong>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control rounded-0" name="vehicle" id="vehicle" data-placeholder="Select vehicle">
                                        <?php if (!empty($vehicles)) {
                                            foreach ($vehicles as $vehicle) { ?>
                                                <option value="<?= $vehicle['v_id']; ?>"><?= $vehicle['v_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <input type="checkbox" id="check_all" name="check_all" value="1"> Add Picture to Dashboard screen</input>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-10">
                                    <strong style="font-size: 18px;">Date</strong>
                                </div>
                                <div class="col-md-10">
                                    <input type="datetime-local" id="datetime" class="form-control rounded-0">
                                </div>
                            </div>
                            <div class="col-md-2" style="align-content: center;">
                                <button id="addFilesFMS" class="btn btn-block btn-primary rounded-0"><i class="fas fa-plus"></i> Add File</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card rounded-0">
                    <div class="card-header bg-light rounded-0">
                        <h3>
                            Safety Report List
                        </h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <button id="showTable1" class="btn btn-primary">Safety By Vessel</button>
                            <button id="showTable2" class="btn btn-secondary">Safety Overall</button>
                        </div>
                        <table id="table1" class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">S.No</th>
                                    <th>File Name</th>
                                    <th>Vessel Name</th>
                                    <th>Uploaded Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($fms)) {
                                    foreach ($fms as $fms_data) {
                                ?>
                                        <tr>
                                            <td><?php echo $fms_data['id']; ?></td>
                                            <td><?php echo $fms_data['file_name']; ?></td>
                                            <td><?php echo $fms_data['v_name']; ?></td>
                                            <td><?php echo $fms_data['datetime']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url($fms_data['file_path']); ?>" target="_blank"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                        <table id="table2" class="table card-table table-vcenter text-nowrap" style="display: none;">
                            <thead>
                                <tr>
                                    <th class="w-1">S.No</th>
                                    <th>File Name</th>
                                    <th>Uploaded Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($safety_all)) {
                                    foreach ($safety_all as $safety_data) {
                                ?>
                                        <tr>
                                            <td><?php echo $safety_data['id']; ?></td>
                                            <td><?php echo $safety_data['file_name']; ?></td>
                                            <td><?php echo $safety_data['datetime']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url($safety_data['file_path']); ?>" target="_blank"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showTable1Button = document.getElementById('showTable1');
        const showTable2Button = document.getElementById('showTable2');
        const table1 = document.getElementById('table1');
        const table2 = document.getElementById('table2');

        showTable1Button.addEventListener('click', function() {
            table1.style.display = ''; // Or 'table'
            table2.style.display = 'none';
        });

        showTable2Button.addEventListener('click', function() {
            table1.style.display = 'none';
            table2.style.display = ''; // Or 'table'
        });
    });

    $(document).on('click', '#addFilesFMS', function() {
        var formdata = new FormData();

        let files = $('#files')[0].files;
        let vehicle = $('#vehicle').val();
        let datetime = $('#datetime').val();

        formdata.append('vehicle', vehicle);
        formdata.append('datetime', datetime);

        for (var index = 0; index < files.length; index++) {
            formdata.append('files[]', files[index]);
        }


        if ($('#check_all').prop('checked') == true) {
            $.ajax({
                url: '<?= base_url(); ?>reports/add_pms_all',
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    location.reload();
                }
            });
        } else {
            $.ajax({
                url: '<?= base_url(); ?>reports/add_safety',
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    location.reload();
                }
            });
        }
    })

    $(document).on('click', '#check_all', function() {
        let check = $(this).prop('checked');
        $('#vehicle').prop('disabled', check);
    })
</script>