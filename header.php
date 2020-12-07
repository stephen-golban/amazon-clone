<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('Components/Login');
}
$items = array();
foreach (DB::getInstance()->get2('cart', 'WHERE user_id =', $user->data()->id)  as $o) {
    $items[] = $o;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php'; ?>
    <link rel="stylesheet" href="header.css">
    <title>Amazon: Online Shopping System</title>
</head>

<body>
    <style>
        <?php include "main.css" ?>
    </style>
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark elegant-color-dark">
        <a href="../../index.php"><img class="navbar-brand" src="https://pngimg.com/uploads/amazon/amazon_PNG11.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <form class="header__search" action="Components/Results/index.php" method="POST">
                <input type="text" className="header__searchInput" autocomplete="Off" placeholder="e.g Iphone" />
                <button type="submit" name="search-submit" id="search__submit"><i class="fa fa-search"></i></button>
            </form>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="Components/Cart/index.php">
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
                            <a href="Admin/" class="dropdown-item" style="text-decoration: none;">
                                <i class="fas fa-user-shield"></i> Admin Panel
                            </a>
                        <?php } else { ?>
                            <a href="Components/Credits/index.php" class="dropdown-item" style="text-decoration: none;">
                                <p><i class="fas fa-award"></i> Get Credits</p>
                            </a>
                        <?php } ?>
                        <a class="dropdown-item" href="Components/Profile/index.php">
                            <i class="fas fa-user"></i> Account
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="includes/logout.inc.php">
                            <i class="fas fa-power-off"></i> Log Out
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--/.Navbar -->