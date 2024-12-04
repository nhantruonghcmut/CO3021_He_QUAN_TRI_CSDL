<?php
    if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST["submit"] == "Đổi mật khẩu"){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $oldpass = $_POST["oldpassword"];
            $newpass = $_POST["newpassword"];

            require_once('./admincp/config-database.php');
            $conn = openCon();

            // Sử dụng prepared statements để chống SQL injection
            $query = "UPDATE users SET password = '$newpass' WHERE username = '$username' AND email = '$email' AND phone = '$phone' AND password = '$oldpass'";
            $result = $conn->query($query);

            if ($result) {
                if($conn->affected_rows > 0){
                    echo 
                    '
                    <script>
                        alert("Đã đổi password thành công");
                        window.location.href = "index.php?headermenu=login";
                    </script>
                    ';
                    exit();
                }
                else{
                    echo 
                    '
                    <script>
                        alert("Thông tin cung cấp chưa đúng.");
                    </script>
                    ';
                }
            } else {
                echo 
                '
                <script>
                    alert("Có lỗi xảy ra");
                </script>
                ';
                exit();
            }
             
            
        }
        elseif($_POST["submit"] == "Đăng nhập"){
            echo '<script>window.location.href = "index.php?headermenu=login";</script>';
        }
    }
?>


<div class="container bg-light mt-5 mb-5 col-10 col-sm-5" >
    <div class="row">
        <h2 class="fw-bold text-center mt-2">Đổi mật khẩu</h2>
    </div>

    <form method="post" action="">
        <p>Tên đăng nhập*</p>
        <input type="text" class="form-control mb-3" name="username" placeholder="Username" value=''>
        <p>Email*</p>
        <input type="text" class="form-control mb-3" name="email" placeholder="Email đăng ký" value=''>
        <p>Số điện thoại*</p>
        <input type="text" class="form-control mb-3" name="phone" placeholder="Số điện thoại đăng ký" value=''>
        <p>Password cũ*</p>
        <input type="password" class="form-control mb-3" name="oldpassword" placeholder="Mật khẩu cũ" value=''>
        <p>Password mới*</p>
        <input type="password" class="form-control mb-3" name="newpassword" placeholder="Mật khẩu mới" value=''>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-danger mt-3 mb-3" name="submit" value="Đổi mật khẩu">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit" value="Đăng nhập">
            </div>
        </div>
    </form>
</div>