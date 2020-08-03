<?php
require('db.php');



if(!isset($_SESSION)){
	session_start();
}


if(!empty($_SESSION['email'])) {
	echo"<script type=\"text/javascript\"> alert('The user".$_SESSION['email']." is still logged in!');</script>";
	header('Location: index.php');
}

$success_signup = false;
$is_duplicate = false;
$success_login = false;
//Registration
try {
	if(isset($_POST["action"]) &&($_POST["action"]=="register") && !isset($_SESSION["email"]) &&
		isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["password"]) && isset($_POST["email"])){
	//sanitize input	
		$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
	    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
	    $user_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	    $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	    $user_type = 1; // 0 - admin 1 - user
	    
		$query_email = $dbh -> prepare("SELECT * FROM users WHERE email = :email");
		$query_email->bindParam(":email", $user_email);

		$query_email->execute();
		
		$row_users = $query_email -> fetchAll();
		if(sizeof($row_users) > 0){
			$is_duplicate = true;
		}

		
		if(!$is_duplicate){
			$query = $dbh->prepare("INSERT INTO users (first_name, last_name, email, password, usertype) VALUES (:first_name, :last_name, :email, :password, :usertype)");
			$query->bindParam(":first_name", $first_name);
	        $query->bindParam(":last_name", $last_name);
    	    $query->bindParam(":password", $user_password);
       		$query->bindParam(":email", $user_email);
        	$query->bindParam(":usertype", $user_type);
        	$query->execute();

	        if ("00000" == $dbh->errorCode())
	        {
    	        $success = true;
        	}

			if($success && isset($success)){
				//pakibago na lang yung paths dito depende kung nasaan yung PHPMailer nyo.
				require_once('C:/xampp/htdocs/LIBRARIES/PHPMailer/vendor/autoload.php');
				require("C:/xampp/htdocs/LIBRARIES/PHPMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php");
				require("C:/xampp/htdocs/LIBRARIES/PHPMailer/vendor/phpmailer/phpmailer/src/SMTP.php");
				$mail = new PHPMailer\PHPMailer\PHPMailer();

  				$to = $user_email;
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
			    $mail->Subject = "Welcome to G-Shop!";
			    $mail->Body = "Hi ".$first_name."!\n You may now log in using the information you have provided. Thank you for signing up!";
			    $mail->AddAddress($to);
			    #$mail->AddAttachment('./files/rooms.pdf', $name = 'rooms',  $encoding = 'base64', $type = 'application/pdf');
			    if(!$mail->Send()) {
			        echo "Mailer Error: " . $mail->ErrorInfo;
			     } else {
			        #echo "Message has been sent";
			        echo"<script type=\"text/javascript\"> alert('Sign-Up success!');</script>";
			        header( "refresh:0.001;url=login.php" );

			     }

			}
	    	$dbh = null;
		}
		else if($is_duplicate){
			echo"<script type=\"text/javascript\"> alert('E-mail is already taken!');</script>";
			header( "refresh:0.001;url=login.php" );
		}

	}

}
catch(PDOException $e){
	echo "Error: ".$e->getMessage();
}
//Registration end

//log in
try {
	if(isset($_POST["action"]) && ($_POST["action"]=="login")){
		$user_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	    $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$query_login = $dbh->prepare("
			SELECT first_name, last_name, email, usertype FROM users WHERE (email=:email) AND (password=:password)");
		$query_login->bindParam(":email", $user_email);
		$query_login->bindParam(":password", $user_password);
		$query_login->execute();
		$row = $query_login->fetch(PDO::FETCH_ASSOC);
		
		if($row){
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] =  $row['last_name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['usertype'] = $row['usertype'];
			$_SESSION['loggedin'] = true;

			echo"<script type=\"text/javascript\"> alert('login successul!');</script>";
			header( "refresh:0.001;url=index.php" );

		}
		else{
			echo"<script type=\"text/javascript\"> alert('Error logging in!');</script>";
			header( "refresh:0.001;url=login.php" );
		}
		
	}
}

catch(PDOException $e){
	echo "Error: ".$e->getMessage();
}
//log in end


?>



<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>G-Shop | Log In</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/login_style.css">

  
</head>

<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name="first_name" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="last_name"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="password"/>
          </div>
          
          <input type="hidden" name="action" value="register">
          <button type="submit" class="button button-block" />Get Started</button>
          <p style="color:#FFFFFF;">Return to <a href="index.php">home</a>.</p>
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="password"/>
          </div>
          
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          <input type="hidden" name="action" value="login">
          <button class="button button-block"/>Log In</button>
          
          </form>
          <p style="color:#FFFFFF;">Return to <a href="index.php">home</a>.</p>
        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/login_index.js"></script>




</body>

</html>
