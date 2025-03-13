<?php
if ($this->uri->segment(3)) {
    $data = $this->uri->segment(3);
} else {
    $data = 0;
}
?>
<section class="content" style="padding: 0.5rem">
    <div class="container-fluid">

        <!-- <script id="group" data-name="<?= $data  ?>" src="<?php echo base_url(); ?>assets/livetrack.js"></script> -->
        <!-- <script src="<?php echo base_url(); ?>assets/fontawesome-markers.min.js"></script> -->

        <div class="col-lg-12 col-md-12" id="map" style="width: 100%; height: 650px;margin-bottom: 50px;"></div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 col-sm-3" style="display: flex;align-items: center;">
                    <label class="form-label text-dark">Select Vessel</label>
                </div>
                <div class="col-md-2 col-sm-4">
                    <select name=" vessel" id="vessel_name" class="form-control">
                        <option value="" selected disabled></option>
                        <?php
                        $groupedData = [];

                        foreach ($camera_name as $item) {
                            if (in_array($item['cameraName'], $groupedData)) {
                                continue;
                            } else {
                                array_push($groupedData, $item["cameraName"]);
                            }
                        }

                        foreach ($groupedData as $name) {
                            echo '<option value="' . $name . '">' . $name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-1 col-sm-4">
                    <button class="btn btn-primary" id="play_video" onclick="get_video('Open')">Update</button>
                </div>
                <div class="col-md-1 col-sm-4">
                    <button class="btn btn-primary" id="stop_video" onclick="get_video('Stop')" disabled>Stop</button>
                </div>
                <input type="text" id="streamSecrtKey" value="" hidden />
            </div>
        </div>
    </div>
</section>

<div id="video-play" style="display: flex; justify-content: center;">
    <div id="playWind"></div>
</div>
</div>
</div>
<script src="<?= base_url(); ?>assets/dist/jsPlugin-1.2.0.min.js"></script>

<script>
    var map = L.map('map').setView([13.6499, 100.5843], 5); // Samrong Nuea coordinates and zoom level
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    map.addControl(new L.Control.Fullscreen());


    var markers = {}; // Array to store markers


    async function map_location() {
        removeAllMarkers();

        var location = await getData_location();

        location.map((item) => {
            item.latitude = parseFloat(item.latitude).toFixed(5);
            item.longitude = parseFloat(item.longitude).toFixed(5);
            const Bearing = calculateHeading(item.latlng[1].latitude, item.latlng[1].longitude, item.latlng[0].latitude, item.latlng[0].longitude);
            const speed = calculateSpeedKnots(item.latlng[1].latitude, item.latlng[1].longitude, new Date(item.latlng[1].timestamp), item.latlng[0].latitude, item.latlng[0].longitude, new Date(item.latlng[0].timestamp));
            const index_head = (Bearing / 45).toFixed(0) <= 7 ? (Bearing / 45).toFixed(0) : 0;
            update_location(item.latitude, item.longitude, item.esnName, item.esn, index_head, speed, Bearing);
        })

    }

    $(document).ready(function() {
        map_location();
        setInterval(map_location, 30000); // 5000 milliseconds = 5 seconds
    })

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

    async function getData_API(value) {

        var data = await $.ajax({
            url: "<?= base_url() ?>api/post_camera_video",
            method: "POST",
            data: {
                data: value
            },
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

    async function get_video(check) {
        var vessel = document.getElementById("vessel_name").value;
        var camera_all = <?= json_encode($camera_name) ?>;
        const camera_index = camera_all.filter(item => item.cameraName === vessel)


        if (vessel == '') {
            return false;
        }
        await getData_API(camera_index).then(response => {
            realplay(check, response)
        });
        // console.log("HI Video");
        // const testWs = new WebSocket("ws://49.231.64.173:559");
        // testWs.onopen = () => console.log("WebSocket connection successful");
        // testWs.onerror = (err) => console.error("WebSocket connection failed:", err);


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


    function realplay(value, data) {
        var iWind = 0;
        var vessel = document.getElementById("vessel_name");

        var streamSecrtKey = document.getElementById("streamSecrtKey").value;
        var url = '',
            playUrl = '';

        let width = 0;
        let height = 0;
        let iWidth = 0;
        let iHeight = 0;
        let iMaxSplit = data.length / 2;
        let iCurrentSplit = 0;

        if (data.length <= 2) {
            width = 1200;
            height = 800;
            iWidth = 1200;
            iHeight = 800;
            iCurrentSplit = 2;

        } else if (data.length <= 4) {
            width = 800;
            height = 400;
            iWidth = 600;
            iHeight = 400;
            iCurrentSplit = 2;
        } else {
            width = 1600;
            height = 800;
            iWidth = 1600;
            iHeight = 1600;
            iCurrentSplit = 4;
        }

        var playwind = document.getElementById("playWind");
        playwind.style.width = `${width}px`;
        playwind.style.height = `${height}px`;

        var jsDecoder = new JSPlugin({
            szId: "playWind",
            iType: 2,
            iWidth: iWidth,
            iHeight: iHeight,
            iMaxSplit: iMaxSplit,
            iCurrentSplit: iCurrentSplit,
            szBasePath: "<?= base_url() ?>assets/dist",
            oStyle: {
                border: "",
                borderSelect: "",
                background: "#4C4B4B"
            }
        });

        if (value == "Open") {
            data.forEach((item) => {
                var tempArr = item.response.data.url.split('/');
                if (tempArr.length > 4) {
                    url = 'ws://' + tempArr[2] + "/" + "001";
                    // url = 'wss://' + "scgroup.shipexpert.info:443/ws" + "/" + "001";
                    // url = 'wss://scgroup.shipexpert.info/ws';
                    playUrl = tempArr[3] + "/" + tempArr[4];
                    // playUrl = "SMSEurl/EQFgAC3qRz%2FcjURYdbepym0xJqho4rencSMPQl8dGY4RPTRR5SXEma1AiNhw7bclBi69XbroMeQ6AyGwFD%2FkcoXz5ZaAicgWKCMkEKbe1ZznvelvhnEF%2FJNncF3OD5vWXi7fb1lmaiur0by4dKUBuj5oEb3XhCWWhTZE%2FsJN13oPzLB7TApwKqYDMJ3yHqTu98821xjAtV5VsjqyF4p1ozS%2FC9YyvoNxKQ6%2F9a2pGDc%2FUxc23opnFrcDBn7T5XzAot2e6vsJl4CBnZhS1We5CtUZnhKUSJtyDDXoQ8J3e%2FCpERJ7CBBzhPbF5UV4MxlW3izQW7pff53UQkzElvE1XGM3EigUvgnbE9kyh%2B%2B1xRGeirBp4TZv14G1v3rSj2a%2BrhxCuKHCHu4oSL4ND6AbNFdMN0PtHH%2F4JOQVZnNLkCb5%2FFK1RXibp2QAjrpv1FwK%2BTePL6XqZRRzQZJ2qdJp1kCYH9PMzEYTZeTg60INi%2BELmFNx%2BmXyk45qHyyF0Ocyy61%2FQA%3D%3D";
                    console.log(url)
                    console.log(playUrl)
                } else {
                    alert("The format of the Preview Url is incorrect.");
                    return;
                }

                if ('' != streamSecrtKey) {
                    jsDecoder.JS_SetSecretKey(iWind, streamSecrtKey);
                }
                jsDecoder.JS_Play(url, {
                    playURL: playUrl,
                    auth: '',
                    token: ''
                }, iWind).then(function() {
                    console.log("realplay success");
                }, function() {
                    console.log("realplay failed");
                });
                iWind++;
            });
            document.getElementById("play_video").disabled = true;
            document.getElementById("stop_video").disabled = false;
            vessel.disabled = true;
        } else {
            playwind.innerHTML = "";
            playwind.style.width = `0px`;
            playwind.style.height = `0px`;
            jsDecoder.JS_StopRealPlayAll();
            document.getElementById("play_video").disabled = false;
            document.getElementById("stop_video").disabled = true;
            vessel.disabled = false;
        }
    }

    // function realplay(value) {
    //     let iWind = 0; // Initialize iWind outside the loop
    //     const vessel = document.getElementById("vessel_name");
    //     const camera_all = <?= json_encode($camera_name) ?>;
    //     const camera_index = camera_all.filter(item => item.cameraName === vessel.value);
    //     const streamSecrtKey = document.getElementById("streamSecrtKey").value;
    //     const playvideo = document.getElementById("video-play");
    //     var url = '',
    //         playUrl = '';


    //     let width = 0;
    //     let height = 0;

    //     if (camera_index.length <= 2) {
    //         width = 1200;
    //         height = 800;
    //     } else if (camera_index.length <= 4) {
    //         width = 600;
    //         height = 400;
    //     } else {
    //         width = 1600;
    //         height = 800;
    //     }

    //     playvideo.innerHTML = ''; // Clear existing video divs (important!)

    //     // camera_index.forEach(async (item, index) => { // Use index for player IDs
    //     const div = document.createElement("div");
    //     div.id = `playWind${1}`; // Use index + 1 for ID (start from 1)
    //     div.style.width = `50%`;
    //     div.style.height = `100%`;
    //     div.style.padding = '10px 10px';
    //     div.style.display = 'flex';
    //     div.style.justifyContent = 'center';
    //     playvideo.append(div);

    //     console.log(`Creating player ${1}`);
    //     var tempArr = camera_index[0].url_web.split('/');
    //     if (tempArr.length > 4) {
    //         url = 'ws://' + tempArr[2] + "/" + "001";
    //         playUrl = tempArr[3] + "/" + tempArr[4];
    //     } else {
    //         alert("The format of the Preview Url is incorrect.");
    //         return;
    //     }

    //     // var jsDecoder = new JSPlugin({
    //     //     szId: `playWind${index + 1}`, // Use index + 1 here as well
    //     //     iType: 2,
    //     //     iWidth: 800,
    //     //     iHeight: 400,
    //     //     iMaxSplit: 1, // Adjust if needed
    //     //     iCurrentSplit: 1, // Adjust if needed
    //     //     szBasePath: "<?= base_url() ?>assets/dist",
    //     //     oStyle: {
    //     //         border: "#fff",
    //     //         borderSelect: "#fff",
    //     //         background: "#fff"
    //     //     }
    //     // });

    //     if (value == "Open") {
    //         decode_video(url, playUrl, streamSecrtKey, 0, iWind)

    //         document.getElementById("play_video").disabled = true;
    //         document.getElementById("stop_video").disabled = false;
    //         vessel.disabled = true;

    //     } else {
    //         document.getElementById("play_video").disabled = false;
    //         document.getElementById("stop_video").disabled = true;
    //         vessel.disabled = false;
    //     }

    //     iWind++; // Increment iWind if you still need it for something else
    //     // });
    // }

    function decode_video(url, playUrl, streamSecrtKey, index, iWind) {
        const playerId = `playWind${index + 1}`; // Store the ID in a variable for consistency

        var jsDecoder = new JSPlugin({
            szId: playerId, // Use index + 1 here as well
            iType: 2,
            iWidth: 800,
            iHeight: 400,
            iMaxSplit: 1, // Adjust if needed
            iCurrentSplit: 1, // Adjust if needed
            szBasePath: "<?= base_url() ?>assets/dist",
            oStyle: {
                border: "#fff",
                borderSelect: "#fff",
                background: "#fff"
            }
        });


        if ('' != streamSecrtKey) {
            jsDecoder.JS_SetSecretKey(playerId, streamSecrtKey); // Use correct ID
        }

        jsDecoder.JS_Play(url, {
            playURL: playUrl,
            auth: '',
            token: ''
        }, playerId).then(function() { // Use correct ID
            console.log(`Player ${index + 1} realplay success`);
        }, function(error) {
            console.error(`Error ${index + 1}: ${error}`);
        });

    }
</script>