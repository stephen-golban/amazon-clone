<?php
require_once '../../core/init.php';
$user = new User();
$errArr = array();
$cartItems = array();
$items = array();
$res = 0;

if (!$user->isLoggedIn()) {
    Redirect::to('Components/Login');
}
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
    <?php require_once "../../includes/head.php" ?>
    <link rel="stylesheet" href="../../header.css">
    <title>Amazon : <?php echo $user->data()->name . "'s Profile"; ?></title>
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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>
    <?php if (Session::exists('product-bought')) : ?>
        <div class="alert alert-success"><?php echo Session::flash('product-bought'); ?></div>
    <?php endif; ?>
    <?php if (count($items) > 0) : ?>
        <div class="cart__itemContainer">
            <div class="container">
                <h1 class="display-4">Shopping Cart</h1>
                <?php if (Session::exists('action-success')) : ?>
                    <div class="alert alert-success"><?php echo Session::flash('action-success'); ?></div>
                <?php endif; ?>
                <hr>
                <?php foreach ($items as $i) {
                    $res = $res + $i[3];
                    foreach (DB::getInstance()->get2('products', 'WHERE id =', $i[2]) as $ci) { ?>
                        <div class="cart__item">
                            <img src="<?php echo $ci[2]; ?>" alt="prod">
                            <div class="cart__itemDetails">
                                <div class="top">
                                    <a href="../Details/index.php?id=<?php echo $ci[0]; ?>">
                                        <p class="lead text-info"><?php echo $ci[1]; ?></p>
                                    </a>
                                    <p class="text-elegant"><b>$<?php echo $ci[4]; ?></b></p>
                                </div>
                                <form action="../../includes/removeFromCart.php" method="POST">
                                    <input type="hidden" name="c_i_d" value="<?php echo $ci[0]; ?>">
                                    <input type="hidden" name="cid" value="<?php echo $i[0]; ?>">
                                    <button type="submit" class="btn btn-outline-danger" name="remove-from-cart">Remove</button>
                                </form>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <div class="subtotal__container">
                <p class="h3 text-elegant">Subtotal (<?php if (count($items) > 1) {
                                                            echo count($items) . " items";
                                                        } else {
                                                            echo count($items) . " item";
                                                        } ?>) : <br></p>
                <p class="h4" style="font-weight: bold;">$ <?php echo $res; ?></p>
                <a class="btn btn-amber" href="../Buy/index.php?i_value=<?php echo $res; ?>">Proceed to checkout</a>
            </div>
        <?php endif; ?>
        <?php if (count($items) == 0) : ?>
            <div class="container">
                <h1 class="display-4">Your shopping cart is empty</h1>
                <hr>
            </div>
        <?php endif; ?>
</body>

</html>