<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            padding: 30px 20px;
            text-align: center;
        }

        form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        form div {
            margin-bottom: 15px;
            text-align: left;
        }

        form label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
            color: #555;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="password"]:focus {
            border-color: #770000;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        form input[type="submit"],
        form input[type="reset"] {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
            color: #fff;
            transition: background-color 0.3s;
        }

        form input[type="submit"] {
            background-color: #770000;
        }

        form input[type="reset"] {
            background-color: #770000;
        }
        form .button-group {
            display: flex;
            justify-content: space-between;
        }

        form p {
            font-size: 12px;
            margin-top: 10px;
            color: #888;
        }
    </style>
</head>
<?php
    include_once('../db.php');
?>
<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $user = $_POST['txtName']; // lay du lieu username
        $pass = $_POST['txtPass']; // lay du lieu pass

        $sql = "select* from users where username=? and pass=?";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("ss", $user, $pass);
        $stmt -> execute();
        $result = $stmt -> get_result();
        if ($result -> num_rows > 0){ //dang nhap thanh cong
            $_SESSION['user'] = $user; // dung bien nay de luu thong tin ten dang nhap
            header("location: adminhome.php");
        }
        else echo "Đăng nhập thất bại";
            $stmt -> close();
            $conn -> close(); // dong ke tnoi
}      
    else {

    }
?>
<body>
    <form action="adminindex.php" method='post'>
        <h2>ĐĂNG NHẬP</h2>
        <div>
            <label for="txtName">Tài khoản</label>
            <input type="text" name="txtName" id="txtName" placeholder="Nhập tài khoản của bạn">
        </div>
        <div>
            <label for="txtPass">Mật khẩu</label>
            <input type="password" name="txtPass" id="txtPass" placeholder="Nhập mật khẩu">
        </div>
        <div class="button-group">
            <input type="submit" value="Đăng nhập">
            <input type="reset" value="Hủy">
        </div>
        <p>Bạn quên mật khẩu? Liên hệ hỗ trợ.</p>
    </form>
</body>
</html>
