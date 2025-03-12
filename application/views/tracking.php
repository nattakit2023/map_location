       <div class="content-header">
          <div class="container-fluid">
             <!-- Main content -->
             <section class="content">
                <div class="container-fluid">
                   <div class="row">
                      <div class="col-lg-7 col-md-7">
                         <div class="card rounded-0">
                            <!-- <div class="card-header">

                            </div> -->
                            <div class="card-body">
                               <div class="row" style="margin-left: 0.5rem;margin-bottom: 1rem;">
                                  <h5 class="card-title" style="display:flex;align-items: center;font-weight: 600;">
                                     <span class="material-symbols-outlined" style="color:rgb(110, 178, 255)">
                                        near_me
                                     </span> History Tracking Map
                                  </h5>
                               </div>
                               <div class="row">
                                  <div class="col-md-12">
                                     <div id="map" style="width: 100%; height: 550px"></div>
                                  </div>
                                  <div class="col-md-12" style="margin-top: 10px;" id="tab-slider" hidden>
                                     <div class="custom-slider">
                                        <div class="slidecontainer">
                                           <input type="range" class="slider" id="myRange" style="width: 100%;" oninput="changeValueSlider()">
                                           <div class="timestamp" id="timestamp"></div>
                                        </div>
                                        <div class="controls">
                                           <div>
                                              <button class="skip-back">
                                                 << </button>
                                                    <button class="step-back"> |<< </button>
                                           </div>
                                           <div>
                                              <i class='fas fa-play'></i>
                                           </div>
                                           <div>
                                              <button class="step-forward">>>|</button>
                                              <button class="skip-forward">>></button>
                                              <select class="playback-speed">
                                                 <option value="1">1x</option>
                                                 <option value="1.5">1.5x</option>
                                                 <option value="2">2x</option>
                                              </select>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>

                      <div class="col-lg-5 col-md-5">
                         <div class="card">
                            <div class="card-header">
                               <div class="row col-md-12">
                                  <div class="col-md-3">
                                     <div class="form-group">
                                        <input type="text" required="true" name="fromdate" id="fromdate" class="form-control datepicker" placeholder="From Date">
                                     </div>
                                  </div>
                                  <div class="col-md-3">
                                     <div class="form-group">
                                        <input type="text" required="true" name="todate" id="todate" class="form-control datepicker" placeholder="To Date">
                                     </div>
                                  </div>
                                  <div class="col-md-5">
                                     <div class="form-group">
                                        <select id="t_vechicle" required="true" class="form-control selectized" name="t_vechicle">
                                           <option value="">Select Vessel</option>
                                           <?php foreach ($vechiclelist_from_sc as $key => $vechiclelists) { ?>
                                              <option value="<?php echo output($vechiclelists['esn']) ?>"><?php echo output($vechiclelists['esnName']) ?></option>
                                           <?php  } ?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-md-1">
                                     <div class="form-group">
                                        <button id="history_tracking" class="btn btn-primary">Load</button>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="card-body" id="showTable">
                            </div>

                         </div>
                      </div>
                   </div>
                </div>
          </div>
          </section>
          <!-- /.content -->

          <script>
             var data_from_get;
             var tmpvalue = 0;
             var markers = {}; // Array to store markers

             const svgCode = `<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                              <circle cx="50" cy="50" r="45" fill="blue" />
                              <polygon points="50,25 75,75 25,75" fill="white" />
                              </svg>`;
             const svgDataUri = 'data:image/svg+xml;utf8,' + encodeURIComponent(svgCode);

             var main_logo = L.icon({
                iconUrl: svgDataUri,
                iconSize: [30, 30], // Adjust size as needed
                iconAnchor: [15, 15], // Adjust anchor point
             });


             var second_logo = L.divIcon({
                className: 'square-marker',
                iconSize: [6, 6], // Size of the icon
                iconAnchor: [3, 3] // Anchor point (center of the icon)
             });

             var map = L.map('map').setView([13.6499, 100.5843], 5);
             // Add a tile layer
             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
             map.addControl(new L.Control.Fullscreen());

             function changeValueSlider() {
                let value = document.getElementById('myRange').value;
                if (value != tmpvalue) {
                   document.getElementById('timestamp').innerHTML = new Date(data_from_get[value].timestamp);
                }
                console.log(value, tmpvalue);
                //  const Bearing = calculateHeading(data_from_get[value + 1].latitude, data_from_get[value + 1].longitude, data_from_get[value].latitude, data_from_get[value].longitude);
                //  const Speed = calculateSpeedKnots(data_from_get[value].latitude, data_from_get[value].longitude, new Date(data_from_get[value].timestamp), data_from_get[value + 1].latitude, data_from_get[value + 1].longitude, new Date(data_from_get[value + 1].timestamp));

                //  main_logo = L.icon({
                //     iconUrl: svgDataUri,
                //     iconSize: [30, 30], // Adjust size as needed
                //     iconAnchor: [15, 15], // Adjust anchor point
                //  });

                //  second_logo = L.divIcon({
                //     className: 'square-marker',
                //     iconSize: [6, 6], // Size of the icon
                //     iconAnchor: [3, 3] // Anchor point (center of the icon)
                //  });

                map.removeLayer(markers[value]);
                map.removeLayer(markers[tmpvalue]);

                marker = L.marker([data_from_get[value].latitude, data_from_get[value].longitude], {
                      icon: main_logo
                   })
                   .addTo(map)
                   .bindPopup(`Point ${parseInt(value) + 1}`)

                markers[value] = marker;

                marker = L.marker([data_from_get[tmpvalue].latitude, data_from_get[tmpvalue].longitude], {
                      icon: second_logo
                   })
                   .addTo(map)
                   .bindPopup(`Point ${parseInt(tmpvalue) +1}`)

                markers[tmpvalue] = marker;

                tmpvalue = value;


             }

             function loadHistory() {
                removeAllMarkers();
                document.getElementById('timestamp').innerHTML = new Date(data_from_get[0].timestamp);

                const latlngs = data_from_get.map(item => L.latLng(item.latitude, item.longitude));
                // Display history as a polyline
                const polyline = L.polyline(latlngs, {
                   color: 'blue',
                   weight: 2,
                   opacity: 0.5,
                   smoothFactor: 1
                }).addTo(map);

                // Add markers at each point
                var marker;


                data_from_get.forEach((value, index) => {
                   index === 0 ?
                      marker = L.marker([value.latitude, value.longitude], {
                         icon: main_logo
                      })
                      .addTo(map)
                      .bindPopup(`Point ${index + 1}`) :
                      marker = L.marker([value.latitude, value.longitude], {
                         icon: second_logo
                      })
                      .addTo(map)
                      .bindPopup(`Point ${index + 1}`);

                   markers[index] = marker; // Store the marker using esn as the key
                });

                console.log("SUCCESS")
             }

             function removeAllMarkers() {
                for (var key in markers) {
                   map.removeLayer(markers[key]);
                }
                markers = {}; // Clear the markers object
             }

             //  function createTable(data, columns) {
             //     const tableContainer = document.getElementById('triptbl');
             //     tableContainer.innerHTML = '';
             //     // Create the table element
             //     const table = document.getElementById('triptbl');

             //     const thead = document.createElement('thead');
             //     table.appendChild(thead);

             //     const tbody = document.createElement('tbody');
             //     table.appendChild(tbody);

             //     // Create the table header
             //     const headerRow = document.createElement('tr');
             //     columns.forEach(column => {
             //        const headerCell = document.createElement('th');
             //        headerCell.textContent = column;
             //        headerRow.appendChild(headerCell);
             //     });
             //     thead.appendChild(headerRow);

             //     data.forEach(row => {
             //        const tableRow = document.createElement('tr');
             //        columns.forEach(column => {
             //           const tableCell = document.createElement('td');
             //           tableCell.textContent = row[column];
             //           tableRow.appendChild(tableCell);
             //        });
             //        tbody.appendChild(tableRow);
             //     });

             //  }
          </script>