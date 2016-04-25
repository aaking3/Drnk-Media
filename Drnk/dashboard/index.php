<?php
    require "../autoloader.php";
    require "../session.php";
    require "../refresh_user.php";
    require "../login_check.php";
    $page = isset($_GET['page']) ? $_GET['page'] : "my_profile";
    $admin = (isset($user) && $user->isAdmin()) ? "Admin" : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DRNK Account Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic" rel="stylesheet" type="text/css">

    <link href="css/dashboard_styles.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">DRNK <?= $admin ?> Account Dashboard</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown account-name-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php if (!empty($admin)) echo "({$admin}) "; ?><?= $user->getEmail(); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="?page=my_profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav side-bar-menu">
                    <li <?php 
                            if ($page == "my_profile") { 
                                echo 'class="active"';
                            }
                        ?>>
                        <a href="?page=my_profile"><i class="fa fa-fw fa-user"></i> My Profile</a>
                    </li>
                    <li <?php 
                            if ($page == "business_info") { 
                                echo 'class="active"';
                            }
                        ?>>
                        <a href="?page=business_info"><i class="fa fa-fw fa-glass"></i> Business Info</a>
                    </li>
                    <li <?php 
                            if ($page == "edit_deals") { 
                                echo 'class="active"';
                            }
                        ?>>
                        <a href="?page=edit_deals"><i class="fa fa-fw fa-usd"></i> Edit Deals</a>
                    </li>
                    <?php if ($user->isAdmin()) { ?>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-wrench"></i> Admin Tools<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="#">Verify New Businesses</a>
                                </li>
                                <li>
                                    <a href="#">Approve Changes</a>
                                </li>
                                <li>
                                    <a href="#">List of Businesses</a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <?php
            if ($page == "my_profile") {
                include "my_profile.html.php";
            } elseif ($page == "business_info") {
                include "business_info.html.php";    
            }elseif ($page == "edit_deals") {
                include "edit_deals.html.php";    
            }
        ?>

    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>
</html>
