<?php
require_once '../../core/init.php';
$user = new User();
$items = array();
if (!$user->isLoggedIn()) {
    Redirect::to('../Login');
}
$products = array();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach (DB::getInstance()->get('products', array('id', '=', $id))->first() as $p) {
        $products[] = $p;
    }
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
    <?php require_once '../../includes/head.php'; ?>
    <title>Amazon: Online Shopping System</title>
    <link rel="stylesheet" href="../../header.css">
</head>

<body>
    <style>
        <?php include 'index.css'; ?>
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

    <!-- PRODUCT -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="../Products/index.php?category=<?php echo $products[5]; ?>"><?php echo $products[5]; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $products[1]; ?></li>
        </ol>
    </nav>
    <?php if (Session::exists('product-bought')) : ?>
        <div class="alert alert-success"><?php echo Session::flash("product-bought"); ?></div>
    <?php endif; ?>
    <div class="details__container">
        <div class="details__product">
            <img src="<?php echo $products[2]; ?>" alt="<?php echo $products[1]; ?>">
            <div class="product__info">
                <p class="lead"><?php echo $products[1]; ?></p>
                <div class="rating">
                    <?php if ($products[6] == 0) : ?>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="text-danger" style="font-size: 13px;"><?php echo $products[6] . "/5"; ?></span>
                    <?php endif; ?>
                    <?php if ($products[6] == 1) : ?>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="text-danger" style="font-size: 13px;"><?php echo $products[6] . "/5"; ?></span>
                    <?php endif; ?>
                    <?php if ($products[6] == 2) : ?>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="text-danger" style="font-size: 13px;"><?php echo $products[6] . "/5"; ?></span>
                    <?php endif; ?>
                    <?php if ($products[6] == 3) : ?>
                        <span class="fas fa-star text-warning"></span>
                        <span class="fas fa-star text-warning"></span>
                        <span class="fas fa-star text-warning"></span>
                        <span class="fas fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="text-danger" style="font-size: 13px;"><?php echo $products[6] . "/5"; ?></span>
                    <?php endif; ?>
                    <?php if ($products[6] == 4) : ?>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star"></span>
                        <span class="text-danger" style="font-size: 13px;"><?php echo $products[6] . "/5"; ?></span>
                    <?php endif; ?>
                    <?php if ($products[6] == 5) : ?>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="text-danger" style="font-size: 13px;"><?php echo $products[6] . "/5"; ?></span>
                    <?php endif; ?>
                </div>
                <a class="text-info" href="../Products/index.php?category=<?php echo $products[5]; ?>"><?php echo "In " . $products[5]; ?></a>
                <hr>
                <p class="lead text-danger"><b>$</b> <?php echo $products[4]; ?></p>
                <p class="h3">About this item</p>
                <div class="text-elegant"><?php echo $products[3]; ?></div>
            </div>
        </div>
        <div class="checkout__container">
            <p class="lead text-elegant" style="font-size: 15px;">Availaible Credit: <b>$ <?php echo $user->data()->credits; ?></b></p>
            <form action="../Buy/index.php?i_value=<?php echo $products[4]; ?>" method="POST" style="margin-top: 0;">
                <p class="lead text-info" style="font-size: 15px;"><i class="fas fa-search-location"></i> Deliver to <b>Moldova</b></p>
                <p class="display-4 text-danger" style="font-size: 25px; margin-bottom: 10px; text-align:start;"><b>$<?php echo $products[4] . "</b>"; ?></p>
                <button type="submit" name="fast-pay-submit" class="btn btn-amber">Buy Now</button>
            </form>
            <form action="../../includes/addToCart.php" method="POST">
                <input type="hidden" name="prodID" value="<?php echo $products[0]; ?>">
                <hr>
                <input type="hidden" name="product_price" value="<?php echo $products[4]; ?>">
                <button type="submit" class="btn btn-outline-elegant" name="add-to-cart">Add to cart</button>
            </form>
            <?php if (Session::exists('action-success')) : ?>
                <div class="alert alert-success"><?php echo Session::flash('action-success'); ?></div>
            <?php endif; ?>
        </div>
    </div>
    <!-- END PRODUCT -->
</body>

</html>