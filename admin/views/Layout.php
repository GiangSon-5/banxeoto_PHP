<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản trị hệ thống</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/admin/layout1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/admin/layout1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/admin/layout1/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/admin/layout1/css/_all-skins.min.css">
    <link rel="shortcut icon" href="../assets/frontend/100/047/633/themes/517833/assets/logo-toyota.jpg" type="image/x-icon" />
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- load file ckeditor.js vao day de hien thi editor o text area -->
    <script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>
    <style>
        .logo-lg .logo-lg-text {
        font-size: 18px;
        font-family: 'Source Sans Pro', sans-serif;
        font-weight: 700;
        display: inline-block;
    }
    .user-menu {
    padding-top: 15px; /* Điều chỉnh khoảng cách từ góc phải trên cùng */
    }

    .user-menu .dropdown-toggle {
        font-size: 14px;
        color: #ffffff;
        padding: 5px 15px;
        text-decoration: none;
    }
    .sidebar-menu > li > a {
        font-size: 16px;
        font-family: 'Source Sans Pro', sans-serif;
        font-weight: 400;
        color: #ffffff;
        padding: 12px 20px; /* Điều chỉnh padding cho mỗi mục */
        display: block; /* Đảm bảo mỗi mục là một khối block */
        height: auto; /* Hoặc bạn có thể sử dụng height cố định, ví dụ: height: 50px; */
        line-height: normal; /* Đảm bảo line-height bình thường */
        text-decoration: none; /* Loại bỏ đường gạch chân mặc định của thẻ a */
    }
    
    .sidebar-menu > li {
        padding: 0; /* Loại bỏ padding */
        margin: 0; /* Loại bỏ margin */
    }
    
    .sidebar-menu > li > a:hover {
        background-color: #0073b7;
        color: #ffffff;
    }
    
    .sidebar-menu > li.active > a {
        background-color: #0073b7;
        color: #ffffff;
    }
    
    .user-panel .info {
        font-size: 14px;
        color: #ffffff;
        margin: 0;
        padding: 5px 15px;
    }

    .user-panel .info p,
    .user-panel .info a {
        font-size: 14px;
        font-family: 'Source Sans Pro', sans-serif;
        font-weight: 400;
        color: #ffffff;
        margin: 0;
        padding: 5px 15px;
    }

    .user-panel .info a {
        color: #00a65a;
    }

    .user-panel .info i {
        color: #00a65a;
        margin-right: 5px;
    }
    
    .sidebar-toggle {
        font-size: 16px;
    }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>QTHT</b></span>
            <!-- logo for regular state and mobile devices -->
            <span href="index.php" class="logo-lg"><b> <img src="../assets/frontend/100/047/633/themes/517833/assets/Toyota-Logo.png"  alt="User Image"></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <?php if (isset($_GET['controller']) && $_GET['controller'] == 'maintain'): ?>
            <form  method="GET" style="position: absolute;left: 50px;top: 10px">
                <?php if (isset($_GET['controller']) && $_GET['controller']): ?>
                <input type="hidden" name="controller" value="<?php echo isset($_GET['controller']) ? $_GET['controller'] : ''?>">
                <?php endif; ?>
                <input type="text" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''?>" name="search" placeholder="Nhập từ khóa tìm kiếm..." id="key" class="input-control">
            <button style="margin-top:5px;background: transparent;border: none;color: white;" type="submit"> <i class="fa fa-search"></i> </button>
            </form>
            <?php endif; ?>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav" >
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../assets/admin/layout1/images/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">Admin</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="../assets/admin/layout1/images/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p style="color: black">
                                        Admin
                                        <small style="color: black" >Quản trị viên</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->

                            </ul>
                        </li>
                    </ul>
                </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="../assets/frontend/100/047/633/themes/517833/assets/logo-toyota.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Admin</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">DANH MỤC</li>

                <li>
                    <a href="index.php?controller=categories">
                        <i class="fa fa-th"></i> <span>Danh mục sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=products">
                        <i class="fa fa-th"></i> <span>Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=news">
                        <i class="fa fa-th"></i> <span>Tin tức</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=orders">
                        <i class="fa fa-th"></i> <span>Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=statistic">
                        <i class="fa fa-th"></i> <span>Doanh thu</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=maintain">
                        <i class="fa fa-code"></i> <span>Lịch bảo dưỡng</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=users">
                        <i class="fa fa-code"></i> <span>Quản lý user</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=login&action=logout">
                        <i class="fa fa-code"></i> <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <?php echo $this->view; ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Đại Học Giao Thông Vận Tải TPHCM &copy; UTH<a href="https://adminlte.io"></a>.</strong> 
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/admin/layout1/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/admin/layout1/js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/admin/layout1/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/admin/layout1/js/adminlte.min.js"></script>
</body>
</html>
