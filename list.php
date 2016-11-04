<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$list=new db();
$sql="select *, item.id as itr ,store.name as nam, item.is_bought as bog from store inner join item on store.id=item.store_id";
$price="select sum(price) as total from item";
$tot=$list->lis($price);
$users=$list->lis($sql);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<title>list</title>
<style>

.header
{
	font-weight:bolder;
	}
	.total
	{
		font-size:18px;
		font-weight:bolder;
	}
	.icon
	{
		font-size:2.1em;
		color:#009;
	}
</style>

</head>

<body>

<nav class="navbar navbar-default navbar">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="home.php"><span class="glyphicon glyphicon-home icon"></span></a></li>
<li><a href="store.php"><span class="btn btn-primary">Add Store</a></span></li>
</div>
</nav>
<div class="col-md-8 col-xs-offset-2">
<table align="center" bordercolordark="#000000" class="table table-striped table-bordered">
<tr class="header">
<td>Store</td>
<td>Product</td>
<td>Price</td>
<td>Delete</td>
<td>Confirm</td>
</tr>

<?php

	while($row=$users->fetch(PDO::FETCH_OBJ)):
	

?>
<tr><form method="get" action="list.php">
<td>


<?php  echo $row->nam;?>


</td>
<td>
<?php  echo $row->name;?>
</td><br />
<td><?php  echo $row->price;// price is entry in product table?></td> 
<td><button type="submit" name="del" class="btn btn-danger" value="<?php echo $row->itr; ?>" onClick="return confirm('Are you sure','YES','No')"><span class="glyphicon glyphicon-trash"></span></button></td>
<td>
<?php if($row->bog==0){ ?>
<button type="submit" class="btn btn-success" name="app" value="<?php echo $row->id?>"><span class="glyphicon glyphicon-ok"></span></button>
<?php } else { ?>
  confirm
<?php }?>
</td> 
</tr>
<?php
endwhile;
?>
<tr>
<td class="total">Total price:</td>
<?php foreach($tot as $to):?>
<td class="total"><?php echo $to['total']?></td>
<?php endforeach;?>
</tr>
<tr>
<td><a href="home.php" class="btn btn-primary"><strong>Check out</strong></td>
<td align="left"><a href="item.php" class="btn btn-primary"><strong>Add More Item</strong></a></td>
</tr>

</table>
</div>
<div class="clearfix">

</div>
</body>
</html>
<?php
if(isset($_GET['del']))
{

/*$sqld ="delete s, r from store s left join item r on s.id = r.store_id where r.store_id =".$_GET['del'];
 $con->exec($sqld); this will delte from both table  and uncommentwill delete from item table only i think data will not delete from both tabbles*/
 $sqlds ="DELETE from item where id=".$_GET['del'];
 $list->lis($sqlds);

header('Location: list.php');
    //die();
  
}
if(isset($_GET['app']))
{
	
	$sql="update item set is_bought = 1 where id=".$_GET['app'];
	$val=$list->lis($sql);
	header('Location: list.php');
	
}



?>
<script>
function show(x)
{
	alert (x + ' Added Sucessfully');
	
}
</script>
