<?php 
    include 'inc/header.php';
    $login = Session::get("cuslogin");
    if ($login != false){
        header("Location:cart.php");
    }
?>
    <?php
        $username = "username";
        $password = "password";
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
            $custLogin = $cmr->customerLogin($_POST);
        }
    ?>
 <div class="main">
    <div class="content">
    	<div class="login_panel">
            <h3>Existing Customers</h3>
            <h5>Sign in with the form below.</h5>
        <?php
            if (isset($custLogin)){
                echo $custLogin;
            }
        ?>
            <form action="" method="post"/>
                <input name="username" type="text" placeholder="Username or Email"/>
                <input name="password" type="password" placeholder="Password"/>
                <div class="buttons"><div><button class="grey"  name="login">Sign In</button></div></div>
            </form>
        </div>
    	<?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
                $customerReg = $cmr->customerRegistration($_POST);
            }
        ?>
        <div class="register_account">    
        <h3>Register New Account</h3>
    <?php
        if (isset($customerReg)){
            echo $customerReg;
        }
    ?>
        <form action="" method="post">
            <table>
                <tbody>
                    <tr>
                        <td>
                             <div>
                                     <input type="text" name="firstname" placeholder="First Name"/>
                             </div>
                             <div>
                                     <input type="text" name="city" placeholder="City"/>
                             </div>

                             <div>
                                     <input type="text" name="postcode" placeholder="Zip-Code"/>
                             </div>
                             <div>
                                     <input type="text" name="email" placeholder="E-Mail"/>
                             </div>
                            <div>
                                     <input type="text" name="username" placeholder="Username/Email"/>
                             </div>
                         </td>
                         <td>
                             <div>
                                     <input type="text" name="lastname" placeholder="Last Name"/>
                             </div>
                             <div>
                                     <input type="text" name="address" placeholder="Address"/>
                             </div>
                             <div>
                                   <input type="text" name="country" placeholder="Country"/>
                             </div>
                             <div>
                                     <input type="text"name="phone"  placeholder="Phone"/>
                             </div>
                             <div>
                                   <input type="text" name="password" placeholder="Password"/>
                             </div>
                         </td>
                    </tr> 
            </tbody></table> 
            <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
                <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
            <div class="clear"></div>
        </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php include 'inc/footer.php';?>