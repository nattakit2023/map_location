<aside class="main-sidebar elevation-1 sidebar-light-primary">
   <?php $data = sitedata();  ?>
   <a href="<?= base_url(); ?>dashboard" class="brand-link" style="display: flex; justify-content: center;">
      <img src="<?= base_url() ?>assets/image/SC.png" class="brand-image frlogo">
   </a>
   <div class="sidebar">
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
               <a href="<?= base_url(); ?>dashboard" class="nav-link <?php echo activate_menu('dashboard'); ?>" style="display:flex;align-items:center;font-weight:600;">
                  <span class="nav-icon material-symbols-outlined">
                     dashboard
                  </span>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <li class="nav-item has-treeview <?php echo ((activate_menu('vehicle')) == 'active') ? 'menu-open' : '' ?>
               <?php echo ((activate_menu('addvehicle')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('viewvehicle')) == 'active') ? 'menu-open' : '' ?><?php echo ((activate_menu('editvehicle')) == 'active') ? 'menu-open' : '' ?><?php echo ((activate_menu('vehiclegroup')) == 'active') ? 'menu-open' : '' ?>">
               <a href="#" class="nav-link <?php echo activate_menu('vehicle'); ?> <?php echo activate_menu('addvehicle'); ?><?php echo activate_menu('viewvehicle'); ?><?php echo activate_menu('editvehicle'); ?><?php echo activate_menu('vehiclegroup'); ?>" style="display:flex;align-items:center;font-weight:600;">
                  <span class="nav-icon material-symbols-outlined">
                     directions_boat
                  </span>
                  <p>
                     Vessel
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <?php if (userpermission('lr_vech_list')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>vehicle" class="nav-link <?php echo activate_menu('vehicle'); ?><?php echo activate_menu('editvehicle'); ?><?php echo activate_menu('viewvehicle'); ?>">
                           <i class="nav-icon fas faa-list"></i>
                           <p>Vessel List</p>
                        </a>
                     </li>
                  <?php }
                  if (userpermission('lr_vech_add')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>vehicle/addvehicle" class="nav-link <?php echo activate_menu('addvehicle'); ?>">
                           <i class="nav-icon fas faa-plus"></i>
                           <p>Add Vessel</p>
                        </a>
                     </li>
                  <?php }
                  if (userpermission('lr_vech_group')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>vehicle/vehiclegroup" class="nav-link <?php echo activate_menu('vehiclegroup'); ?>">
                           <i class="nav-icon fas faa-plus"></i>
                           <p>Vessel Group</p>
                        </a>
                     </li>

               </ul>
            </li>
         <?php }
                  if (userpermission('lr_tracking') || userpermission('lr_liveloc')) { ?>
            <li class="nav-item has-treeview <?php echo ((activate_menu('tracking')) == 'active') ? 'menu-open' : '' ?>
               <?php echo ((activate_menu('livestatus')) == 'active') ? 'menu-open' : '' ?>">
               <a href="#" class="nav-link <?php echo activate_menu('tracking'); ?> <?php echo activate_menu('livestatus'); ?>" style="display:flex;align-items:center;font-weight:600;">
                  <span class="nav-icon material-symbols-outlined">
                     pin_drop
                  </span>
                  <p>
                     Tracking
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <?php if (userpermission('lr_tracking')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>tracking" class="nav-link <?php echo activate_menu('tracking'); ?>">
                           <i class="nav-icon fas faa-list"></i>
                           <p>History Tracking</p>
                        </a>
                     </li>
                  <?php }
                     if (userpermission('lr_liveloc')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>tracking/livestatus" class="nav-link <?php echo activate_menu('livestatus'); ?>">
                           <i class="nav-icon fas faa-plus"></i>
                           <p>Live Location</p>
                        </a>
                     </li>
                  <?php } ?>
               </ul>
            </li>
         <?php }
                  if (userpermission('lr_restrict_add') || userpermission('lr_restrict_list') || userpermission('lr_restrict_events')) { ?>
            <li class="nav-item has-treeview <?php echo ((activate_menu('addrestrict')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('restrictevents')) == 'active') ? 'menu-open' : '' ?>
               <?php echo ((activate_menu('restrict_management')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('restrict')) == 'active') ? 'menu-open' : '' ?>">
               <a href="#" class="nav-link <?php echo activate_menu('restrict_management'); ?>  <?php echo activate_menu('restrict'); ?><?php echo activate_menu('addrestrict'); ?> <?php echo activate_menu('restrictevents'); ?>" style="display:flex;align-items:center;font-weight:600;">
                  <span class="nav-icon material-symbols-outlined">
                     location_off
                  </span>
                  <p>
                     Restrict Zone
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="<?= base_url(); ?>restrict" class="nav-link <?php echo activate_menu('restrict'); ?>">
                        <i class="nav-icon fas faa-list"></i>
                        <p>View Restrict Zone</p>
                     </a>
                  </li>
                  <?php if (userpermission('lr_restrict_add')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>restrict/addrestrict" class="nav-link <?php echo activate_menu('addrestrict'); ?>">
                           <i class="nav-icon fas faa-list"></i>
                           <p>Add Restrict Zone</p>
                        </a>
                     </li>
                  <?php }
                     if (userpermission('lr_restrict_list')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>restrict/restrict_management" class="nav-link <?php echo activate_menu('restrict_management'); ?>">
                           <i class="nav-icon fas faa-plus"></i>
                           <p>Restrict Zone Management</p>
                        </a>
                     </li>
                  <?php }
                     if (userpermission('lr_restrict_events')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>restrict/restrictevents" class="nav-link <?php echo activate_menu('restrictevents'); ?>">
                           <i class="nav-icon fas faa-plus"></i>
                           <p>Restrict Zone Events</p>
                        </a>
                     </li>
                  <?php } ?>
               </ul>
            </li>
         <?php }
                  if (userpermission('lr_geofence_add') || userpermission('lr_geofence_list') || userpermission('lr_geofence_events')) { ?>
            <li class="nav-item has-treeview <?php echo ((activate_menu('addgeofence')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('geofenceevents')) == 'active') ? 'menu-open' : '' ?>
               <?php echo ((activate_menu('geofence_management')) == 'active') ? 'menu-open' : '' ?>"> <?php echo ((activate_menu('geofence')) == 'active') ? 'menu-open' : '' ?>
               <a href="#" class="nav-link <?php echo activate_menu('geofence'); ?> <?php echo activate_menu('addgeofence'); ?> <?php echo activate_menu('geofenceevents'); ?>" style="display:flex;align-items:center;font-weight:600;">
                  <span class="nav-icon material-symbols-outlined">
                     my_location
                  </span>
                  <p>
                     Geofence
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <?php if (userpermission('lr_geofence_add')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>geofence/addgeofence" class="nav-link <?php echo activate_menu('addgeofence'); ?>">
                           <i class="nav-icon fas faa-list"></i>
                           <p>Add Geofence</p>
                        </a>
                     </li>
                  <?php }
                     if (userpermission('lr_geofence_list')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>geofence/geofence_management" class="nav-link <?php echo activate_menu('geofence_management'); ?>">
                           <i class="nav-icon fas faa-plus"></i>
                           <p>Geofence Management</p>
                        </a>
                     </li>
                  <?php }
                     if (userpermission('lr_geofence_events')) { ?>
                     <li class="nav-item">
                        <a href="<?= base_url(); ?>geofence/geofenceevents" class="nav-link <?php echo activate_menu('geofenceevents'); ?>">
                           <i class="nav-icon fas faa-plus"></i>
                           <p>Geofence Events</p>
                        </a>
                     </li>
                  <?php } ?>
               </ul>
            </li>

         <?php } ?>

         <li class="nav-item has-treeview <?php echo ((activate_menu('fms')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('crew_status')) == 'active') ? 'menu-open' : '' ?>">
            <a href="<?= base_url(); ?>reports" class="nav-link <?php echo activate_menu('report'); ?>" style="display:flex;align-items:center;font-weight:600;">
               <span class="material-symbols-outlined">
                  lab_profile
               </span>
               <p>
                  Report Management
                  <i class="right fas fa-angle-left"></i>
               </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="<?= base_url(); ?>reports/fms" class="nav-link <?php echo activate_menu('fms'); ?>">
                     <i class="fas fa-cosg icon nav-icon"></i>
                     <p>FMS</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url(); ?>reports/crew_status" class="nav-link <?php echo activate_menu('crew_status'); ?>">
                     <i class="fas fa-cosg icon nav-icon"></i>
                     <p>CREW Status</p>
                  </a>
               </li>
            </ul>
         </li>
         <?php if (userpermission('lr_settings')) { ?>
            <li class="nav-item has-treeview <?php echo ((activate_menu('websitesetting')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('smtpconfig')) == 'active') ? 'menu-open' : '' ?><?php echo ((activate_menu('email_template')) == 'active') ? 'menu-open' : '' ?><?php echo ((activate_menu('edit_email_template')) == 'active') ? 'menu-open' : '' ?>">
               <a href="#" class="nav-link <?php echo activate_menu('websitesetting'); ?><?php echo activate_menu('email_template'); ?> <?php echo activate_menu('smtpconfig'); ?><?php echo activate_menu('edit_email_template'); ?>" style="display:flex;align-items:center;font-weight:600;">
                  <span class="nav-icon material-symbols-outlined">
                     settings
                  </span>
                  <p>
                     Setting's
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="<?= base_url(); ?>settings/websitesetting" class="nav-link <?php echo activate_menu('websitesetting'); ?>">
                        <i class="fas fa-cosg icon nav-icon"></i>
                        <p>General Settings</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?= base_url(); ?>settings/smtpconfig" class="nav-link <?php echo activate_menu('smtpconfig'); ?>">
                        <i class="nav-icon fas faa-plus"></i>
                        <p>SMTP Configuration</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?= base_url(); ?>settings/email_template" class="nav-link <?php echo activate_menu('email_template'); ?><?php echo activate_menu('edit_email_template'); ?>">
                        <i class="nav-icon fas faa-plus"></i>
                        <p>Email Template</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview <?php echo ((activate_menu('users')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('adduser')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('edituser')) == 'active') ? 'menu-open' : '' ?>">
               <a href="#" class="nav-link <?php echo activate_menu('users'); ?> <?php echo activate_menu('edituser'); ?><?php echo activate_menu('adduser'); ?>" style="display:flex;align-items:center;font-weight:600;">
                  <span class="nav-icon material-symbols-outlined">
                     group
                  </span>
                  <p>
                     User's
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="<?= base_url(); ?>users" class="nav-link <?php echo activate_menu('users'); ?> <?php echo activate_menu('edituser'); ?>">
                        <i class="fas fa-cosg icon nav-icon"></i>
                        <p>User Management</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?= base_url(); ?>users/adduser" class="nav-link <?php echo activate_menu('adduser'); ?>">
                        <i class="nav-icon fas faa-plus"></i>
                        <p>Add User</p>
                     </a>
                  </li>
               </ul>
            </li>
         <?php } ?>
         <li class="nav-item has-treeview <?php echo ((activate_menu('customer')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('addcustomer')) == 'active') ? 'menu-open' : '' ?> <?php echo ((activate_menu('editcustomer')) == 'active') ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?php echo activate_menu('customer'); ?> <?php echo activate_menu('editcustomer'); ?><?php echo activate_menu('addcustomer'); ?>" style="display:flex;align-items:center;font-weight:600;">
            <span class="material-symbols-outlined">
