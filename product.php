<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($classname) {
    require './app/models/'.$classname.'.php';
});

$perpage=3;
$page=1;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
$path = explode('-', $_SERVER['REQUEST_URI']);
$id = $path[count($path) - 1];
// catogery
$getcategory = new Category();
$category_name = $getcategory->getCategory();
//product(danh muc san pham)
$productModel= new ProductModel();
//lay san pham
//$getproduct = $productModel->getProduct($perpage,$page); 
$item = $productModel->getProductById($id);

//dem so luong san pham
$totalRow= $productModel->getTotalRow();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BLOG MOTO</title>
    <link rel="stylesheet" href="/<?php echo BASE_URL; ?>/public/css/styleProduct.css">
    <link rel="stylesheet" href="/<?php echo BASE_URL; ?>/public/css/style.css">
    <link rel="stylesheet" href="/<?php echo BASE_URL; ?>/public/css/bootstrap.min.css">
  
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="/<?php echo BASE_URL; ?>/">BLOG MOTO</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/<?php echo BASE_URL; ?>/">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- In Category -->
                <?php
foreach ($category_name as $name) {
    ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $name['category_name']; ?></a>
                </li>
                <?php }?>  <!-- dong vong lap Category -->
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="background">
    <div class="container">
        <div class="row">
            <div class="col md-2">
            <?php
foreach ($category_name as $name) {
    ?>
                <li class="btn">
                    <a class="btn" href="#"><?php echo $name['category_name']; ?></a>
                </li>
                <?php }?>  <!-- dong vong lap Category -->
            </div>
            <div class="col-md-10">
                <div class="display-container-center" style="display: block;">
                         <!-- <a href=""><img src="/<?php echo BASE_URL; ?>/public/images/ducati-panigale-899.jpg" alt="" class="img-fluid" style="with:100%;"></a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- (: het giao diem chinh :) -->
    </div>
    <h1>WELCOME</h1>
    <form action="" method="get">
        <div class="container">
            <div class="imageProduct">
                <img src="/<?php echo BASE_URL; ?>/public/images/<?php echo $item['product_image']; ?>"     alt=""class="img-fluid">
            </div>
             <br>
    
             <h4><?php echo $item['product_name']; ?></h4>
            <br>
             <p>Giá : <?php echo $item['product_price']; ?>$</p>
             <br>
            <p><?php echo $item['product_description']; ?></p>    
            </div>
        </div>
    </form>
    
</body>
</html>