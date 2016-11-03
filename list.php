<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$list=new db();
$sql="select *, item.id as itr ,store.name as nam from store inner join item on store.id=item.store_id";

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


</head>

<body>

<table align="center" bordercolordark="#000000">
<tr>
<td>Store</td>
<td>Product</td>
<td>Price</td>
</tr>

<?php

	while($row=$users->fetch(PDO::FETCH_OBJ)):
	

?>
<tr><form method="get">
<td>


<?php  echo $row->nam;?>


</td>
<td>
<?php  echo $row->name;?>
</td><br />
<td><?php  echo $row->price;// price is entry in product table?></td> 
<td><button type="submit" name="del"  value="<?php echo $row->itr; ?>" onClick="return confirm('Are you sure','YES','No')"><span class="glyphicon glyphicon-remove"></span></button></td>
<td><button type="submit" onclick="show('<?php echo $row->name;?>')" name="app"><span class="glyphicon glyphicon-ok"></span></button></td>

</tr>
<?php
endwhile;
?>
<tr>
<td><a href="home.php"><strong>Check out</strong></td>
<td align="left"><a href="item.php" ><strong>Add More Item</strong></a></td>
</tr>

</table>
</body>
</html>
<?php
if(isset($_GET['del']))
{
/*$sqld ="delete s, r from store s left join item r on s.id = r.store_id where r.store_id =".$_GET['del'];
 $con->exec($sqld); this will delte from both table  and uncommentwill delete from item table only i think data will not delete from both tabbles*/
 $sqlds ="DELETE from item where id=".$_GET['del'];
 $con->exec($sqlds);

header('Location: list.php');
    die();
  
}

?>
<script>
function show(x)
{
	alert (x + ' Added Sucessfully');
	
}
</script>
