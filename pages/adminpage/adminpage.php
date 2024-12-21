<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin BK Shop</title>
</head>
<body>
    <?php
        session_start();
        if(!($_SESSION) || !($_SESSION['role'] == 1)){ 
            echo 
            '
            <script>
                window.location.href = "../../index.php";
            </script>
            ';
            exit();
        }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./../../images/hcmut.png" alt="logo" style="height: 40px; width: 40px;">
            </a>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <span>Admin của BK Shop</span>
                    </li>
                </ul>
                
                <form method='GET' action="" class="d-flex m-2">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success" type="submitSearch">Search</button>
                </form>

                <div class="m-2">
                    <a class="text-decoration-none" href="../logout.php"><span class="d-none d-sm-inline mx-1 text-primary">Đăng xuất</span></a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class='container mt-3'>
        <h3 class='text-center'>Danh sách sản phẩm</h3>
        
        <a href='./addproduct.php'><button class='col-5 col-sm-2 btn btn-success'>+ Thêm sản phẩm mới</button></a>
        

        <table class='table table-hover container'>
            <thead>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Tên sản phẩm</th>
                    <th scope='col'>Loại</th>
                    <th scope='col'>Số lượng</th>
                    <th scope='col'>Mô tả</th>
                    <th scope='col'>Hình ảnh</th>
                    <th scope='col'>Giá</th>
                    <th scope='col'>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once('../../admincp/config-database.php');
                    $conn = openCon();

                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                    if($keyword != ''){
                        $query = "SELECT * FROM product WHERE name LIKE '%$keyword%'";
                        $result = $conn->query($query);
                    }
                    else{
                        $query = "SELECT * FROM product";
                        $result = $conn->query($query);
                    }
                
                    

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo
                            "
                            <tr>
                                <th scope='row'>". $row["id"] ."</th>
                                <td>". $row["name"] ."</td>
                                <td>". $row["type"] ."</td>
                                <td>". $row["quantity"] ."</td>
                                <td>". $row["description"] ."</td>
                                <td>
                                    <img src='". $row["image"] ."' alt='...' style='height:40px; width: 40px;'>
                                </td>
                                <td>". $row["price"] ." VNĐ</td>
                                <td>
                                    <a href='./updateproduct.php?id=". $row["id"] ."'><button class='btn btn-primary'>Sửa</button></a>
                                    <a href='./deleteproduct.php?id=". $row["id"] ."'><button class='btn btn-danger'>Xóa</button></a>
                                </td>
                            </tr>
                            ";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>