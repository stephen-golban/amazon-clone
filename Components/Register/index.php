<?php
require_once '../../core/init.php';

$errArr = array();
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 3,
                'max' => 50,
                'numbers' => true,
            ),
            'email' => array(
                'required' => true,
                'min' => 5,
                'max' => 64,
                'unique' => 'users',
                'mustBeEmail' => true
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
            $user = new User();
            $salt = Hash::salt(32);
            try {
                $user->create(array(
                    'email' => Input::get('email'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group_id' => 1,
                    'credits' => 50,
                ));
                Session::flash('login', 'You have been registered and can now log in!');
                Session::flash('congrats', 'Congratulations you have received $50 for registering!');
                Redirect::to('../Login/index.php');
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/logo.png">
    <title>Amazon Registration</title>
</head>

<body>
    <style>
        <?php include 'signup.css'; ?>
    </style>
    <div class="signup">
        <a href="../../index.php">
            <img class="signup__logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/1024px-Amazon_logo.svg.png" width="100px" alt="logo" />
        </a>

        <div class="signup__container">
            <h1>Create account</h1>
            <form method="post" action="">
                <h5>Your Name</h5>
                <input type="text" name="name" autocomplete="off" value="<?php echo escape(Input::get('name')); ?>" />
                <h5>E-mail</h5>
                <input type="text" name="email" autocomplete="off" value="<?php echo escape(Input::get('email')); ?>" />
                <h5>Password</h5>
                <input type="password" name="password" autocomplete="off" value="<?php echo escape(Input::get('password')); ?>" />
                <h5>Repeat Password</h5>
                <input type="password" name="password_again" autocomplete="off" value="<?php echo escape(Input::get('password_again')); ?>" />
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <?php
                foreach ($errArr as $e) { ?>
                    <div class="alert alert-warning"><?php echo $e; ?></div>
                <?php } ?>
                <button type="submit" name="signup-submit">Register</button>
            </form>
            <p>By creating an account, you agree to Amazon's Conditions of Use and Privacy Notice.
            </p>
            <a href="../Login/index.php"><button>Log into your account</button></a>
        </div>
    </div>
</body>

</html>