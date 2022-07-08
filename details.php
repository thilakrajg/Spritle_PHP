<?php session_start();
 include('connection.php');

$get_id = $_GET['id'];


 $sql = "SELECT * FROM thoughts WHERE id='$get_id' ";
 $res = mysqli_query($conn,$sql);
$fetch = mysqli_fetch_assoc($res);

 $id  = $fetch['id'];
 $username  = $fetch['username'];
 $thoughts  = $fetch['thoughts'];
 $likes1  = $fetch['likes'];

 $date1  = $fetch['date'];
 $date  = date("d-m-Y", strtotime($date1));
 



if (isset($_GET['like']))
{
  $id = $_GET['like']; 

 $sqllike = "SELECT * FROM thoughts WHERE id='$id' ";
 $reslike = mysqli_query($conn,$sqllike);
 $fetchlike = mysqli_fetch_assoc($reslike);
 
 $like  = $fetchlike['likes'];
 $likes = $like+1;

 $sqlupdate = "UPDATE thoughts set likes = '$likes' where id = '$id' ";
   
   if($result = mysqli_query($conn, $sqlupdate)){
     echo "<script>  
    window.location.href='details.php?id=$id';
    </script>";
   }

} 






  if(isset($_POST['submit'])){
    $newcomment = $_POST['comments'];
    $newid = $_POST['id'];

    $ins = "INSERT INTO comments(t_id,comments) VALUES ('$newid','$newcomment')";
    $qrycmt = mysqli_query($conn,$ins);
    if($qrycmt){
     echo "<script>  
    window.location.href='details.php?id=$id';
    </script>";
   }

  }
?>

<style>
/* CSS */
.button-7 {
  background-color: #0095ff;
  border: 1px solid transparent;
  border-radius: 3px;
  box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI","Liberation Sans",sans-serif;
  font-size: 13px;
  font-weight: 400;
  line-height: 1.15385;
  margin: 0;
  outline: none;
  padding: 8px .8em;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: baseline;
  white-space: nowrap;
}

.button-7:hover,
.button-7:focus {
  background-color: #07c;
}

.button-7:focus {
  box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
}

.button-7:active {
  background-color: #0064bd;
  box-shadow: none;
}
</style>

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
          Detailed Thoughts
        </h2>
      </div>

      <div class="job_container">
        <div class="row">     

          <div class="col-lg-12">
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

                <a href="details.php?like=<?php echo $id; ?>">
            <span id = heart1><i class="fa fa-heart"  aria-hidden="true" ></i> </span></a>
                        <?php  echo  $likes1 ?> likes
                </div>

<br>
<br>
<hr>
Comments:

  <?php


 $sqlcmt = "SELECT * FROM comments WHERE t_id='$get_id' ";
 $rescmt = mysqli_query($conn,$sqlcmt); 

  while($fetchcmt = mysqli_fetch_assoc($rescmt)){ 

  $t_id = $fetchcmt['t_id'];
  $comments = $fetchcmt['comments'];
  $datecmt = $fetchcmt['date'];

  ?>

<div class="col-lg-6">
            <div class="box">
 <?php   echo  $comments  ?>
              </div>
            </div>

 <?php   }  ?>


    <form method="POST" action="">
      <div class="col-lg-6">
        <div class="box">
          <input type="hidden" name="id" value="<?php echo $id; ?>" placeholder="Add New Comments"/>
          <input type="textarea" name="comments" placeholder="Add New Comments"/>
          <button  class="button-7" type="submit" name="submit">Submit</button>
        </div>
      </div>
    </form>



              </div>
            </div>
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