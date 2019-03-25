<?php 
    $filepath = realpath(dirname(__FILE__));
    include ($filepath.'/inc/header.php');
    include ($filepath.'/../inc/sidebar.php');

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2> Dashboard </h2>
                <div class="block">               
                  Welcome to Admin panel        
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
