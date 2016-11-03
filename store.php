<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Store</title>
<style>
.table {
	margin-top: 300px;
}
h1 {
	alignment-baseline: central;
}
</style>
</head>

<body>
<form method="post" action="store.php">
<table align="center" class="table" >
  <tr>
    <td colspan="5" align="center"><strong>Store</strong></td>
  </tr>
  <tr>
    <td>Name:</td>
    <td><input type="text" name="nme"</td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><input type="text" name="addr"</td>
  </tr>
  <tr>
    <td>pin code:</td>
    <td><input type="number" name="pin"</td>
  </tr>
  <tr>
    <td align="center" colspan="5"><input type="submit" name="submit" align="center"</td>
  </tr>
  
  <tr>
  <td><a href="home.php">Home</td>
  <td align="right"><a href="item.php" name="item">Add item</td>
  </tr>
</table>
</form>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
	$store_name=$_POST['nme'];
	$store_addr=$_POST['addr'];
	$store_pin=$_POST['pin'];
	$len=strlen($store_pin);
	
	if($store_name=="" || $store_addr==""|| $store_pin=="")
	{
		echo "<script>alert('All entries must be fill')</script>";	
		exit();
	}
	if($len != 6)
	   {
		echo "<script>alert('Pin code should be of 6 digits')</script>";
		exit();
		}
	
   try
  {
	  include 'dbconnect.php';
	  $db=new db();
	  
	  $duplicate="select name , pin_code, address from store where name = '$store_name' and pin_code='$store_pin' and address='$store_addr'";
	  $duplicateCount =$db->stre($duplicate);
	  $number_of_rows=$duplicateCount->fetchAll();
	  if(count($number_of_rows) > 0)
	  {
		  echo "<script>alert('Store name already exists')</script>";
	  }
	  else
	  {
		$sql="insert into store(name,address,pin_code) values ('$store_name','$store_addr','$store_pin')";
	  $db->stre($sql);
	  echo "<script>alert('store added')</script>";  
	  }  
	
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?>