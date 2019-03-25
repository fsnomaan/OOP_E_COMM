<?php include 'inc/header.php';?>
<?php
    $login = Session::get("cuslogin");
    if ($login == false){
        header("Location:login.php");
    }
?>
<style>
    .tblone{width:550px;margin:0 auto; border:2px solid #ddd;}
    .tblone tr td{text-align:justify;}
</style> 
<div class="main">
    <div class="content">
        <div class="section group">
        
        <?php
                $id = Session::get("$login");
            $getdata = $cmr->getCustomerdata($id);
            if ($getdata){
                while($result = $getdata->fetch_assoc()){
        ?>
        <table class="tblone">
            <tr>
                <td></td>
                <td colspan="3" font-color="red">Your Profile Details</td>
            </tr>
            <tr>
                <td width="25%">First Name</td>
                <td width="5%">:</td>
                <td><?php echo $result['firstName'];?></td>
            </tr>
            <tr>
                <td width="20%">Last Name</td>
                <td width="5%">:</td>
                <td><?php echo $result['lastName'];?></td>
            </tr>
            <tr>
                <td>Mobile Phone</td>
                <td>:</td>
                <td><?php echo $result['phone'];?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $result['email'];?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $result['address'];?></td>
            </tr>
            <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $result['city'];?></td>
            </tr>
            <tr>
                <td>Postcode</td>
                <td>:</td>
                <td><?php echo $result['postcode'];?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $result['country'];?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="editprofile.php">Update Profile Details</a></td>
            </tr>
        </table>
        <?php } } ?>
        </div> 
    </div>
</div>

<?php include 'inc/footer.php';?>