<?php


class db
{
    public $hostname = "localhost";
    public $username = "root";
    public $password = "";

    public $con;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->con = new PDO("mysql:host=$this->hostname;dbname=cart", $this->username, $this->password);
    }


    public function insert($sq)
    {
        return $result = $this->con->query($sq);


    }

//    public function lis($sql)
//    {
//        return $result = $this->con->query($sql);
//    }
//
//    public function stre($sql)
//    {
//        return $result = $this->con->query($sql);
//    }
//
//    public function item($sql)
//    {
//        return $res = $this->con->query($sql);
//    }
//
//    public function store_list($sql)
//    {
//        return $res = $this->con->query($sql);
//    }


    public function pagination($page, $direct, $a)
    {
        ?>
        <ul class="pagination">
            <?php for ($b = 1; $b <= $a; $b++) {
        ?>
        <li class="<?php if (($page && $page == $b) || (!$page && $b == 1)) echo "active" ?>"><a
        href= "<?php echo $direct; ?>?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
                <?php
    }?>
        </ul>
    <?php }


    public function redirect($location)
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$location.'">';
        exit;
    }
}
?>