<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục sản phẩm</title>
    <style>
       /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
            color: #333;
        }

        /* Header styling */
        h2 {
            background-color: #770000;
            color: white;
            text-align: center;
            padding: 15px;
            margin: 0;
            border-radius: 5px 5px 0 0;
        }

        /* Container styling */
        div {
            padding: 10px;
        }

        /* Sidebar (Left) styling */
        .left {
            float: left;
            width: 25%;
            background-color: #fff;
            border-right: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .left ul {
            list-style: none;
            padding: 0;
        }

        .left li {
            margin-bottom: 10px;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9fafb;
            border: 1px solid #ddd;
            font-weight: bold;
            color: #770000;
        }

        .left li a {
            text-decoration: none;
            color: #770000;
            font-size: 14px;
        }

        .left li:hover {
            background-color: #770000;
            color: white;
            cursor: pointer;
        }

        .left li:hover a {
            color: white;
        }

        /* Main content (Right) styling */
        .right {
            float: left;
            width: 70%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Form input styling */
        .right div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #770000;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            background-color: #770000;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #a50000;
        }

        a {
            text-decoration: none;
            color: #770000;
            font-size: 14px;
            font-weight: bold;
            margin-left: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Footer styling */
        div:last-child {
            text-align: center;
            font-size: 12px;
            color: #770000;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <?php
        session_start();
        include_once("../db.php");

        if (!$conn) {
            die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
        }

        $maloai = ""; 
        $tenloai = ""; 
        $mota = "";

        if ($_SERVER['REQUEST_METHOD'] == "POST") { 
            // Lấy dữ liệu từ form
            $maloai = mysqli_real_escape_string($conn, $_POST["txtma"]);
            $tenloai = mysqli_real_escape_string($conn, $_POST["txttenloai"]);
            $mota = mysqli_real_escape_string($conn, $_POST["txtmota"]);

            // Câu lệnh SQL thêm mới
            $sql = "INSERT INTO loaisp (tenloai, mota) VALUES ('$tenloai', '$mota')";
            $kq = $conn->query($sql);

            if ($kq) {
                header("Location: adminhome.php");
            } else {
                echo "Lỗi khi thêm dữ liệu: " . $conn->error;
            }
        } elseif (isset($_GET['id'])) {
            // Lấy dữ liệu để sửa
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM loaisp WHERE maloai = '$id'";
            $kq = $conn->query($sql);

            if ($kq && $kq->num_rows > 0) {
                $row = $kq->fetch_assoc();
                $tenloai = $row["tenloai"];
                $maloai = $id;
                $mota = $row["mota"];
            }
        }
    ?>

    <div>
        <h2>Chào mừng <?php echo htmlspecialchars($_SESSION['user']); ?> đến với trang quản lý sản phẩm</h2>
        <hr>
    </div>

    <div class="left">
        <ul>
            <li style="text-align: center; font-weight: bold;">Danh mục</li>
            <li>
                <a href="adminhome.php">Quản lý danh mục sản phẩm</a>
            </li>
            <li>
                <a href="adminproduct.php">Quản lý sản phẩm</a>
            </li>
        </ul>
    </div>

    <div class="right">
        <form method="POST" action="">
            <div>
                <label for="txtma">Mã loại</label>
                <input type="text" name="txtma" id="txtma" value="<?php echo htmlspecialchars($maloai); ?>">
            </div>
            <div>
                <label for="txttenloai">Tên loại</label>
                <input type="text" name="txttenloai" id="txttenloai" value="<?php echo htmlspecialchars($tenloai); ?>">
            </div>
            <div>
                <label for="txtmota">Mô tả</label>
                <input type="text" name="txtmota" id="txtmota" value="<?php echo htmlspecialchars($mota); ?>">
            </div>
            <div>
                <input type="submit" value="Thêm">
                <a href="adminhome.php">Quay về</a>
            </div>
        </form>
    </div>

    <div>
        <hr>
        <p>Copyright @2024 - Đặng Nhật Bảo</p>
    </div>
</body>
</html>
