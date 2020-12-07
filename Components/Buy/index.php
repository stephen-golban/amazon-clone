<?php
require_once '../../core/init.php';
$user = new User();
$errArr = array();
$items = array();
$res = 0;

if (!$user->isLoggedIn()) {
    Redirect::to('Components/Login');
}
foreach (DB::getInstance()->get2('cart', 'WHERE user_id =', $user->data()->id)  as $o) {
    $items[] = $o;
}
if (isset($_GET['i_value'])) {
    $i_value = $_GET['i_value'];
}
if (isset($_POST['cart-pay-submit'])) {
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'name' => array('required' => true),
                'address' => array('required' => true),
                'city' => array('required' => true),
                'country' => array('required' => true),
                'email' => array('required' => true),
                'phone' => array('required' => true),
                'zip' => array('required' => true),
            ));

            if ($validation->passed()) {
                $user = new User();

                if ($user->data()->credits > $i_value) {
                    DB::getInstance()->update('users', $user->data()->id, array(
                        'credits' => $user->data()->credits - $i_value,
                    ));
                    DB::getInstance()->delete('cart', array('user_id', '=', $user->data()->id));
                    Session::flash('product-bought', 'You have successfully bought your products!');
                    Redirect::to($_SESSION['redirectTo']);
                } else {
                    Session::flash('no-credits', 'You have insufficient credits to buy these products!');
                }
            } else {
                foreach ($validation->errors() as $error) {
                    $errArr[] = $error;
                }
            }
        }
    }
} else if (isset($_POST['fast-pay-submit'])) {
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'name' => array('required' => true),
                'address' => array('required' => true),
                'city' => array('required' => true),
                'country' => array('required' => true),
                'email' => array('required' => true),
                'phone' => array('required' => true),
                'zip' => array('required' => true),
            ));

            if ($validation->passed()) {
                $user = new User();

                if ($user->data()->credits > $i_value) {
                    DB::getInstance()->update('users', $user->data()->id, array(
                        'credits' => $user->data()->credits - $i_value,
                    ));
                    Session::flash('product-bought', 'You have successfully bought this product!');
                    Redirect::to($_SESSION['redirectTo']);
                } else {
                    Session::flash('no-credits', 'You have insufficient credits to buy this product!');
                }
            } else {
                foreach ($validation->errors() as $error) {
                    $errArr[] = $error;
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../../includes/head.php" ?>
    <link rel="stylesheet" href="../../header.css">
    <title>Amazon : Shipping</title>
</head>

<body>
    <style>
        <?php require_once "index.css"; ?>
    </style>
    <!--Navbar -->
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
                        <p class="dropdown-item disabled" aria-disabled="true">$ <?php echo $user->data()->credits; ?></p>
                        <?php if ($user->data()->group_id == 2) { ?>
                            <a href="../../Admin/" class="dropdown-item" style="text-decoration: none;">
                                <i class="fas fa-user-shield"></i> Admin Panel
                            </a>
                        <?php } else { ?>
                            <a href="../Credits/index.php" class="dropdown-item" style="text-decoration: none;">
                                <p><i class="fas fa-award"></i> Get Credits</p>
                            </a>
                        <?php } ?>
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
    <!--/.Navbar -->
    <?php if (Session::exists('no-credits')) : ?>
        <div class="alert alert-danger"><?php echo Session::flash('no-credits'); ?> <span><a href="../Credits/index.php" class="text-info">Get Credits for free</a></span></div>
    <?php endif; ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="../Cart/index.php">Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shipping</li>
        </ol>
    </nav>
    <div class="container my-5 py-5">


        <!--Section: Content-->
        <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">

            <h3 class="font-weight-bold">Select a shipping address</h3>

            <hr class="my-3">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <form class="col-lg-7 col-md-12 mb-4 mb-md-0" method="POST" action="">


                    <!--Grid row-->
                    <div class="md-form md-outline mt-3">
                        <input type="text" id="form-first-name" name="name" class="form-control" value="<?php echo $user->data()->name; ?>">
                        <label for="form-first-name">Name</label>
                    </div>
                    <!-- Material outline input -->
                    <div class="md-form md-outline mt-3">
                        <input type="text" id="form-company" class="form-control" name="address" value="<?php echo escape(Input::get('address')); ?>">
                        <label for="form-company">Address</label>
                    </div>

                    <!-- Material outline input -->
                    <div class="md-form md-outline mt-3">
                        <input type="text" id="form-city" class="form-control" name="city" value="<?php echo escape(Input::get('city')); ?>">
                        <label for="form-city">City</label>
                    </div>

                    <div class="md-form md-outline mt-3">
                        <input type="text" id="form-country" class="form-control" name="country" value="<?php echo escape(Input::get('country')); ?>">
                        <label for="form-country">Country</label>
                    </div>

                    <div class="md-form md-outline mt-3">
                        <input type="text" id="form-email" name="email" class="form-control" value="<?php echo $user->data()->email; ?>">
                        <label for="form-email">Email</label>
                    </div>
                    <!-- Material outline input -->
                    <div class="md-form md-outline mt-3">
                        <input type="number" id="form-number" class="form-control" name="phone" value="<?php echo escape(Input::get('phone')); ?>">
                        <label for="form-number">Phone</label>
                    </div>

                    <!-- Material outline input -->
                    <div class="md-form md-outline">
                        <input type="text" id="form-zip" class="form-control" name="zip" value="<?php echo escape(Input::get('zip')); ?>">
                        <label for="form-zip">Zip / Postal Code</label>
                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    <button type="submit" class="btn btn-info btn-lg ml-0" name="cart-pay-submit">Pay <?php if (isset($_GET['i_value'])) : ?>$<?php echo $_GET['i_value']; ?><?php endif; ?><i class="far fa-paper-plane ml-2"></i></button>
                    <?php foreach ($errArr as $e) { ?>
                        <div class="alert alert-warning"><?php echo $e; ?></div>
                    <?php } ?>
                </form>
                <!--Grid column-->

            </div>
            <!--Grid row-->


        </section>
        <!--Section: Content-->


    </div>

</body>

</html>