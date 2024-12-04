<div class="container">
        <div class="row mt-3 mb-2">
            <?php 
                include("./pages/sidebar-content.php");
            ?>

            <div class="row col-lg-9">
                <?php 
                    if(isset($_GET['keyword'])){
                        include("./pages/content/search.php");
                    }
                    else{
                        if(isset($_GET['contentmenu'])){
                            $term = $_GET['contentmenu'];
                        }
                        elseif(isset($_GET['detailproduct'])){
                            $term = "detail";
                        }
                        else{
                            $term = "";
                        }
    
                        if($term == "sanphammoi"){
                            include("./pages/content/new-product.php");
                        }
                        elseif($term == "sanphamkhuyenmai"){
                            include("./pages/content/discount-product.php");
                        }
                        elseif($term == "quanaobongda"){
                            include("./pages/content/clothes.php");
                        }
                        elseif($term == "gangtaythumon"){
                            include("./pages/content/goalkeeper.php");
                        }
                        elseif($term == "phukienbongda"){
                            include("./pages/content/accessories.php");
                        }
                        elseif($term == "bongthidau"){
                            include("./pages/content/ball.php");
                        }
                        elseif($term == "giaybongda"){
                            include("./pages/content/shoe.php");
                        }
                        elseif($term == "detail"){
                            include("./pages/content/detailproduct.php");
                        }
                        elseif($term == "tatcasanpham"){
                            include("./pages/content/allproduct.php");
                        }
                        else{
                            include("./pages/content/new-product.php");
                        }
                    }
                    
                ?>
            </div>
        </div>
    </div>