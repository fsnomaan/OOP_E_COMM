<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Customer{
    private $db;
    private $fm;
    public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
    }
    public function customerRegistration($data){
        $firstname  = mysqli_real_escape_string($this->db->link, $data['firstname']);
        $lastname   = mysqli_real_escape_string($this->db->link, $data['lastname']);
        $city       = mysqli_real_escape_string($this->db->link, $data['city']); 
        $address    = mysqli_real_escape_string($this->db->link, $data['address']); 
        $postcode   = mysqli_real_escape_string($this->db->link, $data['postcode']); 
        $country    = mysqli_real_escape_string($this->db->link, $data['country']); 
        $email      = mysqli_real_escape_string($this->db->link, $data['email']); 
        $phone      = mysqli_real_escape_string($this->db->link, $data['phone']); 
        $username   = mysqli_real_escape_string($this->db->link, $data['username']); 
        $password   = mysqli_real_escape_string($this->db->link, $data['password']); 
        if ($firstname=="" || $lastname=="" || $city=="" || $address=="" || $postcode=="" || $country=="" || $email=="" || $phone=="" || $username=="" || $password==""){
            $msg = "<span class='error'> Fields must not be empty </span>";
            return $msg;
        } 
        $emailCheck = "SELECT * FROM tbl_customer WHERE email ='$email' LIMIT 1";
        $emailChk = $this->db->select($emailCheck);
        if ($emailChk == false){
            $query = "INSERT INTO tbl_customer(firstName, lastName, address, city, postcode, country, email, phone, username, password) " . "VALUES('$firstname','$lastname','$address','$city','$postcode','$country','$email', '$phone', '$username', '$password')";
            $inserted_row = $this->db->insert($query) ;
            if ($inserted_row){
                $msg = "<span class='success'>Customer Account created successfully</span>";
                return $msg;              
            } else{
                $msg = "<span class='error'>Customer Account cound not create </span>";
                return $msg;
            }
        }else{
            $msg = "<span class='error'> Email already exist!!! Please enter a new Email address. </span>";
            return $msg; 
        }
    }
    public function customerLogin($data){
        $username   = mysqli_real_escape_string($this->db->link, $data['username']); 
        $password   = mysqli_real_escape_string($this->db->link, $data['password']);
        if (empty($username) || empty($password)){
            $msg = "<span class='error'> User name And Password must not be empty </span>";
        }
        $query = "SELECT * FROM tbl_customer WHERE username ='$username' AND password ='$password'";
        $result = $this->db->select($query);
        if ($result != false){
            while($value = $result->fetch_assoc()){
            Session::set("cuslogin", true);
            Session::set("cusId", $value['cusId']);
            Session::set("firstName", $value['firstName']);
            Session::set("lastName", $value['lastName']);
            header("Location:cart.php");
            }
        }else{
            $msg = "<span class='error'> Username And Password Not match </span>";
            return $msg;
        }
    }
    public function getCustomerdata($id){
        $query = "SELECT * FROM tbl_customer  WHERE cusId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function customerUpdate($data, $id){
        $firstName  = mysqli_real_escape_string($this->db->link, $data['firstName']);
        $lastName   = mysqli_real_escape_string($this->db->link, $data['lastName']);
        $city       = mysqli_real_escape_string($this->db->link, $data['city']); 
        $address    = mysqli_real_escape_string($this->db->link, $data['address']); 
        $postcode   = mysqli_real_escape_string($this->db->link, $data['postcode']); 
        $country    = mysqli_real_escape_string($this->db->link, $data['country']); 
        $email      = mysqli_real_escape_string($this->db->link, $data['email']); 
        $phone      = mysqli_real_escape_string($this->db->link, $data['phone']); 
        if ($firstName=="" || $lastName=="" || $city=="" || $address=="" || $postcode=="" || $country=="" || $email=="" || $phone==""){
            $msg = "<span class='error'> Fields must not be empty </span>";
            return $msg;
        } 

        $query = "UPDATE tbl_customer
                SET 
                firstName   = '$firstName',
                lastName    = '$lastName',
                address     = '$address',
                city        = '$city',
                postcode    = '$postcode',
                country     = '$country',
                email       = '$email',
                phone       = '$phone'
            WHERE cusId = '$id'";    
        $updated_row = $this->db->update($query) ;
        if ($updated_row){
            $msg = "<span class='success'>Customer data Updated successfully</span>";
            return $msg;              
        } else{
            $msg = "<span class='error'>Customer data  cound not Updated </span>";
            return $msg;
        }
    } 
}
?>