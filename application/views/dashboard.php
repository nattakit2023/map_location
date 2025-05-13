<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- Main content -->
<!-- <section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
               <span class="info-box-icon theme-bg-default elevation-1"><i class="fas fa-ship text-white"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Total Vessel</span>
                  <span class="info-box-number"><?= ($dashboard['tot_vehicles'] != '') ? $dashboard['tot_vehicles'] : '0' ?>  </span>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-secret"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Total Online</span>
                  <span class="info-box-number"><?= ($dashboard['tot_drivers'] != '') ? $dashboard['tot_drivers'] : '0' ?> </span>
               </div>
            </div>
         </div>
         <div class="clearfix hidden-md-up"></div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-user text-white"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Total Customer</span>
                  <span class="info-box-number"><?= ($dashboard['tot_customers'] != '') ? $dashboard['tot_customers'] : '0' ?> </span>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
               <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-id-card"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Today Trips</span>
                  <span class="info-box-number"><?= ($dashboard['tot_today_trips'] != '') ? $dashboard['tot_today_trips'] : '0' ?></span>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="row col-md-12">
            <?php if (userpermission('lr_ie_list')) { ?>
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                     <h2 class="card-title">Historical</h2>
                  </div>
                  <div class="card-header border-transparent">
                     <div class="card-body">
                        <div class="d-flex">
                           <p class="d-flex flex-column">
                           </p>
                           <p class="ml-auto d-flex flex-column text-right">
                              <span class="text-success">
                              </span>
                           </p>
                        </div>
                        <div class="position-relative mb-4">
                           <div class="chartjs-size-monitor">
                              <div class="chartjs-size-monitor-expand">
                                 <div class=""></div>
                              </div>
                              <div class="chartjs-size-monitor-shrink">
                                 <div class=""></div>
                              </div>
                           </div>
                           <canvas id="ie-chart" height="200" width="487" class="chartjs-render-monitor" style="display: block; width: 487px; height: 200px;"></canvas>
                        </div>
                        <div class="d-flex flex-row justify-content-end">
                           <span class="mr-2">
                           <i class="fas fa-square text-success"></i> Online
                           </span>
                           <span>
                           <i class="fas fa-square text-danger"></i> Offline
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php }
            if (userpermission('lr_reminder_list')) { ?>
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header ui-sortable-handle" style="cursor: move;">
                     <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Reminder
                     </h3>
                     <div class="card-tools">
                     </div>
                  </div>
                  <div class="card-body">
                     <ul class="todo-list ui-sortable" data-widget="todo-list">
                        <?php if (!empty($todayreminder)) {
                           foreach ($todayreminder as $reminder) { ?>
                        <li id="<?= $reminder['r_id'] ?>">
                           <span class="text">
                              <?= $reminder['r_message'] . ' ';  ?>    
                              <div class="tools"> 
                                 <button type="button" data-id="<?= $reminder['r_id'] ?>" class="todayreminderread btn btn-block btn-outline-primary btn-xs">Mark as Read</button>                 
                              </div>
                           </span>
                        </li>
                        <?php }
                        } else {
                           echo 'No reminders';
                        } ?>  
                     </ul>
                  </div>
                  <div class="card-footer clearfix">
                     <a href="<?= base_url() ?>reminder/addreminder"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add Reminder</button></a>
                  </div>
               </div>
            </div>
         </div>
         <?php }
            if (userpermission('lr_liveloc')) { ?>
         <div class="col-sm-6 col-lg-6 ">
            <div class="card ">
               <div class="card-header">
                  <h2 class="card-title">Vessel Current Location</h2>
               </div>
               <table  class="datatable table card-table table-vcenter">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Current Location</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($vechicle_currentlocation)) {
                        foreach ($vechicle_currentlocation as $vech_details) {
                     ?>
                     <tr>
                        <td> <?php echo output($vech_details['v_name']); ?></td>
                        <td>  <span class="badge badge-<?php echo ($vech_details['current_location'] != '') ? 'success' : 'warning' ?>"><?php echo ($vech_details['current_location'] != '') ? wordwrap($vech_details['current_location'], 60, "<br />\n") : 'Location Not Updated' ?></span></td>
                     </tr>
                     <?php }
                     } ?>
                  </tbody>
               </table>
            </div>
         </div>
         <?php }
            if (userpermission('lr_vech_list')) { ?>
         <div class="col-sm-6 col-lg-6 ">
            <div class="card">
               <div class="card-header">
                  <h2 class="card-title">Vessel Running Status</h2>
               </div>
               <table class="datatable table card-table">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($vechicle_status)) {
                        foreach ($vechicle_status as $key => $vechicle_status_arr) {
                     ?>
                     <tr>
                        <td><?php echo output($vechicle_status_arr['v_name']); ?></td>
                        <td>
                           <span class="badge badge-<?php echo ($vechicle_status_arr['t_trip_status'] == 'Completed') ? 'success' : 'danger' ?>"><?php echo ($vechicle_status_arr['t_trip_status'] == 'Completed') ? 'Idle' : 'In Trip' ?></span>
                        </td>
                     </tr>
                     <?php  }
                     }  ?>
               </table>
            </div>
         </div>
         <?php }
            if (userpermission('lr_geofence_list')) { ?>
         <div class="col-md-6">
            <div class="col-sm-12 col-lg-12 ">
               <div class="card">
                  <div class="card-header">
                     <h2 class="card-title">Vessel Geofence Status</h2>
                  </div>
                  <table class="datatable table card-table table-vcenter">
                     <thead>
                        <tr>
                           <th>Vessel</th>
                           <th>Event</th>
                           <th>Time</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if (!empty($geofenceevents)) {
                           foreach ($geofenceevents as $geofence) {
                        ?>
                        <tr>
                           <td> <?php echo output($geofence['v_name']); ?></td>
                           <td>  <?php if ($geofence['ge_event'] == 'inside') {
                                    echo 'Moving ' . output($geofence['ge_event']) . ' ' . $geofence['geo_name'];
                                 } else {
                                    echo 'Exiting ' . output($geofence['ge_event']) . ' ' . $geofence['geo_name'];
                                 } ?></td>
                            <td> <?php echo output($geofence['ge_timestamp']); ?></td>
                        </tr>
                        <?php }
                        } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </div>
</section> -->
<!-- /.content -->

<section class="content">
   <div class="container-fluid">
      <!-- <div class="row">
         <div class="col-md-7">
            <div class="card rounded-0">
               <div class="card-header">
                  <h3>Map Windys</h3>
               </div>
               <div class="card-body">
                  <div id="windy" style="width: 100%; height: 650px;"></div>
               </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="card rouded-0">
               <div class="card-header">
                  <h3>Safety Overview</h3>
               </div>
               <div class="card-body" id="safety_overview">
               </div>
            </div>
         </div>
      </div> -->
      <div class="row">
         <div class="col-md-6">
            <div class="card rounded-0">
               <div class="card-header">
                  <h5>Map Windys</h5>
               </div>
               <div class="card-body">
                  <div id="windy" style="width: 100%; height: 660px;"></div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card rouded-0">
               <div class="card-header">
                  <h5>Safety Overview</h5>
               </div>
               <div class="card-body" id="safety_overview">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
</div>
<!-- <script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script> -->

<!-- /.content-wrapper -->
<!-- <?php if (userpermission('lr_ie_list')) { ?>
  <script>
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }
  var mode      = 'index';
    var intersect = true;
  var $visitorsChart = $('#ie-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : <?= "['" . implode("', '", array_keys($iechart)) . "']" ?>,
      datasets: [{
        type                : 'line',
        data                : <?= "['" . implode("', '", array_column($iechart, 'income')) . "']" ?>,
        backgroundColor     : 'transparent',
        borderColor         : '#28a745',
        pointBorderColor    : '#28a745',
        pointBackgroundColor: '#28a745',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
        {
          type                : 'line',
          data                : <?= "['" . implode("', '", array_column($iechart, 'expense')) . "']" ?>,
          backgroundColor     : 'tansparent',
          borderColor         : '#dc3545',
          pointBorderColor    : '#dc3545',
          pointBackgroundColor: '#dc3545',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })

</script> <?php } ?> -->

<script>
   // Windy API key
   const WINDY_API_KEY = "w4MQrAJ7s06EGyMTtzSbPFRuw5ORcJyv";

   // Store markers in an array so we can remove them before updating
   let markers = [];
   var vessel_location;

   // Function to generate random coordinates (for testing)
   function getRandomCoords() {
      let lat = 18 + Math.random() * 10; // Between 18 and 28
      let lon = 75 + Math.random() * 10; // Between 75 and 85
      return [lat, lon];
   }

   function get_safety() {
      $.ajax({
         url: "<?= base_url() ?>reports/get_pms_all",
         method: "GET",
         success: (res) => {
            var data = JSON.parse(res);
            var report_safety = document.getElementById("safety_overview");

            report_safety.innerHTML = `
                    <div>
                        <img src="<?= base_url(); ?>${data[0].file_path}" width="100%" height="660px"/>
                    </div>
                `;
            return res;
         },
         error: function(xhr, status, error) {}
      })
   }

   $(document).ready(function() {
      get_safety();
   });

   // Initialize Windy Map
   windyInit({
         key: WINDY_API_KEY,
         lat: 13.406105629697434,
         lon: 100.91933242591432,
         zoom: 6,
         mobileUI: "fullscreen",
      },
      (windyAPI) => {
         const {
            map
         } = windyAPI; // Get Leaflet instance from Windy API
         map.addControl(new L.Control.Fullscreen());
         map.invalidateSize();


         async function map_location() {
            removeAllMarkers();
            vessel_location = await getData_location();
            vessel_location.map((item) => {
               item.latitude = parseFloat(item.latitude).toFixed(5);
               item.longitude = parseFloat(item.longitude).toFixed(5);
               const Bearing = calculateHeading(item.latlng[1].latitude, item.latlng[1].longitude, item.latlng[0].latitude, item.latlng[0].longitude);
               const speed = calculateSpeedKnots(item.latlng[1].latitude, item.latlng[1].longitude, new Date(item.latlng[1].timestamp), item.latlng[0].latitude, item.latlng[0].longitude, new Date(item.latlng[0].timestamp));
               const index_head = (Bearing / 45).toFixed(0) <= 7 ? (Bearing / 45).toFixed(0) : 0;
               const time = new Date(item.timestamp);
               const gmtplus = new Date(time.getTime() + (7 * 60 * 60 * 1000)).toISOString();
               update_location(item.latitude, item.longitude, item.esnName, item.esn, index_head, speed, Bearing, gmtplus);
            })
         }

         async function getData_location() {
            var data = await $.ajax({
               url: "<?= base_url() ?>api/get_vessel_location",
               method: "GET",
               success: (res) => {
                  return res;
               },
               error: function(xhr, status, error) {}
            })
            return data;
         }

         async function ChangeData() {
            var change_location = await getData_location();
            var checked = 0;
            for (var i = 0; i < change_location.length; i++) {
               if (change_location[i].id != vessel_location[i].id && change_location[i].esnName == vessel_location[i].esnName) {
                  checked = 1;
                  break;
               }
            }
            if (checked == 1) {
               map_location();
            }
         }

         function update_location(lat, lng, esnName, esn, index_head, speed, Bearing, timestamp) {
            const heading = ["N", "NE", "E", "SE", "S", "SW", "W", "NW"]
            const svgCode = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 14 14" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                            <g transform="rotate(${Bearing},7,7)">
                            <path d="M4.784,13.635c0,0 -0.106,-2.924 0.006,-4.379c0.115,-1.502 0.318,-3.151 0.686,-4.632c0.163,-0.654 0.45,-1.623 0.755,-2.44c0.202,-0.54 0.407,-1.021 0.554,-1.352c0.038,-0.085 0.122,-0.139 0.215,-0.139c0.092,0 0.176,0.054 0.214,0.139c0.151,0.342 0.361,0.835 0.555,1.352c0.305,0.817 0.592,1.786 0.755,2.44c0.368,1.481 0.571,3.13 0.686,4.632c0.112,1.455 0.006,4.379 0.006,4.379l-4.432,0Z" style="fill:rgb(0,46,252);"/><path d="M5.481,12.731c0,0 -0.073,-3.048 0.003,-4.22c0.06,-0.909 0.886,-3.522 1.293,-4.764c0.03,-0.098 0.121,-0.165 0.223,-0.165c0.103,0 0.193,0.067 0.224,0.164c0.406,1.243 1.232,3.856 1.292,4.765c0.076,1.172 0.003,4.22 0.003,4.22l-3.038,0Z" style="fill:#ffffff;fill-opacity:0.846008;"/>
                            </g>
                            </svg>`;
            const svgDataUri = 'data:image/svg+xml;utf8,' + encodeURIComponent(svgCode);
            var myLogoIcon = L.icon({
               // iconUrl: 'data:image/svg+xml;utf8,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20standalone%3D%22no%22%3F%3E%0A%20%20%20%20%20%20%20%20%3C!DOCTYPE%20svg%20PUBLIC%20%22-%2F%2FW3C%2F%2FDTD%20SVG%201.1%2F%2FEN%22%20%22http%3A%2F%2Fwww.w3.org%2FGraphics%2FSVG%2F1.1%2FDTD%2Fsvg11.dtd%22%3E%0A%20%20%20%20%20%20%20%20%3Csvg%20width%3D%22100%25%22%20height%3D%22100%25%22%20viewBox%3D%220%200%2014%2014%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20xml%3Aspace%3D%22preserve%22%20style%3D%22fill-rule%3Aevenodd%3Bclip-rule%3Aevenodd%3Bstroke-linejoin%3Around%3Bstroke-miterlimit%3A1.41421%3B%22%3E%0A%20%20%20%20%20%20%20%20%3Cg%20transform%3D%22rotate(243%2C%207%2C%207)%22%3E%20%3C!--%20Add%20rotation%20here%20--%3E%0A%20%20%20%20%20%20%20%20%3Cpath%20d%3D%22M4.784%2C13.635c0%2C0%20-0.106%2C-2.924%200.006%2C-4.379c0.115%2C-1.502%200.318%2C-3.151%200.686%2C-4.632c0.163%2C-0.654%200.45%2C-1.623%200.755%2C-2.44c0.202%2C-0.54%200.407%2C-1.021%200.554%2C-1.352c0.038%2C-0.085%200.122%2C-0.139%200.215%2C-0.139c0.092%2C0%200.176%2C0.054%200.214%2C0.139c0.151%2C0.342%200.361%2C0.835%200.555%2C1.352c0.305%2C0.817%200.592%2C1.786%200.755%2C2.44c0.368%2C1.481%200.571%2C3.13%200.686%2C4.632c0.112%2C1.455%200.006%2C4.379%200.006%2C4.379l-4.432%2C0Z%22%20style%3D%22fill%3Argb(0%2C46%2C252)%3B%22%2F%3E%3Cpath%20d%3D%22M5.481%2C12.731c0%2C0%20-0.073%2C-3.048%200.003%2C-4.22c0.06%2C-0.909%200.886%2C-3.522%201.293%2C-4.764c0.03%2C-0.098%200.121%2C-0.165%200.223%2C-0.165c0.103%2C0%200.193%2C0.067%200.224%2C0.164c0.406%2C1.243%201.232%2C3.856%201.292%2C4.765c0.076%2C1.172%200.003%2C4.22%200.003%2C4.22l-3.038%2C0Z%22%20style%3D%22fill%3A%23ffffff%3Bfill-opacity%3A0.846008%3B%22%2F%3E%0A%20%20%20%20%20%20%20%20%3C%2Fg%3E%20%20%3C%2Fsvg%3E', // Replace with your logo URL
               iconUrl: svgDataUri,
               iconSize: [32, 32],
               iconAnchor: [16, 32],
               popupAnchor: [0, -32]
            });

            if (markers[esn]) {
               // Update the existing marker
               markers[esn].setLatLng([lat, lng]);
               markers[esn].setIcon(myLogoIcon);
               markers[esn].setPopupContent(`<table>
                                <tr>
                                    <td>ESN [${esn}]</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table>
                                        <tr>
                                            <th>Latitude</th>
                                            <td>${parseFloat(lat).toFixed(5)}</td>
                                        </tr>
                                        <tr>
                                            <th>Longitude</th>
                                            <td>${parseFloat(lng).toFixed(5)}</td>
                                        </tr>
                                        <tr>
                                            <th>Heading</th>
                                            <td>${heading[index_head]}</td>
                                        </tr>
                                        <tr>
                                            <th>Speed</th>
                                            <td>${speed.toFixed(5)} Knot</td>
                                        </tr>
                                        <tr>
                                            <th>Bearing</th>
                                            <td>${Bearing.toFixed(2)} ํ</td>
                                        </tr>
                                        <tr>
                                            <th>TimeStamp</th>
                                            <td>${timestamp} ํ</td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>`); // Update popup content
            } else {
               var marker = L.marker([lat, lng], {
                     icon: myLogoIcon
                  }).addTo(map)
                  .bindTooltip(esnName, {
                     permanent: true, // Make the tooltip always visible
                     direction: 'bottom', // Adjust direction as needed
                     offset: L.point(0, -10), // Adjust offset as needed
                     className: 'my-permanent-tooltip' // Optional: Add a custom CSS class
                  }).bindPopup(`<table>
                                <tr>
                                    <td>ESN [${esn}]</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table>
                                        <tr>
                                            <th>Latitude</th>
                                            <td>${parseFloat(lat).toFixed(5)}</td>
                                        </tr>
                                        <tr>
                                            <th>Longitude</th>
                                            <td>${parseFloat(lng).toFixed(5)}</td>
                                        </tr>
                                        <tr>
                                            <th>Heading</th>
                                            <td>${heading[index_head]}</td>
                                        </tr>
                                        <tr>
                                            <th>Speed</th>
                                            <td>${speed.toFixed(5)} Knot</td>
                                        </tr>
                                        <tr>
                                            <th>Bearing</th>
                                            <td>${Bearing.toFixed(2)} ํ</td>
                                        </tr>
                                        <tr>
                                            <th>TimeStamp</th>
                                            <td>${timestamp} ํ</td>
                                        </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>`); // Keep bindPopup here!;

               marker.on('click', function(event) {
                  event.target.openPopup();
               })

               markers[esn] = marker; // Store the marker using esn as the key

            }
         }

         function removeAllMarkers() {
            for (var key in markers) {
               map.removeLayer(markers[key]);
            }
            markers = {}; // Clear the markers object
         }


         map_location();
         setInterval(ChangeData, 30000); // 5000 milliseconds = 5 seconds

         // Set Windy overlay (e.g., Wind Layer)
         windyAPI.store.set("overlay", "wind");
      }
   );
</script>