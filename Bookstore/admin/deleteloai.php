<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục sản phẩm</title>
</head>
<body>
    <?php
        include_once("../db.php");
        $id = $_GET['id']??null;
        $sql = "delete from loaisp where maloai ={$id}";
        $kq = $conn -> query ($sql);
        echo $sql;
        if ($kq) {header("Location:adminhome.php");}
        else echo "Update error ";
    ?>
</body>
</html>