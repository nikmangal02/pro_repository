<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$list=new db();
$price="select sum(price) as total from item";
$page = isset($_GET['page']) ? $_GET['page'] : null;
if (empty($page) || $page == 1) {
  $page1 = 0;
} else {
  $page1 = ($page * 5) - 5;
}
$sql="select *, item.id as itr ,concat(store.name,'(',store.landmark,')') as nam, item.is_bought as bog from store inner join item on store.id=item.store_id limit $page1,5";

$tot=$list->insert($price);
$users = $list->insert($sql);
//$con_list=count($users);
$co=$users->fetchAll();

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
		color:#FFF;
	}
</style>
</head>
<body>
<nav class="navbar navbar-inverse navbar">
<div class="container-fluid">
  <div class="navbar-header">
    <a class="navbar-brand" href="#"style="font-size:35px ">STORE</a>
  </div>
<ul class="nav navbar-nav navbar-right">
  <li><a href="home.php"><span class="btn btn-primary">Home</span></a></li>
    <?php if(count($co) > 0){?>
  <li><a href="store.php"><span class="btn btn-primary">Add Store</span></a></li></ul>
    <?php }?>
</div>
</nav>

<div class="col-md-8 col-xs-offset-2">
    <?php
    $va = count($co);
   // echo $va;
    if($va > 0){?>
<table align="center" bordercolordark="#000000" class="table table-striped table-bordered">


<tr class="header">
<td>Product</td>
<td>Store</td>
<td>Price</td>
<td>Confirm</td>
<td>Delete</td>
</tr>

<?php
$faltu=$list->insert($sql);
	while($row = $faltu->fetch(PDO::FETCH_OBJ)):
        //var_dump($row);
?>
<tr><form method="get">
<td>
<?php  echo $row->name;?>
</td>
<td>
<?php  echo $row->nam;?>
</td>
<td><?php echo $row->price;// price is entry in product table?></td> 
<td>
<?php
if($row->bog==0){
?>
<button type="submit" class="btn btn-success" name="app" value="<?php echo $row->itr; ?>"onClick="return confirm('Are you sure','YES','No')"><span class="glyphicon glyphicon-ok"></span></button>
<?php } else { ?>
  confirm
  
<?php }?>
</td>
<td><button type="submit" name="del" class="btn btn-danger" value="<?php echo $row->itr; ?>" onClick="return confirm('Are you sure','YES','No')"><span class="glyphicon glyphicon-trash"></span></button></td>
 
</tr>
<?php
endwhile;
$num="select *,(select name from store where item.store_id=store.id) as nam from item";
$cn=$list->insert($num);

$num_of_rows=$cn->fetchAll();
$a= count($num_of_rows)/ 5;
$a=ceil($a);
//echo count($num_of_rows);
?>
    <?php if(count($num_of_rows) > 5){ ?>
  <tr>
    <td colspan="5">
        <div class="text-center">
          <?php $res=$list->pagination($page,'list.php',$a);?>
        </div>
    </td>
  </tr>
<?php }?>
  <div class="text-center">
<tr>

    <td class="total" colspan="2" ><div class="text-center"> Total price:</div></td>
    <?php foreach($tot as $to):?>
      <td class="total" colspan="3"><?php echo $to['total']?></td>
    <?php endforeach;?>

</tr>
</div>

  <div class="text-center">
<tr>

<td colspan="3"><div class="text-center">  <a href="item.php" class="btn btn-primary"><strong>Add More Item</strong></a></td>

<td align="left" colspan="3"><div class="text-center"><a href="home.php" class="btn btn-primary"><strong>Check out</strong> </div></a></td>
  </div>
</tr>
</table>
    <?php } else{?>
       <div class="text-center alert alert-danger"><b>OOPS!!!</b> No items available, Click <a href="item.php"><b>here</b></a> to add one.</div>
    <?php }?>

</div>

</body>
</html>
<?php
if(isset($_GET['del'])) {
    /*$sqld ="delete s, r from store s left join item r on s.id = r.store_id where r.store_id =".$_GET['del'];
     $con->exec($sqld); this will delte from both table  and uncommentwill delete from item table only i think data will not delete from both tabbles*/
    $sqlds = "DELETE from item where id=" . $_GET['del'];

    $list->insert($sqlds);
    $list->redirect('list.php');

} ?>
<?php
if(isset($_GET['app']))
{
    $sql="update item set is_bought = 1 where id=".$_GET['app'];
$list->insert($sql);
    $list->redirect('list.php');
} ?>