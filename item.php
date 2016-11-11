<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$db=new db();
$ft="select id, concat(name,',',landmark) as title from store";
$result=$db->insert($ft);
$result = $result->fetchAll(PDO::FETCH_OBJ);
$con=count($result);

$itm="select * from item";
$item_con=$db->insert($itm);
$fetch=$item_con->fetchAll();
//echo $con;
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link type="text/css" href="item.css" rel="stylesheet">
	<title>Add item</title>

	<style>

</style>
</head>

<body>
<nav class="navbar navbar-inverse navbar">
<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="#" style="font-size:35px ">STORE</a>
	</div>
	<ul class="nav navbar-nav navbar-right">
		<li><a href="home.php"><span class="btn btn-primary" >Home</a></span> </li>
		<?php if(count($fetch) > 0){?>
		<li><a href="list.php"><span class="btn btn-primary">Show items</span> </a> </li>

		<li><a href="store.php"><span class="btn btn-primary">Add store</span></a> </li>
		<?php } ?>
	</ul>
</div>
</nav>


<?php

if(count($result)==0){
?>

		<div class="alert alert-danger text-center"><b>OOPS!!!</b> No store is available to add items. To add items <a href="store.php?redirect=addItem" ><b>Add Store</b></a> first. </div>


	<?php } else {?>
<h3><strong>--Add Item--</strong></h3>
<div class="col-md-8 col-xs-offset-2">
<form action="item.php" method="post">
<table class="table">
<tr>
<td>Name of product:</td>
<td><input   type="text" placeholder="Enter name of product" name="naam"></td>
</tr>

<tr>
<td>Store</td>
<td >


<select name="store">
	<option value="-1"> -- Select store -- </option>
<?php
foreach ($result as $row) :
?>
	<option value= <?php echo $row->id ?>>
			<?php
			echo $row->title;//name =store[name]
			?>
			</option>
		<?php

		endforeach;

?>
</select>
</td>
</tr>

<tr>
<td>Price:</td>
<td><input type="number" name="prce" placeholder="Price"/></td>
</tr>

<tr>
<td colspan="5" align="center"><input type="submit" class="btn btn-primary"  name ="submit" />
</td>
</tr>

</table>

</form>
</div>
<?php } ?>

</body>
</html>
<?php
if(isset($_POST['submit'])) {
	$item_name = $_POST['naam'];
	$item_price = $_POST['prce'];
	$store_id = $_POST['store'];
	$len = strlen($item_price);
	$value = 100;
	//$srr=array();
	//$srr=array('0','1','2','3','4','5','6','7','8','9');
	try {
		//$tem_db=new PDO("mysql:host=$hostname;dbname=cart", $username, $password);
		//$item_db="insert into item (name,price,store_id) values ('".$_POST["naam"]."','".$_POST["prce"]."','".$_POST["store"]."')";//store_id take input from row->id query
		$item_db = "insert into item (name,price,store_id) values('$item_name','$item_price','$store_id')";

		if ($item_name == "") {
			echo "<script>alert('Name must be fill')</script>";
			exit();
		}
//			if ( ctype_alnum($item_name)) {
//				echo "<script>alert('Invalid product name')</script>";
//
//				exit();
//			}
		if(is_numeric($item_name))
		{
			echo "<script>alert('invalid')</script>";
		}


			if ($item_price == "") {
				echo "<script>alert('Price must be fill')</script>";
				exit();
			}

			if ($item_price < $value) {
				echo "<script>alert('Minimum order Rs 100')</script>";
				exit();
			}

			if ($db->insert($item_db)) {
				echo "<script>alert('item added')</script>";
				//echo "<script> return confirm('are u sure','yes','no')</script>";

				header("location:list.php");
			} else {
				echo "<script>alert('item is not added')</script>";
			}
		}

	catch
		(PDOException $e)
	{
		echo $e->getMessage();
	}

}

?>