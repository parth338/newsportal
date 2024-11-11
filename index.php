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

    <title>News Portal | Home Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
   <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">


     
      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <!-- Blog Post -->
<?php 
  
  $url = 'https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=c951fbf67f97460fa2621b5d2a814fa6';//open this link to chrome to get news
   // $my_url = urlencode("$url");
  $response = file_get_contents($url);
  $NewsData = json_decode($response);
  ?>
  <div class="container-fluid">
   <?php
   foreach($NewsData->articles as $News)
   {

   ?>
    <div class="card mb-4">
      <img  class="card-img-top" src="<?php echo $News->urlToImage ?>" alt="News thumbnail">
    </div>
    <div class="card-body">
    <h2>title: <?php echo $News->title ?> </h2>
    <h5>description: <?php echo $News->description ?></h5>
    <p>Content: <?php echo $News->content ?></p>
    <a href="<?php echo $News->url?>" style="color:brown;">Read More</a>
    <h6>author: <?php echo $News->author ?></h6>
    <h6>Published: <?php echo $News->publishedAt ?></h6>

    </div>
    
  <?php
  
  }
  
  ?>
   </div>
  
   <?php 
 $url = 'https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=c951fbf67f97460fa2621b5d2a814fa6';//open this link to chrome to get news
  $response = file_get_contents($url);
  $NewsData = json_decode($response);
  ?>
  <div class="container-fluid">
   <?php
   foreach($NewsData->articles as $News)
   {

   ?>
    <div class="card mb-4">
      <img  class="card-img-top" src="<?php echo $News->urlToImage ?>" alt="News thumbnail">
    </div>
    <div class="card-body">
    <h2>title: <?php echo $News->title ?> </h2>
    <h5>description: <?php echo $News->description ?></h5>
    <p>Content: <?php echo $News->content ?></p>
    <a href="<?php echo $News->url?>" style="color:darkred;">Read More</a>
    <h6>author: <?php echo $News->author ?></h6>
    <h6>Published: <?php echo $News->publishedAt ?></h6>

    </div>
  <?php
  }
  ?>
   </div>
   <?php 
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
   

$query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
while ($row=mysqli_fetch_array($query)) {
?>

          <div class="card mb-4">
 <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                 <p><!--category-->
 <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid'])?>" style="color:#fff"><?php echo htmlentities($row['category']);?></a>
<!--Subcategory--->
  <a class="badge bg-secondary text-decoration-none link-light"  style="color:#fff"><?php echo htmlentities($row['subcategory']);?></a></p>
       
              <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo htmlentities($row['postingdate']);?>
           
            </div>
          </div>
<?php } ?>
       

      

          <!-- Pagination -->


    <ul class="pagination justify-content-center mb-4">
        <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
        </li>
        <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
    </ul>

        </div>

          <!-- Pagination -->

        <!-- Sidebar Widgets Column -->
      <?php include('includes/sidebar.php');?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
      <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 
</head>
  </body>

</html>
