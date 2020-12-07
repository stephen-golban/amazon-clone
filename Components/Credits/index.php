<?php
require_once '../../core/init.php';
$user = new User();
$errArr = array();

if (!$user->isLoggedIn()) {
    Redirect::to('Components/Login');
}
$group = DB::getInstance()->get('groups', array('id', '=', $user->data()->group_id));
if ($group->count()) {
    $permissions = $group->first()->permissions;
}
if (isset($_POST['get-money'])) {
    $answer = $_POST['groupOfDefaultRadios'];
    if ($answer == 2) {
        DB::getInstance()->update('users', $user->data()->id, array(
            'credits' => $user->data()->credits + 1000,
        ));
        Session::flash('credits-added', 'Your account has been supplied with $1000!');
        Redirect::to("../../index.php");
    } else {
        Session::flash('credits-failed', 'Your answer was not right, try again!');
        Redirect::to("../../index.php");
    }
}
$items = array();
foreach (DB::getInstance()->get2('cart', 'WHERE user_id =', $user->data()->id)  as $o) {
    $items[] = $o;
}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];
$_SESSION['redirectTo'] = $url;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../../includes/head.php'; ?>
    <link rel="stylesheet" href="../../header.css">
    <title>Amazon : <?php echo $user->data()->name . "'s Profile"; ?></title>
</head>

<body>
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark elegant-color-dark">
        <a href="../../index.php"><img class="navbar-brand" src="https://pngimg.com/uploads/amazon/amazon_PNG11.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <form class="header__search" action="../Results/index.php" method="POST">
                <input type="text" name="search-query" className="header__searchInput" autocomplete="Off" placeholder="e.g Iphone" />
                <button type="submit" name="search-submit" id="search__submit"><i class="fa fa-search"></i></button>
            </form>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="../Cart/index.php">
                        <i class="fas fa-shopping-basket"></i>
                        <span className="header__basketCount"> <?php echo count($items); ?></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="../Cart/index.php" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <?php if ($user->isLoggedIn()) : ?>
                            <p class="dropdown-item disabled" aria-disabled="true">$ <?php echo $user->data()->credits; ?></p>
                            <?php if ($user->data()->group_id == 2) { ?>
                                <a href="../../Admin/" class="dropdown-item" style="text-decoration: none;">
                                    <i class="fas fa-user-shield"></i> Admin Panel
                                </a>
                            <?php } ?>
                            <?php if ($user->data()->group_id == 1) { ?>
                                <a href="../Credits/index.php" class="dropdown-item" style="text-decoration: none;">
                                    <p><i class="fas fa-award"></i> Get Credits</p>
                                </a>
                            <?php } ?>
                        <?php endif; ?>
                        <a class="dropdown-item" href="../Profile/index.php">
                            <i class="fas fa-user"></i> Account
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="../../includes/logout.inc.php">
                            <i class="fas fa-power-off"></i> Log Out
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="display-4 text-warning" style="text-align: center;">Guess the answer for $1000 on your account</div>
    <div class="container" style="margin-top: 10px;">
        <?php if (Session::exists('acc-updated')) : ?>
            <div class="alert alert-success"><?php echo Session::flash('acc-updated'); ?></div>
        <?php endif; ?>

        <div class="container my-5 z-depth-1">


            <!--Section: Content-->
            <section class="dark-grey-text p-5">

                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-5 mb-4 mb-md-0">

                        <div class="view">
                            <img src="https://mdbootstrap.com/img/illustrations/undraw_Group_chat_unwm.svg" class="img-fluid" alt="smaple image">
                        </div>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <form class="col-md-7 mb-lg-0 mb-4" action="" method="POST">
                        <p class="text-info lead">How much time did it take me to create this website?</p>
                        <!-- Default unchecked -->
                        <!-- Group of default radios - option 1 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="groupOfDefaultRadios" value="1">
                            <label class="custom-control-label" for="defaultGroupExample1">5 Days</label>
                        </div>

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="groupOfDefaultRadios" value="2">
                            <label class="custom-control-label" for="defaultGroupExample2">1 Week</label>
                        </div>

                        <!-- Group of default radios - option 3 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="defaultGroupExample3" name="groupOfDefaultRadios" value="3">
                            <label class="custom-control-label" for="defaultGroupExample3">2 Weeks</label>
                        </div>
                        <button type="submit" class="btn btn-elegant" name="get-money">Submit Answer</button>
                    </form>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </section>
            <!--Section: Content-->


        </div>

    </div>
</body>

</html>