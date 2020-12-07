<?php require_once '../core/init.php';

$user = new User();
$userRes = array();
foreach (DB::getInstance()->getOnly('users') as $u) {
    $userRes[] = $u;
}
?>
<?php include 'header.php'; ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users Table</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <?php if (Session::exists('success-u')) : ?>
            <div class="alert alert-success"><?php echo Session::flash('success-u'); ?></div>
        <?php endif; ?>
        <?php if (Session::exists('f-deleted-u')) : ?>
            <div class="alert alert-danger"><?php echo Session::flash('f-deleted-u'); ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users Table
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Joined</th>
                                        <th>User Group</th>
                                        <th>Credits</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userRes as $u) { ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $u['id']; ?></td>
                                            <td class="center"><?php echo $u['name']; ?></td>
                                            <td class="center"><?php echo $u['email']; ?></td>
                                            <td class="center"><?php echo $u['joined']; ?></td>
                                            <td class="center"><?php echo $u['group_id']; ?></td>
                                            <td class="center"><?php echo $u['credits']; ?></td>
                                            <td>
                                                <form action="settings/delete.php" method="POST">
                                                    <input type="hidden" name="u_id" value="<?php echo $u['id']; ?>">
                                                    <button type="submit" name="user-delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="updateUsers.php?uid=<?php echo $u['id']; ?>" class="btn btn-info">Update</a>
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