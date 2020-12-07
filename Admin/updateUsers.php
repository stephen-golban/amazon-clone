<?php require_once '../core/init.php';
$user = new User();
$userRes = array();
$errArr = array();
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
}
foreach (DB::getInstance()->get('users', array('id', '=', $uid))->first() as $u) {
    $userRes[] = $u;
}
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 3,
                'max' => 50,
                'numbers' => true,
            )
        ));

        if ($validation->passed()) {

            DB::getInstance()->update('users', $uid, array(
                'name' => Input::get('name'),
                'group_id' => substr(Input::get('role'), 0, 1),
            ));
            Session::flash('updated-u', 'You have successfully updated this user!');
            Redirect::to('uTable.php');
        } else {
            foreach ($validation->errors() as $error) {
                $errArr[] = $error;
            }
        }
    }
}
if (!$user->hasPermission('admin')) {
    Redirect::to('../index.php');
}
if (!$user->isLoggedIn()) {
    Redirect::to('../Components/Login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="https://www.pinclipart.com/picdir/big/313-3134049_amazon-button-clipart.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Amazon - Admin | <?php echo $user->data()->name; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <ul class="nav navbar-nav navbar-left navbar-top-links">
                <li><a href="../index.php"><i class="fa fa-home fa-fw"></i> Amazon</a></li>
            </ul>

            <ul class="nav navbar-right navbar-top-links">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $user->data()->name; ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../Components/Profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../includes/logout.inc.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Tables<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="uTable.php">Users Table</a>
                                </li>
                                <li>
                                    <a href="cTable.php">Categories Table</a>
                                </li>
                                <li>
                                    <a href="pTable.php">Products Table</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Forms<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="addUsers.php">Add Users</a>
                                </li>
                                <li>
                                    <a href="addCategories.php">Add Categories</a>
                                </li>
                                <li>
                                    <a href="addProducts.php">Add Products</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Update Users</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Update a user
                            </div>
                            <!-- /.panel-heading -->
                            <?php print_r($userRes); ?>
                            <div class="panel-body">
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" id="name" class="form-control" name="name" autocomplete="off" value="<?php echo escape($userRes[4]); ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Give a Role</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="role">
                                            <option>1 (Standard User)</option>
                                            <option>2 (Admin User)</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                    <?php
                                    foreach ($errArr as $e) { ?>
                                        <div class="alert alert-warning"><?php echo $e; ?></div>
                                    <?php } ?>
                                    <div class="form-group form-row">
                                        <button type="submit" class="btn btn-default">Update User</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'footer.php'; ?>