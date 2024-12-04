<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/bkshop1.png" type="image/jpg">
    <title>BK Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    
</head>
<body>
    <?php 
        session_start();
        include("./pages/header.php");
        if(isset($_GET['headermenu'])){
            $term = $_GET['headermenu'];
        }
        elseif(isset($_GET['footer'])){
            $term = $_GET['footer'];
        }
        else{
            $term = "";
        }

        if($term == "gioithieu"){
            include("./pages/introduce.php");
        }
        elseif($term == "lienhe"){
            include("./pages/contact.php");
        }
        elseif($term == "huongdan"){
            include("./pages/huongdan.php");
        }
        elseif($term == "giaonhanvathanhtoan"){
            include("./pages/giaonhanvathanhtoan.php");
        }
        elseif($term == "doitravabaohanh"){
            include("./pages/doitravabaohanh.php");
        }
        elseif($term == "chinhsachthanhtoan"){
            include("./pages/chinhsachthanhtoan.php");
        }
        elseif($term == "chinhsachvanchuyen"){
            include("./pages/chinhsachvanchuyen.php");
        }
        elseif($term == "chinhsachdoitra"){
            include("./pages/chinhsachdoitra.php");
        }
        elseif($term == "chinhsachbaohanh"){
            include("./pages/chinhsachbaohanh.php");
        }
        elseif($term == "login"){
            include("./pages/login.php");
        }
        elseif($term == "register"){
            include("./pages/register.php");
        }
        elseif($term == "cart"){
            include("./pages/cart/cart.php");
        }
        elseif($term == "forgetpassword"){
            include("./pages/forgetpassword.php");
        }
        elseif($term == "changepassword"){
            include("./pages/changepassword.php");
        }
        else{
            include("./pages/carousel.php");
            include("./pages/sub-info.php");
            include("./pages/content.php");
        }
        include("./pages/footer.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>