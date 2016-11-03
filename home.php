<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$db=new db;
$sql="select (select name from store where item.store_id=store.id) as name, SUM(price) as price from item group by store_id order by price desc limit 0,3";
$users=$db->insert($sql);

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
<title>Home</title>

<style>
#header
{
background-color:#06F;
color:#000;
}
#color
{

color:#069;
}
.img
{
	height:700px;
	width:1350px;
}
.button {
    background-color: #06F;
    border: none;
    color: #000;
 margin-top:250px;
 margin-left:600px;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
}
.image_container
{
    width:1375px;
    height:700px;
	background-repeat:no-repeat;
	background-image:url(grocery.jpg);
    background-size: 100%;
}
h1
{
	color:#FFF;
	margin-left:390px;
	font-size:96px;
}
td
{
	color:#FFF;
	}
	
	table
	{
		margin-right:100px;
		}
		.head
		{
			color:#FFF;
			font-size:24px;
			}
</style>
</head>

<body>

<div class="image_container img-responsive">
<div class="container-fluid">
<div class>
<h1>Grocery store</h1>
</div>
<div class="row">
<div class="col-md-12">    	
<a href="store.php" class="button">Add Store</a>
</div>
</div>
<table align="right" >
<tr>
<td class="head">Trending store</td>
</tr>



<?php 
foreach($users as $user):
?>
<tr>
<td><?php echo $user['name'];?></td>
<td><?php echo $user['price'];?></td>
<?php
endforeach;
?>
</tr>

</table>
</div>
</div>


<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>
