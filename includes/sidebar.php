<link href="css/modern-business.css" type="text/css" type="stylesheet">
<div class="col-md-4">

  <!-- Search Widget -->
  <div class="card mb-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <form name="search" action="search.php" method="post">
        <div class="input-group">

          <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
      </form>
    </div>
  </div>
</div>
<!-- Categories Widget -->
<div class="card my-4">
  <h5 class="card-header">Categories</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6">
        <ul class="list-unstyled mb-0">
          <?php $query = mysqli_query($con, "select id,CategoryName from tblcategory");
          while ($row = mysqli_fetch_array($query)) {
          ?>

            <li>
              <a href="category.php?catid=<?php echo htmlentities($row['id']) ?>"><?php echo htmlentities($row['CategoryName']); ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>

    </div>
  </div>
</div>

<!-- Side Widget -->
<div class="card my-4">
  <h5 class="card-header">Recent News</h5>
  <div class="card-body">
    <marquee scrollamount="4" direction="up">
      <ul class="mb-0">
        <?php
        $query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
        while ($row = mysqli_fetch_array($query)) {

        ?>

          <li>
            <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>"><?php echo htmlentities($row['posttitle']); ?></a>
          </li>
        <?php } ?>
        <?php
        $url = 'https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=c951fbf67f97460fa2621b5d2a814fa6';
        $response = file_get_contents($url);
        $NewsData = json_decode($response);
        ?>
        <div class="container-fluid">
          <?php
          foreach ($NewsData->articles as $News) {

          ?>
            <li>
              <div class="card1">
                <a> <?php echo $News->title ?></a>
              </div>
            </li>
          <?php } ?>
      </ul>
    </marquee>
  </div>
</div>


<!-- Side Widget -->
<div class="card my-4">
  <h5 class="card-header">Popular News</h5>
  <div class="card-body">
    <marquee scrollamount="4" direction="up">
      <ul>
        <?php
        $query1 = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId  order by viewCounter desc limit 5");
        while ($result = mysqli_fetch_array($query1)) {

        ?>

          <li>
            <a href="news-details.php?nid=<?php echo htmlentities($result['pid']) ?>"><?php echo htmlentities($result['posttitle']); ?></a>
          </li>
        <?php } ?>
      </ul>
    </marquee>
  </div>
</div>