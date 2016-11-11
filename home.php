<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'dbconnect.php';
$db=new db();
$sql="select *,(select name from store where item.store_id=store.id) as name, SUM(price) as price from item where is_bought=1 group by store_id order by price desc limit 0,3";
$users=$db->insert($sql);
$final = $users->fetchAll();
//echo $final;


    $page = isset($_GET['page']) ? $_GET['page'] : null;
    if (empty($page) || $page == 1) {
        $page1 = 0;
    } else {
        $page1 = ($page * 5) - 5;
    }

$ftch="select *,(select name from store where item.store_id=store.id) as nam from item where is_bought=1 limit $page1,5";
$con=$db->insert($ftch);
$con_pro=$con->fetchAll();

$tot="select SUM(price) as pr from item where is_bought=1";
$to=$db->insert($tot);
$to = $to->fetch(PDO::FETCH_OBJ);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="home.css" type="text/css"/>
<title>Home</title>
</head>

<body>

<nav class="navbar navbar-inverse navbar">
    <div class="container-fluid">
        <div class="navbar-header">
           <a class="navbar-brand" href="#"style="font-size:35px ">STORE</a>
        </div>
     <ul class="nav navbar-nav navbar-right">
          <li><a href="home.php"><span class="btn btn-primary" >Home</a></span> </li>
          <li><a href="item.php"><span class="btn btn-primary">Add item</a></span> </li>
     </ul>
    </div>
</nav>
<div class="wrapper-home">
<div class="col-lg-5 col-xs-offset-1 ">
    <table class="table table-striped table-bordered">

        <tr>
            <td colspan="3"><div class="text-center" ><strong>List of Product</strong></div></td>
        </tr>
        <?php if(count($con_pro) > 0){?>
        <tr>
                <td><b>Product</b></td>
                <td><b>Store</b></td>
                 <td><b>Price</b></td>
        </tr>

        <?php $total = 0;
            $fat=$db->insert($ftch);
            foreach ($fat as $cons):
            ?>
        <tr>
            <td><?php echo $cons['name'] ?></td>
            <td><?php echo $cons['nam'] ?></td>
            <td><?php echo $cons['price'] ?></td>
        </tr>


        <?php endforeach;?>

        <tr>
            <td colspan="2" class="">
                <div class="text-center">
                    <strong>Total Purchase Amount</strong>
                </div>
            </td>
            <td>
                <?php echo $to->pr;?>
            </td>
        </tr>
          <?php  } else {
            ?>
            <tr>
                <td colspan="6"><div class="text-center"><div class="alert alert-danger"> No Items Available, Click <b>Add Items</b> button above to add. </div></div></td>

            </tr>
        <?php } ?>

        <tr>
            <td colspan="3">
                <div class="text-center">
                    <?php
                    $num="select *,(select name from store where item.store_id=store.id) as nam from item where is_bought=1";
                    $cn=$db->insert($num);
                    $num_of_rows=$cn->fetchAll();
                    $a= count($num_of_rows)/ 5;
                    $a=ceil($a);
                    ?>
<?php if(count($num_of_rows) > 5) {$out=$db->pagination($page,'home.php',$a);}?>

                    <div>
                        <a href="list.php">See Complete list</a>
                    </div>
                </div>
            </td>
        </tr>
    </table><br>
</div>
    <div class="col-lg-4">
        <table class="table table-striped table-bordered">
            <tr>
                <td colspan="2"><div class="text-center"><strong>Trending store</strong></div></td>
            </tr>
            <?php if(count($final) > 0){?>
                <tr>
                    <td colspan="1"><b>Store</b></td>
                    <td colspan="3"><b>Purchase(Rs)</b></td>
                </tr>

                <?php
$faltu=$db->insert($sql);
                foreach($faltu as $user):
                    ?>
                    <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['price']; ?></td>
                    <?php
                endforeach;
                ?>
                </tr>
            <?php } else {?>
                <tr>
                    <td colspan="5"><div class="alert alert-danger"> No Trends Available, Click <b>Add Items</b> button above to add. </div></td>
                </tr>
            <?php }?>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
