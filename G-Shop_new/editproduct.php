<?php
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION['email'])) header("Location: login.php");
else if($_SESSION['usertype'] != 0) header("Location: index.php");

if(isset($_GET['logout'])&&$_GET['logout']==1){
        #echo "<script type=\"text/javascript\"> </script>";
        session_destroy();
        header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!--Custom CSS-->
    <link href="./css/style.css" rel="stylesheet">
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!--Animate CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <!--Wow JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

  <title>G-Shop | Manage Items</title>
  
  </head>
  <body>
  
      <div class="container-fluid header-bg" id="home">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
            <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!--width="183px" height="107.1px" -->
      <a class="navbar-brand wow fadeInLeft" href="#"><img src="assets/logo.png" class="img-responsive" width="102px" height="51.4px"></a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto wow fadeInRight">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">HOME </a>
          </li>
          <li class="nav-item">
            <?php
              if(!empty($_SESSION['email'])){
                  echo "<a class=\"nav-link\" href=\"index.php?logout=1\">LOG OUT</a>";
              }
              else{
                  echo "<a class=\"nav-link\" href=\"login.php\">LOGIN</a>";                
              }
            ?>          
        </li>
         <li class="nav-item">
            <?php
              if(!empty($_SESSION['email'])){
                if($_SESSION["usertype"]==0)
                {   //IF THE USER IS ADMIN, ADMIN CAN MANAGE ITEMS.
                      echo "<a class=\"nav-link\" href=\"manage.php\">MANAGE ITEMS</a> <span class=\"sr-only\">(current)</span>";
                }
              }
            ?>
          </li>
        </ul>
      </div>
      </div>
    </nav>
   
    <div class="container desc-main wow fadeInUp">
        <div class="row">
            <div class="col-md-8">
                <h1 class="display-3" style="color: #FFFFFF;">Preloved items, tailored for you.</h1>
                <?php
                  if(!empty($_SESSION['email'])&&$_SESSION["usertype"]==0){
                    echo "<p class=\"lead\">Manage your items, ".$_SESSION["first_name"]. "! </p>";
                  }
                ?>
            </div>
        </div>
        <div class="row"></a></div>
    </div>
    </div>
    
    <div class="container compo">
      <div class="row">
      <?php
        if(!empty($_GET["id"])&&$_GET["edit"]==1){
            include('edit.php?id='.$_GET["id"]);
        }

      ?>
      </div>  
    </div>

    
    <div class="footer">
        <div class="container">
            <h5><strong>Copyright</strong></h5>
            
        </div>
    </div>
    
    
    
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script>
      
      
      // Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
      
      </script>
    <script>
      $(document).ready(function(){
          $(window).scroll(function() {
              var scroll = $(window).scrollTop();
              if (scroll > 50) {
                  $(".navbar").css("background" , "#333");
              }
              
              else {
                  $(".navbar").css("background" , "transparent");
              }
          })
      })
    </script>
    <script>
    new WOW().init();  
    </script>
    
    
    
    
    
    
    
    
    
    
    
    
  </body>
</html>