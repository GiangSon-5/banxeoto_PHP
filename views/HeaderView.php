<!DOCTYPE html>
<html>
<head>
  <title>Menu Dropdown</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<header id="header">
<!-- top header -->
<div style="width: 100%;display: flex; flex-direction: row; object-fit: cover;">
<img src="assets/frontend/images/anhheader.png" style="width: 50%;height: 100px;object-fit: cover; ">
<img src="assets/frontend/images/anhheader.png" style="width: 50%;height: 100px;object-fit: cover;">
</div>
<div class="top-header" style="background-color: #4e73df;">
  <div class="container">
    <div class="row" >
      <div class="col-xs-12 col-sm-6 col-md-6" >  </div>
      <div class="col-xs-12 col-sm-6 col-md-6 customer">
        <?php if(isset($_SESSION["customer_email"]) == false): ?>
        <span><i class="fa fa-user"> </i><a href="index.php?controller=account&action=login">Đăng nhập</a></span>   <span><i class="fa fa-user-plus"></i> <a href="index.php?controller=account&action=register">Đăng ký</a></span>
        <?php else: ?>
          <a href="#">Xin chào <?php echo $_SESSION["customer_email"]; ?></a>   <a href="index.php?controller=account&action=logout">Đăng xuất</a>
        <?php endif; ?>
         </div>
    </div>
  </div>
</div>
<!-- end top header -->
<!-- middle header -->
<div class="mid-header">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 logo "> <a href="index.php"> <img src="assets/frontend/100/047/633/themes/517833/assets/logo-toyota.jpg" alt="User" title="User" class="img-responsive"> </a> </div>
    <div class="col-xs-12 col-sm-12 col-md-6 header-search">
      <!--<form method="post" id="frm" action="">-->
      <div style="margin-top:25px; position: relative;">
      <form method="GET">

        <input type="text" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''?>" name="search" placeholder="Nhập từ khóa tìm kiếm..." id="key" class="input-control">
          <button style="margin-top:5px;" type="submit"> <i class="fa fa-search" onclick="return search();" style="position: absolute; top: -13px;"></i> </button>
          </form>
        <div class="smart-search">
          <ul>
          </ul>
        </div>
      </div>
      <style type="text/css">
        .smart-search img{width: 70px; margin-right: 5px;}
        .smart-search{position: absolute; width: 100%; z-index: 1; display: none; max-height: 350px; overflow: scroll;}
        .smart-search ul{padding:0px; margin:0px; list-style: none;}
        .smart-search ul li{background: white; border-bottom: 1px solid #dddddd;}
      </style>
      <script type="text/javascript">
        $(document).ready(function(){
          //khi go phim vao o textbox
          $("#key").keyup(function(){
            //lay gia tri vua nhap vao
            var strKey = $("#key").val();
            //ham trim() loai bo khoang trang
            strKey = strKey.trim();
            if(strKey != ""){
              //hien thi the html co class=smart-search
              $(".smart-search").attr("style","display:block");
              //---
              //ajax de lay du lieu
              $.ajax({
                url: "index.php?controller=products&action=ajax&key="+strKey,
                success: function( result ) {
                  //clear tat ca cac the li
                  $(".smart-search ul").empty();
                  //them ket qua vua tim thay
                  $(".smart-search ul").append(result);
                }
              });
              //---
            }else
              $(".smart-search").attr("style","display:none");
          });
        });
      </script>
      <!--</form>-->
    </div>
    <?php
        $numberProduct = 0;
        if(isset($_SESSION["cart"])){
            foreach($_SESSION["cart"] as $product){
              $numberProduct++;
            }
        }
     ?>
    <div class="col-xs-12 col-sm-12 col-md-3 mini-cart">
      <div class="wrapper-mini-cart"> <span class="icon"><i class="fa fa-shopping-cart"></i></span> <a href="index.php?controller=cart"> <span class="mini-cart-count"> <?php echo $numberProduct; ?> </span> sản phẩm <i class="fa fa-caret-down"></i></a>
        <div class="content-mini-cart">
          <div class="has-items">
            <ul class="list-unstyled">
              <?php if(isset($_SESSION["cart"])): ?>
                <?php foreach($_SESSION["cart"] as $product): ?>
                <li class="clearfix" id="item-1853038">
                  <div class="image"> <a href="index.php?controller=products&action=detail&id=<?php echo $product['id']; ?>"> <img alt="<?php echo $product['name']; ?>" src="assets/upload/products/<?php echo $product['photo']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive"> </a> </div>
                  <div class="info">
                    <h3><a href="index.php?controller=products&action=detail&id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h3>
                    <p><?php echo $product['number']; ?> x <?php echo number_format($product['price']); ?>₫</p>
                  </div>
                  <div> <a href="index.php?controller=cart&action=delete&id=<?php echo $product['id']; ?>"> <i class="fa fa-times"></i></a> </div>
                </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
            <?php if($numberProduct > 0): ?>
            <a href="index.php?controller=cart" class="button">Thanh toán</a><?php endif; ?> </div>
            <!-- <a href="index.php?controller=cart&action=checkout" class="button">Thanh toán</a> </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end middle header -->
<!-- bottom header -->
<div class="bottom-header">
  <div class="container">
    <div class="clearfix">
      <ul class="main-nav hidden-xs hidden-sm list-unstyled">
        <li class="active"><a href="index.php">Trang chủ</a></li>
        <li class="has-submenu"> <a href="#"> <span>Sản phẩm</span><i class="fa fa-caret-down" style="margin-left: 5px;"></i> </a>
          <ul class="list-unstyled level1">
          <?php
              //load cap 1
              $categories = $this->modelGetCategories();
           ?>
           <?php foreach($categories as $rows): ?>
            <li class="has-submenu">
              <a href="index.php?controller=products&action=categories&category_id=<?php echo $rows->id; ?>"><?php echo $rows->name; ?></a>
              <ul class="list-unstyled level2" style="display: none;">
                <?php
                  //load cap 2
                  $categoriesSub = $this->modelGetCategoriesSub($rows->id);
                ?>
                <?php foreach($categoriesSub as $rowsSub): ?>
                  <li style="padding-left:20px;"><a href="index.php?controller=products&action=categories&category_id=<?php echo $rowsSub->id; ?>"><?php echo $rowsSub->name; ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="index.php?controller=cart">Giỏ hàng</a></li>
        <?php if(isset($_SESSION["customer_email"])): ?>
          <li><a href="index.php?controller=orders">Bảo dưỡng xe</a></li>
        <?php endif; ?>
          </ul>
      <a href="javascript:void(0);" class="toggle-main-menu hidden-md hidden-lg"> <i class="fa fa-bars"></i> </a>
      <ul class="list-unstyled mobile-main-menu hidden-md hidden-lg" style="display:none">
        <li class="active"><a href="index.php">Trang chủ</a></li>
        <li><a href="#">Giới thiệu</a></li>
        <li><a href="index.php?controller=tintuc">Tin tức</a></li>
        <li><a href="index.php?controller=lienhe">Liên hệ</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- end bottom header -->
</header>
