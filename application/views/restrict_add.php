<?php $successMessage = $this->session->flashdata('successmessage');
$warningmessage = $this->session->flashdata('warningmessage');
if (isset($successMessage)) {
  echo '<div id="alertmessage" class="col-md-5">
          <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   ' . output($successMessage) . '
                  </div>
          </div>';
}
if (isset($warningmessage)) {
  echo '<div id="alertmessage" class="col-md-5">
          <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   ' . output($warningmessage) . '
                  </div>
          </div>';
}
?>

<div class="card-header">
  <div style="display: none" id="color-palette"></div>
  <div class="row">
    <div class="col-sm-8 col-md-6">
      <h3 class="card-title">
        <div class="form-group row">
          <label for="res_description" class="col-sm-5 col-md-2 col-form-label">Input Address </label>
          <div class="form-group col-sm-7 col-md-4">
            <input id="input-lat" class="form-control" type="text" placeholder="Enter Latitude">
          </div>
          <div class="form-group col-sm-7 col-md-4">
            <input id="input-lng" class="form-control" type="text" placeholder="Enter Longitude">
          </div>
          <div class="form-group col-sm-7 col-md-2">
            <input id="radius" class="form-control" type="text" placeholder="Enter Radius (NMI)">
          </div>
        </div>
      </h3>
    </div>
    <!-- /.col -->
    <div class="form-group col-sm-4 col-md-1" id="removemarker" hidden>
      <button class="btn btn-block btn-outline-danger btn-sm">Remove Marker</button>
    </div>
    <!-- /.col -->
    <div class="form-group col-sm-4 col-md-1" id="addmarker">
      <button class="btn btn-block btn-outline-success btn-sm">Add Marker</button>
    </div>
    <div class="form-group col-sm-4 col-md-1" id="savemarker" hidden>
      <button class="btn btn-block btn-outline-success btn-sm">Save Restrict</button>
    </div>

  </div>
</div>

<div id="map" style="width: 100%; height: 600px"></div>

<div class="modal fade show" id="modal-restrict" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Save Selected Restrict</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="form-group row">
            <label for="res_name" class="col-sm-4 col-form-label">Name</label>
            <div class="form-group col-sm-8">
              <input type="text" class="form-control" name="res_name" id="res_name" required="true" placeholder="Restrict Name">
            </div>
          </div>
          <div class="form-group row">
            <label for="res_description" class="col-sm-4 col-form-label">Description</label>
            <div class="form-group col-sm-8">
              <input type="text" class="form-control" name="res_description" id="res_description" required="true" placeholder="Restrict Description">
            </div>
          </div>
          <div class="form-group row">
            <label for="Cateogry" class="col-sm-4 col-form-label">Vehicle</label>
            <div class="form-group col-sm-8">
              <div class="form-group">
                <select class="select2 select2-hidden-accessible" id="res_vehicles" required="true" name="res_vehicles[]" multiple data-placeholder="Select vehicles" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <?php if (!empty($vehicles)) {
                    foreach ($vehicles as $vehicle) { ?>
                      <option value="<?= $vehicle['v_id']; ?>"><?= $vehicle['v_name']; ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="restrictvaluesave" class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  // const geofencePolygon = {
  //   type: "Polygon",
  //   coordinates: [
  //     [
  //       [100.603, 13.626],
  //       [100.604, 13.627],
  //       [100.605, 13.626],
  //       [100.603, 13.626],
  //     ],
  //   ],
  // };


  var map = L.map('map').setView([13.6499, 100.5843], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
  var marker;
  var circle;

  function addmarker(lat, lng, radiusNMI) {

    console.log("lat", lat)
    console.log("lng", lng)
    console.log("radius", radiusNMI)
    marker = L.marker([lat, lng], {}).addTo(map); // Use custom icon
    const radiusMeters = radiusNMI * 1852;
    circle = L.circle([lat, lng], {
      radius: radiusMeters,
      color: "red",
      fillColor: "red",
      fillOpacity: 0.5
    }).addTo(map);

    marker.on('click', () => {
      map.removeLayer(marker);
      map.removeLayer(circle);
      document.getElementById("removemarker").hidden = true;
      document.getElementById("addmarker").hidden = false;
      document.getElementById("savemarker").hidden = true;

      document.getElementById("input-lat").disabled = false;
      document.getElementById("input-lng").disabled = false;
      document.getElementById("radius").disabled = false;
    });

    marker.bindPopup(`Radius: ${radiusNMI} NMI`);
  }

  function removemarker() {
    map.removeLayer(marker);
    map.removeLayer(circle);
  }

  // // Track user location
  // map.locate({
  //   watch: true,
  //   enableHighAccuracy: true
  // });
  // map.on("locationfound", (e) => {
  //   const userLocation = turf.point([e.longitude, e.latitude]);
  //   const isInside = turf.booleanPointInPolygon(userLocation, geofencePolygon);

  //   if (isInside) {
  //     console.log("User is inside the geofence!");
  //     // Trigger your actions here
  //   } else {
  //     console.log("User is outside the geofence.");
  //   }
  // });

  // map.on("locationerror", (e) => {
  //   console.log("Location error:", e.message);
  // });
</script>