<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SC Group</title>
    <link href="https://fonts.cdnfonts.com/css/general-sans" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        body {
            width: 100%;
            height: 100vh;
            font-family: 'General Sans', sans-serif;
            margin: 0px;
        }

        .img {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .content {
            position: absolute;
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
        }

        .content-center {
            color: white;
            z-index: 1000;
        }

        .split-container {
            position: absolute;
            display: block;
            /* Use flexbox for easy side-by-side layout */
            width: 100%;

            height: 100vh;
            /* Make it full viewport height */
        }

        .split-section {
            color: white;
            height: 100vh;

        }


        .split-section.left {
            position: absolute;
            width: 100%;
            clip-path: polygon(0 0, 55% 0, 45% 100%, 0% 100%);
            background: rgba(3, 56, 85, 0.4);
            z-index: 1000;
        }

        .split-section.right {
            position: absolute;
            width: 100%;
            clip-path: polygon(45% 100%, 55% 0%, 100% 0%, 100% 100%);
            background: rgba(0, 0, 0, 0.4);
            z-index: 1000;

        }

        .content-left {
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .content-right {
            width: 50%;
            height: 100%;
            float: right;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 0px;
            margin-block-start: 0;
            margin-block-end: 0;
        }

        .title .image {
            display: flex;
            justify-content: center;
            width: 100%;
            height: 150px;
        }

        h2 {
            font-size: 88px;
            font-weight: bold;
            margin-bottom: 0px;
            display: flex;
            margin-block-start: 0;
            margin-block-end: 0;
            line-height: 0.6;
            justify-content: center;
        }

        p {
            font-size: 48px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        footer {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: left;
            align-items: end;
        }

        footer p {
            color: white;
            font-size: 12px;
            font-weight: 400;
            text-align: center;
            margin-top: 0;
            margin-bottom: 10px;
        }

        footer span {
            color: white;
            font-size: 14px;
            font-weight: 600;
        }

        .button {
            display: flex;
            justify-content: center;
        }

        .submit {
            display: inline-block;
            background-color: #007bff;
            border: 1px solid #eeeeee;
            /* Example button color */
            color: white;
            padding: 5px 50px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 5px;
            z-index: 5;
        }

        .button:hover {
            color: white;
        }
    </style>
</head>

<body>
    <div class="img">
        <img src="<?= base_url() ?>assets/image/bg-first-2.jpg" width="100%" height="100%" style="position:absolute">
        <div class="split-container">
            <div class="split-section left">
            </div>
            <div class="split-section right">
            </div>
            <div class="content">
                <div class="content-center">
                    <div class="title">
                        <span class="image">
                            <img src="https://www.scgroupthai.com/images/client/scm.png">
                        </span>
                        <p>SC Management Co.,Ltd.</p>
                        <span class="button">
                            <a href="<?= base_url() ?>/login" class="submit">Visit</a>
                        </span>
                    </div>
                </div>
            </div>
            <footer>
                <p>&copy; 2021 SCM and all rights reserved. </p>
                <p> Designed by <span>Ship Expert</span>.</p>
                <p>Version 1.0</p>
            </footer>
        </div>
    </div>

</body>

</html>