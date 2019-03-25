<?php
//error_reporting(0);
    $filepath = realpath(dirname(__FILE__));
		include_once ($filepath.'/../lib/Session.php');
		include_once ($filepath.'/../lib/Database.php');
		include_once ($filepath.'/../classes/Product.php');
		include_once ($filepath.'/../classes/category.php');
		include_once ($filepath.'/../classes/Cart.php');
		include_once ($filepath.'/../classes/Customer.php');
		include_once ($filepath.'/../helpers/Format.php');

	    Session::init();

        spl_autoload_register(function($class)
        {
        include "classes/".$class.".php";
        });
        $db  = new Database();
        $fm  = new Format();
        $pd  = new Product();
        $cat = new category();
        $ct  = new Cart();
        $cmr = new Customer();


    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");
?>

<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
    <div class="header_top">
        <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
        </div>
          <div class="header_top_right">
            <div class="search_box">
                <form>
                    <input type="text" value="Search for Products" onfocus="this.value = '';
                           " onblur="if (this.value == '') {this.value = 'Search for Products';}">
                    <input type="submit" value="SEARCH">
                </form>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                    <a href="cart.php" title="View my shopping cart" rel="nofollow">
                        <span class="cart_title" >Cart</span>
                        <span class="no_product">
                        <?php
                        $total = 0;
                        $gTotal = 0;
                        $qty = 0;
                            $sId = session_id();
                            $getPro = $ct->getCartProduct();
                            if ($getPro){
                                while ($result = $getPro->fetch_assoc()){
                                    $total= $total + ($result['price']* $result['quantity'] );
                                    $qty = $qty + $result['quantity'];
                                }
                            }
                            $gTotal = $gTotal + ($total * 0.2) + $total;
                            Session::set("gTotal", $gTotal);
                            Session::set("qty", $qty);
                            $gTotal = session::get("gTotal");
                            $qty = session::get("qty");
                            if ($gTotal<=0){
                                echo "Empty";
                            }else
                            echo "£". $gTotal. " , Qty:".$qty;

                        ?>
                        </span>
                            </a>
                    </div>
                </div>
        <?php // to logout and clear the session data..
            if (isset($_GET['cid'])){
                $deldata = $ct->delCustomerCart();
                Session::destroy();
                header("Location:index.php");
            }
        ?>
            <div class="login">
            <?php
                $login = Session::get("cuslogin");
                if ($login == false){
            ?>
                <a href="login.php">Login</a>
            <?php    }else { ?>
                        <a href="?cid=<?php Session::get('cusId');?>">Logout</a>
            <?php    }?>

            </div>
            <div class="clear"></div>
            </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <li><a href="cart.php">Categories</a></li>
	  <li><a href="contact.php">Contact</a> </li>
          <?php
                $login = Session::get("cuslogin");
                if ($login == true){
          ?>
          <li><a href="profile.php">Profile</a> </li>
          <?php }?>
	  <div class="clear"></div>
	</ul>
</div>
