<?php 
    include 'inc/header.php';
    $login = Session::get("cuslogin");
    if ($login == false){
        header("Location:login.php");
    }
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
                <h2>Order page</h2>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include 'inc/footer.php';?>