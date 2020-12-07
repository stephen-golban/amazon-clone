<?php
require_once '../../core/init.php';
$user = new User();
$path = "C://xampp/htdocs/Amazon/";
$errArr = array();

if (!$user->isLoggedIn()) {
    Redirect::to('Components/Login');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_current' => array(
                'required' => true,
                'min' => 5,
                'capital' => true,
                'same' => 'password'
            ),
            'password' => array(
                'required' => true,
                'min' => 5,
                'capital' => true
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password',
            ),
        ));
        if ($validation->passed()) {
            try {
                if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                    Session::flash('incorrect-password', 'Incorrect current password!');
                    Redirect::to('changePassword.php');
                } else {
                    $salt = Hash::salt(32);
                    $user->update(array(
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt
                    ));
                    Session::flash('acc-updated', 'Your password was successfully updated!');
                    Redirect::to('changePassword.php');
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                $errArr[] = $error;
            }
        }
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
    <title>Amazon: Online Shopping System</title>
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
                        <a class="dropdown-item" href="index.php">
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
    <div class="container" style="margin-top: 200px; padding: 0 100px;">
        <?php if (Session::exists('acc-updated')) : ?>
            <div class="alert alert-success"><?php echo Session::flash('acc-updated'); ?></div>
        <?php endif; ?>
        <?php if (Session::exists('incorrect-password')) : ?>
            <div class="alert alert-danger"><?php echo Session::flash('incorrect-password'); ?></div>
        <?php endif; ?>
        <div class="container z-depth-1 my-5 p-5">

            <!-- Section -->
            <section>

                <h3 class="font-weight-normal text-center dark-grey-text my-4 pb-2">Change your password</h3>

                <!--First row-->
                <form class="row d-flex justify-content-center" role="form" method="post" action="">

                    <div class="col-md-6 col-lg-3 mb-4">
                        <!-- Material outline input -->
                        <div class="md-form md-outline form-lg">
                            <input class="form-control form-control-lg" id="form1" name="password_current" type="password" value="<?php echo escape(Input::get('password_current')); ?>">
                            <label for="form1">Current Password</label>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <!-- Material outline input -->
                        <div class="md-form md-outline form-lg">
                            <input class="form-control form-control-lg" id="form2" name="password" type="password" value="<?php echo escape(Input::get('password')); ?>">
                            <label for="form2">New Password</label>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">

                        <!-- Material outline input -->
                        <div class="md-form md-outline form-lg">
                            <input class="form-control form-control-lg" id="form3" name="password_again" type="password" value="<?php echo escape(Input::get('password_again')); ?>">
                            <label for="form3">Confirm New Password</label>
                        </div>

                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <div class="col-md-6 col-lg-3 mb-4">

                        <button class="btn btn-block btn-primary my-4">Save</button>
                        <a href="index.php" class="btn btn-block btn-outline-danger">Cancel</a>

                    </div>

                </form>
                <?php
                foreach ($errArr as $e) { ?>
                    <div class="alert alert-warning"><?php echo $e; ?></div>
                <?php } ?>
                <!--First row-->

            </section>
            <!-- Section -->
        </div>

    </div>
</body>

</html>