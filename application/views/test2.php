<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split Landing Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* พื้นหลัง */
        body {
            background: url('<?=base_url()?>assets/image/bg-first.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
        }

        /* คอนเทนเนอร์หลัก */
        .container {
            width: 100%;
            display: flex;
        }

        /* แบ่งหน้าจอซ้าย-ขวา */
        .panel {
            width: 50%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            color: white;
            text-align: center;
        }

        /* Overlay สี */
        .left {
            background: rgba(0, 0, 0, 0.6); /* ดำโปร่งใส */
        }

        .right {
            background: rgba(0, 0, 0, 0.6); /* ดำโปร่งใส */
        }

        /* สไตล์ปุ่ม */
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* ข้อความ */
        h1 {
            font-size: 50px;
            font-weight: bold;
        }

        p {
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- ฝั่งซ้าย -->
        <div class="panel left">
            <div>
                <h1>SCM</h1>
                <p>SC Management</p>
                <button class="btn">Visit</button>
            </div>
        </div>

        <!-- ฝั่งขวา -->
        <div class="panel right">
            <div>
                <h1>SCO</h1>
                <p>SC Offshore</p>
                <button class="btn">Visit</button>
            </div>
        </div>
    </div>

</body>
</html>
