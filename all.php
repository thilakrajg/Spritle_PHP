<?php session_start();
error_reporting(E_ERROR | E_PARSE);
 $user = $_SESSION['username'];
 
 include('connection.php');

 $sql = "SELECT * FROM thoughts ORDER BY id DESC";
 $res = mysqli_query($conn,$sql); 
 
if (isset($_GET['like']))
{
 $id = $_GET['like']; 
 $sqllike = "SELECT * FROM thoughts WHERE id='$id' ";
 $reslike = mysqli_query($conn,$sqllike);
 $fetchlike = mysqli_fetch_assoc($reslike);
 
 $like  = $fetchlike['likes'];
 $likes = $like+1;


  $id = $_GET['like']; 
  $sqlupdate = "UPDATE thoughts set likes = '$likes' where id = '$id' ";
   if($result = mysqli_query($conn, $sqlupdate)){
     echo "<script>  
    window.location.href='all.php';
    </script>";
   }

} 

?>


<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Interesting Thoughts</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              Interesting Thoughts  
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="all.php">All</a>
              </li> 

<?php if($user!=''){ ?>
              <li class="nav-item">
                <a class="nav-link" href="add.php">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  <span>
                    Add Thoughts
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Logout
                  </span>
                </a>
              </li>
<?php } else{ ?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Login
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Sign Up
                  </span>
                </a>
              </li> 
<?php } ?>


            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- job section -->
  <section class="job_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          All Thoughts
        </h2>
      </div>

      <div class="job_container">
        <div class="row">     
     <?php 

 while($fetch = mysqli_fetch_assoc($res)){

 $id  = $fetch['id'];
 $username  = $fetch['username'];
 $thoughts  = $fetch['thoughts'];
 $likes  = $fetch['likes'];
 $date1  = $fetch['date'];
 $date  = date("d-m-Y", strtotime($date1));

?>
          <div class="col-lg-6">
            <div class="box">
              <div class="job_content-box">
                <div class="img-box">
                  <img src="images/job_logo4.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    <?php  echo  $username ?>
                  </h5>
                  <div class="detail-info">
                    <h6>
                     <span>
                        <?php  echo  $thoughts ?>
                      </span>
                    </h6>
                </div>
                    <br>
                    <div>
                  Posted on:  <?php  echo  $date ?>
                 </div>
                </div>
              </div>
              <div class="option-box">


<?php if($user!=''){ ?>
                <a href="all.php?like=<?php echo $id; ?>">
            <span id = heart1><i class="fa fa-heart"  aria-hidden="true" ></i> </span></a>
                        <?php  echo  $likes ?>&nbsp;&nbsp;&nbsp;
 <?php } else{ ?>            

                <a href="all.php" onclick="alert('Please Login to like');">
                  <span id = heart1><i class="fa fa-heart"  aria-hidden="true" ></i> </span></a>
                        <?php  echo  $likes ?>&nbsp;&nbsp;&nbsp;
 <?php } ?> 



 
<?php if($user!=''){ ?>
                <a href="details.php?id=<?php echo $id ?>" class="apply-btn">
                  comment
                </a>
<?php } else{ ?>      
                <a href="login.php" class="apply-btn" onclick="alert('Please Login to Comment');">
                  comment
                </a>
 <?php } ?> 
 


              </div>
            </div>
          </div>
    <?php } ?>
         
        </div>
      </div>

    </div>
  </section>
  <!-- end job section -->
  </div>

  
 
  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>


</body>

</html>