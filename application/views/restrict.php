<div id="map" style="width: 100%; height: 820px"></div>

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

    var map = L.map('map').setView([13.6499, 100.5843], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    map.addControl(new L.Control.Fullscreen());

    var marker;
    var markers = {};
    var restrict = {};
    var circle;
    const restrictedAreas = []; // Store restricted area circles
    var restrict_location;
    var vessel_location;

    $(document).ready(function() {
        map_plot_location('start');
        setInterval(ChangeData, 60000);
    })

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
            map_plot_location('change');
        }
    }

    async function map_plot_location(setting) {
        restrict_location = await getRestrict_location();
        vessel_location = await getData_location();

        if (setting == 'start') {
            if (restrict_location.length > 0) {
                restrict_location.forEach((location) => {
                    addrestrict(location.res_lat, location.res_lng, location.res_radius, location.res_name, location.res_vehiclename);
                });
            }
            if (vessel_location.length > 0) {
                removeAllMarkers();
                vessel_location.map((item) => {
                    item.latitude = parseFloat(item.latitude).toFixed(5);
                    item.longitude = parseFloat(item.longitude).toFixed(5);
                    const Bearing = calculateHeading(item.latlng[1].latitude, item.latlng[1].longitude, item.latlng[0].latitude, item.latlng[0].longitude);
                    const speed = calculateSpeedKnots(item.latlng[1].latitude, item.latlng[1].longitude, new Date(item.latlng[1].timestamp), item.latlng[0].latitude, item.latlng[0].longitude, new Date(item.latlng[0].timestamp));
                    const index_head = (Bearing / 45).toFixed(0) <= 7 ? (Bearing / 45).toFixed(0) : 0;
                    update_location(item.latitude, item.longitude, item.esnName, item.esn, index_head, speed, Bearing);
                });
            }
        } else {
            if (vessel_location.length > 0) {
                removeAllMarkers();
                vessel_location.map((item) => {
                    item.latitude = parseFloat(item.latitude).toFixed(5);
                    item.longitude = parseFloat(item.longitude).toFixed(5);
                    const Bearing = calculateHeading(item.latlng[1].latitude, item.latlng[1].longitude, item.latlng[0].latitude, item.latlng[0].longitude);
                    const speed = calculateSpeedKnots(item.latlng[1].latitude, item.latlng[1].longitude, new Date(item.latlng[1].timestamp), item.latlng[0].latitude, item.latlng[0].longitude, new Date(item.latlng[0].timestamp));
                    const index_head = (Bearing / 45).toFixed(0) <= 7 ? (Bearing / 45).toFixed(0) : 0;
                    update_location(item.latitude, item.longitude, item.esnName, item.esn, index_head, speed, Bearing);
                });
            }
        }
    }

    async function getData_location() {
        var data = await $.ajax({
            url: "<?= base_url() ?>api/get_vessel_location",
            method: "GET",
            success: (res) => {
                return res;
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
                console.log("Response:", xhr.responseText); // Check the full error response
                // Handle the error
            }
        })
        return data;
    }

    async function getRestrict_location() {
        var data = await $.ajax({
            url: "<?= base_url() ?>api/get_restrict_location",
            method: "GET",
            success: (res) => {
                return res;
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
                console.log("Response:", xhr.responseText); // Check the full error response
                // Handle the error
            }
        })
        return data;
    }

    function addrestrict(lat, lng, radiusNMI, name, vehicle_name) {
        if (!restrict[name]) {

            marker = L.marker([lat, lng], {}).addTo(map).bindTooltip(name, {
                permanent: true, // Make the tooltip always visible
                direction: 'bottom', // Adjust direction as needed
                offset: L.point(-15, 20), // Adjust offset as needed
                className: 'my-permanent-tooltip' // Optional: Add a custom CSS class
            }); // Use custom icon
            const radiusMeters = radiusNMI * 1852;
            circle = L.circle([lat, lng], {
                radius: radiusMeters,
                color: "green",
                fillColor: "green",
                fillOpacity: 0.5
            }).addTo(map);

            marker.bindPopup(`Radius: ${radiusNMI} NMI`);

            restrict[name] = marker;

            restrictedAreas.push({
                circle,
                lat,
                lng,
                radiusNMI,
                name,
                vehicle_name
            }); // Store the circle and its data
        }

    }

    function update_location(lat, lng, esnName, esn, index_head, speed, Bearing) {
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
                                        </table>
                                    </td>
                                </tr>
                            </table>`); // Keep bindPopup here!;

            marker.on('click', function(event) {
                event.target.openPopup();
            })

            const vesselPoint = turf.point([lng, lat]); // Note: turf.js uses [lng, lat]

            restrictedAreas.forEach((area, index) => {
                const poiCircle = turf.circle([area.lng, area.lat], area.radiusNMI * 1852, {
                    units: 'meters'
                });
                if (turf.booleanPointInPolygon(vesselPoint, poiCircle)) {
                    var check_vevehicle_name = area.vehicle_name.split(', ');
                    if (!check_vevehicle_name.includes(esnName)) {
                        area.circle.setStyle({
                            color: 'red',
                            fillColor: 'red'
                        });
                        alert(`Vessel: ${esnName} is in restricted area: ${area.name}`);
                    }
                }
            });

            markers[esn] = marker; // Store the marker using esn as the key
            console.log("Update Marker Successfully")


        }
    }

    function removeAllMarkers() {
        for (var key in markers) {
            map.removeLayer(markers[key]);
        }
        markers = {}; // Clear the markers object
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