assignment_ind
</span>
               <p>
                  Customer
                  <i class="right fas fa-angle-left"></i>
               </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="<?= base_url(); ?>customer" class="nav-link <?php echo activate_menu('customer'); ?> <?php echo activate_menu('editcustomer'); ?>">
                     <i class="fas fa-cosg icon nav-icon"></i>
                     <p>Customer Management</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url(); ?>customer/addcustomer" class="nav-link <?php echo activate_menu('addcustomer'); ?>">
                     <i class="nav-icon fas faa-plus"></i>
                     <p>Add Customer</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item">
            <a href="<?= base_url(); ?>resetpassword" class="nav-link <?php echo activate_menu('resetpassword'); ?>" style="display:flex;align-items:center;font-weight:600;">
               <span class="nav-icon material-symbols-outlined">
                  key
               </span>
               <p>
                  Change Password
               </p>
            </a>
         </li>
         </ul>
      </nav>
      <div class="sidebar-footer" style="padding: 200px 30px 10px 30px; color: rgba(0,0,0,0.4); font-size: 12px; font-weight: 500; position: relative; bottom: 0;">
         <p>Developed by<br><span style="color: rgba(0,0,0,0.8);">
               Ship Expert Technology
            </span>
         </p>
         <p>Version 0.1</p>
      </div>
   </div>
</aside>
<div class="content-wrapper pb-2 mb-0">