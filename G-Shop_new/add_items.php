<?php
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION['email'])) header("Location: login.php");
else if($_SESSION['usertype'] != 0) header("Location: index.php");

require 'C:\xampp\htdocs\LIBRARIES\PHP-FileUpload/vendor/autoload.php';

$xml=simplexml_load_file("assets/xml/clothinglist.xml") or die("Error: Cannot create object");

if(isset($xml)){
	$commit = false;
	if(isset($_POST["add"]))
	{
		$clothing = $xml->addChild("clothing");
		$id = substr(str_shuffle(uniqid()),0,10);
		$clothing ->addChild("id", "$id");
		$name = $_POST["name"];
		$price = $_POST["price"];
		$description = $_POST["description"];
		$clothing -> addChild("name", "$name");
		$clothing -> addChild("price", "$price");
		$clothing -> addChild("description", "$description");
		
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
	
	if(isset($_GET["delete"])){
		$id = $_GET["id"];
		if((int)$_GET["delete"] == 1){
			foreach($xml->clothing as $clothing){
				if($id == $clothing->id){
					$dom = dom_import_simplexml($clothing);
					$dom->parentNode->removeChild($dom);
					array_map('unlink', glob("assets/products/".$id.".*"));
					$commit = true;
					break;
				}
			}
		} 
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
  	<title>G-Shop | Manage Items</title>
  	<meta charset="UTF-8">

</head>
<body>

	<div align="center">
		<table class="table table-striped" id="entries">
			<thead>
			<tr>
				<th align="justify" width="10%">Name</th>
				<th align="justify" width="5%">Price</th>
				<th align="justify" width="50%">Description</th>
				<th align="justify" width="10%">Update</th>
				<th align="justify" width="10%">Delete</th>
				<th align="justify" width="20%">Photo</th>
			</tr>
			</thead>	
			<tbody>
				<?php
				foreach($xml->children() as $clothing) { 
				echo "<tr>";
				echo "<td align=\"justify\" width=\"10%\">" . $clothing->name . "</td> "; 
				echo "<td align=\"justify\" width=\"5%\">" . $clothing->price . "</td> "; 
				echo "<td align=\"justify\" width=\"50%\">" . $clothing->description . "</td> ";
				echo '<td width=\"10%\" valign="top" align="right">
		 		<a href="./edit.php?id='.$clothing->id.'">
				<button class="btn btn-warning">Update</button></a></td>'; 
				echo '<td width=\"10%\" valign="top" align="right">
				<a href="./manage.php?delete=1&id='.$clothing->id.'"><button onClick="return confirm(\'Do you really want to delete '.$clothing->name.'?\');" class="btn btn-danger">Delete</button></a></td>';
				#echo "<td align=\"justify\">" . $rooms->subject . "</td> "; 
				#echo $rooms->subject . ", "; 
				echo "<td align=\"justify\" width=\"20%\"> <img src=\"assets/products/".$clothing->id.".jpg\" width=\"30%\" height=50px\"\"></td> "; 
				echo "</tr>";
				}
				?>
			</tbody>	
		</table>		
	</div>


	<div align="center" class="centered_div">
		<form method="post" enctype="multipart/form-data">
		  		<div class="form-group">
		  				Name: <input type="text" name="name" required> <br>
		  		</div>
		  		<div class="form-group">
		  				Price: <input type="text" name="price" required> <br>
		  		</div>
		  		<div class="form-group">
		  				Description: <input type="text" name="description" required> <br>
		  		</div>
		  		<div class="form-group">
		  				Image:<br>
		    			<input type="file" name="my-input-name">
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576">			
		  		</div>
						<!--<button class="btn btn-primary" id="search"> Search </button>-->
						<input type="submit" class="btn-primary h-25" width=17% id="add" name="add" value="Add clothing" align="center">	
		</form>
	</div>
</body>
</html>