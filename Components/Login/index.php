<?php
require_once '../../core/init.php';

$errArr = array();
$loginOutput = "";
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array('required' => true, 'mustBeEmail' => true),
            'password' => array('required' => true, 'capital' => true),
        ));

        if ($validation->passed()) {
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('email'), Input::get('password'), $remember);
            if ($login) {
                Session::flash('loggedIn', 'You have been logged in successfully!');
                Redirect::to('../../index.php');
            } else {
                Session::flash('loggedIn-fail', 'Login failed, check your inputs!');
            }
        } else {
            foreach ($validation->errors() as $error) {
                $errArr[] = $error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="https://www.pinclipart.com/picdir/big/313-3134049_amazon-button-clipart.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php
    if (Session::exists('login')) : ?>
        <div class="alert alert-success"><?php echo Session::flash('login'); ?></div>
    <?php endif; ?>
    <?php if (Session::exists('loggedIn-fail')) : ?>
        <div class="alert alert-warning"><?php echo Session::flash('loggedIn-fail'); ?></div>
    <?php endif; ?>

    <div class="login">
        <a href="../../index.php">
            <img class="login__logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/1024px-Amazon_logo.svg.png" width="100px" alt="logo" />
        </a>

        <div class="login__container">
            <h1>Sign in</h1>
            <form action="" method="post">
                <h5>E-mail</h5>
                <input type="text" name="email" autocomplete="off" value="<?php echo escape(Input::get('email')); ?>" />
                <h5>Password</h5>
                <input type="password" name="password" autocomplete="off" value="<?php echo escape(Input::get('password')); ?>" />
                <?php foreach ($errArr as $e) { ?>
                    <div class="alert alert-warning"><?php echo $e; ?></div>
                <?php } ?>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button type="submit">Login</button>
            </form>
            <p>By signing-in you agree to Amazon's Conditions of Use & Sale. Please see our
                Privacy Notice, our Cookies Notice and our Interest-Based Ads Notice.
            </p>
            <a href="../Register/index.php"><button>Create your Amazon Account</button></a>
        </div>
    </div>
</body>

</html>