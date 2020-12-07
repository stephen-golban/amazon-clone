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
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];
$_SESSION['redirectTo'] = $url;
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 3,
                'max' => 50,
                'numbers' => true,
                'same-name' => 'name_current'
            )
        ));
        if ($validation->passed()) {
            try {
                $user->update(array(
                    'name' => Input::get('name'),
                ));
                Session::flash('acc-updated', 'Your name was successfully updated!');
                Redirect::to('index.php');
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
    <div class="container" style="margin-top: 150px;">
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
                    <div class="col-md-7 mb-lg-0 mb-4">

                        <!-- Form -->
                        <div class="col-lg-8 order-lg-2">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" data-target="#roles" data-toggle="tab" class="nav-link">Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a href="changePassword.php" class="nav-link">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content py-4">
                                <div class="tab-pane active" id="profile">
                                    <form role="form" method="post" action="">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" name="name" value="<?php echo escape($user->data()->name); ?>">
                                                <input class="form-control" type="hidden" name="name_current" value="<?php echo escape($user->data()->name); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">E-mail</label>
                                            <div class="col-lg-9">
                                                <input class="form-control disabled" disabled type="email" name="email" value="<?php echo escape($user->data()->email); ?>">
                                            </div>
                                        </div>
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <?php
                                        foreach ($errArr as $e) { ?>
                                            <div class="alert alert-warning"><?php echo $e; ?></div>
                                        <?php } ?>
                                    </form>
                                </div>
                                <div class="tab-pane" id="roles">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Roles</h4>
                                            <a class="badge badge-dark badge-pill"><?php echo $permissions; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Form -->

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </section>
            <!--Section: Content-->


        </div>

    </div>
</body>

</html>