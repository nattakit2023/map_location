<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Restrict Events
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Restrict Events</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table id="triptbl" class="table card-table table-vcenter text-nowrap">
            <thead>
              <tr>
                <th class="w-1">S.No</th>
                <th>Vessel Name</th>
                <th>Restrict Name</th>
                <th>Restrict Event</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($restrictevents)) {
                $count = 1;
                foreach ($restrictevents as $restrict) {
              ?>
                  <tr>
                    <td><?php echo output($count);
                        $count++; ?></td>
                    <td><?php echo output($restrict['v_name']); ?></td>
                    <td><?php echo output($restrict['res_name']); ?></td>
                    <td> <span class="badge badge-danger">
                        <?php echo output($restrict['latitude']); ?> , <?= output($restrict['longitude']) ?></span> </td>
                    <td><?php echo output($restrict['res_timestamp']); ?></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>

        </div>
      </div>
      <!-- /.card-body -->
    </div>

  </div>
</section>
<!-- /.content -->



<div id="geofencepopupmodel" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
      </div>
    </div>
  </div>
</div>