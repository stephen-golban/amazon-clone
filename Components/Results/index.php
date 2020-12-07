<?php
require_once '../../core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('../Login');
}
$products = array();
$categories = array();
$items = array();
if (isset($_POST['search-submit'])) {
    $query = $_POST['search-query'];
    foreach (DB::getInstance()->get3('products', 'WHERE productName', $query) as $p) {
        $products[] = $p;
    }
}
foreach (DB::getInstance()->getOnly('categories') as $c) {
    $categories[] = $c;
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
                        <?php if ($user->isLoggedIn()) : ?>
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
    <!--/.Navbar -->
    <div class="results__row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $query; ?></li>
            </ol>
        </nav>
        <?php if (isset($_GET['category'])) {
            echo "<span class='lead'><strong>" . count($products) . "</strong> results for <span style='color: orange; font-weight: bold;'>" . $_GET['category'] . "</span> category</span>";
        } ?>
    </div>
    <div class="products__container">
        <div class="products">
            <?php foreach ($products as $prod) { ?>
                <div class="product">
                    <a href="../Details/index.php?id=<?php echo $prod['id']; ?>">
                        <?php echo "<img class='rounded' src='" . $prod['productImage'] . "'/>"; ?>
                    </a>
                    <div class="product__body">
                        <a href="../Details/index.php?id=<?php echo $prod['id']; ?>">
                            <h5><?php echo $prod['productName']; ?></h5>
                        </a>
                        <p><?php $string = $prod['productDescription'];
                            echo $string = (strlen($string) > 60) ? substr($string, 0, 200) . '...' : $string; ?></p>
                        <p class="lead"><?php echo "<strong>$</strong> " . $prod['productPrice']; ?></p>
                        <div class="rating">
                            <?php if ($prod['productRating'] == "0") : ?>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="text-danger" style="font-size: 13px;"><?php echo $prod['productRating'] . "/5"; ?></span>
                            <?php endif; ?>
                            <?php if ($prod['productRating'] == "1") : ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="text-danger" style="font-size: 13px;"><?php echo $prod['productRating'] . "/5"; ?></span>
                            <?php endif; ?>
                            <?php if ($prod['productRating'] == "2") : ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="text-danger" style="font-size: 13px;"><?php echo $prod['productRating'] . "/5"; ?></span>
                            <?php endif; ?>
                            <?php if ($prod['productRating'] == "3") : ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="text-danger" style="font-size: 13px;"><?php echo $prod['productRating'] . "/5"; ?></span>
                            <?php endif; ?>
                            <?php if ($prod['productRating'] == "4") : ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="text-danger" style="font-size: 13px;"><?php echo $prod['productRating'] . "/5"; ?></span>
                            <?php endif; ?>
                            <?php if ($prod['productRating'] == "5") : ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="text-danger" style="font-size: 13px;"><?php echo $prod['productRating'] . "/5"; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>