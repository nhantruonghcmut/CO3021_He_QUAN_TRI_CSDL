<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./images/bkshop1.png" alt="logo" style="height: 40px; width: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?headermenu=gioithieu">Giới thiệu</a>
                    </li>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sản phẩm
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=sanphammoi&page=1">Sản phẩm mới</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=sanphamkhuyenmai&page=1">Sản phẩm khuyến mãi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=quanaobongda&page=1">Quần áo bóng đá</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=giaybongda&page=1">Giày bóng đá</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=gangtaythumon&page=1">Găng tay thủ môn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=phukienbongda&page=1">Phụ kiện bóng đá</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=bongthidau&page=1">Bóng thi đấu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?contentmenu=tatcasanpham&page=1">Tất cả sản phẩm</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?headermenu=lienhe">Liên hệ</a>
                    </li>
                </ul>
                
                <form method="GET" action="index.php" class="d-flex m-2">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <div>
                    <a href="./pages/cart/cartController.php" class="text-decoration-none">
                        <button type="button" class="btn btn-outline-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart4 inline-block" viewBox="0 0 20 20">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                            </svg>
                            Giỏ hàng
                        </button>
                    </a>
                    
                </div>
                
                <?php 
                    if(($_SESSION) && $_SESSION['role'] == 2){
                        echo 
                        '
                        <div class="m-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle text-secondary" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                            <span class="d-none d-sm-inline mx-1 text-primary">' . $_SESSION["name"] . '</span>
                            
                        </div>
                        <div class="m-2">
                            <a class="text-decoration-none" href="./pages/logout.php" class="d-none d-sm-inline mx-1 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                </svg>

                                <span>Đăng xuất</span>
                            </a>
                            
                        </div>
                        ';
                    }
                    elseif(($_SESSION) && $_SESSION['role'] == 1){
                        echo 
                        '
                        <script>
                            window.location.href = "pages/adminpage/adminpage.php";
                        </script>
                        ';
                        exit();
                    }
                    else{
                        echo 
                        '
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Đăng nhập
                            </a>
        
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="index.php?headermenu=login">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="index.php?headermenu=register">Đăng ký</a></li>
                            </ul>
                        </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </nav>  