<?php
    if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST["submit"] == "Đăng ký") {
            $role = '2';
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            if (!preg_match("/[a-zA-Z]{2,30}/", $name)) {
                echo 
                '
                <script>
                    alert("Firstname chuỗi từ 2-30 ký tự, không bao gồm số và ký tự đặc biệt");
                    window.location.href = "index.php?headermenu=register";
                </script>
                ';
                exit();
            }
            else if (!preg_match ("/^([a-zA-Z0-9_])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{1,6}$/", $email)) {
                echo 
                '
                <script>
                    alert("Nhập email định dạng: <sth>@<sth>.<sth>");
                    window.location.href = "index.php?headermenu=register";
                </script>
                ';
                exit();
            }
            else if (!preg_match("/[a-zA-Z]{2,30}/", $username)) {
                echo 
                '
                <script>
                    alert("Username chuỗi từ 2-30 ký tự, không bao gồm số và ký tự đặc biệt");
                    window.location.href = "index.php?headermenu=register";
                </script>
                ';
                exit();
            }
            if (!preg_match("/^[0-9]{7,14}/", $phone)) {
                echo 
                '
                <script>
                    alert("Số điện thoại phải có từ 7 đến 14 chữ số.");
                    window.location.href = "index.php?headermenu=register";
                </script>
                ';
                exit();
            }
            else{
                require_once('./admincp/config-database.php');
                $conn = openCon();

                $query = "SELECT * FROM users WHERE username = '$username'";
                $result = $conn->query($query);

                if($result->num_rows > 0){
                    echo '<script>alert("Tên username đã được sử dụng")</script>';
                }
                else{
                    $query = "INSERT INTO users (username, password, name, phone, email, role) VALUES ('$username', '$password', '$name', '$phone', '$email', '$role')";
                    $result = $conn->query($query);
        
                    if($result) {
                        echo 
                        '
                        <script>
                            alert("Người dùng đã được thêm thành công vào cơ sở dữ liệu. Hãy đăng nhập!!!");
                            window.location.href = "index.php?headermenu=login";
                        </script>
                        ';
                        exit();
                    } else {
                        echo 
                        '
                        <script>
                            alert("Có lỗi xảy ra khi thêm người dùng vào cơ sở dữ liệu.");
                            window.location.href = "index.php?headermenu=register";
                        </script>
                        ';
                        exit();
                    }
                }
            }
        }
        else if ($_POST["submit"] == "Đăng nhập"){
            echo '<script>window.location.href = "index.php?headermenu=login";</script>';
            exit();
        }
    }
?>  
    
<div class="container bg-light mt-5 mb-5 col-10 col-sm-5">
    <div class="row">
        <h2 class="fw-bold text-center mt-2">ĐĂNG KÝ TÀI KHOẢN</h2>
        <p>
            Nếu bạn có một tài khoản, xin vui lòng bấm nút "Đăng nhập" chuyển qua trang đăng nhập.<br/>
            Những trường có * là bắt buộc
        </p>
    </div>

    <form method="post">
        <p>Họ và tên*</p>
        <input type="text" class="form-control mb-3" name="name" placeholder="Name" value=''>
        <p>Email*</p>
        <input type="text" class="form-control mb-3" name="email" placeholder="Email" value=''>
        <p>Phone number*</p>
        <input type="text" class="form-control mb-3" name="phone" placeholder="Phone number" value=''>
        <p>Tên đăng nhập*</p>
        <input type="text" class="form-control mb-3" name="username" placeholder="Username" value=''>
        <p>Password*</p>
        <input type="password" class="form-control mb-3" name="password" placeholder="Password" value=''>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-danger mt-3 mb-3" name="submit" value="Đăng ký">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit" value="Đăng nhập">
            </div>
        </div>
    </form>
</div>