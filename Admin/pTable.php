<?php
include 'header.php';
$prodRes = array();
foreach (DB::getInstance()->getOnly('products') as $p) {
    $prodRes[] = $p;
}
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Products Table</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /.row -->
        <?php if (Session::exists('success-p')) : ?>
            <div class="alert alert-success"><?php echo Session::flash('success-p'); ?></div>
        <?php endif; ?>
        <?php if (Session::exists('f-deleted-p')) : ?>
            <div class="alert alert-danger"><?php echo Session::flash('f-deleted-p'); ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Products Table
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Img</th>
                                        <th>Desc</th>
                                        <th class="text-success">$</th>
                                        <th>Category</th>
                                        <th><i class="fa fa-star text-warning"></i></th>
                                        <th><i class="fa fa-trash text-danger"></i></th>
                                        <th><i class="fa fa-edit text-info"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($prodRes as $p) { ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $p['id']; ?></td>
                                            <td><?php echo substr($p['productName'], 0, 40); ?></td>
                                            <td><img src="<?php echo $p['productImage']; ?>" width="40px" height="40px" alt=""></td>
                                            <td><?php echo substr($p['productDescription'], 0, 100) . " <b>...</b>"; ?></td>
                                            <td><?php echo $p['productPrice']; ?></td>
                                            <td><?php echo $p['productCategory']; ?></td>
                                            <td><?php echo $p['productRating']; ?></td>
                                            <td>
                                                <form action="settings/delete.php" method="POST">
                                                    <input type="hidden" name="p_id" value="<?php echo $p['id']; ?>">
                                                    <button type="submit" name="product-delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="updateProducts.php?p_id=<?php echo $p['id']; ?>">Update</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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