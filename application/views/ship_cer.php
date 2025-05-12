<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Ship Certificate
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Ship Certificate</li>
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
                            Add Ship Certificate Report
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="col-md-10">
                                    <strong style="font-size: 18px;">Select Files </strong>
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
                            <div class="col-md-2" style="align-content: end;">
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
                            Ship Certificate Report List
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="fmslisttbl" class="table card-table table-vcenter text-nowrap">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
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

        $.ajax({
            url: '<?= base_url(); ?>reports/add_ship_cer',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload();
            }
        });
    })
</script>