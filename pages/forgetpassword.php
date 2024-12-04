<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'vendor/autoload.php';

    if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST["submit"] == "Lấy lại mật khẩu"){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];

            require_once('./admincp/config-database.php');
            $conn = openCon();

            // Sử dụng prepared statements để chống SQL injection
            $query = "SELECT * FROM users WHERE username = ? AND email = ? AND phone = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sss', $username, $email, $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                // Tạo mật khẩu mới (hoặc lấy mật khẩu hiện tại)
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $new_password = substr(str_shuffle($chars), 0, 8);
                // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Cập nhật mật khẩu mới vào cơ sở dữ liệu
                $update_query = "UPDATE users SET password = ? WHERE username = ? AND email = ? AND phone = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param('ssss', $new_password, $username, $email, $phone);
                $update_result = $update_stmt->execute();

                if ($update_result) {
                    $mail = new PHPMailer(true);
                    try{
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = ''; //tài khoản email
                        $mail->Password = ''; //password ứng dụng
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('no-reply@bk97shop.com', 'Bk97 Shop');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = 'Khôi phục mật khẩu';
                        $mail->Body = 'Mật khẩu mới của bạn là: ' . $new_password;
                        $mail->send();

                        echo 
                        '
                        <script>
                            alert("Mật khẩu mới đã được gửi đến email của bạn.");
                            window.location.href = "index.php?headermenu=login";
                        </script>
                        ';
                        exit();

                    } catch(Exception $e){
                        echo 'Gửi email thất bại. Mailer Error: ' . $mail->ErrorInfo;
                    }
                }
                $stmt->close();
                $conn->close();
            }
            else{
                echo 
                '
                <script>
                    alert("Không tìm thấy người dùng!!!");
                    window.location.href = "index.php?headermenu=login";
                </script>
                ';
                exit();
            }
        }
        elseif($_POST["submit"] == "Đăng ký"){
            echo '<script>window.location.href = "index.php?headermenu=register";</script>';
        }
    }
?>

<div class="container bg-light mt-5 mb-5 col-10 col-sm-5" >
    <div class="row">
        <h2 class="fw-bold text-center mt-2">Quên mật khẩu</h2>
    </div>

    <form method="post" action="">
        <p>Tên đăng nhập*</p>
        <input type="text" class="form-control mb-3" name="username" placeholder="Username" value=''>
        <p>Email*</p>
        <input type="text" class="form-control mb-3" name="email" placeholder="Email đăng ký" value=''>
        <p>Số điện thoại*</p>
        <input type="text" class="form-control mb-3" name="phone" placeholder="Số điện thoại đăng ký" value=''>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-danger mt-3 mb-3" name="submit" value="Lấy lại mật khẩu">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit" value="Đăng ký">
            </div>
        </div>
    </form>
</div>