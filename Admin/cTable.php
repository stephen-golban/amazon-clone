<?php include 'header.php';

$categRes = array();
foreach (DB::getInstance()->getOnly('categories') as $c) {
    $categRes[] = $c;
}
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users Table</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <?php if (Session::exists('success-c')) : ?>
            <div class="alert alert-success"><?php echo Session::flash('success-c'); ?></div>
        <?php endif; ?>
        <?php if (Session::exists('f-deleted-c')) : ?>
            <div class="alert alert-danger"><?php echo Session::flash('f-deleted-c'); ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categories Table
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Category Image</th>
                                        <th>Category Name</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categRes as $c) { ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $c['id']; ?></td>
                                            <td><img src="<?php echo $c['categoryImage']; ?>" width="40px" height="40px" alt="category" style="object-fit: contain;"></td>
                                            <td><?php echo $c['categoryName']; ?></td>
                                            <td>
                                                <form action="settings/delete.php" method="POST">
                                                    <input type="hidden" name="c_id" value="<?php echo $c['id']; ?>">
                                                    <button type="submit" name="category-delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="updateCategory.php?c_id=<?php echo $c['id']; ?>">Update</td>
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