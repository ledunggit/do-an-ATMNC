<?php
    require_once './connect.php';
    if (isset($_POST['sometext'])) {
        try {
            $stmt = $conn->prepare("UPDATE something SET text = ?");
            $data = $_POST['sometext'];
            $stmt->bind_param('s', $data);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    if (isset($_POST['search'])) {
        try {
            $data = $_POST['search'];
            $sql = "SELECT * FROM something1 WHERE text = '$data'";
            //echo $sql;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $data1[] = $row['text'];
                }
            } else {
                $data1 = null;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    $sql = "SELECT `text` FROM `something`";
    if ($result = $conn->query($sql)) {
        while($obj = $result->fetch_object()) {
            $data = $obj->text;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>An toàn mạng máy tính nâng cao - NT534.L21.ATCL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="left">
                <div class="logo">
                    <img src="./logo.png" alt="logo">
                </div>
                <h2>Khoa Mạng máy tính và Truyền thông</h2>
                <h3>An toàn mạng máy tính nâng cao - NT534.L21.ATCL</h3>
                <h4>Giảng viên: Thầy Nguyễn Duy</h4>
                <div class="sv-list">
                    <ul>
                        <li><span>18520633</span> Lê Đăng Dũng</li>
                        <li><span>18520585</span> Phạm Trần Tiến Đạt</li>
                    </ul>
                </div>
                <div class="version">Đây là APP 2</div>
            </div>
            <div class="center">
                <form method="post">
                    <h3>Ví dụ về tấn công XSS</h3>
                    <div class="form-gr">
                        <label for="sometext">Nhập một thứ gì đó để lưu lại:</label>
                        <input type="text" name="sometext" id="sometext">
                    </div>
                    <div class="form-gr">
                        <button type="submit">Lưu lại</button>
                    </div>
                    <div class="form-gr output-gr">
                        <h4 for="output"><?=isset($data) ?  $data : "Giá trị lấy ra từ database" ?></h4>
                    </div>
                </form>
            </div>
            <div class="right">
                <form method="post">
                    <h3>Ví dụ về SQL Injection</h3>
                    <div class="form-gr">
                        <label for="search">Tìm kiếm:</label>
                        <input type="text" name="search" id="search">
                    </div>
                    <div class="form-gr">
                        <button type="submit">Tìm</button>
                    </div>
                    <div class="form-gr output-gr">
                        <h4 for="output"><?php
                            if (isset($data1)) {
                                foreach ($data1 as $data) {
                                    echo $data . "</br>";
                                }
                            } else {
                                echo "Giá trị sẽ in ra từ db";
                            }
                        ?></h4>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>


