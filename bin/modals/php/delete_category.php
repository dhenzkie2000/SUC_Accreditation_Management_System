<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['cat_code'])){
    $cat_code = $_POST['cat_code'];
    $query = "DELETE FROM accsys.maintenance_parameter_category WHERE cat_code ='$cat_code'";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>