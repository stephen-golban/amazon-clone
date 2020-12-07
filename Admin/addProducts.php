<?php include 'header.php';

$errArr = array();
$categRes = array();
foreach (DB::getInstance()->getOnly('categories') as $c) {
    $categRes[] = $c;
}
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'prodName' => array(
                'required' => true,
                'min' => 2,
            ),
            'prodImage' => array(
                'required' => true,
                'min' => 3,
            ),

            'prodDescription' => array(
                'required' => true,
                'min' => 3,
            ),

            'prodPrice' => array(
                'required' => true,
                'min' => 1,
                'noLetters' => true
            )
        ));

        if ($validation->passed()) {
            try {
                DB::getInstance()->insert('products', array(
                    'productName' => Input::get('prodName'),
                    'productImage' => Input::get('prodImage'),
                    'productDescription' => Input::get('prodDescription'),
                    'productPrice' => Input::get('prodPrice'),
                    'productCategory' => Input::get('prodCategory'),
                    'productRating' => 0
                ));
                Session::flash('success-c', 'Changes have been successfully saved!');
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
                <h1 class="page-header">Add Products</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add a new product
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form method="post" action="">
                            <?php if (Session::exists('success-c')) : ?>
                                <div class="alert alert-success"><?php echo Session::flash('success-c'); ?></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" id="name" class="form-control" name="prodName" autocomplete="off" value="<?php echo escape(Input::get('prodName')); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Product Image <span class="text-info">*image link</span></label>
                                <input type="text" name="prodImage" class="form-control" id="exampleFormControlFile1" value="<?php echo escape(Input::get('prodImage')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="prodDescription">Product Description</label>
                                <textarea id="prodDescription" class="form-control" name="prodDescription" autocomplete="off"><?php echo escape(Input::get('prodDescription')); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="text" id="price" class="form-control" name="prodPrice" autocomplete="off" value="<?php echo escape(Input::get('prodPrice')); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Product Category</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="prodCategory">
                                    <option><?php echo escape(Input::get('prodCategory')); ?></option>
                                    <?php foreach ($categRes as $c) { ?>
                                        <option><?php echo $c['categoryName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <?php
                            foreach ($errArr as $e) { ?>
                                <div class="alert alert-warning"><?php echo $e; ?></div>
                            <?php } ?>
                            <div class="form-group form-row">
                                <button type="submit" class="btn btn-default" name="add-product">Add Product</button>
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