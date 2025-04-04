<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vessel Management
            </h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
               <li class="breadcrumb-item active">Vessel Management</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<section class="content">
   <div class="container-fluid">
      <div class="card">
         <div class="card-body p-0">
            <div class="table-responsive">
               <table id="vehiclelisttbl" class="table card-table table-vcenter text-nowrap">
                  <thead>
                     <tr>
                        <th class="w-1">S.No</th>
                        <th>Vessel Name</th>
                        <th>IMO</th>
                        <th>MMSI</th>
                        <th>Call sign</th>
                        <th>Group</th>
                        <th>Is Active</th>
                        <?php if(userpermission('lr_vech_list_view') || userpermission('lr_vech_list_edit')) { ?>
                        <th>Action</th>
                        <?php } ?>
                     </tr>
                  </thead>
                  <tbody>

                     <?php if(!empty($vehiclelist)){  $count=1; foreach($vehiclelist as $vehiclelists){  ?>
                     <tr>
                        <td><?php echo output($count); $count++; ?></td>
                        <td><a href="https://iot.thaicom.io/dashboards/shared/6f03d010-e4d2-11ee-9ae1-d9b029988059/7a5c04a0-e4d2-11ee-9ae1-d9b029988059"><?php echo output($vehiclelists['v_name']); ?></a></td>

                        <td><?php echo output($vehiclelists['v_model']); ?></td>
                        <td><?php echo output($vehiclelists['v_chassis_no']); ?></td>
                        <td><?php echo output($vehiclelists['v_engine_no']); ?></td>
                        <td><?php echo output($vehiclelists['gr_name']); ?></td>
                        <td><span class="badge <?php echo ($vehiclelists['v_is_active']=='1') ? 'badge-success' : 'badge-danger'; ?> "><?php echo ($vehiclelists['v_is_active']=='1') ? 'Active' : 'Inactive'; ?></span>  
                        </td>
                        <?php if(userpermission('lr_vech_list_view') || userpermission('lr_vech_list_edit')) { ?>
                        <td>
                           <?php if(userpermission('lr_vech_list_view')) { ?>
                           <a class="icon" href="<?php echo base_url(); ?>vehicle/viewvehicle/<?php echo output($vehiclelists['v_id']); ?>">
                           <i class="fa fa-eye"></i>
                           </a> | 
                           <?php } if(userpermission('lr_vech_list_edit')) { ?>
                           <a class="icon" href="<?php echo base_url(); ?>vehicle/editvehicle/<?php echo output($vehiclelists['v_id']); ?>">
                           <i class="fa fa-edit"></i>
                           </a> 
                           <?php } ?>
                        </td>
                        <?php } ?>
                     </tr>
                     <?php } } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>
