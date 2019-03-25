<?php 
    include 'inc/header.php';
    $login = Session::get("cuslogin");
    if ($login == false){
        header("Location:login.php");
    }
?>
<?php
    $id = Session::get("cusId");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['back'])){
        header("Location:profile.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $cusUpdate = $cmr->customerUpdate($_POST, $id);
    }
?>
<style>
    .tblone{width:500px; margin:0 auto; border:2px solid #ddd;}
    .tblone tr td{text-align:justify;}
    .tblone input[type="text"]{width:300px;}
</style>

<div class="main">
    <div class="content">
        <div class="section group">     
        <?php
            $id = Session::get("cusId");
            $getdata = $cmr->getCustomerdata($id);
            if ($getdata){
                while($result = $getdata->fetch_assoc()){
        ?>
        <form action="" method="post">
        <table class="tblone">
            <?php if (isset($cusUpdate)){
           echo " <tr> <td></td>
                <td colspan='2'>". $cusUpdate ."</td>
            </tr>
            ";}?>
            <tr>
                <td></td>
                <td colspan="2" font-color="red">Update Your Profile Details</td>
            </tr>
            <tr>
                <td width="25%">First Name</td>
                <td><input type="text" name="firstName" value="<?php echo $result['firstName'];?>"></td>
            </tr>
            <tr>
                <td width="20%">Last Name</td>
                <td><input type="text" name="lastName" value="<?php echo $result['lastName'];?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" name="address" value="<?php echo $result['address'];?>"></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
            </tr>
            <tr>
                <td>Postcode</td>
                <td><input type="text" name="postcode" value="<?php echo $result['postcode'];?>"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><input type="text" name="country" value="<?php echo $result['country'];?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $result['email'];?>"></td>
            </tr>
            <tr>
                <td>Mobile Phone</td>
                <td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Update"></td>
                <td><input type="submit" name="back" value="Back"></td>
            </tr>
        </table>
        </form>
        <?php } }?>
        </div> 
    </div>
</div>

<?php include 'inc/footer.php';?>