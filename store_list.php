<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
include 'dbconnect.php';
$db=new db();
$sql="select * from store";
$results=$db->store_list($sql);

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<title>Store list</title>
<style>
.icon
{
	color:#FFF;
	font-size:2.1em;
}
</style>
</head>

<body>
<nav class="navbar navbar-inverse navbar">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="home.php"><span class="glyphicon glyphicon-home icon"></span></a></li>

</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="item.php"><span class="btn btn-primary">Add Item</a></span></li>

<li><a href="store.php"><span class="btn btn-primary">Add Store</a></span></li>
</ul>
</div>
</nav>
<form action="store_list.php" method="post">
<div class="col-md-8 col-xs-offset-2">
<table class="table table-bordered">
<tr>
<td><strong>Store Name<strong></td>
<td><strong>Store Addr<strong></td>
<td><strong>Store landmark<strong></td>
<td><strong>Store Pincode<strong></td>
</tr>
<tr>
<?php
foreach($results as $result):
?>
<td ><?php echo $result['name'];?></td>
<td ><?php echo $result['address'];?></td>
<td ><?php echo $result['landmark'];?></td>
<td ><?php echo $result['pin_code'];?></td>

</tr>
<?php
endforeach;

?>

</table>
</div>

</form>
</body>
</html>