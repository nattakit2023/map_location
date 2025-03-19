<?php
function activate_menu($controller)
{
    $CI = get_instance();
    $last = $CI->uri->total_segments();
    $seg = $CI->uri->segment($last);
    if (is_numeric($seg)) {
        $seg = $CI->uri->segment($last - 1);
    }
    if (in_array($controller, array($seg))) {
        return 'active';
    } else {
        return '';
    }
}
if (!isset($this->session->userdata['session_data'])) {
    $url = base_url() . 'login';
    header("location: $url");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php
            $data = sitedata();
            $total_segments = $this->uri->total_segments();
            echo ucwords(str_replace('_', ' ', $this->uri->segment(1))) . ' | ' . output($data['s_companyname']) ?>
    </title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/toast/toast.min.css" />
    <script src="<?= base_url(); ?>assets/plugins/toast/toast.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Load Leaflet 1.4.0 (Required for Windy API) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"></script>
    <script src="https://api.windy.com/assets/map-forecast/libBoot.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
    <script src="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js"></script>

    <style>
        :where(#map-container) {
            z-index: 0;
        }

        :where(#logo-wrapper, #plugin-menu, #windy, #bottom, #embed-zoom, #mobile-ovr-select) {
            z-index: 1000;
        }

        .square-marker {
            width: 5px;
            /* Adjust size as needed */
            height: 5px;
            /* Adjust size as needed */
            border-radius: 50%;
            /* Makes the square a circle */
            background-color: blue;
            /* Or any color you want */
            border: 1px solid darkblue;
            /* Optional border */
            index: 0;
        }

        .arrow {
            width: 30px;
            height: 30px;
            background-size: contain;
            background-image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0A…oy3ty3TZVLaCC2rRxru/hPwVgtEdFK5vOAAAAAElFTkSuQmCC';
            background-position: center;
            background-repeat: no-repeat;
        }

        .custom-slider {
            width: 600px;
            /* Adjust as needed */
            margin: 20px auto;
            font-family: sans-serif;
        }

        .slider-bar {
            position: relative;
            width: 100%;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background-color: #3f51b5;
            /* Blue progress color */
            border-radius: 5px;
            width: 0%;
            /* Initial progress */
            transition: width 0.2s ease;
        }

        .slider-handle {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translate(50%, -50%);
            width: 20px;
            height: 20px;
            background-color: #3f51b5;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .controls button,
        .playback-speed {
            padding: 8px 12px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .timestamp {
            text-align: center;
            margin-top: 5px;
            font-size: 0.9em;
            color: #555;
        }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <input type="hidden" id="base" value="<?php echo base_url(); ?>">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto" style="display: flex;align-items: center;justify-content: center;">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="material-symbols-outlined">
                            notifications
                        </i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <span class="dropdown-item dropdown-header">Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">aaa</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li>

                    <a href="#" class="nav-item">
                        <h5 style="color: rgba(0,0,0,0.8); font-size: 1rem; margin-bottom: 0"><?php echo ucfirst(output($this->session->userdata['session_data']['name'])); ?></h5>
                    </a>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>login/logout">
                        <span class="material-symbols-outlined">
                            power_settings_new
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->