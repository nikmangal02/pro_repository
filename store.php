<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$db = new db();
$qry="select * from store";
$con=$db->insert($qry);
$fetch=$con->fetchAll();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

<title>Add Store</title>
<style>

h3 {
	padding-left:600px;
	font-family:"Times New Roman", Times, serif;
	font-size:45px;
	
}
.button
{
	color:#000;
	display:block;
	position:relative;
	text-align:center;
    
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
	font-size:2.1em;
	color:#FFF;
}
.navbar
{
	background-color:transparent;
	border-color:transparent;
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
<?php if(count($fetch) > 0) {?>
  <li><a href="item.php"><span class="btn btn-primary">Add item</span> </a> </li>
<li><a href="store_list.php"><span class="btn btn-primary">Show List</a></span></li>
<?php }?>
</ul>
</div>
</nav>
<div>

<h3><strong>--Add Store--</strong></h3>
<div class="col-md-8 col-xs-offset-2" >
<form method="post" action="store.php">
<table align="center" class="table" >
  <tr>
    <td>Name:</td>
    <td><input type="text" name="nme"  placeholder="Enter name"</td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><input type="text" name="addr"  placeholder="Address"</td>
  </tr>
  <tr>
  <td>Landmark:</td>
  <td><input type="text" name="landmark" placeholder="Landmark"</td>
  </tr>
  <tr>
    <td>pin code:</td>
    <td><input type="number" name="pin" placeholder="Pin code"</td>
    <td class="hide"><input type="hidden" name="redirectUrl" value="<?php if(isset($_GET['redirect'])){ echo $_GET['redirect']; }?>"></td>
  </tr>
  <tr>
    <td align="center" colspan="5" ><input class="btn btn-primary" type="submit" name="submit" align="center" /></td>
  </tr>
  
  <tr>
  </tr>
</table>
</form>
</div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>

<?php

if(isset($_POST['submit'])) {
    $store_name = $_POST['nme'];
    $store_addr = $_POST['addr'];
    $store_pin = $_POST['pin'];
    $store_landmark = $_POST['landmark'];
    $len = strlen($store_pin);

    if ($store_name == "" || $store_addr == "" || $store_pin == "" || $store_landmark == "") {
      echo "<script>alert('All entries must be fill')</script>";
      if(isset($_POST['redirectUrl']))
      {
        echo "<script>alert('Pin code should be of 6 digits')</script>";
        echo "<script>window.location.href='store.php?redirect=addItem'</script>";
      }
      exit();
    }
    if ($len != 6) {
      if(isset($_POST['redirectUrl']))
      {
        echo "<script>alert('Pin code should be of 6 digits')</script>";
        echo "<script>window.location.href='store.php?redirect=addItem'</script>";
      }

      exit();
    }

    try {


      $duplicate = "select name , pin_code, address from store where name = '$store_name' and pin_code='$store_pin' and address='$store_addr'";
      $duplicateCount = $db->insert($duplicate);
      $number_of_rows = $duplicateCount->fetchAll();
      if (count($number_of_rows) > 0) {
        echo "<script>alert('Store name already exists')</script>";
      } else {
        $sql = "insert into store(name,address,landmark,pin_code) values ('$store_name','$store_addr','$store_landmark','$store_pin')";
        $db->insert($sql);
        echo "<script>alert('store added')</script>";

        if ($_POST['redirectUrl']) {
          header('location:item.php');
        } else {
          header("location:store_list.php");
        }
      }

    } catch (PDOException $e) {
      echo $e->getMessage();
    }


}
?>