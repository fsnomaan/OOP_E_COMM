<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Product{
    private $db;
    private $fm;
    public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
    }

    public function productInsert($data, $file){
        $productName = $this->fm->validation($data['productName']);

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body        = mysqli_real_escape_string($this->db->link, $data['body']);
        $price       = mysqli_real_escape_string($this->db->link, $data['price']);
        $type        = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ($productName=="" || $catId=="" || $brandId=="" ||
                $body=="" || $price=="" || $type==""){
            $msg = "<span class='error'> Fields must not be empty </span>";
            return $msg;
        } elseif($file_size > 10450000){
            echo "<span class='error'>Image size should be less then 1MB !!! </span> ";
        } elseif(in_array($file_ext, $permited) === false){
            echo "<span class='error'>You can Upload type only: ".implode(',',$permited)." </span> ";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, brandid, body, price, image, type) "
                    . "VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
            $inserted_row = $this->db->insert($query) ;
            if ($inserted_row){
                $msg = "<span class='success'>Product inserted successfully</span>";
                return $msg;
            } else{
                $msg = "<span class='error'>Product NOT inserted </span>";
                return $msg;
            }
        }
    }
    public function getAllProduct(){
        $query = " SELECT p.*, c.catName, b.brandName
                FROM tbl_product as p, tbl_category as c, tbl_brand as b
                WHERE p.catId = c.catId AND p.brandId = b.brandId
                ORDER BY p.productId DESC";

        $result = $this->db->select($query);
        return $result;
    }
    public function getProById($id){
        $query = "SELECT * FROM tbl_product WHERE productId='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file , $id){

        $productName = $this->fm->validation($data['productName']);

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body        = mysqli_real_escape_string($this->db->link, $data['body']);
        $price       = mysqli_real_escape_string($this->db->link, $data['price']);
        $type        = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ($productName=="" || $catId=="" || $brandId=="" ||
                $body=="" || $price=="" || $type==""){
            $msg = "<span class='error'> Fields must not be empty </span>";
            return $msg;
        } elseif($file_size > 10450000){
            echo "<span class='error'>Image size should be less then 1MB !!! </span> ";
        } else {
            if (empty($file_name)){
            $query = "UPDATE tbl_product SET
                        productName = '$productName',
                        catId       = '$catId',
                        brandId     = '$brandId',
                        body        = '$body',
                        price       = '$price',
                        type        = '$type'
                        WHERE productId = '$id'";
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    catId       = '$catId',
                    brandId     = '$brandId',
                    body        = '$body',
                    price       = '$price',
                    image       = '$uploaded_image',
                    type        = '$type'
                    WHERE productId = '$id'";
            }
            $updated_row = $this->db->update($query) ;
            if ($updated_row){
                $msg = "<span class='success'>Product Updated successfully</span>";
                return $msg;
            } else{
                $msg = "<span class='error'>Product NOT Updated </span>";
                return $msg;
            }
        }
    }

    public function delProById($id){
        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $getData = $this->db->select($query);
        if ($getData){
            while ($delImg = $getData->fetch_assoc()){
                $dellink = $delImg['image'];
                unlink($dellink);
            }
        }
        $delquery = "DELETE FROM tbl_product WHERE productId = '$id'";
        $deldata = $this->db->delete($delquery) ;
        if ($deldata){
            $msg = "<span class='success'>Product Deleted successfully</span>";
            return $msg;
        } else{
            $msg = "<span class='error'>Producty NOT Deleted </span>";
            return $msg;
        }
    }

    public function getFeaturedProduct(){
        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

     public function getNewProduct(){
        $query = "SELECT * FROM tbl_product  ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct($id){
        $query = " SELECT p.*, c.catName, b.brandName
                FROM tbl_product as p, tbl_category as c, tbl_brand as b
                WHERE p.catId = c.catId AND p.brandId = b.brandId
                AND p.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromIphone(){
        $query = "SELECT * FROM tbl_product  WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromSansung(){
        $query = "SELECT * FROM tbl_product  WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromAcer(){
        $query = "SELECT * FROM tbl_product  WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromCanon(){
        $query = "SELECT * FROM tbl_product  WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductByCat($id){
        $query = "SELECT * FROM tbl_product WHERE catId='$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>
