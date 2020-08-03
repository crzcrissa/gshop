<?php
require('db.php');

if(!isset($_SESSION)){
  session_start();
}

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

    <title>G-Shop | Home </title>
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
            <a class="nav-link" href="#home">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#compo">WHY BUY PRE-LOVED CLOTHES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="store.php">PRODUCTS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">CONTACT US</a>
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
                      echo "<a class=\"nav-link\" href=\"manage.php\">MANAGE ITEMS</a>";
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
                <h1 class="display-3">Preloved items, tailored for you.</h1>
                <?php
                  if(!empty($_SESSION['email'])){
                    $init_name = $_SESSION['first_name']." ".$_SESSION["last_name"];
                    echo "<p class=\"lead\">Welcome back, ".$init_name. "! </p>";
                    if($_SESSION["usertype"]==0){   //IF THE USER IS ADMIN, ADMIN CAN MANAGE ITEMS.
                      echo "<p class=\"lead\"> Manage your <u><a href=\"manage.php\" style=\"color: #FFFFFF\">items.</a></u></p>";
                    }
                  }
                  else{
                    echo"
                    <p class=\"lead\">G-SHOP: An online preloved shop <br>
                    There is beauty in everything, including preloved items..</p>

                    ";
                  }
                ?>
            </div>
        </div>
        <div class="row"></a></div>
    </div>
    </div>
    
    <!--Composition-->
    <div class="container composition" id="compo">
        <div class="row">
            <div class="col-md-4 wow fadeInLeft">
               <h5>Why buy preloved clothes?</h5> 
               <p>When you buy pre-loved items you do not have compromise on quality but can enjoy reduced prices — an average a 50% reduction — on the clothes, shoes, bags or other accessories that you are getting.  </p>
               <h5>Get high fashion brands without crushing your bank account.</h5> 
               <p> If you think that by buying pre-loved you may be compromising on the hygiene standards of the item, know that many shops that stock pre-loved items only accept donations that are clean and in good condition</p>
            </div>
            <div class="col-md-4 wow fadeInUp">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid dress" src="assets/1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid dress" src="assets/2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid dress" src="assets/3.jpg" alt="Third slide">
    </div>
  </div>
</div>
            </div>
            <div class="col-md-4 wow fadeInRight">
               <h5>Clothes are Rewashed</h5> 
               <p> But do use common sense, people, and do not buy second hand intimates. Why? Not because they are going to be dirty, but because it’s just not smart. It’s not a trench coat that you can proudly display. There is no good reason to get into someone else’s undies when you can wear your own.</p>
               <h5>Share Something Meaningful With Your Loved Ones</h5> 
               <p>There is beauty in everything, including preloved items.</p>
            </div>
        </div>
    </div>
    
    <!--PHRASE-->
    <div class="container-fluid phrase-bg wow fadeInUp" id="phrase">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <h3>Details are the key for perfection</h3>
                    <p>We mix and match clothes</p>
                </div>
            </div>
        </div>
    </div>
    <!--STORE-->
    <div class="container items" id="clothes">
        <div class="row">
            <div class="col-md-6 wow fadeInLeft">
               <h5>Dress Neat, At Low Cost!</h5> 
               <p>See our store.</p>
               
            </div>
            <div class="col-md-6">
                <img class="img-fluid wow fadeInRight" src="assets/1.jpg">
            </div>
        </div>
    </div>


    <!--CONTACT-->
    <div class="container-fluid contact-us" id="contact">
        <div class="container">
        <h1  class="display-3 wow fadeInUp">Contact Us</h1>
            <p class="lead">We are willing to hear your thoughts on how we can improve our services. Or if you love us, cheer us up!</p>
      <form method="post">
		  <div class="form-group wow fadeInUp col-lg-8 center_div" >
      <?php
      if(!empty($_SESSION['email'])){
        $init_name = $_SESSION['first_name']." ".$_SESSION["last_name"];
      }
      else{
        $init_name = null;
      }
      ?>

			<label for="Name">Name</label>
			<input type="text" class="form-control" id="name" name="given_name" placeholder="Your Name" align="center" value="<?=$init_name ?>" required>
		  </div>
		  <div class="form-group wow fadeInUp col-lg-8 center_div">
			<label for="formGroupExampleInput2">Message</label>
			<textarea class="form-control" id="formGroupExampleInput2" rows="6" placeholder="Your Message" name="message" required>
			</textarea>
		  </div>
		  <div class="form-group wow fadeInUp col-lg-8 center_div">
			<label for="formGroupExampleInput2">Submit</label>
      <input type="hidden" name="action" value="feedback">
			<input type="submit" class="form-control" id="formGroupExampleInput2" value="Send Love">
		  </div>
		</form>
    </div>
    </div>
    <?php
      if(isset($_POST["action"]) && $_POST["action"]=="feedback"){
          require_once('C:/xampp/htdocs/LIBRARIES/PHPMailer/vendor/autoload.php');
          require("C:/xampp/htdocs/LIBRARIES/PHPMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php");
          require("C:/xampp/htdocs/LIBRARIES/PHPMailer/vendor/phpmailer/phpmailer/src/SMTP.php");
          $mail = new PHPMailer\PHPMailer\PHPMailer();

          $to = "marcjermaine.mailer@gmail.com";
          $mail->IsSMTP(); // enable SMTP
          $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
          $mail->SMTPAuth = true; // authentication enabled
          $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 465; // or 587
          $mail->IsHTML(true);
          $mail->Username = "marcjermaine.mailer@gmail.com";
          $mail->Password = "wsx12345678";
          $mail->SetFrom("marcjermaine.mailer@gmail.com");
          $mail->Subject = "Feedback from ".$_POST["given_name"];
          $mail->Body = $_POST["message"];
          $mail->AddAddress($to);
          #$mail->AddAttachment('./files/rooms.pdf', $name = 'rooms',  $encoding = 'base64', $type = 'application/pdf');
          if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
           } else {
              #echo "Message has been sent";
              #echo"<script type=\"text/javascript\"> alert('Sign-Up success!');</script>";
           }

      }
    ?>
    
    <div class="footer">
        <div class="container">
            <h5><strong>Copyright</strong></h5>
            <a href="index.php"><img src="assets/logo.png" class="img-responsive wow fadeInUp" width="132px" height="71.4px" align="center"></a>
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