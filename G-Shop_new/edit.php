<?php
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION['email'])) header("Location: login.php");
else if($_SESSION['usertype'] != 0) header("Location: index.php");

require 'C:\xampp\htdocs\LIBRARIES\PHP-FileUpload/vendor/autoload.php';

$xml=simplexml_load_file("assets/xml/clothinglist.xml") or die("Error: Cannot create object");
$commit = false;

if(!empty($_GET["id"]))
{
	$id = $_GET["id"];
	foreach($xml->clothing as $clothing)
	{
		if($id == $clothing->id){
			$n = $clothing->name;
			$p = $clothing->price;
			$d = $clothing->description;
			$i = $id;
			break;
		}
	} 
}

if(!empty($_POST)){
	foreach($xml->clothing as $clothing)
	{
		if($id == $clothing->id){
			$dom = dom_import_simplexml($clothing);
			$dom->parentNode->removeChild($dom);
			if(!empty($_POST["my-input-name"])){
				array_map('unlink', glob("assets/products/".$id.".*"));	
			}

			$clothing2 = $xml->addChild("clothing");
			$clothing2 -> addChild("id", "$i");
			$name = $_POST["name"];
			$price = $_POST["price"];
			$description = $_POST["description"];
			$clothing2 -> addChild("name", "$name");
			$clothing2 -> addChild("price", "$price");
			$clothing2 -> addChild("description", "$description");

			break;
		}
	}	

	if(!empty($_POST["my-input-name"]))
	{
		$upload = new \Delight\FileUpload\FileUpload();
		$upload->withTargetDirectory('assets/products/');
		$upload->withAllowedExtensions([ 'jpeg', 'jpg', 'png', 'gif' ]);
		$upload->from('my-input-name');
		$upload->withTargetFilename($id);
		try {

		    $uploadedFile = $upload->save();
		    $commit = true;
		    // success: $uploadedFile->getFilenameWithExtension()
		}
		catch (\Delight\FileUpload\Throwable\InputNotFoundException $e) {
		    // input not found
		}
		catch (\Delight\FileUpload\Throwable\InvalidFilenameException $e) {
		    // invalid filename
		}
		catch (\Delight\FileUpload\Throwable\InvalidExtensionException $e) {
		    // invalid extension
		}
		catch (\Delight\FileUpload\Throwable\FileTooLargeException $e) {
		    // file too large
		}
		catch (\Delight\FileUpload\Throwable\UploadCancelledException $e) {
		    // upload cancelled
		}

	}
	else{
		$commit = true;
	}

}


if($commit){
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	$dom->save('assets/xml/clothinglist.xml');
	header("Location: ./manage.php");
}



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div align="center" class="centered_div">
		<form method="post" enctype="multipart/form-data">
		  		<div class="form-group">
		  				Name: <input type="text" name="name" value="<?= $n ?>" required> <br>
		  		</div>
		  		<div class="form-group">
		  				Price: <input type="text" name="price" value="<?= $p ?>" required> <br>
		  		</div>
		  		<div class="form-group">
		  				Description: <input type="text" value="<?= $d ?>" name="description" required> <br>
		  		</div>
		  		<div class="form-group">
		  				New Image:<br>
		    			<input type="file" name="my-input-name">
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576">			
		  		</div>
						<!--<button class="btn btn-primary" id="search"> Search </button>-->
				<input type="submit" class="btn-primary h-25" width=17% id="add" name="edit" value="Edit clothing" align="center">	
		</form>
	</div>
</body>
</html>

