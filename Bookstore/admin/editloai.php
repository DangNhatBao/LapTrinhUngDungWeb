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
    <form action="editloai.php" method = "post">
        <?php
            session_start();
            include_once("../db.php")
        ?>
        <div>
            <h2>Chào mừng <?php echo $_SESSION['user']; ?> đến với trang quản lý sản phẩm</h2>
            <hr>
        </div>

        <div>
            <div class = "left">
                <ul>
                    <li style = "text-align: center; font-weight: bold;">Danh mục</li>
                    <li>
                        <a href="adminhome.php">Quản lý danh mục sản phẩm</a>
                    </li>
                    <li>
                        <a href="adminproduct.php">Quản lý sản phẩm</a>
                    </li>
                </ul>
            </div>
            <div class= "right">
            <?php
                $maloai = ""; $tenloai = ""; $mota = "";
                if ( $_SERVER['REQUEST_METHOD'] == "POST" ){ // Khi người dùng bấm nút lưu
                    $maloai = $_POST["txtma"];
                    $tenloai = $_POST["txttenloai"];
                    $mota = $_POST["txtmota"];
                    //Viết câu lệnh update
                    $sql = " update loaisp set tenloai = '{$tenloai}', mota= '{$mota}' where maloai ={$maloai} ";
                    // echo $sql
                    $kq = $conn -> query($sql);
                    if ($kq) {header("Location:adminhome.php");}
                    else echo "Update error ";

                } else { // Khi load dữ liệu lên cho người dùng nhìn thấy
                    $id = $_GET['id']??null;
                    if ($id != null){
                        $sql = "select * from loaisp where maloai ={$id}";
                        $kq = $conn -> query ($sql); // thực hiện query 
                        $row = $kq ->fetch_assoc();
                        $tenloai = $row["tenloai"];
                        $maloai = $id;
                        $mota = $row["mota"]; 
                    }
                } 
            
            ?>
            <div>
                <label for="">Mã loại</label>
                <input type="text" name="txtma" id="txtma" readonly value= " <?php echo $maloai ?>">
            </div>
            <div>
                <label for="">Tên loại</label>
                <input type="text" name="txttenloai" id="txttenloai" value= "<?php echo $tenloai ?>">
            </div>
                <label for="">Mô tả</label>
                <input type="text" name="txtmota" id="txtmota" value= "<?php echo $mota ?>">
            </div>
            <div>
                <input type="submit" value="Lưu">
                <a href="adminhome.php">Quay về</a>
            </div>
        </div>

        <div>
            <hr>
            copyright @2024 - Đặng Nhật Bảo
        </div>
    </form>
</body>
</html>