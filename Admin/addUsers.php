<?php include 'header.php';

$categRes = array();
$errArr = array();
foreach (DB::getInstance()->getOnly('categories') as $c) {
    $categRes[] = $c;
}
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
                Session::flash('added-u', 'You have successfully registered a new account!');
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

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add a new user
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form method="post" action="addUsers.php">
                            <?php if (Session::exists('added-u')) : ?>
                                <div class="alert alert-success"><?php echo Session::flash('added-u'); ?></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" id="name" class="form-control" name="name" autocomplete="off" value="<?php echo escape(Input::get('name')); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="email">User E-mail</label>
                                <input type="text" id="email" class="form-control" name="email" autocomplete="off" value="<?php echo escape(Input::get('email')); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="password">User Password</label>
                                <input type="password" id="password" class="form-control" name="password" autocomplete="off" value="<?php echo escape(Input::get('password')); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="r-pass">Repeat User Password</label>
                                <input type="password" name="password_again" id="r-pass" class="form-control" autocomplete="off" value="<?php echo escape(Input::get('password_again')); ?>" />
                            </div>
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <?php
                            foreach ($errArr as $e) { ?>
                                <div class="alert alert-warning"><?php echo $e; ?></div>
                            <?php } ?>
                            <div class="form-group form-row">
                                <button type="submit" class="btn btn-default" name="signup-submit">Register User</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include 'footer.php'; ?>