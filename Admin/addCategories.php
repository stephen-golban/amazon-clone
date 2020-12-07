<?php include 'header.php';

$errArr = array();
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'categName' => array(
                'required' => true,
                'min' => 3,
            ),
            'categImage' => array(
                'required' => true,
                'min' => 3,
            )
        ));

        if ($validation->passed()) {
            try {
                DB::getInstance()->insert('categories', array(
                    'categoryName' => Input::get('categName'),
                    'categoryImage' => Input::get('categImage')
                ));
                Session::flash('added-c', 'You have successfully added a new category!');
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
                <h1 class="page-header">Add Categories</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add a new category
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form method="post" action="">
                            <?php if (Session::exists('added-c')) : ?>
                                <div class="alert alert-success"><?php echo Session::flash('added-c'); ?></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" id="name" class="form-control" name="categName" autocomplete="off" value="<?php echo escape(Input::get('categName')); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Category Image <span class="text-info">*image link</span></label>
                                <input type="text" name="categImage" class="form-control" id="exampleFormControlFile1" value="<?php echo escape(Input::get('categImage')); ?>">
                            </div>
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <?php
                            foreach ($errArr as $e) { ?>
                                <div class="alert alert-warning"><?php echo $e; ?></div>
                            <?php } ?>
                            <div class="form-group form-row">
                                <button type="submit" class="btn btn-default" name="add-category">Add Category</button>
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