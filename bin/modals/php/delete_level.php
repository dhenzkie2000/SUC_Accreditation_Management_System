<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['lvl_id'])){
    $lvl_code = $_POST['lvl_id'];
    $query = "DELETE FROM accsys.maintenance_level WHERE lvl_code ='$lvl_code'";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>