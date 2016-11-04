<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$db=new db();
$ft="select id,concat(name,',',landmark) as title from store";
$result=$db->item($ft);


?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<title>Add item</title>
<style>
.img
{
	width:1200px;
	height:650px;
}

.image_container
{
	
	background-repeat:no-repeat;
	width:1375px;
    height:700px;
	background-size:100%;
	
	}
	table
	{
		margin-right:100px;
		border-collapse:collapse;
		border-color:#000;
		font-family:Arial, Helvetica, sans-serif;
		}
		
		td
		{
			
    
    padding: 8px;
	font-weight:bold;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
		}
	.icon
	{
	font-size:2.2em;	
	color:#FFF;
	}
	.navbar
	{
		border-color:transparent;
		background-color:transparent;
	}
	h3
	{
		padding-left:600px;
		font-family:"Times New Roman", Times, serif;
		font-size:40px;
	}
</style>
</head>

<body>
<nav class="navbar navbar-inverse navbar">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="home.php"><span class="glyphicon glyphicon-home icon"</span></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="list.php"><span class="btn btn-primary">Show item</a></span></li>
</ul>
</div>
</nav>

<div>

<h3><strong>--Add Item--</strong></h3>
<div class="col-md-8 col-xs-offset-2">
<form action="item.php" method="post">
<table class="table">
<tr>
<td>Name of product:</td>
<td><input type="text" placeholder="Enter name of product" name="naam"</td>
</tr>

<tr>
<td>Store</td>
<td>


<select name="store">
<?php
while($row=$result->fetch(PDO::FETCH_OBJ)):
?>
<option value=<?php echo $row->id ?>>
<?php 

echo$row->title;//name =store[name]

?>
</option>
<?php
endwhile;

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
<br />



</table>
</div>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	$item_name=$_POST['naam'];
	$item_price=$_POST['prce'];
	$store_id=$_POST['store'];
	$len=strlen($item_price);
	$value=100;
			
	try
	{
		//$tem_db=new PDO("mysql:host=$hostname;dbname=cart", $username, $password);
     //$item_db="insert into item (name,price,store_id) values ('".$_POST["naam"]."','".$_POST["prce"]."','".$_POST["store"]."')";//store_id take input from row->id query
	$item_db="insert into item (name,price,store_id) values('$item_name','$item_price','$store_id')";
	
	if($item_name=="")
	{
		echo "<script>alert('Name must be fill')</script>";
		exit();
		}
		
		if($item_price=="")
	{
		echo "<script>alert('Price must be fill')</script>";
		exit();}
	
	if($item_price < $value)
	{
		echo "<script>alert('Minimum order Rs 100')</script>";
		exit();
	}
	
	if($db->item($item_db))
	{
		echo "<script>alert('item added')</script>";
		//echo "<script> return confirm('are u sure','yes','no')</script>";
        
        header("location:list.php");
	}
    else
    {
    echo "<script>alert('item is not added')</script>";
    }
	}
		catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	

}
?>
