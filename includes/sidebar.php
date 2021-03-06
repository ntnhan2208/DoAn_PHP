  
  <div class="col-md-4">
    <!-- Search Widget -->
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm</h5>
      <div class="card-body">
        <form name="search" action="search.php" method="post">
          <div class="input-group">
            <input type="text" name="searchtitle" class="form-control" placeholder="Nhập tựa đề cần tìm..." required>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="submit">Tìm</button>
            </span>
        </form>
      </div>
    </div>
  </div>

  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Danh mục</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0">
            <?php $query = mysqli_query($con, "select id,CategoryName from tblcategory");
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <li>
                <a style="text-decoration:none;" href="category.php?catid=<?php echo htmlentities($row['id']) ?>"><?php echo htmlentities($row['CategoryName']); ?></a>
              </li>
            <?php } ?>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header">Tin mới đăng</h5>
    <div class="card-body">
      <ol class="list-unstyled mb-0" >
        <?php
        $query = mysqli_query($con, "select tblposts.PostingDate as postingdate,tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId order by tblposts.PostingDate desc limit 5");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <li>
            <a style="text-decoration:none;" href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>"><?php echo htmlentities($row['posttitle']); ?></a>
            (<?php echo htmlentities($row['postingdate']);?>)
          </li>
        <?php } ?>
      </ol>
    </div>
  </div>

  </div>