<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$db=new db();
$ft="select id,name from store";
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
	background-image:url(item.jpg);
	background-repeat:no-repeat;
	width:1375px;
    height:700px;
	background-size:100%;
	
	}
</style>
</head>

<body>
<div class="image_container img-responsive">
<div class="container-fluid img">
<form action="item.php" method="post">
<table>
<tr>
<td colspan="5" align="center"><b>Select item</b></td>


</tr>

<tr>
<td>Name of product:</td>
<td><input type="text" name="naam"</td>
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
echo$row->name;//name =store[name]

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
<td><input type="number" name="prce"</td>
</tr>

<tr>
<td colspan="5" align="center"><input type="submit"  name ="submit" />
</td>
</tr>
<br />
<tr><br />
<td><a href="home.php">Home</td>

</tr>


</table>
</form>
</div></div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	$item_name=$_POST['naam'];
	$item_price=$_POST['prce'];
	$store_id=$_POST['store'];
	$len=strlen($item_price);
			
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
