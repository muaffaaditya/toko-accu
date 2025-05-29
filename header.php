<?php 
session_start();
include 'koneksi/koneksi.php';
if (isset($_SESSION['kd_cs'])) {
    $kode_cs = $_SESSION['kd_cs'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Website Jaya Accu</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .navbar-default {
            background: #000 !important;
            border: none !important;
            box-shadow: none !important;
        }
        .navbar-default .navbar-nav > li > a,
        .navbar-default .navbar-brand,
        .navbar-default .navbar-toggle .icon-bar {
            color: #fff !important;
        }
        .navbar-default .navbar-toggle {
            border-color: #fff !important;
        }
        .navbar-default .navbar-nav > li > a {
            padding-left: 80px;
            padding-right: 20px;
        }

        .navbar-header {
            position: relative;
        }

        .navbar {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .brand-text {
            color: #fff;
            font-weight: bold;
            font-size: 23px;
            margin-left: -5px;
            margin-top: 11px;
            display: inline-block;
        }

        .sidebar-menu {
            position: fixed;
            top: 0;
            right: -250px;
            width: 250px;
            height: 100%;
            background-color: #000;
            color: #fff;
            transition: right 0.3s ease;
            z-index: 9999;
            padding: 20px;
        }
        .sidebar-menu.active {
            right: 0;
        }
        .sidebar-menu ul {
            list-style: none;
            padding: 0;
        }
        .sidebar-menu ul li {
            margin-bottom: 15px;
        }
        .sidebar-menu ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9998;
            display: none;
        }

        @media (max-width: 768px) {
            .navbar-toggle {
                position: absolute;
                right: 15px;
                top: 10px;
            }

            .brand-text {
                margin-left: 10px;
            }
        }
		
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default" style="padding: 5px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" style="display: inline-block;">
                <img src="image/logo 2.jpg" alt="Logo" style="max-height: 52px; margin-top: -15px;">
            </a>
            <span class="navbar-text brand-text">
                <span style="color: red;">JAYA</span><span style="color: blue; padding-left: 8px;">ACCU</span>

            </span>

            <!-- Tombol hamburger pindah ke kanan -->
            <button type="button" class="navbar-toggle collapsed" id="mobileMenuBtn">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="accu_mobil.php">Accu Mobil</a></li>
                <li><a href="accu_motor.php">Accu Motor</a></li>
                <li><a href="accu_kapal.php">Accu Kapal</a></li>
                <li><a href="pemesanan.php">Pemesanan</a></li>
                <li><a href="chat_user.php">Kontak</a></li>

                <?php 
                if (isset($_SESSION['kd_cs'])) {
                    $cek = mysqli_query($conn, "SELECT kode_produk FROM keranjang WHERE kode_customer = '$kode_cs'");
                    $value = mysqli_num_rows($cek);
                    echo "<li><a href='keranjang.php'><i class='glyphicon glyphicon-shopping-cart'></i> <b>[ $value ]</b></a></li>";
                } else {
                    echo "<li><a href='keranjang.php'><i class='glyphicon glyphicon-shopping-cart'></i> [0]</a></li>";
                }

                if (!isset($_SESSION['user'])) {
                    echo '
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Akun <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="user_login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
                        </ul>
                    </li>';
                } else {
                    $user = $_SESSION['user'];
                    echo "
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                            <i class='glyphicon glyphicon-user'></i> $user <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a href='proses/logout.php'>Log Out</a></li>
                        </ul>
                    </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar Mobile Menu -->
<div class="sidebar-menu" id="mobileMenu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="accu_mobil.php">Accu Mobil</a></li>
        <li><a href="accu_motor.php">Accu Motor</a></li>
        <li><a href="accu_kapal.php">Accu Kapal</a></li>
        <li><a href="keranjang.php"><i class="glyphicon glyphicon-shopping-cart"></i> Keranjang</a></li>
        <li><a href="pemesanan.php">Pemesanan</a></li>
        <li><a href="chat_user.php">Kontak</a></li>
        <?php if (!isset($_SESSION['user'])) { ?>
            <li><a href="user_login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php } else { ?>
            <li><a href="proses/logout.php">Log Out</a></li>
        <?php } ?>
    </ul>
</div>
<div class="overlay" id="menuOverlay"></div>

<!-- Script untuk menu slide -->
<script>
$(document).ready(function(){
    $("#mobileMenuBtn").click(function(){
        $("#mobileMenu").addClass("active");
        $("#menuOverlay").fadeIn();
    });

    $("#menuOverlay").click(function(){
        $("#mobileMenu").removeClass("active");
        $(this).fadeOut();
    });
});
</script>

</body>
</html>
