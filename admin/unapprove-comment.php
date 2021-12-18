<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if ($_GET['disid']) {
        $id = intval($_GET['disid']);
        $query = mysqli_query($con, "update tblcomments set status='0' where id='$id'");
        $msg = "Bình luận không được duyệt!";
    }
    // Code for restore
    if ($_GET['appid']) {
        $id = intval($_GET['appid']);
        $query = mysqli_query($con, "update tblcomments set status='1' where id='$id'");
        $msg = "Bình luận đã được duyệt!";
    }

    // Code for deletion
    if ($_GET['action'] == 'del' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($con, "delete from  tblcomments  where id='$id'");
        $delmsg = "Bình luận đã được xoá!";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>ĐỒ ÁN CUỐI KỲ</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">QUẢN LÝ BÌNH LUẬN</h4>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">

                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Thành công!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($delmsg) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Thành công!</strong> <?php echo htmlentities($delmsg); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên người binh luận</th>
                                                        <th>Email</th>
                                                        <th width="300">Bình luận</th>
                                                        <th>Trạng thái</th>
                                                        <th>Bài viết</th>
                                                        <th>Ngày đăng</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "Select tblcomments.id,  tblcomments.name,tblcomments.email,tblcomments.postingDate,tblcomments.comment,tblposts.id as postid,tblposts.PostTitle from  tblcomments join tblposts on tblposts.id=tblcomments.postId where tblcomments.status=0");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['name']); ?></td>
                                                            <td><?php echo htmlentities($row['email']); ?></td>
                                                            <td><?php echo htmlentities($row['comment']); ?></td>
                                                            <td><?php $st = $row['status'];
                                                                if ($st == '0') :
                                                                    echo "Đợi duyệt";
                                                                else :
                                                                    echo "Đợi duyệt";
                                                                endif;
                                                                ?></td>
                                                            <td><a href="edit-post.php?pid=<?php echo htmlentities($row['postid']); ?>"><?php echo htmlentities($row['PostTitle']); ?></a> </td>
                                                            <td><?php echo htmlentities($row['postingDate']); ?></td>
                                                            <td>
                                                                <?php if ($st == '0') : ?>
                                                                    <a href="unapprove-comment.php?disid=<?php echo htmlentities($row['id']); ?>" title="Disapprove this comment"><span>Ẩn</span></a>
                                                                <?php else : ?>
                                                                    <a href="unapprove-comment.php?appid=<?php echo htmlentities($row['id']); ?>" title="Approve this comment"><span>Duyệt</span></a>
                                                                <?php endif; ?>

                                                                &nbsp;<a href="unapprove-comment.php?rid=<?php echo htmlentities($row['id']); ?>&&action=del"><span>Xoá</span></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- end row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>

            </div>
            <!-- END wrapper -->

            <script>
                var resizefunc = [];
            </script>

            <!-- jQuery  -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="../plugins/switchery/switchery.min.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>