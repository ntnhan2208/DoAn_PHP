<?php
session_start();
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ĐỒ ÁN CUỐI KỲ</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php include('includes/header.php'); ?>
  <!-- Page Content -->
  <div class="container">
    <div class="row" style="margin-top: 4%">
      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <!--Slide-->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php
            $query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc LIMIT 3");
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <div class="carousel-item">
                <h5 style="color: black;"><?php echo htmlentities($row['posttitle']); ?></h5>
                <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>"><img src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>" height="600" width="800"></a>
                <h4 style="color: black;"><?php echo htmlentities($row['posttitle']); ?></h4>
              </div>
            <?php } ?>
          </div>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!--EndSlide-->
        <br>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <h2>TIN TỨC</h2>
        <!-- Blog Post -->
        <?php
        if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
        } else {
          $pageno = 1;
        }
        $no_of_records_per_page = 4;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
        $result = mysqli_query($con, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
        while ($row = mysqli_fetch_array($query)) {
        ?>

          <div class="row">
            <div class="col-md-5 col-xs-12">
              <img src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>" height="100%" width="100%">
            </div>
            <div class="col-md-7">
              <a style="text-decoration:none;" href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>">
                <h4><?php echo htmlentities($row['posttitle']); ?></h4>
              </a>
              <p><b>Danh mục: </b> <a style="text-decoration:none;" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a> </p>
              <div>Đăng ngày <?php echo htmlentities($row['postingdate']); ?>
              </div>
            </div>
          </div>
          <hr style="height:1px;border-width:0;color:gray;background-color:gray">
        <?php } ?>
        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item"><a href="?pageno=1" class="page-link">Trang đầu</a></li>
          <li class="<?php if ($pageno <= 1) {
                        echo 'disabled';
                      } ?> page-item">
            <a href="<?php if ($pageno <= 1) {
                        echo '#';
                      } else {
                        echo "?pageno=" . ($pageno - 1);
                      } ?>" class="page-link">Trang trước</a>
          </li>
          <li class="<?php if ($pageno >= $total_pages) {
                        echo 'disabled';
                      } ?> page-item">
            <a href="<?php if ($pageno >= $total_pages) {
                        echo '#';
                      } else {
                        echo "?pageno=" . ($pageno + 1);
                      } ?> " class="page-link">Trang kế</a>
          </li>
          <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Trang cuối</a></li>
        </ul>
      </div>
      <!-- Sidebar Widgets Column -->
      <?php include('includes/sidebar.php'); ?>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <!-- Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: 3000
    });

    $('.carousel-item')[0].className = "carousel-item active";
  });
</script>

</html>