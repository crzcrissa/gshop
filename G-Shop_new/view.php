<?php
$xml=simplexml_load_file("assets/xml/clothinglist.xml") or die("Error: Cannot create object");
?>

<!DOCTYPE html>
<html lang="en" >


<head>
  <meta charset="UTF-8">
  <title>G-Shop</title>
 <meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link href='https://fonts.googleapis.com/css?family=Arimo:400,700&subset=latin,cyrillic-ext' rel='stylesheet'>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css" rel="stylesheet">
  
  
      <link rel="stylesheet" href="css/view-style.css">

  
</head>

<body>

  <div class="layout">
			<section class="inner">
				<ul class="grid">
					<div align="right">
						<input type="text" name="key" id="keyword" class="h-25" placeholder="Search a keyword: ">
						<!--<button class="btn btn-primary" id="search"> Search </button>-->
						<input type="submit" class="btn-primary h-25" width=17% id="search" value="Search">
						<br><br>
					</div>

					<?php
					foreach($xml->clothing as $clothing){
						$clothing_name = $clothing->name;
						$clothing_price = $clothing->price;
						$clothing_id = $clothing->id;

						echo "
						<li class=\"grid-tile\">
							<div class=\"item\">
								<div class=\"item-img\" style=\"background-image: url('assets/products/".$clothing_id.".jpg'); background-size: cover;\"></div>
								<div class=\"item-pnl\">
									<div class=\"pnl-wrapper\">
										<div class=\"pnl-description\">
												<span class=\"pnl-label\"> <a href=\"product.php?id=".$clothing->id."\">".$clothing_name."</a></span>
											<span class=\"pnl-price\">".$clothing_price."</span>
										</div>
										<div class=\"pnl-favorites\">
											<div class=\"pnl-ic-wrapper\">
												<span class=\"pnl-ic\"><svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 32 32\" style=\"enable-background:new 0 0 32 32;\" xml:space=\"preserve\"><path d=\"M22.6,6.5c-2.9,0-5.4,1.7-6.6,4.1c-1.2-2.4-3.7-4.1-6.6-4.1C5.3,6.5,2,9.8,2,13.9C2,23.7,15.8,29,15.8,29S30,23.6,30,13.9C30,9.8,26.7,6.5,22.6,6.5L22.6,6.5z\"></path></svg></span>
											</div>
										</div>
										<div class=\"pnl-tocart\">
											<div class=\"pnl-ic-wrapper\">
												<span class=\"pnl-ic\"><svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 32 32\" style=\"enable-background:new 0 0 32 32;\" xml:space=\"preserve\"><g><path d=\"M25.4,29H6.6c-1.7,0-3-1.4-2.8-2.9l1.9-13.8C5.9,11,6.6,10,8,10h16c1.4,0,2.1,1,2.3,2.3l1.9,13.8 C28.4,27.6,27.1,29,25.4,29z\"></path><path d=\"M10.6,12.7V8.4C10.6,5.4,13,3,16,3h0c3,0,5.4,2.4,5.4,5.4v4.3\"></path></g></svg></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						";
					}
					?>
				</ul>
			</section>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script type="text/javascript" src="js/search.js"></script>
  	<script src='https://tympanus.net/Development/Animocons/js/mo.min.js'></script>
  	<script  src="js/view-js.js"></script>




</body>

</html>
