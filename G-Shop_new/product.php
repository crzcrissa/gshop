<?php

if(!isset($_SESSION)) session_start();
#if(!isset($_SESSION['email'])) header("Location: login.php");
$xml=simplexml_load_file("assets/xml/clothinglist.xml") or die("Error: Cannot create object");

$id = $_GET["id"];

foreach($xml->clothing as $clothing){
  if($clothing->id == $id){
    $name = $clothing->name;
    $price = $clothing->price;
    $description = $clothing->description;
  }
}
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
      <link rel="stylesheet" href="css/product_style.css">

  
</head>

<body>

  <div class="single-item">
  <div class="left-set">
    <img src="http://images.nike.com/is/image/DotCom/PDP_HERO_S/NIKE-YA-LEBRON-MAX-AIR-BP-BA5124_660_A.jpg" alt="" />
  </div>
  <div class="right-set">
    <div class="name">LEBRON MAX AIR</div>
    <div class="subname">KIDS' BACKPACK</div>
    <div class="price">$65</div>
    <div class="description">
    <p>
    The LeBron Max Air Kids' Backpack has cushioned, adjustable straps, a top-loading design and spacious main compartment for comfortable carrying and easy access to your gear.
    </p>
    </div>
    <br>
    <br>
    <br>

    <button>ADD TO CART</button>
  </div>
  </div>


  <div class="single-item">
  <div class="left-set">
    <?php
    echo "<img src=\"assets/products/".$id.".jpg\"/>";
    ?>
  </div>
  <div class="right-set">
    <?php
    echo "<div class=\"name\">".$name."</div>";
    echo "<div class=\"price\">".$price."</div>";
    echo "<div class=\"description\"><p>".$description."</p></div>";
    ?>
    <br>
    <p class="description"><a href="store.php">Return</a></p>
    <br>
    <button>ADD TO CART</button>
  </div>
  </div>


  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

  

    <script  src="js/product_js.js"></script>




</body>

</html>
